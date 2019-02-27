<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once dirname(__FILE__). '/../../Clases/ConectorBD.php';
require_once dirname(__FILE__). '/../../Clases/Plato.php';

foreach ($_POST as $variable=> $Valor) ${$variable}=$Valor;
foreach ($_GET as $variable=> $Valor) ${$variable}=$Valor;

if (isset($_FILES['foto']['name'])) {
   $nombrefoto=$_FILES['foto']['name'];
   $origen=$_FILES['foto']['tmp_name'];
   
   $nombrefinal= strtolower($idplato.$nombrefoto);
   $ruta="foto/".$nombrefoto;
   $resultado=@move_uploaded_file($origen, $ruta);

} else {
    $ruta=" ";    
}






switch ($accion){
        case 'Adicionar':
            $platos=new Plato(null, NULL);
            $platos->setIdplato($idplato);
            $platos->setNombre($nombre);
            $platos->setDescripcion($descripcion);
            $platos->setValor($valor);
            $platos->setTiempopreparacion($tiempopreparacion);
            $platos->setMenu($menu);
            $platos->setTipo($tipo);
            $platos->setFoto($ruta);
                   
            $platos->grabar();
            
            break;
         case 'Modificar':
            $platos=new Plato(null, NULL);
            $platos->setIdplato($idplato);
            $platos->setNombre($nombre);
            $platos->setDescripcion($descripcion);
            $platos->setValor($valor);
            $platos->setTiempopreparacion($tiempopreparacion);
            $platos->setMenu($menu);
            $platos->setTipo($tipo);
            if ($_FILES['foto']['name']==""){
                $platos->setFoto("null");
            }else{
                $platos->setFoto($ruta);
            }
            $platos->Modificar($idplatoanterior);
            
            
            break;
         case 'Eliminar':
            $platos=new Plato(null, NULL);
            $platos->setIdplato($idplato);
            $platos->Eliminar();
            
            break;

    
        
}
  ?>
<script>
location="PrincipalAdmin.php?CONTENIDOADMIN=Configuracion/Platos/plato.php";
</script>

