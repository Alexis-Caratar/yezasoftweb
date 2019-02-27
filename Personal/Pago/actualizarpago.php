<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require_once dirname(__FILE__).'/../../Clases/Pagoempleado.php';
require_once dirname(__FILE__).'/../../Clases/ConectorBD.php';

foreach ($_GET as $Variable=> $Valor) ${$Variable}=$Valor;

date_default_timezone_set("America/Bogota");
$horaactual= getdate();
$horayfecha=$horaactual['year'].'-'. 0 .$horaactual['mon'].'-'.$horaactual['mday'].' '.$horaactual['hours'].':'.$horaactual['minutes'].':'.$horaactual['seconds'];
print_r(getdate());
   

switch ($accion){
    case 'Adicionar':
        $pagoempleado=new Pagoempleado(null, null);
        $pagoempleado->setIdempleado($idempleado);
        $pagoempleado->setHorasextras($horasextras);
        $pagoempleado->setValorhoraextra($valorhoraextra);
        $pagoempleado->setAuxiliotrasporte($auxiliotrasporte);
        $pagoempleado->setDescuentosalud($descuentosalud);
        $pagoempleado->setDescuentopencion($descuentopencion);
        $pagoempleado->setFechainicio($fechainicio);
        $pagoempleado->setFechafin($fechafin);
        $pagoempleado->setFechasistema($horayfecha);
        $pagoempleado->setRiesgolaboral($riesgolaboral);
        $total=$sueldo+$horasextras*$valorhoraextra+$auxiliotrasporte-$descuentopencion-$descuentosalud-$riesgolaboral;
        $pagoempleado->setSueldo($total);
        $pagoempleado->grabar();
    case 'Modificar':
        $pagoempleado=new Pagoempleado(null, null);
        $pagoempleado->setIdempleado($idempleado);
        $pagoempleado->setHorasextras($horasextras);
        $pagoempleado->setValorhoraextra($valorhoraextra);
        $pagoempleado->setAuxiliotrasporte($auxiliotrasporte);
        $pagoempleado->setDescuentosalud($descuentosalud);
        $pagoempleado->setDescuentopencion($descuentopencion);
        $pagoempleado->setFechainicio($fechainicio);
        $pagoempleado->setFechafin($fechafin);
        $pagoempleado->setSueldo($sueldo);
        $pagoempleado->setFechasistema($horayfecha);
        $pagoempleado->setRiesgolaboral($riesgolaboral);
        $pagoempleado->modificar($idpagoempleado);
      
        break;
    case 'Eliminar':
         $pagoempleado=new Pagoempleado(null, null);
        $pagoempleado->setIdpagoempleado($idpagoempleado);
        $pagoempleado->eliminar();
        break;
    
}
   //header('location: PrincipalAdmin.php?CONTENIDOADMIN=Personal/Pago/pago.php');   


?>


             




