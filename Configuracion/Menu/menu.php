<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once dirname(__FILE__). '/../../Clases/ConectorBD.php';
require_once dirname(__FILE__). '/../../Clases/Menu.php';

$filtro="";
if (isset($_POST['nombre'])&&$_POST['nombre']!=NULL){
    $nombresmenu=$_POST['nombre'];
    $filtro="nombre like'%$nombresmenu%'"; 
            
}


$datos= Menu::getDatosObjetos($filtro, 'idmenu');
$listaMenus='';
$numero=1;
if (count($datos)>0){
for ($i = 0; $i < count($datos); $i++) {
    $datomenu= $datos[$i];
    
    $listaMenus.='<tr>';
    $listaMenus.="<td>$numero</td>";
    $listaMenus.="<td>{$datomenu->getNombre()}</td>";
    $listaMenus.="<td><a href='PrincipalAdmin.php?CONTENIDOADMIN="
            . "Configuracion/Menu/formulariomenu.php&idmenu={$datomenu->getIdmenu()}&"
            . "accion=Modificar'><img src='Presentacion/imagenes/Modificar.png' "
                    . "title='Modificar'></a> <img src='Presentacion/imagenes/Eliminar.png'"
                    . " title='Eliminar' onclick='Eliminar({$datomenu->getIdmenu()})'></td>";
    $listaMenus.='</tr>';
    $numero+=1;   
}
} else {
$listaMenus.="<td class='text-primary'>No se encontraron resultado para su criterio de busqueda. </td>";    
}
?>
<div class="offset-8 col-md-4  "style="z-index: 100;  margin: 0% 65%; position: absolute;background: #333333;">
    <form method="post" class="">
     <table class="table-responsive-lg table table-dark table-hover " >
          <tr>
              <th> <img src="presentacion/imagenes/buscarpequeño.png"></span></th><td><input  class="form-control" type="text"  autofocus name="nombre" placeholder="Nombre menu" ></td>
              <td><input class="btn-primary"type="submit" value="BUSCAR"></td>
         </tr>
       </table>
 </form>
</div>
 

<div class="container">
    <br><br>
    <H2 >MENU</H2><!--titulos principal-->
        <table class="tabla container  table-hover table-responsive-lg">
            <thead  class="table-dark "><th>NUMERO</th><th>NOMBRE DE LA CATEGORIA</th>
                <th><a href="PrincipalAdmin.php?CONTENIDOADMIN=Configuracion/Menu/formulariomenu.php&accion=Adicionar">
                    <img src="Presentacion/imagenes/Adicionar.png" title="Adicionar"></a>
                </th>
            </thead>
            <?= $listaMenus ?>
        </table>
</div>

<script type="text/javascript">
function Eliminar(id){
    if (confirm("Confirmar Eliminación")) 
        location='PrincipalAdmin.php?CONTENIDOADMIN=Configuracion/Menu/actualizarmenu.php&accion=Eliminar&idmenu='+id;

}
</script>
