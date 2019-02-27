<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


ConectorBD::ejecutarQuery("update caja set fechasalida=now() where idcaja=$idcaja", NULL);
header("Location:index.php");
?>