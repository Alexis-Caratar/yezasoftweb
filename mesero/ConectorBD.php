<?php
class ConectorBD {
    private $servidor;
    private $puerto;
    private $controlador;
    private $usuario;
    private $clave;
    private $bd;
    private $conexion;
    
    function __construct() {
        $this->servidor = 'localhost';
        $this->puerto = '3306';
        $this->controlador = 'mysql';
        $this->usuario = 'adsi';
        $this->clave = 'utilizar';
        $this->bd = 'yezasoft';
    }
    
    private function conectar() {
        try {
            $this->conexion = new PDO("$this->controlador:host=$this->servidor;port=$this->puerto;dbname=$this->bd",$this->usuario, $this->clave);
        } catch (PDOException $ex) {
            $this->conexion = null;
            echo $ex->getMessage();
            echo 'Error en la conexion con la base de datos '. $this->bd;
            die();
        }
    }
    
    private function desconectar(){ $this->conexion = null; }
    
    public static function ejecutarQuery($cadenaSQL) {
        global $USUARIO;
        $conector = new ConectorBD();
        $conector->conectar();
        $conector->conexion->query("SET NAMES 'utf8';");
        $sentencia = $conector->conexion->prepare($cadenaSQL);
        $tipoSQL = substr($cadenaSQL, 0, strpos($cadenaSQL, ' '));
        if($tipoSQL!='select') {
            $aplicacion='web';
            if(isset($_POST['aplicacion'])) $aplicacion=$_POST['aplicacion'];
            if($USUARIO->getUsuario()!=null) Auditoria::registrar($USUARIO->getUsuario(), $tipoSQL, $cadenaSQL, $_GET['contenido'], $aplicacion);
        } 
        if ($sentencia->execute()){
            $consulta=$sentencia->fetchAll();
            $sentencia->closeCursor();
            $conector->desconectar();            
            return($consulta);
        } else {
            echo "Error al ejecutar $cadenaSQL";
            $conector->desconectar();
            return(false);
        }
    }
    
    public static function ejecutarQueryAuditoria($cadenaSQL) {
        $conector = new ConectorBD();
        $conector->conectar();
        $conector->conexion->query("SET NAMES 'utf8';");
        $sentencia = $conector->conexion->prepare($cadenaSQL);
        if ($sentencia->execute()){
            $consulta=$sentencia->fetchAll();
            $sentencia->closeCursor();
            $conector->desconectar();            
            return(true);
        } else {
            echo "Error al ejecutar $cadenaSQL";
            $conector->desconectar();
            return(false);
        }
    }
}