<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once dirname(__FILE__).'/../Clases/ConectorBD.php';

$lista='';
$listaplatos='';
$ventanaModal='';
$cadenaSQL="select*from menu";
$resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);

if (count($resultado)>0) {
    for ($i = 0; $i < count($resultado); $i++) {
        $lista.="<tr>";  
        $lista.="<td style='cursor:pointer;'  onclick='cargarDatos({$resultado[$i]['idmenu']})'>";
        $lista.="{$resultado[$i]['nombre']}</td>";
        $lista.="</tr>";   
    }
            $cadenaSQL="select*from plato where tipo='P'  ";
    $resultadoplatos= ConectorBD::ejecutarQuery($cadenaSQL,null);       
          if (count($resultadoplatos)>0){
        for ($i = 0; $i < count($resultadoplatos); $i++) {
            
            $listaplatos.="<a style='cursor:pointer;' onclick='modal(".'"'."{$resultadoplatos[$i]['idplato']}".'"'.")''>";
            $listaplatos.= "<h2><font face='Arialblack' size='6'>{$resultadoplatos[$i]['nombre']}</font></h2>";
            $listaplatos.= "<li><img  class='img-contenedor' style='border-radius:5000%;' src='{$resultadoplatos[$i]['foto']}' ></li> ";
            $listaplatos.= "<h4>  $ {$resultadoplatos[$i]['valor']}</h4><br>";      
            $listaplatos.="</a>"; 
        }  
        }
    }

?>
<style type="text/css">
  .img-contenedor  {
    -webkit-transition:all .9s ease; /* Safari y Chrome */
    -moz-transition:all .9s ease; /* Firefox */
    -o-transition:all .9s ease; /* IE 9 */
    -ms-transition:all .9s ease; /* Opera */
    width:100%;
}

.img-contenedor:hover  {
    -webkit-transform:scale(1.25);
    -moz-transform:scale(1.25);
    -ms-transform:scale(1.25);
    -o-transform:scale(1.25);
    transform:scale(1.25);
}

.img-contenedor,.img-contenedor2,.img-contenedor3 {/*Ancho y altura son modificables al requerimiento de cada uno*/
    width:250;
    height:250;
    overflow:hidden;
}
ul{
       list-style:none;
       }

       .offset-3{
           margin: -50% 0%;
           
       }
</style>
<link rel="stylesheet" type="text/css" href="Presentacion/css/menu.css">  
<br><br>
<div class="">

    <h2  class="text-center " style="font-weight: bold; font-size: 50px;">MENU  </h2><br>
<div class="row container-fluid  ">
         <div class="col-md-2 form-control  "  >
             
                <table class=" table  ">
                    <thead class="table-dark" >
                      
                        <td><a href="index.php?CONTENIDO=MenuWeb/Menuweb.php"> Menu</a></td> 
                        </thead>
             
                
                        <?=$lista?>
                </table>
        </div>
    <div class="col-md-10">
       
             <ul id="button">
        <div class=" container ">
        <?= $listaplatos?>
            </div
     </ul>
        
    </div>
      
 
    <div class="col_md-2">
     
  
    
    </div>
    </div>
</div>


<div  id="modalInformacionPlato">

    <a href="index.php?CONTENIDO=MenuWeb/Menuweb.php"><button class=" btn btn-primary" id="cerrar"> x</button></a>
    
    <div id="contenidoModalPlato" class="container">
        <h3 class="text-center display-4">Información del plato</h3>
        <img src="foto/cuy.jpg" id="foto" style="width: 50%;  height: 80%; margin: 0px 40px;float: left; ">
            
            <div style=" float: left; width: 40%; margin-left: 10px"><br><br>
                <h3 class="text-primary">Nombre</h3><h4 id="nombre" class="mover">cuy asado</h4>
                <h3 class="text-primary">Detalle</h3><h4 id="detalle" class="mover">cuy asado</h4>
                <h3 class="text-primary">Tiempo de preparación</h3><h4 id="tiempoPreparacion" class="mover">cuy asado</h4>
                <h3 class="text-primary">Valor</h3><h4 id="valor" class="mover">cuy asado</h4>
            </div>
    </div>
</div>





<script type="text/javascript">
    
function cargarDatos(id){
        var cadenaSQL="select*from plato where tipo='P' and menu="+id;
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: "MenuWeb/buscador.php",
            data: {cadenaSQL: cadenaSQL},
            success: function (data) {
                      var lista=""
                                  
                         if(data.length>0){
                        for(var i=0; i<data.length; i++){
                            lista+="<a  style='cursor:pointer;'  onclick='modal("+'"'+data[i].idplato+'"'+") ' > ";
                          lista+= "<h2>"+data[i].nombre+"</h2>";
                          lista+= "<li><img style='border-radius:5000%;' src='"+data[i].foto+"'  width='250' height='250' ></li> ";
                          lista+= "<h4>  $ "+data[i].valor+"</h4><br>";      
                          lista+="</a>"; 
                            
                        }}
                        else
                        lista+="<tr><th>No hay platos en este menu</th></tr>"
                        $('#button').html(lista)
                
                    },error: function (data) {
                        alert("data");
                        
                    }
        });
}



function modal(id){
    $("#modalInformacionPlato").toggle('slow')
    var cadenaSQL="select*from plato where tipo='P' and idplato='"+id+"'";
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: "MenuWeb/buscador.php",
            data: {cadenaSQL: cadenaSQL},
            success: function (data) {
                  $("#foto").attr("src",data[0].foto)
                  $("#nombre").html(data[0].nombre)
                  $("#detalle").html(data[0].descripcion)
                  $("#tiempoPreparacion").html(data[0].tiempopreparacion+" Minutos")
                  $("#valor").html(data[0].valor)
              
                },error: function (data) {
                    alert("data");
                }
        });

}

</script>

