<?php
header('HTTP/1.1 200 OK');
header ('Content-Type: application/json;charset=UTF-8');
require_once '../Clases/ConectorBD.php';
$filtro = '';
if(isset($_POST['idmenu'])) $filtro = " and menu = {$_POST['idmenu']}";
$cadenaSQL="select idplato,nombre,descripcion,valor,foto from plato where  tipo='P'$filtro;";
$resultado=ConectorBD::ejecutarQuery($cadenaSQL,'yezasoft');
$resultadofinal=array();
for($i=0;$i<count($resultado);$i++){
	$resultadofinal[$i]['idplato']=$resultado[$i]['idplato'];
	$resultadofinal[$i]['nombre']=$resultado[$i]['nombre'];
	$resultadofinal[$i]['descripcion']=$resultado[$i]['descripcion'];
	$resultadofinal[$i]['valor']=$resultado[$i]['valor'];
	$resultadofinal[$i]['foto']=$resultado[$i]['foto'];	
	
}
echo json_encode($resultadofinal);

?>