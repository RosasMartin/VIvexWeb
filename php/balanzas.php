<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vivex</title>

    
    <!-- Silider JQuery library and script-->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    
    
    <!-- Slider touch library -->
    <script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script src="http://code.jquery.com/ui/1.8.21/jquery-ui.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    
    <!-- Seteo de caracterisicas de slider -->
    <script>
        
    $( function() {
        $( "#slider-range" ).slider({
        range: true,
        min: 0,
        max: 120,
        values: [ 6, 99 ],
        slide: function( event, ui ) {
            $( "#amount" ).val( "Min: " + ui.values[ 0 ] + " - Max: " + ui.values[ 1 ] );
            consultarDatos();
        }
        });

        $( "#amount" ).val( "Min: " + $( "#slider-range" ).slider( "values", 0 ) +
        " - Max: " + $( "#slider-range" ).slider( "values", 1 ) );
        
    } );
        
    </script>
    <!-- End Slider -->

    <!-- Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js"></script>
    <!-- End Chart.js -->
    
    <!-- PopUp -->
    <script type="text/javascript" src="../js/popup.js"></script>
    
    
	<link rel="stylesheet" type="text/css" href="../css/component.css" />
	<!-- remove this if you use Modernizr -->
	<script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>
	

    <!-- Mlutiple Select library -->
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="../css/example-styles-dos.css">
    <script type="text/javascript" src="../js/jquery.multi-select.js"></script>

    <!-- CSS Styles -->
    <link href="https://necolas.github.io/normalize.css/8.0.1/normalize.css" rel="stylesheet">
    
    <link rel="stylesheet" href="../css/balanzas.css">
    

    
</head>

<!-- PHP session -->
<?php 
    session_start();
    //Recibimos las variables
    
    //Recibimos información del Administrador
    
    $nombre = $_SESSION['nombre'];
    $apellido = $_SESSION['apellido'];
    $status = $_SESSION['status'];
    $email = $_SESSION['email'];
    
    $usuario = $_SESSION['usuario'];
    $id_institucion = $_SESSION['id_institucion'];
    $id_administrador = $_SESSION['id_administrador'];
    $institucion = $_SESSION['institucion'];
    
    $pais = $_SESSION['pais'];
    $provincia = $_SESSION['provincia'];
    $ciudad = $_SESSION['ciudad'];

    if($nombre==null){
        session_destroy();
        header("Location:../index.html");

    }
    
    error_reporting(0);
    
    //iniciamos sesion en la base de datos
    
    
    //$db_name = "healthyjunio";
    //$mysql_user = "root";
    //$mysql_pass = "Joseroot01";
    //$server_name = "localhost";
    //$var_res = "";
    //$conexion=mysqli_connect($server_name,$mysql_user,$mysql_pass,$db_name);


    //consultamos Provincias, ciudades e intituciones disponibles de acuerdo al valor "status"
    

?>
<?php 
require "./ajax/conexion.php";
$user=new vivexDB();
$files="";
?>


<body>
    <!-- Header -->
    <header class="header">
        <div class="links">
            <a href="http://www.arconsultores.com.ar/">
                <img src="../img/ARConsultores.png" alt="AR logo">
            </a>
        
            <a href="http://www.sanjuan.gov.ar/">
                <img src="../img/SanJuan.png" alt="logo san juan">
            </a>
        </div>
        <div class="barra">
            <ul class="nav">
                <li><a href="#">Configuraciones</a>
                    <ul>
                        <li><a href="#" id="Admin" onclick="open_popup(this.id);">Agregar Administrador</a></li>
                        <li><a href="#" id="Insti" onclick="open_popup(this.id);">Agregar Instituciones</a></li>
                        <li><a href="#" id="Alumn" onclick="open_popup(this.id);">Agregar Alumnos</a></li>
                        <li><a href="balanzas.php">Balanzas</a></li>
                    </ul>
                </li>
                <li><a href="#">Búsqueda</a></li>
                <li><a href="#">Mapas</a></li>
                <li><a href="#">Comparativas</a></li>
                <li><a href="../php/principal.php">Inicio</a></li>
            </ul>
        </div>
    </header>
    <!-- End Header -->


