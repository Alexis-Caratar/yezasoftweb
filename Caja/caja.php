<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__)."/../Clases/ConectorBD.php";
require_once dirname(__FILE__)."/../Clases/Comandas.php";
require_once dirname(__FILE__)."/../Clases/Facturas.php";

foreach ($_POST as $variable => $valor) ${$variable}=$valor;
foreach ($_GET as $variable=> $valor) ${$variable}=$valor;
$foo = "local variable";
 echo $GLOBALS["foo"];
 
$usuario=$_SESSION['user'];
$rol=$_SESSION['roles'];


        ConectorBD::ejecutarQuery("insert into caja(fecha,base,usuariocaja) values(now(), $base, '$usuario')", null);
        header('Location: PrincipalAdmin.php?CONTENIDOADMIN=Comandas/comanda.php');
    
  ?>


  



