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
        $u=$user->buscar("dispositivos",'paises_id_pais in ('.$_POST['id_pais'].')');
    }
    if($_POST['id_ciudad']=="null"&&$_POST['id_provincia']!="null"){
        $u=$user->buscar("dispositivos",'provincias_id_provincia in ('.$_POST['id_provincia'].')');
    }
    if($_POST['id_institucion']=="null"&&$_POST['id_ciudad']!="null"){
        $u=$user->buscar("dispositivos",'ciudades_id_ciudad in ('.$_POST['id_ciudad'].')');
    }
    if($_POST['id_institucion']!="null"){
        $u=$user->buscar("dispositivos",'id_institucion in ('.$_POST['id_institucion'].')');
    }
    if($_POST['id_pais']=="null"&&$_POST['id_provincia']=="null"&&$_POST['id_ciudad']=="null"&&$_POST['id_institucion']=="null"){
        $u=="";
    }
    if($_POST['id_contrato']!="null"){
        $u=$user->buscar("dispositivos",'id_contrato in ('.$_POST['id_contrato'].')');
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
            <input type='checkbox' class='chek-disp'>
            <p>".$value['id_dispositivo']."</p>
            <p>".$value['id_institucion']."</p>
            <p>".$value['id_contrato']."</p>
            <p>".$estado."</p>
            <p>$mediciones</p>
            <p>".$fecha."</p>
            <a href='#' id=".$value['id_dispositivo']." edit class='icon-disp' onclick='open_popup(".strval($value['id_dispositivo']).");'><img id=".$value['id_dispositivo']." class='icon_datos' src='../img/editar.png' alt=''></a>
            <a href='#' class='icon-disp'><img class='icon_datos' src='../img/informacion.png' alt=''></a>
            <a href='#' id=".$value['id_hardware']." class='icon-disp'><img id=".$value['id_dispositivo']." class='icon_datos' src='../img/bloquear.png' alt='' onClick='block(this.id)'></a>
            <a href='#' class='icon-disp'><img class='icon_datos' src='../img/basura.png' alt=''></a>
            </div>
            <script type='text/javascript'>

                //verificamos pago 
                if(".$value['pago']."=='1'){
                    document.getElementById(".$value['id_dispositivo'].").src = '../img/bloquear.png';
                }else{
                    document.getElementById(".$value['id_dispositivo'].").src = '../img/bloqueado.png';
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

                function edit(clicked_id){
                   
                }
            </script>
            
            ";
        }
    }
    echo $html;
    
    	
endif;
?>
<?php    
echo "";
?>