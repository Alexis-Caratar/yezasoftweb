<?php

require_once dirname(__FILE__). '/../Clases/ConectorBD.php';
require_once dirname(__FILE__). '/../Clases/Reservas.php';
require_once dirname(__FILE__). '/../Clases/Evento.php';
require_once dirname(__FILE__). '/../Clases/Plato.php';
require_once dirname(__FILE__). '/../Clases/Cliente.php';
require_once dirname(__FILE__) . '/../Clases/Menu.php';
require_once dirname(__FILE__). '/../Clases/DetalleOrden.php';

foreach ($_GET as $variable => $valor)
	${$variable} = $valor;
        
$cadenaSQL="select * from empresa";
$nit= ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
$nombreEmpresa= ConectorBD::ejecutarQuery($cadenaSQL, null)[0][1];
$foto= ConectorBD::ejecutarQuery($cadenaSQL, null)[0][6];
$resultados= ConectorBD::ejecutarQuery($cadenaSQL, null);
$cadenaSQL="select*from reserva where idreserva='{$valor}'";
$resultados= ConectorBD::ejecutarQuery($cadenaSQL, null);
$cadenaSQL="select idcomanda,factura from comanda where reserva={$valor}";
$comanda= ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
$factura= ConectorBD::ejecutarQuery($cadenaSQL, null)[0][1];

$lista="";
$lista2="";

for ($i = 0; $i < count($resultados); $i++) {
    $datos=$resultados[$i];
    $cadenaSQL="select*from cliente where identificacion={$datos[9]}";
    $cliente= ConectorBD::ejecutarQuery($cadenaSQL, NULL);
    $lista.="<tr><td>Identificacion: {$datos[9]}</td></tr>";
    $completo=$cliente[0][1]." ".$cliente[0][2];
    $lista.="<tr><td>Nombres: {$completo}</td></tr>";
    $lista.="<tr><td>Telefono: {$cliente[0][3]}</td></tr>";
    $lista.="<tr><td>E-Mail: {$cliente[0][4]}</td></tr>";
}
$cadenaSQL="select now()";
$fecha= ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
$lis="";
$lis.="<tr><td>{$factura} </td><th> Factura</th></tr>";
$lis.="<tr><td>{$fecha} </td><th> Fecha</th></tr>";
$lis.="<tr><td>{$resultados[0][3]} </td><th> Fecha Reserva</th></tr>";  

$cadenaSQL="select*from detalleorden,plato where plato=idplato and comanda={$comanda} and tipo='P'";
$platos= ConectorBD::ejecutarQuery($cadenaSQL, null);
for ($j = 0; $j < count($platos); $j++) {
    $datosplatos=$platos[$j];
    $cadenaSQL="select nombre from plato where idplato={$datosplatos[4]}";
    $nombreplato= ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
    $subt=$datosplatos[2]*$datosplatos[6];
    $lista2.="<tr><td>{$datosplatos[2]}</td><td>{$nombreplato}</td><td>{$datosplatos[6]}</td><td>$subt</td></tr>";
}
$cadenaSQL="select sum(vrunitario*cantidad) from detalleorden,plato where plato=idplato and comanda={$comanda} and tipo='P'";
$total= ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
$lista2.="<tr><td colspan='3'>Total</td><td>{$total}</td></tr>";

$lista3="";
$cadenaSQL="select*from detalleorden,plato where plato=idplato and comanda={$comanda} and tipo='S'";
$platos= ConectorBD::ejecutarQuery($cadenaSQL, null);
for ($j = 0; $j < count($platos); $j++) {
    $datosplatos=$platos[$j];
    $cadenaSQL="select nombre from plato where idplato={$datosplatos[4]}";
    $nombreplato= ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
    $subt=$datosplatos[2]*$datosplatos[6];
    $lista3.="<tr><td>{$datosplatos[2]}</td><td>{$nombreplato}</td><td>{$datosplatos[6]}</td></tr>";
}
$cadenaSQL="select sum(vrunitario*cantidad) from detalleorden,plato where plato=idplato and comanda={$comanda} and tipo='S'";
$total= ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
$cadenaSQL="select sum(vrunitario*cantidad) from detalleorden where comanda={$comanda}";
$totals= ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
$lista3.="<tr><td colspan='2'>Total</td><td>{$total}</td></tr>";
?>
<style >
    
    tr:hover{
        background: white;
    }
</style>
<center onclick="imprimir()">
    <br><h2>FACTURA</h2><br><br>
    
    <img src="<?=$foto?>" width='100' height='100' style='border-radius: 40px;margin-top: 0%;margin-left:-2%;position: absolute'>
    
    <table style="margin-top: -2%;margin-left: -45%" border="1">
        <tr>
            <th>
                <tr><th colspan="1"><h6 class="text-center">Datos Del Cliente</h6></th></tr>
                <?=$lista?>
            </th>
        </tr>
    </table>
    <table style="margin-top: -6%;margin-left: 46%;text-align: right" border="1">
        <tr>
            <th>
                <?=$lis?>
            </th>
        </tr>
    </table>
    <hr style="background: black;width: 65%">
    <table class="table-condensed" style="width: 65%;text-align: center" border="1">
        <tr>
            <td>
                <table class="table">
                    <tr><th colspan="4"><h6 class="text-center">Lista De Platos</h6></th></tr>
                    <tr>
                        <th>Cantidad</th><th>Plato</th><th>Valor</th><th>Subtotal</th>
                    </tr>
        <?=$lista2?>
                </table>
            </td>
        <tr>
            <td>
                <table class="table">
                    <tr><th colspan="3" style="font-size: 25px"><h6 class="text-center"><b>Servicios</b></h6></th></tr>
                    <tr><th>N°</th><th>Nombre</th><th>Valor</th></tr>
                    <?=$lista3?>
                </table>
            </td>
        </tr>
        </tr>
    </table>
    <h3>
        Total: <?=$totals?>
    </h3><br>
</center>
<script>
    function imprimir(){
        print();
    }
</script>