<?php 
    class vivexDB{    
        private $host   ="localhost";
        private $usuario="root";
        private $clave  ="Joseroot01";
        private $db     ="healthyjunio";
        public $conexion;
        public function __construct(){
            $this->conexion = new mysqli($this->host, $this->usuario, $this->clave,$this->db);
            $this->conexion->set_charset("utf8");
        }

        //INSERTAR
        public function insertar($tabla, $datos){
            $resultado =    $this->conexion->query("INSERT INTO $tabla VALUES (null,$datos)") or die($this->conexion->error);
            if($resultado)
                return true;
            return false;
        }

        //INSERTAR NO NULO
        public function insertar_nonulo($tabla, $datos){
            $resultado =    $this->conexion->query("INSERT INTO $tabla VALUES ($datos)") or die($this->conexion->error);
            if($resultado)
                return true;
            return false;
        }

        //BORRAR
        public function borrar($tabla, $condicion){    
            $resultado  =   $this->conexion->query("DELETE FROM $tabla WHERE $condicion") or die($this->conexion->error);
            if($resultado)
                return true;
            return false;
        }

        //ACTUALIZAR
        public function actualizar($tabla, $campos, $condicion){    
            $resultado  =   $this->conexion->query("UPDATE $tabla SET $campos WHERE $condicion") or die($this->conexion->error);
            if($resultado)
                return true;
            return false;        
        }

        //BUSCAR
        public function buscar($tabla, $condicion){
            $resultado = $this->conexion->query("SELECT * FROM $tabla WHERE $condicion") or die($this->conexion->error);
            if($resultado)
                return $resultado->fetch_all(MYSQLI_ASSOC);
            return false;
        } 

        //BUSCAR Maximo
        public function buscar_maximo($tabla, $condicion){
            $resultado = $this->conexion->query("SELECT * FROM $tabla WHERE $condicion AND id_medicion=(select max(id_medicion) from alumnos_salud where $condicion)") or die($this->conexion->error);
            if($resultado)
                return $resultado->fetch_all(MYSQLI_ASSOC);
            return false;
        } 

        //BUSCAR Maximo
        public function buscar_atras($tabla, $condicion,$condicion2){
            $resultado = $this->conexion->query("SELECT  * FROM $tabla WHERE alumnos_dni=$condicion AND tiempo_unix_UTC < $condicion2 order by id_medicion desc limit 1;") or die($this->conexion->error);
            if($resultado)
                return $resultado->fetch_all(MYSQLI_ASSOC);
            return false;
        }
        //BUSCAR Maximo
        public function buscar_atras2($tabla, $condicion,$condicion2){
            $resultado = $this->conexion->query("SELECT  * FROM $tabla WHERE alumnos_dni=$condicion AND tiempo_unix_UTC < $condicion2 order by id_medicion desc limit 1;") or die($this->conexion->error);
            if($resultado)
                return $resultado->fetch_all(MYSQLI_ASSOC);
            return false;
        }  

        //BUSCAR Institucion
        public function buscar_valor($tabla, $valor, $condicion){
            $resultado = $this->conexion->query("SELECT $valor FROM $tabla WHERE $condicion") or die($this->conexion->error);
            if($resultado)
                return $resultado->fetch_all(MYSQLI_ASSOC);
            return false;
        } 
    }
?>