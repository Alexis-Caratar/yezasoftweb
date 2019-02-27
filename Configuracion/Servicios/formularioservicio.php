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
    margin: 4%  500px;
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
input.btn-primary{
position: absolute;
    margin: -10% 5%;
}
</style>


<div class="container-fluid card-header">
    <h2><?= strtoupper($accion)?> SERVICIO</h2><br>

<form name="formularioplato" method="POST" action="PrincipalAdmin.php?CONTENIDOADMIN=Configuracion/Servicios/actualizarservicio.php&idplato=<?=$platos->getIdplato()?>" enctype="multipart/form-data">
    <table>
        <tr><th>Nombre</th><th><input class="form-control-plaintext" type="text" name="nombre" value="<?=$platos->getNombre()?>"placeholder="ingrese nombre" required></th></tr>
        <tr><th>Descripcion</th><th><textarea class="form-control-plaintext" name="descripcion" required placeholder="ingrese una descripcion" ><?=$platos->getDescripcion()?></textarea></th></tr>
        <tr><th>Valor</th><th><input class="form-control-plaintext" type="number" name="valor" value="<?=$platos->getValor()?>"placeholder="ingrese valor" required></th></tr>
    </table>
    
    <input id="file" type="file" name="foto" onchange="vistaprevia()" value="<?=$platos->getFoto()?>"placeholder="ingrese Foto"  required=""accept="image/png, .jpg, .jpeg, image/gif" >

    <input type="hidden" name="tipo" value="S" >
    <input type="hidden"  name="idplato"value="<?=$platos->getIdplato()?>">
      <input class="btn btn-primary" type="submit"  name="accion"value="<?=$accion?>">
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
              })
</script>

    
    