<?php
header('HTTP/1.1 200 OK');
header ('Content-Type: application/json;charset=UTF-8');
require_once '../Clases/ConectorBD.php';
$mesero=$_POST['mesero'];
$mesa=$_POST['idmesa'];
//print_r($_POST); die();
$cadenaSQL="insert into factura (fecha,empresa) values(current_timestamp,'123')";
$resultado=ConectorBD::ejecutarQuery($cadenaSQL,'yezasoft');

$cadenaSQL="select  max(idfactura) as factura from factura";
$resultado1=ConectorBD::ejecutarQuery($cadenaSQL,'yezasoft');
	  $resultadores=$resultado1[0][0];
	  //complementar esta linea
	  $cadenaSQL="select  max(idcaja) as caja from caja";
$resultado2=ConectorBD::ejecutarQuery($cadenaSQL,'yezasoft');
	  $resultadores2=$resultado2[0][0];
	  //complementar esta linea
	  
	   $cadenaSQL="INSERT INTO comanda(idempleado,mesa, fecha, estado, factura,caja) VALUES('$mesero',$mesa,current_timestamp,'P',$resultadores,$resultadores2)" ;
      $resultado=ConectorBD::ejecutarQuery($cadenaSQL,'yezasoft');
	  
	  
	  $cadenaSQL="select  max(idcomanda) as comanda from comanda";
		$resultado1=ConectorBD::ejecutarQuery($cadenaSQL,'yezasoft');

	  $resultadores=$resultado1[0][0];
	  
	  $platosjson=json_decode($_POST['platosJSON']);
	  for ($i = 0; $i < count($platosjson); $i++) {
		  $cadenaSQL="insert into detalleorden (comanda,cantidad,plato,vrunitario) values('$resultadores','{$platosjson[$i]->cantidad}', '{$platosjson[$i]->idplato}', '{$platosjson[$i]->valor}');";
		$resultado=ConectorBD::ejecutarQuery($cadenaSQL,'yezasoft');
	  }
	  
?>