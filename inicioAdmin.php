<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$inicio="";
$sesiones=$_SESSION['rolesi'];

if ($sesiones=="cocina") {
    header("location:PrincipalAdmin.php?CONTENIDOADMIN=Comandas/comanda.php&salir");   
}
if ($sesiones=="cajero") {
    $today = getdate();
        date_default_timezone_set("America/Bogota");
        $inicio = '
         <div class="container">
         <H2 class="text-center" >ABRIR CAJA</H2><br>
         <div class="row">
            <div class=" col-5">
             <form method = "post" action = "principalAdmin.php?CONTENIDOADMIN=Caja/caja.php">
                 <table class="table table-hover">
                     <tr>
                          <h4> FECHA: ' . date("Y-m-d g:i:s A"). ' </h4>
                         <h3> CAJERO: '.$_SESSION['rol']. ' </h3>
                         <h3> IDENTIFICACION: '.$_SESSION['user']. ' </h3>
                     </tr>
                 </table> 
                 </div>
                 <div class=" col-5">
                 <span>INGRESE BASE</span>
                   <span><input class="form-control" type="number" name = "base"></span> 

                             <input type="hidden" value="' . $_SESSION["user"] . ' name="usuario">
                             <input  class="btn btn-primary form-control" type="submit" value="Abrir" >
                 </div>    
             </form>
          </div> 
          </div>';
}else{
    $inicio='<div class="container text-center">
    <br>
    <h2 class="text-center " style="font-weight: bolder;font-size: 50px;">SISTEMA DE INFORMACION  PARA RESTAURANTE </h2>
<br>
  <img  class="imgprincipal" src="Presentacion/imagenes/modal0000.jpg" width="1200" height="550">
               
</div>';
}
?>
<?=$inicio?>