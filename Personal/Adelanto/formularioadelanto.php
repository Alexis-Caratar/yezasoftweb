<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once dirname(__FILE__).'/../../Clases/Empleado.php';
require_once dirname(__FILE__).'/../../Clases/Adelanto.php';
require_once dirname(__FILE__).'/../../Clases/ConectorBD.php';

foreach ($_GET as $Variable=> $Valor) ${$Variable}=$Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable}=$Valor;

if ($accion=='Modificar') $adelanto=new Adelanto('idadelanto', $idadelanto);
else $adelanto=new Adelanto(null, null);

?> 
<div class="container"><br>
    <h2 class="text-center"><?= strtoupper($accion)?> ADELANTO</h2>
    <div class="col-lg-5">
    <table class="table table-hover table-striped">
    <tr><th>Identificacion</th><td><?= $idempleado?></td></tr>
    <tr><th>Nombre Completo</th><td><?= $nombres?> </td></tr>
    <tr><th>Telfono</th><td><?= $telefono?></td></tr>
    <tr><th>Email</th><td><?= $email?></td></tr>
</table>
        </div>
<br>
<H4>Fecha del Adelanto: <?=$adelanto->getFecha()?></H4>





<center>
<div class="col-lg-5 form-control ">
<center>
    <form name="formulario" action="PrincipalAdmin.php?CONTENIDOADMIN=Personal/Adelanto/actualizaradelanto.php&accion=<?=$accion?>&idempleado=<?=$idempleado?>&nombres=<?=$nombres?>&apellidos=<?=$apellidos?>&telefono=<?=$telefono?>&email=<?=$email?>&fecha=<?=$adelanto->getFecha()?> " method="post">
        <table class="table table-hover">
    <tr><th>VALOR</th><th><input  class="form-control"type="number" placeholder="ingrese el valor" name="valor" value="<?= $adelanto->getValor()?>" autofocus required> </th></tr>
    
</table >
    
<input  type="hidden" name="idadelanto" value="<?=$adelanto->getIdadelanto()?>">
    <input  class="btn btn-primary" type="submit" value="<?=$accion?>">
    
    </form>
</center>
    </div>
    </center>
</div>