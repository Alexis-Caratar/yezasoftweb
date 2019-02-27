<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require_once dirname(__FILE__).'/../Clases/Empleado.php';
require_once dirname(__FILE__).'/../Clases/Usuario.php';
require_once dirname(__FILE__).'/../Clases/ConectorBD.php';

foreach ($_GET as $Variable=> $Valor)
   ${$Variable}=$Valor;
   
if ($accion=='Modificar') {$empleado=new Empleado('identificacion', $identificacion);
$usuario=new Usuario('empleado', $identificacion);
}
else {$empleado=new Empleado(null, null);
$usuario=new Usuario(NULL, null);
}
$auxiliar='';


?>
<style>
    

div#content {
	display:none;
  padding:10px;
  background-color:#f6f6f6;
  width:200px;
  cursor:pointer;
}

input#show:checked ~ div#content {
	display:block;
}

input#hide:checked ~ div#content {
	display:none;
}
</style>
<center>
<div class="container-fluid "><br><br>
    <h2 class="text-center"><?=strtoupper($accion)?></h2><br>


<div class="col-lg-8 col-lg-offset-6">
<form name="formulario" action="PrincipalAdmin.php?CONTENIDOADMIN=Personal/actualizarpersonal.php" method="post">
    <label id="mensaje1" style="color: red;"></label>
    <table class="table table-content">
        <tr><th>IDENTIFICACION</th><td><input id="identificacion" class="form-control" type="number" value="<?=$empleado->getIdentificacion()?>" name="identificacion" placeholder="ingrese identificacion" required autofocus onchange="validarusuario()"></td></tr> 
        <tr><th>NOMBRES</th><td><input class="form-control" type="text" value="<?=$empleado->getNombres()?>" name="nombres" placeholder="ingrese nombres" required ></td></tr>
        <tr>    <th>APELLIDOS</th><td><input class="form-control" type="text" value="<?=$empleado->getApellidos()?>" name="apellidos" placeholder="ingrese apellidos" required ></td></tr>
        
        <tr><th>GENERO</th>
            <th> <select name="genero" class="form-control" >
                    <option value="Masculino"    >Masculino</option>
                    <option value="Femenino">Femenino</option>
                  </select>
             </th>
        </tr>
        <tr><th>TELEFONO</th><td><input class="form-control" type="number" value="<?=$empleado->getTelefono()?>" name="telefono" placeholder="telefono" required ></td></tr>
        <tr> <th>FECHA DE NACIMIENTO</th><td><input class="form-control" type="date" value="<?=$empleado->getFechanacimiento()?>" name="fechanacimiento" placeholder="fecha nacimiento" required></td></tr>
        <tr><th>EMAIL</th><td><input class="form-control" type="text" value="<?=$empleado->getEmail()?>" name="email" placeholder="email" required></td>        </tr>
        <tr><th>FECHA INGRESO</th><td><input class="form-control" type="date" value="<?=$empleado->getFechaingreso()?>" name="fechaingreso" placeholder="fecha ingreso"required ></td></tr>
        <tr><th>FECHA SALIDA</th><td><input class="form-control" type="date" value="<?=$empleado->getFechafin()?>" name="fechafin" placeholder="fecha salida" ></td></tr>
        <tr><th>CARGO</th><td><select name="cargo" class="form-control"><?= $empleado->getlistacargo($empleado->getCargo())?></select></td></tr>
        <tr><th>ROL EN S.I</th>
        
           
      
    </table>
    
     <input type="radio" id="hide" name="rol" checked value="nada">Ninguno
            <input type="radio" id="show" name="rol" value="admin">Administrador
            <input type="radio" id="show" name="rol" value="cajero">Cajero
            <input type="radio" id="show" name="rol" value="mesero">Mesero
            <input type="radio" id="show" name="rol" value="cocina">Cocina
            <br>
            <label id="mensaje" style="color: red;"></label>
            <div id="content">
                <tr><th>USUARIO</th><td><input id="usuario" class="form-control" type="text" value="<?=$usuario->getUsuario()?>" onchange="validarusuario()" name="usuario" placeholder="usuario"  ></td></tr>
                <tr> <th>CONTRASEÑA</th><td><input id="clave" class="form-control" type="password" value="<?=$usuario->getClave()?>" name="clave" placeholder="contraseña" ></td></tr>
                </div>
            <br><br><br>
            <center><input id="botton" class="btn btn-primary " id="accion" type="submit" value="<?=$accion?>" name="accion"></center>  
    <input  type="hidden" value="<?=$empleado->getIdentificacion()?>" name="identificacionA" >
    
</form>
    </div>
    
</div>
    </center>
<script>
    
    function validarusuario(){
        $("#mensaje1").html("");
         $("#mensaje").html("");
         
       var usuario=$('#usuario').val();       
       var identificacion=$('#identificacion').val();  
       var accion=$("#accion").html("");
        if(accion=='Adicionar'){
        if(usuario!=''){
            var $cadena="select*from usuario where usuario='"+usuario+"'";
        }
        if(identificacion!=''){
            var $cadena="select*from empleado where identificacion='"+identificacion+"'";
        }
        }else{
            
        }
        
        
     
      $.ajax({
            type: 'POST',
            data: {cadena: $cadena},
            url: "consultageneral.php",
            success: function (data) {
                if(data!=""){
                    if(usuario!=''){
                       $("#mensaje").html("Usuario existente ") 
                    }
                    if(identificacion!=''){
                      $("#mensaje1").html("identificacion existente ")  
                    }
                    
                    
                    $('#botton').hide(); 
                }else{
                     $('#botton').show(); 
                }
            },error: function () {
                
            } 
        });
      
    }
    </script>
