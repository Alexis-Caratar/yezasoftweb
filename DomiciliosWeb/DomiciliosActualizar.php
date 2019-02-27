<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//importacion de las clases que se requieren para este programa.
?>
<br><br>
<?php
require_once dirname(__FILE__) . '/../Clases/ConectorBD.php';
require_once dirname(__FILE__) . '/../Clases/Domicilio.php';

foreach ($_GET as $variable => $valor)
	${$variable} = $valor;
        
foreach ($_POST as $Variable => $Valor) {
	${$Variable} = $Valor;
}
$cadenaSQL="select idplato from plato limit 1";
$idplato= ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
$cadenaSQL="select nit from empresa";
$empresa= ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
$cadenaSQL="insert into factura (fecha,identificacioncliente,empresa) values(current_timestamp,'{$valor}','{$empresa}')";
ConectorBD::ejecutarQuery($cadenaSQL, null);
$cadenaSQL="select max(idfactura) from factura where identificacioncliente='{$valor}'";
$factura= ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];

$si=new Domicilio(null,null);
		  $si->setIdplato($idplato);
		  $si->setFechadomicilio($fechadomicilio);
		  $si->setHora($hora);
		  $si->setDireccion($direccion);
                  $si->setBarrio($barrio);
		  $si->setIdentificacioCliente($identificacioncliente);
                  $si->grabarWeb();
                  
$cadenaSQL="select max(iddomicilio) from domicilio";
$id= ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];

$cadenaSQL="insert into comanda (fecha,estado,domicilio,factura) values(current_timestamp,'P',$id,$factura)";
ConectorBD::ejecutarQuery($cadenaSQL, null);

$cadenaSQL="select max(idcomanda) from comanda";
$comanda= ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];

$datos = $_POST['datosPlatosTablaActualizar'];
$listaPlatos = "";


$cadenaSQL="fecha,identificacioncliente,empresa";
$arrayPlatos = explode("||", $datos);
for ($i = 0; $i < count($arrayPlatos); $i++) {
    $datosPlato = explode("|", $arrayPlatos[$i]);
    $subTotal = $datosPlato[1] * $datosPlato[2];
    $cadenaSQL="select idplato from plato where nombre='$datosPlato[0]'";
    $ids= ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
    $listaPlatos .= "<tr>";
    $listaPlatos .= "<td>$ids</td><td>$datosPlato[0]</td><td>$datosPlato[1]</td><td>$datosPlato[2]</td><td>$subTotal</td>";
    $listaPlatos .= "</tr>";
    $cadenaSQL="insert into detalleOrden(comanda, cantidad, plato, domicilio, vrUnitario)values($comanda,$datosPlato[2],'$ids',$id,$datosPlato[1])";
    ConectorBD::ejecutarQuery($cadenaSQL, null);
    
}
?>
<script type="text/javascript">
    confirm("Domicilio Registrado Correctamente");
    location = 'index.php?CONTENIDO=DomiciliosWeb/Domicilios.php';
    </script>
