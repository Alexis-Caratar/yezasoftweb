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

$idcomanda='';
$iddetalle='';
$total=0;
$compara ='';
$accion ='Adicionar';
$modplato='';
$modmenu='';
$cargar='';
$vr='';
$nt='';
$ca='';
$vista='';
$listo='';
$menu="";//este es solo para el de cocina

foreach ($_GET as $variable => $valor) ${$variable}=$valor;
foreach ($_POST as $variable => $valor) ${$variable}=$valor;

//si la variable vista llega desde comanda como verdadera cambie estado avista por cocina 
if ($vista=='true' && $_SESSION['rolesi']=='cocina') {
    ConectorBD::ejecutarQuery("update comanda set estado='V' where idcomanda=$idcomanda ", null);    
}elseif ($listo=='true' && $_SESSION['rolesi']=='cocina') {///si listo llega como verdadero nos permite cambiar el estado de vista a lista
    ConectorBD::ejecutarQuery("update comanda set estado='L' where idcomanda=$idcomanda ", null);
    header('location: PrincipalAdmin.php?CONTENIDOADMIN=Comandas/comanda.php');
}

if ($accion !='') {
    if ($accion=='Modificar') {
        $cadena=  ConectorBD::ejecutarQuery("SELECT plato, menu, vrunitario,cantidad, nota FROM detalleorden, plato menu WHERE iddetalle=$iddetalle and plato=idplato", null);
        $menu =new Menu('idmenu', $cadena[0][0] );
        $modmenu=$cadena[0][1];
        $modplato=$cadena[0][0];
        $ca=$cadena[0][3];
        $vr=$cadena[0][2];
        $nt=$cadena[0][4];
        $accion='Modificar';
        $cargar="onload='cargar({$cadena[0][0]})'";
        
    }
    
} 

$_SESSION['user'];

//secrea las variables para traer los datos 
$datos = DetalleOrdenes::getDatosEnObjetos("comanda = $idcomanda " ,null);
$lista='';
for ($i = 0; $i < count($datos); $i++) {
    //se crea la vaiable donde va estar los dato de la tabla en i..
    //crea un OBJETO para que llame cada uno de los campos dde la tabla
    $datostabla=$datos[$i];
    if ($datostabla->Plato()==null) {
    header('Location:PrincipalAdmin.php?CONTENIDOADMIN=Comandas/comanda.php');
}
    $lista.="<tr>";
    $lista.="<td>".($i+1)."</td>";
    $lista.="<td>{$datostabla->getPlato()}</td>";
    $lista.="<td>{$datostabla->getCantidad()}</td>";
     $lista.="<td>{$datostabla->getNota()}</td>";
    if ($_SESSION['rolesi']=='admin') {//si el rol es admin permite completar le lista con  los modificar e ilini¡minar personal cocina no permite ingreso a esta secion 
    $lista.="<td>{$datostabla->getVrunitario()}</td>";
    $totales=$datostabla->getVrunitario()*$datostabla->getCantidad();
    $lista.="<td>{$total}</td>";    
        
    $lista.="<td><form method='post' action='PrincipalAdmin.php?CONTENIDOADMIN=Comandas/comandaListaPlato.php'>
                <input type='hidden' name='iddetalle' value='{$datostabla->getIddetalle()}'>                
                <input type='hidden' name='idcomanda' value='$idcomanda'>                
                <input type='hidden' name='idplato' value='{$datostabla->getPlato()}'>                
                <input type='hidden' name='accion' value='Modificar'>                
                <button  title='Modificar'><img src='Presentacion/imagenes/Modificar.png'></button>
        </form"
            ."<a><img src='./Presentacion/imagenes/Eliminar.png' title='eliminar' onclick=Eliminar({$datostabla->getIddetalle()})><a></td>";
    
    $lista.="</tr>";
    $total+=$totales;// con .= concatena con += suma valores numericos
    }
    
    
}
?>
<body>

    <?php 
    //filtrar si es cocina lo que debe ver en interfaz cocina
if ($_SESSION['rolesi']=='cocina') {?>   
    <br>
<div class="container-fluid ">
<div class="text-left">
     <a href="PrincipalAdmin.php?CONTENIDOADMIN=Comandas/comanda.php"><button class="btn btn-danger">REGRESAR</button></a>
        </div>
      <div class="text-right">
        <a href="PrincipalAdmin.php?CONTENIDOADMIN=Comandas/comanda.php"><button class="btn btn-danger">COMANDAS</button></a>
        <a href="index.php"><button class="btn btn-danger">Salir</button></a>
    </div>
</div>
    
<center><h2>DETALLE DE LA COMANDA</h2></center><br><br>
<center>
    <div class="col-md-5">
       
    <table class="table table-hover form-control">
         <h4>LISTA DE PLATOS</h4>
        <tr>
            <th>Numero</th><th>Nombre</th><th>Cantidad</th><th>Observacion</th>
             
        <a href="PrincipalAdmin.php?CONTENIDOADMIN=Comandas/comanda.php"><button class="btn btn-success" title="Cambiar Estado"><img src="Presentacion/imagenes/Adicionar.png"  >ESTADO VISTO</button></a>
        </tr>
        <?=$lista?>
        
    </table>
        </div>
    
<?php }
?>
    <?php 
