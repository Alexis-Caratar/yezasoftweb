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
 $filtro2="";
 $orden="";
 $cocinaad="";
 $cocina="";
 $listadoComanda='';
 $mesasocomandas="";

;
if (isset($_POST['nombre'])&&$_POST['nombre']!=null)  {
   $idmesa=$_POST['nombre'];
if ($idmesa!=0){
   $cadena="select idmesa from mesa where mesainicial='$idmesa'";
   $datosmesas=ConectorBD::ejecutarQuery($cadena, null);
   $filtro=" mesa={$datosmesas[0][0]} and ";

}   
   }
$_SESSION['user'];

$idcomanda='';
$modificar='';//variable para modificar adinistrador o cocina
$Adicionar="";


$usuariorol=$_SESSION['rolesi'];
if (isset($_GET['idcaja'])){$aux=$_GET['idcaja'];}else{$aux="";}
    $cadenaSQLcaja="SELECT MAX(idcaja) FROM caja";
    $datoscaja= ConectorBD::ejecutarQuery($cadenaSQLcaja, 'yezasoft');
if ($usuariorol=='admin'){
    $filtro.="reserva is null and domicilio is null and caja='$aux'";
    $orden.="fecha desc";
}
if($usuariorol=='cajero'){
    $filtro.="  reserva is null and domicilio is null and caja='{$datoscaja[0][0]}'";
    $orden.="fecha desc";
}
if($usuariorol=='cocina'){
    $filtro.="  caja={$datoscaja[0][0]} ";
    $orden.="idcomanda asc";
}

//crear variable para los datos
$datos= Comandas::getDatosEnObjeto($filtro,$orden);
//para cocina
if ($_SESSION['rolesi']=='cocina') {
    $cocina.=' <div class="container">
                                <div class="row">
                                    <div class="col-12 menu-heading">
                                        <div class="section-heading text-center">
                                       
                                        </div>
                                               </div>
                                </div>
                                <div class="row">
                                  
                               ';
}

