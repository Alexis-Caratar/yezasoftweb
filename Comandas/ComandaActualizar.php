<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__)."/../Clases/ConectorBD.php";
require_once dirname(__FILE__)."/../Clases/Comandas.php";
require_once dirname(__FILE__)."/../Clases/Facturas.php";

foreach ($_POST as $variable => $valor) ${$variable}=$valor;
foreach ($_GET as $variable=> $valor) ${$variable}=$valor;

switch ($accion){
    case 'Adicionar':
        $factura=new Facturas(null, null);
        $factura->grabar();
        $cadena=ConectorBD::ejecutarQuery("select max(idfactura) from factura ", null);///verificar la factura con el numero de comanda
        $comanda=new Comandas(null, null);
        $comanda->setEmpleado($empleado);
        $comanda->setFecha('current_timestamp');//fecha actual 
        $comanda->setFactura($cadena[0][0]);//fecha actual 
        $comanda->setEstado($estado);
        $comanda->setCaja($idcaja);
        $comanda->grabarComanda();
        break;
  
    case 'Eliminar':
        $comanda=new Comandas(null,null);
        $comanda->setIdcomanda($id);
        $comanda->eliminar();
        break;
}
$filtro="";
if ($acciones=='cerrar')$filtro="&acciones=cerrar&roles=cajero";
header('location: PrincipalAdmin.php?CONTENIDOADMIN=Comandas/comanda.php'.$filtro.'');
?>

