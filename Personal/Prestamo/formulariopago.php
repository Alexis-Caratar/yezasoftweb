 <?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require_once dirname(__FILE__).'/../../Clases/Empleado.php';
require_once dirname(__FILE__).'/../../Clases/Prestamo.php';
require_once dirname(__FILE__).'/../../Clases/Pago.php';
require_once dirname(__FILE__).'/../../Clases/ConectorBD.php';

foreach ($_GET as $Variable=> $Valor) ${$Variable}=$Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable}=$Valor;


if ($accion=='Modificar') $pagoprestamo=new Pago('idpago', $idpago);
else $pagoprestamo=new Pago(null, null);

if ($accion=='Modificar')$cuotas=$contadorcoutas;
else {
$cuotas=$contadorcoutas;
}


?><div class="container "><br>
    <h2 class="text-center"><?= strtoupper($accion)?> PAGO DE PRESTAMO</h2><br>
    <div class="col-lg-5">
<table class="table table-striped table-hover">
    <tr><th>Nombre</th><td><?= $idempleado?></td></tr>
    <tr><th>Nombre Completo</th><td><?= $nombres?> </td></tr>
    <tr><th>Telfono</th><td><?= $telefono?></td></tr>
    <tr><th>Email</th><td><?= $email?></td></tr>
    <tr><th>CUOTAS</th><td><?= $cuotas?></td></tr>
    
</table>
        </div>
<br>
<h4>FECHA DEL PAGO:  <?=$pagoprestamo->getFecha()?> </h4>  


<center>
    
    <div class="col-lg-5">
<form name="formulario" action="PrincipalAdmin.php?CONTENIDOADMIN=Personal/Prestamo/actualizarpago.php&accion=<?=$accion?>&idprestamo=<?=$idprestamo?>&idpago=<?=$pagoprestamo->getIdpago()?>&idempleado=<?=$idempleado?>&&nombres=<?=$nombres?>&apellidos=<?=$apellidos?>&telefono=<?=$telefono?>&email=<?=$email?> &fecha=<?=$pagoprestamo->getFecha()?> " method="post">
    <table>

        <tr><th>VALOR </th><th><input class="form-control" type="number"required name="valor" value="<?=$pagoprestamo->getValor()?>" autofocus></th></tr>
    
   </table>
    <br>
    <input class="btn btn-primary" type="submit" value="<?=$accion?>">
</form>
        </div>
</center>
</div> 

