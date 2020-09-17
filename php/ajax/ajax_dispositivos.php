<?php
echo "";
?>

<?php 

if(isset($_POST['id_pais'])||isset($_POST['id_provincia'])||isset($_POST['id_ciudad'])||isset($_POST['id_institucion'])):

	require "conexion.php";
    $user = new vivexDB();
    //echo $_POST['id_institucion']; 
    //echo $_POST['id_ciudad'];
    //echo $_POST['id_provincia'];
    //echo $_POST['id_pais'];
    //echo $_POST['id_contrato'];

    $u="";
    $e="";
    $a="";
    if($_POST['id_provincia']=="null"&&$_POST['id_pais']!="null"){
        $u=$user->buscar("dispositivos",'paises_id_pais in ('.$_POST['id_pais'].') AND activo="1"');
    }
    if($_POST['id_ciudad']=="null"&&$_POST['id_provincia']!="null"){
        $u=$user->buscar("dispositivos",'provincias_id_provincia in ('.$_POST['id_provincia'].') AND activo="1"');
    }
    if($_POST['id_institucion']=="null"&&$_POST['id_ciudad']!="null"){
        $u=$user->buscar("dispositivos",'ciudades_id_ciudad in ('.$_POST['id_ciudad'].') AND activo="1"');
    }
    if($_POST['id_institucion']!="null"){
        $u=$user->buscar("dispositivos",'id_institucion in ('.$_POST['id_institucion'].') AND activo="1"');
    }
    if($_POST['id_pais']=="null"&&$_POST['id_provincia']=="null"&&$_POST['id_ciudad']=="null"&&$_POST['id_institucion']=="null"){
        $u=="";
    }
    if($_POST['id_contrato']!="null"){
        $u=$user->buscar("dispositivos",'id_contrato in ('.$_POST['id_contrato'].') AND activo="1"');
    }
    $html="";
    $estado="";
    $mediciones=0;
    $edit="editar";
    $edit_valor="";
    //$u=$user->actualizar('dispositivos', 'pago=0', 'WHERE id_dispositivo=clicked_id');
   
    //Establecemos zona horaria por defecto
   date_default_timezone_set('America/Argentina/Buenos_Aires');

    if($u!=""){  
        $check_count=0;
        foreach ($u as $key => $value){
            $mediciones=0;
            //$html.="<option id='ciud_opt' value='".$value['id_ciudad']."'>".$value['ciudad']."</option>";
            $a=$user->buscar("alumnos_salud",'id_balanza="'.$value['id_hardware'].'"');
            foreach ($a as $key2 => $value2){
                $mediciones++;
            }
            $tUnix=$value['ultima_actualizacion_UNIX'];
            if($tUnix){
                $fecha=date('d/m/Y H:i:s', $tUnix);
                if((time()-$value['ultima_actualizacion_UNIX'])>120){
                    $estado="Off Line";
                    $e=$user->actualizar('dispositivos', 'estado= "Off Line"', 'id_hardware="'.$value['id_hardware'].'"');
                }else{
                    $estado="On Line";
                    $e=$user->actualizar('dispositivos', 'estado= "On Line"', 'id_hardware="'.$value['id_hardware'].'"');
                }
            }else{
                $fecha="-";
                $estado="Off Line";
                $e=$user->actualizar('dispositivos', 'estado= "Off Line"', 'id_hardware="'.$value['id_hardware'].'"');
            }
            
            
            $html.="<div class='item-disp'>
            <input id='check_".$value['id_dispositivo']."' name='check_opt' type='checkbox' class='chek-disp' onchange=''>
            <p>".$value['id_dispositivo']."</p>
            <p>".$value['id_institucion']."</p>
            <p>".$value['id_contrato']."</p>
            <p>".$estado."</p>
            <p>$mediciones</p>
            <p>".$fecha."</p>
            <a href='#' class='icon-disp 'onClick='info(".strval($value['id_dispositivo']).")'><img class='icon_datos' src='../img/informacion.png' alt=''></a>
            <a href='#' id=".$value['id_hardware']." class='icon-disp'><img id=".strval($value['id_dispositivo'])." class='icon_datos' src='../img/bloquear.png' alt='' onClick='block(".strval($value['id_dispositivo']).")'></a>
            <a href='#' class='icon-disp' onClick='borrar(".strval($value['id_dispositivo']).")'><img class='icon_datos' src='../img/basura.png' alt=''></a>
            </div>
            
            <script type='text/javascript'>

                //verificamos pago 
                
                if(".$value['pago']."==1){
                    
                    document.getElementById(".strval($value['id_dispositivo']).").src = '../img/bloquear.png';
                }
                if(".$value['pago']."==0){
                    
                    document.getElementById(".strval($value['id_dispositivo']).").src = '../img/bloqueado.png';
                }

                function block(clicked_id)
                {
                    var mensaje;
                    
                    var opcion = confirm('¿Está seguro de modificar el estado del dispositivo?');
                    if (opcion == true) {
                        mensaje = 'Has clickado OK';
                        document.getElementById(clicked_id).src = '../img/bloqueado.png';
                        bloquear_disp(clicked_id);
                    } else {
                        mensaje = 'Has clickado Cancelar';
                    }
            

                
                }

                

                function info(clicked_id){
                    //alert('info:'+clicked_id);
                    open_popup('info'+clicked_id)
                }

                
            </script>
            
            ";
            $check_count++;
        }
    }
    echo $html;
    
    	
endif;
?>
<?php    
echo "";
?>