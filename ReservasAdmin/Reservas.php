<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../Clases/ConectorBD.php';
require_once dirname(__FILE__) . '/../Clases/Reservas.php';
require_once dirname(__FILE__) . '/../Clases/Evento.php';



$filtro = null;
$AFecha = '';
$VFechaInicio = '';
$VFechaFin = '';
if (isset($_POST['AFecha'])) {
    if ($filtro != null)
        $filtro .= ' and ';
    $filtro .= "fechasistema between '{$_POST['BFechaInicio']}' and '{$_POST['BFechaFin']}' ";
    $VFechaInicio = $_POST['BFechaInicio'];
    $VFechaFin = $_POST['BFechaFin'];
    $AFecha = 'checked';

    if ($VFechaInicio == '' && $VFechaFin == '') {
        $filtro = null;
    }
}
$AFechas = '';
$VFechaInicios = '';
$VFechaFins = '';
if (isset($_POST['AFechas'])) {
    if ($filtro != null)
        $filtro .= ' and ';
    $filtro .= "fechareserva between '{$_POST['BFechaInicios']}' and '{$_POST['BFechaFins']}' ";
    $VFechaInicios = $_POST['BFechaInicios'];
    $VFechaFins = $_POST['BFechaFins'];
    $AFechas = 'checked';

    if ($VFechaInicios == '' && $VFechaFins == '') {
        $filtro = null;
    }
}

$Nomres = '';
$nombre = '';
;
if (isset($_POST['nombre'])!=null) {
    if ($filtro != null)
        $filtro .= ' and ';

    $nombre = $_POST['nombre'];
    $filtro .= "concat (UPPER(nombres),' ',UPPER(apellidos),identificacioncliente) like UPPER('%{$_POST['nombre']}%' )";
    $Nomres = 'checked';

    if ($nombre == '') {
        $filtro = null;
    }
}

$filtro2=" and ".$filtro;


if ($_SESSION['rol']=='cajero') {
    $cadena="select max(idcaja) from caja";
    $datos1= ConectorBD::ejecutarQuery($cadena, null);
    $filtro=" caja={$datos1[0][0]}";
}
$datos = Reservas::getDatosEnObjetos($filtro, 'fechasistema desc');

$mensaje = " ";
$lista = '';
$p='P';
$R='R';
$color="";
$estados="";
$modificar="";
$eliminar="";

if (count($datos)){
for ($i = 0; $i < count($datos); $i++) {
    $cut = count($datos);
    $cliente = $datos[$i];    
    $item = $i + 1;
    $cadenaSQL="select evento from reserva where idreserva={$cliente->getIdreserva()} ";
    $evento= ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
    if($evento!=null){
        $cadenaSQL="select nombre from evento where idevento={$evento}";
        $event= ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
    }else{
        $event="No Hay Evento";
    }
    
    $cadenaSQL="select  estado from comanda where reserva={$cliente->getIdreserva()}";
    $estado= ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
    $estado=$estado;
    
    if($estado=='P'){
       $color="style='background-color: #F5A9A9'";   
       $eliminar="<img src='Presentacion/imagenes/Eliminar.png' title='Eliminar' onclick='Eliminar({$cliente->getIdreserva()})'>";
       $modificar="<a href='PrincipalAdmin.php?CONTENIDOADMIN=ReservasAdmin/ReservasFormulario.php&idreserva={$cliente->getIdreserva()}&idevento={$cliente->getIdevento()}&identificacioncliente={$cliente->getIdentificacion()}&accion=Modificar'><img src='Presentacion/imagenes/Modificar.png' title='Modificar'></a>";
       $estados="PENDIENTE";
    }elseif($estado=='V'){
        $color="style='background-color: #A9F5F2'";
        $eliminar="";
        $modificar="";
        $estados="VISTA";
    }elseif($estado=='L'){
        $color="style='background-color: #81F781'";
        $eliminar="";
        $modificar="";
        $estados="LISTA EN COCINA";
    }elseif($estado=='E'){
        $color="style='background-color: #64FE2E'";
        $eliminar="";
        $modificar="";
        $estados="ENTREGADA";
        $modificar.="<td><button title='Crear Factura' onclick='print({$datosComanda->getIdcomanda()})'><img src='Presentacion/imagenes/bill.png'  ></button><td>";
    }
    elseif($estado=='PG'){
        $color="style='background-color: #2E9AFE'";
        $eliminar="";
        $modificar="";
        $estados="PAGADO";
    }
    
    $lista .= "<tr $color>";
    $lista .= "<td>{$item}</td><td>{$cliente->getIdentificacioCliente()}</td><td>{$cliente->getNombresCompletos()}</td><td>{$event}</td><td>{$cliente->getFechasistema()}</td><td colspan='2'>{$cliente->getFechaYHora()}</td><td>{$cliente->getNumeropersonas()}</td><td>{$cliente->getDireccionYBario()}</td><td>{$cliente->getTotal()}</td><td>{$cliente->getAbono()}</td><td>{$cliente->getSaldos()}</td><td>{$estados}</td>";
    $lista .= "<td>$modificar$eliminar<a href='PrincipalAdmin.php?CONTENIDOADMIN=ReservasAdmin/DetalleReserva.php&idreserva={$cliente->getIdreserva()}&identificacioncliente={$cliente->getIdentificacion()}&accion=Modificar'><img src='Presentacion/imagenes/enviar.png' title='Detalle'> </a>  <button onClick='imprimir({$cliente->getIdreserva()})' class='btn btn-primary'>Factura</button></td>";
    $lista .= '</tr>';
}}else{
    $lista.="<td>No se encontraron resultados</td>";
}


