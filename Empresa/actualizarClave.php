<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__). '/../Clases/ConectorBD.php';
require_once dirname(__FILE__). '/../Clases/Usuario.php';


foreach ($_POST as $Variable=> $valor)   ${$Variable}=$valor;
foreach ($_GET as $Variable=> $valor)   ${$Variable}=$valor;



if (isset($_GET['usuario'])) $usuario = $_SESSION['rol'];
else $usuario='';
    
if (Usuario::validarclave($claveactual)){
    if ($clavenueva==$confirmarclave) {
        $usuarios=new Usuario(null, null);
        $usuarios->Modificaradministrador($usuario,$claveactual,$clavenueva);
    } else {$mensaje="No concuerdan las contraseñas nuevas";
         header("Location:PrincipalAdmin.php?CONTENIDOADMIN=Empresa/cambioclaveadmin.php&mensaje=$mensaje&claveactual=$claveactual&clavenueva=$clavenueva&confirmarclave=$confirmarclave ") ;
    }
}
else{
     $mensaje="las contraseña actual es incorrecta";
        header("Location:PrincipalAdmin.php?CONTENIDOADMIN=Empresa/cambioclaveadmin.php&mensaje=$mensaje&claveactual=$claveactual&clavenueva=$clavenueva&confirmarclave=$confirmarclave ") ;    
}
?>


<script>
    alert("Contraseña Modificada");
  
location="loguin.php?mensaje=Ingrese de nuevo al sistema";
</script>

    

