
<?php 

if(isset($_POST['id_provincia'])):

	require "conexion.php";
    $user = new vivexDB();
    //echo $_POST['id_institucion']; 
    //echo $_POST['id_ciudad'];
    //echo $_POST['id_provincia'];
    //echo $_POST['id_pais'];
    //echo $_POST['id_contrato'];
    $idprovincia=$_POST['id_provincia'];
    //Admin
    //Insti
    //Alumn
    $html="<option id='null' value='0';'>Ciudades</option>";
    $ciudades="";
    $htmlciudades="";
        
    
?>

<?php
    $ciudades=$user->buscar('ciudades',"provincias_id_provincia in(".$idprovincia.")");
    foreach($ciudades as $ciudades):
        $htmlciudades.="<option id='provincia_optpopup' value='".$ciudades['id_ciudad']."'>".$ciudades['ciudad']."</option>";
    endforeach;
    
    

    echo $html.$htmlciudades;
    
    
    
    	
endif;
?>