if (count($datos)>0){
        for ($i = 0; $i < count($datos); $i++) {
            //crear nueva variable
            $datosComanda=$datos[$i];
            if ($datosComanda->getEstado()!='LISTO EN COCINA' || $_SESSION['rolesi']=='admin' || $_SESSION['rolesi']=='cajero' ) {
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
                 if ($_SESSION['rolesi']=='cajero') {
                $modificar="<form method='post' action='PrincipalAdmin.php?CONTENIDOADMIN=Comandas/comandaListaPlato.php'>
                            <input type='hidden' name='idcomanda' value='{$datosComanda->getIdcomanda()}'>                
                            <input type='hidden' name='accion' value='Adicionar'>                
                            <td><button  title='Modificar'><img src='Presentacion/imagenes/Modificar.png'></button>
                            </form>";
                              $Adicionar= '<th><button title="Adicionar"><img src="Presentacion/imagenes/Adicionar.png"  ></button></th>';
                       if ($datosComanda->getEstado()!='LISTO EN COCINA'){
                       $modificar.="<img src='Presentacion/imagenes/Eliminar.png' title='Eliminar' onclick='Eliminarcaje(".$datosComanda->getIdcomanda().")'></td>";
                              }    
                 }        
        elseif ($_SESSION['rolesi']=='cocina') {
        //si es rol cocina permite cambiar el estado visto en cocina
            $cocinaad="<form method='post' action='PrincipalAdmin.php?CONTENIDOADMIN=Comandas/comandaListaPlato.php'>
                        <input type='hidden' name='idcomanda' value='{$datosComanda->getIdcomanda()}'>                
                        <input type='hidden' name='vista' value='true'>                
                        <input type='hidden' name='accion' value='Adicionar'>                
                        <button class='btn btn-primary' title='ver'>ver comandas</button>
                </form>";
                        if ($datosComanda->getEstado()=='VISTA EN COCINA') {//permite si ya esta en visto en cocina permite el boton para enl estado a listo
            $cocinaad.="<form method='post' action='PrincipalAdmin.php?CONTENIDOADMIN=Comandas/comandaListaPlato.php'>
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

        if ($_SESSION['rolesi']!='cocina') {
            $listadoComanda.="<tr>";
            $listadoComanda.="<td>".($i+1)."</td>";
            $listadoComanda.="<td>{$datosComanda->getEmpleado()}</td>";
            $mesaocomanda=$datosComanda->getnumeromesa()->getMesainicial();
            if ($mesaocomanda==null){$mesasocomandas="Sin mesa";}else{$mesasocomandas=$mesaocomanda;}
            $listadoComanda.="<td>$mesasocomandas</td>";
            $listadoComanda.="<td>{$datosComanda->getFecha()}</td>";
            $listadoComanda.="<td>{$datosComanda->getEstado()}</td>";
            $listadoComanda.="<td>{$datosComanda->getFactura()}</td>";
            $listadoComanda.="<td> $modificar</td>";
            $listadoComanda.="</tr>";

            // $modificar="<td><button title='Crear Factura' onclick='print({$datosComanda->getIdcomanda()})'><img src='Presentacion/imagenes/bill.png'  ></button><td>";
        }else{   
            
                $cocina.=' <div class="col-12 col-sm-6 col-md-4">';
                $cocina.='<div class="caviar-single-dish wow fadeInUp" data-wow-delay="0.5s">';
                $cocina.='<h6 class="dish-name"> Numero:'.($i+1-1).'</h6>
                        <h6 class="dish-name"> fecha: '.$datosComanda->getFecha().'</h6>
                        <h6 class="dish-name"> Empleado: '.$datosComanda->getEmpleado().'</h6>
                            <h6 class="dish-name"> Factura: '.$datosComanda->getFactura().'</h6>
                                <div class="dish-info">
                                    
                                    <h6 class="dish-name"> Estado:'.$datosComanda->getEstado().'</h6>
                                    <p class="dish-price">'.$datosComanda->getnumeromesa()->getMesainicial().'</p>';

                $cocina.= '</div>';
                $cocina.='<h6 class="dish-name">'.$cocinaad.'</h6>
                            </div>
                        </div>';
        }
        }
            }
            if ($_SESSION['rolesi']=='cocina') {$cocina.=' </div></div>';}
} else {
    $listadoComanda.="<td class='text-primary'>No se encontraron resultado para su criterio de busqueda. </td>";
    $Adicionar= '<th><button title="Adicionar"><img src="Presentacion/imagenes/Adicionar.png"  >  </button></th>';  
}
   
?>
<link href="Presentacion/css/cj/responsive.css" rel="stylesheet" type="text/css"/>
<link href="Presentacion/css/cj/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="Presentacion/css/cj/style.css" rel="stylesheet" type="text/css"/>



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

  <?=$menu?>
    
    <H2 >COMANDAS</H2>
<br>
<br>
<?php if ($_SESSION['rolesi']=='admin'||$_SESSION['rolesi']=='cajero'){ ?>
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



<?php }?>

   <section class="caviar-dish-menu" id="menu" >
                  <?=$cocina?>
   </section>

<?=$mennsajecomanda?>
</div>


<script src="../Presentacion/css/cj/active.js" type="text/javascript"></script>
<script src="../Presentacion/css/cj/bootstrap.min.js" type="text/javascript"></script>
<script src="../Presentacion/css/cj/jquery-2.2.4.min.js" type="text/javascript"></script>
<script src="../Presentacion/css/cj/plugins.js" type="text/javascript"></script>
<script src="../Presentacion/css/cj/popper.min.js" type="text/javascript"></script>
<script type="text/javascript">
    
<script type="text/javascript">
    function Eliminar(id){
       if(confirm('Desea eliinar esta comanda')){
           location='PrincipalAdmin.php?CONTENIDOADMIN=Comandas/comandaActualizar.php&accion=Eliminar&id='+id;      
        }
    }
    function Eliminarcaje(id){
       if(confirm('Desea eliinar esta comanda')){
           location='PrincipalAdmin.php?CONTENIDOADMIN=Comandas/comandaActualizar.php&accion=Eliminar&id='+id;      
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