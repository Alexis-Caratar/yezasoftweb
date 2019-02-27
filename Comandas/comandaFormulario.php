<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once dirname(__FILE__)."/../Clases/ConectorBD.php";
require_once dirname(__FILE__)."/../Clases/Comanda.php";
//por el metodo que trae
foreach ($_GET as $variable => $valor) ${$variable}=$valor;
if($accion=='Modificar') $comanda=new Comanda('idcomanda', $idcomanda);
else $comanda=new Comanda (null, null);
?>
<div>
    <h2><?=strtoupper($accion)?>Comanda</h2>
    <form name="comandaFormulario" method="POST" action="PrincipalAdmin.php?CONTENIDOADMIN=Comanda/ComandaActualizar.php&idcaja=<?=$idcaja?>">
        <table>
            <tr><th>Empleado</th><th><input type="text" name="empleado" value="<?= $comanda->getEmpleado()?>"></th></tr>
            <tr><th>Mesa</th><th><input type="text" name="mesa" value="<?= $comanda->getMesa()?>" ></th></tr>
            <tr><th>Fecha</th><th><input type="datetime" name="fecha" value="<?= $comanda->getFecha()?>"></th></tr>
            <tr><th>Estado</th><th><input type="text" name="estado" value="<?= $comanda->getEstado()?>"></th></tr>
            <tr><th>Reserva</th><th><input type="text" name="reserva" value="<?= $comanda->getReserva()?>"></th></tr>
            <tr><th>factura</th><th><input type="number" name="numFactura" value="<?= $comanda->getFactura()?>"></th></tr>
        </table>
        <input type="hidden" name="idcomanda" value="<?= $comanda->getIdcomanda()?>">
        <input type="submit" name="accion" value="<?= $accion?>">
        
    </form>
</div>