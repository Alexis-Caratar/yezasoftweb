+<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require_once dirname(__FILE__). '/../../Clases/ConectorBD.php';
require_once dirname(__FILE__). '/../../Clases/Cliente.php';

foreach ($_GET as $variable=> $valor) ${$variable}=$valor;

if ($accion=='Modificar') $reserva=new Cliente('identificacion',$identificacion);
else  $reserva=new Cliente(null, null);


?>
<div id="Formulario">
<center>
<h2><?= strtoupper($accion)?> CLIENTE </h2>
<form name="formularioevento" method="POST" action="PrincipalAdmin.php?CONTENIDOADMIN=Configuracion/Clientes/ClienteActualizar.php" enctype="multipart/form-data">
    <table>
        <tr><th>Identificacion</th><th><input type="text" name="identificacion" value="<?=$reserva->getIdentificacion()?>"placeholder="Ingrese Su Identificacion" required></th></tr>
        <tr><th>Nombres</th><th><input type="text" name="nombres" value="<?=$reserva->getNombres()?>"placeholder="Ingrese Nombres" required maxlength="15"></th></tr>
        <tr><th>Apellidos</th><th><input type="text" name="apellidos" value="<?=$reserva->getApellidos()?>"placeholder="Ingrese Sus Apellidos" required maxlength="15"></th></tr>
        <tr><th>Telefono</th><th><input type="tel" name="telefono" value="<?=$reserva->getTelefono() ?>" placeholder="N° De Telefono" required height="20000"/></th></tr>
        <tr><th>E-Mail</th><th><input type="email" name="emails" value="<?=$reserva->getEmails() ?>" placeholder="pepesuarez@gmail.com" required height="20000"/></th></tr>
        <tr><th>Clave</th><th><input type="password" name="clave" value="<?=$reserva->getClave() ?>" placeholder="******" required height="20000"/></th></tr>
    </table>
    <input type="submit"  name="accion"value="<?=$accion?>" id="accion">
    <input type="hidden"  identificacion="<?=$reserva->getIdentificacion()?>" id="accion">
</form>
</center>
    </div>

