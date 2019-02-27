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
</style>

<script src="boostrap/bootrapmin.js" type="text/javascript"></script>
<script src="boostrap/min.js" type="text/javascript"></script>

<br>
<div id="demo" class="carousel slide" data-ride="carousel">
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
    <li data-target="#demo" data-slide-to="3"></li>
    <li data-target="#demo" data-slide-to="4"></li>
    <li data-target="#demo" data-slide-to="5"></li>
  </ul>
    <div class="carousel-inner" >
     
    <div class="carousel-item active">
      <img src="Presentacion/imagenes/slinder5.png" alt="Los Angeles" width="100%" height="500">
      <div class="carousel-caption">
        <h3>POLLO A LA BROSTER  </h3>
        <p>las  mejores bandejas estan en el restaurante.</p>
      </div>   
    </div>
    <div class="carousel-item">
        <img src="Presentacion/imagenes/slinder1.png" alt="Chicago" width="100%" height="500">
      <div class="carousel-caption">
        <h3>ENSALADAS</h3>
        <p>Los mejores sabores en tus ensaladas.</p>
      </div>   
    </div>
    <div class="carousel-item">
        <img src="Presentacion/imagenes/slinder2.png" alt="New York" width="100%" height="500">
      <div class="carousel-caption">
        <h3>BANDEJA PAISA</h3>
        <p>Un solo plato, Muchos sabores.</p>
      </div>   
    </div>
    <div class="carousel-item">
        <img src="Presentacion/imagenes/slinder3.png" alt="New York" width="100%" height="500">
      <div class="carousel-caption">
        <h3>EVENTOS</h3>
        <p>We love the Big Apple!</p>
      </div>   
    </div>
    <div class="carousel-item">
        <img src="Presentacion/imagenes/slinder4.png" alt="New York" width="100%" height="500">
      <div class="carousel-caption">
        <h3>COSTILLA AHUMADA</h3>
        <p>los platos son mejores con costilla.</p>
      </div>   
    </div>
    <div class="carousel-item">
        <img src="Presentacion/imagenes/cuy.jpg" alt="New York" width="100%" height="500">
      <div class="carousel-caption">
        <h3>LA CASITA DEL CUY</h3>
        <p>Restaurante de los mejores platos</p>
      </div>   
    </div>
  </div>
  <a class="carousel-control-prev " href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon btn-primary"></span>
  </a>
  <a class="carousel-control-next " href="#demo" data-slide="next">
    <span class="carousel-control-next-icon btn-primary"></span>
  </a>
</div>




<h2 class="text-center" style="font-weight: bold;">PLATOS A LA CARTA</h2>




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



            