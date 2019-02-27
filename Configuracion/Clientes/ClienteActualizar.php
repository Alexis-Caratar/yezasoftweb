<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//importacion de las clases que se requieren para este programa.

require_once dirname(__FILE__). '/../../Clases/ConectorBD.php';
require_once dirname(__FILE__). '/../../Clases/Cliente.php';
//fin de importacion de las clases.

//recuperar las variables que llegan.
foreach ($_POST as $Variable => $Valor) ${$Variable}=$Valor; 
foreach ($_GET as $Variable => $Valor) ${$Variable}=$Valor; 


switch ($accion){
    case 'Adicionar':
        $cliente=new Cliente(null,null);
        
        $cliente->setIdentificacion($identificacion);
        $cliente->setNombres($nombres);
        $cliente->setApellidos($apellidos);
        $cliente->setTelefono($telefono);
        $cliente->setEmails($emails);
        $cliente->setClave($clave);
        $cliente->grabarCliente();
        break;
    case 'Modificar':
        $si=new Cliente(null,null);
        $si->setIdentificacion($identificacion);
        $si->setNombres($nombres);
        $si->setApellidos($apellidos);
        $si->setDireccion($direccion);
        $si->setTelefono($telefono);
        $si->setEmails($emails);
        $si->setClave($clave);
        $si->modificar();
        break;
    case 'Eliminar':
        $si=new Cliente(null, null);
        $si->setIdentificacion($identificacion);
        $si->eliminar();
        break;
}
header('Location:PrincipalAdmin.php?CONTENIDOADMIN=ReservasAdmin/ReservasFormulario.php&accion=Adicionar');

