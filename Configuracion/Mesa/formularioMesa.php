<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once dirname(__FILE__). '/../../Clases/ConectorBD.php';
require_once dirname(__FILE__).'/../../Clases/Mesa.php';
foreach ($_GET as $variable=>$valor) ${$variable}=$valor;
$formulariolista="";
if ($accion=='Modificar'){ $mesa=new Mesa('idmesa', $idmesa);
 
$formulariolista.="<tr><th>Area </th><th><input type='text' name='area' value='{$mesa->getArea()}' required='' ></th></tr>";
$formulariolista.="<tr><th>NUMERO DE MESA </th><th><input type='number' name='mesainicial' value='{$mesa->getMesainicial()}' required='' ></th></tr>";
$formulariolista.="<tr><th>color</th><th><input type='color' name='color' value='{$mesa->getColor()}' required='' ></th></tr>";
$formulariolista.="<tr><th>piso</th><th><input type='number' name='piso' value='{$mesa->getPiso()}' required='' placeholder='piso'></th></tr>";


} else {
    $mesa=new Mesa(null, null);
  
    $formulariolista.='<tr><th>AREA</th><th><input  type="text" name="area"  required="" placeholder="ingrese el nombre de la area"></th></tr>
        <tr><th>COLOR</th><th><input type="color" name="color" required="" placeholder="ingrese el color de la area"></th></tr>
        <tr><th>NUMERO DE MESA INICIAL</th><th><input type="number" name="mesainicial"  required="" placeholder="ingrese el numero de mesa inicial"></th></tr>
        <tr><th>NUMERO DE MESAS FINAL</th><th><input type="number" name="numeromesa" required="" placeholder="ingrese el numero de mesas "></th></tr>
        <tr><th>NUMERO DE PISO</th><th><input type="number" name="piso" required="" placeholder="ingrese el piso"></th></tr>   
            ';
}
?><br>
    <div class="container">
        <h2><?=strtoupper($accion)?> MESA</h2><br>
<form name="formularioMesa" method="post" action="PrincipalAdmin.php?CONTENIDOADMIN=Configuracion/Mesa/mesaActualizar.php" >
    <table class="table">
    <?=$formulariolista?>
    </table>
    <input class="input-lg" type="hidden" name="idanterior" value="<?=$mesa->getIdmesa()?>">
    <center> <input class="btn btn-primary" type="submit"  name="accion" value="<?=$accion?>"></center>
</form>
</div>