<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once dirname(__FILE__) .'/../Clases/ConectorBD.php' ;
require_once dirname(__FILE__) .'/../Clases/Usuario.php' ;
require_once dirname(__FILE__) .'/../Clases/Cliente.php' ;


$usuario=$_POST['email'];
$clave=$_POST['clave'];
if (Cliente::validar2($usuario, $clave)) {   
    ?>
<script>
    location="index.php?CONTENIDO=ReservasWeb/Reservas.php&identificacion=<?=$clave?>";
</script>
    <?php
}else{
    $mensaje="Error en el usuario y/o Contraseña";
    //header("Location: index.php?CONTENIDO=ReservasWeb/Loguin.php&mensaje=$mensaje");
    
}   


?>