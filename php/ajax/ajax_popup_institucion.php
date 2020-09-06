
<?php 

if(isset($_POST['id_ciudad'])):

	require "conexion.php";
    $user = new vivexDB();
    //echo $_POST['id_institucion']; 
    //echo $_POST['id_ciudad'];
    //echo $_POST['id_provincia'];
    //echo $_POST['id_pais'];
    //echo $_POST['id_contrato'];
    $idciudad=$_POST['id_ciudad'];
    //Admin
    //Insti
    //Alumn
    $html="<option id='null' value='0';'>Institucion</option>";
    $instituciones="";
    $htmlinstituciones="";
        
    
?>

<?php
    $instituciones=$user->buscar('instituciones',"ciudades_id_ciudad in(".$idciudad.")");
    foreach($instituciones as $instituciones):
        $htmlinstituciones.="<option id='ciudad_optpopup' value='".$instituciones['id_institucion']."'>".$instituciones['colegio']."</option>";
    endforeach;
    
    

    echo $html.$htmlinstituciones;
    
    
    
    	
endif;
?>
