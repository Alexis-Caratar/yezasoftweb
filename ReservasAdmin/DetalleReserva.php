<?php

require_once dirname(__FILE__). '/../Clases/ConectorBD.php';
require_once dirname(__FILE__). '/../Clases/Reservas.php';
require_once dirname(__FILE__). '/../Clases/Evento.php';
require_once dirname(__FILE__). '/../Clases/Plato.php';
require_once dirname(__FILE__). '/../Clases/Cliente.php';
require_once dirname(__FILE__) . '/../Clases/Menu.php';
require_once dirname(__FILE__). '/../Clases/DetalleOrden.php';


$empresa = new Reservas("idreserva", $_GET["idreserva"]);


foreach ($_GET as $variable => $valor)
	${$variable} = $valor;
// Recuperando valores GET.
// nose
$perfil = new Plato('idplato', 'menu');
$accesos = $perfil->getAccesosEnId();
$sistemas = Plato::getDatosObjetos("idplato='{$perfil->getIdplato()}'", 'idplato');
$ABONO="";
if($empresa->getAbono()==null){
    $ABONO=0;
}else{
    $ABONO=$empresa->getAbono();
}
$SALDO=$empresa->getTotal()-$ABONO;

// Inicio de asiganción de datos para modificar y adicionar

$cliente = new Cliente(null, null);
$reserva = new Reservas(null, null);
if ($accion == 'Modificar') {
	$reserva = new Reservas('idreserva', $idreserva);
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
}
$cadenaSQL="select evento from reserva where idreserva={$idreserva}";
    $evento= ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
    if($evento!=null){
        $cadenaSQL="select nombre from evento where idevento={$evento}";
        $event= ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
    }else{
        $event="No Hay Evento";
    }
// fin de concatenar todos los datos de la cadena.
$cadenaSQL="select nombre,vrunitario from detalleorden,plato where idplato=plato and tipo='S' and reserva=$idreserva";
$datosx= ConectorBD::ejecutarQuery($cadenaSQL, null);
$lista="";
for ($j = 0; $j < count($datosx); $j++) {
    $servicios=$datosx[$j];
    $NombreServicio=$servicios[0];
    $ValorServicio=$servicios[1];
    $n=$j+1;
    $lista.="<tr><td>$n<td>$NombreServicio</td><td>$ValorServicio</td></tr>";
}

?>
<style >
    
    tr:hover{
        background: white;
    }
</style>
<center><table class="container">
        <tr><th colspan="4"><hr style="background-color: transparent;border-color: transparent"></th>
        <tr><th>N°: </th><td><?=$empresa->getIdreserva()?></td></tr>
        <tr><th>Cliente: </th><td><?=$empresa->getNombresCompletos()?></td><th> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Evento: </th><td><?=$event?></td></tr>
        <tr><th colspan="4"><hr style="background-color: transparent;border-color: transparent"></th>
        <tr><th>Fecha: </th><td><?=$empresa->getFechaYHora()?></td><th> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N° Personas: </th><td><?=$empresa->getNumeropersonas()?></td></tr>
</table></center>
<center>
    <form name="formulario" method="get" action="PrincipalAdmin.php?CONTENIDOADMIN=ReservasAdmin/DetalleReservaActualizar.php&idreserva=<?=$empresa->getIdreserva()?>" enctype="multipart/form-data">
        <input style="background: transparent;border-color: transparent;font-size:0" name="datos" value="<?=$datos?>"/>
                        <h3>DETALLE DE LA COMANDA</h3>
    <table>
        <tr>
            <th>
                <table border="1" id="tabla" class="table"> </table>
            </th>
            <th style="background: transparent;color: transparent">----</th>
            <th>
                <table class="table" border="1">
                    <tr><th colspan="3" style='background-color: #49b795'><center>SERVICIOS</center></th></tr>
                    <tr><th>N°</th><th>Nombre</th><th>Valor</th></tr>
                    <?=$lista?>
                </table>
            </th>
        </tr>
    </table>            <H6>Observacion</H6>
                        <p><?=$empresa->getObservacion()?></p>
                        
                        <table>
                            <tr><th>Total A Pagar: </th><td><?=$empresa->getTotal()?></td></tr>
                            <tr><th>Abono: </th><td><?=$ABONO?></td></tr>
                            <tr><th>Saldo: </th><td><?=$SALDO?></td></tr>
                        </table>
        
        
    </form>

        

    <form name="ads"  method="get" action="PrincipalAdmin.php?CONTENIDOADMIN=ReservasAdmin/&idreserva=<?=$empresa->getIdreserva()?>"
            <input type="hidden">
    <input type="submit"  name="Cancelar" value="Cancelar" class="btn bg-primary">
    <input type="submit"  name="Aceptar" value="AceptarE" class="btn bg-primary">
     </form>    
    </center>
    
    

<script type="text/javascript">

	cargarTabla();

	function cargarTabla() {

		document.getElementById("tabla").innerHTML = "\
        <tr>\n\
           <th colspan='5' style='background-color: #49b795'><center>PLATOS</center></th>\n\
        </tr>\n\
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