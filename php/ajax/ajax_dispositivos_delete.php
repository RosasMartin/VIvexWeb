<?php
echo "";
?>

<?php 

if(isset($_POST['id_dispositivo'])):

	require "conexion.php";
    $user = new vivexDB();
    //echo $_POST['id_institucion']; 
    //echo $_POST['id_ciudad'];
    //echo $_POST['id_provincia'];
    //echo $_POST['id_pais'];

    
    $u=$user->buscar("dispositivos",'id_dispositivo in ('.$_POST['id_dispositivo'].')');
    $html="";
    if($u!=""){  
        foreach ($u as $key => $value)
        $html.=$value['pago'];
        
    }
    
    
    if($value['pago']=="1"){
        $u=$user->actualizar('dispositivos', 'activo=0', 'id_dispositivo='.$value['id_dispositivo']);
        $html=0;
    }else{
        $u=$user->actualizar('dispositivos', 'activo=1', 'id_dispositivo='.$value['id_dispositivo']);
        $html=1;
    }

    
    
    echo $html;
    
    	
endif;
?>
<?php    
echo "";
?>