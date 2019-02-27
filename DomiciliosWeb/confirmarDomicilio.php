<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../Clases/ConectorBD.php';
require_once dirname(__FILE__) . '/../Clases/Cliente.php';
require_once dirname(__FILE__) . '/../Clases/Domicilio.php';

foreach ($_GET as $variable => $valor)
	${$variable} = $valor;

$datos = $_POST['datosPlatosTabla'];
$listaPlatos = "";

$arrayPlatos = explode("||", $datos);
for ($i = 0; $i < count($arrayPlatos); $i++) {
    $datosPlato = explode("|", $arrayPlatos[$i]);
    $subTotal = $datosPlato[1] * $datosPlato[2];
    $cadenaSQL="select idplato from plato where nombre='$datosPlato[0]'";
    $ids= ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
    $listaPlatos .= "<tr>";
    $listaPlatos .= "<td>$ids</td><td>$datosPlato[0]</td><td>$datosPlato[1]</td><td>$datosPlato[2]</td><td>$subTotal</td>";
    $listaPlatos .= "</tr>";
    
    $cadenaSQL="insert into detalleOrden(comanda, cantidad, plato, domicilio, vrUnitario)";
    
}

$filtro = null;
$Nomres = '';
$nombre = '';
if (isset($_POST['Nomres'])) {
	if ($filtro != null)
		$filtro .= ' and ';

	$nombre = $_POST['nombre'];
	$filtro .= "identificacion ='{$_POST['nombre']}' ";
	$Nomres = 'checked';
} // Fin de nose
// Inicio de asiganción de datos para modificar y adicionar

$cliente = new Cliente(null, null);
$domicilio = new Domicilio(null, null);
if ($variable == 'Modificar') {
	$domicilio = new Domicilio('iddomicilio', $iddomicilio);
	$cliente = new Cliente("identificacion", $domicilio->getIdentificacioCliente());
}// Fin adignación de datos.
//
//fechaDelSistema
$fechasistema = date("Y-m-d");

$datosClente = Cliente::getDatosEnObjetos($filtro, 'identificacion');

$lista = '';

for ($i = 0; $i < count($datosClente); $i++) {
	$cliente = $datosClente[$i];

	$lista .= '<tr id="fila2">';
	$lista .= "<td>{$cliente->getIdentificacion()}</td><td>{$cliente->getNombresCompletos()}</td><td>{$cliente->getTelefono()}</td><td>{$cliente->getEmails()}</td>";
	//$lista.="<td><a href='PrincipalAdmin.php?CONTENIDOADMIN=ReservasAdmin/ReservasFormulario.php&idreserva={$objeto->getIdreserva()}&idevento={$objeto->getIdevento()}&identificacioncliente={$objeto->getIdentificacion()}&accion=Modificar'><img src='Presentacion/imagenes/Modificar.png' title='Modificar'></a><a href='PrincipalAdmin.php?CONTENIDOADMIN=ReservasAdmin/DetalleReserva.php&idreserva={$objeto->getIdreserva()}&idevento={$objeto->getIdevento()}'><img src='Presentacion/imagenes/enviar.png' title='Detalle'></a> <img src='Presentacion/imagenes/Eliminar.' title='Eliminar' onclick='Eliminar({$objeto->getIdreserva()},{$objeto->getIdentificacion()})'></td>";
	$lista .= '</tr>';
}

$registrar = '';
$buscador = '';
$img = '';

