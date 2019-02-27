<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



require_once dirname(__FILE__).'/../../Clases/Empleado.php';
require_once dirname(__FILE__).'/../../Clases/Prestamo.php';
require_once dirname(__FILE__).'/../../Clases/ConectorBD.php';

foreach ($_GET as $Variable=> $Valor) ${$Variable}=$Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable}=$Valor;

if ($accion=='Modificar') $prestamo=new Prestamo('idprestamo', $idprestamo);
else $prestamo=new Prestamo(null, null);



?> 
<div class="container">
    <br>
    <h2 class="text-center"><?= strtoupper($accion)?> PRESTAMO</h2><br>
<div class="col-lg-5">

<table class="table table-hover table-striped">
    <tr><th>Nombre</th><td><?= $idempleado?></td></tr>
    <tr><th>Nombre Completo</th><td><?= $nombres?> </td></tr>
    <tr><th>Telfono</th><td><?= $telefono?></td></tr>
    <tr><th>Email</th><td><?= $email?></td></tr>
</table>
    </div>

<br>
<h4 >FECHA DEL PRESTAMO</h4>  <?=$prestamo->getFecha()?>

<center>
<div class="col-lg-5">
    <form name="formulario" action="PrincipalAdmin.php?CONTENIDOADMIN=Personal/Prestamo/actualizarprestamo.php&accion=<?=$accion?>&idempleado=<?=$idempleado?>&idprestamo=<?=$prestamo->getIdprestamo()?>&nombres=<?=$nombres?>&apellidos=<?=$apellidos?>&telefono=<?=$telefono?>&email=<?=$email?>&fecha=<?=$prestamo->getFecha()?> " method="post">
        <table class="table table-hover">
            <tr><th>VALOR PRESTAMO</th><th><input class="form-control" type="number" placeholder="ingrese el valor"required name="valor" value="<?= $prestamo->getValor()?>"> </th></tr>
            <tr><th>INTERES</th><th><input type="number" class="form-control" placeholder="Interes" name="interes" required value="<?= $prestamo->getInteres()?>"> </th></tr>
    <tr><th>CUOTAS</th><th><input type="number" class="form-control" placeholder="coutas" name="cuota" required value="<?= $prestamo->getCuota()?>"> </th></tr>
  </table>
        <input class="btn btn-primary"type="submit" value="<?=$accion?>">
    </form>
    </div>
    </center>
</div>