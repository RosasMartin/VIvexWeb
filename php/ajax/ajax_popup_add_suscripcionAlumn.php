
<?php 
    $file=$_FILES["file"]['tmp_name'];
	require "conexion.php";
    $user = new vivexDB();
    
    
    $fileAlumn = $_FILES['file']; 
    $fileAlumn = file_get_contents($fileAlumn['tmp_name']); 

    $fileAlumn = explode("\n", $fileAlumn);
    $fileAlumn = array_filter($fileAlumn); 
    
    // preparar contactos (convertirlos en array)
    foreach ($fileAlumn as $alumn) 
    {
        $alumnList[] = explode(";", $alumn);
    }
    
    // insertar contactos
    foreach ($alumnList as $alumnData) 
    {   $id_ciudad = intval($alumnData[8]);
        $id_provincia = intval($alumnData[9]);
        $id_pais = intval($alumnData[10]);
        $id_institucion = intval($alumnData[12]);
        
        $table="alumnos (dni, nombre, apellido, genero, fecha_nacimiento, edad, nacionalidad, domicilio, ciudad_alumno, provincia_alumno, pais_alumno, email_tutor, instituciones_id_institucion)";
        $table_verif="alumnos";
        $values="'$alumnData[0]', '$alumnData[1]', '$alumnData[2]', '$alumnData[3]', '$alumnData[4]', '$alumnData[5]', '$alumnData[6]', '$alumnData[7]', '$id_ciudad', '$id_provincia', '$id_pais', '$alumnData[11]', '$id_institucion'";
        if($alumnData[0]!=0){
            $admin=$user->insertar_nonulo($table,$values);
        }
        
        if($alumnData[0]!=0){
            $verifvalue="dni=".$alumnData[0];
            $admin_verif=$user->buscar_valor($table_verif,"dni",$verifvalue);
            
            if($admin_verif){
                echo "true";
            }else{
                echo "false";
            }
            
        }
        
        
        if(strpos($admin,"Duplicate entry")){
            echo"duplicate";
        }
    }
 
    
 
?>