if($accion=='Adicionar'){
    $registrar="";
    $img="<input type='submit' value='BUSCAR' class='btn btn-primary'>";
    $buscador .= ""
		. "<table clasS='table'>"
		. "<tr>"
		. "<th><input id='check' type='checkbox' name='Nomres' $Nomres><label for='check'>Identificacion Del Cliente</label></th>"
		. "<input type='text' value='$datos' name='datosPlatosTabla' style='background: transparent;border-color: transparent;font-size: 0'> "
		. "<td> <input class='input-group-text'type='n' name='nombre' value='$nombre'> $img</td>"
		. "</tr>"
		. "</table>";
    
    if($Nomres>0){
        $registrar .= ""
		. "<tr>"
		. "<th><BR>Identificacion : </th><th><label name='identificacioncliente' class='form-control'>&nbsp;&nbsp;{$cliente->getIdentificacion()}</label></th>"
		. "</tr>"
		. "<tr>"
		. "<th>Nombres :</th><th><label name='nombres' class='form-control'>&nbsp;&nbsp;{$cliente->getNombres()}</label></th>"
		. "</tr>"
		. "<tr>"
		. "<th>Apellidos :</th><th><label name='apellidos' class='form-control'>&nbsp;&nbsp;{$cliente->getApellidos()}</label></th>"
		. "</tr>"
		. "<tr>"
		. "<th>Telefono :</th><th><label name='telefono' class='form-control'>&nbsp;&nbsp;{$cliente->getIdentificacion()}</label></th>"
		. "</tr>"
		. "<tr>"
		. "<th>Email : </th><th><label name='emails' class='form-control'>&nbsp;&nbsp;{$cliente->getEmails()}</label></th>"
		. "</tr>";
    }else{
        $registrar .= ""
		. "<tr>"
		. "<th><br><br>Identificacion (*) </th><th><br><br><input class='form-control' type='text' name='identificacioncliente' value='{$cliente->getIdentificacion()}' placeholder='N° De Documento' required></th>"
		. "</tr>"
		. "<tr>"
		. "<th>Nombres (*) </th><th><input class='form-control' type='text' name='nombres' value='{$cliente->getNombres()}' placeholder='Nombres Completos' required maxlength='15'></th>"
		. "</tr>"
		. "<tr>"
		. "<th>Apellidos(*) </th><th><input class='form-control' type='text' name='apellidos' value='{$cliente->getApellidos()}' placeholder='Apellidos Completos' required maxlength='15'></th>"
		. "</tr>"
		. "<tr>"
		. "<th>Telefono (*) </th><th><input type='tel' name='telefono' class='form-control' value='{$cliente->getTelefono()}' placeholder='Numero Tel.' required height='20000'/></th></tr>"
		. "<tr>"
		. "<th>E-Mail</th><th><input class='form-control' type='email' name='emails' value='{$cliente->getEmails()}' placeholder='Correo Electronico' required height='20000'/></th></tr>";
		
    }
    
}else{
    $registrar .= ""
		. "<tr>"
		. "<th><br><br>Identificacion : </th><th><br><br><label name='identificacioncliente' class='form-control'>&nbsp;&nbsp;{$cliente->getIdentificacion()}</label></th>"
		. "</tr>"
		. "<tr>"
		. "<th>Nombres :</th><th><label name='nombres' class='form-control'>&nbsp;&nbsp;{$cliente->getNombres()}</label></th>"
		. "</tr>"
		. "<tr>"
		. "<th>Apellidos :</th><th><label name='apellidos' class='form-control'>&nbsp;&nbsp;{$cliente->getApellidos()}</label></th>"
		. "</tr>"
		. "<tr>"
		. "<th>Telefono :</th><th><label name='telefono' class='form-control'>&nbsp;&nbsp;{$cliente->getIdentificacion()}</label></th>"
		. "</tr>"
		. "<tr>"
		. "<th>Email : </th><th><label name='emails' class='form-control'>&nbsp;&nbsp;{$cliente->getEmails()}</label></th>"
		. "</tr>";
}  
?>
<br>
<div class="container " >
    <div class="row container-fluid">
        <div class="col-md-5"><br>
            <center><h2 class="text-center" style="font-weight: bold; font-size: 50px;"><?= strtoupper($accion) ?> DOMICILIO </h2></center>
<article>
   
        <form method="post"><br>
            <?=$buscador?>
            <h3 ><a href='#' onClick="document.forms[0].action = '';document.forms[0].submit();"></a></h3>
		</form>
	
</article>

<div id="Formulario" >
	
            <form name="formulario" method="POST" action="index.php?CONTENIDO=DomiciliosWeb/DomiciliosActualizar.php&IDENTIFICACION=<?=$cliente->getIdentificacion()?>" enctype="multipart/form-data">
                <input type="hidden" name="datos" value="<?= $datos ?>"/>
                    <TABLE ><?=$registrar ?></TABLE>
                    <table class="table">
                            <tr><th><br>Direccion (*) </th><th><br><input class="form-control" type="text" name="direccion"  value='<?= $domicilio->getDireccion() ?>'></th></tr> 
                            <tr><th>Barrio</th><th><input type="text" name="barrio" class="form-control" value='<?= $domicilio->getBarrio() ?>'></th></tr> 
                            <tr><th>Fecha Domicilio (*)</th><th><input class="form-control" type="date" name="fechadomicilio" value="<?= $domicilio->getFechadomicilio() ?>" placeholder="ingrese una descripcion" required/></th></tr>
                            <tr><th>Hora (*) </th><th><input type="time" name="hora" class="form-control" value="<?= $domicilio->getHora() ?>" required="" size="2"/>
                            <center><tr><th><input type="submit" class="btn btn-primary" name="accion" value="<?= $valor ?>" id="accion"> </th></tr> </center> 
			</table>
                    <br>
                    <input type="hidden" name="iddomicilio" value="<?= $domicilio->getIddomicilio() ?>">
			<input type="hidden" name="identificacion" value="<?= $cliente->getIdentificacion() ?>">
                        <input type='hidden' value='<?=$datos?>' name='datosPlatosTablaActualizar'>
			<input type="hidden" name="fechasitema" value="<?= $fechasistema ?>"/></form>

	
</div>

</div>
        <br>
        <div class="col-md-5 offset-2"><br>
    <h2 class="text-center text-primary" style="font-weight: bold; font-size: 30px;">Listado de los platos pedidos</h2>

<table  class="table table-hover hover table-light">
    <tr><th>Id</th><th>Plato</th><th>Vr Unitario</th><th>Cantidad</th><th>SubTotal</th></tr>
    <?= $listaPlatos ?>
</table>
</div>

</div>

</div>