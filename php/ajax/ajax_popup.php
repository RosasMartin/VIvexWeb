
<?php 

if(isset($_POST['id'])):

	require "conexion.php";
    $user = new vivexDB();
    //echo $_POST['id_institucion']; 
    //echo $_POST['id_ciudad'];
    //echo $_POST['id_provincia'];
    //echo $_POST['id_pais'];
    //echo $_POST['id_contrato'];
    
    //Admin
    //Insti
    //Alumn
    $htmlAdmin1="";
    $htmlAdmin2="";
    $AdminPais1="";
    $AdminPais2="";
    $AdminPais3="";
    $AdminContratos="";
    $AdminEstatus="";
    
?>

<?php
    
    if(strpos($_POST['id'], "Admin")=="true"){  
        //Multiselect paises
        $AdminPais1="    
        <form>
            <select id='paisespopup' name='paises' class='select_popup' onchange='ddselectpaispopup();'>
            <option id='null' value='0';'>Pais</option>";

                
                    
        $paises=$user->buscar('paises','1');
        foreach($paises as $paises):
            $AdminPais2.="<option id='pais_optpopup' value='".$paises['id_pais']."'>".$paises['nombre_pais']."</option>";
        endforeach;

        $contratos=$user->buscar('contratos','1');
        foreach($contratos as $contratos):
            $AdminContratos.="<option id='contrato_optpopup' value='".$contratos['id_contrato']."'>".$contratos['descripcion']."</option>";
        endforeach;   

        $estatus=$user->buscar('estatus','1');
        foreach($estatus as $estatus):
            $AdminEstatus.="<option id='estatus_optpopup' value='".$estatus['id_estatus']."'>".$estatus['descripcion']."</option>";
        endforeach; 

        $AdminPais3="
            </select>
        </form>
        <script type='text/javascript'>

            function ddselectpaispopup() {
                            
                var select = $('#paises').val();
                var selectedpaises = [];
                for (var option of document.getElementById('paisespopup').options) {
                    if (option.selected) {
                        selectedpaises.push(option.value);
                    }
                }

                popupPaisSelect(selectedpaises);
                mensajeAdmin();
                document.getElementById('paisespopup').style.border = '2px solid #89fc00';
            }
            function popupPaisSelect(selectedpaises){
                //alert(selectedpaises);
                $.ajax({
                    data: { 'id_pais':selectedpaises[0]},
                    url:   './ajax/ajax_popup_provincia.php',
                    type:  'POST',
                    beforeSend: function () {
                    //console.log('Enviando');
                        
                    },
                    success:  function (response) { 
    
                        $('#provinciapopup').html(response);
                        
                        
                    },
                    error:function(){
                        alert('error')
                    }
                });
            }


            function ddselectprovinciapopup(){
                var select = $('#provinciapopup').val();
                var selectedprovincias = [];
                for (var option of document.getElementById('provinciapopup').options) {
                    if (option.selected) {
                        selectedprovincias.push(option.value);
                    }
                }
                //alert(selectedprovincias);
                popupProvinciaSelect(selectedprovincias);
                mensajeAdmin();
                document.getElementById('provinciapopup').style.border = '2px solid #89fc00';
            }
            function popupProvinciaSelect(selectedprovincias){
                //alert(selectedprovincias);
                $.ajax({
                    data: { 'id_provincia':selectedprovincias[0]},
                    url:   './ajax/ajax_popup_ciudad.php',
                    type:  'POST',
                    beforeSend: function () {
                    //console.log('Enviando');
                        
                    },
                    success:  function (response) { 
    
                        $('#ciudadpopup').html(response);
                        
                        
                    },
                    error:function(){
                        alert('error')
                    }
                });
            }

            function ddselectciudadpopup(){
                var select = $('#ciudadpopup').val();
                var selectedciudades = [];
                for (var option of document.getElementById('ciudadpopup').options) {
                    if (option.selected) {
                        selectedciudades.push(option.value);
                    }
                }
                //alert(selectedciudades);
                popupciudadeselect(selectedciudades);
                mensajeAdmin();
                document.getElementById('ciudadpopup').style.border = '2px solid #89fc00';
            }
            function popupciudadeselect(selectedciudades){
                //alert(selectedciudades);
                $.ajax({
                    data: { 'id_ciudad':selectedciudades[0]},
                    url:   './ajax/ajax_popup_institucion.php',
                    type:  'POST',
                    beforeSend: function () {
                    //console.log('Enviando');
                        
                    },
                    success:  function (response) { 
    
                        $('#institucionpopup').html(response);
                        
                        
                    },
                    error:function(){
                        alert('error')
                    }
                });
            }

            function ddselectinstitucionpopup(){
                document.getElementById('institucionpopup').style.border = '2px solid #89fc00';
            }

            function suscribeAdmin(){
                var paisAdmin = $('#paisespopup').val();
                var provinciaAdmin = $('#provinciapopup').val();
                var ciudadAdmin = $('#ciudadpopup').val();
                var institucionAdmin = $('#institucionpopup').val();
                var contratoAdmin = $('#idcontratopopup').val();
                var estatusAdmin = $('#estatuspopup').val();
                var nombreAdmin = $('#nombrepopup').val();
                var apellidoAdmin = $('#apellidopopup').val();
                var correoAdmin = $('#correopopup').val();
                var passoneAdmin = $('#passonepopup').val();
                var passtwoAdmin = $('#passtwopopup').val();

                let element = document.getElementById('btnAdmin');
                let elementStyle = window.getComputedStyle(element);
                let elementcursor = elementStyle.getPropertyValue('cursor');
                //alert(elementcursor);
                if(elementcursor=='default'){
                    $.ajax({
                        data: { 'status': estatusAdmin,
                                'nombre': nombreAdmin,
                                'apellido': apellidoAdmin,
                                'username': correoAdmin,
                                'password': passoneAdmin,
                                'email': correoAdmin,
                                'paises_id_pais': paisAdmin,
                                'provincias_id_provincia': provinciaAdmin,
                                'ciudades_id_ciudad': ciudadAdmin,
                                'instituciones_id_institucion': institucionAdmin,
                                'id_contrato': contratoAdmin},
                        url:   './ajax/ajax_popup_suscripcionAdmin.php',
                        type:  'POST',
                        beforeSend: function () {
                        //console.log('Enviando');
                            
                        },
                        success:  function (response) { 
                            if(response=='true'){
                                var overlay = document.getElementById('overlay'),
                                popup = document.getElementById('popup');
                                overlay.classList.remove('active');
	                            popup.classList.remove('active');
                                
                            }
                            if(response=='false'){
                                alert('Error: Falló la conexión, intente nuevamente!');
                            }
                            if(response!='true'&&response!='false'){
                                //alert(response);
                                //console.log(response);
                                document.getElementById('mensajeAdmin').innerHTML = 'Error: *Ya existe un administrador con el mismo correo';
                    
                            }
                        },
                        error:function(){
                            alert('error')
                        }
                    });
                }
                
            }

            function mensajeAdmin(){
                var paisAdmin = $('#paisespopup').val();
                var provinciaAdmin = $('#provinciapopup').val();
                var ciudadAdmin = $('#ciudadpopup').val();
                var institucionAdmin = $('#institucionpopup').val();
                var contratoAdmin = $('#idcontratopopup').val();
                var estatusAdmin = $('#estatuspopup').val();
                var nombreAdmin = $('#nombrepopup').val();
                var apellidoAdmin = $('#apellidopopup').val();
                var correoAdmin = $('#correopopup').val();
                var passoneAdmin = $('#passonepopup').val();
                var passtwoAdmin = $('#passtwopopup').val();
                
                if(contratoAdmin!='0'){
                    document.getElementById('idcontratopopup').style.border = '1.5px solid #89fc00';
                }else{
                    document.getElementById('idcontratopopup').style.border = '1.5px solid #D00000';
                    document.getElementById('mensajeAdmin').innerHTML = 'Error: *Complete todos los campos';
                }

                if(estatusAdmin!='0'){
                    document.getElementById('estatuspopup').style.border = '1.5px solid #89fc00';
                }else{
                    document.getElementById('estatuspopup').style.border = '1.5px solid #D00000';
                    document.getElementById('mensajeAdmin').innerHTML = 'Error: *Complete todos los campos';
                }

                if(paisAdmin!='0'){
                    document.getElementById('paisespopup').style.border = '1.5px solid #89fc00';
                }else{
                    document.getElementById('paisespopup').style.border = '1.5px solid #D00000';
                    document.getElementById('mensajeAdmin').innerHTML = 'Error: *Complete todos los campos';
                }

                if(provinciaAdmin!='0'){
                    document.getElementById('provinciapopup').style.border = '1.5px solid #89fc00';
                }else{
                    document.getElementById('provinciapopup').style.border = '1.5px solid #D00000';
                    document.getElementById('mensajeAdmin').innerHTML = 'Error: *Complete todos los campos';
                }

                if(ciudadAdmin!='0'){
                    document.getElementById('ciudadpopup').style.border = '1.5px solid #89fc00';
                }else{
                    document.getElementById('ciudadpopup').style.border = '1.5px solid #D00000';
                    document.getElementById('mensajeAdmin').innerHTML = 'Error: *Complete todos los campos';
                }

                if(institucionAdmin!='0'){
                    document.getElementById('institucionpopup').style.border = '1.5px solid #89fc00';
                }else{
                    document.getElementById('institucionpopup').style.border = '1.5px solid #D00000';
                    document.getElementById('mensajeAdmin').innerHTML = 'Error: *Complete todos los campos';
                }

                if(nombreAdmin!=''){
                    document.getElementById('nombrepopup').style.border = '1.5px solid #89fc00';
                }else{
                    document.getElementById('nombrepopup').style.border = '1.5px solid #D00000';
                    document.getElementById('mensajeAdmin').innerHTML = 'Error: *Complete todos los campos';
                }

                if(apellidoAdmin!=''){
                    document.getElementById('apellidopopup').style.border = '1.5px solid #89fc00';
                }else{
                    document.getElementById('apellidopopup').style.border = '1.5px solid #D00000';
                    document.getElementById('mensajeAdmin').innerHTML = 'Error: *Complete todos los campos';
                }

                if(correoAdmin!=''){

                    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
                   
                    if (reg.test(correoAdmin) == false) {
                        document.getElementById('correopopup').style.border = '1.5px solid #D00000';
                        document.getElementById('mensajeAdmin').innerHTML = 'Error: *El formato de correo es incorrecto';
                    }else{
                        document.getElementById('correopopup').style.border = '1.5px solid #89fc00';
                        document.getElementById('mensajeAdmin').innerHTML = 'Error: *Complete todos los campos';
                        document.getElementById('btnAdmin').style.cursor = 'not-allowed';
                    }
                }else{
                    document.getElementById('correopopup').style.border = '1.5px solid #D00000';
                    document.getElementById('mensajeAdmin').innerHTML = 'Error: *Complete todos los campos';
                }

                if(passoneAdmin!='' || passtwoAdmin!=''){
                    if(passoneAdmin!=passtwoAdmin){
                        document.getElementById('mensajeAdmin').innerHTML = 'Error: las contraseñas no son iguales';
                        document.getElementById('passonepopup').style.border = '1.5px solid #D00000';
                        document.getElementById('passtwopopup').style.border = '1.5px solid #D00000';
                    }else{
                        document.getElementById('mensajeAdmin').innerHTML = 'Error: *Complete todos los campos';
                        document.getElementById('passonepopup').style.border = '1.5px solid #89fc00';
                        document.getElementById('passtwopopup').style.border = '1.5px solid #89fc00';
                        document.getElementById('btnAdmin').style.cursor = 'not-allowed';
                    }
                }

                if(passoneAdmin=='' || passtwoAdmin==''){
                    document.getElementById('passonepopup').style.border = '1.5px solid #D00000';
                    document.getElementById('passtwopopup').style.border = '1.5px solid #D00000';
                }

                if(paisAdmin!='0'&&provinciaAdmin!='0'&&ciudadAdmin!='0'&&institucionAdmin!='0'&&contratoAdmin!='0'&&estatusAdmin!='0'){
                    if(nombreAdmin!=''&&apellidoAdmin!=''&&correoAdmin!=''){
                        if(passoneAdmin!='' || passtwoAdmin!=''){
                            if(passoneAdmin==passtwoAdmin){
                                document.getElementById('mensajeAdmin').innerHTML = '';   
                                document.getElementById('btnAdmin').style.cursor = 'default';
                            }
                        }
                    }
                }

            }
        </script>";
        

        $htmlAdmin1.="
        <style type='text/css'>

        /* ------------------------- */
        /* POPUP */
        /* ------------------------- */
    
        main .overlay {
            background: rgba(0,0,0,.4);
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            align-items: center;
            justify-content: center;
            display: flex;
            visibility: hidden;
            z-index: 1;
        }
    
        main .overlay.active {
            visibility: visible;
        }
    
        main .popup {
            display:grid;
            background: #F8F8F8;
            box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.4);
            border-radius: 6px;
            font-family: 'Montserrat', sans-serif;
            padding: 20px;
            text-align: center;
            width: 800px;
            height: 500px;
            transition: .3s ease all;
            transform: scale(0.7);
            opacity: 0;
            z-index: 2;
        }
        
        main .popup .mensaje {
            mergin-top: 10px;
            margin-bottom: 10px;
            color: #551919;
        }

        main .popup .btn-cerrar-popup {
            height: 2.5px;
            display: block;
            text-align: right;
            transition: .3s ease all;
            color: #BBBBBB;
        }
    
        main .popup .btn-cerrar-popup:hover {
            color: #000;
        }
    
        main .popup h3 {
            font-size: 25px;
            font-weight: 600;
            margin-bottom: 5px;
            opacity: 0;
            color: rgba(0, 0, 0, 0.6);
        }
    
        main .popup h4 {
            font-size: 20px;
            font-weight: 300;
            margin-bottom: 15px;
            opacity: 0;
        }
        main .popup form .contenedor-inputs {
            opacity: 0;
            display:grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows:1fr .4fr;
        }
        main .popup form .contenedor-inputs imput1{
            display:grid;
            grid-row: 1 / 2;
        }
        main .popup form .contenedor-inputs imput2{
            display:grid;
            grid-row: 2 / 3;
        }
        main .popup form .contenedor-inputs imput3{
            display:grid;
            grid-row: 1 / 2;
            padding-top:20px;
        }
        main .popup form .contenedor-inputs imput4{
            display:grid;
            grid-row: 2 / 3;
           
        }
        main .popup form .contenedor-inputs input {
            width: 100%;
            margin-bottom: 10px;
            height: 28px;
            width: 350px;
            font-size: 18px;
            line-height: 52px;
            text-align: center;
            border: 1px solid #BBBBBB;
            border-radius: 20px;
        }
        
        main .popup form .contenedor-inputs .select_popup {
            width: 100%;
            margin-bottom: 10px;
            height: 28px;
            width: 350px;
            font-size: 18px;
            line-height: 52px;
            text-align: center;
            border: 1px solid #BBBBBB;
            border-radius: 20px;
            color:#6C6B6B;
            text-align-last: center;
            align-self: center;
            justify-self: center;
        }
        
    
        main .popup form .btn-submit {
            padding: 10px 20px;
            margin-top: 10px;
            height: 40px;
            line-height: 40px;
            border: none;
            color: #fff;
            background: #551919;
            border-radius: 3px;
            font-family: 'Montserrat', sans-serif;
            font-size: 16px;
            cursor: pointer;
            transition: .3s ease all;
        }
    
        main .popup form .btn-submit:hover {
            background: rgba(94,125,227, .9);
            background: #8c4848c0;
        }
    
        /* ------------------------- */
        /* ANIMACIONES */
        /* ------------------------- */
        main .popup.active {	transform: scale(1); opacity: 1; }
        main .popup.active h3 { animation: entradaTitulo .8s ease .5s forwards; }
        main .popup.active h4 { animation: entradaSubtitulo .8s ease .5s forwards; }
        main .popup.active .contenedor-inputs { animation: entradaInputs 1s linear 1s forwards; }
    
        @keyframes entradaTitulo {
            from {
                opacity: 0;
                transform: translateY(-25px);
            }
    
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
    
        @keyframes entradaSubtitulo {
            from {
                opacity: 0;
                transform: translateY(25px);
            }
    
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
    
        @keyframes entradaInputs {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        </style>

        <a href='#' id='btn-cerrar-popup' class='btn-cerrar-popup'><img src='../img/clear.png' alt=''></a>
        <h3>Administrador</h3>
        <h4>Agregar administrador</h3>
        <form action=''>
            <div class=contenedor-maestro>
                <div class='contenedor-inputs'>
                    <div class='imput1'>
                        <form>
                            <select id='idcontratopopup' name='idcontrato' class='select_popup' onchange='mensajeAdmin();'>
                                <option id='null' value='0';'>ID Contrato</option>
                                ".$AdminContratos."
                            </select>
                        </form>
                        <form>
                            <select id='estatuspopup' name='estatus' class='select_popup' onchange='mensajeAdmin();'>
                                <option id='null' value='0';'>Estatus</option>
                                ".$AdminEstatus."
                            </select>
                        </form>
                        <input id='nombrepopup' type='text' placeholder='Nombre' onchange='mensajeAdmin();'>
                        <input id='apellidopopup' type='text' placeholder='Apellido' onchange='mensajeAdmin();'>
                        <input id='correopopup' type='email' placeholder='Correo' onchange='mensajeAdmin();'>
                    </div>
                    <div class='imput2'>";

                    $htmlAdmin2="
                    
                        <form>
                            <select id='provinciapopup' name='provincia' class='select_popup' onchange='ddselectprovinciapopup();'>
                                <option id='null' value='0';'>Provincia</option>
                            </select>
                        </form>
                        <form>
                            <select id='ciudadpopup' name='ciudad' class='select_popup' onchange='ddselectciudadpopup();'>
                                <option id='null' value='0';'>Ciudad</option>
                            </select>
                        </form>
                        <form>
                            <select id='institucionpopup' name='institucion' class='select_popup' onchange='ddselectinstitucionpopup();'>
                                <option id='null' value='0';'>Institucion</option>
                            </select>
                        </form>
                    </div>
                        <div class='imput3' style='padding-top: 30px;'>
                        <input id='passonepopup' type='password' placeholder='Password' onchange='mensajeAdmin();'>
                    </div>
                        <div class='imput4' style='padding-top: 30px;'>
                        <input id='passtwopopup' type='password' placeholder='Reingrese Password' onchange='mensajeAdmin();'>
                    </div>
                  
                </div>
                <a id='btnAdmin' class='btn-submit' onclick='suscribeAdmin();' style='cursor: not-allowed;'>Suscribirse</a>
                
            </div>
            <p class='mensaje' id='mensajeAdmin'></p>
        </form>
        ";
    }
    

    echo $htmlAdmin1;
    echo $AdminPais1;
    echo $AdminPais2;
    echo $AdminPais3;
    echo $htmlAdmin2;
    
    
    	
endif;
?>
