<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once dirname(__FILE__) . '/Clases/ConectorBD.php';
require_once dirname(__FILE__) . '/Clases/Empresa.php';

$list="";

$cadenaSQL="select*from empresa";
$datos= ConectorBD::ejecutarQuery($cadenaSQL, null);
$foto="<img  alt='Responsive image'  src='{$datos[0][9]}' width='500' height='400' style='position:absolute; margin:-2% 50%  ';  >";
?>

<br><br>
<div class="container-fluid " >
    <div class="form-control ">
    <br>
        <h2  class="text-center " style="font-weight: bold; font-size: 50px;"><?=$datos[0][1]?>  </h2><br>
        <h2  class="text-info">ADMINISTRADOR: <?=$datos[0][2]?></h2> <?=$foto?>
        <h2 class="">DIRECCION: <?=$datos[0][3]?></h2>
        <h2 class="">BARRIO: <?=$datos[0][4]?></h2>
        <h2 class="">CIUDAD: <?=$datos[0][5]?></h2>
        <h2 class="">TELEFONO: <?=$datos[0][6]?></h2>
        <h2 class="">CELULAR: <?=$datos[0][7]?></h2>
        <h2 class="">CORREO: <?=$datos[0][8]?></h2>
        <br><br><br><br><br><br>
        <h2 class="btn btn-danger" style="background: black;width: 100%;height: 100%;border-radius: 20px;font-size: 30px;font-family: Times New Roman">UBICACION DEL RESTAURANTE<br>
        <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m11!1m3!1d1714.5112001511222!2d-77.26677007297495!3d1.2059325733563395!2m2!1f0!2f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e2ed4948fa04261%3A0x6751a9b4b949dfca!2sLa+Casita+del+Cuy%2C+Restaurante!5e1!3m2!1ses!2sco!4v1522714281074" width="1050" height="600" frameborder="0" style="border:0" allowfullscreen></iframe>
        <br>.
        </h2>
     
        </div>
   
 
</div>

