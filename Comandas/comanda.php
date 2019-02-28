<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//importar las clases
require_once dirname(__FILE__).'/../Clases/ConectorBD.php';
require_once dirname(__FILE__).'/../Clases/Comandas.php';
require_once dirname(__FILE__).'/../Clases/Personal.php';
$menu="";
$mennsajecomanda="";
 $filtro="";
 


;
if (isset($_POST['nombre'])&&$_POST['nombre']!=null)  {
   $identificacion=$_POST['nombre'];
   $filtro= " idempleado LIKE '$identificacion%' and ";

}
 
 
if (isset($idcaja)) {$idcaja=$idcaja;
}else{
$cadena="select idcaja from caja ORDER BY `caja`.`idcaja` DESC LIMIT 1;";
$datoscaja= ConectorBD::ejecutarQuery($cadena, null);

$idcaja=$datoscaja[0][0];
}

$_SESSION['user'];

$idcomanda='';
$modificar='';//variable para modificar adinistrador o cocina
$Adicionar="";


$usuariorol=$_SESSION['rol'];

if ($usuariorol=='admin'|| $usuariorol=='cajero'){
    $filtro.="reserva is null and domicilio is null and caja='$idcaja'";
}elseif($usuariorol=='cocina'){
    $filtro.="  caja='$idcaja'";
}

//crear variable para los datos
$datos= Comandas::getDatosEnObjeto($filtro,' idcomanda asc');
$listadoComanda='';
if (count($datos)>0){
for ($i = 0; $i < count($datos); $i++) {
    //crear nueva variable
    $datosComanda=$datos[$i];
    if ($datosComanda->getEstado()!='L' || $_SESSION['rolesi']=='admin' || $_SESSION['rolsi']=='cajero' ) {
        //si el pedido esta en el estado =Listo no permite ingresar o si el rol es andministrador el listado listo deja ingresar
        
         if ($_SESSION['rolesi']=='admin') {//si es administrador permite ver modificar
    $modificar="<form method='post' action='PrincipalAdmin.php?CONTENIDOADMIN=Comandas/comandaListaPlato.php'>
                <input type='hidden' name='idcomanda' value='{$datosComanda->getIdcomanda()}'>                
                <input type='hidden' name='accion' value='Adicionar'>                
                <td><button  title='Modificar'><img src='Presentacion/imagenes/Modificar.png'></button>
                </form>
                <img src='Presentacion/imagenes/Eliminar.png' title='Eliminar' onclick='Eliminar(".$datosComanda->getIdcomanda().")'></td>";
             $Adicionar= '<th><button title="Adicionar"><img src="Presentacion/imagenes/Adicionar.png"  ></button></th>';
                
         }        
         if ($_SESSION['rolesi']=='cajero') {//si es administrador permite ver modificar
    $modificar="<form method='post' action='PrincipalAdmin.php?CONTENIDOADMIN=Comandas/comandaListaPlato.php&acciones=cerrar&roles=cajero'>
                <input type='hidden' name='idcomanda' value='{$datosComanda->getIdcomanda()}'>                
                <input type='hidden' name='accion' value='Adicionar'>                
                <td><button  title='Modificar'><img src='Presentacion/imagenes/Modificar.png'></button>
                </form>
                <img src='Presentacion/imagenes/Eliminar.png' title='Eliminar' onclick='Eliminarcaje(".$datosComanda->getIdcomanda().")'></td>";
             $Adicionar= '<th><button title="Adicionar"><img src="Presentacion/imagenes/Adicionar.png"  ></button></th>';
                
         }        
elseif ($_SESSION['rolesi']=='cocina') {


//si es rol cocina permite cambiar el estado visto en cocina
    $modificar="<form method='post' action='PrincipalAdmin.php?CONTENIDOADMIN=Comandas/comandaListaPlato.php'>
                <input type='hidden' name='idcomanda' value='{$datosComanda->getIdcomanda()}'>                
                <input type='hidden' name='vista' value='true'>                
                <input type='hidden' name='accion' value='Adicionar'>                
                <button class='btn btn-primary' title='ver'>ver comandas</button>
        </form>";
                
                if ($datosComanda->getEstado()=='V') {//permite si ya esta en visto en cocina permite el boton para enl estado a listo
        $modificar.="<form method='post' action='PrincipalAdmin.php?CONTENIDOADMIN=Comandas/comandaListaPlato.php'>
                <input type='hidden' name='idcomanda' value='{$datosComanda->getIdcomanda()}'>                
                <input type='hidden' name='listo' value='true'>                
                <input type='hidden' name='accion' value='Adicionar'>                
                <button class='btn btn-success' title='ver'>Plato listo</button>
        </form>";
                
                
    }
    
    $menu='  <div class="text-right">
        <a href="loguin.php"><button class="btn btn-danger">COMANDAS</button></a>
        <a href="loguin.php"><button class="btn btn-danger">Salir</button></a>
    </div>';
    
}

    $listadoComanda.="<tr>";
    $listadoComanda.="<td>".($i+1)."</td>";
    $listadoComanda.="<td>{$datosComanda->getEmpleado()}</td>";
    $listadoComanda.="<td>{$datosComanda->getnumeromesa()->getMesainicial()}</td>";
    $listadoComanda.="<td>{$datosComanda->getFecha()}</td>";
	$estadop="";
    if ($datosComanda->getEstado()=='P') {
        $estadop='PENDIENTE';
    }elseif ($datosComanda->getEstado()=='V') {//para que en la interfaz complete segun el estado
        $estadop='VISTA EN COCINA';
    }elseif ($datosComanda->getEstado()=='L') {
         $estadop='LISTO EN COCINA';
    }elseif($estado=='E'){
        $color="style='background-color: #64FE2E'";
        $eliminar="";
        $modificar="";
        $estados="ENTREGADA";
        $modificar.="<td><button title='Crear Factura' onclick='print({$datosComanda->getIdcomanda()})'><img src='Presentacion/imagenes/bill.png'  ></button><td>";
    }elseif($estado=='PG'){
        $color="style='background-color: #2E9AFE'";
        $eliminar="";
        $modificar="";
        $estados="PAGADO";
    }
    
    
    
    
    
    $listadoComanda.="<td>$estadop</td>";
    $listadoComanda.="<td>{$datosComanda->getFactura()}</td>";
    $listadoComanda.="<td> $modificar</td>";
    $listadoComanda.="</tr>";

        
        
    }
    }
              
} else {
    $listadoComanda.="<td class='text-primary'>No se encontraron resultado para su criterio de busqueda. </td>";
$Adicionar= '<th><button title="Adicionar"><img src="Presentacion/imagenes/Adicionar.png"  >  </button></th>';
 
    
}
   
