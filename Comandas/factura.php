<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//importar clases
require_once dirname(__FILE__)."/../Clases/Menus.php";
//por el metodo que trae

require_once dirname(__FILE__).'/../Clases/ConectorBD.php';
require_once dirname(__FILE__).'/../Clases/Platos.php';
require_once dirname(__FILE__).'/../Clases/DetalleOrdenes.php';
require_once dirname(__FILE__).'/../Clases/Facturas.php';
require_once dirname(__FILE__).'/../Clases/Cliente.php';

$total='';
$accion='';
$onload='';

foreach ($_GET as $variable => $valor) ${$variable}=$valor;
foreach ($_POST as $variable => $valor) ${$variable}=$valor;


if ($accion=='print') {
    $onload="onload='printpant()'";
}
//secrea las variables para traer los datos 
$datos = DetalleOrdenes::getDatosEnObjetos(" comanda = $idcomanda " ,null);
$lista='';
for ($i = 0; $i < count($datos); $i++) {
    //se crea la vaiable donde va estar los dato de la tabla en i..
    //crea un OBJETO para que llame cada uno de los campos dde la tabla
    $datostabla=$datos[$i];
    if ($datostabla->Plato()==null) {
    header('Location:PrincipalAdmin.php?CONTENIDOADMIN=Comandas/comanda.php');
}
    $lista.="<tr>";
    $lista.="<td>{$datostabla->getIddetalle()}</td>";
    $lista.="<td>{$datostabla->getPlato()}</td>";
    $lista.="<td>{$datostabla->getNota()}</td>";
    $lista.="<td>{$datostabla->getCantidad()}</td>";
    $lista.="<td>{$datostabla->getVrunitario()}</td>";
    $lista.="<td>{$datostabla->getSubt()}</td>";      
    $lista.="</tr>";
    $total+=$datostabla->getSubt();// con .= concatena con += suma valores numericos    
}

$cadenaq=ConectorBD::ejecutarQuery("select factura, fecha from comanda where idcomanda=$idcomanda ", null);//consulta la faltura creada anterior 

?>

<body>
<center>
<div>  
    <h2>factura de la comanda</h2> 
 <br>
<center><h2>Plato</h2></center>
    <center>
       
    <table border="1">
        <tr>
            <th>Numero Factura </th>
            <th colspan="2"><?= $cadenaq[0][0]?> </th><!--trae el numero de lafactura consulta que se hizo---->
            <th>Fecha Factura </th>
            <th colspan="2"><?= $cadenaq[0][1]?> </th><!--fecha de la factura automatica-->        
        </tr>
        <tr>
            
            <th>Cliente </th>
            <th colspan="2"><input list='persona' id="nombre" onchange="nombre()" name="persona" type="text" value=''><?= Cliente::opciones()?> </th>
            <th>Descuento </th>
            <th colspan="2"><input type="number" id='descuento' onkeyup="descuento(this.value)" onchange="descuento(this.value)"> </th>
            <!--se escribe el descuento con el onkey se envia el valor a una funcion javascrip --->
        </tr>
        
        <tr>
            <th>N°</th><th>Nombre</th><th>obserbacion</th><th>Cantidad</th><th>Valor</th><th>Subtotal</th>
            
              </tr>
        <?=$lista?>
        <tr>
            <td> Total </td><td colspan="3"><p style="margin-left: 440px" id='total'><?=$total?></p></td> <td>descuento</td>
            <td><p id='totales'></p></td>
        </tr>
    </table>  
</center>
<br>
<form method="post" action="PrincipalAdmin.php?CONTENIDOADMIN=Comandas/formularioModificar.php">    
    <input type="number" name="pagos" id="pagos" onkeyup="regreso()" value="">
    <p id="vul"></p>
    <input type="hidden" name="totales" value="<?=$total?>">
    <input type="hidden" name="facturas" value="<?=$cadenaq[0][0]?>">
    <input type="hidden" id="name" name="nombres" value="">
    <input type="hidden" id="descuentos" name="descuentos" value=''>
    <input type="submit" name="accion" value="Modificar">
 </form>

</body>
<script>
    function printpant(){
        print();
    }
    
    function descuento(){//se trae el valo total y se resta al descuento y con
       var total=document.getElementById('total').innerHTML;
       var descuentos=document.getElementById('descuento').value;
       totales=total-descuentos;
       document.getElementById('totales').innerHTML=totales;//innerenviaos el nuevo valor al id totales
       document.getElementById('descuentos').value=descuentos//innerenviaos el nuevo valor al id totales
    }
    
    function nombre(){
        var name=document.getElementById('nombre').value;
        document.getElementById('name').value=name;
    }
        function regreso(){
        var pagosdos=document.getElementById('pagos').value;
        var descuentos=document.getElementById('totales').innerHTML;
        if(pagosdos>descuentos){
            document.getElementById('vul').innerHTML=(pagosdos-descuentos);
            
        }
    }
</script>