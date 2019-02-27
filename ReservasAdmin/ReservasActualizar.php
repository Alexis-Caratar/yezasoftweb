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
//header("Location: principal.php?CONTENIDO=admon/perfilesAccesos.php&id={$perfil->getId()}");
//recuperar las variables que llegan.
foreach ($_POST as $Variable => $Valor) {
	${$Variable} = $Valor;
}
foreach ($_GET as $Variable => $Valor) {
	${$Variable} = $Valor;
}
$cadenaSQL="select idplato from plato limit 1";
$idplato= ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
$cadenaSQL="select nit from empresa";
$nitempresa= ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];

if ($usuario==null){$usuario='00000';}else{$usuario=$_SESSION['user'];}
//****
//Falta atributos atributos en la clase.
//****

switch ($accion) {
	case 'Adicionar':
            $cliente=new Cliente(null,null);
            $cadenaSQL="select identificacion from cliente where identificacion={$identificacioncliente}";
            $idddd= ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
            
            if(count($idddd)>0){
                $si=new Reservas(null,null);
		  $si->setIdevento($idevento);
		  $si->setIdplato($idplato);
		  $si->setFechasistema($fechasitema);
		  $si->setFechareserva($fechareserva);
		  $si->setHora($hora);
		  $si->setNumeropersonas($numeropersonas);
		  $si->setDireccion($direccion);
                  $si->setBarrio($barrio);
		  $si->setAbono($abono);
		  $si->setObservacion($observacion);
		  $si->setIdentificacioCliente($identificacioncliente);
		  $si->setPiso($piso);
                  $si->grabar();
                  
                  
                  $Factura=new Factura(null, null);
            $Factura->setIdentificaioncliente($identificacioncliente);
            $Factura->setEmpresa($nitempresa);
            $Factura->grabar();
            $cadenaSQL="select max(idfactura) from factura where identificacioncliente='{$identificacioncliente}'";
            $idfactura= ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
            
            $Comanda=new Comanda(null, null);
            $Comanda->setFactura($idfactura);
            
            $cadenaSQL="select max(idreserva) from reserva where identificacioncliente='{$identificacioncliente}'";
            $idreservas= ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
            
            $Comanda->setReserva($idreservas);
            $Comanda->grabar($usuario);
                  
		$cadenaSQL = "select max(idreserva) from reserva where identificacioncliente='{$identificacioncliente}'";

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
				$detalleReserva->setReserva($idreserva);
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
            }else{
                
                $cliente->setIdentificacion($identificacioncliente);
                $cliente->setNombres($nombres);
                $cliente->setApellidos($apellidos);
                $cliente->setTelefono($telefono);
                $cliente->setEmails($emails);
                $cliente->setClave($identificacioncliente);
                $cliente->grabarCliente();
              
               
                
                $si=new Reservas(null,null);
		  $si->setIdevento($idevento);
		  $si->setIdplato($idplato);
		  $si->setFechasistema($fechasitema);
		  $si->setFechareserva($fechareserva);
		  $si->setHora($hora);
		  $si->setNumeropersonas($numeropersonas);
		  $si->setDireccion($direccion);
                  $si->setBarrio($barrio);
		  $si->setAbono($abono);
		  $si->setObservacion($observacion);
		  $si->setIdentificacioCliente($identificacioncliente);
		  $si->setPiso($piso);
                  $si->grabar();
                  
                  
                  $Factura=new Factura(null, null);
            $Factura->setIdentificaioncliente($identificacioncliente);
            $Factura->setEmpresa($nitempresa);
            $Factura->grabar();
            $cadenaSQL="select max(idfactura) from factura where identificacioncliente='{$identificacioncliente}'";
            $idfactura= ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
            
            $Comanda=new Comanda(null, null);
            $Comanda->setFactura($idfactura);
            
            $cadenaSQL="select max(idreserva) from reserva where identificacioncliente='{$identificacioncliente}'";
            $idreservas= ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
            
            $Comanda->setReserva($idreservas);
            $Comanda->grabar($usuario);
                  
		$cadenaSQL = "select max(idreserva) from reserva where identificacioncliente='{$identificacioncliente}'";

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
				$detalleReserva->setReserva($idreserva);
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
            }
            
		

		break;
	case 'Modificar':
		$si = new Reservas(null, null);
		$si->setIdreserva($idreserva);
		$si->setIdevento($idevento);
		$si->setIdplato($idplato);
		$si->setDireccion($direccion);
		$si->setBarrio($barrio);
		$si->setFechasistema($fechasitema);
		$si->setFechareserva($fechareserva);
                $si->setHora($hora);
		$si->setNumeropersonas($numeropersonas);
		$si->setAbono($abono);
		$si->setObservacion($observacion);
		$si->setIdentificacioCliente($identificacion);
		$si->setPiso($piso);
		$si->Modificar();
                
                // actualizado servicios.
		
                
                $cadenaSQL = "select factura from comanda where reserva=$idreserva";
		//para actualizar borramos todos los datos aterires y grabamos los nuevos datos;
		$Nfactura=ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
                
                $cadenaSQL = "delete from detalleOrden where reserva=$idreserva";
		//para actualizar borramos todos los datos aterires y grabamos los nuevos datos;
		ConectorBD::ejecutarQuery($cadenaSQL, null);
                
		$cadenaSQL = "delete from comanda where reserva=$idreserva";
		//para actualizar borramos todos los datos aterires y grabamos los nuevos datos;
		ConectorBD::ejecutarQuery($cadenaSQL, null);
                
		$cadenaSQL = "delete from factura where idfactura=$Nfactura";
		//para actualizar borramos todos los datos aterires y grabamos los nuevos datos;
		ConectorBD::ejecutarQuery($cadenaSQL, null);

		$Factura=new Factura(null, null);
            $Factura->setIdentificaioncliente($identificacion);
            $Factura->setEmpresa($nitempresa);
            $Factura->grabar();
            $cadenaSQL="select max(idfactura) from factura where identificacioncliente='{$identificacion}'";
            $idfactura= ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
            
            $Comanda=new Comanda(null, null);
            $Comanda->setFactura($idfactura);
            
            $cadenaSQL="select idreserva from reserva where idreserva=$idreserva";
            $idreservas= ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
            
            $Comanda->setReserva($idreservas);
            $Comanda->grabar($usuario);
                  
		$cadenaSQL = "select idreserva from reserva where idreserva=$idreserva";

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
				$detalleReserva->setReserva($idreserva);
				$detalleReserva->setDomicilio("null");
				$detalleReserva->setReserva($id);
				$detalleReserva->grabar();
			}
		}

		//grabando platos
		if ($datos != '') {
                    
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
		}

		break;
	case 'Eliminar':
		$si = new Reservas(null, null);
		$si->setIdreserva($idreserva);
                
                $cadenaSQL = "select factura from comanda where reserva=$idreserva";
		//para actualizar borramos todos los datos aterires y grabamos los nuevos datos;
		$Nfactura=ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
                
                $cadenaSQL = "delete from detalleOrden where reserva=$idreserva";
		//para actualizar borramos todos los datos aterires y grabamos los nuevos datos;
		ConectorBD::ejecutarQuery($cadenaSQL, null);
                
		$cadenaSQL = "delete from comanda where reserva=$idreserva";
		//para actualizar borramos todos los datos aterires y grabamos los nuevos datos;
		ConectorBD::ejecutarQuery($cadenaSQL, null);
                
		$cadenaSQL = "delete from factura where idfactura=$Nfactura";
		//para actualizar borramos todos los datos aterires y grabamos los nuevos datos;
		ConectorBD::ejecutarQuery($cadenaSQL, null);
                
		$si->eliminar();
		break;
}
//header("Location: principalAdmin.php?CONTENIDOADMIN=ReservasAdmin/Reservas.php");
?>
<script type="text/javascript">
  //location = 'PrincipalAdmin.php?CONTENIDOADMIN=ReservasAdmin/Reservas.php';
    </script>