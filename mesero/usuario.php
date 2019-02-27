<?php
header('HTTP/1.1 200 OK');
header ('Content-Type: application/json;charset=UTF-8');
require_once '../Clases/ConectorBD.php';
$idempleado=$_POST['idempleado'];
$cadenaSQL="select usuario,clave,empleado from usuario where usuario='$idempleado'";
print_r($cadenaSQL);
$resultado=ConectorBD::ejecutarQuery($cadenaSQL,'yezasoft');
echo json_encode($resultado);

?>