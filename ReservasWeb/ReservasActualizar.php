<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//importacion de las clases que se requieren para este programa.

require_once dirname(__FILE__) . '/../Clases/ConectorBD.php';
require_once dirname(__FILE__) . '/../Clases/Evento.php';
require_once dirname(__FILE__) . '/../Clases/Reservas.php';
require_once dirname(__FILE__) . '/../Clases/Cliente.php';
require_once dirname(__FILE__) . '/../Clases/Plato.php';
require_once dirname(__FILE__) . '/../Clases/DetalleOrden.php';
require_once dirname(__FILE__) . '/../Clases/Menu.php';
require_once dirname(__FILE__) . '/../Clases/Comanda.php';
require_once dirname(__FILE__) . '/../Clases/Factura.php';
//fin de importacion de las clases.

//recuperar las variables que llegan.
foreach ($_POST as $Variable => $Valor) {
	${$Variable} = $Valor;
}
foreach ($_GET as $Variable => $Valor) {
	${$Variable} = $Valor;
}
$cliente = new Cliente(null, null);
$reserva = new Reservas(null, null);
$cadenaSQL="select idplato from plato limit 1";
$idplato= ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
//****
//Falta atributos atributos en la clase.
//****
$cadenaSQL="select nit from empresa";
$nitempresa= ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
switch ($accion) {
	case 'Adicionar':
            
            $si=new Reservas(null,null);
		  $si->setIdevento($idevento);
		  $si->setIdplato($idplato);
		  $si->setFechasistema($fechasitema);
		  $si->setFechareserva($fechareserva);
		  $si->setHora($hora);
		  $si->setNumeropersonas($numeropersonas);
		  $si->setDireccion($direccion);
                  $si->setBarrio($barrio);
		  $si->setObservacion($observacion);
		  $si->setIdentificacioCliente($Valor);
                  $si->grabarWeb();
                  
                  
                  $Factura=new Factura(null, null);
            $Factura->setIdentificaioncliente($Valor);
            $Factura->setEmpresa($nitempresa);
            $Factura->grabar();
            
            $cadenaSQL="select max(idfactura) from factura where identificacioncliente='{$Valor}'";
            $idfactura= ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
            
            $Comanda=new Comanda(null, null);
            $Comanda->setFactura($idfactura);
            
            $cadenaSQL="select max(idreserva) from reserva where identificacioncliente='{$Valor}'";
            $idreservas= ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
            
            $Comanda->setReserva($idreservas);
            $Comanda->grabar();
                  
		$cadenaSQL = "select max(idreserva) from reserva where identificacioncliente='{$Valor}'";

		$id = ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];

		$detalleReserva = new DetalleOrden(null, null);
		for ($i = 0; $i < $numservicios; $i++) {
			if (isset($_POST['idplato_' . $i])) {

                            $cadenaSQL = "select max(idcomanda) from comanda where factura={$idfactura}";
                            $idcomanda = ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
                            
				$detalleReserva->setComanda($idcomanda);
				$detalleReserva->setCantidad("1");
				$detalleReserva->setPlato($_POST['idplato_' . $i]);
                                
                                $cadenaSQL="select valor from plato where idplato='{$_POST['idplato_' .$i]}'";
                                $valorUnitarios= ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
                                
				$detalleReserva->setVrunitario($valorUnitarios);
				//$detalleReserva->setReserva($idreserva);
				$detalleReserva->setDomicilio("null");
				$detalleReserva->setReserva($id);
				$detalleReserva->grabar();
			}
		}

		//grabando platos

		$detalleReserva = new DetalleOrden(null, null);
		$arrayDatos = explode("::", $datos);
		for ($i = 0; $i < count($arrayDatos); $i++) {
			$plato = explode(":", $arrayDatos[$i]);
                        
                        $cadenaSQL = "select max(idcomanda) from comanda where factura={$idfactura}";
                        $idcomanda = ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
			$detalleReserva->setComanda($idcomanda);
			$detalleReserva->setPlato($plato[0]);
                        
                        $cadenaSQL="select valor from plato where idplato='$plato[0]'";
                        $valorUnitarios= ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
                        
                        $detalleReserva->setCantidad($plato[2]);
			$detalleReserva->setVrunitario($valorUnitarios);
			$detalleReserva->setReserva($id);
			$detalleReserva->setDomicilio("null");
			$detalleReserva->grabar();
		}
		break;
}
//header("Location: principalAdmin.php?CONTENIDOADMIN=ReservasAdmin/Reservas.php");
?>
<script type="text/javascript">
    //confirm("Reserva Registrada Correctamente");
    location = 'index.php?CONTENIDO=ReservasWeb/Loguin.php';
    </script>