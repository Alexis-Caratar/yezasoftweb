<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once dirname(__FILE__). '/../Clases/ConectorBD.php';


foreach ($_POST as $variable=> $valor) ${$variable}=$valor;
foreach ($_GET as $variable=> $valor) ${$variable}=$valor;

switch ($accion){
        case 'Adicionar':
             $cadenasql="insert into gasto (valor,descripcion,caja)values('$gasto','$descripcion',$idcaja);";
             print_r($cadenasql);  
            ConectorBD::ejecutarQuery($cadenasql, null);
            break;
        case 'Modificar':
          $cadenasql="update  gasto set valor='$gasto', descripcion='$descripcion',caja='$idcaja' where idgastos=$idgastos";
            print_r($cadenasql); 
            ConectorBD::ejecutarQuery($cadenasql, null);
            break;
        case 'Eliminar': 
          $cadenasql="delete from gasto where idgastos=$idgastos";
           print_r($cadenasql);
            ConectorBD::ejecutarQuery($cadenasql, null);
            break;
    
        
}
?>
<script>
location="PrincipalAdmin.php?CONTENIDOADMIN=Comandas/gasto.php&idcaja=<?=$idcaja?>";
</script>



 