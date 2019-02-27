<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once dirname(__FILE__). '/../../Clases/ConectorBD.php';
require_once dirname(__FILE__). '/../../Clases/Cargo.php';
$filtro="";
if (isset($_POST['nombre'])&&$_POST['nombre']!=NULL){
    $nombrescargo=$_POST['nombre'];
    $filtro="nombre like'%$nombrescargo%'"; 
            
}

$datos= Cargo::getDatosObjetos($filtro, 'idcargo');
$listaCargos='';
$numero=1;
if (count($datos)>0){
for ($i = 0; $i < count($datos); $i++) {
    $datocargo= $datos[$i];
    
    $listaCargos.='<tr>';
    $listaCargos.="<td>$numero</td>";
    $listaCargos.="<td>{$datocargo->getNombre()}</td>";
    $listaCargos.="<td> $ {$datocargo->getSueldo()} Pesos</td>";
    $listaCargos.="<td><a href='PrincipalAdmin.php?CONTENIDOADMIN=Configuracion/Cargos/formulariocargo.php&idcargo={$datocargo->getIdcargo()}&accion=Modificar'><img src='Presentacion/imagenes/Modificar.png' title='Modificar'></a> <img src='Presentacion/imagenes/Eliminar.png' title='Eliminar' onclick='Eliminar({$datocargo->getIdcargo()})'></td>";
    $listaCargos.='</tr>';
    $numero+=1;
}
}else{
    $listaCargos.="<td class='text-primary'>No se encontraron resultado para su criterio de busqueda. </td>";
}
?>
<div class="offset-8 col-md-4  "style="z-index: 100;  margin: 0% 65%; position: absolute;background: #333333;">
    <form method="post" class="">
     <table class="table-responsive-lg table table-dark table-hover " >
          <tr>
              <th> <img src="presentacion/imagenes/buscarpequeño.png"></span></th><td><input  class="form-control" type="text"  autofocus name="nombre" placeholder="Nombre Cargo" ></td>
              <td><input class="btn-primary"type="submit" value="BUSCAR"></td>
         </tr>
       </table>
 </form>
</div>

<div class="container">
    <br>
    <H2 >CARGOS</H2>
       <table class="tabla container  table-hover table-responsive-lg">
            <thead class="table-dark"><th>NUMERO</th><th>NOMBRE</th><th>SUELDO</th>
                <th><a href="PrincipalAdmin.php?CONTENIDOADMIN=Configuracion/Cargos/formulariocargo.php&accion=Adicionar"><img src="Presentacion/imagenes/Adicionar.png" title="Adicionar"></a></th>
            </thead>
            <?= $listaCargos?>
        </table>
 </div>

<script type="text/javascript">
function Eliminar(id){
    if (confirm("Confirmar Eliminación")) 
    
        location='PrincipalAdmin.php?CONTENIDOADMIN=Configuracion/Cargos/actualizarcargo.php&accion=Eliminar&idcargo='+id;

}

</script>