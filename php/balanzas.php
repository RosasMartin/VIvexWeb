<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vivex</title>

    <!-- CSS Styles -->
    <link href="https://necolas.github.io/normalize.css/8.0.1/normalize.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/balanzas.css">


    <!-- PHP session -->
    <?php 
        session_start();
        //Recibimos las variables
        
        //Recibimos información del Administrador
        
        $nombre = $_SESSION['nombre'];
        $apellido = $_SESSION['apellido'];
        $status = $_SESSION['status'];
        $email = $_SESSION['email'];
        
        $usuario = $_SESSION['usuario'];
        $id_institucion = $_SESSION['id_institucion'];
        $id_administrador = $_SESSION['id_administrador'];
        $institucion = $_SESSION['institucion'];
        
        $pais = $_SESSION['pais'];
        $provincia = $_SESSION['provincia'];
        $ciudad = $_SESSION['ciudad'];

        if($nombre==null){
            session_destroy();
            header("Location:../index.html");

        }
        
        error_reporting(0);
        
        //iniciamos sesion en la base de datos
        
        
        //$db_name = "healthyjunio";
        //$mysql_user = "root";
        //$mysql_pass = "Joseroot01";
        //$server_name = "localhost";
        //$var_res = "";
        //$conexion=mysqli_connect($server_name,$mysql_user,$mysql_pass,$db_name);
    

        //consultamos Provincias, ciudades e intituciones disponibles de acuerdo al valor "status"
        

    ?>


</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="links">
            <a href="http://www.arconsultores.com.ar/">
                <img src="../img/ARConsultores.png" alt="AR logo">
            </a>
        
            <a href="http://www.sanjuan.gov.ar/">
                <img src="../img/SanJuan.png" alt="logo san juan">
            </a>
        </div>
        <div class="barra">
            <ul class="nav">
                <li><a href="#">Configuraciones</a>
                    <ul>
                        <li><a href="#">Agregar Administrador</a></li>
                        <li><a href="#">Agregar Instituciones</a></li>
                        <li><a href="#">Agregar Alumnos</a></li>
                        <li><a href="balanzas.php">Balanzas</a></li>
                    </ul>
                </li>
                <li><a href="#">Búsqueda</a></li>
                <li><a href="#">Mapas</a></li>
                <li><a href="#">Comparativas</a></li>
                <li><a href="../php/principal.php">Inicio</a></li>
            </ul>
        </div>
    </header>
    <!-- End Header -->
    
    <!-- Main -->
    <main>
        <!-- Estado de las balanzas -->
        <div class="indicadores-busqueda-resultado">
                <div class="indicadores-sexo">
                    <img src="../img/indicador_femenino.png" alt="indicador femenino img">
                    <p id="gf">0</p>
                    <img src="../img/indicador_masculino.png" alt="indicador femenino img">
                    <p id="gm">0</p>
                </div>
                <div class="total-alumnos">
                    <p>Total de Alumnos:</p>
                    <p id="totalalumnos">0</p>
                </div>
            </div>
        <!-- End Estado de las balanzas -->
    </main>
    <!-- End MAin -->

    <!-- Footer -->
    <footer class="footer">
        <p>Copyright © Sistema Vivex 2020 - Todos los derechos reservados</p>
    </footer>
    <!-- End Footer-->


</body>
</html>