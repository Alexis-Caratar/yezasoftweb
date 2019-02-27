<?php
header('HTTP/1.1 200 OK');
header ('Content-Type: application/json;charset=UTF-8');
require_once '../Clases/ConectorBD.php';
$cadenaSQL="select idmenu,nombre from menu;";
$resultado=ConectorBD::ejecutarQuery($cadenaSQL,'yezasoft');
$resultadofinal=array();
for($i=0;$i<count($resultado);$i++){
	$resultadofinal[$i]['idmenu']=$resultado[$i]['idmenu'];
	$resultadofinal[$i]['nombre']=$resultado[$i]['nombre'];
}
echo json_encode($resultadofinal);

?>