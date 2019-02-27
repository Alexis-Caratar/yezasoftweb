<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require_once dirname(__FILE__). '/../../Clases/ConectorBD.php';
require_once dirname(__FILE__). '/../../Clases/Plato.php';

foreach ($_GET as $variable=> $valor) ${$variable}=$valor;

if ($accion=='Modificar') $platos=new Plato('idplato',$idplato);

else  $platos=new Plato(null, null);

?>
<style>
    
    img.verimagenvista{
  position: absolute;
    margin: -30% 690px;
}
input#file{
    background: #00cccc;
    margin: 8px  500px;
    padding: 10px;
}
tr:hover{
    background: #fff;
    margin: 0% 10%;
}
div.container-fluid{
    margin: 2% 10%;
    width: 80%;
}
</style>
<div class="container-fluid card-header " ><br>
    <h2 class="container text-center"><?= strtoupper($accion)?> PLATO</h2><br>

<form name="formularioplato" method="POST" action="PrincipalAdmin.php?CONTENIDOADMIN=Configuracion/Platos/actualizarplato.php" enctype="multipart/form-data">
    <table>
            <tr><th>Menu</th>
            <th>    <select name="menu" class="  "> <?=$platos->getlistamenu($platos->getMenu())?></select>    </th></tr>
        
            <tr><th>Codigo</th><th><input  class="form-control-plaintext " type="number" name="idplato" value="<?=$platos->getIdplato()?>"placeholder="ingrese codigo" required autofocus></th></tr>
        <tr><th>Nombre</th><th><input  class="form-control-plaintext" type="text" name="nombre" value="<?=$platos->getNombre()?>"placeholder="ingrese nombre" required></th></tr>
        <tr><th>Descripcion</th><th><textarea class="form-control-plaintext"  name="descripcion" required placeholder="ingrese una descripcion" ><?=$platos->getDescripcion()?></textarea></th></tr>
        <tr><th>Valor</th><th><input class="form-control-plaintext" type="number" name="valor" value="<?=$platos->getValor()?>"placeholder="ingrese valor" required></th></tr>
        <tr><th>Tiempo Preparacion</th><th><input class="form-control-plaintext"  type="number" name="tiempopreparacion" value="<?=$platos->getTiempopreparacion()?>"placeholder="tiempo " required></th></tr>    
    </table>
    
    <input id="file" type="file" name="foto"  required=""   value="<?=$platos->getFoto()?>"      accept="image/png, .jpg, .jpeg, image/gif" >
       
    <input type="hidden" name="idplatoanterior" value="<?=$platos->getIdplato()?>" >
    <input type="hidden" name="tipo" value="P" >
    <input type="submit"  class="btn btn-primary" name="accion"value="<?=$accion?>">
</form>

</div>
<div class="verimagen">
    <output id="list" > <img class="verimagenvista"    height="250" width="250"    src="<?=$platos->getFoto()?>" ></output>

</div>


<script type="text/javascript">

    
  function archivo(evt) {
                  var files = evt.target.files; // FileList object
             
                  // Obtenemos la imagen del campo "file".
                  for (var i = 0, f; f = files[i]; i++) {
                    //Solo admitimos imágenes.
                    if (!f.type.match('image.*')) {
                        continue;
                    }
             
                    var reader = new FileReader();
             
                    reader.onload = (function(theFile) {
                        return function(e) {
                          // Insertamos la imagen
                         document.getElementById("list").innerHTML = ['<img  class="verimagenvista"    height="250" width="250"  src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
                        };
                    })(f);
             
                    reader.readAsDataURL(f);
                  }
              }
             
              document.getElementById('file').addEventListener('change', archivo, false);
              
              
              //validacion para la foto si esta cargada o no
              var accion="<?=$accion?>";
              $(document).ready(function (){
                  if(accion=="Modificar"){
                      $("#file").attr("required",false)
                  }
              });
              
</script>

    
    