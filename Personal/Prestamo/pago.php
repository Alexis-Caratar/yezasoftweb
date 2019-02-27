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



$lista='';
  $contadorcoutas=1;
$datos= Pago::getDatosObjetos("prestamo=$idprestamo", null);
if (count($datos)>0) {
    
 
for ($i = 0; $i < count($datos); $i++) {
    $pagoprestamo=$datos[$i];  
    $valorabonado=$pagoprestamo->getValor();
    $lista.="<tr>";
    $lista.="<td>$contadorcoutas</td>";
    $lista.="<td>{$pagoprestamo->getFecha()}</td>";
    $lista.="<td>{$pagoprestamo->getValor()}</td>";
    $lista.="<td>$contadorcoutas</td>";  
    $lista.="<td>";
    $lista.="<a href='PrincipalAdmin.php?CONTENIDOADMIN=Personal/Prestamo/formulariopago.php&accion=Modificar&idprestamo=$idprestamo&idpago={$pagoprestamo->getIdpago()}&nombres=$nombres&apellidos=$apellidos&telefono=$telefono&email=$email&idempleado=$idempleado&contadorcoutas=$contadorcoutas '> <img src='Presentacion/imagenes/Modificar.png' title='Modificar'></a>";
   $lista.="<img src='Presentacion/imagenes/Eliminar.png' onClick=eliminar('{$pagoprestamo->getIdpago()}') title='Eliminar'> ";
    $lista.="</td>";
    $lista.="</tr>";
    $contadorcoutas=$contadorcoutas+1;

}   
}else{
    $lista.="<H5><font color='red'>NO TIENE PAGOS<H5>";
}

?>
<style>
    h2.alert-primary{
        font-family: TeamViewer;
        padding: 10px;
    }
    </style>
    <div class="container">
        <br>
            <a href="PrincipalAdmin.php?CONTENIDOADMIN=Personal/Prestamo/prestamo.php&idprestamo=<?=$idprestamo?>&identificacion=<?=$idempleado?> &nombres=<?=$nombres?>&apellidos=<?=$apellidos?>&telefono=<?=$telefono?>&email=<?=$email?>&idempleado=<?=$idempleado ?> &contadorcoutas=<?=$contadorcoutas?> ">   < regresar</a>
        <h2 class="alert-primary text-center">LISTADO DE LOS PAGOS</h2>

<table>
    <tr><th>Nombre</th><td><?= $idempleado?></td></tr>
    <tr><th>Nombre Completo</th><td><?= $nombres?> <?= $apellidos?></td></tr>
    <tr><th>Telfono</th><td><?= $telefono?></td></tr>
    <tr><th>Email</th><td><?= $email?></td></tr>
    <tr><th>idprestamo</th><td><?= $idprestamo?></td></tr>
</table>

        <br>
  
<table class="table container" >
    <thead class="table-dark">
    <th>Numero</th><th>Fecha de Pago</th><th>Valor</th><th>Cuotas</th>
        <th><a href="PrincipalAdmin.php?CONTENIDOADMIN=Personal/Prestamo/formulariopago.php&accion=Adicionar&idprestamo=<?=$idprestamo?> &nombres=<?=$nombres?>&apellidos=<?=$apellidos?>&telefono=<?=$telefono?>&email=<?=$email?>&idempleado=<?=$idempleado ?> &contadorcoutas=<?=$contadorcoutas?> "> <img src="Presentacion/imagenes/Adicionar.png"></a></th>
 
    </thead>
    <?=$lista?>
</table>
            
    

</div>


<script>
    function  eliminar(idpago){
      if(confirm("Desea Eliminar Este registro"))
        location="PrincipalAdmin.php?CONTENIDOADMIN=Personal/Prestamo/actualizarpago.php&accion=Eliminar&idpago="+idpago+"&idprestamo=<?=$idprestamo?>"+"&idempleado=<?=$idempleado?>"+"&nombres=<?=$nombres?>"+"&apellidos=<?=$apellidos?>"+"&telefono=<?=$telefono?>"+"&email=<?=$email?> ";
   
        
        
    }
</script>