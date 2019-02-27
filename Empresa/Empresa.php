<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require_once dirname(__FILE__). '/../Clases/ConectorBD.php';
require_once dirname(__FILE__). '/../Clases/Empresa.php';

foreach ($_GET as $variable=> $valor) ${$variable}=$valor;

$cadenaSQL="select nit from empresa";
$nit= ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
if ($accion=='Modificar') $reserva=new Empresa('nit',$nit);
else  $reserva=new Empresa(null, null);
$usuario = $_SESSION['user'];
?>


<div class="container-fluid">
        <br>
        <h2  > DATOS DE EMPRESA </h2><br>
        <div class="row">
               <div class="col-lg-5">
                   <form name="formularioevento" method="POST" action="PrincipalAdmin.php?CONTENIDOADMIN=Empresa/actualizarEmpresa.php" enctype="multipart/form-data">
                             <table class="table table-hover table-responsive-lg">
                            <tr><th>Nit</th><th><input class="form-control"type="text" name="nit" value="<?=$reserva->getNit()?>"required></th></tr>
                            <tr><th>Nombre</th><th><input class="form-control"type="text" name="nombre" value="<?=$reserva->getNombre()?>"required></th></tr>
                            <tr><th>Administrador</th><th><input class="form-control"type="text" name="administrador" value="<?=$reserva->getAdministrador()?>"required></th></tr>
                            <tr><th>Direccion</th><th><input class="form-control"type="text" name="direccion" value="<?=$reserva->getDireccion()?>"required></th></tr>
                            <tr><th>Barrio</th><th><input class="form-control"type="text" name="barrio" value="<?=$reserva->getBarrio()?>"required></th></tr>
                            <tr><th>Ciudad</th><th><input class="form-control"type="text" name="ciudad" value="<?=$reserva->getCiudad()?>"required></th></tr>
                            <tr><th>Telefono</th><th><input class="form-control"type="text" name="telefono" value="<?=$reserva->getTelefono()?>"required></th></tr>
                            <tr><th>Celular</th><th><input class="form-control" type="text" name="celular" value="<?=$reserva->getCelular()?>"required></th></tr>
                            <tr><th>Email</th><th><input class="form-control" type="text" name="redessociales" value="<?=$reserva->getRedessociales()?>"required></th></tr>

                        </table>
                    <br>
             </div>
             <div class="col-lg-5">
                            <table class="table table-hover table-responsive-lg">
                                    <tr><th>Foto</th><th><input class="form-control"   id="file" type="file"  name="foto" onchange="vistaprevia()" value="<?=$reserva->getFoto()?>"placeholder="ingrese Foto" accept="image/png, .jpg, .ico, .jpeg,.jfif, image/gif" >
                                        <div id="verimagen">
                                        <output id="list" > <img class="verimagenvista" src="<?=$reserva->getFoto()?>" width="300"height="300" style="border-radius: 40px;margin-top: 10"></output>
                                        </div></th>
                                    </tr>
                             </table>
                            <br><br><br>
                        <input type="submit" class="btn btn-primary" name="accion"value="ACTUALIZAR DATOS" id="accion">
                        <input type="hidden"  name="nit"value="<?=$reserva->getNit()?>">

              </div>
            </form>
        </div>
        <a href="PrincipalAdmin.php?CONTENIDOADMIN=Empresa/cambioclaveadmin.php"><button class="btn btn-primary">CAMBIAR CLAVE</button></a>



  
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
                         document.getElementById("list").innerHTML = ['<img   class="verimagenvista"  id="foto" height="300" width="300" style="border-radius: 40px;margin-top: 10"  src="', e.target.result,'" title="', escape(theFile.name),'"/>'].join('');
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