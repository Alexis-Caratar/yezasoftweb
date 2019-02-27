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
require_once dirname(__FILE__) . '/../Clases/Usuario.php';

foreach ($_POST as $Variable => $Valor) {
    ${$Variable} = $Valor;
}
foreach ($_GET as $Variable => $Valor) {
	${$Variable} = $Valor;
}
// Recuperando valores GET.
// nose

$cliente = new Cliente(null, null);
$usuario = new Usuario(null, null);

$cadenaSQL="select nombres,apellidos,telefono,email from cliente where identificacion='$Valor'";
$resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
        
$perfil = new Plato('idplato', 'menu');
$accesos = $perfil->getAccesosEnId();
$sistemas = Plato::getDatosObjetos("idplato='{$perfil->getIdplato()}'", 'idplato');



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

$fechasistema = date("Y-m-d");

$datosClente = Cliente::getDatosEnObjetos($filtro, 'identificacion');

$registrar = '';
$buscador = '';
$img = '';

$registrar="";
    $registrar .= ""
		. "<tr>"
		. "<th><BR>Identificacion : </th><th><label style='width: 130%' name='identificacioncliente' class='input-group-text'>&nbsp;&nbsp;{$Valor}</label></th>"
		. "</tr>"
		. "<tr>"
                . "<th>Nombres :</th><th><label  style='width: 130%'name='nombres' class='input-group-text'>&nbsp;&nbsp;{$resultado[0][0]}</label></th>"
		. "</tr>"
		. "<tr>"
		. "<th>Apellidos :</th><th><label style='width: 130%' name='apellidos' class='input-group-text'>&nbsp;&nbsp;{$resultado[0][1]}</label></th>"
		. "</tr>"
		. "<tr>"
		. "<th>Telefono :</th><th><label name='telefono' style='width: 130%' class='input-group-text'>&nbsp;&nbsp;{$resultado[0][2]}</label></th>"
		. "</tr>"
		. "<tr>"
		. "<th>Email : </th><th><label name='emails' class='input-group-text' style='width: 130%'>&nbsp;&nbsp;{$resultado[0][3]}</label></th>"
		. "</tr>";
    

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
$identificacionx=$Valor;
?>

<style >
    
    tr:hover{
        background: white;
    }
</style>
<center><br><h2>ADICIONAR RESERVA </h2></center>

<div id="Formulario" style="width: 100%">
	<center>
                <form name="formulario" method="POST" action="index.php?CONTENIDO=ReservasWeb/ReservasActualizar.php&identificacion=<?=$identificacionx?>" enctype="multipart/form-data">
                    <input style="background: transparent;border-color: transparent;font-size: 0" name="datos" value="<?= $datos ?>"/>
                    <TABLE style="margin-top: 0;margin-left: -890"><?=$registrar ?></TABLE>
                    <table style="margin-top: 10;margin-left: -600">
                                <tr><br><th>Evento</th><th><select style='width: 60%' class="input-group-text" name="idevento"><?= Evento::getListaEnOptions($reserva->getIdEvento()) ?></select></th></tr>
                                <tr><th>Direccion (*) </th><th><input style='width: 60%'type="text" name="direccion" class="input-group-text" value='<?= $reserva->getDireccion() ?>'></th></tr> 
                                <tr><th>Barrio</th><th><input type="text" style='width: 60%'name="barrio" class="input-group-text" value='<?= $reserva->getBarrio() ?>'></th></tr> 
				<tr><th>Fecha Reserva (*) </th><th><input type="date"  style='width: 60%'class="input-group-text" name="fechareserva" value="<?= $reserva->getFechareserva() ?>" placeholder="ingrese una descripcion" required/></th></tr>
                                <tr><th>Hora (*) </th><th><input type="time" name="hora" style='width: 60%'class="input-group-text" value="<?= $reserva->getHora() ?>" required="" size="2"/>
                                <tr><th>Personas (*) </th><th><input type="number" name="numeropersonas"style='width: 60%' class="input-group-text" value="<?= $reserva->getNumeropersonas() ?>"placeholder="N° Personas" ></th></tr>
                                <tr><th>observacion</th><th><textarea class="input-group-text" placeholder="Ingrese Su Observacion Aqui" name="observacion" cols="50" rows="4"><?= $reserva->getObservacion() ?></textarea>
                                <tr><th><input type="submit" class="btn btn-primary" name="accion" value="Adicionar" id="accion"></th></tr>
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
			<input type="hidden" name="numservicios" value="<?= $k ?>">
                        <input type="hidden" name="vrunitario" value="<?= $objetoPlato->getValor() ?>">
			<input type="hidden" name="identificacion" value="<?= $identificacionx ?>">
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