<!--################################################################################################################-->    
    <!-- Javascript functions -->
    <script type="text/javascript">
               
        //Ajax
        function change_pais(){
            //Ajax provincia
            var parametrospaises= ""+$("#paises").val();
                        
            $.ajax({
                data: {'id':parametrospaises},
                url:   './ajax/ajax_provincias.php',
                type:  'POST',
                beforeSend: function () {
                    //console.log("Enviando");
                    
                },
                success:  function (response) { 

                    $("#provincias_recargar").html(response);
                    //console.log("cambio");
                    //console.log(parametrospaises);
                    //console.log(response);
                    
                },
                error:function(){
                    alert("error")
                }
            });
        }

        function change_provincia(){
            //Ajax ciudades
            var parametrosProvincias= ""+$("#provincias").val();
                        
            $.ajax({
                data: {'id':parametrosProvincias},
                url:   './ajax/ajax_ciudades.php',
                type:  'POST',
                beforeSend: function () {
                    //console.log("Enviando");
                    
                },
                success:  function (response) { 

                    $("#ciudades_recargar").html(response);
                    //console.log("cambio");
                    //console.log(parametrosProvincias);
                    //console.log(response);
                    
                },
                error:function(){
                    alert("error")
                }
            });
        }

        function change_ciudad(){
            //Ajax instituciones
            var parametrosciudades= ""+$("#ciudades").val();
                        
            $.ajax({
                data: {'id':parametrosciudades},
                url:   './ajax/ajax_instituciones.php',
                type:  'POST',
                beforeSend: function () {
                    //console.log("Enviando");
                    
                },
                success:  function (response) { 

                    $("#instituciones_recargar").html(response);
                    //console.log("cambio");
                    //console.log(parametrosciudades);
                    //console.log(response);
                    
                },
                error:function(){
                    alert("error")
                }
            });
            //End Ajax instituciones
        }

        function change_contrato(){
            //Ajax instituciones
            
                        
            $.ajax({
                data: {'id':"-"},
                url:   './ajax/ajax_contratos.php',
                type:  'POST',
                beforeSend: function () {
                    //console.log("Enviando");
                    
                },
                success:  function (response) { 

                    $("#contratos_recargar").html(response);
                    //console.log("cambio");
                    //console.log(parametrosciudades);
                    //console.log(response);
                    
                },
                error:function(){
                    alert("error")
                }
            });
            //End Ajax instituciones
        }

        function dispositivos(){
            var parametrospaises= ""+$("#paises").val();
            var parametrosProvincias= ""+$("#provincias").val();
            var parametrosciudades= ""+$("#ciudades").val();
            var parametrosinstituciones= ""+$("#instituciones").val();
            var parametroscontrato= ""+$("#contratos").val();
            //alert("contratos: "+parametroscontrato);      
            $.ajax({
                data: { 'id_pais':parametrospaises,
                        'id_provincia':parametrosProvincias,
                        'id_ciudad':parametrosciudades,
                        'id_institucion':parametrosinstituciones,
                        'id_contrato':parametroscontrato},
                url:   './ajax/ajax_dispositivos.php',
                type:  'POST',
                beforeSend: function () {
                //console.log("Enviando");
                    
                },
                success:  function (response) { 

                    $("#contenido-dispositivos").html(response);
                    //console.log("cambio");
                    //console.log(parametrospaises);
                    console.log(response);
                    
                },
                error:function(){
                    alert("error")
                }
            });
        }

        function bloquear_disp(clicked_id){ //id_hardware
            console.log("ajax dispositivos");           
            $.ajax({
                data: { 'id_dispositivo':clicked_id},
                url:   './ajax/ajax_dispositivos_block.php',
                type:  'POST',
                beforeSend: function () {
                //console.log("Enviando");
                    
                },
                success:  function (response) { 

                    //$("#contenido-dispositivos").html(response);
                    //console.log("cambio");
                    //console.log(parametrospaises);
                    console.log(response);
                    if(response==0){
                        document.getElementById(clicked_id).src = '../img/bloqueado.png';
                        console.log("bloqueado");
                    }
                    if(response==1){
                        document.getElementById(clicked_id).src = '../img/bloquear.png';
                        console.log("bloquear");
                    }
                    dispositivos_mapa();
                    dispositivos_estado();
                },
                error:function(){
                    alert("error")
                }
            });
        }

        function borrar_disp(clicked_id){ //id_hardware
            console.log("ajax dispositivos");           
            $.ajax({
                data: { 'id_dispositivo':clicked_id},
                url:   './ajax/ajax_dispositivos_delete.php',
                type:  'POST',
                beforeSend: function () {
                //console.log("Enviando");
                    
                },
                success:  function (response) { 

                    dispositivos();
                    dispositivos_mapa();
                    dispositivos_estado();
                },
                error:function(){
                    alert("error")
                }
            });
        }

        function dispositivos_mapa(){ //id_hardware
            var parametrospaises= ""+$("#paises").val();
            var parametrosProvincias= ""+$("#provincias").val();
            var parametrosciudades= ""+$("#ciudades").val();
            var parametrosinstituciones= ""+$("#instituciones").val();
            var parametroscontrato= ""+$("#contratos").val();
            //alert("contratos: "+parametroscontrato); 
            //console.log("ajax dispositivos");           
            $.ajax({
                data: { 'id_pais':parametrospaises,
                        'id_provincia':parametrosProvincias,
                        'id_ciudad':parametrosciudades,
                        'id_institucion':parametrosinstituciones,
                        'id_contrato':parametroscontrato},
                url:   './ajax/ajax_dispositivos_mapa.php',
                type:  'POST',
                beforeSend: function () {
                //console.log("Enviando");
                    
                },
                success:  function (response) { 

                    $("#map").html(response);
                    //console.log("cambio");
                    //console.log(parametrospaises);
                    //console.log("mapa");
                    
                    
                },
                error:function(){
                    alert("error")
                }
            });
        }

        function dispositivos_estado(){ //id_hardware
            var parametrospaises= ""+$("#paises").val();
            var parametrosProvincias= ""+$("#provincias").val();
            var parametrosciudades= ""+$("#ciudades").val();
            var parametrosinstituciones= ""+$("#instituciones").val();
            var parametroscontrato= ""+$("#contratos").val();
            //console.log("ajax dispositivos");           
            $.ajax({
                data: { 'id_pais':parametrospaises,
                        'id_provincia':parametrosProvincias,
                        'id_ciudad':parametrosciudades,
                        'id_institucion':parametrosinstituciones,
                        'id_contrato':parametroscontrato},
                url:   './ajax/ajax_dispositivos_estado.php',
                type:  'POST',
                beforeSend: function () {
                //console.log("Enviando");
                    
                },
                success:  function (response) { 

                    $("#dispositivos_estado").html(response);
                    //console.log("cambio");
                    //console.log(parametrospaises);
                    //console.log("mapa");
                    
                    
                },
                error:function(){
                    alert("error")
                }
            });
        }
        //End Ajax

        //Google Maps initMap Function (Ajax Response)
        var markers="";
        var infoWindowContent="";
        var icon_select="";
        var estado="";
        function initMap() {
            var map;
            var bounds = new google.maps.LatLngBounds();
            var mapOptions = {
                mapTypeId: google.maps.MapTypeId.HYBRID,
            };
                            
            // Display a map on the web page
            map = new google.maps.Map(document.getElementById("map"), mapOptions);
            map.setTilt(50);
                
            console.log(markers);
            console.log(infoWindowContent);
            console.log(icon_select);    
            // Add multiple markers to map
            var infoWindow = new google.maps.InfoWindow(), marker, i;
            
            //Iconos
            var normal_icon = {
                url: "../img/mapa_indicador_normal.png", // url
                scaledSize: new google.maps.Size(30, 30), // scaled size
                origin: new google.maps.Point(0,0), // origin
                anchor: new google.maps.Point(0, 0) // anchor
            };
            var leve_icon = {
                url: "../img/mapa_indicador_leve.png", // url
                scaledSize: new google.maps.Size(30, 30), // scaled size
                origin: new google.maps.Point(0,0), // origin
                anchor: new google.maps.Point(0, 0) // anchor
            };
            var alto_icon = {
                url: "../img/mapa_indicador_alto.png", // url
                scaledSize: new google.maps.Size(30, 30), // scaled size
                origin: new google.maps.Point(0,0), // origin
                anchor: new google.maps.Point(0, 0) // anchor
            };
            var null_icon = {
                url: "../img/mapa_indicador_null.png", // url
                scaledSize: new google.maps.Size(30, 30), // scaled size
                origin: new google.maps.Point(0,0), // origin
                anchor: new google.maps.Point(0, 0) // anchor
            };
            var block_icon = {
                url: "../img/mapa_indicador_block.png", // url
                scaledSize: new google.maps.Size(30, 30), // scaled size
                origin: new google.maps.Point(0,0), // origin
                anchor: new google.maps.Point(0, 0) // anchor
            };
            var nada_icon = {
                url: "../img/mapa_indicador_nada.png", // url
                scaledSize: new google.maps.Size(30, 30), // scaled size
                origin: new google.maps.Point(0,0), // origin
                anchor: new google.maps.Point(0, 0) // anchor
            };
            //End iconos
            
            // Place each marker on the map 
             
                for( i = 0; i < markers.length; i++ ) {
                    if(icon_select[i]=="1"){
                        var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
                        bounds.extend(position);
                        marker = new google.maps.Marker({
                            position: position,
                            icon: normal_icon,
                            map: map,
                            title: markers[i][0]
                        });
                        
                        // Add info window to marker    
                        google.maps.event.addListener(marker, "click", (function(marker, i) {
                            return function() {
                                infoWindow.setContent(infoWindowContent[i][0]);
                                infoWindow.open(map, marker);
                            }
                        })(marker, i));

                        // Center the map to fit all markers on the screen
                        map.fitBounds(bounds);
                    }
                    if(estado[i]=="Off Line"){
                        var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
                        bounds.extend(position);
                        marker = new google.maps.Marker({
                            position: position,
                            icon: alto_icon,
                            map: map,
                            title: markers[i][0]
                        });
                        
                        // Add info window to marker    
                        google.maps.event.addListener(marker, "click", (function(marker, i) {
                            return function() {
                                infoWindow.setContent(infoWindowContent[i][0]);
                                infoWindow.open(map, marker);
                            }
                        })(marker, i));

                        // Center the map to fit all markers on the screen
                        map.fitBounds(bounds);
                    }
                    
                    
                    if(icon_select[i]=="0"){
                        var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
                        bounds.extend(position);
                        marker = new google.maps.Marker({
                            position: position,
                            icon: block_icon,
                            map: map,
                            title: markers[i][0]
                        });
                        
                        // Add info window to marker    
                        google.maps.event.addListener(marker, "click", (function(marker, i) {
                            return function() {
                                infoWindow.setContent(infoWindowContent[i][0]);
                                infoWindow.open(map, marker);
                            }
                        })(marker, i));

                        // Center the map to fit all markers on the screen
                        map.fitBounds(bounds);
                    }

                    if(icon_select[i]=="2"){
                        console.log("nada");
                        marker.setMap(null);
                        marker=null;
                        var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
                        bounds.extend(position);
                        marker = new google.maps.Marker({
                            position: position,
                            icon: " ",
                            map: map,
                            title: markers[i][0]
                        });
                        
                        // Add info window to marker    
                        google.maps.event.addListener(marker, "click", (function(marker, i) {
                            return function() {
                                infoWindow.setContent(infoWindowContent[i][0]);
                                infoWindow.open(map, marker);
                            }
                        })(marker, i));

                        // Center the map to fit all markers on the screen
                        map.fitBounds(bounds);
                        
                    }

                    if(icon_select[i]=="3"){
                        console.log("nada");
                        var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
                        bounds.extend(position);
                        marker = new google.maps.Marker({
                            position: position,
                            icon: " ",
                            map: map,
                            title: markers[i][0]
                        });
                        
                        // Add info window to marker    
                        google.maps.event.addListener(marker, "click", (function(marker, i) {
                            return function() {
                                infoWindow.setContent(infoWindowContent[i][0]);
                                infoWindow.open(map, marker);
                            }
                        })(marker, i));

                        // Center the map to fit all markers on the screen
                        map.fitBounds(bounds);
                        
                    }
                   
                }
           
             
               
                    
            

            // Set zoom level
            var boundsListener = google.maps.event.addListener((map), "bounds_changed", function(event) {
                this.setZoom(5);
                google.maps.event.removeListener(boundsListener);
            });
            
        }
        //End Google Maps
    </script> 
    
