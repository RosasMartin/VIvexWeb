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

    $u="";
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
    $html="";
    //$u=$user->actualizar('dispositivos', 'pago=0', 'WHERE id_dispositivo=clicked_id');
    


    if($u!=""){  
        foreach ($u as $key => $value)
        //$html.="<option id='ciud_opt' value='".$value['id_ciudad']."'>".$value['ciudad']."</option>";
        
        
        

        $html.="<div class='item-disp'>
        <input type='checkbox' class='chek-disp'>
        <p>".$value['id_dispositivo']."</p>
        <p>".$value['id_institucion']."</p>
        <p>On Line</p>
        <p>5263</p>
        <p>24/08/2020 15:25:36</p>
        <a href='#' class='icon-disp'><img class='icon_datos' src='../img/editar.png' alt=''></a>
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
        </script>
        
        ";
    }
    echo $html;
    
    	
endif;
?>
<?php    
echo "";
?>