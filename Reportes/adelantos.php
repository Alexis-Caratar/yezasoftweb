<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . "./../Clases/ConectorBD.php";

$filtro="";
if (isset($_POST['nombre'])&&$_POST['nombre']!=NULL){
    $nombresperson=$_POST['nombre'];
    $filtro="  and concat(idempleado,nombres,apellidos) like'%$nombresperson%'";  
}


$fecha= getdate();
$fecha=$fecha['year']."-".$fecha['mon'];


$cadena="SELECT *from adelanto,empleado,cargo WHERE idempleado=identificacion and cargo=idcargo AND fecha>=2018-$fecha-01 AND fecha<=now() $filtro";
$datos= ConectorBD::ejecutarQuery($cadena, null);
$lista="";
$numero=1;
if (count($datos)>0){
    for ($i = 0; $i < count($datos); $i++) {
    $lista.="<tr>";
    $lista.="<td>{$numero}</td>";
    $lista.="<td>{$datos[$i][2]}</td>";
    $lista.="<td>{$datos[$i][3]}</td>";
    $lista.="<td>{$datos[$i][5]}".""."{$datos[$i][6]}</td>";
    $lista.="<td>{$datos[$i][8]}</td>";
    $lista.="<td>{$datos[$i][11]}</td>";
    $lista.="<td>{$datos[$i][15]}</td>";
    $lista.="<td> $ {$datos[$i][1]}</td>";
    $lista.="</tr>";
    $numero+=1;
    }
}else {
$lista.="<td class='text-primary'>No se encontraron resultado para su criterio de busqueda. </td>";    
}
?>

<div class="offset-8 col-md-4  "style="z-index: 100;  margin: 0% 65%; position: absolute;background: #333333;">
    <form method="post" class="">
     <table class="table-responsive-lg table table-dark table-hover " >
          <tr>
              <th> <img src="presentacion/imagenes/buscarpequeño.png"></span></th><td><input  class="form-control" type="text"  autofocus name="nombre" placeholder="idenfificacion o nombres" ></td>
              <td><input class="btn-primary"type="submit" value="BUSCAR"></td>
         </tr>
       </table>
 </form>
</div>
<br><br>
<h2 > ADELANTOS  ULTIMO MES</h2><br><img src="presentacion/imagenes/word.png" width="50" height="50"><img src="presentacion/imagenes/pdf.png" width="50" height="50"> <img src="presentacion/imagenes/exel.png"width="50" height="50">
<table class="table table-hover table-responsive-lg">
    <tr><th>Numero</th><th>Fecha adelanto</th><th>Identificacion</th><th>Nombres completos</th><th>Telefono</th><th>Fecha ingreso</th><th>Cargo</th> <th>Valor Adelanto</th></tr>
<?=$lista?>
</table>