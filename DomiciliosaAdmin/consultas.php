<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once dirname(__FILE__) . "/../Clases/ConectorBD.php";

if (isset($_POST['buscaridentificacion'])) {
    $cadenaSQL="select identificacion,nombres from cliente WHERE identificacion LIKE '%{$_POST['buscaridentificacion']}%' or nombres like'%{$_POST['buscaridentificaion']}%'";
    $datos= ConectorBD::ejecutarQuery($cadenaSQL, NULL);
    echo json_encode($datos);
}