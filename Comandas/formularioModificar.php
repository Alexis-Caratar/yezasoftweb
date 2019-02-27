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
    case 'Modificar':
        $factura=new Facturas(null, null);
        $factura->setIdfactura($facturas);
        $factura->setIdentificaioncliente($nombres);
        $factura->setDescuento($descuentos);
        $factura->setTotal($totales);
        $factura->modificardos();
        break;      
}

