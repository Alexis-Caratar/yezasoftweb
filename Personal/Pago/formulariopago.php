
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


setlocale(LC_ALL,"es_ES");


require_once dirname(__FILE__).'/../../Clases/Empleado.php';
require_once dirname(__FILE__).'/../../Clases/Pagoempleado.php';
require_once dirname(__FILE__).'/../../Clases/ConectorBD.php';


foreach ($_GET as $Variable=> $Valor) ${$Variable}=$Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable}=$Valor;

$cadenasql="SELECT sueldo from empleado,cargo where idcargo=cargo and identificacion=$idempleado";
$datos= ConectorBD::ejecutarQuery($cadenasql, null);

//para listar adelantos
$cadenasql1="select*from adelanto where idempleado=$idempleado";
$datos1= ConectorBD::ejecutarQuery($cadenasql1, null);
$listaadelantos="";
$contador=1;
if (count($datos1)>0){
    for ($i = 0; $i < count($datos1); $i++) {
    $listaadelantos.="<tr>";    
    $listaadelantos.="<td>$contador</td>"; 
    $listaadelantos.="<td>{$datos1[$i][1]}</td>";  
    $listaadelantos.="<td>{$datos1[$i][2]}</td>";
    $listaadelantos.="<td>ESTADO</td>";
    $listaadelantos.="</tr>";  
    $contador+=$contador;
    }
    
}else{
    $listaadelantos="<tr><td><h4>No tiene Adelantos<h4></td></tr>";
    
}
//para listar prestamos

$cadenasql1="select*from prestamo where idempleado=$idempleado";
$datos2= ConectorBD::ejecutarQuery($cadenasql1, null);
$listaprestamos="";
$valors=7;
$contador=1;
if (count($datos1)>0){
    for ($i = 0; $i < count($datos2); $i++) {
    $listaprestamos.="<tr>";    
    $listaprestamos.="<td>$contador</td>";
    $listaprestamos.="<td>{$datos2[$i][1]}</td>";  
    $listaprestamos.="<td>{$datos2[$i][2]}</td>";
    $listaprestamos.="<td>{$datos2[$i][3]}%</td>";
    $listaprestamos.="<td>{$datos2[$i][5]}</td>";
    $cadenasql1="select sum(valor)as valor from pago where prestamo={$datos2[$i][0]}";
    $datos3= ConectorBD::ejecutarQuery($cadenasql1, null);
    if (count($datos3)>0){ $listaprestamos.="<td>{$datos3[0][0]}</td>";}
    $listaprestamos.="<td>ESTADO</td>";
    $listaprestamos.="</tr>";  
    $contador+=$contador;
    }
}else{
    $listaprestamos="<tr><td><h4>No tiene Adelantos<h4></td></tr>";
    
}


