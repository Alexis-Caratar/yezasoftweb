<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once dirname(__FILE__).'/../Clases/conectorBD.php';

if (isset($_POST['cadenaSQL'])){
    $datos= ConectorBD::ejecutarQuery($_POST['cadenaSQL'], null);
    
    echo json_encode($datos);
    
}