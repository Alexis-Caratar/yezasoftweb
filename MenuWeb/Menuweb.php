<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once dirname(__FILE__).'/../Clases/ConectorBD.php';

$lista='';
$ventanaModal='';
$menunuevo="";
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
    $menunuevo.=' <div class="container">
                                <div class="row">
                                    <div class="col-12 menu-heading">
                                        <div class="section-heading text-center">
                                            <a href="index.php?CONTENIDO=MenuWeb/Menuweb.php">  <h2>Menu</h2></a>
                                        </div>
                                               </div>
                                </div>
                                <div class="row">
                                  
                               ';
    
          if (count($resultadoplatos)>0){
        for ($i = 0; $i < count($resultadoplatos); $i++) {
             $menunuevo.=' <div class="col-12 col-sm-6 col-md-4">';
             $menunuevo.="<a style='cursor:pointer;' onclick='modal(".'"'."{$resultadoplatos[$i]['idplato']}".'"'.")''>";
            $menunuevo.='<div class="caviar-single-dish wow fadeInUp" data-wow-delay="0.5s">';
             $menunuevo.='<img src="'.$resultadoplatos[$i]['foto'].'" alt="">
                        <div class="dish-info">
                            <h6 class="dish-name">'.$resultadoplatos[$i]['nombre'].'</h6>
                            <p class="dish-price">$'.number_format($resultadoplatos[$i]['valor']).'</p>';
            $menunuevo.= '</div>';
             $menunuevo.='</a>
                    </div>
                </div>'; 
        }
        $menunuevo.=' </div>
                            </div>';
        }
    }

?>
<style>
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
        font-family: team viwer;   
    }
    .mover{
        margin-left: 20px;
    }
   
    #cerrar{
        position: absolute;
       margin: 1.8% 89%;
       font-size: 150%;
    }
    
    
    
</style>
<link href="Presentacion/css/cj/responsive.css" rel="stylesheet" type="text/css"/>
<link href="Presentacion/css/cj/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="Presentacion/css/cj/style.css" rel="stylesheet" type="text/css"/>


<br>
<div class="container-fluid">
   
    <div class="row   ">
         <div class="col-md-2 form-control  "  >
                <table class=" table  ">
                    <thead class="table-dark" >
                        <td><a href="index.php?CONTENIDO=MenuWeb/Menuweb.php"> Menu</a></td> 
                    </thead>
                         <?=$lista?>
                </table>
        </div>
        <div class="col-md-10">
           
            
            <section class="caviar-dish-menu" id="menu" >
                  <?=$menunuevo?>
                     </section>
        </div>
    </div>
</div>



    </label> </div>

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
<script src="../Presentacion/css/cj/active.js" type="text/javascript"></script>
<script src="../Presentacion/css/cj/bootstrap.min.js" type="text/javascript"></script>
<script src="../Presentacion/css/cj/jquery-2.2.4.min.js" type="text/javascript"></script>
<script src="../Presentacion/css/cj/plugins.js" type="text/javascript"></script>
<script src="../Presentacion/css/cj/popper.min.js" type="text/javascript"></script>
<script type="text/javascript">
    
function cargarDatos(id){
        var cadenaSQL="select*from plato where tipo='P' and menu="+id;
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: "MenuWeb/buscador.php",
            data: {cadenaSQL: cadenaSQL},
            success: function (data) {
                      var lista="";
                      lista+="<div class='container'><div class='row'>  <div class='col-12 menu-heading'><div class='section-heading text-center'>       <a href='index.php?CONTENIDO=MenuWeb/Menuweb.php'>  <h2>Menu</h2></a></div></div> </div><div class='row'>";
                         if(data.length>0){
                        for(var i=0; i<data.length; i++){  
                            lista+="<div class='col-12 col-sm-6 col-md-4'>";
                            lista+="<a style='cursor:pointer;' onclick='modal("+'"'+data[i].idplato+'"'+") ' > ";
                            lista+="<div class='caviar-single-dish wow fadeInUp' data-wow-delay='0.5s'>";
                            lista+="<img src='"+data[i].foto+"' alt=''>";
                            lista+="<div class='dish-info'>";
                            lista+="<h6 class='dish-name'>"+data[i].nombre+"</h6>";
                            lista+="<p class='dish-price'>$" +data[i].valor+  "</p>";
                            lista+= "</div>";
                            lista+="</a>";
                            lista+= "</div>";
                            lista+= "</div>";
                            lista+= "</div>";
                              
                        }}
                        else
                        lista+="<tr><th>No hay platos en este menu</th></tr>"
                        $('#menu').html(lista)
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

