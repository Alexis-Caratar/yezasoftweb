<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require_once dirname(__FILE__) . '/../Clases/ConectorBD.php';
require_once dirname(__FILE__) . '/../Clases/Evento.php';
require_once dirname(__FILE__) . '/../Clases/Reservas.php';
require_once dirname(__FILE__) . '/../Clases/Plato.php';
require_once dirname(__FILE__) . '/../Clases/DetalleOrden.php';
require_once dirname(__FILE__) . '/../Clases/Menu.php';
require_once dirname(__FILE__) . '/../Clases/Cliente.php';
require_once dirname(__FILE__) . '/../Clases/FormatoFecha.php';

foreach ($_GET as $variable => $valor)
	${$variable} = $valor;
// Recuperando valores GET.
// nose
$perfil = new Plato('idplato', 'menu');
$accesos = $perfil->getAccesosEnId();
$sistemas = Plato::getDatosObjetos("idplato='{$perfil->getIdplato()}'", 'idplato');

$mensaje="";

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
$reserva = new Reservas(null, null);
if ($accion == 'Modificar') {
	$reserva = new Reservas('idreserva', $idreserva);
	$cliente = new Cliente("identificacion", $reserva->getIdentificacioCliente());
}// Fin adignación de datos.
//
//fechaDelSistema
$fechasistema = date("Y-m-d");

//para hacer el buscador$$
if ($accion=='Adicionar'){
    $buscador="<input type='number' name='buscadoridentin'>";
    
    if (isset($buscadoridentin)&&$buscadoridentin!=null) {    
        $filtro="identificacion=".$buscadoridentin;
    }
}else
    $buscador="";

$datosClente = Cliente::getDatosEnObjetos($filtro, 'identificacion');

if (count($datosClente)==0) 
    if (isset ($buscadoridentin))
    $mensaje="<font color='red'>El usuario no esta registrado</font>";
else $mensaje="";
 
   


$lista = '';
for ($i = 0; $i < count($datosClente); $i++) {
	$cliente = $datosClente[$i];

	$lista .= '<tr id="fila2">';
	$lista .= "<td>{$cliente->getIdentificacion()}</td><td>{$cliente->getNombresCompletos()}</td><td>{$cliente->getTelefono()}</td><td>{$cliente->getEmails()}</td>";
	//$lista.="<td><a href='principalAdmin?CONTENIDOADMIN=ReservasAdmin/ReservasFormulario.php&idreserva={$objeto->getIdreserva()}&idevento={$objeto->getIdevento()}&identificacioncliente={$objeto->getIdentificacion()}&accion=Modificar'><img src='Presentacion/imagenes/Modificar.png' title='Modificar'></a><a href='principalAdmin?CONTENIDOADMIN=ReservasAdmin/DetalleReserva.php&idreserva={$objeto->getIdreserva()}&idevento={$objeto->getIdevento()}'><img src='Presentacion/imagenes/enviar.png' title='Detalle'></a> <img src='Presentacion/imagenes/Eliminar.' title='Eliminar' onclick='Eliminar({$objeto->getIdreserva()},{$objeto->getIdentificacion()})'></td>";
	$lista .= '</tr>';
}

$registrar = '';


