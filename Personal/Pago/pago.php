<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once dirname(__FILE__).'/../../Clases/Empleado.php';
require_once dirname(__FILE__).'/../../Clases/ConectorBD.php';


foreach ($_GET as $Variable=> $Valor) ${$Variable}=$Valor;
$cadenasql="SELECT fechasistema,cargo.sueldo, auxiliotrasporte, descuentosalud, descuentopencion, riesgolaboral, horasextras, pagoempleado.sueldo, pagoempleado.fechainicio, pagoempleado.fechafin, idpagoempleado FROM cargo, empleado, pagoempleado WHERE idempleado=$identificacion AND empleado.cargo =$cargo group by idpagoempleado";
$datos= ConectorBD::ejecutarQuery($cadenasql, null);

$lista='';
$numero=1;
if(count($datos)>0){
for ($i = 0; $i < count($datos); $i++) { 
    $lista.="<tr>";
    $lista.="<td> $numero</td>";
    $lista.="<td> {$datos[$i][0]}</td>";
    $lista.="<td> {$datos[$i][1]}</td>";
    $lista.="<td> {$datos[$i][2]}</td>";
    $lista.="<td> {$datos[$i][3]}</td>";
    $lista.="<td> {$datos[$i][4]}</td>";
    $lista.="<td> {$datos[$i][5]}</td>";
    $lista.="<td> {$datos[$i][6]}</td>";
    $lista.="<td> {$datos[$i][7]}</td>";
    $lista.="<td> pagado</td>";
    $lista.="<td> {$datos[$i][8]}</td>";
    $lista.="<td> {$datos[$i][9]}</td>";   
   
    $lista.="<td>";
    $lista.="<a href='PrincipalAdmin.php?CONTENIDOADMIN=Personal/Pago/formulariopago.php&accion=Modificar&sueldo={$datos[$i][1]}&nombres=$nombres&apellidos=$apellidos&telefono=$telefono&email=$email&idempleado=$identificacion&idpagoempleado={$datos[$i]['idpagoempleado']} '> <img src='Presentacion/imagenes/Modificar.png' title='Modificar'></a>";
    $lista.="<img src='Presentacion/imagenes/Eliminar.png' onClick=eliminar('{$datos[$i]['idpagoempleado']}') title='Eliminar'> ";
    $lista.="</td>";
    $lista.="</tr>";
    $numero+=1;     

//lo cerre al final para que recorra el for y deje enviar el dato correcto del sueldo
}
}else{
	$lista.="<H4>NO TIENE PAGOS</H4>";
}

?>
<div class="container-fluid"><br>
    <h2 class="text-center text-primary">LISTADO DE LOS PAGOS</h2><br>
    <div class="col-lg-5">
    <table class="table table-hover table-striped">
    <tr><th>Identificacion</th><td><?= $identificacion?></td></tr>
    <tr><th>Nombre Completo</th><td><?= $nombres?> <?= $apellidos?></td></tr>
    <tr><th>Telfono</th><td><?= $telefono?></td></tr>
    <tr><th>Email</th><td><?= $email?></td></tr>
</table>
        </div>
<br>

<table class="table ">
    <thead class="table-dark">
    <td>Numero</td> <td>Fecha pago</td><td>Salario</td><td>Auxilio Trasporte</td><td>Salud</td><td>Pension</td><td>Riegos laboral</td><td>Horas Extras</td><td>Valor pago</td><td>Estado</td><td>Fecha Inicio</td><td>Fecha fin</td>
        <th><a href="PrincipalAdmin.php?CONTENIDOADMIN=Personal/Pago/formulariopago.php&accion=Adicionar&nombres=<?=$nombres?>&apellidos=<?=$apellidos?>&telefono=<?=$telefono?>&email=<?=$email?>&idempleado=<?=$identificacion ?> "> <img src="Presentacion/imagenes/Adicionar.png"></a></th>
</thead>
<?=$lista?>
</table>
</div>
<script>
    function  eliminar(idpagoempleado){
     if(confirm("Desea Eliminar Este registro"+idpagoempleado))
        location="PrincipalAdmin.php?CONTENIDOADMIN=Personal/Pago/actualizarpago.php&accion=Eliminar&idpagoempleado="+idpagoempleado;
        
        
    }
</script>
    





