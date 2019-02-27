<?php
header('HTTP/1.1 200 OK');
header ('Content-Type: application/json;charset=UTF-8');
require_once '../Clases/ConectorBD.php';
$usuario=$_POST['usuario'];
$cadenaSQL="select identificacion,nombres,apellidos,celular,latitud,longitud,foto FROM caficultor,usuario WHERE identificacion=idcaficultor AND usuario='$usuario'";


$resultado=ConectorBD::ejecutarQuery($cadenaSQL,'yezasoft');
echo json_encode($resultado);
?>