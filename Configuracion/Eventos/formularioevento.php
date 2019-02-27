<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require_once dirname(__FILE__). '/../../Clases/ConectorBD.php';
require_once dirname(__FILE__). '/../../Clases/Evento.php';

foreach ($_GET as $variable=> $valor) ${$variable}=$valor;

if ($accion=='Modificar') $cargo=new Evento('idevento',$idevento);
else  $cargo=new Evento(null, null);


?>
<style>
    
    tr:hover{
        background: white;
    }
    
    img.verimagenvista{
  position: absolute;
    margin: -27% 520px;
}
input#file{
    background: #00cccc;
    margin: 5%  500px;
    padding: 10px;
}

div.container-fluid{
    margin: 2% 10%;
    width: 80%;
}
input.btn-primary{
    margin: -8% 20%;
}

textArea:hover{
    background: white;
}
</style>

<div class="container-fluid " >

    <h2 class="text-center"><?= strtoupper($accion)?> EVENTO </h2>
<form name="formularioevento" method="POST" action="PrincipalAdmin.php?CONTENIDOADMIN=Configuracion/Eventos/actualizarevento.php" enctype="multipart/form-data">
    <br>
    <table class="card-header">
        <tr><th>Nombre</th><th><input class="form-control-plaintext" type="text" name="nombre"  autofocus value="<?=$cargo->getNombre()?>"placeholder="ingrese nombre" required maxlength="50" width="50%"></th></tr>
             <tr><th>Descripcion</th></tr>
    
             </table>
    <textarea  name="descripcion" rows="6"  cols="30"   placeholder="ingrese una descripcion" required    ><?=$cargo->getDescripcion() ?> </textarea>
                  
    
    
         <input  id="file" type="file" name="foto" onchange="vistaprevia()" value="<?=$cargo->getFoto()?>"placeholder="ingrese Foto" accept="image/png,.jpg,.JPG, .ico, .jpeg,.jfif, image/gif" >

        <div id="verimagen">
            <output id="list" > <img class="verimagenvista" src="<?=$cargo->getFoto()?>" width="250"height="250"></output>
        </div>
 
    <input type="hidden"  name="idevento"value="<?=$cargo->getIdevento()?>">
    <input type="submit" class="btn btn-primary"  name="accion"value="<?=$accion?>" id="accion">
</form>

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
                         document.getElementById("list").innerHTML = ['<img   class="verimagenvista"  id="foto" height="250" width="250"   src="', e.target.result,'" title="', escape(theFile.name),'"/>'].join('');
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