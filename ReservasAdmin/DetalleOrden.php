<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once dirname(__FILE__). '/../../Clases/ConectorBD.php';
require_once dirname(__FILE__). '/../../Clases/Plato.php';

$datos= Plato::getDatosObjetos(" tipo='P'", 'idplato');
$listaplato='';

for ($i = 0; $i < count($datos); $i++) {
    $datoplato= $datos[$i];
    
    $listaplato.='<tr>';
    $listaplato.="<td>{$datoplato->getIdplato()}</td>";
    $listaplato.="<td>{$datoplato->getNombre()}</td>";
    $listaplato.="<td>{$datoplato->getDescripcion()}</td>";
    $listaplato.="<td> $ {$datoplato->getValor()} pesos</td>";
    $listaplato.="<td>{$datoplato->getTiempopreparacion()} Minutos</td>";
    
   $listaplato.="<td>{$datoplato->getNombreMenus()->getNombre()}</td>";
    
    $listaplato.="<td><img src='{$datoplato->getFoto()}' width='50' height='50'></td>";

    $listaplato.="<td><a href='PrincipalAdmin.php?CONTENIDOADMIN=Configuracion/Platos/formularioplato.php&idplato={$datoplato->getIdplato()}&accion=Modificar'><img src='Presentacion/imagenes/Modificar.png' title='Modificar'></a> <img src='Presentacion/imagenes/Eliminar.' title='Eliminar' onclick='Eliminar({$datoplato->getIdplato()})'></td>";
    $listaplato.='</tr>';
    
    
    
}



?>

<H2>Gestionar Platos</H2>
<center>
    
<table border="1">
    <tr><th>Codigo</th><th>Nombre</th><th>Descripcion</th><th>Valor</th><th>Tiempo Preparacion</th><th>Menu</th><th>Foto</th>
        
     <th><a href="PrincipalAdmin.php?CONTENIDOADMIN=Configuracion/Platos/formularioplato.php&accion=Adicionar"><img src="Presentacion/imagenes/Adicionar.png" title="Adicionar"></a></th></tr>
 
 
    
    <?= $listaplato?>
</table>
    </center>

<script type="text/javascript">
function Eliminar(id){
    if (confirm("Confirmar Eliminación")) 
    
        location='PrincipalAdmin.php?CONTENIDOADMIN=Configuracion/Platos/actualizarplato.php&accion=Eliminar&idplato='+id;

}

</script>