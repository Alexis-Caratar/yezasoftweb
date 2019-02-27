<?php
require_once dirname(__FILE__). '/../Clases/ConectorBD.php';
require_once dirname(__FILE__). '/../Clases/Empresa.php';

foreach ($_POST as $Variable => $Valor) ${$Variable}=$Valor; 
foreach ($_GET as $Variable => $Valor) ${$Variable}=$Valor; 

if (isset($_FILES['foto']['name'])) {
   $nombrefoto=$_FILES['foto']['name'];
   $origen=$_FILES['foto']['tmp_name'];
   
   $nombrefinal= strtolower($nit.$nombrefoto);
   $ruta="foto/".$nombrefinal;
   $resultado=@move_uploaded_file($origen, $ruta);
   if (!empty($resultado)) {
       //echo 'se subio el archivo correctamente';
   }
} else {
$ruta=" ";    
}

switch ($accion){
    case 'Actualizar':
        $si=new Empresa(null,null);
        $si->setNit($nit);
        $si->setNombre($nombre);
        $si->setDireccion($direccion);
        $si->setBarrio($barrio);
        $si->setCiudad($ciudad);
        $si->setTelefono($telefono);
        $si->setCelular($celular);
        $si->setAdministrador($administrador);
        $si->setRedessociales($redessociales);
             if ($_FILES['foto']['name']==""){
                $si->setFoto("null");
            }else{
                $si->setFoto($ruta);
            }
        $si->modificar();
        break;
}

?>
<script>
    alert("Los Datos Han Sido Actualizados Correctamete");
    location='PrincipalAdmin.php?CONTENIDOADMIN=Empresa/Empresa.php&accion=Modificar';
</script>

