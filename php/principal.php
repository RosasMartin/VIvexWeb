<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vivex</title> 
    <!-- jQuery AJAX -->
    <script src="jquery.js"></script>
    
    <!-- Silider JQuery library and script-->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    
    
    <!-- Slider touch library -->
    <script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script src="http://code.jquery.com/ui/1.8.21/jquery-ui.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
    <script src="jquery.ui.touch-punch.min.js"></script>
    
    <!-- Seteo de caracterisicas de slider -->
    <script>
        
    $( function() {
        $( "#slider-range" ).slider({
        range: true,
        min: 0,
        max: 120,
        values: [ 6, 99 ],
        slide: function( event, ui ) {
            $( "#amount" ).val( "Min:" + ui.values[ 0 ] + " - Max:" + ui.values[ 1 ] );
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
    
   

    <!-- Mlutiple Select library -->
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="../css/example-styles.css">
    <script type="text/javascript" src="../js/jquery.multi-select.js"></script>
    
	
    <!-- CSS Styles -->
    <link href="https://necolas.github.io/normalize.css/8.0.1/normalize.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/principal.css">
    
       
    
    
</head>
<!-- PHP -->
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
    
?>
<!-- PHP END -->
<body>
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
            <nav class="nav">
                <a href="#">Configuraciones</a>
                <a href="#">Búsqueda</a>
                <a href="#">Mapas</a>
                <a href="#">Comparativas</a>
                <a href="../index.html" <?php session_destroy(); ?>;>Salir</a>
            </nav>
        </div>
    </header>
    
    <main>

        <!-- Controles -->
        <div class="controles">
            <p>Filtros de Búsqueda</p>
  
            <div class="genero">
                <p class="title">Genero</p>
                <div class="sexos">
                    <p class="sexo-title">M</p>
                    <label class="container">
                        <input type="checkbox" id="G-M" name="G-M" onchange="checkOption()">
                        <span class="checkmark"></span>
                    </label>
                    <p class="sexo-title">F</p>
                    <label class="container">
                        <input type="checkbox" id="G-F" name="G-F" onchange="checkOption()">
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <hr>
            <div class="riesgos">
                <div class="item">
                    <p>Obesidad tipo 1</p>
                    <label class="container">
                        <input type="checkbox" id="R-O-1" name="R-O-1" onchange="checkOption()">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="item">
                    <p>Obesidad tipo 2</p>
                    <label class="container">
                        <input type="checkbox" id="R-O-2" name="R-O-2" onchange="checkOption()">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="item">
                    <p>Obesidad tipo 3</p>
                    <label class="container">
                        <input type="checkbox" id="R-O-3" name="R-O-3" onchange="checkOption()">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="item">
                    <p>Sobrepeso</p>
                    <label class="container">
                        <input type="checkbox" id="R-S" name="R-S" onchange="checkOption()">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="item">
                    <p>Delgadez Aceptable</p>
                    <label class="container">
                        <input type="checkbox" id="R-D-A" name="R-D-A" onchange="checkOption()">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="item">
                    <p>Delgadez Moderada</p>
                    <label class="container">
                        <input type="checkbox" id="R-D-M" name="R-D-M" onchange="checkOption()">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="item">
                    <p>Delgadez Severa</p>
                    <label class="container">
                        <input type="checkbox" id="R-D-S" name="R-D-S" onchange="checkOption()">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="item">
                    <p>Normal</p>
                    <label class="container">
                        <input type="checkbox" id="N" name="N" onchange="checkOption()">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="item">
                    <p>Todos</p>
                    <label class="container">
                        <input type="checkbox" id="R-ALL" name="R-ALL" onchange="checkAll()">
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <!-- Scrpit lectura de checkbox riesgos y genero-->
            <script>
                // Elementos check
                var gmBox = document.getElementById('G-M');
                var gfBox = document.getElementById('G-F');
                var ro1Box = document.getElementById('R-O-1');
                var ro2Box = document.getElementById('R-O-2');
                var ro3Box = document.getElementById('R-O-3');
                var rsBox = document.getElementById('R-S');
                var rdaBox = document.getElementById('R-D-A');
                var rdmBox = document.getElementById('R-D-M');
                var rdsBox = document.getElementById('R-D-S');
                var rnBox = document.getElementById('N');
                var allBox = document.getElementById('R-ALL');
                var allUncheck = "";
                var edades="";
                var edadMin="";
                var edadMax="";
                var parametrosProvincias="";
                var parametrosCiudades="";
                var parametrosInstituciones="";
                function checkAll(){
                    // All chekbox check
                        
                    if (allBox.checked)
                        {
                            // Rango de Edades
                            edades = $("#amount").val();
                            //console.log(edades);
                            // Genero Masculino chekbox check
                            if (gmBox.checked)
                            {
                              //  console.log("G-M");
                            }
                            // Genero Femenino chekbox check
                            if (gfBox.checked)
                            {
                                //console.log("G-F");
                            }
                            //console.log("ALL");
                            allUncheck=1;
                            ro1Box.checked=1;
                            //console.log("R-O-1");
                            ro2Box.checked=1;
                            //console.log("R-O-2");
                            ro3Box.checked=1;
                            //console.log("R-O-3");
                            rsBox.checked=1;
                            //console.log("R-S");
                            rdaBox.checked=1;
                            //console.log("R-D-A");
                            rdmBox.checked=1;
                            //console.log("R-D-M");
                            rdsBox.checked=1;
                            //console.log("R-D-S");
                            rnBox.checked=1;
                            //console.log("N");
                        }else{
                            if(allUncheck==1){
                                ro1Box.checked=0;
                                ro2Box.checked=0;
                                ro3Box.checked=0;
                                rsBox.checked=0;
                                rdaBox.checked=0;
                                rdmBox.checked=0;
                                rdsBox.checked=0;
                                rnBox.checked=0;
                                allUncheck=0;
                            }
                        }
                        consultarDatos();
                }

                function checkOption(){
                        // Rango de Edades
                        edades = $("#amount").val();
                        //console.log(edades);
                        
                        // Genero Masculino chekbox check
                        if (gmBox.checked)
                        {
                          //  console.log("G-M");
                        }
                        // Genero Femenino chekbox check
                        if (gfBox.checked)
                        {
                            //console.log("G-F");
                        }
                        // Riesgo Obesidad Tipo 1 check
                        if (ro1Box.checked)
                        {
                            //console.log("R-O-1");
                        }
                        // Riesgo Obesidad Tipo 2 check
                        if (ro2Box.checked)
                        {
                            //console.log("R-O-2");
                        }
                        // Riesgo Obesidad Tipo 3 check
                        if (ro3Box.checked)
                        {
                            //console.log("R-O-3");
                        }
                        // Riesgo Sobrepeso check
                        if (rsBox.checked)
                        {
                            //console.log("R-S");
                        }
                        // Riesgo Delgadez Aceptable chekbox check
                        if (rdaBox.checked)
                        {
                            //console.log("R-D-A");
                        }
                        // Riesgo Delgadez Moderada chekbox check
                        if (rdmBox.checked)
                        {
                            //console.log("R-D-M");
                        }
                        // Riesgo Delgadez Severa chekbox check
                        if (rdsBox.checked)
                        {
                            //console.log("R-D-S");
                        }
                        // Normal chekbox check
                        if (rnBox.checked)
                        {
                            //console.log("N");
                        }
                        consultarDatos();
                }
            </script>
            <hr>
                <div class="edades-rango">
                    <p>
                    <label for="amount">Rango de edades</label>
                    <input type="text" id="amount" readonly > 
                    </p>
        
                    <div class="slider" id="slider-range" style="color:#f6931f;"></div>          
                    
                </div>
            <hr>
            <div id="sitios" class="sitios">
                <!-- Provincias -->
                <form class="demo-example">
                    <select id="provincias" name="provincias" multiple onchange="ddselect();">
                        <?php 
                            if($status=="90"||$status=="80"){
                                $provincias=$user->buscar("provincias","1");
                            }else{
                                $provincias=$user->buscar("provincias","id_provincia=".$provincia);
                            }
                            foreach($provincias as $provincias):
                        ?>
                        <option value="<?php echo $provincias['id_provincia'] ?>"><?php echo $provincias['provincia'] ?></option>
                        <?php 
                            endforeach;
                        ?>

                        
                            
                    </select>
                </form>
                
                
                <script type="text/javascript">
                    $(function() {
                        $('#provincias').multiSelect({
                            'noneText': 'Provincias',

                        });
                    });

                    function ddselect() {
                        
                        var count = $("#provincias :selected").length;
                        //document.getElementById("show2").innerHTML = count;
                        $(function() {
                            $('#provincias').multiSelect({
                                'allText': 'Provincias',

                            });
                        });

                        var selected2 = [];
                        for (var option of document.getElementById('provincias').options) {
                            if (option.selected) {
                                selected2.push(option.value);
                                //mostramos elementos seleccionados con el id= show
                                //document.getElementById("show").innerHTML = selected2;
                                
                                //Busqueda de ciudades de acuerdo a lo seleccionado en provincias
                                
                                //console.log(selected2);
                                consultarDatos();

                            }
                            if ($("#provincias :selected").length == 0) {
                                //document.getElementById("show").innerHTML = "-";
                            }
                        }
                        
                       
                    }
                </script>
                 <!-- Enc Provincias -->
                 
                 <!-- Ciudades -->
                <div id="ciudades_recargar">
                    <form class="demo-example" >
                        <select id="ciudades" name="ciudades" multiple onchange="ddselect2();">
                        
                            
                                
                        </select>
                    </form>
                    
                                    
                    <script type="text/javascript">
                        $(function() {
                            $('#ciudades').multiSelect({
                                'noneText': 'Ciudades',

                            });
                        });
                    </script>
                </div>

                <script type="text/javascript">
                    function ddselect2() {
                        var count = $("#ciudades :selected").length;
                        //document.getElementById("show2").innerHTML = count;
                        $(function() {
                            $('#ciudades').multiSelect({
                                'allText': 'Ciudades',

                            });
                        });

                        var selected3 = [];
                        for (var option of document.getElementById('ciudades').options) {
                            if (option.selected) {
                                selected3.push(option.value);
                                //mostramos elementos seleccionados con el id= show
                                
                                //document.getElementById("show").innerHTML = selected3;
                                consultarDatos();
                            }
                            if ($("#ciudades :selected").length == 0) {
                                //document.getElementById("show").innerHTML = "-";
                            }
                        }
                        //console.log("ciudades");
                        var parametrosCiudades= ""+$("#ciudades").val();
                        
                        $.ajax({
                            data: {'id':parametrosCiudades},
                            url:   './ajax/ajax_instituciones.php',
                            type:  'POST',
                            beforeSend: function () {
                                //console.log("Enviando");
                                
                            },
                            success:  function (response) {       
                                $("#intituciones_recargar").html(response);
                                //console.log("cambio");
                                //console.log(parametrosCiudades);
                                //console.log(response);
                                
                            },
                            error:function(){
                                alert("error")
                            }
                        });             
                    }
                </script>
                <!-- End Ciudades -->

                <!-- Instituciones -->
                <div id="intituciones_recargar">
                    <form class="demo-example">
                        <select id="instituciones" name="instituciones" multiple onchange="ddselect3();">
                            
                                
                        </select>
                    </form>
                
                
                <script type="text/javascript">
                    $(function() {
                        $('#instituciones').multiSelect({
                            'noneText': 'Instituciones',

                        });
                    });
                </script>    
                </div>
                <script>
                    function ddselect3() {
                        var count = $("#instituciones :selected").length;
                        //document.getElementById("show2").innerHTML = count;
                        $(function() {
                            $('#people2').multiSelect({
                                'allText': 'Instituciones',

                            });
                        });

                        var selected4 = [];
                        for (var option of document.getElementById('instituciones').options) {
                            if (option.selected) {
                                selected4.push(option.value);
                                //mostramos elementos seleccionados con el id= show
                                consultarDatos();
                                //document.getElementById("show").innerHTML = selected4;
                            }
                            if ($("#instituciones :selected").length == 0) {
                                //document.getElementById("show").innerHTML = "-";
                            }
                        }
                        //parametros instituciones
                        //console.log("Instituciones");
                        var parametrosInstituciones= ""+$("#instituciones").val();
                        //console.log(parametrosInstituciones);
                    }
                </script>
                <!-- End Instituciones -->
                <script type="text/javascript">
                    $(document).ready(function(e){
                        $("#provincias").change(function(){
                            //console.log("provincias");
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
                   
                        })

                    })
                </script>
            </div>
           
            <hr>

            <!-- Obtencion de Estadisticas -->
            <!--
            <div class="consultar">
                <button class="btnSubmit" type="submit" onclick="consultarDatos();">Consultar</button>
            </div>
             -->
            <script>
                function consultarDatos() {

                    var gmBox = document.getElementById('G-M');
                    var gfBox = document.getElementById('G-F');
                    var ro1Box = document.getElementById('R-O-1');
                    var ro2Box = document.getElementById('R-O-2');
                    var ro3Box = document.getElementById('R-O-3');
                    var rsBox = document.getElementById('R-S');
                    var rdaBox = document.getElementById('R-D-A');
                    var rdmBox = document.getElementById('R-D-M');
                    var rdsBox = document.getElementById('R-D-S');
                    var rnBox = document.getElementById('N');
                    var gM="";
                    var gF="";
                    var ro1 ="";
                    var ro2 ="";
                    var ro3 ="";
                    var rs = "";                     
                    var rda = "";
                    var rdm = "";
                    var rds = "";
                    var rn = "";
                    var masculino = "";
                    var femenino = "";
                    
                    if (gmBox.checked)
                        {
                            gM="M";
                        }
                    if (gfBox.checked)
                        {
                            gF="F";
                        }
                    if (ro1Box.checked)
                        {
                            ro1="ro1";
                        }
                    if (ro2Box.checked)
                        {
                            ro2="ro2";
                        }
                    if (ro3Box.checked)
                        {
                            ro3="ro3";
                        }
                    if (rsBox.checked)
                        {
                            rs="rs";
                        }
                    if (rdaBox.checked)
                        {
                            rda="rda";
                        }
                    if (rdmBox.checked)
                        {
                            rdm="rdm";
                        }
                    if (rdsBox.checked)
                        {
                            rds="rds";
                        }
                    if (rnBox.checked)
                        {
                            rn="rn";
                        }


                    var parametrosProvincias= ""+$("#provincias").val();
                    var parametrosCiudades= ""+$("#ciudades").val();
                    var parametrosInstituciones= ""+$("#instituciones").val();
                    var edades = $("#amount").val();

                    console.log("Consulta:");

                    console.log("Genero:");
                    console.log(gM);
                    console.log(gF);

                    masculino=gM;
                    femenino=gF;

                    console.log("Riesgos:");
                    console.log(ro1);
                    console.log(ro2);
                    console.log(ro3);
                    console.log(rs);
                    console.log(rda);
                    console.log(rdm);
                    console.log(rds);
                    console.log(rn);

                    console.log("provincias:");
                    console.log(parametrosProvincias);

                    console.log("Ciudades:");
                    console.log(parametrosCiudades);
                    
                    console.log("Instituciones:");
                    console.log(parametrosInstituciones);
                    
                    console.log("Edades:");
                    edades = edades.replace("Min:", "");
                    edades = edades.replace("Max:", "");
                    edades = edades.replace(" ", "");
                    edades = edades.replace(" ", "");
                    edades = edades.replace(" ", "");
                    edades = edades.replace(" ", "");
                    var arredad=edades.split("-");
                    var edadMin=arredad[0];
                    var edadMax=arredad[1];
                    var dni_alumnos="";
                    var dni=""; 
                    var alum_exit=0;
                    var gen_exit=0;
                    var ind_exit=0;
                    
                    console.log(edades);
                    
                    //estadisticas y cantidad de alumnos
                    $(document).ready(function(e){
                        
                            //Busqueda de Alumnos    
                            $.ajax({
                                data: {'instituciones': parametrosInstituciones, 'ciudades': parametrosCiudades, 'provincias': parametrosProvincias, 'edadmin':edadMin, 'edadmax':edadMax, 'masculino':masculino, 'femenino':femenino, 'ro1': ro1, 'ro2': ro2, 'ro3': ro3, 'rs': rs, 'rda': rda, 'rdm': rdm, 'rds': rds, 'rn': rn },
                                url:   './ajax/ajax_Alumnos.php',
                                type:  'POST',
                                beforeSend: function () {
                                    console.log("Enviando");
                                    
                                },
                                success:  function (response) { 
                                    console.log("Resultado:");                                   
                                    console.log(response);
                                    $("#chart-container").html(response);

                                    imc_data=response;
                                    
                                },
                                error:function(){
                                    alert("error");
                                    alum_exit=1;
                                }
                            });
                        
                    }); 

                    //tendencias
                    $(document).ready(function(e){
                        
                        var tUnix = Date.now();
                        var date = new Date(tUnix);
                        var fechaActual = Date(tUnix);
                        var mesActual = date.getMonth();
                        var anoActual = date.getFullYear();
                        var diaActual = date.getDay();
                        //console.log(tUnix);
                        //console.log(fechaActual);
                        //console.log(mesActual);
                        //console.log(anoActual);
                        //console.log(diaActual);


                        //tendencias    
                        $.ajax({
                            data: {'instituciones': parametrosInstituciones, 'ciudades': parametrosCiudades, 'provincias': parametrosProvincias, 'edadmin':edadMin, 'edadmax':edadMax, 'masculino':masculino, 'femenino':femenino, 'ro1': ro1, 'ro2': ro2, 'ro3': ro3, 'rs': rs, 'rda': rda, 'rdm': rdm, 'rds': rds, 'rn': rn },
                            url:   './ajax/ajax_mediciones.php',
                            type:  'POST',
                            beforeSend: function () {
                                console.log("Enviando");
                                
                            },
                            success:  function (response) { 
                                console.log("Resultado mediciones:");                                   
                                console.log(response);
                                $("#tendencias").html(response);

                                
                            },
                            error:function(){
                                alert("error");
                                
                            }
                        });
                    
                    }); 

                    //cantidad mediciones
                    $(document).ready(function(e){
                        
                        var tUnix = Date.now();
                        var date = new Date(tUnix);
                        var fechaActual = Date(tUnix);
                        var mesActual = date.getMonth();
                        var anoActual = date.getFullYear();
                        var diaActual = date.getDay();
                        //console.log(tUnix);
                        //console.log(fechaActual);
                        //console.log(mesActual);
                        //console.log(anoActual);
                        //console.log(diaActual);


                        //cantidad de mediciones 
                        $.ajax({
                            data: {'instituciones': parametrosInstituciones, 'ciudades': parametrosCiudades, 'provincias': parametrosProvincias, 'edadmin':edadMin, 'edadmax':edadMax, 'masculino':masculino, 'femenino':femenino, 'ro1': ro1, 'ro2': ro2, 'ro3': ro3, 'rs': rs, 'rda': rda, 'rdm': rdm, 'rds': rds, 'rn': rn },
                            url:   './ajax/ajax_mediciones_totales.php',
                            type:  'POST',
                            beforeSend: function () {
                                console.log("Enviando");
                                
                            },
                            success:  function (response) { 
                                console.log("Resultado mediciones totales:");                                   
                                console.log(response);
                                $("#chart-container2").html(response);

                                
                            },
                            error:function(){
                                alert("error");
                                
                            }
                        });
                    
                    }); 

                    
                   
                }
            </script>

           
            <!-- Obtencion de Archivos -->
                <div class="archivos">
                    <p>Descargas</p>
                    <div class="enlaces">
                        <a href="#">
                            <img src="../img/pdf.png" alt="pdf icono">
                        </a>
                        <a href="#">
                            <img src="../img/sobresalir.svg" alt="excel icono">
                        </a>
                    </div>
                </div>

        </div>
        <!-- End controles-->

        <!-- Estadisticas Generales -->
        <div class="porcentaje-grafico">
            <div class="barra-porcentaje">
                <p>Gráfico de Porcentajes</p>
            </div>
            <div class="grafico">
                <div id="chart-container" class="chart-container">
                    <canvas id="myChart" height="370vh"></canvas>
                    <script>
                        var ctx= document.getElementById("myChart").getContext("2d");
                        var myChart = new Chart(ctx, {
                            type:"doughnut",
                            data:{
                                labels:['Obesidad Tipo 1','Obesidad Tipo 2','Obesidad Tipo 3','Sobrepeso','Delgadez Aceptable','Delgadez Moderada','Delgadez Severa','Normal','Resto'],
                                datasets:[{
                                    label:'Porcentaje',
                                    data:[0,0,0,0,0,0,0,0,0],
                                    backgroundColor:['#d500f9','#f50057','#ff1744','#651fff','#c6ff00','#ffc400','#ff3d00','#00e676','#B7B7B7'],
                                    borderWidth:0
                                }]
                            },
                            options:{
                                responsive: true,
                                maintainAspectRatio: false,
                                yAxisID:false,
                                scales:{
                                    yAxes:[{
                                        ticks:{
                                            beginAtZero:true
                                        }
                                    }]
                                },
                                legend: {
                                        align: 'center',
                                        position:'right',
                                        labels: {
                                            // This more specific font property overrides the global property
                                            fontColor: 'white',
                                            fontSize: 12,
                                            boxWidth: 10
                                        }
                                }
                            }
                        });
                    </script>
                    
                </div>   
            </div>
        </div>
        <!-- End Estadisticas Generales -->

        <!-- Historial Mediciones -->
        <div class="mapa">
            <div class="barra-mapa">
                <p>Historial Mediciones</p>
            </div>
            <div class="contenedor-mapa">
                <div class="grafico">
                    <div id="chart-container2" class="chart-container">
                    
                        <canvas id="myChart2" height="370vh"></canvas>
                        <script>
                            var ctx= document.getElementById("myChart2").getContext("2d");
                            var gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
                            gradientStroke.addColorStop(0, "#80b6f4");
                            gradientStroke.addColorStop(1, "#f49080");
                            var myChart = new Chart(ctx, {
                                type:"bar",
                                data:{
                                    labels:['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
                                    
                                    datasets:[{
                                        label:'Mediciones',
                                        borderColor:               gradientStroke,
                                        pointBorderColor:          gradientStroke,
                                        pointBackgroundColor:      gradientStroke,
                                        pointHoverBackgroundColor: gradientStroke,
                                        pointHoverBorderColor:     gradientStroke,
                                        fill: false,
                                        data:[0,0,0,0,0,0,0,0,0,0,0,0],
                                        //backgroundColor:['#2E4B63','#2E4B63','#2E4B63','#2E4B63','#2E4B63','#2E4B63','#2E4B63','#2E4B63','#2E4B63','#2E4B63','#2E4B63','#2E4B63',],
                                        backgroundColor: gradientStroke,
                                        borderWidth:3,
                                    }]
                                },
                                options:{
                                    responsive: true,
                                    maintainAspectRatio: false,
                                    yAxisID:false,
                                    scales:{
                                        yAxes:[{
                                            ticks:{
                                                beginAtZero:true
                                            }
                                        }]
                                    },
                                    legend: {
                                            align: 'center',
                                            position:'top',
                                            labels: {
                                                // This more specific font property overrides the global property
                                                fontColor: 'white',
                                               
                                                fontSize: 0,
                                                boxWidth: 0
                                            }
                                    }
                                }
                            });
                        </script>
                        
                    </div>   
                </div>
            </div>
            
        </div>
        <!-- Historial Mediciones -->

        <!-- Tendencias -->
        <div class="tendencias">
            <div class="barra-tendencias">
                <p>Tendencias</p>
            </div>
            <div class="tendencia-div">
            
                <h2 id="tendencia_texto">Sin Tendencia</h2>
                <div class="contenedor-tendencias">
                    <div class="principal">
                        <img id="indicador-principal" class="indicador-principal" src="../img/error.png" alt="indicador principal">
                    </div>

                    <div class="secundario">
                        <div class="anterior">
                            <p style="color: #FFFFFF;">6 Meses Atrás</p>
                            <div class="contenido">
                                <img src="../img/good.png" alt="indicador good">
                                <p id="anterior-good" style="color: #06B506;">0 %</p>
                                <img class="bad" src="../img/bad.png" alt="indicador bad">
                                <p id="anterior-bad">0 %</p>
                            </div>
                        </div>
                        <div class="actual">
                            <p style="color: #FFFFFF;">Actual</p>
                            <div class="contenido">
                                <img src="../img/good.png" alt="indicador good">
                                <p id="actual-good" style="color: #06B506;">0 %</p>
                                <img class="bad" src="../img/bad.png" alt="indicador bad">
                                <p id="actual-bad">0 %</p>
                            </div>
                        </div>
                        <div id="tendencias" >

                        </div>
                  
                    </div>
                </div>
            </div>
            
        </div>
        <!-- End Tendencias -->

        <!-- Resultados de la Búsqueda -->
        <div class="busqueda-resultado">
            <div class="barra-busqueda-resultado">
                <p>Resultados de la Búsqueda</p>
            </div>
            <div class="contenedor-busqueda-resultado">
                <div class="item-resultado">
                    <p>Obesidad Tipo 1:</p>
                    <p id="ro1">0</p>
                </div>
                <div class="item-resultado">
                    <p>Obesidad Tipo 2:</p>
                    <p id="ro2">0</p>
                </div>
                <div class="item-resultado">
                    <p>Obesidad Tipo 3:</p>
                    <p id="ro3">0</p>
                </div>
                <div class="item-resultado">
                    <p>Sobrepeso:</p>
                    <p id="rs">0</p>
                </div>
                <div class="item-resultado">
                    <p>Delgadez aceptable:</p>
                    <p id="rda">0</p>
                </div>
                <div class="item-resultado">
                    <p>Delgadez Moderada:</p>
                    <p id="rdm">0</p>
                </div>
                <div class="item-resultado">
                    <p>Delgadez Severa:</p>
                    <p id="rds">0</p>
                </div>
                <div class="item-resultado">
                    <p>Normal:</p>
                    <p id="rn">0</p>
                </div>
                <div class="item-resultado">
                    <p>Sin Medición:</p>
                    <p id="nn">0</p>
                </div>

            </div>
            <div class="indicadores-busqueda-resultado">
                <div class="indicadores-sexo">
                    <img src="../img/indicador_femenino.png" alt="indicador femenino img">
                    <p id="gf">0</p>
                    <img src="../img/indicador_masculino.png" alt="indicador femenino img">
                    <p id="gm">0</p>
                </div>
                <div class="total-alumnos">
                    <p>Total de Alumnos:</p>
                    <p id="totalalumnos">0</p>
                </div>
            </div>
        </div>
        <!-- End Resultados de la Búsqueda -->
    </main>

    <footer class="footer">
        <p>Copyright © Sistema Vivex 2020 - Todos los derechos reservados</p>
    </footer>
    
</body>


</html>