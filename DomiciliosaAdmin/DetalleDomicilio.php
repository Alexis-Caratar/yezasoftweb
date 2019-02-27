<?php

require_once dirname(__FILE__). '/../Clases/ConectorBD.php';
require_once dirname(__FILE__). '/../Clases/Domicilio.php';
require_once dirname(__FILE__). '/../Clases/Plato.php';
require_once dirname(__FILE__). '/../Clases/Cliente.php';
require_once dirname(__FILE__) . '/../Clases/Menu.php';
require_once dirname(__FILE__). '/../Clases/DetalleOrden.php';


$empresa = new Domicilio("iddomicilio", $_GET["iddomicilio"]);

foreach ($_GET as $variable => $valor)
	${$variable} = $valor;
// Recuperando valores GET.
// nose
$cadenaSQL="select sum(vrunitario*cantidad) from detalleorden where domicilio={$_GET["iddomicilio"]}";
$SUB= ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
$ABONO="";
if($empresa->getAbono()==null){
    $ABONO=0;
}else{
    $ABONO=$empresa->getAbono();
}
$SALDO=$SUB-$empresa->getAbono();
$perfil = new Plato('idplato', 'menu');
$accesos = $perfil->getAccesosEnId();
$sistemas = Plato::getDatosObjetos("idplato='{$perfil->getIdplato()}'", 'idplato');


// Inicio de asiganción de datos para modificar y adicionar

$cliente = new Cliente(null, null);
$reserva = new Domicilio(null, null);
if ($accion == 'Modificar') {
	$reserva = new Domicilio('iddomicilio', $iddomicilio);
	$cliente = new Cliente("identificacion", $reserva->getIdentificacioCliente());
        }// Fin adignación de datos.
//
//fechaDelSistema
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

?>

<center><table class="container" style="width: 50%">
        <tr><th colspan="4"><hr style="background-color: transparent;border-color: transparent"></th>
        <tr><th>N°: </th><td><?=$empresa->getIddomicilio()?></td></tr>
        <tr><th>Cliente: </th><td><?=$empresa->getNombresCompletos()?></td><th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N° Identificacion</th><td><?=$empresa->getIdentificacion()?></td></tr>
        <tr><th colspan="4"><hr style="background-color: transparent;border-color: transparent"></th>
        <tr><th>Fecha: </th><td><?=$empresa->getFechaYHora()?></td></tr>
    </table></center><br>
<center>
    <form name="formulario" method="POST" action="PrincipalAdmin.php?CONTENIDOADMIN=DomiciliosaAdmin/Domicilios.php" enctype="multipart/form-data">
			<input style="background: transparent;border-color: transparent;font-size: 0" name="datos" value="<?= $datos ?>"/>
                        <h3>DETALLE DE LA COMANDA</h3>
    <table>
        <tr>
            <th>
                <table border="1" id="tabla"> </table>
            </th>
        </tr>
    </table>
                        <table>
                            <tr><th>Total A Pagar: </th><td><?=$SUB?></td></tr>
                            <tr><th>Abono: </th><td><?=$ABONO?></td></tr>
                            <tr><th>Saldo: </th><td><?=$SALDO?></td></tr>
                        </table>
        <input type="submit"  name="accion" value="Aceptar" id="accion" class="btn bg-primary">
    </form>
</center>
<script type="text/javascript">

	cargarTabla();

	function cargarTabla() {

		document.getElementById("tabla").innerHTML = "\
        <tr>\n\
            <th>N°</th>\n\
            <th>Nombre</th>\n\
            <th>Cantidad</th>\n\
            <th>Valor Unitario</th>\n\
            <th>Sub total</th>\n\
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
                </tr>";
			}
		}

	}
	function prueva() {

		alert("parse que si");

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


</script>