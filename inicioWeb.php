<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once dirname(__FILE__) . '/Clases/ConectorBD.php';



$cadena="select menu.nombre,foto from plato,menu where idmenu=menu and tipo='P'";
$datos= ConectorBD::ejecutarQuery($cadena, null);

$lista="";
for ($i = 0; $i < count($datos); $i++) {
  // Numero total de imagenes

$lista.="<h3 class='text-center text-primary' style='font-weight:bold; '>{$datos[$i][0]}<h3>";   
$lista.="<img class='form-control'  src='{$datos[$i][1]}'>";   
$lista.="<a href='index.php?CONTENIDO=MenuWeb/Menuweb.php' class='alert-warnnig'> VER MAS</a>";   

}

?>

<style>
    #navegador ul{
	list-style-type: none;
	text-align: center;
        
}
#navegador li{
	display: inline;
	text-align: center;
	margin: 0 10px 0 0;
}
    
.modal {
	width: 100%;
	height: 100vh;
	background: rgba(0,0,0,0.8);
	position: fixed;
	top: 0;
	left: 0;
	display: flex;
	animation: modal 2s 3s forwards;
	visibility: hidden;
	opacity: 0;
}
.contenido {
	margin: auto;
	width: 80%;
	height: 90%;
	background: white;
	border-radius: 10px;
}
#cerrar {
	display: none;
}
#cerrar + label {
	position: fixed;
	color: #fff;
	font-size: 25px;
	z-index: 50000000000;
	line-height: 40px;
	margin: -8% -10px; 
	right: 150px;
	top: 150px;
	cursor: pointer;
	animation: modal 2s 3s forwards;
	visibility: hidden;
	opacity: 0;
}
#cerrar:checked + label, #cerrar:checked ~ .modal {
	display: none;
}

@keyframes modal {
	100% {
		visibility: visible;
		opacity: 1;
	}
}

img.imgprincipal{
    
}

h2.btn-primary{
    font-size: 50px;
}

/*SLINDER */

* {
  box-sizing: border-box;
}

img.img {
  vertical-align: middle;

}

/* Position the image container (needed to position the left and right arrows) */
.container {
  position: relative;
  height: 20%;
}

/* Hide the images by default */
.mySlides {
  display: none;
}

/* Add a pointer when hovering over the thumbnail images */
.cursor {
  cursor: pointer;
  
}

/* Next & previous buttons */
.prev,
.next {
  cursor: pointer;

  width: auto;
  padding: 26px;
  color: white;
  font-weight: bold;
  font-size: 20px;
  border-radius: 0 3px 3px 0;
  user-select: none;
  -webkit-user-select: none;
   background: rgba(0,0,0,1);
   
}

/* Position the "next button" to the right */
.next {
   
 
  right: 0;
  border-radius: 3px 0 0 3px;
  
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover,
.next:hover {
    
  background-color: rgba(0, 0, 0, 0.8);
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* Container for image text */
.caption-container {
  text-align: center;
  background-color: #222;
  padding: 2px 16px;
  color: white;
}

.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Six columns side by side */
.column {
  float: left;
  width: 16.66%;
}

/* Add a transparency effect for thumnbail images */
.demo {
  opacity: 0.6;
}

.active,
.demo:hover {
  opacity: 1;
}




</style>
<div class="container-fluid">


<div class="container-fluid "style="margin: 2% -10%;">

<input type="checkbox" id="cerrar">
<label for="cerrar" id="btn-cerrar" class=" btn btn-primary">X</label>
            <div class="modal">
                <div class="contenido"><br>
                    <h2 class="text-center text-info" style="font-size: 50px;font-weight:bolder" >BIENVENIDOS </h2>
                    <img  class="imgprincipal" src="Presentacion/imagenes/modal0000.jpg" width="1000" height="550">
                  
                </div>
            </div>
            

            

<div class="container">
  <div class="mySlides">
    <div class="numbertext">1 / 6</div>
    <img  src="Presentacion/imagenes/slinder5.png" style="width:122%;height: 480%; "  >
  </div>

  <div class="mySlides">
    <div class="numbertext">2 / 6</div>
    <img src="Presentacion/imagenes/slinder1.png"  style="width:122%;height: 480%" >
  </div>

  <div class="mySlides">
    <div class="numbertext">3 / 6</div>
    <img src="Presentacion/imagenes/slinder2.png" style="width:122%;height: 480%"  >
  </div>
    
  <div class="mySlides">
    <div class="numbertext">4 / 6</div>
    <img src="Presentacion/imagenes/slinder3.png" style="width:122%;height: 480%">
  </div>

  <div class="mySlides">
    <div class="numbertext">5 / 6</div>
    <img src="Presentacion/imagenes/slinder4.png" style="width:122%;height: 480%" >
  </div>
    
  <div class="mySlides">
    <div class="numbertext">6 / 6</div>
    <img src="Presentacion/imagenes/cuy.jpg" style="width:130%;height: 480%" >
  </div>
    
    <a class="prev" style="color: white;position: absolute; margin: -28% 5%;"   onclick="plusSlides(-1)">❮</a>
  <a class="next" style="color: white; position: absolute; margin: -28% -20%;"  onclick="plusSlides(1)">❯</a>

  <div class="caption-container">
    <p id="caption"></p>
  </div>

  <div class=" container-fluid row">
    <div class="column">
        <img class="demo cursor " src="Presentacion/imagenes/slinder5.png" style="width:100%" onclick="currentSlide(1)" alt="FRITO">
    </div>
    <div class="column">
        <img class="demo cursor" src="Presentacion/imagenes/slinder1.png" style="width:100%" onclick="currentSlide(2)" alt="ENSALADA DE FRUTAS">
    </div>
    <div class="column">
        <img class="demo cursor" src="Presentacion/imagenes/slinder2.png" style="width:100%" onclick="currentSlide(3)" alt="BANDEJA PAISA">
    </div>
    <div class="column">
        <img class="demo cursor" src="Presentacion/imagenes/slinder3.png" style="width:100%" onclick="currentSlide(4)" alt="SALON DE EVENTOS">
    </div>
    <div class="column">
        <img class="demo cursor" src="Presentacion/imagenes/slinder4.png" style="width:100%" onclick="currentSlide(5)" alt="BANDEJAS">
    </div>    
    <div class="column">
        <img class="demo cursor" src="Presentacion/imagenes/cuy.jpg" style="width:60%; height: 77.8%"  onclick="currentSlide(6)" alt="LA CASITA DEL CUY">
    </div>
  </div>
</div>
<br><br><br><br><br><br>
<br><br><br><br><br><br>
<br><br><br><br><br><br>
<br><br><br><br><br><br>
<br><br><br><br><br><br>
<h2 class="text-center" style="font-weight: bold;">PLATOS A LA CARTA</h2>



</div>
    <div class="container-fluid">
<div class="container-fluid "  style="max-height: 800px; min-width: 100px;  overflow-y: auto;">
   <?=$lista?>
    </div>
        </div>


<script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}



</script>



            