if ($_SESSION['rolesi']=='admin'||$_SESSION['rolesi']=='cajero') {

//administrador puede ver todo?>
    <center><h2><?= strtoupper($accion) ?> PLATOS</h2></center>

    <div class="container-fluid row">  
 
     <div class="col-4 ">
        
         <form name="comandaFormulario" method="POST" action="PrincipalAdmin.php?CONTENIDOADMIN=Comandas/comandaPlatoActualizar.php">

             <table class="container">
                 <tr><th>Menu</th><th><select class="form-control" name="menu" onchange="cargar(this.value)"><?= Menus::listaOpcciones(NULL) ?></select></th></tr>
                 <tr><th>plato</th><th><select class="form-control" name="plato" onchange="cargard(this.value)"><option>Lista de platos</option></select></th></tr>
                 <tr><th>cantidad</th><th><input class="form-control" type="number" name="cantida" id="cantida" value="<?= $ca ?>" onkeyup="calcularvalor()"></th></tr>
                 <tr><th>valor</th><th><input class="form-control" id="valor" type="number" name="val" value="<?= $vr ?>" onkeyup="calcularvalor()"></th></tr>
                 <tr><th>subtotal</th><th><lavel class="form-control" id="subtotal" ></lavel></th></tr>
                 <tr><th>observacion</th><th><textarea class="form-control" name="nota"><?= $nt ?></textarea></th></tr>


             </table>

             <input type="hidden" name="idcomanda" value="<?= $idcomanda ?>">
             <input type="hidden" name="iddetalle" value="<?= $iddetalle ?>">
            <input  class="btn btn-primary"type="submit" name="accion" value="<?= $accion ?>">

         </form>
     </div>


     <div class="col-8">

         <center>  <h4>LISTA DE PLATOS</h4></center>
         <table class="tabla table-active table-bordered " >
    <thead  class="table-dark">
                 <th>NUMERO</th><th>PLATO</th><th>CANTIDAD  </th><th>OBSERVACION</th><th>VALOR</th><th>SUBTOTAL</th>
                 <th>
                 </th>

                 <button  title='Crear Factura' onclick='print()'><img src='Presentacion/imagenes/bill.png'  ></button>
             <thead
             <?= $lista ?>
            
                 <tr>
                 <td> Total </td><td colspan="5"><p style="margin-left: 440px"><?= $total ?></p></td> <td></td>
             </tr>
         </table>

         <br><br>
         <input class="btn btn-primary" type="button" class="btn-primary" onclick="regresarguardar()" value="Guardar">  
     </div>
    </div>
    
<?php }
?>
   

<br>
</body>
<script type="text/javascript">
    
    window.addEventListener('keydown', llave);
   
    function llave(ev){ //tecla escape
        if(ev.keyCode==27){ 
            location="PrincipalAdmin.php?CONTENIDOADMIN=Comandas/comanda.php";
        }
    }
    
    function print(){
      window.open('PrincipalAdmin.php?CONTENIDOADMIN=Comandas/factura.php&idcomanda=<?=$idcomanda?>&accion=print' ,null, null);  
    }
</script>

<script type="text/javascript">
   
        
        <?= Platos::arreglo()?>;
        
        function cargar(valor){             
            document.comandaFormulario.plato.length=1;//nombre del formulario y nombre de donde sale el objeto
            for(var i =0; i<plato.length; i++){
                if(plato[i][2]==valor.toString()){
                    document.comandaFormulario.plato.length++;
                    document.comandaFormulario.plato.options[document.comandaFormulario.plato.length-1].value=plato[i][0];
                    document.comandaFormulario.plato.options[document.comandaFormulario.plato.length-1].text=plato[i][1];                    
            
           
                }         
            }
        }
        function cargard(valor){
             for(var i =0; i<plato.length; i++){
                if(plato[i][0]==valor){
                    document.comandaFormulario.val.value=plato[i][3];
                    document.comandaFormulario.val.text=plato[i][3]; 
                }         
            }
        }
        function calcularvalor(){
            num1=parseFloat(document.getElementById('cantida').value);
            num2=parseFloat(document.getElementById('valor').value);
            total=num1*num2;
            document.getElementById('subtotal').innerHTML=total;
            }
            
        function Eliminar(id){
            if(confirm('Desea eliminar esta orden')){
           location='PrincipalAdmin.php?CONTENIDOADMIN=Comandas/comandaPlatoActualizar.php&accion=Eliminar&id='+id+"&idcomanda=<?=$idcomanda?>";      
        }
        }
        
        function regresarguardar(){
        location='PrincipalAdmin.php?CONTENIDOADMIN=Comandas/comanda.php';
        }
            
           
</script>

