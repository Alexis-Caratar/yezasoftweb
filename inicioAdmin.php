<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$sesiones=$_SESSION['rol'];
if ($sesiones=="cocina") {
    header("location:PrincipalAdmin.php?CONTENIDOADMIN=Comandas/comanda.php&salir");   
}
?>
<div class="container text-center">
    <br>
    <h2 class="text-center " style="font-weight: bolder;font-size: 50px;">SISTEMA DE INFORMACION  PARA RESTAURANTE </h2>
<br>
  <img  class="imgprincipal" src="Presentacion/imagenes/modal0000.jpg" width="1200" height="550">
                 
</div>