if($accion=='Adicionar'){
    $registrar="";
  
    if($Nomres>0){
        $registrar .= ""
		. "<tr>"
		. "<th><BR>Identificacion : </th><th><label name='identificacioncliente' style='width: 150%' class='input-group-text'>&nbsp;&nbsp;{$cliente->getIdentificacion()}</label></th>"
		. "</tr>"
		. "<tr>"
		. "<th>Nombres :</th><th><label name='nombres' class='input-group-text'>&nbsp;&nbsp;{$cliente->getNombres()}</label></th>"
		. "</tr>"
		. "<tr>"
		. "<th>Apellidos :</th><th><label name='apellidos' class='input-group-text'>&nbsp;&nbsp;{$cliente->getApellidos()}</label></th>"
		. "</tr>"
		. "<tr>"
		. "<th>Telefono :</th><th><label name='telefono' class='input-group-text'>&nbsp;&nbsp;{$cliente->getIdentificacion()}</label></th>"
		. "</tr>"
		. "<tr>"
		. "<th>Email : </th><th><label name='emails' class='input-group-text'>&nbsp;&nbsp;{$cliente->getEmails()}</label></th>"
		. "</tr>";
    }else{
        $registrar .= ""
		. "<tr>"
		. "<th>Identificacion (*) </th><th><input class='input-group-text' style='width: 135%' type='text' name='identificacioncliente' value='{$cliente->getIdentificacion()}' placeholder='N° De Documento' required></th>"
		. "</tr>"
		. "<tr>"
		. "<th>Nombres (*) </th><th><input class='input-group-text' type='text' style='width: 135%' name='nombres' value='{$cliente->getNombres()}' placeholder='Nombres Completos' required maxlength='50'></th>"
		. "</tr>"
		. "<tr>"
		. "<th>Apellidos(*) </th><th><input class='input-group-text' type='text' name='apellidos' style='width: 135%' value='{$cliente->getApellidos()}' placeholder='Apellidos Completos' required maxlength='50'></th>"
		. "</tr>"
		. "<tr>"
		. "<th>Telefono (*) </th><th><input type='tel' name='telefono' class='input-group-text' style='width: 135%' value='{$cliente->getTelefono()}' placeholder='Numero Tel.' required height='20000'/></th></tr>"
		. "<tr>"
		. "<th>E-Mail</th><th><input class='input-group-text' type='email' name='emails' style='width: 135%' value='{$cliente->getEmails()}' placeholder='Correo Electronico' required height='20000'/></th></tr>";
		
    }
    
}else{
    $registrar .= ""
		. "<tr>"
		. "<th>Identificacion : </th><th><label name='identificacioncliente' class='input-group-text' style='width: 135%'>&nbsp;&nbsp;{$cliente->getIdentificacion()}</label></th>"
		. "</tr>"
		. "<tr>"
		. "<th>Nombres :</th><th><label name='nombres' class='input-group-text' style='width: 135%'>&nbsp;&nbsp;{$cliente->getNombres()}</label></th>"
		. "</tr>"
		. "<tr>"
		. "<th>Apellidos :</th><th><label name='apellidos' class='input-group-text' style='width: 135%'>&nbsp;&nbsp;{$cliente->getApellidos()}</label></th>"
		. "</tr>"
		. "<tr>"
		. "<th>Telefono :</th><th><label name='telefono' class='input-group-text' style='width: 135%'>&nbsp;&nbsp;{$cliente->getIdentificacion()}</label></th>"
		. "</tr>"
		. "<tr>"
		. "<th>Email : </th><th><label name='emails' class='input-group-text' style='width: 135%'>&nbsp;&nbsp;{$cliente->getEmails()}</label></th>"
		. "</tr>";
}

//inicio preparacion de la cadena de todos los datos

$detalles = $reserva->getDetallesEnObjetos();
$datos = "";
$lim = 0; // comtrola cuando se adicciona el doble punto ya que con el 'i' del for hay probremas con los platos que tienen el menu como null.
for ($i = 0; $i < count($detalles); $i++) {
	$objetoDetalle = $detalles[$i];
	$plato = $objetoDetalle->getObjetoPlato();
	if ($plato->getMenu() != "") {

		if ($lim > 0)
			$datos .= "::";
		$lim++;
		$datos .= $plato->getIdplato(). ":" . $plato->getNombre() . ":" . $objetoDetalle->getCantidad() . ":" . $objetoDetalle->getVrunitario();
	}
}// fin de concatenar todos los datos de la cadena.

$lista2 = "";

$opciones = Plato::getDatosObjetos("Menu is null", 'idplato');
$Arraydetalles = $reserva->getDetalles(); //Buscamos las reservas en array.

