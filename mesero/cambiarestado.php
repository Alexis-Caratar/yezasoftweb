<?php
header('HTTP/1.1 200 OK');
header ('Content-Type: application/json;charset=UTF-8');
require_once '../Clases/ConectorBD.php';
$idcomanda=$_POST['idcomanda'];

$cadenaSQL="update comanda set estado='E' where idcomanda='$idcomanda'";
$resultado=ConectorBD::ejecutarQuery($cadenaSQL,'yezasoft');
?>