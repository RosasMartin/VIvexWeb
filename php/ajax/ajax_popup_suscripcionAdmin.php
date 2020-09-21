<?php 

if(isset($_POST['status'])):
    //echo "Error: Ya existe un administrador con el mismo correo";
	require "conexion.php";
    $user = new vivexDB();
   
    //variables generales

    $status=$_POST['status'];
    $nombre=$_POST['nombre'];
    $apellido=$_POST['apellido'];
    $username=$_POST['username'];
    $password=$_POST['password'];
    $email=$_POST['email'];
    $paises_id_pais=$_POST['paises_id_pais'];
    $provincias_id_provincias=$_POST['provincias_id_provincia'];
    $ciudades_id_ciudad=$_POST['ciudades_id_ciudad'];
    $instituciones_id_institucion=$_POST['instituciones_id_institucion'];
    $id_contrato=$_POST['id_contrato'];


    $verifEmail=0;
    $administradores=$user->buscar('administradores','email="'.$_POST['email'].'"');
        foreach($administradores as $administradores):
           $verifEmail++;
        endforeach;
    if($verifEmail!=0){
        echo "Error: Ya existe un administrador con el mismo correo";
    }else{
        $table="administradores (id_administrador, status, nombre, apellido, username, password, email, paises_id_pais, provincias_id_provincia, ciudades_id_ciudad, instituciones_id_institucion, id_contrato)";
        $values="'$status', '$nombre', '$apellido', '$email', '$password', '$email', '$paises_id_pais', '$provincias_id_provincias', '$ciudades_id_ciudad', '$instituciones_id_institucion', '$id_contrato'";
        $admin=$user->insertar($table,$values);
        if($admin=="true"){
            echo "true";
        }else{
            echo"false";
        }
    }


endif;  
?>