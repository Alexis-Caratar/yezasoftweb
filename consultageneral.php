<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__).'/Clases/ConectorBD.php';

foreach ($_POST as $Variable=> $Valor)${$Variable}=$Valor;
$datos=ConectorBD::ejecutarQuery($cadena, null);
  $lista="";
  if (count($datos)>0){
       $lista.=$datos[0][0];
  }else{  $lista.="";
  }
  echo $lista;
?>
