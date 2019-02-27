<?php
header('HTTP/1.1 200 OK');
header ('Content-Type: application/json;charset=UTF-8');
require_once '../Clases/ConectorBD.php';
$usuario=$_POST['usuario'];
$cadenaSQL="select usuario,clave,correo from usuario where usuario='$usuario' ";
$resultado=ConectorBD::ejecutarQuery($cadenaSQL,'yezasoft');
echo json_encode($resultado);
?>