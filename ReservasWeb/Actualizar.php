<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//importacion de las clases que se requieren para este programa.

require_once dirname(__FILE__) . '/../Clases/ConectorBD.php';
require_once dirname(__FILE__) . '/../Clases/Usuario.php';
require_once dirname(__FILE__) . '/../Clases/Cliente.php';
//fin de importacion de las clases.
//header("Location: principal.php?CONTENIDO=admon/perfilesAccesos.php&id={$perfil->getId()}");
//recuperar las variables que llegan.
foreach ($_POST as $Variable => $Valor) {
	${$Variable} = $Valor;
}
foreach ($_GET as $Variable => $Valor) {
	${$Variable} = $Valor;
}
$cliente = new Cliente(null, null);
$reserva = new Usuario(null, null);

//****
//Falta atributos atributos en la clase.
//****

            $si=new Cliente(null,null);
		  $si->setIdentificacion($identificacion);
		  $si->setNombres($nombres);
		  $si->setApellidos($apellidos);
		  $si->setTelefono($telefono);
		  $si->setEmails($emails);
		  $si->setClave($identificacion);
                  $si->grabarCliente();
                  $cadenaSQL=" insert into usuario (usuario,clave,correo) values ('$nombres$apellidos','$identificacion','$emails')";
                  ConectorBD::ejecutarQuery($cadenaSQL, null);
                  
                  
//header("Location: principalAdmin.php?CONTENIDOADMIN=ReservasAdmin/Reservas.php");
?>
<script type="text/javascript">
    location = 'index.php?CONTENIDO=ReservasWeb/Loguin.php';
    </script>