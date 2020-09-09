<?php 

if(isset($_POST['colegio'])):
    //echo "Error: Ya existe un administrador con el mismo correo";
	require "conexion.php";
    $user = new vivexDB();
   
    //variables generales

    $colegio=$_POST['colegio'];
    $domicilio=$_POST['domicilio'];
    $caracteristica=$_POST['caracteristica'];
    $financiamiento=$_POST['financiamiento'];
    $reisgo_educativo=$_POST['riesgo_educativo'];
    $programa_asistencia=$_POST['programa_asistencia'];
    $ciudades_id_ciudad=$_POST['ciudades_id_ciudad'];
    $tipo=$_POST['tipo'];
    $porcentaje_riesgo=$_POST['porcentaje_riesgo'];


    $verifcolegio=0;
    $instituciones=$user->buscar('instituciones','colegio="'.$_POST['colegio'].'"');
        foreach($instituciones as $instituciones):
           $verifcolegio++;
        endforeach;
    if($verifcolegio!=0){
        echo "Error: Ya existe la institucion";
    }else{
        $table="instituciones (id_institucion, colegio, domicilio, caracteristica, financiamiento, riesgo_educativo, programa_asistencia, otras, latitud_institucion, longitud_institucion, ciudades_id_ciudad, tipo, porcentaje_riesgo)";
        $values="'$colegio', '$domicilio', '$caracteristica', '$financiamiento', '$reisgo_educativo', '$programa_asistencia', ' ', ' ', ' ', '$ciudades_id_ciudad', '$tipo', '$porcentaje_riesgo'";
        $insti=$user->insertar($table,$values);
        if($insti=="true"){
            echo "true";
        }else{
            echo"false";
        }
    }


endif;  
?>