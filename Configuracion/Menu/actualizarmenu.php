<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once dirname(__FILE__). '/../../Clases/ConectorBD.php';
require_once dirname(__FILE__). '/../../Clases/Menu.php';

foreach ($_POST as $variable=> $valor) ${$variable}=$valor;
foreach ($_GET as $variable=> $valor) ${$variable}=$valor;

switch ($accion){
        case 'Adicionar':
            $menu=new Menu(null, null);
            $menu->setIdmenu($idmenu);
            $menu->setNombre($nombre);
            $menu->grabar();
            break;
        case 'Modificar':
            $menu=new Menu(null, null);
            $menu->setIdmenu($idmenu);
            $menu->setNombre($nombre);
            $menu->Modificar();
            break;
        case 'Eliminar': 
            $menu=new Menu(null, null);
            $menu->setIdmenu($idmenu);
            $menu->Eliminar();
            break;
    
        
}
?>
<script>
location="PrincipalAdmin.php?CONTENIDOADMIN=Configuracion/Menu/menu.php";
</script>



 