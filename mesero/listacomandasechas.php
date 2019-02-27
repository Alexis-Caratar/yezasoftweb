<?php
header('HTTP/1.1 200 OK');
header ('Content-Type: application/json;charset=UTF-8');
require_once '../Clases/ConectorBD.php';
$idempleado=$_POST['idempleado'];
$cadenaSQL="SELECT idcomanda,idempleado,mesa,fecha,estado,factura, SUM(cantidad*vrunitario)as total FROM comanda,detalleorden WHERE idcomanda=comanda AND idempleado='$idempleado' GROUP by idcomanda,idempleado,mesa,fecha,estado,factura order by fecha desc ";
$resultado=ConectorBD::ejecutarQuery($cadenaSQL,'yezasoft');
echo json_encode($resultado);
//SELECT idcomanda,idempleado,mesa,fecha,estado,factura, SUM(cantidad*vrunitario)as total FROM comanda,detalleorden WHERE idcomanda=comanda AND idempleado='1233194301' GROUP by idcomanda,idempleado,mesa,fecha,estado,factura;
?>
