<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require_once dirname(__FILE__).'/../../Clases/Empleado.php';
require_once dirname(__FILE__).'/../../Clases/Prestamo.php';
require_once dirname(__FILE__).'/../../Clases/Pago.php';
require_once dirname(__FILE__).'/../../Clases/ConectorBD.php';



foreach ($_GET as $Variable=> $Valor) ${$Variable}=$Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable}=$Valor;

//esta es para la hora automatica del sistema
date_default_timezone_set("America/Bogota");
$horaactual= getdate();
$horayfecha=$horaactual['year'].'-'. 0 .$horaactual['mon'].'-'.$horaactual['mday'].' '.$horaactual['hours'].':'.$horaactual['minutes'].':'.$horaactual['seconds'];



switch ($accion){
    case'Adicionar': 
         $pagoprestamo=new Pago(null, null);
        $pagoprestamo->setFecha($horayfecha);
        $pagoprestamo->setValor($valor);
        $pagoprestamo->setPrestamo($idprestamo);
        $pagoprestamo->grabar();
      break;
    
    case'Modificar':
          $pagoprestamo=new Pago(null, null);
        $pagoprestamo->setIdpago($idpago);
        $pagoprestamo->setFecha($fecha);
        $pagoprestamo->setValor($valor);
        $pagoprestamo->setPrestamo($idprestamo);
        $pagoprestamo->Modificar();
        break;
    case'Eliminar':
              $pagoprestamo=new Pago(null, null);
              $pagoprestamo->setIdpago($idpago);
              $pagoprestamo->Eliminar();
        break;
}
 header('Location:PrincipalAdmin.php?CONTENIDOADMIN=Personal/Prestamo/pago.php&idempleado='.$idempleado.'&nombres='.$nombres.'&apellidos='.$apellidos.',&telefono='.$telefono.'&email='.$email.'&idprestamo='.$idprestamo.'  ');

?>