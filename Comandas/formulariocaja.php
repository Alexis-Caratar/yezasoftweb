<?php 
require_once dirname(__FILE__).'/../Clases/ConectorBD.php';
require_once dirname(__FILE__).'/../Clases/caja.php';
print_r($_SESSION['user']); 

 if ($accion=='Modificar'){ $caja=new Caja('idcaja', $idcaja);}
else $caja=new Caja(null, null);



if (isset($base)&&$base!=null){
    if($accion=='Adicionar'){
    $base=$base;
    $cadena="insert into caja (fecha,base,usuariocaja)values(now(),$base,{$_SESSION['user']})";
    ConectorBD::ejecutarQuery($cadena,null);
    
    }elseif($accion=='Modificar'){
        $cadena="update  caja set base=$base where idcaja=$idcaja";
         ConectorBD::ejecutarQuery($cadena,null);
}
header("location:PrincipalAdmin.php?CONTENIDOADMIN=Comandas/caja.php");
}
if($accion=='Eliminar'){
    $cadena="delete from caja  where idcaja=$idcaja";
    print_r($cadena);     
    ConectorBD::ejecutarQuery($cadena,null);
        //header("location:PrincipalAdmin.php?CONTENIDOADMIN=Comandas/caja.php");
}


 ?>
 
<form name="formulario" method="post" >
    
    

<h2>FORMULARIO</h2>
<h2>BASE</h2>
<input type="text" name="base" value="<?=$caja->getBase()?>" autofocus>
<input type="hidden" value="<?=$caja->getIdcaja()?>" name="idcaja">
<input type="submit" value="<?=$accion?>" name="accion">
</form>