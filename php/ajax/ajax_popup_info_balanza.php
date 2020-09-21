
<?php 

if(isset($_POST['id'])):

	require "conexion.php";
    $user = new vivexDB();
    
    
    //Admin
    //Insti
    //Alumn
    $htmlAdmin1="";
    $htmlAdmin2="";
    
    


    //Busqueda información balanza
    $id=strval($_POST['id']);
    $dispositivo=$user->buscar('dispositivos','id_dispositivo ='.$id);
    
    // preparar datos (convertirlos en array)
    $dispositivo=json_encode($dispositivo);
    $dispositivo = explode(",", $dispositivo);
    
    
    //busqueda pais
    $id_pais=str_replace('paises_id_pais','',$dispositivo[8]);
    $id_pais=str_replace('"','',$id_pais);
    $id_pais=str_replace(':','',$id_pais);
    $responseInfo=$id_pais;

    $responsePais="";
    $pais=$user->buscar_valor('paises','nombre_pais','id_pais ='.intval($id_pais));
    $pais=json_encode($pais);
    $pais = explode(",",$pais);

    $responsePais=str_replace(':','',$pais[0]);
    $responsePais=str_replace('nombre_pais','',$responsePais);
    $responsePais=str_replace('"','',$responsePais);
    $responsePais=str_replace('[{','',$responsePais);
    $responsePais=str_replace('}]','',$responsePais);
    //End busqueda pais

    //busqueda provincia
    $id_provincia=str_replace('provincias_id_provincia','',$dispositivo[9]);
    $id_provincia=str_replace('"','',$id_provincia);
    $id_provincia=str_replace(':','',$id_provincia);
    $responseInfo=$id_provincia;

    $responseProvincia="";
    $provincia=$user->buscar_valor('provincias','provincia','id_provincia ='.intval($id_provincia));
    $provincia=json_encode($provincia);
    $provincia = explode(",",$provincia);

    $responseProvincia=str_replace(':','',$provincia[0]);
    $responseProvincia=str_replace('provincia','',$responseProvincia);
    $responseProvincia=str_replace('"','',$responseProvincia);
    $responseProvincia=str_replace('[{','',$responseProvincia);
    $responseProvincia=str_replace('}]','',$responseProvincia);
    //End busqueda provincia

    //busqueda ciudad
    $id_ciudad=str_replace('ciudades_id_ciudad','',$dispositivo[10]);
    $id_ciudad=str_replace('"','',$id_ciudad);
    $id_ciudad=str_replace(':','',$id_ciudad);
    $responseInfo=$id_ciudad;

    $responseCiudad="";
    $ciudad=$user->buscar_valor('ciudades','ciudad','id_ciudad ='.intval($id_ciudad));
    $ciudad=json_encode($ciudad);
    $ciudad = explode(",",$ciudad);

    $responseCiudad=str_replace(':','',$ciudad[0]);
    $responseCiudad=str_replace('ciudad','',$responseCiudad);
    $responseCiudad=str_replace('"','',$responseCiudad);
    $responseCiudad=str_replace('[{','',$responseCiudad);
    $responseCiudad=str_replace('}]','',$responseCiudad);
    //End busqueda ciudad

    //busqueda institucion
    $id_institucion=str_replace('id_institucion','',$dispositivo[2]);
    $id_institucion=str_replace('"','',$id_institucion);
    $id_institucion=str_replace(':','',$id_institucion);
    $responseInfo=$id_institucion;

    $responseInstitucion="";
    $institucion=$user->buscar_valor('instituciones','colegio','id_institucion ='.intval($id_institucion));
    $institucion=json_encode($institucion);
    $institucion = explode(",",$institucion);

    $responseInstitucion=str_replace(':','',$institucion[0]);
    $responseInstitucion=str_replace('colegio','',$responseInstitucion);
    $responseInstitucion=str_replace('"','',$responseInstitucion);
    $responseInstitucion=str_replace('[{','',$responseInstitucion);
    $responseInstitucion=str_replace('}]','',$responseInstitucion);
    //End busqueda institucion

    //busqueda dirección institución
    $id_institucion=str_replace('id_institucion','',$dispositivo[2]);
    $id_institucion=str_replace('"','',$id_institucion);
    $id_institucion=str_replace(':','',$id_institucion);
    $responseInfo=$id_institucion;

    $responseDireccion="";
    $direccion=$user->buscar_valor('instituciones','domicilio','id_institucion ='.intval($id_institucion));
    $direccion=json_encode($direccion);
    $direccion = explode(",",$direccion);

    $responseDireccion=str_replace(':','',$direccion[0]);
    $responseDireccion=str_replace('domicilio','',$responseDireccion);
    $responseDireccion=str_replace('"','',$responseDireccion);
    $responseDireccion=str_replace('[{','',$responseDireccion);
    $responseDireccion=str_replace('}]','',$responseDireccion);
    //End busqueda dirección institución

    //busqueda contrato
    $id_contrato=str_replace('id_contrato','',$dispositivo[3]);
    $id_contrato=str_replace('"','',$id_contrato);
    $id_contrato=str_replace(':','',$id_contrato);
    $responseInfo=$id_contrato;

    $responseContrato="";
    $contrato=$user->buscar_valor('contratos','descripcion','id_contrato ='.intval($id_contrato));
    $contrato=json_encode($contrato);
    $contrato = explode(",",$contrato);

    $responseContrato=str_replace(':','',$contrato[0]);
    $responseContrato=str_replace('descripcion','',$responseContrato);
    $responseContrato=str_replace('"','',$responseContrato);
    $responseContrato=str_replace('[{','',$responseContrato);
    $responseContrato=str_replace('}]','',$responseContrato);
    //End busqueda contrato
    
    //busqueda estado bateria
    $bateria=str_replace('bateria_salud','',$dispositivo[6]);
    $bateria=str_replace('"','',$bateria);
    $bateria=str_replace(':','',$bateria);
    $responseBateria=$bateria;
    //End estado bateria

    //busqueda estado conexion
    $conexion=str_replace('estado','',$dispositivo[11]);
    $conexion=str_replace('"','',$conexion);
    $conexion=str_replace(':','',$conexion);
    $responseConexion=$conexion;
    //End estado conexion

    //busqueda estado pago
    $pago=str_replace('pago','',$dispositivo[7]);
    $pago=str_replace('"','',$pago);
    $pago=str_replace(':','',$pago);
    $responsePago=$pago;
    if($responsePago=='1'){
        $responsePago='Pagado';
    }
    if($responsePago=='0'){
        $responsePago='No Pagado';
    }
    //End estado pago

    //busqueda estado actualizacion
    $actualizacion=str_replace('ultima_actualizacion_UNIX','',$dispositivo[12]);
    $actualizacion=str_replace('"','',$actualizacion);
    $actualizacion=str_replace(':','',$actualizacion);
    if($actualizacion!='null'){
        //Establecemos zona horaria por defecto
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $fecha=date('d/m/Y H:i:s', $actualizacion);
    }else{
        $fecha='-';
    }
    $responseActualizacion=$fecha;
    //End estado actualizacion

    //busqueda datos admin contrato
    $id_contrato=str_replace('id_contrato','',$dispositivo[3]);
    $id_contrato=str_replace('"','',$id_contrato);
    $id_contrato=str_replace(':','',$id_contrato);
    $responseInfo=$id_contrato;

    $nombre=$user->buscar_valor('contratos','nombre','id_contrato ='.intval($id_contrato));
    $nombre=json_encode($nombre);
    $nombre = explode(",",$nombre);

    $responseNombre=str_replace(':','',$nombre[0]);
    $responseNombre=str_replace('nombre','',$responseNombre);
    $responseNombre=str_replace('"','',$responseNombre);
    $responseNombre=str_replace('[{','',$responseNombre);
    $responseNombre=str_replace('}]','',$responseNombre);

    $apellido=$user->buscar_valor('contratos','apellido','id_contrato ='.intval($id_contrato));
    $apellido=json_encode($apellido);
    $apellido = explode(",",$apellido);

    $responseApellido=str_replace(':','',$apellido[0]);
    $responseApellido=str_replace('apellido','',$responseApellido);
    $responseApellido=str_replace('"','',$responseApellido);
    $responseApellido=str_replace('[{','',$responseApellido);
    $responseApellido=str_replace('}]','',$responseApellido);

    $email=$user->buscar_valor('contratos','email','id_contrato ='.intval($id_contrato));
    $email=json_encode($email);
    $email = explode(",",$email);

    $responseEmail=str_replace(':','',$email[0]);
    $responseEmail=str_replace('email','',$responseEmail);
    $responseEmail=str_replace('"','',$responseEmail);
    $responseEmail=str_replace('[{','',$responseEmail);
    $responseEmail=str_replace('}]','',$responseEmail);
    //End busqueda datos admin contrato
