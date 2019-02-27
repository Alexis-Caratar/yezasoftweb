<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require_once dirname(__FILE__) . '/../Clases/ConectorBD.php';
require_once dirname(__FILE__) . '/../Clases/Plato.php';
require_once dirname(__FILE__) . '/../Clases/DetalleOrden.php';
require_once dirname(__FILE__) . '/../Clases/Menu.php';
require_once dirname(__FILE__) . '/../Clases/Cliente.php';
require_once dirname(__FILE__) . '/../Clases/Domicilio.php';
require_once dirname(__FILE__) . '/../Clases/FormatoFecha.php';

foreach ($_GET as $variable => $valor)
	${$variable} = $valor;
// Recuperando valores GET.
// nose
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

$domicilio = new Domicilio(null, null);
if ($accion == 'Modificar') {
	$domicilio = new Domicilio('iddomicilio', $iddomicilio);
	$cliente = new Cliente("identificacion", $domicilio->getIdentificacioCliente());
}else{
$cliente = new Cliente(null, null);// Fin adignación de datos.
}


//
//fechaDelSistema
$fechasistema = date("Y-m-d");

$datosClente = Cliente::getDatosEnObjetos($filtro, 'identificacion');

$lista = '';

for ($i = 0; $i < count($datosClente); $i++) {
	$cliente = $datosClente[$i];

	$lista .= '<tr id="fila2">';
	$lista .= "<td>{$cliente->getIdentificacion()}</td><td>{$cliente->getNombresCompletos()}</td><td>{$cliente->getTelefono()}</td><td>{$cliente->getEmails()}</td>";
	//$lista.="<td><a href='principalAdmin?CONTENIDOADMIN=ReservasAdmin/ReservasFormulario.php&idreserva={$objeto->getIdreserva()}&idevento={$objeto->getIdevento()}&identificacioncliente={$objeto->getIdentificacion()}&accion=Modificar'><img src='Presentacion/imagenes/Modificar.png' title='Modificar'></a><a href='principalAdmin?CONTENIDOADMIN=ReservasAdmin/DetalleReserva.php&idreserva={$objeto->getIdreserva()}&idevento={$objeto->getIdevento()}'><img src='Presentacion/imagenes/enviar.png' title='Detalle'></a> <img src='Presentacion/imagenes/Eliminar.' title='Eliminar' onclick='Eliminar({$objeto->getIdreserva()},{$objeto->getIdentificacion()})'></td>";
	$lista .= '</tr>';
}

$registrar = '';
$buscador = '';
$img = '';
if($accion=='Adicionar'){
    $registrar="";
    $img="<img src='Presentacion/imagenes/buscarpequeño.png' border='0'>";
    $buscador .= ""
		. "<table>"
		. "<tr>"
		. "<th><input id='check' type='checkbox' name='Nomres' $Nomres><label for='check'>Identificacion Del Cliente</label></th>"
		. "<td><input class='input-group-text'type='n' name='nombre' value='$nombre'></td>"
		. "</tr>"
		. "</table>";
    
    if($Nomres>0){
        $registrar .= ""
		. "<tr>"
		. "<th><BR>Identificacion : </th><th><label name='identificacioncliente' class='input-group-text'>&nbsp;&nbsp;{$cliente->getIdentificacion()}</label></th>"
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
		. "<br>"
		. "<th><br>Identificacion (*) </th><th><br><br><input class='input-group-text' style='width: 150%' type='text' name='identificacioncliente' value='{$cliente->getIdentificacion()}' placeholder='N° De Documento' required></th>"
		. "</tr>"
		. "<tr>"
		. "<th>Nombres (*) </th><th><input class='input-group-text' type='text' style='width: 150%' name='nombres' value='{$cliente->getNombres()}' placeholder='Nombres Completos' required maxlength='15'></th>"
		. "</tr>"
		. "<tr>"
		. "<th>Apellidos(*) </th><th><input class='input-group-text' style='width: 150%' type='text' name='apellidos' value='{$cliente->getApellidos()}' placeholder='Apellidos Completos' required maxlength='15'></th>"
		. "</tr>"
		. "<tr>"
		. "<th>Telefono (*) </th><th><input type='tel' name='telefono' style='width: 150%' class='input-group-text' value='{$cliente->getTelefono()}' placeholder='Numero Tel.' required height='20000'/></th></tr>"
		. "<tr>"
		. "<th>E-Mail</th><th><input class='input-group-text' type='email' name='emails' style='width: 150%' value='{$cliente->getEmails()}' placeholder='Correo Electronico' required height='20000'/></th></tr>";
		
    }
    
}else{
    $registrar .= ""
		. "<tr>"
		. "<th><br><br>Identificacion : </th><th><br><br><label name='identificacioncliente' class='input-group-text'>&nbsp;&nbsp;{$cliente->getIdentificacion()}</label></th>"
		. "</tr>"
		. "<tr>"
		. "<th>Nombres :</th><th><label name='nombres' style='width: 150%' class='input-group-text' style='width: 150%'>&nbsp;&nbsp;{$cliente->getNombres()}</label></th>"
		. "</tr>"
		. "<tr>"
		. "<th>Apellidos :</th><th><label name='apellidos' style='width: 150%' class='input-group-text' style='width: 150%'>&nbsp;&nbsp;{$cliente->getApellidos()}</label></th>"
		. "</tr>"
		. "<tr>"
		. "<th>Telefono :</th><th><label name='telefono' style='width: 150%' class='input-group-text'>&nbsp;&nbsp;{$cliente->getIdentificacion()}</label></th>"
		. "</tr>"
		. "<tr>"
		. "<th>Email : </th><th><label style='width: 150%' name='emails' class='input-group-text'>&nbsp;&nbsp;{$cliente->getEmails()}</label></th>"
		. "</tr>";
}
//inicio preparacion de la cadena de todos los datos

