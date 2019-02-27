<?php
header('HTTP/1.1 200 OK');
header ('Content-Type: application/json;charset=UTF-8');
require_once '../Clases/ConectorBD.php';

$estado=$_POST['mesas'];

if($estado=="disponibles"){
	//estado de las mesas disponibles
	
	$cadenaSQL="select idmesa,area,color,mesainicial,piso from comanda,mesa where idmesa=mesa and estado<>'' group by idmesa  ";
	$datos1= ConectorBD::ejecutarQuery($cadenaSQL, 'yezasoft');
	$cadena="SELECT * FROM mesa WHERE mesainicial NOT IN (";
	$coma=",";
for ($p = 0; $p < count($datos1); $p++) {
    $cadena.=" {$datos1[$p][3]}$coma";
}
$cadena.="0)";

$resultado=ConectorBD::ejecutarQuery($cadena,'yezasoft');
echo json_encode($resultado);
	
}
else{
	//estado de las mesas ocupadas
	$cadenaSQL="select idmesa,area,color,mesainicial,piso from comanda,mesa where idmesa=mesa and estado='P'  group by mesainicial;";
$resultado=ConectorBD::ejecutarQuery($cadenaSQL,'yezasoft');
echo json_encode($resultado);
}



?>