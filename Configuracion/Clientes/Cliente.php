<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__). '/../../Clases/ConectorBD.php';
require_once dirname(__FILE__). '/../../Clases/Cliente.php';

$filtro = null;

$Id='';
$Identifi='';
if(isset($_POST['Id'])){
	if($filtro!=null)$filtro.=' and ';
	$filtro.="identificacion like'%{$_POST['Identifi']}%'";
	$Identifi=$_POST['Identifi'];
	$Id='checked';
}

$Nomres='';
$nombre='';;
if(isset($_POST['Nomres'])){
	if($filtro!=null)$filtro.=' and ';
        
	$nombre=$_POST['nombre'];
        $filtro.="concat (trim(nombres),' ', trim(apellidos)) like'%{$_POST['nombre']}%' ";
	$Nomres='checked';
}
$datos= Cliente::getDatosEnObjetos($filtro, 'identificacion');
//print_r($registros);//print_r examinar arreglos.
$lista='';
for ($i = 0; $i < count($datos); $i++) {
    $cliente=$datos[$i];
    
    $lista.='<tr id="filas">';
    $lista.="<td>{$cliente->getIdentificacion()}</td><td>{$cliente->getNombres()}</td><td>{$cliente->getApellidos()}</td><td>{$cliente->getDireccion()}</td><td>{$cliente->getTelefono()}</td><td>{$cliente->getEmails()}</td><td>{$cliente->getClave()}</td>";
    $lista.="<td><a href='PrincipalAdmin.php?CONTENIDOADMIN=Configuracion/Clientes/ClienteFormulario.php&identificacion={$cliente->getIdentificacion()}&accion=Modificar'><img src='Presentacion/imagenes/Modificar.png' title='Modificar'></a> <img src='Presentacion/imagenes/Eliminar.png' title='Eliminar' onclick='Eliminar({$cliente->getIdentificacion()})'></td>";
    $lista.='</tr>';
}
?>

<article>
    <center>
        <form method="post">
        <table >
            <tr>
                <td><th><input type="checkbox" name="Id" <?= $Id ?>>Identificacion </th></td>
                <td><input type="number" name="Identifi" value="<?= $Identifi ?>"></td>
                <td><th><input type="checkbox" name="Nomres" <?= $Nomres ?>>Buscar por Cliente </th></td>
                <td><input type="text" name="nombre" value="<?= $nombre ?>"></td>
            </tr>
        </table>
        <h3 ><a href='#' onClick="document.forms[0].action = '';document.forms[0].submit();"><img src='Presentacion/imagenes/buscarpequeño.png' border='0'></a></h3>
    </form>
        </center>
</article>

<center>
<h3>LISTA DE CLIENTES</h3>
<table border="1" id="tablaeventos">
    <tr><th>IDENTIFICACION</th><th>NOMBRES</th><th>APELLIDOS</th><th>DIRECCION</th><th>TELEFONO</th><th>E-MAIL</th><th>CLAVE</th>
        <th><a href="PrincipalAdmin.php?CONTENIDOADMIN=Configuracion/Clientes/ClienteFormulario.php&accion=Adicionar"><img src="Presentacion/imagenes/Adicionar.png" title="Adicionar"></a></th></tr>
    
    </tr>
    <?=$lista?>
</table>
</center>
<script type="text/javascript">
function Eliminar(id){
    if (confirm("Confirmar Eliminación")) 
    
        location='PrincipalAdmin.php?CONTENIDOADMIN=Configuracion/Clientes/ClienteActualizar.php&accion=Eliminar&identificacion='+id;

}

</script>