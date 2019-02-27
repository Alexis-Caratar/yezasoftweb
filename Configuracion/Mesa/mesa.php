<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__). '/../../Clases/ConectorBD.php';
require_once dirname(__FILE__).'/../../Clases/Mesa.php';

$filtro="";
if (isset($_POST['nombre'])&&$_POST['nombre']!=NULL){
    $nombresmenu=$_POST['nombre'];
    $filtro=" concat(area,mesainicial) like'%$nombresmenu%'";            
}

$datos=Mesa::getDatosEnObjeto($filtro, 'idmesa');
$listadoMesa='';
if (count($datos)>0){
for ($i=0; $i< count($datos);$i++){
    $datosMesa=$datos[$i];
    $listadoMesa.='<tr>';
    $listadoMesa.="<td>{$datosMesa->getArea()}</td>";
    $listadoMesa.="<td><input type='color' value='{$datosMesa->getColor()}' disabled></td>";
    $listadoMesa.="<td>{$datosMesa->getMesainicial()}</td>";
    $listadoMesa.="<td>{$datosMesa->getPiso()}</td>";
    $listadoMesa.="<td><a href='PrincipalAdmin.php?CONTENIDOADMIN=Configuracion/Mesa/formularioMesa.php&idmesa={$datosMesa->getIdmesa()}&accion=Modificar'>"
    . "<img src='Presentacion/imagenes/Modificar.png' title='Modificar'></a><img src='Presentacion/imagenes/Eliminar.png' title='Eliminar' onclick='Eliminar({$datosMesa->getIdmesa()})'></td>";
    $listadoMesa.='</tr>';
    
}
  }else {
$listadoMesa.="<td class='text-primary'>No se encontraron resultado para su criterio de busqueda. </td>";    
}
?>

<div class="offset-8 col-md-4  "style="z-index: 100;  margin: 0% 65%; position: absolute;background: #333333;">
    <form method="post" class="">
     <table class="table-responsive-lg table table-dark table-hover " >
          <tr>
              <th> <img src="presentacion/imagenes/buscarpequeño.png"></span></th><td><input  class="form-control" type="text"  autofocus name="nombre" placeholder="Area o Mesa" ></td>
              <td><input class="btn-primary"type="submit" value="BUSCAR"></td>
         </tr>
       </table>
 </form>
</div>

<div class="container">
    <br>
    <H2 >MESAS</H2>
<br>
    <table class="tabla container table-hover table table-responsive-lg">
        <thead class="table-dark">
                <th>AREA</th><th>COLOR</th><th>MESA </th><th>PISO</th>
                <th><a href="PrincipalAdmin.php?CONTENIDOADMIN=Configuracion/Mesa/formularioMesa.php&accion=Adicionar"><img src="Presentacion/imagenes/Adicionar.png" title="Adicionar"></a></th>
        </thead>
            <?=$listadoMesa?>
    </table>
</div>
<script type="text/javascript">
    function Eliminar(id){
        if(confirm("Confirmar Eliminacion"))
            location='PrincipalAdmin.php?CONTENIDOADMIN=Configuracion/Mesa/mesaActualizar.php&accion=Eliminar&idmesa='+id;
    }

</script>