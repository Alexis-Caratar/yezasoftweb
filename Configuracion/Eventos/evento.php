<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__). '/../../Clases/ConectorBD.php';
require_once dirname(__FILE__). '/../../Clases/Evento.php';
$filtro="";
if (isset($_POST['nombre'])&&$_POST['nombre']!=NULL){
    $nombresevento=$_POST['nombre'];
    $filtro=" nombre like'%$nombresevento%'"; 
            
}
$datos= Evento::getDatosEnObjetos($filtro, 'idevento');
$lista='';
$numero=1;
if (count($datos)>0){
for ($i = 0; $i < count($datos); $i++) {
    $objeto=$datos[$i];
    
    $lista.='<tr id="filas">';
    $lista.="<td>$numero</td>";
    $lista.="<td>{$objeto->getNombre()}</td><td>{$objeto->getDescripcion()}</td>";
    $lista.="<td id='forularioContenido'><img src='{$objeto->getFoto()}' width='80' height='70' ></td>";
    $lista.="<td><a href='PrincipalAdmin.php?CONTENIDOADMIN=Configuracion/Eventos/formularioevento.php&idevento={$objeto->getIdevento()}&accion=Modificar'><img src='Presentacion/imagenes/Modificar.png' title='Modificar'></a> <img src='Presentacion/imagenes/Eliminar.png' title='Eliminar' onclick='Eliminar({$objeto->getIdevento()})'></td>";
    $lista.='</tr>';
    $numero+=1;
}
} else {
$lista.="<td class='text-primary'>No se encontraron resultado para su criterio de busqueda. </td>";    
}
?>

<div class="offset-8 col-md-4  "style="z-index: 100;  margin: 0% 65%; position: absolute;background: #333333;">
    <form method="post" class="">
     <table class="table-responsive-lg table table-dark table-hover " >
          <tr>
              <th> <img src="presentacion/imagenes/buscarpequeño.png"></span></th><td><input  class="form-control" type="text"  autofocus autocomplete name="nombre" placeholder="Nombre Evento" ></td>
              <td><input class="btn-primary"type="submit" value="BUSCAR"></td>
         </tr>
       </table>
 </form>
</div>

<div class="container"><br>
    <h2   > EVENTOS </h2>
    <table  class="table table-hover table-responsive-lg">
        <thead class="table-dark"><th>NUMERO</th><th>NOMBRE</th><th>DESCRIPCION</th><th>FOTO</th>
            <th><a href="PrincipalAdmin.php?CONTENIDOADMIN=Configuracion/Eventos/formularioevento.php&accion=Adicionar"><img src="Presentacion/imagenes/Adicionar.png" title="Adicionar"></a></th></tr>
        </thead>
        <?=$lista?>
    </table>
</div>

<script type="text/javascript">
function Eliminar(id){
    if (confirm("Confirmar Eliminación")) 
    
        location='PrincipalAdmin.php?CONTENIDOADMIN=Configuracion/Eventos/actualizarevento.php&accion=Eliminar&idevento='+id;

}

</script>