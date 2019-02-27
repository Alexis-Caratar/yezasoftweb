<?php
require_once dirname(__FILE__). '/../../Clases/ConectorBD.php';
require_once dirname(__FILE__). '/../../Clases/Plato.php';

foreach ($_POST as $variable=> $Valor) ${$variable}=$Valor;
foreach ($_GET as $variable=> $Valor) ${$variable}=$Valor;

if (isset($_FILES['foto']['name'])) {
   $nombrefoto=$_FILES['foto']['name'];
   $origen=$_FILES['foto']['tmp_name'];
   
   $nombrefinal= strtolower($nombrefoto);
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
            //este metodo sive para que el usuario a la hora de agregar un servicio no tenga que agregar el ide el cual en plato si lo pider

            $cadenaSQL="SELECT idplato FROM `plato` order by idplato DESC LIMIT 1";
            $respuesta=ConectorBD::ejecutarQuery($cadenaSQL, null);
            $idservicios=40000;
            if (count($respuesta)>0) {
                $idplatonumero=$respuesta[0]['idplato'];
                $idservicio=$idplatonumero+$idservicios-$idservicios+1;
                print_r($idservicio);
            }else $idservicio=$idservicios;
        
            
            $platos=new Plato(null, NULL);
            $platos->setNombre($nombre);
            $platos->setDescripcion($descripcion);
            $platos->setValor($valor);
            $platos->setTipo($tipo);
            $platos->setFoto($ruta);
            $platos->grabarservicio($idservicio);
            
            break;
         case 'Modificar':
             $platos=new Plato(null, NULL);
            $platos->setNombre($nombre);
            $platos->setDescripcion($descripcion);
            $platos->setValor($valor);
            $platos->setTipo($tipo);
            if ($_FILES['foto']['name']==""){
                $platos->setFoto("null");
            }else{
                $platos->setFoto($ruta);
            }
            $platos->Modificarservicio($idplato);
            
            break;
         case 'Eliminar':
            $platos=new Plato(null, NULL);
            $platos->setIdplato($idplato);
            $platos->Eliminar();
            
            break;
}



   ?>
<script>
location="PrincipalAdmin.php?CONTENIDOADMIN=Configuracion/Servicios/servicio.php";
</script>