?>

   <div class="offset-8 col-md-4  "style="z-index: 100;  margin: 0% 65%; position: absolute;background: #333333;">
    <form method="post">
     <table class="table-responsive-lg table table-dark table-hover " >
          <tr>
              <th> <img src="presentacion/imagenes/buscarpequeño.png"></span></th><td><input  class="form-control" type="text"  autofocus name="nombre" placeholder="Identificacion o nombre  " ></td>
              <td><input class="btn-primary"type="submit" value="BUSCAR"></td>
         </tr>
       </table>
 </form>
  <a style='cursor: pointer;color: white;' onClick="muestra_oculta('contenido1')" title="BUSQUEDA AVANZADA" class="btn-dark offset-5"><img src="presentacion/imagenes/lista.png"width="20" height="15"> Busqueda Avanzada </a>

 </div>
<br>
    
    
  <?=$menu?>
    
    <H2 >COMANDAS</H2>
<br>
<br>

<table class="table container table-hover">
    <thead  class="table-dark table-responsive-lg">
            <th>Numero</th><th>Empleado</th><th>mesa</th><th>Fecha</th><th>Estado</th><th>factura</th>
            <form method="post" action="PrincipalAdmin.php?CONTENIDOADMIN=Comandas/comandaActualizar.php&idcaja=<?=$idcaja?>">
                <th></th> <th>    <input type="hidden" name="accion" value="Adicionar">
                <input type="hidden" name="empleado" value="<?=$_SESSION['user']?>">
                <input type="hidden" name="estado" value="P">
                <?=$Adicionar?>
                
        </form>        
            </thead>
        <?=$listadoComanda?>
    </table>
<?=$mennsajecomanda?>
</div>
<script type="text/javascript">
    function Eliminar(id){
       if(confirm('Desea eliinar esta comanda')){
           location='PrincipalAdmin.php?CONTENIDOADMIN=Comandas/comandaActualizar.php&accion=Eliminar&id='+id;      
        }
    }
    function Eliminarcaje(id){
       if(confirm('Desea eliinar esta comanda')){
           location='PrincipalAdmin.php?CONTENIDOADMIN=Comandas/comandaActualizar.php&accion=Eliminar&id='+id+"&acciones=cerrar&roles=cajero";      
        }
    }
    function print(id){
      window.open('PrincipalAdmin.php?CONTENIDOADMIN=Comandas/factura.php&idcomanda='+id+'&accion=print' ,null, null);  //enviar a ver factura y se puede imprimir 
    }
    
       function muestra_oculta(id){
if (document.getElementById){ 
var el = document.getElementById(id); 
el.style.display = (el.style.display == 'none') ? 'block' : 'none'; 
}
}
window.onload = function(){

muestra_oculta('contenido1');
}

    setTimeout("location.reload()", 7000);
    
    </script>