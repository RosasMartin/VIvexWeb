
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
    
    if(strpos($_POST['id'], "Insti")=="true"){  
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

            function ddselectcaracteristicapopup(){
                var select = $('#caracteristicapopup').val();
                var selectedcaracteristicapopup = [];
                for (var option of document.getElementById('caracteristicapopup').options) {
                    if (option.selected) {
                        selectedcaracteristicapopup.push(option.value);
                    }
                }

                //popupcaracteristicapopup(selectedcaracteristicapopup);
                mensajeInsti();
                document.getElementById('caracteristicapopup').style.border = '1.5px solid #89fc00';
            }

            function ddselectfinanciamientopopup(){
                var select = $('#financiamientopopup').val();
                var selectedfinanciamientopopup = [];
                for (var option of document.getElementById('financiamientopopup').options) {
                    if (option.selected) {
                        selectedfinanciamientopopup.push(option.value);
                    }
                }

                //popupfinanciamientopopup(selectedfinanciamientopopup);
                mensajeInsti();
                document.getElementById('financiamientopopup').style.border = '1.5px solid #89fc00';
            }

            function ddselectriesgoeducativopopup(){
                var select = $('#riesgoeducativopopup').val();
                var selectedriesgoeducativopopup = [];
                for (var option of document.getElementById('riesgoeducativopopup').options) {
                    if (option.selected) {
                        selectedriesgoeducativopopup.push(option.value);
                    }
                }

                //popupriesgoeducativopopup(selectedriesgoeducativopopup);
                mensajeInsti();
                document.getElementById('riesgoeducativopopup').style.border = '1.5px solid #89fc00';
            }

            function ddselectprogramaasistenciapopup(){
                var select = $('#programaasistenciapopup').val();
                var selectedprogramaasistenciapopup = [];
                for (var option of document.getElementById('programaasistenciapopup').options) {
                    if (option.selected) {
                        selectedprogramaasistenciapopup.push(option.value);
                    }
                }

                //alert(selectedprogramaasistenciapopup);
                //popupprogramaasistenciapopup(selectedprogramaasistenciapopup);
                mensajeInsti();
                document.getElementById('programaasistenciapopup').style.border = '1.5px solid #89fc00';
            }

            function ddselectpaispopup() {
                            
                var select = $('#paises').val();
                var selectedpaises = [];
                for (var option of document.getElementById('paisespopup').options) {
                    if (option.selected) {
                        selectedpaises.push(option.value);
                    }
                }

                popupPaisSelect(selectedpaises);
                mensajeInsti();
                document.getElementById('paisespopup').style.border = '1.5px solid #89fc00';
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
                mensajeInsti();
                document.getElementById('provinciapopup').style.border = '1.5px solid #89fc00';
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
                mensajeInsti();
                document.getElementById('ciudadpopup').style.border = '1.5px solid #89fc00';
            }
            
           
            function suscribeInsti(){
                var paisInsti = $('#paisespopup').val();
                var provinciaInsti = $('#provinciapopup').val();
                var ciudadInsti = $('#ciudadpopup').val();
                var caracteristicapopup = $('#caracteristicapopup').val();
                var financiamientopopup = $('#financiamientopopup').val();
                var nombreinstitucionpopup = $('#nombreinstitucionpopup').val();
                var domiciliopopup = $('#domiciliopopup').val();
                var riesgoeducativopopup = $('#riesgoeducativopopup').val();
                var programaasistenciapopup = $('#programaasistenciapopup').val();
                

                let element = document.getElementById('btnInsti');
                let elementStyle = window.getComputedStyle(element);
                let elementcursor = elementStyle.getPropertyValue('cursor');
                //alert(elementcursor);
                if(elementcursor=='default'){
                    $.ajax({
                        data: { 'colegio': nombreinstitucionpopup,
                                'domicilio': domiciliopopup,
                                'caracteristica': caracteristicapopup,
                                'financiamiento': financiamientopopup,
                                'riesgo_educativo':  riesgoeducativopopup,
                                'programa_asistencia':  programaasistenciapopup,
                                'ciudades_id_ciudad': ciudadInsti,
                                'tipo': 'azul',
                                'porcentaje_riesgo': '0.0'},
                        url:   './ajax/ajax_popup_suscripcionInsti.php',
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
                                alert(response);
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

            function mensajeInsti(){
                var paisInsti = $('#paisespopup').val();
                var provinciaInsti = $('#provinciapopup').val();
                var ciudadInsti = $('#ciudadpopup').val();
                var caracteristicapopup = $('#caracteristicapopup').val();
                var financiamientopopup = $('#financiamientopopup').val();
                var nombreinstitucionpopup = $('#nombreinstitucionpopup').val();
                var domiciliopopup = $('#domiciliopopup').val();
                var riesgoeducativopopup = $('#riesgoeducativopopup').val();
                var programaasistenciapopup = $('#programaasistenciapopup').val();

                if(nombreinstitucionpopup!=''){
                    document.getElementById('nombreinstitucionpopup').style.border = '1.5px solid #89fc00';
                }else{
                    document.getElementById('nombreinstitucionpopup').style.border = '1.5px solid #D00000';
                    document.getElementById('mensajeInsti').innerHTML = 'Error: *Complete todos los campos';
                }

                if(domiciliopopup!=''){
                    document.getElementById('domiciliopopup').style.border = '1.5px solid #89fc00';
                }else{
                    document.getElementById('domiciliopopup').style.border = '1.5px solid #D00000';
                    document.getElementById('mensajeInsti').innerHTML = 'Error: *Complete todos los campos';
                }

                if(caracteristicapopup!='0'){
                    document.getElementById('caracteristicapopup').style.border = '1.5px solid #89fc00';
                }else{
                    document.getElementById('caracteristicapopup').style.border = '1.5px solid #D00000';
                    document.getElementById('mensajeInsti').innerHTML = 'Error: *Complete todos los campos';
                }

                if(financiamientopopup!='0'){
                    document.getElementById('financiamientopopup').style.border = '1.5px solid #89fc00';
                }else{
                    document.getElementById('financiamientopopup').style.border = '1.5px solid #D00000';
                    document.getElementById('mensajeInsti').innerHTML = 'Error: *Complete todos los campos';
                }

                if(riesgoeducativopopup!='0'){
                    document.getElementById('riesgoeducativopopup').style.border = '1.5px solid #89fc00';
                }else{
                    document.getElementById('riesgoeducativopopup').style.border = '1.5px solid #D00000';
                    document.getElementById('mensajeInsti').innerHTML = 'Error: *Complete todos los campos';
                }

                if(programaasistenciapopup!='0'){
                    document.getElementById('programaasistenciapopup').style.border = '1.5px solid #89fc00';
                }else{
                    document.getElementById('programaasistenciapopup').style.border = '1.5px solid #D00000';
                    document.getElementById('mensajeInsti').innerHTML = 'Error: *Complete todos los campos';
                }

                if(paisInsti!='0'){
                    document.getElementById('paisespopup').style.border = '1.5px solid #89fc00';
                }else{
                    document.getElementById('paisespopup').style.border = '1.5px solid #D00000';
                    document.getElementById('mensajeInsti').innerHTML = 'Error: *Complete todos los campos';
                }

                if(provinciaInsti!='0'){
                    document.getElementById('provinciapopup').style.border = '1.5px solid #89fc00';
                }else{
                    document.getElementById('provinciapopup').style.border = '1.5px solid #D00000';
                    document.getElementById('mensajeInsti').innerHTML = 'Error: *Complete todos los campos';
                }

                if(ciudadInsti!='0'){
                    document.getElementById('ciudadpopup').style.border = '1.5px solid #89fc00';
                }else{
                    document.getElementById('ciudadpopup').style.border = '1.5px solid #D00000';
                    document.getElementById('mensajeInsti').innerHTML = 'Error: *Complete todos los campos';
                }
                
                if(paisInsti!='0'&&provinciaInsti!='0'&&ciudadInsti!='0'&&caracteristicapopup!='0'&&financiamientopopup!='0'&&riesgoeducativopopup!='0'&&programaasistenciapopup!='0'){
                    if(nombreinstitucionpopup!=''&&domiciliopopup!=''){
                        document.getElementById('mensajeInsti').innerHTML = '';   
                        document.getElementById('btnInsti').style.cursor = 'default';
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
            width: 500px;
            height: 600px;
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
            grid-template-columns: 1fr ;
            grid-template-rows:1fr 1fr ;
        }
        main .popup form .contenedor-inputs imput1{
            display:grid;
            grid-row: 1 / 2;
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
        <h3>Institución</h3>
        <h4>Agregar institución</h3>
        <form action=''>
            <div class=contenedor-maestro>
                <div class='contenedor-inputs'>
                    <div class='imput1'>
                        
                        <input id='nombreinstitucionpopup' type='text' placeholder='Nombre Institución' onchange='mensajeInsti();'>
                        <input id='domiciliopopup' type='text' placeholder='Domicilio' onchange='mensajeInsti();'>
                        <form>
                            <select id='caracteristicapopup' name='caracteristica' class='select_popup' onchange='ddselectcaracteristicapopup();'>
                                <option id='null' value='0';'>Caracteristica</option>
                                <option id='caracteristica_optpopup' value='urbana'>Urbana</option>
                                <option id='caracteristica_optpopup' value='rural'>Rural</option>
                            </select>
                        </form>
                        <form>
                            <select id='financiamientopopup' name='financiamiento' class='select_popup' onchange='ddselectfinanciamientopopup();'>
                                <option id='null' value='0';'>Financiamiento</option>
                                <option id='financiamiento_optpopup' value='publica'>Publica</option>
                                <option id='financiamiento_optpopup' value='privada no confesional'>Privada no confesional</option>
                                <option id='financiamiento_optpopup' value='privada confesional'>Privada confesional</option>
                            </select>
                        </form>
                        <form>
                            <select id='riesgoeducativopopup' name='riesgoeducativo' class='select_popup' onchange='ddselectriesgoeducativopopup();'>
                                <option id='null' value='0';'>Riesgo Educativo</option>
                                <option id='riesgoeducativo_optpopup' value='bajo'>Bajo</option>
                                <option id='riesgoeducativo_optpopup' value='medio'>Medio</option>
                                <option id='riesgoeducativo_optpopup' value='alto'>Alto</option>
                            </select>
                        </form>
                        <form>
                            <select id='programaasistenciapopup' name='programaasistencia' class='select_popup' onchange='ddselectprogramaasistenciapopup();'>
                                <option id='null' value='0';'>Programa de Asistencia</option>
                                <option id='programaasistencia_optpopup' value='Si'>Si</option>
                                <option id='programaasistencia_optpopup' value='No'>No</option>
                            </select>
                        </form>
                    ";

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
                        <a id='btnInsti' class='btn-submit' onclick='suscribeInsti();' style='cursor: not-allowed;'>Suscribirse</a>
                    </div>
                    <p class='mensaje' id='mensajeInsti'></p>
            </div>
            
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
