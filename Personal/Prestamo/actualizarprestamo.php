<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



require_once dirname(__FILE__).'/../../Clases/Empleado.php';
require_once dirname(__FILE__).'/../../Clases/Prestamo.php';
require_once dirname(__FILE__).'/../../Clases/ConectorBD.php';

foreach ($_GET as $Variable=> $Valor) ${$Variable}=$Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable}=$Valor;

//esta es para la hora automatica del sistema
$horaactual= getdate();
$horayfecha=$horaactual['year'].'-'. 0 .$horaactual['mon'].'-'.$horaactual['mday'].' '.$horaactual['hours'].':'.$horaactual['minutes'].':'.$horaactual['seconds'];



switch ($accion){
    case'Adicionar': 
         $prestamo=new Prestamo(null, null);
        $prestamo->setIdprestamo($idprestamo);
      $prestamo->setValor($valor);
      $prestamo->setInteres($interes);
      $prestamo->setCuota($cuota);
      $prestamo->setFecha($horayfecha);
      $prestamo->setIdempleado($idempleado);
      $prestamo->grabar();
      break;
    
    case'Modificar':
      $prestamo=new Prestamo(null, null);
       $prestamo->setIdprestamo($idprestamo);
      $prestamo->setValor($valor);
      $prestamo->setInteres($interes);
      $prestamo->setCuota($cuota);
      $prestamo->setFecha($fecha);
      $prestamo->setIdempleado($idempleado);
     $prestamo->Modificar();
        break;
    case'Eliminar':
           $prestamo=new Prestamo(null, null);
           $prestamo->setIdprestamo($idprestamo);
           $prestamo->Eliminar();
        break;   
}
 header('Location:PrincipalAdmin.php?CONTENIDOADMIN=Personal/Prestamo/prestamo.php&identificacion='.$idempleado.'&nombres='.$nombres.'&apellidos='.$apellidos.',&telefono='.$telefono.'&email='.$email.'  ');

?>