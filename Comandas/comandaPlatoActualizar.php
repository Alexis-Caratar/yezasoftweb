<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__)."/../Clases/ConectorBD.php";
require_once dirname(__FILE__)."/../Clases/Platos.php";
require_once dirname(__FILE__)."/../Clases/menus.php";
require_once dirname(__FILE__)."/../Clases/DetalleOrdenes.php";
$val='';

foreach ($_POST as $variable=> $valor) ${$variable}=$valor;
switch ($accion){
    case'Adicionar':
        $cadena2= ConectorBD::ejecutarQuery("SELECT * FROM detalleorden WHERE plato= $plato and comanda=$idcomanda", null);
        if ($cadena2==null) {
        $detalle=new DetalleOrdenes(null,null);
        $detalle->setComanda($idcomanda);
        $detalle->setPlato($plato);
        $detalle->setCantidad($cantida);
        $detalle->setVrunitario($val);
        $detalle->setNota($nota);
        $detalle->grabarComanda();
          break;
       }
       if ($cadena2!=null) {
            $accion='Modificar';
        }
       
    case'Modificar':          
         $cadena2= ConectorBD::ejecutarQuery("SELECT * FROM detalleorden WHERE plato= $plato and comanda=$idcomanda", null);
         if ($cadena2!=null) { 
             $iddetalle=$cadena2[0][0];
        $detalle=new DetalleOrdenes(null,null);
        $detalle->setIddetalle($iddetalle);
        $detalle->setComanda($idcomanda);
        $detalle->setPlato($plato);        
        $cantida=$cantida+$cadena2[0][2]; 
        $detalle->setCantidad($cantida);
        $detalle->setVrunitario($val);
        $notas=$cadena2[0][3].", ".$nota;
        $detalle->setNota($notas);
        $detalle->modificar();
        }
         if ($cadena2==null) { 
        $detalle=new DetalleOrdenes(null,null);
        $detalle->setIddetalle($iddetalle);
        $detalle->setComanda($idcomanda);
        $detalle->setPlato($plato);
        $detalle->setCantidad($cantida);
        $detalle->setVrunitario($val);
        $detalle->setNota($nota);
         $detalle->modificar();}
        break; 
    case 'Eliminar':
        $detalle=new DetalleOrdenes(null,null);
        $detalle->setIddetalle($id);
        $detalle->eliminar();        
}
header('Location:PrincipalAdmin.php?CONTENIDOADMIN=Comandas/comandaListaPlato.php&idcomanda='.$idcomanda.'');
        


