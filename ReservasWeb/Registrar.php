<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require_once dirname(__FILE__) . '/../Clases/ConectorBD.php';
require_once dirname(__FILE__) . '/../Clases/Cliente.php';
require_once dirname(__FILE__) . '/../Clases/Usuario.php';


$cliente = new Cliente(null, null);
$usuario = new Usuario(null, null);

?>

<div class="container"> 
    <div class="col-md-5">
<div id="Formulario" >
	<center>
                <form name="formulario" method="POST" action="index.php?CONTENIDO=ReservasWeb/Actualizar.php" enctype="multipart/form-data">
                    <br><br><table class="table table-hover" >
                        <tr>
                            <th  >
                        <center>REGISTRAR USUARIO</center>
                            </th>
                        </tr>
                        <tr>
                            <th>Identificacion</th><th><input class="form-control"type="tex" name="identificacion" value="<?=$cliente->getIdentificacion()?>"></th>
                        </tr>
                        <tr>
                            <th>Nombres</th><th><input class="form-control"type="tex" name="nombres" value="<?=$cliente->getNombres()?>"></th>
                        </tr>
                        <tr>
                            <th>Apellidos</th><th><input class="form-control"type="tex" name="apellidos" value="<?=$cliente->getApellidos()?>"></th>
                        </tr>
                        <tr>
                            <th>Telefono</th><th><input class="form-control"type="tel" name="telefono" value="<?=$cliente->getTelefono()?>"></th>
                        </tr>
                        <tr>
                            <th>E-Mail</th><th><input class="form-control"type="email" name="emails" value="<?=$cliente->getEmails()?>"></th>
                        </tr>
                    </table><br>
                    <input type="submit" value="Registrar" class="btn btn-primary">
		</form>

	</center>
</div>
        </div>
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