<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once dirname(__FILE__) .'/Clases/ConectorBD.php' ;
require_once dirname(__FILE__) .'/Clases/Usuario.php' ;


$usuario=$_POST['usuario'];
$clave=$_POST['clave'];

if (Usuario::validar($usuario, $clave)) {
    $usuariosd=new Usuario('usuario', "'$usuario'");  
    session_start();    
    $_SESSION['user']=$usuariosd->getId();
    $_SESSION['rol']=$usuariosd->getUsuario();
    $_SESSION['rolesi']=$usuariosd->getRol();
    $_SESSION['accion']='Abrir';
     
 
header("Location: PrincipalAdmin.php?CONTENIDOADMIN=inicioAdmin.php");
    
}else{
    $mensaje="Error en el usuario y/o Contraseña";
    header("Location: loguin.php?mensaje=$mensaje");
    
}   


?>
<h2>VALIDAR</h2>