?>
<div class="offset-8 col-md-4  "style="z-index: 100;  margin: 0% 65%; position: absolute;background: #333333;">
    <form method="post" class="">
     <table class="table-responsive-lg table table-dark table-hover " >
          <tr>
              <th> <img src="presentacion/imagenes/buscarpequeño.png"></span></th><td><input  class="form-control" type="text"  autofocus name="nombre" placeholder="Identificacion o Nombre" ></td>
              <td><input class="btn-primary"type="submit" value="BUSCAR"></td>
         </tr>
       </table>
 </form>

 

      
  <a style='cursor: pointer;color: white;' onClick="muestra_oculta('contenido1')" title="BUSQUEDA AVANZADA" class="btn-dark offset-5"><img src="presentacion/imagenes/lista.png"width="20" height="15"> Busqueda Avanzada </a>
  
 <!--busqueda avanzada-->

<div class="contenido1" id="contenido1">
    <form method="post">
        <div id="ColosTitulos">
            <center>
                <table class="table-hover"style="color:white; ">
                <tr>
                    <td><h6><input type="checkbox" id="check" name="AFecha" <?= $AFecha ?>class="input-group"><label for='check'>Registro</label></h6></td>   
                </tr>
                <tr>
                    <td>
                        <div class="input-group-text">
                            <span class="input-group-text">inicio(*)</span>   
                        <input type="date" name="BFechaInicio" value="<?= $VFechaInicio ?>" class="form-control"></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="input-group-text">
                        <span class="input-group-text">fin(*)</span><input type="date" name="BFechaFin" value="<?= $VFechaFin ?> "class="form-control"></div>
                    </td>
                </tr>
                <tr>
                <td><h6><input type="checkbox" id="check2" name="AFechas" <?= $AFechas ?>class="input-group"><label for='check2'>Reserva</label></h6></td>
                </tr>
                <tr> 
                    <td>
                        <div class="input-group-text">
                            <span class="input-group-text">inicio(*)</span><input type="date" name="BFechaInicios" value="<?= $VFechaInicios ?>"class="form-control"></div>
                    </td>
                </tr>
                <tr>
                        <td>
                            <div class="input-group-text">
                            <span class="input-group-text">fin(*)</span><input type="date" name="BFechaFins" value="<?= $VFechaFins ?>"class="form-control"></div>
                        </td>
                     </tr>
                     <tr>
                     <table>
                         <tr>
                            
                         <td>
                         <th>
                             <div class="col-md-4 col-md-offset-4">
                                 <a class="btn-primary" href='#' onClick="document.forms[0].action = '';document.forms[0].submit();">BUSCAR</a>
                    </div>
                         </th>
                         </td>
                         </tr>
                     </table>
                         </tr>
                </table>
             </form>
</div>
</div> 
  
 </div>
<br>
 <!--ESTADOS--> 
 <div class="table-dark col-2" style="background:#333333;z-index: 100;position: absolute;" >
        <div class="offset-0">
            <a  style='cursor: pointer;' onClick="muestra_oculta('contenido')" title="" ><img src="presentacion/imagenes/lista.png"width="20" height="20"> Informacion</a>
        </div>
     
      <div  id="contenido" >
          <table class="table-content"style="color: white">
            <tr><td>PENDIENTE</td><td><input type="color" value="#F5A9A9" disabled></td><tr>
            <tr><td>VISTO EN COCINA</td><td><input type="color" value="#A9F5F2" disabled></td><tr>
            <tr><td>LISTO EN COCINA</td><td><input type="color" value="#81F781" disabled></td><tr>
            <tr><td>ENTREGADO</td><td><input type="color" value="#64FE2E" disabled></td><tr>
            <tr><td>PAGADO</td><td><input type="color" value="#2E9AFE" disabled></td><tr>
        </table>
    </div>
</div> 
 <br>
 
<H2 >RESERVAS</H2>
   <div class="container-fluid ">
     <table class="table table-hover  table-responsive-lg ">
        <thead  class="table-dark">
                    <th>N°</th><th>Identificaion</th><th>Cliente</th><th>Evento</th><th>Fecha Registro</th><th colspan="2">Fecha Reserva</th><th>Personas</th><th>Direccion</th><th>Total</th><th>Abono</th><th>Saldo</th><th>Estado</th>
                    <th><a href="PrincipalAdmin.php?CONTENIDOADMIN=ReservasAdmin/ReservasFormulario.php&accion=Adicionar"><img src="Presentacion/imagenes/Adicionar.png" title="Adicionar"></a></th> 
         </thead>
              <?= $lista ?>
       </table>   
</div>
  

<script type="text/javascript">
    function Eliminar(id) {
        if (confirm("Confirmar Eliminación")) 
            location = 'PrincipalAdmin.php?CONTENIDOADMIN=ReservasAdmin/ReservasActualizar.php&accion=Eliminar&idreserva='+id;

    }
    
    function imprimir(id){
        
      window.open('Principal.php?CONTENIDOADMIN=ReservasAdmin/Imprimir.php&id='+id);  
    }


//funcion para ocultar y mosrar contenido
function muestra_oculta(id){
if (document.getElementById){ 
var el = document.getElementById(id); 
el.style.display = (el.style.display == 'none') ? 'block' : 'none'; 
}
}
window.onload = function(){
muestra_oculta('contenido');
muestra_oculta('contenido1');
}

</script>