?>

<?php

    $htmlAdmin1="
    
    
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
        grid-template-rows: 1fr 1fr 1fr 9fr;
        background: #F8F8F8;
        box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.4);
        border-radius: 6px;
        font-family: 'Montserrat', sans-serif;
        padding: 20px;
        text-align: center;
        width: 600px;
        height: 400px;
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
        margin-top: 10px;
        opacity: 0;
        color: rgba(0, 0, 0, 0.6);
    }

    main .popup h4 {
        font-size: 20px;
        font-weight: 300;
        margin-top: 10px;
        margin-bottom: 15px;
        opacity: 0;
    }
    main .popup form .contenedor-inputs {
        opacity: 0;
        display:grid;
        grid-template-columns: 1fr 1fr;
        grid-template-rows:1fr 1fr;
        text-align:start;
        
    }

    main .popup form .contenedor-inputs span{
        color:#000000;
        font-weight:bold;
        font-size:1.1rem;
    }

    main .popup form .contenedor-inputs p{
        font-weight:bold;
        color:#551919
        
    }

    main .popup form .contenedor-inputs input {
        display:none;
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


    /** File **/
    
    /** File **/
    </style>

    

    <a href='#' id='btn-cerrar-popup' class='btn-cerrar-popup'><img src='../img/clear.png' alt=''></a>
    <h3>Información</h3>
    <h4>Información balanza nº:".$_POST['id']."</h3>
    <form action=''>
        <div class=contenedor-maestro>
            <div class='contenedor-inputs'>                    
            
            
                ";

                $htmlAdmin2="
                
            </div>
            
            
        </div>
        <p class='mensaje' id='mensajeAlumn'></p>
    </form>

    ";
   
    

    echo $htmlAdmin1;
    //echo json_encode($institucion);
    echo "<p><span>Pais: </span>".$responsePais."</p>";
    echo "<p><span>Provincia: </span>".$responseProvincia."</p>";
    echo "<p><span>Ciudad: </span>".$responseCiudad."</p>";
    echo "<p><span>Instutucion: </span>".$responseInstitucion."</p>";
    echo "<p><span>Dirección: </span>".$responseDireccion."</p>";
    echo "<p><span>Contrato: </span>".$responseContrato."</p>";
    echo "<p><span>Estado Bateria: </span>".$responseBateria."</p>";
    echo "<p><span>Estado Conexión: </span>".$responseConexion."</p>";
    echo "<p><span>Estado Pago: </span>".$responsePago."</p>";
    echo "<p><span>Ultima Conexión: </span>".$responseActualizacion."</p>";
    echo "<p><span>Admin. Contrato: </span>".$responseNombre." ".$responseApellido."</p>";
    echo "<p><span>email: </span>".$responseEmail."</p>";
    echo $htmlAdmin2;
    
    
    	
endif;
?>
