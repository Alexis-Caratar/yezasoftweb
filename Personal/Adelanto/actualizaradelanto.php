<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require_once dirname(__FILE__).'/../../Clases/Empleado.php';
require_once dirname(__FILE__).'/../../Clases/Adelanto.php';
require_once dirname(__FILE__).'/../../Clases/ConectorBD.php';

foreach ($_GET as $Variable=> $Valor) ${$Variable}=$Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable}=$Valor;

date_default_timezone_set("America/Bogota");
$horaactual= getdate();
$horayfecha=$horaactual['year'].'-'. 0 .$horaactual['mon'].'-'.$horaactual['mday'].' '.$horaactual['hours'].':'.$horaactual['minutes'].':'.$horaactual['seconds'];
print_r($horayfecha);

switch ($accion){
    case'Adicionar': 
         $adelantos=new Adelanto(null, null);
        $adelantos->setIdadelanto($idadelanto);
         $adelantos->setValor($valor);
         $adelantos->setFecha( $horayfecha );
        $adelantos->setIdempleado($idempleado);
        $adelantos->grabar();
        
        break;
    
    case'Modificar':
        $adelantos=new Adelanto(null, null);
        $adelantos->setIdadelanto($idadelanto);
         $adelantos->setValor($valor);
         $adelantos->setFecha($fecha);
        $adelantos->setIdempleado($idempleado);
        $adelantos->Modificar();
        break;
    case'Eliminar':
        $adelantos=new Adelanto(null, null);
        $adelantos->setIdadelanto($idadelanto);
        $adelantos->Eliminar();
        break;
}
header('location: PrincipalAdmin.php?CONTENIDOADMIN=Personal/Adelanto/adelanto.php&identificacion='.$idempleado.'&nombres='.$nombres.'&apellidos='.$apellidos.'&telefono='.$telefono.'&email='.$email);

?>

