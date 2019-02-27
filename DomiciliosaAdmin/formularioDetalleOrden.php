<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require_once dirname(__FILE__) . '/../Clases/ConectorBD.php';
require_once dirname(__FILE__) . '/../Clases/Plato.php';
require_once dirname(__FILE__) . '/../Clases/DetalleOrden.php';
require_once dirname(__FILE__) . '/../Clases/Cliente.php';

foreach ($_GET as $variable => $valor)
	${$variable} = $valor;
$platos = new DetalleOrden(null, null);

if ($accion == 'Modificar')
	$platos = new DetalleOrden("iddetalle", 1);
else
	$platos = new DetalleOrden(null, null);

$cliente = new Cliente(null, null);

$codigoProducto = "";

// continuar con el modificar que da error

$accion = $_GET['accion'];

if (isset($_GET['codigoProducto']))
	$codigoProducto = $_GET['codigoProducto'];
    print_r($codigoProducto);

$cantidad = "1";

if (isset($_GET['cantidad']))
	$cantidad = $_GET['cantidad'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Adicion De Platos A La Factura</title>
        <script type="text/javascript">

<?= Plato::getDatosEnArregloJS() ?>
			// presenta el valor de cada producto seleccionado.
			function presentarValor(codigo) {
				var encontrado = false;
				var i = 0;
				while (!encontrado && i < productos.length) {
					if (productos[i][0] === codigo)
						encontrado = true;
					else
						i++;
				}
				if (encontrado)
					document.getElementById("vrUnitario").innerHTML = productos[i][2];
				else
					document.getElementById("vrUnitario").innerHTML = 0;
			}//fin presentar cada produto seleccionado.

			//cambia la cantidad cuando modifica un producto y este ya existe.
			function cambiarCantidad() {
				var encontrado = false;
				var registros = window.opener.document.formulario.datos.value.split("::");
				for (var i = 0; i < registros.length; i++) {
					var registro = registros[i].split(":");
					if (registro[0] == document.formulario.codigoProducto.value) {
						var cantidad = parseInt(registro[2]) + parseInt(document.formulario.cantidad.value);
						encontrado = true;
					} else if (encontrado == false)
						cantidad = document.formulario.cantidad.value;
				}
				document.formulario.cantidad.value = cantidad;
			}
			//calcula es subtotal dependiedo de el producto y la cantidad seleccionda.

			function calcular() {

				var cantidad = parseInt(document.formulario.cantidad.value);
				var vrUnitario = parseInt(document.getElementById("vrUnitario").innerHTML);
				var subtotal = cantidad * vrUnitario;
				document.getElementById("subtotal").innerHTML = subtotal;
			}// fin calcular subtotal.

			//carga los datos al formulario de la factura.
			function cargarDatos() {
				var seleccion = document.formulario.codigoProducto;
				var nombreProducto = seleccion.options[seleccion.selectedIndex].text;
				var codigo = seleccion.options[seleccion.selectedIndex].value;
				var cantidad2 = document.formulario.cantidad.value;
				var registroNuevos = "";
				var encotrado = false;
				var registros = window.opener.document.formulario.datos.value.split("::");
				if (window.opener.document.formulario.datos.value != "") {
					for (var i = 0; i < registros.length; i++) {
						var datos = registros[i].split(":");
						if (datos[0].trim() === codigo) {
							if ("<%=accion %>" === "Adicionar") {
								datos[2] = parseInt(datos[2]) + parseInt(cantidad2);
								datos[3] = document.getElementById("vrUnitario").innerHTML;
							} else {
								datos[1] = nombreProducto;
								datos[2] = parseInt(cantidad2);
								datos[3] = document.getElementById("vrUnitario").innerHTML;
							}
							encotrado = true;
						}
						if (datos[0].trim() != "<%=codigoProducto%>" || datos[0].trim() === codigo) {
							if (registroNuevos.length > 0)
								registroNuevos += "::";
							registroNuevos += datos[0] + ":" + datos[1] + ":" + datos[2] + ":" + datos[3];
						}
					}
				}
				if (encotrado == false) {
					if (registroNuevos.length > 0)
						registroNuevos += "::";
					registroNuevos += codigo + ":" + nombreProducto + ":" + cantidad2 + ":" + document.getElementById("vrUnitario").innerHTML;
				}
				window.opener.document.formulario.datos.value = registroNuevos;
				window.opener.cargarTabla();
				window.close();
			}//fin cargar producto

		</script>

	</head>
    <body onLoad="presentarValor(document.formulario.codigoProducto.value); calcular()" >
    <center>
        <div>

			<h2><?= strtoupper($accion) ?> PLATO</h2>

			<form name="formulario" method="POST" action="PrincipalAdmin.php?CONTENIDOADMIN=DomiciliosaAdmin/Domicilios.php" enctype="multipart/form-data">
				<table>
					<tr><th>Producto</th><td><select name="codigoProducto" onChange="presentarValor(this.value);calcular()"><?= Plato::getListaEnOptions($codigoProducto) ?></select></td></tr>
					<tr><th>Cantidad</th><td><input type="number" name="cantidad" onKeyUp="calcular()" value="<?= $cantidad ?>" /></td></tr>
					<tr><th>Vr Unitario</th><td><label id="vrUnitario"/></td></tr>
					<tr><th>Subtotal</th><td><label id="subtotal"/></td></tr>

				</table>

                            <p><input type="submit" name="accion" value="<?= $accion ?>" onclick="cargarDatos()"/>
			</form>
        </div>
    </center>
	</body>
</html>
