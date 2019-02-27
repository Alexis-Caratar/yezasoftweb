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



$lista='';
$numerodeprestamos=1;
$datos= Prestamo::getDatosObjetos("idempleado=$identificacion",null);

if ($datos==NULL){
    $lista.="<H2>No tiene Prestamos</H2>";
} else {
    
for ($i = 0; $i < count($datos); $i++) {
    
      $prestamo=$datos[$i];
      //PARA LA PARTE DE VALOR ABONADO
      //consultas de un metodo
      $valorabonado= Prestamo::valorabonado($prestamo->getIdprestamo());
      //validacion si a abnado algo
      if (count($valorabonado)>0) $valorabonado=$valorabonado;
      else $valorabonado=0;
      //validacion si ha pagado algo si no es  null
       $cadenaSQL="select fecha  from pago where prestamo=".$prestamo->getIdprestamo()."  order by idpago DESC LIMIT 1;";
       $ultimafechaprestamo=ConectorBD::ejecutarQuery($cadenaSQL, null);
      if (count($ultimafechaprestamo)>0) $ultimafechaprestamo=$ultimafechaprestamo;
      else $ultimafechaprestamo="N";
      
      for ($j = 0; $j < count($valorabonado); $j++) {
          
      //PARA EL TOTAL A PAGAR Y CUOTAS 
    //  for ($k = 0; $k < count($ultimafechaprestamo); $k++) {
          
    $interes=$prestamo->getValor()*$prestamo->getInteres();
    $interestotal=$interes/100;
    $totalapagar=$interestotal+$prestamo->getValor();
   $pagarcuotas=$totalapagar/$prestamo->getCuota();
    //sacar el saldo
    $saldo=$totalapagar-$valorabonado[$j]['valorabonado'];
    //sacar estado
    if ($saldo<=0) $estado="<font color='green  '>PAGADO";
    else $estado="<font color='red'> PENDIENTE</font>";
    
  
    $lista.="<tr>";
    $lista.="<td>$numerodeprestamos</td>";
    $lista.="<td>{$prestamo->getFecha()}</td>";
    $lista.="<td>$ ". number_format($prestamo->getValor())."</td>";
    $lista.="<td>{$prestamo->getInteres()} %</td>";
    $lista.="<td> {$prestamo->getCuota()}</td>";
    $lista.="<td>$ ".number_format($pagarcuotas)."</td>";
    $lista.="<td>$ ".number_format( $valorabonado[$j]['valorabonado'])."</td>";
    $lista.="<td>$saldo</td>";
   // $lista.="<td> ultimo pago</td>";
    $lista.="<td>{$ultimafechaprestamo[0][0]}</td>";
    $lista.="<td >$estado</td>";

    $lista.="<td>$  ".number_format( $totalapagar)."</td>";
    $lista.="<td>";
   $lista.="<a href='PrincipalAdmin.php?CONTENIDOADMIN=Personal/Prestamo/formularioprestamo.php&accion=Modificar&idprestamo={$prestamo->getIdprestamo()}&nombres=$nombres&apellidos=$apellidos&telefono=$telefono&email=$email&idempleado=$identificacion '> <img src='Presentacion/imagenes/Modificar.png' title='Modificar'></a>";
   $lista.="<img src='Presentacion/imagenes/Eliminar.png' onClick=eliminar('{$prestamo->getIdprestamo()}') title='Eliminar'> ";
   $lista.="<a href='PrincipalAdmin.php?CONTENIDOADMIN=Personal/Prestamo/pago.php&idprestamo={$prestamo->getIdprestamo()}&nombres=$nombres&apellidos=$apellidos&telefono=$telefono&email=$email&idempleado=$identificacion '> <img src='Presentacion/imagenes/Pago.png' title='pago prestamo'></a>";
    $lista.="</td>";
    $lista.="</tr>";
    
    $numerodeprestamos+=1;
      }
      }
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
    <a href="PrincipalAdmin.php?CONTENIDOADMIN=Personal/personal.php">< regresar</a>
    <h2 class="alert-primary text-center">LISTADO DE LOS PRESTAMOS</h2>

<table class="table-">
    <tr><th>Nombre</th><td><?=$identificacion?></td></tr>
    <tr><th>Nombre Completo</th><td><?= $nombres?> <?= $apellidos?></td></tr>
    <tr><th>Telfono</th><td><?= $telefono?></td></tr>
    <tr><th>Email</th><td><?= $email?></td></tr>
</table>

<br><br>

    <table class="table  badge" >
        <thead class="table-dark">
        <th>Numero</th><th>Fecha de prestamo</th><th>Valor</th><th>Interes</th><th>Cuotas</th><th>cuota a pagar</th><th>Valor abonado</th><th>saldo</th><th>Fecha ultimo pago</th><th>Estado</th><th>Total a pagar</th>
        <th><a href="PrincipalAdmin.php?CONTENIDOADMIN=Personal/Prestamo/formularioprestamo.php&accion=Adicionar&nombres=<?=$nombres?>&apellidos=<?=$apellidos?>&telefono=<?=$telefono?>&email=<?=$email?>&idempleado=<?=$identificacion ?>  "> <img src="Presentacion/imagenes/Adicionar.png"></a></th>
    </thead>
    <?=$lista?>
</table>


</div>



<script>
    function  eliminar(idprestamo){
     if(confirm("Desea Eliminar Este registro"))
        location="PrincipalAdmin.php?CONTENIDOADMIN=Personal/Prestamo/actualizarprestamo.php&accion=Eliminar&idprestamo="+idprestamo+"&idempleado=<?=$identificacion?>"+"&nombres=<?=$nombres?>"+"&apellidos=<?=$apellidos?>"+"&telefono=<?=$telefono?>"+"&email=<?=$email?> ";
        
        
    }
</script>