for ($k = 0; $k < count($opciones); $k++) {

	$objetoPlato = $opciones[$k];

	if (is_int(array_search($objetoPlato->getIdplato(), array_column($Arraydetalles, 'plato')))){ // buscamos el id del plato en detalles
		$auxiliar = 'checked';
	}
	else
		$auxiliar = '';
	
	$lista2 .= "<tr>";
	$lista2 .= "<td><input type='checkbox' name='idplato_$k' value='{$objetoPlato->getIdPlato()}' $auxiliar></td>";
	$lista2 .= "<td >{$objetoPlato->getNombre()}</td><td>{$objetoPlato->getDescripcion()}</td><td>{$objetoPlato->getValor()}</td>";
	$lista2 .= "</tr>";
}

// Fin nose
// Inicio nose
$iden=$cliente->getIdentificacion();
?>

<style >
    
    tr:hover{
        background: white;
    }
</style>
<br><br><br>
<center><h2><?= strtoupper($accion) ?> RESERVA </h2></center>
<article>
    <center>
        <form method="POST">
            <?=$buscador?>
        </form>
        <?=$mensaje?>
	</center>
   
</article>


<div id="Formulario" style="width: 100%">
	<center>
                <form name="formulario" method="POST" action="PrincipalAdmin.php?CONTENIDOADMIN=ReservasAdmin/ReservasActualizar.php" enctype="multipart/form-data">
                    <input style="background: transparent;border-color: transparent;font-size: 0" name="datos" value="<?= $datos ?>"/>
                    <TABLE style="margin-top: -80;margin-left: -900"><?=$registrar ?></TABLE>
                    <table style="margin-top: 10;margin-left: -700">
                                <tr><br><th>Evento</th><th><select style='width: 60%' class="input-group-text" name="idevento"><?= Evento::getListaEnOptions($reserva->getIdEvento()) ?></select></th></tr>
                    <tr><th>Direccion (*) </th><th><input type="text" style='width: 60%' name="direccion" class="input-group-text" value='<?= $reserva->getDireccion() ?>' required></th></tr> 
                                <tr><th>Barrio</th><th><input type="text" style='width: 60%' name="barrio" class="input-group-text" value='<?= $reserva->getBarrio() ?>' required></th></tr> 
				<tr><th>Fecha Reserva (*) </th><th><input type="date"  style='width: 60%' class="input-group-text" name="fechareserva" value="<?= $reserva->getFechareserva() ?>" required placeholder="ingrese una descripcion" required/></th></tr>
                                <tr><th>Hora (*) </th><th><input type="time" name="hora" style='width: 60%' class="input-group-text" value="<?= $reserva->getHora() ?>" required="" size="2"/>
                                <tr><th>Personas (*) </th><th><input type="number" name="numeropersonas" style='width: 60%' class="input-group-text" value="<?= $reserva->getNumeropersonas() ?>" required placeholder="N° Personas" ></th></tr>
				<tr><th>Abono</th><th><input type="number" name="abono" class="input-group-text" style='width: 60%'value="<?= $reserva->getAbono() ?>"placeholder="$$$$" ></th></tr>
                                <tr><th>observacion</th><th><textarea class="input-group-text" placeholder="Ingrese Su Observacion Aqui" name="observacion" cols="40" rows="4"><?= $reserva->getObservacion() ?></textarea>
				<tr><th>Piso</th><th><input type="text" name="piso" class="input-group-text" style='width: 60%' value="<?= $reserva->getPiso() ?>" required/></th></tr>
                                <tr><th><input type="submit" class="btn btn-primary" name="accion" value="<?= $accion ?>" id="accion"></th></tr>
                    </table>
                    <table style="margin-top: -225;margin-left: 500">
				<tr>
                                <table border="1" class="table" style="margin-left: 600;margin-top: -400;width: 50%">
                                    <tr><th colspan="4" style="background-color: #49b795"><h6 class="text-center">Servicios (*) </h6></th></tr>
                                        <tr><th></th><th>Opcion</th><th>Descripcion</th><th>Valor</th></tr>
                                        <?= $lista2 ?>
                                    </table>
				</tr>

				<tr>
                                <table border="0" id="tabla" class="table" style="margin-left: 600;width: 50%">
                                </table>                  
					</th>
				</tr>
			</table>
                    <br>
			<input type="hidden" name="idreserva" value="<?= $reserva->getIdreserva() ?>">
			<input type="hidden" name="numservicios" value="<?= $k ?>">
                        <input type="hidden" name="vrunitario" value="<?= $objetoPlato->getValor() ?>">
			<input type="hidden" name="identificacion" value="<?= $cliente->getIdentificacion() ?>">
			<!--<input type="hidden" name="idplato" value="<?= $perfil->getIdplato() ?>"/>-->
			<input type="hidden" name="fechasitema" value="<?= $fechasistema ?>"/>
		</form>

	</center>
