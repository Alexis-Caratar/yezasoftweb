<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$usuario=$_SESSION['user'];

if ($accion=='Adicionar'){
    $cadena="insert into caja (fecha,base,usuariocaja)values(now(),$base,$usuario)";
    ConectorBD::ejecutarQuery($cadena,null);
}


?>
<h3>aCTUALIZAR</h2>