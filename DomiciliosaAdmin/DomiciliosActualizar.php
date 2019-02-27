<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//importacion de las clases que se requieren para este programa.

require_once dirname(__FILE__) . '/../Clases/ConectorBD.php';
require_once dirname(__FILE__) . '/../Clases/Cliente.php';
require_once dirname(__FILE__) . '/../Clases/Plato.php';
require_once dirname(__FILE__) . '/../Clases/DetalleOrden.php';
require_once dirname(__FILE__) . '/../Clases/Menu.php';
require_once dirname(__FILE__) . '/../Clases/Comanda.php';
require_once dirname(__FILE__) . '/../Clases/Factura.php';
require_once dirname(__FILE__) . '/../Clases/Domicilio.php';
//fin de importacion de las clases.
//header("Location: principal.php?CONTENIDO=admon/perfilesAccesos.php&id={$perfil->getId()}");
//recuperar las variables que llegan.
foreach ($_POST as $Variable => $Valor) {
	${$Variable} = $Valor;
}
foreach ($_GET as $Variable => $Valor) {
	${$Variable} = $Valor;
}

$cadenaSQL="select nit from empresa";
$nitempresa= ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];

$cadenaSQL="select idplato from plato limit 1";
$idplato= ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];

//****
//Falta atributos atributos en la clase.
//****
$usuario = $_SESSION['user'];
switch ($accion) {
	case 'Adicionar':
            
            $cliente=new Cliente(null,null);
            $cadenaSQL="select identificacion from cliente where identificacion={$identificacioncliente}";
            $idddd= ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
            
            if(isset($idddd)){
		$si=new Domicilio(null,null);
		  $si->setIdplato($idplato);
		  $si->setFechasistema($fechasitema);
		  $si->setFechadomicilio($fechadomicilio);
		  $si->setHora($hora);
		  $si->setDireccion($direccion);
                  $si->setBarrio($barrio);
		  $si->setAbono($abono);
		  $si->setIdentificacioCliente($identificacioncliente);
                  $si->grabar();
                  
                  
                  $Factura=new Factura(null, null);
            $Factura->setIdentificaioncliente($identificacioncliente);
            $Factura->setEmpresa($nitempresa);
            $Factura->grabarDomicilio();
            $cadenaSQL="select max(idfactura) from factura where identificacioncliente='$identificacioncliente'";
            $idfactura= ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
            
            $Comanda=new Comanda(null, null);
            $Comanda->setFactura($idfactura);
            
            $cadenaSQL="select max(iddomicilio) from domicilio";
            $idreservas= ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
            
            $Comanda->setDomicilio($idreservas);
            $Comanda->grabarDomicilio($usuario);
                  
		$cadenaSQL = "select max(iddomicilio) from domicilio";

		$id = ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];

		
		//grabando platos

		$detalleReserva = new DetalleOrden(null, null);
		$arrayDatos = explode("::", $datos);
		for ($i = 0; $i < count($arrayDatos); $i++) {
			$plato = explode(":", $arrayDatos[$i]);
                        
                        $cadenaSQL = "select max(idcomanda) from comanda";
                        $idcomanda = ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
			$detalleReserva->setComanda($idcomanda);
			$detalleReserva->setPlato($plato[0]);
                        
                        $cadenaSQL="select valor from plato where idplato='$plato[0]'";
                        $valorUnitarios= ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
                        
                        $detalleReserva->setCantidad($plato[2]);
			$detalleReserva->setVrunitario($valorUnitarios);
			$detalleReserva->setDomicilio($id);
			$detalleReserva->grabarDomicilio();
		}
            }else{
                
                $cliente->setIdentificacion($identificacioncliente);
                $cliente->setNombres($nombres);
                $cliente->setApellidos($apellidos);
                $cliente->setTelefono($telefono);
                $cliente->setEmails($emails);
                $cliente->setClave($identificacioncliente);
                $cliente->grabarCliente();
                $cadenaSQL="insert into cliente values('{$identificacioncliente}','{$nombres}','{$apellidos}','{$telefono}','{$emails}','{$identificacioncliente}')";
                ConectorBD::ejecutarQuery($cadenaSQL, null);
                
                $si=new Domicilio(null,null);
		  $si->setIdplato($idplato);
		  $si->setFechasistema($fechasitema);
		  $si->setFechadomicilio($fechadomicilio);
		  $si->setHora($hora);
		  $si->setDireccion($direccion);
                  $si->setBarrio($barrio);
		  $si->setAbono($abono);
		  $si->setIdentificacioCliente($identificacioncliente);
                  $si->grabar();
                  
                  
                  $Factura=new Factura(null, null);
            $Factura->setIdentificaioncliente($identificacioncliente);
            $Factura->setEmpresa($nitempresa);
            $Factura->grabarDomicilio();
            $cadenaSQL="select max(idfactura) from factura where identificacioncliente='$identificacioncliente'";
            $idfactura= ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
            
            $Comanda=new Comanda(null, null);
            $Comanda->setFactura($idfactura);
            
            $cadenaSQL="select max(iddomicilio) from domicilio";
            $idreservas= ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
            
            $Comanda->setDomicilio($idreservas);
            $Comanda->grabarDomicilio($usuario);
                  
		$cadenaSQL = "select max(iddomicilio) from domicilio";

		$id = ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];

		
		//grabando platos

		$detalleReserva = new DetalleOrden(null, null);
		$arrayDatos = explode("::", $datos);
		for ($i = 0; $i < count($arrayDatos); $i++) {
			$plato = explode(":", $arrayDatos[$i]);
                        
                        $cadenaSQL = "select max(idcomanda) from comanda";
                        $idcomanda = ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
			$detalleReserva->setComanda($idcomanda);
			$detalleReserva->setPlato($plato[0]);
                        
                        $cadenaSQL="select valor from plato where idplato='$plato[0]'";
                        $valorUnitarios= ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
                        
                        $detalleReserva->setCantidad($plato[2]);
			$detalleReserva->setVrunitario($valorUnitarios);
			$detalleReserva->setDomicilio($id);
			$detalleReserva->grabarDomicilio();
		}
            }

		break;
	case 'Modificar':
		$si = new Domicilio(null, null);
		$si->setIddomicilio($iddomicilio);
		$si->setIdplato($idplato);
		  $si->setFechasistema($fechasitema);
		  $si->setFechadomicilio($fechadomicilio);
		  $si->setHora($hora);
		  $si->setDireccion($direccion);
                  $si->setBarrio($barrio);
		  $si->setAbono($abono);
		  $si->setIdentificacioCliente($identificacion);
                  $si->Modificar();
                
                // actualizado servicios.
		
                
                $cadenaSQL = "select factura from comanda where domicilio=$iddomicilio";
		//para actualizar borramos todos los datos aterires y grabamos los nuevos datos;
		$Nfactura=ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
                
                $cadenaSQL = "delete from detalleOrden where domicilio=$iddomicilio";
		//para actualizar borramos todos los datos aterires y grabamos los nuevos datos;
		ConectorBD::ejecutarQuery($cadenaSQL, null);
                
		$cadenaSQL = "delete from comanda where domicilio=$iddomicilio";
		//para actualizar borramos todos los datos aterires y grabamos los nuevos datos;
		ConectorBD::ejecutarQuery($cadenaSQL, null);
                
		$cadenaSQL = "delete from factura where idfactura=$Nfactura";
		//para actualizar borramos todos los datos aterires y grabamos los nuevos datos;
		ConectorBD::ejecutarQuery($cadenaSQL, null);

		$Factura=new Factura(null, null);
            $Factura->setIdentificaioncliente($identificacion);
            $Factura->setEmpresa($nitempresa);
            $Factura->grabarDomicilio();
            $cadenaSQL="select max(idfactura) from factura";
            $idfactura= ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
            
            $Comanda=new Comanda(null, null);
            $Comanda->setFactura($idfactura);
            
            $cadenaSQL="select iddomicilio from domicilio where iddomicilio=$iddomicilio";
            $idreservas= ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
            
            $Comanda->setDomicilio($idreservas);
            $Comanda->grabarDomicilio($usuario);
                  
		$cadenaSQL = "select iddomicilio from domicilio where iddomicilio=$iddomicilio";

		$id = ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];

		//grabando platos
		if ($datos != '') {
                    
                    $detalleReserva = new DetalleOrden(null, null);
                    $arrayDatos = explode("::", $datos);
                    for ($i = 0; $i < count($arrayDatos); $i++) {
			$plato = explode(":", $arrayDatos[$i]);
                        
                        $cadenaSQL = "select max(idcomanda) from comanda";
                        $idcomanda = ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
                        
                        $detalleReserva->setComanda($idcomanda);
			$detalleReserva->setPlato($plato[0]);
                        
                        $cadenaSQL="select valor from plato where idplato='$plato[0]'";
                        $valorUnitarios= ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
                        
                        $detalleReserva->setCantidad($plato[2]);
			$detalleReserva->setVrunitario($valorUnitarios);
			$detalleReserva->setReserva("null");
			$detalleReserva->setDomicilio($id);
			$detalleReserva->grabarDomicilio();
		}
		}

		break;
	case 'Eliminar':
		$si = new Domicilio(null, null);
		$si->setIddomicilio($iddomicilio);
                
                $cadenaSQL = "select factura from comanda where domicilio=$iddomicilio";
		//para actualizar borramos todos los datos aterires y grabamos los nuevos datos;
		$Nfactura=ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
                
                $cadenaSQL = "delete from detalleOrden where domicilio=$iddomicilio";
                
		//para actualizar borramos todos los datos aterires y grabamos los nuevos datos;
		ConectorBD::ejecutarQuery($cadenaSQL, null);
                
		$cadenaSQL = "delete from comanda where domicilio=$iddomicilio";
		//para actualizar borramos todos los datos aterires y grabamos los nuevos datos;
		ConectorBD::ejecutarQuery($cadenaSQL, null);
                
		$cadenaSQL = "delete from factura where idfactura=$Nfactura";
		//para actualizar borramos todos los datos aterires y grabamos los nuevos datos;
		ConectorBD::ejecutarQuery($cadenaSQL, null);
                
		$si->eliminar();
		break;
}
//header("Location:PrincipalAdmin.php?CONTENIDOADMIN=DomiciliosaAdmin/Domicilios.php");
?>
<script type="text/javascript">
   location = 'PrincipalAdmin.php?CONTENIDOADMIN=DomiciliosaAdmin/Domicilios.php';
    </script>