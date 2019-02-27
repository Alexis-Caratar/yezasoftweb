<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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
    $filtro .= "fechadomicilio between '{$_POST['BFechaInicios']}' and '{$_POST['BFechaFins']}' ";
    $VFechaInicios = $_POST['BFechaInicios'];
    $VFechaFins = $_POST['BFechaFins'];
    $AFechas = 'checked';

    if ($VFechaInicios == '' && $VFechaFins == '') {
        $filtro = null;
    }
}



if (isset($_POST['nombre'])&&$_POST['nombre']!="")  {
   $identificacion=$_POST['nombre'];
   $filtro= " where usuariocaja='$identificacion'";
}

$cadenasql="select idcaja,fecha,base,gasto,usuariocaja,fechasalida  from caja $filtro order by fecha desc ";
$datos= ConectorBD::ejecutarQuery($cadenasql, NULL);
$lista="";
$numero=1;
$dtagasto=0;
if (count($datos)>0){ 
    for ($i = 0; $i < count($datos); $i++) {
         $cadenasql="select sum(valor) from gasto where caja={$datos[$i][0]}";
        $datosgasto= ConectorBD::ejecutarQuery($cadenasql, NULL);
        if (count($datosgasto)>0){
            $dtagasto=$datosgasto[0][0];
        }
        
   $cadenasql="select concat(nombres,apellidos)as nombres from empleado where identificacion={$datos[$i][4]}";
   $datosempleado= ConectorBD::ejecutarQuery($cadenasql, null);
   if (count($datosempleado)>0){
       $lista .= "<tr><th>".$numero."</th>";
      
      $lista .= "<td>".$datos[$i][1]."</td>";
      $lista .= "<td>".$datos[$i][5]."</td>";
      $lista .= "<td>".$datos[$i][2]."</td>";
      $lista .= "<td>".$dtagasto."</th>";
      $lista .= "<td>".$datosempleado[0][0]."</td>";
      
      $lista.="<th><a href='PrincipalAdmin.php?CONTENIDOADMIN=Comandas/formulariocaja.php&accion=Modificar&idcaja={$datos[$i][0]}'><img src=presentacion/imagenes/Modificar.png title='Adicionar'></a>";
      $lista.="<img src=presentacion/imagenes/Eliminar.png title='Eliminar' onClick='eliminar({$datos[$i][0]})'></a>";
      $lista.="<a href='PrincipalAdmin.php?CONTENIDOADMIN=Comandas/comanda.php&idcaja={$datos[$i][0]}'><img src=presentacion/imagenes/enviar.png title='comandas'></a>";
      $lista.="<a href='PrincipalAdmin.php?CONTENIDOADMIN=Comandas/gasto.php&idcaja={$datos[$i][0]}'><img src=presentacion/imagenes/gasto.png title='Gastos' width='30' height='40'></a>";
      $lista.="</th><tr>";
      $numero+=1;
   } 
    }
} else {
    $lista.="<td class='text-primary'>No se encontraron resultado para su criterio de busqueda. </td>";   
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

 
<H2>CAJA</H2><br><br>
    
    <table class="table table-hover table-responsive-lg">
        <tr class="thead-dark">
            <th>Numero</th><th>CAJA ABIERTA</th><th>CAJA CERRADA</th><th>BASE</th><th>GASTO</th><th>USUARIO</th>
        <th><a href="PrincipalAdmin.php?CONTENIDOADMIN=Comandas/formulariocaja.php&accion=Adicionar"><img src="Presentacion/imagenes/Adicionar.png" title="Adicionar" height=""></a></th>
        </tr>
    <?= $lista?>
</table>
</div>

<script>
    function  eliminar(idcaja){
        if(confirm("Realemente desea eliminar este registro"+idcaja))
            location= "PrincipalAdmin.php?CONTENIDOADMIN=Comandas/formulariocaja.php&accion=Eliminar&idcaja="+idcaja;
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

</script>