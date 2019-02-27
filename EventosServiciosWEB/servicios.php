<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require_once dirname(__FILE__).'/../Clases/ConectorBD.php';
foreach ($_GET as $variable=> $valor) ${$variable}=$valor;

$lista='';
$cadenaSQL="select * from plato where tipo='S'";
$resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
if (count($resultado)>0) {
    for ($i = 0; $i < count($resultado); $i++) {
        
        $lista.="<a onClick=cargarDatos($i)>";
        $lista.="<h2>{$resultado[$i]['nombre']}</td>"; 
        $lista.="<li><img class='img-contenedor'  style='border-radius:5000%;'src='{$resultado[$i]['foto']} 'width='200' height='200'></li>";  
        $lista.="<h4> Valor: $ {$resultado[$i]['valor']}</h4>";
        $lista.="</a>";
    }
}

?>

<style>
.container-fluid ul li{
	text-decoration: none;
	
}
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
 
#button a {
 display: inline-block;
 width: 20%;


}
 #button  a  li{
 font-family: Arial;
 font-size: 11px;
 text-decoration: none;
 padding: 10px;
 

 }
    
    #modalInformacionPlato{
        z-index: 1000000;
        background: rgba(0,0,0,.5);
        top: 0;
        width: 100%;
        height: 100%;
        left: 0;
        position: fixed;
        display: none;
    }
    
    #contenidoModalPlato{
        background: #fff;
        margin: auto;
        margin-top: 20px;
        height: 95%;
    }
    
    .mover{
        margin-left: 20px;
    }
    
    #atras{
        margin-top: 20%;
        float: left;
  
    }
    
    #siguiente{
        margin-top: 20%;
         float: right
        
    }
    #cerrar{
        position: absolute;
       margin: 1.8% 88%;
    }
  
ul{
       list-style:none;
       }
    
</style><br><br>
<div class="btn-danger">
<div class="container"><br><br>
    <h2 class="text-center "style="font-weight: bold;font-size: 50px;">SERVICIOS</h2><br><hr>   
</div>
<div  class="container-fluid">
    <ul id="button">
        <?= $lista?>
     </ul>       
    </div>
</div>


<div  id="modalInformacionPlato">

    <a href="index.php?CONTENIDO=EventosServiciosWEB/servicios.php"><button  class="btn btn-primary" id="cerrar"> x</button></a>
    
    <div id="contenidoModalPlato" class="container">
        <h3 class="text-center display-4">Informacion del Servicio</h3>
        <img src="foto/cuy.jpg" id="foto" style="width: 50%;  height: 80%; margin: 0px 40px;float: left; ">
            
            <div style=" float: left; width: 40%; margin-left: 10px">
                <h3 class="text-primary">Nombre</h3><h4 id="nombre" class="mover">cuy asado</h4>
                <h3 class="text-primary">Detalle</h3><h4 id="detalle" class="mover">cuy asado</h4>
                <h3 class="text-primary">Valor</h3><h4 id="valor" class="mover">12500</h4>
            </div>
    </div>
</div>



<script>
function  cargarDatos(id){
     $("#modalInformacionPlato").toggle('slow')
    var cadenaSQL="SELECT * FROM plato where tipo='S'" ;
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: "MenuWeb/buscador.php",
            data: {cadenaSQL: cadenaSQL},
            success: function (data) {
                  $("#foto").attr("src",data[id].foto)
                  $("#nombre").html(data[id].nombre)
                  $("#detalle").html(data[id].descripcion)
                  $("#valor").html(data[id].valor)
            
              
                },error: function (data) {
                    alert("data");
                }
        });

    
    
}
</script>
    