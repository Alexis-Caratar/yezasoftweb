+<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require_once dirname(__FILE__). '/../../Clases/ConectorBD.php';
require_once dirname(__FILE__). '/../../Clases/Cargo.php';

foreach ($_GET as $variable=> $valor) ${$variable}=$valor;

if ($accion=='Modificar') $cargo=new Cargo('idcargo',$idcargo);
else  $cargo=new Cargo(null, null);


?>
<style>
    input.btn-primary{
    position: absolute;
   
  
    }
</style>

<center>
<h2><?= strtoupper($accion)?> CARGO </h2>
<form name="formulariocargo" method="POST" action="PrincipalAdmin.php?CONTENIDOADMIN=Configuracion/Cargos/actualizarcargo.php">
    <table>
        <tr><th>Nombre</th><th><input class="form-control-lg" type="text" name="nombre" value="<?=$cargo->getNombre()?>"placeholder="ingrese cargo" required  autofocus=""maxlength="50"></th></tr>
        <tr><th>Sueldo</th><th><input class="form-control-lg"type="number" name="sueldo" value="<?=$cargo->getSueldo() ?>"placeholder="ingresesueldo" required maxlength="11"></th></tr>
    </table>
    
    <input type="hidden"  name="idcargo"value="<?=$cargo->getIdcargo()?>"
           
     
           <input type="submit"  class="btn btn-primary" name="accion"value="<?=$accion?>">
           <input type="submit"  class="btn btn-primary" name="accion"value="<?=$accion?>">
    
    
</form
</center>