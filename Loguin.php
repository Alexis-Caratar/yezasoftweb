<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (isset($_GET['mensaje']))
    $mensaje = $_GET['mensaje'];
else
    $mensaje = ''
    ?>
<html>
    <head><title>LOGIN</title>
        <link href="boostrap/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="lib/jquery-3.3.1.min.js" type="text/javascript"></script>
        <link href="Presentacion/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="Presentacion/css/iconos menu.css" rel="stylesheet" type="text/css"/>
        <style>

            div.container{
                background-color: rgba(63,192,162,0.2);   
                padding: 2%;
            }

            H3{

                font-family: arial;
                color: white;
            }
          
            body{
                width: 100%;
                height: 100%;
                background:url(Presentacion/imagenes/fondo4.jpg)
            }

        </style>
    </head>
    <body ><br><br>
        <div class="container-fluid">
                   
            <div class="container col-md-6 offset-6" >
                 <img src="Presentacion/imagenes/yezasoftfinalfinal.png" width="200" height="150" style="background: white; border-radius:10%; margin: 0% 5%; padding: 10"><br>
         
                <form name="formulario" method="POST"  action="ValidarAdmin.php">
                       <div class="col-10  offset-2 ">
                        <H1 class="text-center" style="font-weight:bolder;color: white;font-family:arial;font-size: 50px" >  LOGIN</H1>
                        <font color="red" face="arial" >    <?= $mensaje ?>
                        <center>
                        <table class="table table-dark table-hover " >
                            <tr> 
                                <th> <span class="icon-user"></span> Usuario</span></th><td><input  class="form-control" type="text"  autofocus name="usuario" placeholder="ingrese usuario" ></td>
                            </tr><br>
                            <tr>
                                <th><span class="icon-key"></span> </span> Contraseña</th><td><input id="contraseñatxt"class="form-control" type="password" name="clave" placeholder="ingrese Contraseña">
                                    <input type="checkbox" id="chkcontraseña" onclick=" constraseñass()"></td>
                            </tr>
                        </table>
                            </center>
                        <center>
                            <input class=" btn btn-primary"   type="submit" value="Ingresar">
                        </center>
                    </div>
                </form>  
            </div>
            <br><br>
            <a href="index.php">Regresar Menu</a>
            <h3 class="text-right" style="font-weight:bolder; ">SISTEMA DE INFORMACION PARA RESTAURANTE</h3>
            <h6 class="text-right text-info ">@Todos los derechos reservados por @yezasoft</h6>
        </div>
    </body>
</html>

