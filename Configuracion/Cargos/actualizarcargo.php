<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once dirname(__FILE__). '/../../Clases/ConectorBD.php';
require_once dirname(__FILE__). '/../../Clases/Cargo.php';

foreach ($_POST as $variable=> $valor) ${$variable}=$valor;
foreach ($_GET as $variable=> $valor) ${$variable}=$valor;

switch ($accion){
        case 'Adicionar':
            $cargo=new Cargo(null, null);
            $cargo->setIdcargo($idcargo);
            $cargo->setNombre($nombre);
            $cargo->setSueldo($sueldo);
            $cargo->grabar();
            break;
        case 'Modificar':
             $cargo=new Cargo(null, null);
             $cargo->setIdcargo($idcargo);
            $cargo->setNombre($nombre);
            $cargo->setSueldo($sueldo);
            $cargo->Modificar();
            break;
        case 'Eliminar': 
            $cargo=new Cargo(null, null);
            $cargo->setIdcargo($idcargo);
            $cargo->Eliminar();
            break;       
}?>
<script>
location="PrincipalAdmin.php?CONTENIDOADMIN=Configuracion/Cargos/cargo.php";
</script>