//para el modficicar o adicionar
if ($accion=='Modificar') $pago=new Pagoempleado('idpagoempleado', $idpagoempleado);
else $pago=new Pagoempleado(null, null);
?> 
<div class="container-fluid">
    <h1 class="text-center text-info">REGISTRAR PAGO</h1>
    <H4>Fecha del PAGO: <?= $pago->getFechasistema() ?></H4>
    <br>
        <div class="row"><br>
            <div class="col-lg-4">
                        <div class="table table-hover table-striped " >
                            <h4 >DATOS DEL EMPLEADO</h4>
                                <table>
                                    <tr><th>Identificacion</th><td><?= $idempleado ?></td></tr>
                                    <tr><th>Nombre Completo</th><td><?= $nombres ?> <?= $apellidos ?> </td></tr>
                                    <tr><th>SUELDO BASE</th><td ><?= $datos[0][0] ?></td></tr>
                                </table>
                        </div>
                         <div class="">
                        <h3>LISTA DE ADELANTOS<a href="PrincipalAdmin.php?CONTENIDOADMIN=Personal/Adelanto/adelanto.php&identificacion=<?=$idempleado?>&nombres=<?=$nombres?>&apellidos=<?=$apellidos?>&telefono=<?=$telefono?>&email=<?=$email?>" class=" btn btn-danger" >Adelantos</a></h3>
                           <table class="table table-hover table-striped">
                                <tr><td>NUMERO</td><td>MONTO</td><td>FECHA</td><td>ESTADO</td></tr>
                                     <?= $listaadelantos?>
                           </table>
                    </div><br><br>
                    <div>
                            <h3>LISTA DE PRESTAMO<a href="PrincipalAdmin.php?CONTENIDOADMIN=Personal/Prestamo/prestamo.php&identificacion=<?=$idempleado?>&nombres=<?=$nombres?>&apellidos=<?=$apellidos?>&telefono=<?=$telefono?>&email=<?=$email?>" class=" btn btn-danger" >PRESTAMOS</a></h3>
                           <table class="table table-hover table-striped">
                               <tr><td>NUMERO</td><td>FECHA</td><td>VALOR PRESTAMO</td><td>INTERES</td><td>CUOTA</td><td>Valor abonado</td><td>ESTADO</td></tr>
                              <?= $listaprestamos?>
                           </table>
                    </div>


             </div>
             <div class="offset-2 col-lg-6">
                    <form name="formulario" action="PrincipalAdmin.php?CONTENIDOADMIN=Personal/Pago/actualizarpago.php&idpagoempleado=<?= $pago->getIdpagoempleado() ?>&fechasistema=<?= $pago->getFechasistema() ?>" method="post" >

                            <h2 class="text-center"><?= strtoupper($accion) ?> PAGO</h2>
                              <table class="table table-hover" >
                                    <tr> <th>Valor hora extra</th><th><input class="form-control"  onchange="cargar()" id='valorhora'   type="number" placeholder="ingrese el valor" name="valorhoraextra" value="<?= $pago->getValorhoraextra() ?>" autofocus required> </th> </tr>
                                    <tr><th>Horas Extras</th><th><input class="form-control"   onchange="cargar()" id='horasextras'   type="number" placeholder="ingrese el valor" name="horasextras" value="<?= $pago->getHorasextras() ?>"  required> </th>
                                    <tr><th>Auxilio de Transporte</th><th><input class="form-control" onchange="cargar()" id="auxiliotrasporte" type="number" placeholder="ingrese el valor" name="auxiliotrasporte" value="<?= $pago->getAuxiliotrasporte() ?>"  required> </th></tr>
                                    <tr><th>Descuento Salud</th><th><input class="form-control" onchange="cargar()" id="descuentosalud"  type="number" placeholder="ingrese el valor" name="descuentosalud" value="<?= $pago->getDescuentosalud() ?>" required> </th></tr>
                                    <tr><th>Descuento pencion</th><th><input class="form-control" onchange="cargar()"  id="descuentopencion" type="number" placeholder="ingrese el valor" name="descuentopencion" value="<?= $pago->getDescuentopencion() ?>" required> </th></tr>
                                    <tr><th>Riesgo labora</th><th><input class="form-control" onchange="cargar()"  id="riegolaboral" type="number" placeholder="ingrese el valor" name="riesgolaboral" value="<?= $pago->getRiesgolaboral() ?>" required> </th></tr>
                                    <tr><th>Fecha inicio</th><th><input class="form-control" type="date" placeholder="ingrese el valor" name="fechainicio" value="<?= $pago->getFechainicio() ?>" autofocus required> </th></tr>
                                    <tr><th>Fecha fin</th><th><input  class="form-control" type="date" placeholder="ingrese el valor" name="fechafin" value="<?= $pago->getFechafin() ?>" autofocus required> </th></tr>
                                    <tr><th>TOTAL A PAGAR</th><th> <h2 id='pagar' ><?= $datos[0][0] ?></h2></th></tr>
                             </table>
                              <input type="hidden" id="sueldo" name="sueldo" value="<?= $datos[0][0] ?>">
                              <input type="hidden"  name="idpagoempleado" value="<?= $pago->getIdpagoempleado() ?>">
                              <input type="hidden"  name="idempleado" value="<?= $idempleado ?>">
                              <input class=" btn btn-primary" type="submit" name="accion" value="<?= $accion ?>"> 
                    </form>
             </div>
        </div>
 </div>


 
        



        
    



<script>
    function cargar(){
        
        var sueldo=$('#sueldo').val();
        var SUELDO=parseFloat(sueldo)
        var valorhora=$('#valorhora').val();
        var horasextras=$('#horasextras').val();
         var totalpagar1=SUELDO+parseFloat(valorhora)*parseFloat(horasextras);
         $('#pagar').html(totalpagar1);
        var auxiliotrasporte=$('#auxiliotrasporte').val();
        var totalpagar2=parseFloat(totalpagar1)-parseFloat(auxiliotrasporte);
         $('#pagar').html(totalpagar2);
        var descuentopencion=$('#descuentopencion').val();
          var totalpagar3=parseFloat(totalpagar2)-parseFloat(descuentopencion);
         $('#pagar').html(totalpagar3);
        var descuentosalud=$('#descuentosalud').val();
         var totalpagar4 =parseFloat(totalpagar3)-parseFloat(descuentosalud);
         $('#pagar').html(totalpagar4);
        var riegolaboral=$('#riegolaboral').val();
         var totalpagar5=parseFloat(totalpagar4)-parseFloat(riegolaboral);
         $('#pagar').html(totalpagar5);
         var totalhoraextra=valorhora*horasextras;
         var totalpagar=parseFloat(sueldo)+parseFloat(totalhoraextra)+parseFloat(auxiliotrasporte)-parseFloat(descuentopencion)-parseFloat(descuentosalud) - parseFloat(riegolaboral);
        $('#pagar').html(totalpagar);
    }
</script>


