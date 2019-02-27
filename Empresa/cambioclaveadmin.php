<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__). '/../Clases/ConectorBD.php';
require_once dirname(__FILE__). '/../Clases/Usuario.php';




foreach ($_GET as $Variable=> $valor)   ${$Variable}=$valor;
foreach ($_POST as $Variable=> $valor)   ${$Variable}=$valor;

if (isset($_GET['mensaje'])) $mensaje=$_GET['mensaje'];
else $mensaje='';

if (isset($_GET['claveactual'])) $claveactual=$_GET['claveactual'];
else $claveactual='';


if (isset($_GET['clavenueva'])) $clavenueva=$_GET['clavenueva'];
else $clavenueva='';

if (isset($_GET['confirmarclave'])) $confirmarclave=$_GET['confirmarclave'];
else $confirmarclave='';
?>
<div class="container col-md-5"><br>
        <h2>CAMBIO DE CONTRASEÑA </h2>
    <form name="formulario" action="PrincipalAdmin.php?CONTENIDOADMIN=Empresa/actualizarClave.php&usuario=<?=$usuario?>"method="post">
        <table class="table table-hover table-responsive-lg table-content ">
        <font color="red" face="arial"><?= $mensaje?>
        <tr><th>Contraseña Actual</th><th><input class="form-control" type="text" name="claveactual" placeholder="Ingrese contraseña actual" required autofocus value="<?= $claveactual?>"> </th></tr>
        <tr><th>Contraseña nueva</th><th><input  class="form-control"type="text" name="clavenueva" placeholder="Ingrese contraseña nueva" required  value="<?= $clavenueva?>"> </th></tr>
        <tr><th>Confirmar contraseña</th><th><input class="form-control" type="text" name="confirmarclave" placeholder="repita la contraseña actual" value="<?= $confirmarclave?>"required > </th></tr>
        <tr><td></td><td> <input class=" btn btn-primary"type="submit" value="Confirmar"></td></tr>
        </table>
       

    </form>
</div>