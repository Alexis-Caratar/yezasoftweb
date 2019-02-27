<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once dirname(__FILE__).'/../Clases/Empleado.php';
require_once dirname(__FILE__).'/../Clases/ConectorBD.php';
$filtro="";
if (isset($_POST['nombre'])&&$_POST['nombre']!=NULL){
    $nombresperson=$_POST['nombre'];
    $filtro="     concat(identificacion,nombres,apellidos) like'%$nombresperson%'";  
}

$datos= Empleado::getDatosEnObjeto($filtro, null);
$lista='';
$numero=1;
if(count($datos)>0){
for ($i = 0; $i < count($datos); $i++) {
    $empleado=$datos[$i];
    
    $lista.="<tr>";
    $lista.="<td> $numero</td>";
    $lista.="<td> {$empleado->getIdentificacion()}</td>";
    $lista.="<td> {$empleado->getNombres()} "."{$empleado->getApellidos()}</td>";
    $lista.="<td> {$empleado->getGenero()}</td>";
    $lista.="<td> {$empleado->getTelefono()}</td>";
    $lista.="<td> {$empleado->getFechanacimiento()}</td>";
    $lista.="<td> {$empleado->getEmail()}</td>";
    $lista.="<td> {$empleado->getFechaingreso()}</td>";
    $lista.="<td> {$empleado->getFechafin()}</td>";
    $lista.="<td> {$empleado->getNombrecargo()->getNombre()}</td>";
   // $lista.="<td> {$empleado->getNombrecargo()->getNombre()}</td>";
    $lista.="<td>";
    $lista.="<a href='PrincipalAdmin.php?CONTENIDOADMIN=Personal/formulariopersonal.php&accion=Modificar&identificacion={$empleado->getIdentificacion()}'><img src='Presentacion/imagenes/Modificar.png' title='Modificar'></a>";
    $lista.="<img src='Presentacion/imagenes/Eliminar.png' onClick=eliminar('{$empleado->getIdentificacion()}') title='Eliminar'> ";
    $lista.="<a href='PrincipalAdmin.php?CONTENIDOADMIN=Personal/Adelanto/adelanto.php&identificacion={$empleado->getIdentificacion()}&nombres={$empleado->getNombres()}&apellidos={$empleado->getApellidos()}&telefono={$empleado->getTelefono()}&email={$empleado->getEmail()}' ><img src='Presentacion/imagenes/Adelanto.png' title='Adelanto'></a>";
    $lista.="<a href='PrincipalAdmin.php?CONTENIDOADMIN=Personal/Prestamo/prestamo.php&identificacion={$empleado->getIdentificacion()}&nombres={$empleado->getNombres()}&apellidos={$empleado->getApellidos()}&telefono={$empleado->getTelefono()}&email={$empleado->getEmail()}'><img src='Presentacion/imagenes/Prestamo.png' title='Prestamo'></a>";
    $lista.="<a href='PrincipalAdmin.php?CONTENIDOADMIN=Personal/Pago/pago.php&identificacion={$empleado->getIdentificacion()}&nombres={$empleado->getNombres()}&apellidos={$empleado->getApellidos()}&telefono={$empleado->getTelefono()}&email={$empleado->getEmail()}&cargo={$empleado->getCargo()}'><img src='Presentacion/imagenes/Pago.png' title='Pago'></a>";  
    $lista.="</td>";
    $lista.="</tr>";
    
    $numero+=1;
    
}
}else{
    $lista.="<td class='text-primary'>No se encontraron resultado para su criterio de busqueda. </td>";
}



?>

<div class="container-fluid ">
  <div class="offset-8 col-md-4   "style="z-index: 100;  margin: 0% 65%; position: absolute;background: #333333;">              <form method="post" >
                    <table class="table-responsive-lg   table-dark table-hover" >
                       <tr> 
                            <th> <img src="presentacion/imagenes/buscarpequeño.png"></span></th><td><input  class="form-control" type="text"  autofocus name="nombre" placeholder="Identificacion o Nombre" ></td>                                               <td><input class="btn btn-primary"type="submit" value="BUSCAR"></td>
                        </tr>
                    </table>
                </form>
        <a style='cursor: pointer;color: white;' onClick="muestra_oculta('contenido1')" title="BUSQUEDA AVANZADA" class="btn-dark offset-5"><img src="presentacion/imagenes/lista.png"width="20" height="15"> Busqueda Avanzada </a>
             <!--busqueda avanzada-->
             <div class="contenido1" id="contenido1">
                <form method="post">
                   <table class="table-hover"style="color:white; ">
                        <tr>
                           <td>
                               <div class="input-group-text"> <span class="input-group-text">CARGO</span>
                                   <select class="input-group-text" name="menus">
                                      
                                   </select>    
                              </div>
                            </td>
                        </tr>
                        <table>
                </form>
                 <form method="post">
                     <table>
                        <tr>
                           
                        </tr>
                        <tr>
                            <td>  
                                <input type="date" name="valor"class="form-control">
                            </td>
                            <td>  
                               <input type="date" name="valor"class="form-control">
                            </td>
                        
                           
                        </tr>
                      </table>
                 </form>
                 <form method="post">
                     <table>
                        <tr>
                           <td>
                                <div class="input-group-text"><span class="input-group-text">Tiempo Preparacion</span>
                                    <input type="number" name="tiempopreparacion"class="form-control">
                                </div>
                            </td>
                        </tr>
                    </table>
                     <input class="btn btn-primary" type="submit"  value="Buscar">
                </form>
              <br>
             

            </div>
    </div> 
     </div>


<div class=" container-fluid"><br>
    <h2 >PERSONAL</h2>
    <table class="table table-hover table-responsive-lg   badge" >
        <thead class="thead-dark">
            <th>No</th> <th>Identificacion</th><th>Nombres Completos</th> <th>Genero</th><th>Telefono</th>
           <th>Fecha de nacimiento</th><th>Email</th><th> Ingreso</th><th> salida</th><th>Cargo</th>
           <th><a href="PrincipalAdmin.php?CONTENIDOADMIN=Personal/formulariopersonal.php&accion=Adicionar"> <img src="Presentacion/imagenes/Adicionar.png" title='Adicionar'></a></th>
       </thead>
       <?=$lista?>
   </table>

</div>

<script>
    function  eliminar(identificacion){
       if(confirm("Desea Eliminar Este registro "+identificacion))
        location="PrincipalAdmin.php?CONTENIDOADMIN=Personal/actualizarpersonal.php&accion=Eliminar&identificacion="+identificacion;   
    }
    function muestra_oculta(id){
     if (document.getElementById){ 
       var el = document.getElementById(id); 
        el.style.display = (el.style.display == 'none') ? 'block' : 'none'; 
     }
        }
        window.onload = function(){
        muestra_oculta('contenido1');
   }

</script>