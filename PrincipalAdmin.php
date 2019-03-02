<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . "./Clases/ConectorBD.php";
foreach ($_GET as $Variable => $valor)${$Variable} = $valor;
foreach ($_POST as $Variable => $valor) ${$Variable} = $valor;

session_start();
$usuario = $_SESSION['user'];
date_default_timezone_set("America/Bogota");


$_SESSION['rol'];
$_SESSION['accion'];
$fechaingreso = ConectorBD::ejecutarQuery("SELECT fecha FROM caja where usuariocaja='$usuario' order by  fecha desc limit 1 ", null);
$cadena= ConectorBD::ejecutarQuery("select max(idcaja) from caja", NULL);
$maximo=$cadena[0][0];
$menu = "";

 if (isset($_GET['acciones'])) {$acciones=$_GET['acciones'];} else {$acciones="abrir";}

    if ($_SESSION['rolesi'] == 'admin') { //Administrador
        $menu = '<div class = "menu">
        <div id = "cssmenu">
            <ul>
            <li class = "active"><a href = "PrincipalAdmin.php?CONTENIDOADMIN=inicioAdmin.php"><span class = "icon-home"></span>INICIO</a></li>
            <li ><a href = "#"><span class = "icon-cog"></span> CONFIGURACION </a>
            <ul>
            <li ><a href = "PrincipalAdmin.php?CONTENIDOADMIN=Configuracion/Menu/menu.php">MENU</a> </li>
            <li><a href = "PrincipalAdmin.php?CONTENIDOADMIN=Configuracion/Platos/plato.php">PLATOS</a> </li>
            <li ><a href="PrincipalAdmin.php?CONTENIDOADMIN=Configuracion/Cargos/cargo.php"> CARGOS</a> </li>
            <li ><a href="PrincipalAdmin.php?CONTENIDOADMIN=Configuracion/Servicios/servicio.php"> SERVICIOS</a> </li>
            <li ><a href="PrincipalAdmin.php?CONTENIDOADMIN=Configuracion/Eventos/evento.php"> EVENTOS</a> </li>
            <li ><a href="PrincipalAdmin.php?CONTENIDOADMIN=Configuracion/Mesa/mesa.php"> MESA</a> </li>
            </ul>
            </li>
            <li ><a href = "PrincipalAdmin.php?CONTENIDOADMIN=Personal/personal.php"><span class = "icon-users"></span>PERSONAL</a> </li>
            <li><a href = "principalAdmin.php?CONTENIDOADMIN=Comandas/caja.php"><span class = "icon-stack"></span>COMANDA</a> </li>
            <li ><a href = "PrincipalAdmin.php?CONTENIDOADMIN=ReservasAdmin/Reservas.php"><span class = "icon-list-numbered"></span>RESERVAS</a> </li>
            <li><a href = "PrincipalAdmin.php?CONTENIDOADMIN=DomiciliosaAdmin/Domicilios.php"><span class = "icon-cart"></span>DOMICILIOS</a></li>
            <li><a href = "#"><span class = "icon-stats-dots"></span>REPORTES</a>
            <ul>
            <li><a href = "PrincipalAdmin.php?CONTENIDOADMIN=Reportes/adelantos.php">Adelantos</a></li>
            </ul>
            </li>
            <li><a href = "#"><span class = "icon-stats-bars"></span>INDICADORES</a>
            <ul>
            <li><a href = "PrincipalAdmin.php?CONTENIDOADMIN=REportes/indicadores.php">Ventas por mes </a> </li>
            </ul>
            </li>
            <li><a href = "PrincipalAdmin.php?CONTENIDOADMIN=Empresa/Empresa.php&accion=Modificar"><span class = "icon-lock"></span>Empresa</a></li>
            <li><a href = "index.php" ><span class = "icon-enter"></span>SALIR</a></li>
            </ul>
        </div>
        </div>';
    }
    if ($_SESSION['rolesi']=='cajero') {//cajero al inicio de sesion
            $menu='<div id = "cssmenu">
            <ul>
                  <li><a href="principalAdmin.php?CONTENIDOADMIN=Comandas/comanda.php"><span class="icon-stack"></span>COMANDA</a> </li>
                   <li ><a href="PrincipalAdmin.php?CONTENIDOADMIN=ReservasAdmin/Reservas.php&"><span class="icon-list-numbered"></span>RESERVAS</a> </li>
                   <li><a href="PrincipalAdmin.php?CONTENIDOADMIN=DomiciliosaAdmin/Domicilios.php"><span class="icon-cart"></span>DOMICILIOS</a></li>
                   <li><a href="PrincipalAdmin.php?CONTENIDOADMIN=Comandas/gasto.php&idcaja='.$maximo.'"><span class="icon-cart"></span>GASTOS</a></li>
                   <li><a onClick="salir('.$maximo.')";>Salir</a></li>
             </ul>
           </div>   ';
        
    }
    if($_SESSION['rolesi'] == 'cocina') { //cocina
        $menu = '
        <table>
            <div id="cssmenu">  
                <ul>

                    <li ><a href="PrincipalAdmin.php?CONTENIDOADMIN=Comandas/comanda.php">COMANDA</a> </li>
                    <li><a href="index.php" >SALIR</a></li>
                    </table>
            ';
    }
 
        
           
    
    

?>
<html>
    <head><title >Yeza Soft</title>
            <link rel="stylesheet" type="text/css" href="Presentacion/css/PrincipalAdmin.css">
            <link rel="stylesheet" type="text/css" href="Presentacion/css/iconos menu.css">
            <link href="boostrap/bootstrap.min.css" rel="stylesheet" type="text/css"/>
            <link href="Presentacion/css/style.css" rel="stylesheet" type="text/css"/>
            <script src="lib/jquery-3.3.1.min.js" type="text/javascript"></script> 
                <style>
                         h2{
                                font-family: serif;
                                font-weight: bolder;
                                font-size: 40px;
                                color: #000;
                        }
                </style>
    </head>
    <body> 
            <!-- estas imagenes son para las redes sociales puro banner-->
            <div style="background: url(presentacion/imagenes/banneryeza0000.jpg); width: 100%; height: 100px; background-size: 100% 100%"> 
                <div style="width: auto; height: 100px; float: right; margin-right: 10px">
                    <li><a >Quienes somos</a></li>
                    <li><a>Ayuda</a></li>
                    <li><a>Acerca de?</a></li>
                </div>
            </div>
            <div class=" table-responsive-lg " >
                    <?= $menu ?>
            </div>
            <div class="contenido table-responsive-lg">
                <?php include $_GET['CONTENIDOADMIN'] ?>    
            </div>
    </body>
</html>
<script>
    function salir(idcaja){
        if(confirm("Esta Seguro de Cerrar Caja "))
        location="PrincipalAdmin.php?CONTENIDOADMIN=Comandas/validarcierrecaja.php&idcaja="+idcaja;
    }
</script>










