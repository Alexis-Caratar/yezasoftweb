<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__)."./Clases/ConectorBD.php";
    
foreach ($_GET as $Variable=> $valor)   ${$Variable}=$valor;
foreach ($_POST as $Variable=> $valor)   ${$Variable}=$valor;
session_start();
$usuario=$_SESSION['user'];
$_SESSION['rol'];
$_SESSION['accion'];


$fechaingreso=ConectorBD::ejecutarQuery("SELECT fecha FROM caja where usuariocaja='$usuario' order by  fecha desc limit 1 ", null);


?>
<link href="boostrap/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <script src="lib/jquery-3.3.1.min.js" type="text/javascript"></script> 
        <div class="contenido"><?php include $_GET['CONTENIDOADMIN']?></div>


 





