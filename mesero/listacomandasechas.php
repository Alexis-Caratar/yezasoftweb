<?php
header('HTTP/1.1 200 OK');
header ('Content-Type: application/json;charset=UTF-8');
require_once '../Clases/ConectorBD.php';

$idempleado=$_POST['idempleado'];
$cadenaSQLcaja="SELECT MAX(idcaja) FROM caja";
	$datoscaja= ConectorBD::ejecutarQuery($cadenaSQLcaja, 'yezasoft');
	$caja=$datoscaja[0][0];
	
$cadenaSQL="SELECT idcomanda,idempleado,mesa,fecha,estado,factura, SUM(cantidad*vrunitario)as total FROM comanda,detalleorden WHERE idcomanda=comanda and caja=$caja AND idempleado='$idempleado' GROUP by idcomanda,idempleado,mesa,fecha,estado,factura order by fecha desc ";
$resultado=ConectorBD::ejecutarQuery($cadenaSQL,'yezasoft');

$resultadofinal=array();
for($i=0;$i<count($resultado);$i++){
	$mesainicial=$resultado[$i][2];
	
	$cadenaSQL2="SELECT mesainicial FROM mesa where idmesa=$mesainicial";
	$resultado2=ConectorBD::ejecutarQuery($cadenaSQL2,'yezasoft');
	
	$resultadofinal[$i]['idcomanda']=$resultado[$i]['idcomanda'];
	$resultadofinal[$i]['idempleado']=$resultado[$i]['idempleado'];
	$resultadofinal[$i]['mesa']=$resultado2[0][0];
	$resultadofinal[$i]['fecha']=$resultado[$i]['fecha'];
	$resultadofinal[$i]['estado']=$resultado[$i]['estado'];	
	$resultadofinal[$i]['factura']=$resultado[$i]['factura'];	
	$resultadofinal[$i]['total']=$resultado[$i]['total'];	

	
}

echo json_encode($resultadofinal);

//SELECT idcomanda,idempleado,mesa,fecha,estado,factura, SUM(cantidad*vrunitario)as total FROM comanda,detalleorden WHERE idcomanda=comanda AND idempleado='1233194301' GROUP by idcomanda,idempleado,mesa,fecha,estado,factura;
?>
