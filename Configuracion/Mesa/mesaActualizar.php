<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__). '/../../Clases/ConectorBD.php';
require_once dirname(__FILE__).'/../../Clases/Mesa.php';

foreach ($_POST as $variable=>$valor) ${$variable}=$valor;
foreach ($_GET  as $variable=>$valor) ${$variable}=$valor;

switch ($accion){
case 'Adicionar':
    //$suma=$mesainicial<=$numeromesa;
    
    for ($i = $mesainicial; $i<= $numeromesa; $i++) {
        
    $mesa=new Mesa(null, null);
    $mesa->setArea($area);
    $mesa->setColor($color);
    $mesa->setMesainicial($i);
    $mesa->setPiso($piso);
    $cadenaSQL="select mesainicial from mesa where mesainicial=".$i;
    $datos= ConectorBD::ejecutarQuery($cadenaSQL, null);
    print_r($datos);
    $mesa->grabar();
    }
    
   
    
    break;
    case 'Modificar':
        $mesa=new Mesa(null, null);
        $mesa->setArea($area);
        $mesa->setColor($color);
        $mesa->setMesainicial($mesainicial);
        $mesa->setPiso($piso);      
        $mesa->modificar($idanterior);
        
        break;
        case 'Eliminar':
            $mesa=new Mesa(null, null);
            $mesa->setIdmesa($idmesa);
            $mesa->eliminar();
            break;
}
?>
<!--<script>
location="PrincipalAdmin.php?CONTENIDOADMIN=Configuracion/Mesa/mesa.php";
</script>-->
