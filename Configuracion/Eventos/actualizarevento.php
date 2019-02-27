<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//importacion de las clases que se requieren para este programa.

require_once dirname(__FILE__). '/../../Clases/ConectorBD.php';
require_once dirname(__FILE__). '/../../Clases/Evento.php';
//fin de importacion de las clases.

//recuperar las variables que llegan.
foreach ($_POST as $Variable => $Valor) ${$Variable}=$Valor; 
foreach ($_GET as $Variable => $Valor) ${$Variable}=$Valor; 

if (isset($_FILES['foto']['name'])) {
   $nombrefoto=$_FILES['foto']['name'];
   $origen=$_FILES['foto']['tmp_name'];
   
   $nombrefinal= strtolower($idevento.$nombrefoto);
   $ruta="foto/".$nombrefinal;
   $resultado=@move_uploaded_file($origen, $ruta);
   if (!empty($resultado)) {
       echo 'se subio el archivo correctamente';
   }
} else {
$ruta=" ";    
}

switch ($accion){
    case 'Adicionar':
        $si=new Evento(null,null);
        $si->setIdevento($idevento);
        $si->setNombre($nombre);
        $si->setDescripcion($descripcion);
        $si->setFoto($ruta);
        
        $si->grabar();
        break;
    case 'Modificar':
        $si=new Evento(null,null);
        $si->setIdevento($idevento);
        $si->setNombre($nombre);
        $si->setDescripcion($descripcion);
             if ($_FILES['foto']['name']==""){
                $si->setFoto("null");
            }else{
                $si->setFoto($ruta);
            }
        $si->modificar();
        break;
    case 'Eliminar':
        $si=new Evento(null, null);
        $si->setIdevento($idevento);
        $si->eliminar();
        break;
}
?>
<script>
location="PrincipalAdmin.php?CONTENIDOADMIN=Configuracion/Eventos/evento.php";
</script>

