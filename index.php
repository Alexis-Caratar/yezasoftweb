<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__).'/Clases/ConectorBD.php';


$CONTENIDO = "inicioweb.php";
if (isset($_GET['CONTENIDO'])) {
    $CONTENIDO = $_GET['CONTENIDO'];
}
$cadena="select*from empresa";
$datos12= ConectorBD::ejecutarQuery($cadena, null);
?>
<html>
    <head>
        <title>YEZA SOFT</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet"  href="Presentacion/css/index.css">
        <link rel="stylesheet" type="text/css" href="Presentacion/css/spinnerCarga.css">  
        <link rel="stylesheet" type="text/css" href="Presentacion/css/iconos menu.css">  
        <link rel="stylesheet" type="text/css" href="Presentacion/css/redes sociales.css">  
        <link href="Presentacion/css/style.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="menu.css">  
        <link rel="stylesheet" type="text/css"  href="boostrap/bootstrap.min.css" />
        <script src="lib/jquery-3.3.1.min.js" type="text/javascript"></script>
        <script src="lib/ModalMenu.js" type="text/javascript"></script>
        <script src="lib/spinnercarga.js" type="text/javascript"></script>
        <link href="Presentacion/css/menu.css" rel="stylesheet" type="text/css"/>
        


        <script>
            window.onload = function () {
                var contenedor = document.getElementById('contenedor_carga');
                contenedor.style.visibility = 'hidden';
                contenedor.style.opacity = '0';
            }
        </script>
        <style>
            img.img_contenedor{                
                 width: 200px; height: 200px;
            }
            body{
                background-color: #ffffcc;
            }
        </style>
    </head>
    <body >

        <div class="container-fluid">
        <div id="contenedor_carga">

            <div id="spinner">      
            </div>
            <img class="spiiner_img" src="Presentacion/imagenes/cuy.jpg" style="border-radius: 100%; " width="200" height="200">

            <h2 class="titulocargando"> CARGANDO...</h2>
        </div>
        <!--banner-->
        <div class="container-fluid table-responsive-lg">
        
            <img  src="Presentacion/imagenes/lacacasitadelcuy0000.jpg" width="100%;" >
        
        <!--Menu-->
        <div class="table table-responsive-lg form-control" style="background: #161819;">
        <div id='cssmenu' >  
            <ul>
                <li ><a href="index.php">   <span class="icon-home"> </span>INICIO</a>
                    <ul>
                        <li ><a href="index.php?CONTENIDO=InicioWeb/Historia.php">HISTORIA</a></li> 
                        <li ><a href="index.php?CONTENIDO=InicioWeb/Mision_Vision.php">MISION/VISION</a></li> 
                    </ul>
                </li>    
                <li ><a href="index.php?CONTENIDO=MenuWeb/Menuweb.php"><span class="icon-spoon-knife"> </span>MENU </a></li>    
                <li  ><a href="index.php?CONTENIDO=EventosServiciosWEB/eventos.php"><span class="icon-stack"></span>EVENTOS</a></li>
                <li  ><a href="index.php?CONTENIDO=EventosServiciosWEB/servicios.php"><span class="icon-list-numbered"></span>SERVICIOS</a></li>
                <li ><a href="index.php?CONTENIDO=ReservasWeb/Loguin.php"><span class="icon-stats-dots"></span>RESERVA</a></li>
                <li><a href="index.php?CONTENIDO=DomiciliosWeb/Domicilios.php"><span class="icon-cart"></span>DOMICILIOS</a></li>
                <li><a href='index.php?CONTENIDO=contactos.php'><span class="icon-address-book"></span>CONTACTO</a></li>
                <li><a href='Loguin.php'><span class="icon-users"></span>LOGIN</a></li>
            </ul>
        </div>
    </div>
        <div class="social">
            <ul>
                <li><a href="#" target="_blank" class="icon-facebook2"></a></li>
                <li><a href="#" target="_blank" class="icon-twitter"></a></li>
                <li><a href="#" class="icon-instagram"></a></li>
                <li><a href="#" class="icon-youtube2"></a></li>                                       
            </ul>
        </div>
        <div class="lineacolorida"></div>

        <?php include $CONTENIDO ?>


        
        <div class="table-responsive-lg container-fluid"><br>
        <footer style="background-color: #057E94;color: white; font-family: arial; font-size: 30px; "><br>
            
            <div class="row container-fluid">
                <div class="col-md-7">
                    <H1 style="font-weight: bold;">CONTACTO</H1>
                     <li class=""><span class="icon-spoon-knife"></span> <?=$datos12[0][1]?></li>
                     <li><span class="icon-users"></span><?=$datos12[0][2]?></li>
                     <li class=""><span class="icon-compass2"></span><?=$datos12[0][3]?></li>
                     <li class=""><span class="icon-compass2"></span> Direccion: <?=$datos12[0][4]?></li>
                     <li ><span class="icon-compass2"></span> Ciudad: <?=$datos12[0][5]?></li>
                     <li > <span class="icon-phone"></span><?=$datos12[0][6]?></li>
                     <li ><span class="icon-phone"></span><?=$datos12[0][7]?></li>
                     <li ><span class="icon-address-book"></span><?=$datos12[0][8]?></li>
                    
            <br><br>
            <h2>REDES SOCALES</h2>
            <li>
                <a href="https://www.facebook.com/"><span class="icon-facebook2"></span></a>
                <a href="https://www.facebook.com/"><span class="icon-twitter"></span></a>
                <a href="https://www.facebook.com/"><span class="icon-youtube2"></span></a>
                <a href="https://www.facebook.com/"><span class="icon-envelop"></span></a>                
            </li>
                     
                     
                </div>    
                 <div class="col-md-5">
                     
                     <H1 style="font-weight: bold;">SOBRE NOSOSTROS</H1>
            <ul>
                <li ><a href="index.php?CONTENIDO=InicioWeb/Historia.php">Historia</a></li>
                <li><a href="index.php?CONTENIDO=InicioWeb/Mision_Vision.php">Mision y Vision</a></li>
                <li><a href="index.php?CONTENIDO=contactos.php">INFORMACION</a></li>
            </ul>
                     <br><br>
                       <H1 style="font-weight: bold;"> COMENTARIOS</H1>
                       
                       <input type="text" name="nombre" class="form-control" placeholder="NOMBRES COMPLETOS" required><br>
                       <input type="email" name="email" class="form-control" placeholder="EMAIL" required><BR>
                       <textarea name="area"  class="form-control" placeholder="ingrese comentario" required style="max-height: 150px;"></textarea>
                       <input type="submit" onclick="enviar()" class="form-control btn btn-danger" value="Enviar" placeholder="EMAIL"><BR>                     
                </div>  
            </div>
            
            <br>
            <h5 class="form-control"></h5>
            <img class="col-3" src="Presentacion/imagenes/cuy.jpg" width="80" height="100" style="border-radius: 500%;"><br>
            <h6 class="text-right">Copyright 2018 @yezasoft. Todos los derechos reservados.</h6>
        </footer>
  </div>     
       
  </div>
        
    </body>
</html>

<script>
function enviar(){
    alert("COMENTARIOS ENVIADOS");
}
</script>