<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once dirname(__FILE__).'/../Clases/Empleado.php';
require_once dirname(__FILE__).'/../Clases/ConectorBD.php';

foreach ($_GET as $Variable=> $Valor) ${$Variable}=$Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable}=$Valor;

switch ($accion){
    case 'Adicionar':
        $cadenasql="select*from empleado where identificacion=$identificacion";
        $datos= ConectorBD::ejecutarQuery($cadenasql, null);
        if (count($datos)>0) {
          $mensaje="LA IDENTIFICACION DEL EMPLEADO YA ESTA REGISTRADO EN LA BASE DE DATOS";
      header('location: PrincipalAdmin.php?CONTENIDOADMIN=Personal/formulariopersonal.php&mensaje='.$mensaje.'&accion='.$accion.''
              . '&identificacion='.$identificacion.'&nombres='.$nombres.'&apellidos='.$apellidos.'&genero='.$genero.'&telefono='.$telefono.'&email='.$email.''
              . '&fechanacimiento='.$fechanacimiento.'&fechaingreso='.$fechaingreso.'&fechafin='.$fechafin.' ');
       
        } else {
      $empleado=new Empleado(null, null);
        $empleado->setIdentificacion($identificacion);
        $empleado->setNombres($nombres);
        $empleado->setApellidos($apellidos);
        $empleado->setGenero($genero);
        $empleado->setTelefono($telefono);
        $empleado->setEmail($email);
        $empleado->setFechanacimiento($fechanacimiento);
        $empleado->setFechaingreso($fechaingreso);
        $empleado->setFechafin($fechafin);
        $empleado->setCargo($cargo);
        $empleado->grabar();
        //header('location:PrincipalAdmin.php?CONTENIDOADMIN=Personal/personal.php'); 
        }
         break;
    case 'Modificar':
         $empleado=new Empleado(null, null);
        $empleado->setIdentificacion($identificacion);
        $empleado->setNombres($nombres);
        $empleado->setApellidos($apellidos);
        $empleado->setGenero($genero);
        $empleado->setEmail($email);
        $empleado->setTelefono($telefono);
        $empleado->setFechanacimiento($fechanacimiento);
        $empleado->setFechaingreso($fechaingreso);
        $empleado->setFechafin($fechafin);
        $empleado->setCargo($cargo);
        
        $cadenasql="select*from empleado where identificacion=$identificacion";
        $datos= ConectorBD::ejecutarQuery($cadenasql, null);
        if (count($datos)<=0 || $datos[0][0]==$identificacionA){
        $empleado->modificar($identificacionA);
        header('location:PrincipalAdmin.php?CONTENIDOADMIN=Personal/personal.php');
        }else {
            $mensaje="LA IDENTIFICACION DEL EMPLEADO YA ESTA REGISTRADO EN LA BASE DE DATOS";
      header('location: PrincipalAdmin.php?CONTENIDOADMIN=Personal/formulariopersonal.php&mensaje='.$mensaje.'&accion='.$accion.''
              . '&identificacion='.$identificacion.'');     }
        break;
    case 'Eliminar':
         $empleado=new Empleado(null, null);
        $empleado->setIdentificacion($identificacion);
        $empleado->eliminar();
         header('location:PrincipalAdmin.php?CONTENIDOADMIN=Personal/personal.php'); 
        break;
    
   
}
     


?>


             
