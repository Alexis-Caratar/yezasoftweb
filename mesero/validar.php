<?php
header('HTTP/1.1 200 OK');
header ('Content-Type: application/json;charset=UTF-8');
require_once '../Clases/ConectorBD.php';
$usuario=$_POST['usuario'];
$clave=$_POST['clave'];
$cadenaSQL="select usuario,clave,empleado.identificacion as empleado, empleado.email as correo from usuario, empleado where usuario='$usuario' and clave='$clave' and usuario.empleado = empleado.identificacion;";
$resultado=ConectorBD::ejecutarQuery($cadenaSQL,'yezasoft');

if(count($resultado)>0) {
	$json=array();
	for ($i = 0; $i < count($resultado); $i++) {
		$json[$i]['usuario'] = $resultado[$i]['usuario'];
		$json[$i]['clave'] = $resultado[$i]['clave'];
		$json[$i]['empleado'] = $resultado[$i]['empleado'];
		$json[$i]['correo'] = $resultado[$i]['correo'];
	} echo json_encode($json);
} else echo 'false';
?>