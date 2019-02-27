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

$lista='';
$numero=1;
$datos= Adelanto::getDatosObjetos("idempleado=$identificacion", null);
print_r($datos);
if (count($datos)>0){
    

for ($i = 0; $i < count($datos); $i++) {
    $adelanto=$datos[$i];
    $lista.="<tr>";
    
    $lista.="<td>{$numero}</td>";
    $lista.="<td>{$adelanto->getFecha()}</td>";
    $lista.="<td> <img src='Presentacion/imagenes/pesos.png' >".number_format($adelanto->getValor() ) ."</td>";
    $lista.="<td>En proceso</td>";
    $lista.="<td>";
    $lista.="<a href='PrincipalAdmin.php?CONTENIDOADMIN=Personal/Adelanto/formularioadelanto.php&accion=Modificar&idadelanto={$adelanto->getIdadelanto()}&nombres=$nombres&apellidos=$apellidos&telefono=$telefono&email=$email&idempleado=$identificacion '> <img src='Presentacion/imagenes/Modificar.png' title='Modificar'></a>";
    $lista.="<img src='Presentacion/imagenes/Eliminar.png' onClick=eliminar('{$adelanto->getIdadelanto()}') title='Eliminar'> ";
    $lista.="</td>";
    $lista.="</tr>";
    $numero+=1;    
}
} else {
  $lista.="<H5><font color='red'>NO TIENE ADELANTOS<H5>";   

}
?>
<style>
    h2.alert-primary{
        padding: 10px;
    }
    
</style>
<div class="container">
    <br>
    <a href="PrincipalAdmin.php?CONTENIDOADMIN=Personal/personal.php">< regresar</a>
    <h2 class="alert-primary text-center">LISTADO DE LOS ADELANTOS</h2>
<table>
    
    <tr><th>Identificacion</th><td><?= $identificacion?></td></tr>
    <tr><th>Nombre Completo</th><td><?= $nombres?> <?= $apellidos?></td></tr>
    <tr><th>Telfono</th><td><?= $telefono?></td></tr>
    <tr><th>Email</th><td><?= $email?></td></tr>
</table>
    <br>
<!--  esta tabla es el scrud de adelantos -->




<table class="table ">
    <thead class="table-dark">
    <th>NUMERO</th> <th>FECHA</th><th>MONTO</th><th>ESTADO</th>
        <th><a href="PrincipalAdmin.php?CONTENIDOADMIN=Personal/Adelanto/formularioadelanto.php&accion=Adicionar&nombres=<?=$nombres?>&apellidos=<?=$apellidos?>&telefono=<?=$telefono?>&email=<?=$email?>&idempleado=<?=$identificacion ?> "> <img src="Presentacion/imagenes/Adicionar.png"></a></th>
    </thead>
    <?=$lista?>
</table>



</div>

<script>
    function  eliminar(idadelanto){
      if(confirm("Desea Eliminar Este registro"))
        location="PrincipalAdmin.php?CONTENIDOADMIN=Personal/Adelanto/actualizaradelanto.php&accion=Eliminar&idadelanto="+idadelanto+"&idempleado=<?=$identificacion?>"+"&nombres=<?=$nombres?>"+"&apellidos=<?=$apellidos?>"+"&telefono=<?=$telefono?>"+"&email=<?=$email?>";
        
        
    }
</script>