$detalles = $domicilio->getDetallesEnObjetos();
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
$lista2 .= '<table border="1">';
$lista2 .= '<tr><th></th><th>Opcion</th><th>Descripcion</th><th>Valor</th></tr>';

$opciones = Plato::getDatosObjetos("Menu is null", 'idplato');
$Arraydetalles = $domicilio->getDetalles(); //Buscamos las reservas en array.

for ($k = 0; $k < count($opciones); $k++) {

	$objetoPlato = $opciones[$k];

	if (is_int(array_search($objetoPlato->getIdplato(), array_column($Arraydetalles, 'plato')))){ // buscamos el id del plato en detalles
		$auxiliar = 'checked';
	}
	else
		$auxiliar = '';
	
	$lista2 .= "<tr>";
	$lista2 .= "<td><input type='checkbox' name='idplato_$k' value='{$objetoPlato->getIdPlato()}' $auxiliar></td>";
	$lista2 .= "<td>{$objetoPlato->getNombre()}</td><td>{$objetoPlato->getDescripcion()}</td><td>{$objetoPlato->getValor()}</td>";
	$lista2 .= "</tr>";
}

$lista2 .= '</table>'; // Fin nose
// Inicio nose
?>

<center><h2><?= strtoupper($accion) ?> DOMICILIO </h2></center>
<article>
    <center>
        <form method="post"><br>
            <?=$buscador?>
            <h3 ><a href='#' onClick="document.forms[0].action = '';document.forms[0].submit();"><?=$img?></a></h3>
		</form>
	</center>
</article>


<div id="Formulario" style="width: 100%">
	<center>
		<form name="formulario" method="POST" action="PrincipalAdmin.php?CONTENIDOADMIN=DomiciliosaAdmin/DomiciliosActualizar.php" enctype="multipart/form-data">
                    <input style="background: transparent;border-color: transparent;font-size: 0" name="datos" value="<?= $datos ?>"/>
                    <TABLE style="margin-top: -80;margin-left: -900"><?=$registrar ?></TABLE>
			<table style="margin-top: 10;margin-left: -900">
                            <tr><th><br>Direccion (*) </th><th><br><input style='width: 140%' class="input-group-text" type="text" name="direccion"  value='<?= $domicilio->getDireccion() ?>'></th></tr> 
                            <tr><th>Barrio</th><th><input type="text" name="barrio" style='width: 140%' class="input-group-text" value='<?= $domicilio->getBarrio() ?>'></th></tr> 
                            <tr><th>Fecha Domicilio (*)</th><th><input class="input-group-text" style='width: 140%' type="date" name="fechadomicilio" value="<?= $domicilio->getFechadomicilio() ?>" placeholder="ingrese una descripcion" required/></th></tr>
                            <tr><th>Hora (*) </th><th><input type="time" name="hora" class="input-group-text" style='width: 140%' value="<?= $domicilio->getHora() ?>" required="" size="2"/>
                            <tr><th>Abono</th><th><input class="input-group-text" type="number" name="abono"  style='width: 140%' value="<?= $domicilio->getAbono() ?>"placeholder="$$$$" ></th></tr>
                            <tr><th><input type="submit" class="btn btn-primary" name="accion" value="<?= $accion ?>" id="accion"></th></tr>
			</table>
                    <table border="0" id="tabla" class="table" style="margin-left: 500;width: 50%;margin-top: -350">
                                </table>                  
                    <br>
                    <input type="hidden" name="iddomicilio" value="<?= $domicilio->getIddomicilio() ?>">
			<input type="hidden" name="numservicios" value="<?= $k ?>">
                        <input type="hidden" name="vrunitario" value="<?= $objetoPlato->getValor() ?>">
			<input type="hidden" name="identificacion" value="<?= $cliente->getIdentificacion() ?>">
			<!--<input type="hidden" name="idplato" value="<?= $perfil->getIdplato() ?>"/>-->
			<input type="hidden" name="fechasitema" value="<?= $fechasistema ?>"/></form>

	</center>
</div>

<!-- inico script -->
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

		var ventana = window.open("DomiciliosaAdmin/formularioDetalleOrden.php?accion=Adicionar", null, "toolbar=no, location=si, directories=no, status=no, menubar=no, scrollbar=no, resizable=no, width=500, height=350, , top=100, left=400");

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
		var ventana = window.open("DomiciliosaAdmin/formularioDetalleOrden.php?" + cadena, null, "toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbar=no, resizable=no, width=400, height=250, , top=100, left=400");

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
        
        
        $(document).on("keyup","#identificacion",function (){
            var val=$(this).val();
            if(val.length>0){
                $.ajax({
                type: "POST",
                url: "DomiciliosaAdmin/consultas.php",
                dataType: 'json',
                data: {buscaridentificacion: val},
                success: function (data){
                    $("#autocompletar").fadeIn();
                    var tabla="";
                    for (var e = 0; e < data.length; e++){
                        tabla+="<tr id='"+data[e].identificacion+"' class='clickAyuda'>";
                        tabla+="<th style='width:600px; '> "+ data[e].nombres+" ("+data[e].identificacion+ ") </th>";
                        tabla+="</tr>";
                    }                        

                    $("#autocompletar").html(tabla);
                }
            })
        }else{
            $("#autocompletar").html("");
        }
    })
        //document.write(data);

</script>
<br>