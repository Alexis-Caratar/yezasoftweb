<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require_once dirname(__FILE__).'/../Clases/Empleado.php';
require_once dirname(__FILE__).'/../Clases/ConectorBD.php';



if (isset($mensaje)) {$mensaje=$mensaje;}else $mensaje="";
if (isset($identificacion)) {$identificacion=$identificacion;}else $identificacion="";
if (isset($nombres)) {$nombres=$nombres;}else $nombres="";
if (isset($apellidos)) {$apellidos=$apellidos;}else $apellidos="";
if (isset($genero)) {$genero=$genero;}else $genero="";
if (isset($telefono)) {$telefono=$telefono;}else $telefono="";
if (isset($fechanacimiento)) {$fechanacimiento=$fechanacimiento;}else $fechanacimiento="";
if (isset($email)) {$email=$email;}else $email="";
if (isset($fechaingreso)) {$fechaingreso=$fechaingreso;}else $fechaingreso="";
if (isset($fechafin)) {$fechafin=$fechafin;}else $fechafin="";
if (isset($cargo)) {$cargo=$cargo;}else $cargo="";



foreach ($_GET as $Variable=> $Valor)
   ${$Variable}=$Valor;
   
if ($accion=='Modificar') $empleado=new Empleado('identificacion', $identificacion);
else $empleado=new Empleado(null, null);

$auxiliar='';


?>
<center>
<div class="container-fluid "><br><br>
    <h2 class="text-center"><?=strtoupper($accion)?></h2><br>
<font color="red"><h5><?=$mensaje?></h5>

<div class="col-lg-8 col-lg-offset-6">
<form name="formulario" action="PrincipalAdmin.php?CONTENIDOADMIN=Personal/actualizarpersonal.php" method="post">
    <table class="table table-content">
        <tr><th>IDENTIFICACION</th><td><input class="form-control" type="number" value="<?=$empleado->getIdentificacion()?>" name="identificacion" placeholder="ingrese identificacion" required autofocus></td></tr> 
        <tr><th>NOMBRES</th><td><input class="form-control" type="text" value="<?=$empleado->getNombres(),$nombres?>" name="nombres" placeholder="ingrese nombres" required ></td></tr>
        <tr>    <th>APELLIDOS</th><td><input class="form-control" type="text" value="<?=$empleado->getApellidos(),$apellidos?>" name="apellidos" placeholder="ingrese apellidos" required ></td></tr>
        
        <tr><th>GENERO</th>
            <th> <select name="genero" class="form-control" >
                    <option value="Masculino"    >Masculino</option>
                    <option value="Femenino">Femenino</option>
                  </select>
             </th>
        </tr>
        <tr><th>TELEFONO</th><td><input class="form-control" type="number" value="<?=$empleado->getTelefono(),$telefono?>" name="telefono" placeholder="telefono" required ></td></tr>
        <tr> <th>FECHA DE NACIMIENTO</th><td><input class="form-control" type="date" value="<?=$empleado->getFechanacimiento(),$fechanacimiento?>" name="fechanacimiento" placeholder="fecha nacimiento" required></td></tr>
        <tr><th>EMAIL</th><td><input class="form-control" type="text" value="<?=$empleado->getEmail(),$email?>" name="email" placeholder="email" required></td>        </tr>
        <tr><th>FECHA INGRESO</th><td><input class="form-control" type="date" value="<?=$empleado->getFechaingreso(),$fechaingreso?>" name="fechaingreso" placeholder="fecha ingreso"required ></td></tr>
        <tr><th>FECHA SALIDA</th><td><input class="form-control" type="date" value="<?=$empleado->getFechafin(),$fechafin?>" name="fechafin" placeholder="fecha salida" ></td></tr>
        <tr><th>CARGO</th><td><select name="cargo" class="form-control"><?= $empleado->getlistacargo($empleado->getCargo()),$cargo ?></select></td></tr>
      
    </table>
    <center><input class="btn btn-primary " type="submit" value="<?=$accion?>" name="accion"></center>  
    <input  type="hidden" value="<?=$empleado->getIdentificacion()?>" name="identificacionA" >
    
</form>
    </div>
    
</div>
    </center>