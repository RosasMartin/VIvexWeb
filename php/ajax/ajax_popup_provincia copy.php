
<?php 

if(isset($_POST['id_pais'])):

	require "conexion.php";
    $user = new vivexDB();
    //echo $_POST['id_institucion']; 
    //echo $_POST['id_ciudad'];
    //echo $_POST['id_provincia'];
    //echo $_POST['id_pais'];
    //echo $_POST['id_contrato'];
    $idpais=$_POST['id_pais'];
    //Admin
    //Insti
    //Alumn
    $html="<option id='null' value='0';'>Provincia</option>";
    $provincias="";
    $htmlprovincias="";
        
    
?>

<?php
    $provincias=$user->buscar('provincias',"paises_id_pais in(".$idpais.")");
    foreach($provincias as $provincias):
        $htmlprovincias.="<option id='provincia_optpopup' value='".$provincias['id_provincia']."'>".$provincias['provincia']."</option>";
    endforeach;
    
    

    echo $html.$htmlprovincias;
    
    
    
    	
endif;
?>
