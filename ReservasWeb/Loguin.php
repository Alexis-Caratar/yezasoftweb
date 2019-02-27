<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once dirname(__FILE__) . '/../Clases/ConectorBD.php';
require_once dirname(__FILE__) . '/../Clases/Cliente.php';
require_once dirname(__FILE__) . '/../Clases/Usuario.php';

if (isset($_GET['mensaje'])) $mensaje=$_GET['mensaje'];       
else $mensaje='';
$cliente = new Cliente(null, null);
$usuario = new Usuario(null, null);

?>
<style>
    .sinpadding [class*="col-"] {
    padding: 0;
}
</style>
<br>
<diav class="container-fluid sinpadding"> 
    <br>
    
   
<!--    <div class="row container-fluid">
        
        <div class="col-md-5 offset-text-info">
        <h4>RESERVA EN LA CASITA DEL CUY PARA TUS EVENTOS ESPECIALES O COMIDAS FAMILIARES, EN LA CASITA DEL CUY ENCONTRARAS TODO LO QUE BUSCAS
        CON LOS MAS GRANDES SERVICIOS QUE OFRECEMOS  </h4>
        </div>
        <div class="text-center text-muted">
        <h4>SERVICIOS</h4> 
        <ul>
            <li> *CUMPLEAÑOS</li>
            <li>   *BAUTIZOS</li>
            <li>*PRIMERA COMUNION</li>
            <li>*PRIMERA BODAS</li>
        </ul>
        </div>
        
        <h2>RESERVA YA TU SALON PARA TUS EVENTOS  ESPECIALES AQUI</h2>  
       
       </div> -->
 
        <div class="row container-fluid"> 
            <div class="col-md-4 ">
                 <img src="Presentacion/imagenes/Captura.PNG" width="700">
                 <a href="index.php?CONTENIDO=EventosServiciosWEB/eventos.php"><h2 class="btn btn-danger" style="position: absolute;margin: -40% 100%; padding: 20px;font-size: 30px; border-radius: 20%;font-weight: bold;"> VER MAS</h2></a> 
            </div>
    <div class="col-md-4 offset-3">
        <div class="container-fluid form-control">
 <form name="formulario" method="POST"  action="index.php?CONTENIDO=ReservasWeb/Validar.php">
                               
     <H2 class="text-center" style="font-family: arial; font-weight: bold; font-size: 40px;">  Iniciar sesion</H2>
                             <font color="red" face="arial">    <?=$mensaje?><br></font>
                             <div >
                                                       <table class="table-content" >
                                                           <tr> 
                                                               <th > Usuario</th><td><input  class=" form-control " type="email"  autofocus name="email" placeholder="correo electronico" ></td>
                                                       </tr><br>
                                                           <tr>
                                                               <th>Contraseña</th><td><input id="contraseñatxt"class="form-control"  type="password" name="clave" placeholder="N° De Identificaion"></td>
                                                           </tr>
                                                       </table>
                                 </div>
                             <br><input class="btn btn-primary "   type="submit" value="Ingresar" ><a href="index.php?CONTENIDO=ReservasWeb/Registrar.php">Registrar</a>
                              
                    </form>
        </div>
   
        
           <form name="formulario" method="POST" action="index.php?CONTENIDO=ReservasWeb/Actualizar.php" enctype="multipart/form-data">
                    <br><br>
                    
                     <H2 class="text-center" style="font-family: arial; font-weight: bold; font-size: 40px;">  REGISTRARSE</H2>
                    <table class="table table-hover" >
                        <tr>
                            <th   >
                        
                            </th>
                        </tr>
                        <tr>
                            <th>Identificacion</th><th><input class="form-control"type="tex" name="identificacion" value="<?=$cliente->getIdentificacion()?>"></th>
                        </tr>
                        <tr>
                            <th>Nombres</th><th><input class="form-control"type="tex" name="nombres" value="<?=$cliente->getNombres()?>"></th>
                        </tr>
                        <tr>
                            <th>Apellidos</th><th><input class="form-control"type="tex" name="apellidos" value="<?=$cliente->getApellidos()?>"></th>
                        </tr>
                        <tr>
                            <th>Telefono</th><th><input class="form-control"type="tel" name="telefono" value="<?=$cliente->getTelefono()?>"></th>
                        </tr>
                        <tr>
                            <th>E-Mail</th><th><input class="form-control"type="email" name="emails" value="<?=$cliente->getEmails()?>"></th>
                        </tr>
                    </table><br>
                    <center><input type="submit" value="Registrar" class="btn btn-primary"></center>
		</form>

                       
        </div>
   
        </div>
      </div>
    
    </body>
</html>