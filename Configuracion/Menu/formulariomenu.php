<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require_once dirname(__FILE__). '/../../Clases/ConectorBD.php';
require_once dirname(__FILE__). '/../../Clases/Menu.php';

foreach ($_GET as $variable=> $valor) ${$variable}=$valor;

if ($accion=='Modificar') $menu=new Menu('idmenu',$idmenu );
else  $menu=new Menu(null, null);


?>

<div class="container table-responsive-lg ">

        <h2><?= strtoupper($accion)?> MENU </h2>
        <form  name="formulariomenu" method="POST" action="PrincipalAdmin.php?CONTENIDOADMIN=Configuracion/Menu/actualizarmenu.php">
            <table class=" table-hover table-content">
              <tr><th>Nombre</th>
                  <th><input class="form-control" type="text" accept=""name="nombre" value="<?=$menu->getNombre()?>" placeholder="ingrese nombre"  autofocus required maxlength="80">
                  </th>
              </tr>
            </table>
            <input    type="hidden" name="idmenu" value="<?=$menu->getIdmenu()?>"><br>
           <input class="btn btn-primary text-center" type="submit"  name="accion"value="<?=$accion?>">
        </form>
        
    </div>