</div>

<!-- inico script -->
<script type="text/javascript">

	cargarTabla();

	function cargarTabla() {

		document.getElementById("tabla").innerHTML = "\
        <tr><th colspan='6' style='background-color: #49b795'><h6 class='text-center'>Platos (*) </h6></th></tr>\n\
            <tr>\n\
            <th>N°</th>\n\
            <th>Nombre</th>\n\
            <th>Cantidad</th>\n\
            <th>Valor Unitario</th>\n\
            <th>Sub total</th>\n\
            <th><img src='Presentacion/imagenes/Adicionar.png' title='Adicionar' onclick='adicionar()'></th>\n\
        </tr>";
		if (document.formulario.datos.value != "") {
			var registros = document.formulario.datos.value.split("::");
			for (var i = 0; i < registros.length; i++) {
				var datos = registros[i].split(":");
				var subtotal = parseInt(datos[2]) * parseInt(datos[3]);
				document.getElementById("tabla").innerHTML += "\
                <tr>\n\
                    <td>" + (i+1) + "</td>\n\
                    <td>" + datos[1] + "</td>\n\
                    <td align='right'>" + datos[2] + "</td>\n\
                    <td align='right'>" + datos[3] + "</td>\n\
                    <td align='right'>" + subtotal + "</td>\n\
                    <td><img src='presentacion/imagenes/modificar.png' onClick='modificar(" + datos[0] + ")'>\n\
                    <img src='presentacion/imagenes/eliminar.png' onClick='eliminar(" + datos[0] + ")'></td>\n\
                </tr>";
			}
		}

	}
	function prueva() {

		alert("parse que si");

	}

	function adicionar() {

		var ventana = window.open("ReservasAdmin/formularioDetalleOrden.php?accion=Adicionar", null, "toolbar=no, location=si, directories=no, status=no, menubar=no, scrollbar=no, resizable=no, width=500, height=350, , top=100, left=400");

	}

	function buscarProducto(codigo) {

		var registros = document.formulario.datos.value.split("::");
		var encontrado = false;
		var i = 0;
		var cadena = "";
		while (!encontrado && i < registros.length) {
			var datos = registros[i].split(":");
			if (datos[0] == codigo)
				encontrado = true;
			else
				i++;
		}

		if (encontrado)
			cadena = "codigoProducto=" + datos[0] + "&cantidad=" + datos[2] + "&accion=Moficar";
		return cadena;
	}


	function modificar(codigoProducto) {

		var cadena = buscarProducto(codigoProducto);
		var ventana = window.open("ReservasAdmin/formularioDetalleOrden.php?" + cadena, null, "toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbar=no, resizable=no, width=400, height=250, , top=100, left=400");

	}

	function eliminar(codigoProducto) {

		if (confirm('Está seguro de eliminar este registro?')) {
			var registrosNuevo = "";
			var registros = document.formulario.datos.value.split("::");
			for (var i = 0; i < registros.length; i++) {
				var datos = registros[i].split(":");
				if (datos[0] != codigoProducto) {
					if (registrosNuevo.length > 0)
						registrosNuevo += "::";
					registrosNuevo += registros[i];
				}
			}
			document.formulario.datos.value = registrosNuevo;
			cargarTabla();
		}
	}

</script>