<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php 
        //Recibimos las dos variables
$usuario=$_POST["query"];
$password=$_POST["query2"];

$longq = strlen($usuario);
$longq2 = strlen($password);

//echo "Usuario: " . $usuario . " " . "Contraseña: " . $password;

error_reporting(0);

$db_name = "healthyjunio";
$mysql_user = "root";
$mysql_pass = "Joseroot01";
$server_name = "localhost";
$var_res = "";


if (!$longq == 0 && !$longq2 == 0) 
        {

            $con = mysqli_connect($server_name, $mysql_user, $mysql_pass, $db_name);
            if (mysqli_connect_errno()) {
                printf("FALLÓ LA CONEXIÓN: %s\n", mysqli_connect_error());
                exit();
              }

            $sql = "SELECT * FROM administradores WHERE username = '$usuario' AND password = '$password'";
            $result = mysqli_query($con, $sql);

            if(mysqli_num_rows($result) < 1){ // if one or more rows are returned do following


                echo"<script type=\"text/javascript\">alert('USUARIO NO ENCONTRADO O CONTRASEÑA INCORRECTA'); 
                window.location='../index.html';</script>";  
    
     
            }
            else 
            {

                //datos principales del administrador

                $row = $result->fetch_assoc();
                $status = $row["status"];
                $nombre = $row["nombre"];
                $apellido = $row["apellido"];
                $email = $row["email"];
                $id_institucion = $row["instituciones_id_institucion"];
                $id_administrador = $row["id_administrador"];
                $id_pais =$row["paises_id_pais"];
                $id_provincia=$row["provincias_id_provincia"];

                //busqueda de datos adicionales
                
                $sql2 = "SELECT nombre_pais FROM healthyjunio.paises INNER JOIN healthyjunio.administradores ON healthyjunio.administradores.paises_id_pais = healthyjunio.paises.id_pais WHERE username = '$usuario' AND password = '$password'";
                $result2 = mysqli_query($con, $sql2);
                $row2 = $result2->fetch_assoc();
                $pais = $row2["nombre_pais"];
                
                $sql3 = "SELECT instituciones_id_institucion FROM healthyjunio.administradores WHERE 
                username = '$usuario'";
                $result3 = mysqli_query($con, $sql3);
                $row3 = $result3->fetch_assoc();
                $id_institucion = $row3["instituciones_id_institucion"];

                $sql4 = "SELECT provincia FROM healthyjunio.provincias INNER JOIN healthyjunio.administradores ON healthyjunio.administradores.provincias_id_provincia = healthyjunio.provincias.id_provincia WHERE username = '$usuario' AND password = '$password'";
                $result4 = mysqli_query($con, $sql4);
                $row4 = $result4->fetch_assoc();
                $provincia = $row4["provincia"];

                $sql5 = "SELECT ciudad FROM healthyjunio.ciudades INNER JOIN healthyjunio.administradores ON healthyjunio.administradores.ciudades_id_ciudad = healthyjunio.ciudades.id_ciudad WHERE username = '$usuario' AND password = '$password'";
                $result5 = mysqli_query($con, $sql5);
                $row5 = $result5->fetch_assoc();
                $ciudad = $row5["ciudad"];

                $sql6 = "SELECT colegio FROM healthyjunio.instituciones INNER JOIN healthyjunio.administradores ON healthyjunio.administradores.instituciones_id_institucion = healthyjunio.instituciones.id_institucion WHERE username = '$usuario' AND password = '$password'";
                $result6 = mysqli_query($con, $sql6);
                $row6 = $result6->fetch_assoc();
                $institucion = $row6["colegio"];


                session_start();

                //$status = $row["status"];
                $_SESSION['status'] = $status;
                //echo " Estatus: " .  $var_res;
                //$nombre = $row["nombre"];
                $_SESSION['nombre'] = $nombre;
                //echo " Nombre: " .  $var_res;
                //$apellido = $row["apellido"];
                $_SESSION['apellido'] = $apellido;
                //echo " Apellido: " .  $var_res;
                //$email = $row["email"];
                $_SESSION['email'] = $email;
                //echo " Email: " .  $var_res;
                //$id_institucion = $row["instituciones_id_institucion"];
                $_SESSION['id_institucion'] = $id_institucion;
                //echo " ID Institucion: " .  $var_res;
                //$id_administrador = $row["id_administrador"];
                $_SESSION['id_administrador'] = $id_administrador;
                //echo " ID Usuario: " .  $var_res;
                $_SESSION['provincia'] = $id_provincia;
                $_SESSION['ciudad'] = $ciudad;
                //$mensaje = "USUARIO NIVEL NACIONAL: ".$row["username"];

                //$_SESSION['alumno']="usuario: ".$usuario. " - Nivel País: ".$pais;
                //$_SESSION['pais']= " Nivel País: ".$pais;
                
                $_SESSION['pais'] = $id_pais;
                $_SESSION['usuario']=$usuario;
                $_SESSION['institucion']=$institucion;
                /*
                if($usuario == "macgyver")
                {
                    header("Location: ./include/sup/admin.php");
                }
                else
                {
                    header("Location: ./include/admintutor/admin.php");
                }
                */
                
                //versión con menú lateral
                header("Location: principal.php");
                //header("Location: ./include/sup/admin.php");

                exit();
                
                

        }   
} 
else 
{
    echo"<script type=\"text/javascript\">alert('NO SE CARGÓ NINGÚN NOMBRE DE USUARIO O CONTRASEÑA'); 

    window.location='../index.html';</script>";  
}
$conn->close();

?>        
</body>
</html>

