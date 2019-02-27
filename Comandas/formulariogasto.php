<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require_once dirname(__FILE__). '/../Clases/ConectorBD.php';


foreach ($_GET as $variable=> $valor) ${$variable}=$valor;
$datos0="";
$datos1="";
$datos2="";
if ($accion=='Modificar') {
    $cadenasql="select*from gasto where idgastos=$idgasto";
$datos= ConectorBD::ejecutarQuery($cadenasql, null);
$datos0=$datos[0][0];
$datos1=$datos[0][1];
$datos2=$datos[0][2];
print_r($datos);}



?>

<style>
    div.container-fluid{
       margin: 5% 35%;
        width: 80%;
    }
    input.btn-primary{
        margin: 2% 8%;
    }
</style>
<div class="container-fluid">
<h2><?= strtoupper($accion)?> GASTO  DE CAJA <?=$idcaja?></h2>
<form  name="formulariomenu" method="POST" action="PrincipalAdmin.php?CONTENIDOADMIN=Comandas/actualizargasto.php&idcaja=<?=$idcaja?>&accion=<?=$accion?>">
    
    
    <table  >
        <div class="form-group ">
            <tr><th>VALOR</th><th><input type="text" class="form-control input-lg" name="gasto" value="<?=$datos1?>"placeholder="ingrese nombre"  autofocus required maxlength="80"></th></tr>
            <tr><th>DESCRIPCION</th><th><input type="text" class="form-control input-lg" name="descripcion" value="<?=$datos2?>"placeholder="Descripcion"  autofocus required maxlength="80"></th></tr>
            </div> 
    <input    type="hidden" name="idgastos" value="<?=$datos0?>">
    </table>
    <input class="btn btn-primary " type="submit"  name="accion"value="<?=$accion?>">

</form>
</div>