<!--################################################################################################################-->    
    <!-- Main -->
    <main>
        <!-- PopUp (Formularios) -->
       
        <div class="overlay" id="overlay">
			<div class="popup" id="popup">
           
			</div>
        </div>
        <script type="text/javascript">
           

            function open_popup(clicked_id){
                //alert(clicked_id);
                //llamada de ajax popup
                //Ajax
                //Agregar Administrador
                if(clicked_id=="Admin"){
                    $.ajax({
                        data: { 'id':clicked_id},
                        url:   './ajax/ajax_popup_add_admin.php',
                        type:  'POST',
                        beforeSend: function () {
                        //console.log("Enviando");
                            
                        },
                        success:  function (response) { 

                            $("#popup").html(response);
                            //console.log("cambio");
                            //console.log(parametrospaises);
                            //console.log("mapa");
                            show_popup();
                            
                        },
                        error:function(){
                            alert("error")
                        }
                    });
                }

                //Agregar Institucion
                if(clicked_id=="Insti"){
                    $.ajax({
                        data: { 'id':clicked_id},
                        url:   './ajax/ajax_popup_add_insti.php',
                        type:  'POST',
                        beforeSend: function () {
                        //console.log("Enviando");
                            
                        },
                        success:  function (response) { 

                            $("#popup").html(response);
                            //console.log("cambio");
                            //console.log(parametrospaises);
                            //console.log("mapa");
                            show_popup();
                            
                        },
                        error:function(){
                            alert("error")
                        }
                    });
                }

                //Agregar Alumnos
                if(clicked_id=="Alumn"){
                    $.ajax({
                        data: { 'id':clicked_id},
                        url:   './ajax/ajax_popup_add_alumnos.php',
                        type:  'POST',
                        beforeSend: function () {
                        //console.log("Enviando");
                            
                        },
                        success:  function (response) { 

                            $("#popup").html(response);
                            //console.log("cambio");
                            //console.log(parametrospaises);
                            //console.log("mapa");
                            
                            show_popup();
                            
                            
                        },
                        error:function(){
                            alert("error")
                        }
                    });
                }

                //Editar balanza
                if(clicked_id.includes("edit")){
                    id=clicked_id.replace('edit', '');
                    alert('edit:'+id);
                }

                //Informacion balanza
                if(clicked_id.includes("info")){
                    id=clicked_id.replace('info', '');
                    //alert('info:'+id);

                    $.ajax({
                        data: { 'id':id},
                        url:   './ajax/ajax_popup_info_balanza.php',
                        type:  'POST',
                        beforeSend: function () {
                        //console.log("Enviando");
                            
                        },
                        success:  function (response) { 

                            $("#popup").html(response);
                            //console.log("cambio");
                            //console.log(parametrospaises);
                            //console.log("mapa");
                            
                            show_popup();
                            
                            
                        },
                        error:function(){
                            alert("error")
                        }
                    });

                }
                
                //Borrar balanza
                if(clicked_id.includes("borrar")){
                    id=clicked_id.replace('borrar', '');
                    alert('borrar:'+id);
                }
            }
            //show popup
            function show_popup(){
                var overlay = document.getElementById('overlay'),
                popup = document.getElementById('popup'),
                btnCerrarPopup = document.getElementById('btn-cerrar-popup');

                btnCerrarPopup.addEventListener('click', function(e){
                    e.preventDefault();
                    overlay.classList.remove('active');
                    popup.classList.remove('active');
                });

                overlay.classList.add('active');
                popup.classList.add('active');
            }
        </script>
        <!-- End PopUp -->
        <!-- Estado de las balanzas -->
            <div class="balanzas-estado">
                <div class="barra-balanzas-estado">
                    <p>Estado de las balanzas</p>
                </div>
                <div id="dispositivos_estado" class="contenido-balanzas-estado">
                    <div class="estado-uno">
                        <div class="uno-valores">
                            <p class="cantidad-balanzas">0</p>
                            <p class="porcentaje-balanzas">0%</p>
                        </div>
                        <div class="online">
                            <p>Dispositivos Online</p>
                        </div>
                    </div>
                    <div class="estado-dos">
                        <div class="dos-valores">
                            <p class="cantidad-balanzas">0</p>
                            <p class="porcentaje-balanzas">0%</p>
                        </div>
                        <div class="offline">
                            <p>Dispositivos Offline</p>
                        </div>
                    </div>
                    <div class="estado-tres">
                        <div class="tres-valores">
                            <p class="cantidad-transacciones">0</p>
                        </div>
                        <div class="transacciones">
                            <p>Transacciones Mensuales</p>
                        </div>
                    </div>
                    <div class="estado-cuatro">
                        <div class="cuatro-valores">
                            <p class="cantidad-transacciones">0</p>
                        </div>
                        <div class="transacciones">
                            <p>Transacciones diarias</p>
                        </div>
                    </div>
                    <div class="estado-cinco">
                        <p>Ultima Medición:</p>
                        
                    </div>
                </div>
            </div>
        <!-- End Estado de las balanzas -->
        <!-- Búsqueda -->
            <div class="busqueda">
                <div class="barra-busqueda">
                    <p>Búsqueda</p>
                </div>
                <div class="contenido-busqueda">   
                    <!-- Paises -->
                    <form class="demo-example">
                        <select id="paises" name="paises" multiple onchange="ddselect6();">
                            <option id="all_pais" value="0" onchange="allpais();">TODOS</option>
                            <?php 
                                    $paises=$user->buscar("paises","1");
                                
                                foreach($paises as $paises):
                            ?>
                            <option id="pais_opt" value="<?php echo $paises['id_pais'] ?>"><?php echo $paises['nombre_pais'] ?></option>
                            <?php 
                                endforeach;
                            ?>

                            
                                
                        </select>
                    </form>
                    <script type="text/javascript">
                        $(function() {
                            $('#paises').multiSelect({
                                'noneText': 'Paises',

                            });
                        });

                        function allpais(){
                            console.log("Todos los paises");
                            var paisall = document.getElementById('all_pais');
                            var allpais = $("#paises").val();

                            if(paisall.selected==true){
                                
                                $('#paises option').prop('selected', true);
                                document.getElementById('paises').dispatchEvent(new Event('change'));
                                //$('#paises option').attr("checked");
                                //consultarDatos(); 
                                }
                                else{
                                    $('#paises option').prop('selected', false);
                                    document.getElementById('paises').dispatchEvent(new Event('change'));
                                    //consultarDatos();  
                            }

                            
                            
                        }

                        function ddselect6() {
                            var paisall = document.getElementById('all_pais');
                            
                                var select = $("#paises").val();
                                
                                
                                var count = $("#paises :selected").length;
                                //document.getElementById("show2").innerHTML = count;
                                $(function() {
                                    $('#paises').multiSelect({
                                        'allText': 'Paises',

                                    });
                                });

                                var selectedpaises = [];
                                for (var option of document.getElementById('paises').options) {
                                    if (option.selected) {
                                        selectedpaises.push(option.value);
                                        //mostramos elementos seleccionados con el id= show
                                        //document.getElementById("show").innerHTML = selectedpaises;
                                        
                                        //Busqueda de ciudades de acuerdo a lo seleccionado en paises
                                        console.log("Paises seleccionados: ");
                                        console.log(selectedpaises);
                                        if(paisall.selected==false){
                                            //consultarDatos();
                                        }

                                    }
                                    if ($("#paises :selected").length == 0) {
                                        //document.getElementById("show").innerHTML = "-";
                                    }
                                    if(option.selected==false){
                                        //consultarDatos();
                                    }
                                }
                                
                                var opt_pais = document.getElementById('pais_opt');

                                if(opt_pais.selected){
                                    
                                    //$('#paises option').prop('selected', true);
                                    //document.getElementById('paises').dispatchEvent(new Event('change'));
                                    //$('#paises option').attr("checked");
                                    //consultarDatos();
                                    }
                                    else{
                                        //var paisall = document.getElementById('all_pais');
                                        //$(paisall).prop('selected', false);
                                        //paisall.dispatchEvent(new Event('change'));
                                        if(paisall.selected==false){
                                            //consultarDatos();
                                        }

                                } 
                            change_pais();
                            change_provincia();
                            change_ciudad();  
                            dispositivos();
                            dispositivos_mapa();
                            dispositivos_estado();
                        }
                    </script>
                    <!-- End Paises --> 
                   
                    <!-- provincias -->
                    <div id="provincias_recargar">
                        <form class="demo-example">
                            <select id="provincias" name="provincias" multiple onchange="ddselect();">
                                <option id="all_prov" value="0" onchange="allprov();">TODAS</option>
                                

                                
                                    
                            </select>
                        </form>
                    </div>
                    <script type="text/javascript">
                        $(function() {
                            $('#provincias').multiSelect({
                                'noneText': 'Provincias',

                            });
                        });
                       
                        function allprov(){
                            //alert("Todas las provincias");
                            var provinciaall = document.getElementById('all_prov');
                            var allprovincia = $("#provincias").val();

                            if(provinciaall.selected==true){
                                
                                $('#provincias option').prop('selected', true);
                                document.getElementById('provincias').dispatchEvent(new Event('change'));
                                //$('#provincias option').attr("checked");
                                //consultarDatos(); 
                                }
                                else{
                                    $('#provincias option').prop('selected', false);
                                    document.getElementById('provincias').dispatchEvent(new Event('change'));
                                    //consultarDatos();  
                            }

                            
                            
                        }

                        function ddselect() {
                            var provinciaall = document.getElementById('all_prov');
                            
                            var select = $("#provincias").val();
                            
                            //alert(select);
                            
                            var count = $("#provincias :selected").length;
                            //document.getElementById("show2").innerHTML = count;
                            $(function() {
                                $('#provincias').multiSelect({
                                    'allText': 'provincias',

                                });
                            });

                            var selected9 = [];
                            for (var option of document.getElementById('provincias').options) {
                                if (option.selected) {
                                    selected9.push(option.value);
                                    //mostramos elementos seleccionados con el id= show
                                    //document.getElementById("show").innerHTML = selected9;
                                    
                                    //Busqueda de ciudades de acuerdo a lo seleccionado en provincias
                                    console.log("provincias seleccionadas: ");
                                    console.log(selected9);
                                    if(provinciaall.selected==false){
                                        //consultarDatos();
                                    }

                                }
                                if ($("#provincias :selected").length == 0) {
                                    //document.getElementById("show").innerHTML = "-";
                                }
                                if(option.selected==false){
                                    //consultarDatos();
                                }
                            }
                            
                            var opt_provincia = document.getElementById('prov_opt');

                            if(opt_provincia.selected){
                                
                                //$('#provincias option').prop('selected', true);
                                //document.getElementById('provincias').dispatchEvent(new Event('change'));
                                //$('#provincias option').attr("checked");
                                //consultarDatos();
                                }
                                else{
                                    //var provinciaall = document.getElementById('all_provincia');
                                    //$(provinciaall).prop('selected', false);
                                    //provinciaall.dispatchEvent(new Event('change'));
                                    if(provinciaall.selected==false){
                                        //consultarDatos();
                                    }

                            }
                            
                            change_provincia();
                            change_ciudad(); 
                            dispositivos();
                            dispositivos_mapa();
                            dispositivos_estado();
                        }
                    </script>
                    <!-- End provincias --> 
                    
                    <!-- ciudades -->
                    <div id="ciudades_recargar">
                        <form class="demo-example">
                            <select id="ciudades" name="ciudades" multiple onchange="ddselect2();">
                            <option id='all_ciud' value='0' onchange='allciud();'>TODAS</option>

                                
                                    
                            </select>
                        </form>
                    </div>
                    <script type="text/javascript">
                        $(function() {
                            $('#ciudades').multiSelect({
                                'noneText': 'Ciudades',

                            });
                        });

                        function allciud(){
                            console.log("Todas las ciudades");
                            var ciudadall = document.getElementById('all_ciud');
                            var allciudad = $("#ciudades").val();

                            if(ciudadall.selected==true){
                                
                                $('#ciudades option').prop('selected', true);
                                document.getElementById('ciudades').dispatchEvent(new Event('change'));
                                //$('#ciudades option').attr("checked");
                                //consultarDatos(); 
                                }
                                else{
                                    $('#ciudades option').prop('selected', false);
                                    document.getElementById('ciudades').dispatchEvent(new Event('change'));
                                    //consultarDatos();  
                            }

                            
                            
                        }

                        function ddselect2() {
                                var ciudadall = document.getElementById('all_ciud');
                            
                                var select = $("#ciudades").val();
                                
                                
                                var count = $("#ciudades :selected").length;
                                //document.getElementById("show2").innerHTML = count;
                                $(function() {
                                    $('#ciudades').multiSelect({
                                        'allText': 'ciudades',

                                    });
                                });
                                //console.log("ciudad");
                                var selected2 = [];
                                for (var option of document.getElementById('ciudades').options) {
                                    if (option.selected) {
                                        selected2.push(option.value);
                                        //mostramos elementos seleccionados con el id= show
                                        //document.getElementById("show").innerHTML = selected2;
                                        
                                        //Busqueda de ciudades de acuerdo a lo seleccionado en ciudades
                                        console.log("ciudades seleccionadas: ");
                                        console.log(selected2);
                                        if(ciudadall.selected==false){
                                            //consultarDatos();
                                        }

                                    }
                                    if ($("#ciudades :selected").length == 0) {
                                        //document.getElementById("show").innerHTML = "-";
                                    }
                                    if(option.selected==false){
                                        //consultarDatos();
                                    }
                                }
                                
                                var opt_ciudad = document.getElementById('ciud_opt');

                                if(opt_ciudad.selected){
                                    
                                    //$('#ciudades option').prop('selected', true);
                                    //document.getElementById('ciudades').dispatchEvent(new Event('change'));
                                    //$('#ciudades option').attr("checked");
                                    //consultarDatos();
                                    }
                                    else{
                                        //var ciudadall = document.getElementById('all_ciudad');
                                        //$(ciudadall).prop('selected', false);
                                        //ciudadall.dispatchEvent(new Event('change'));
                                        if(ciudadall.selected==false){
                                            //consultarDatos();
                                        }

                                } 

                                change_ciudad();
                                dispositivos();
                                dispositivos_mapa();
                                dispositivos_estado();
                            
                        }
                    </script>
                    <!-- End ciudades --> 
                    
                    <!-- instituciones -->
                    <div id="instituciones_recargar">
                        <form class="demo-example">
                            <select id="instituciones" name="instituciones" multiple onchange="ddselect3();">
                            <option id='all_institucion' value='0' onchange='allinstitucion();'>TODAS</option>

                                
                                    
                            </select>
                        </form>
                    </div>
                    <script type="text/javascript">
                        $(function() {
                            $('#instituciones').multiSelect({
                                'noneText': 'Instituciones',

                            });
                        });

                        function allinstitucion(){
                            console.log("Todas las instituciones");
                            var institucionall = document.getElementById('all_institucion');
                            var allinstitucion = $("#instituciones").val();

                            if(institucionall.selected==true){
                                
                                $('#instituciones option').prop('selected', true);
                                document.getElementById('instituciones').dispatchEvent(new Event('change'));
                                //$('#instituciones option').attr("checked");
                                //consultarDatos(); 
                                }
                                else{
                                    $('#instituciones option').prop('selected', false);
                                    document.getElementById('instituciones').dispatchEvent(new Event('change'));
                                    //consultarDatos();  
                            }

                            
                            
                        }

                        function ddselect3() {
                            var institucionall = document.getElementById('all_institucion');
                            
                                var select = $("#instituciones").val();
                                
                                
                                var count = $("#instituciones :selected").length;
                                //document.getElementById("show2").innerHTML = count;
                                $(function() {
                                    $('#instituciones').multiSelect({
                                        'allText': 'instituciones',

                                    });
                                });

                                var selected2 = [];
                                for (var option of document.getElementById('instituciones').options) {
                                    if (option.selected) {
                                        selected2.push(option.value);
                                        //mostramos elementos seleccionados con el id= show
                                        //document.getElementById("show").innerHTML = selected2;
                                        
                                        //Busqueda de instituciones de acuerdo a lo seleccionado en instituciones
                                        console.log("instituciones seleccionadas: ");
                                        console.log(selected2);
                                        if(institucionall.selected==false){
                                            //consultarDatos();
                                        }

                                    }
                                    if ($("#instituciones :selected").length == 0) {
                                        //document.getElementById("show").innerHTML = "-";
                                    }
                                    if(option.selected==false){
                                        //consultarDatos();
                                    }
                                }
                                
                                var opt_institucion = document.getElementById('institucion_opt');

                                if(opt_institucion.selected){
                                    
                                    //$('#instituciones option').prop('selected', true);
                                    //document.getElementById('instituciones').dispatchEvent(new Event('change'));
                                    //$('#instituciones option').attr("checked");
                                    //consultarDatos();
                                    dispositivos();
                                    dispositivos_mapa();
                                    dispositivos_estado();
                                    }
                                    else{
                                        //var institucionall = document.getElementById('all_institucion');
                                        //$(institucionall).prop('selected', false);
                                        //institucionall.dispatchEvent(new Event('change'));
                                        if(institucionall.selected==false){
                                            //consultarDatos();
                                            dispositivos();
                                            dispositivos_mapa();
                                            dispositivos_estado();
                                        }

                                } 
                            
                        }
                    </script>
                    <!-- End instituciones --> 
                    <!-- Contratos -->
                     <div id="contratos_recargar">
                        <form class="demo-example">
                            <select id="contratos" name="contratos" multiple onchange="ddselect4();">
                            <option id='all_contrato' value='0' onchange='allcontrato();'>TODOS</option>

                                
                                    
                            </select>
                        </form>
                    </div>
                    <script type="text/javascript">
                        
                        $(function() {
                            $('#contratos').multiSelect({
                                'noneText': 'Contratos',

                            });
                        });

                        function allcontrato(){
                            console.log("Todos los contratos");
                            var contratoall = document.getElementById('all_contrato');
                            var allcontrato = $("#contratos").val();

                            if(contratoall.selected==true){
                                
                                $('#contratos option').prop('selected', true);
                                document.getElementById('contratos').dispatchEvent(new Event('change'));
                                //$('#contratos option').attr("checked");
                                //consultarDatos(); 
                                }
                                else{
                                    $('#contratos option').prop('selected', false);
                                    document.getElementById('contratos').dispatchEvent(new Event('change'));
                                    //consultarDatos();  
                            }

                            
                            
                        }

                        function ddselect4() {
                            var contratoall = document.getElementById('all_contrato');
                            
                                var select = $("#contratos").val();
                                
                                
                                var count = $("#contratos :selected").length;
                                //document.getElementById("show2").innerHTML = count;
                                $(function() {
                                    $('#contratos').multiSelect({
                                        'allText': 'contratos',

                                    });
                                });

                                var selected2 = [];
                                for (var option of document.getElementById('contratos').options) {
                                    if (option.selected) {
                                        selected2.push(option.value);
                                        //mostramos elementos seleccionados con el id= show
                                        //document.getElementById("show").innerHTML = selected2;
                                        
                                        //Busqueda de contratos de acuerdo a lo seleccionado en contratos
                                        console.log("contratos seleccionadas: ");
                                        console.log(selected2);
                                        if(contratoall.selected==false){
                                            //consultarDatos();
                                        }

                                    }
                                    if ($("#contratos :selected").length == 0) {
                                        //document.getElementById("show").innerHTML = "-";
                                    }
                                    if(option.selected==false){
                                        //consultarDatos();
                                    }
                                }
                                
                                var opt_contrato = document.getElementById('contrato_opt');

                                if(opt_contrato.selected){
                                    
                                    //$('#contratos option').prop('selected', true);
                                    //document.getElementById('contratos').dispatchEvent(new Event('change'));
                                    //$('#contratos option').attr("checked");
                                    //consultarDatos();
                                    dispositivos();
                                    dispositivos_mapa();
                                    dispositivos_estado();
                                    }
                                    else{
                                        //var contratoall = document.getElementById('all_contrato');
                                        //$(contratoall).prop('selected', false);
                                        //contratoall.dispatchEvent(new Event('change'));
                                        if(contratoall.selected==false){
                                            //consultarDatos();
                                            dispositivos();
                                            dispositivos_mapa();
                                            dispositivos_estado();
                                        }

                                } 
                            
                        }
                        change_contrato();
                    </script>
                    <!-- End Contratos -->
                </div>
            </div>
        <!-- End Búsqueda -->
        <!-- Mapa -->
            
            <div class="mapa">
                <div class="barra-mapa">
                    <p>Mapa</p>
                </div>
                <div class="mapa-contenido">
                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC2cXKKml-JM9lSdSwnymOu2JuZHmjIclc&callback=initMap" async defer></script>
                
                        <script>
                            // Multiple markers location, latitude, and longitude
                            var markers = [
                                ["Vivex", -31.4287235, -64.1888398]
                                
                            ];
                                                
                            // Info window content
                            var infoWindowContent = [
                                ["<div class=info_content>" +
                                "<h3>Vivex</h3>"]];
                            
                            var icon_select="3";
                            initMap(markers,infoWindowContent,icon_select);
                            // Load initialize function
                            google.maps.event.addDomListener(window, "load", initMap);
                        </script>
                    <div id="map"><!--punto de recarga mapas html Ajax-->
                        
                       
                    </div>
                    </div>
            </div>
        <!-- End Mapa -->
        <!-- Dispositivos -->
            <div class="dispositivos">
                <div class="barra-dispositivos">
                    <p>Dispositivos</p>
                </div>
                <div class="barra-dispositivos-datos">
                    <label class="container">
                        <input id="all_disp"type="checkbox" onclick="check_all();">
                        <span class="checkmark"></span>
                    </label>
                    <p>ID Balanza</p>
                    <p>ID Institucuón</p>
                    <p>ID Contrato</p>
                    <p>Estado</p>
                    <p>Trans. Totales</p>
                    <p>Ultim. Transacción</p>
                    <a href="#"><img class="icon_datos" src="../img/bloquear.png" alt="" onclick="block_select();"></a>
                    <a href="#"><img class="icon_datos" src="../img/basura.png" alt="" onclick="delete_select();"></a>
                    <p> </p>
                    <p> </p>
                </div>
                <div id="contenido-dispositivos" class="contenido-dispositivos">
                    
                    
                </div>

            </div>
            <script type="text/javascript">
                function check_all(){

                    //alert('All_check');
                    var all= document.getElementById('all_disp');
                    var checkboxes = document.getElementsByName('check_opt');
                    if(all.checked){
                        for (var checkbox of checkboxes) {

                            checkbox.checked = true;
                        }
                        //alert(i);
                    }else{
                        i=0;
                        for (var checkbox of checkboxes) {

                            checkbox.checked = false;
                        }
                        //alert(i);
                    }
                }

                function block_select(clicked_id)
                {
                    var mensaje;
                    var opcion = confirm('¿Está seguro de modificar el estado del dispositivo?');
                    if (opcion == true) {
                        mensaje = 'Has clickado OK';
                        //document.getElementById(clicked_id).src = '../img/bloqueado.png';
                        //bloquear_disp(clicked_id);
                        var checkboxes = document.getElementsByName('check_opt');
                        for (var checkbox of checkboxes) {
                            if(checkbox.checked){
                                var id=(checkbox.id).replace('check_', '');
                                
                                bloquear_disp(id);
                            }
                        }
                    } else {
                        mensaje = 'Has clickado Cancelar';
                    }
                
                }

                function delete_select(clicked_id)
                {
                    var mensaje;
                    var opcion = confirm('¿Está seguro de modificar el estado del dispositivo?');
                    if (opcion == true) {
                        mensaje = 'Has clickado OK';
                        //document.getElementById(clicked_id).src = '../img/bloqueado.png';
                        //bloquear_disp(clicked_id);
                        var checkboxes = document.getElementsByName('check_opt');
                        for (var checkbox of checkboxes) {
                            if(checkbox.checked){
                                var id=(checkbox.id).replace('check_', '');
                                
                                borrar_disp(id);
                            }
                        }
                    } else {
                        mensaje = 'Has clickado Cancelar';
                    }
                
                }

                function borrar(clicked_id)
                {
                    var mensaje;
                    var opcion = confirm('¿Está seguro de modificar el estado del dispositivo?');
                    if (opcion == true) {
                        mensaje = 'Has clickado OK';
                        borrar_disp(clicked_id);
                        
                    } else {
                        mensaje = 'Has clickado Cancelar';
                    }
                
                }
            </script>
        <!-- End Dispositivos -->
    </main>
    <!-- End MAin -->
                           
    <!-- Footer -->
    <footer class="footer">
        <p>Copyright © Sistema Vivex 2020 - Todos los derechos reservados</p>
    </footer>
    <!-- End Footer-->


</body>
</html>