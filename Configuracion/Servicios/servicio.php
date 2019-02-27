<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once dirname(__FILE__). '/../../Clases/ConectorBD.php';
require_once dirname(__FILE__). '/../../Clases/Plato.php';
$filtro="";
if (isset($_POST['nombre'])&&$_POST['nombre']!=NULL){
    $nombreservicio=$_POST['nombre'];
    $filtro=" and nombre like'%$nombreservicio%'"; 
            
}

$datos= Plato::getDatosObjetos(" tipo='S' $filtro ", 'idplato');
$listaplatos='';
$numero=1;
if (count($datos)>0){
for ($i = 0; $i < count($datos); $i++) {
    $datoplato= $datos[$i];
    
    $listaplatos.='<tr>';
    $listaplatos.="<td>$numero</td>";
    $listaplatos.="<td>{$datoplato->getNombre()}</td>";
    $listaplatos.="<td>{$datoplato->getValor()}</td>";
    $listaplatos.="<td>{$datoplato->getDescripcion()}</td>";
     $listaplatos.="<td><img src='{$datoplato->getFoto()}' width='50' height='50'></td>";
    $listaplatos.="<td><a href='PrincipalAdmin.php?CONTENIDOADMIN=Configuracion/Servicios/formularioservicio.php&idplato={$datoplato->getIdplato()}&accion=Modificar'><img src='Presentacion/imagenes/Modificar.png' title='Modificar'></a> <img src='Presentacion/imagenes/Eliminar.png' title='Eliminar' onclick='Eliminar({$datoplato->getIdplato()})'></td>";
    $listaplatos.='</tr>';
    $numero+=1;
}
}else{
    $listaplatos.="<td>No se encontraron resultado por su criterio de busqueda. </td>";
}


?>
<div class="offset-8 col-md-4  "style="z-index: 100;  margin: 0% 65%; position: absolute;background: #333333;">
    <form method="post" class="">
     <table class="table-responsive-lg table table-dark table-hover " >
          <tr>
              <th> <img src="presentacion/imagenes/buscarpequeño.png"></span></th><td><input  class="form-control" type="text"  autofocus name="nombre" placeholder="Nombre Servicio" ></td>
              <td><input class="btn-primary"type="submit" value="BUSCAR"></td>
         </tr>
       </table>
 </form>
</div>

<div class="container"><br>
    <H2 >SERVICIOS</H2>
    <table class="table table-responsive-lg table-hover ">
          <thead class="table-dark "><th>Numero</th><th>Nombre</th><th>Valor</th> <th>Descripcion</th><th>Foto</th>
                <th><a href="PrincipalAdmin.php?CONTENIDOADMIN=Configuracion/Servicios/formularioservicio.php&accion=Adicionar"><img src="Presentacion/imagenes/Adicionar.png" title="Adicionar"></a></th>
          </thead>
        <?= $listaplatos?>
    </table>
   

</div>
<script type="text/javascript">
function Eliminar(id){
    if (confirm("Confirmar Eliminación")) 
    
        location='PrincipalAdmin.php?CONTENIDOADMIN=Configuracion/Servicios/actualizarservicio.php&accion=Eliminar&idplato='+id;

}

</script>