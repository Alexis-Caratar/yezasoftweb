<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once dirname(__FILE__) . '/../Clases/conectorBD.php';

$lista = '';
$listaplatos = '';
$ventanaModal = '';
$cadenaSQL = "select*from menu";
$resultado = ConectorBD::ejecutarQuery($cadenaSQL, null);

if (count($resultado) > 0) {
    for ($i = 0; $i < count($resultado); $i++) {
        $lista .= "<tr>";
        $lista .= "<td onclick='cargarDatos({$resultado[$i]['idmenu']})'>";
        $lista .= "{$resultado[$i]['nombre']}</td>";
        $lista .= "</tr>";
    }


    $listaplatos .= " <thead class='table-dark'><th>Nombres</th><th>Detalles</th><th >Tiempo Preparacion</th><th>Valor</th></thead> ";
    $cadenaSQL = "select*from plato where tipo='P'  ";
    $resultadoplatos = ConectorBD::ejecutarQuery($cadenaSQL, null);
    if (count($resultadoplatos) > 0) {
        for ($i = 0; $i < count($resultadoplatos); $i++) {



            $listaplatos .= "<tr>";
            $listaplatos .= "<td><h4 id = 'nombre_$i'>{$resultadoplatos[$i]['nombre']}</h4><br>";
            $listaplatos .= "<img  src='{$resultadoplatos[$i]['foto']}' width='80' height='80' onclick='modal(" . '"' . "{$resultadoplatos[$i]['idplato']}" . '"' . ")''>";
            $listaplatos .= "</td>";
            $listaplatos .= "<td>";
            $listaplatos .= $resultadoplatos[$i]['descripcion'] . "Minutos";
            $listaplatos .= "</td>";
            $listaplatos .= "<td>";
            $listaplatos .= $resultadoplatos[$i]['tiempopreparacion'] . " Minutos";
            $listaplatos .= "</td>";
            $listaplatos .= "<td>";
            $listaplatos .= "$<span id = 'vrUnitario_$i'>" . $resultadoplatos[$i]['valor'] . '</span>';
            $listaplatos .= "<br><input type='button' class='btn btn-primary' value='agregar' onclick = 'cargarDatosTabla(" . '"' . "{$resultadoplatos[$i]['nombre']}" . '"' . ", " . '"' . "{$resultadoplatos[$i]['valor']}" . '"' . ")'>";
            $listaplatos .= "</td>";
            $listaplatos .= "</tr>";
        }
    }
}
?>

<script src="lib/funcionesJS.js" type="text/javascript"></script>
<style>
    .sinpadding [class*="col-"] {
    padding: 0;
}
</style>

<br><br>
<div class="container-fluid sinpadding">
<h2  class="text-center " style="font-weight: bold; font-size: 50px;">MENU  </h2><br>
<div class=" row">
    <div class="col-2" style="max-height: 500px; min-width: 200px; overflow: auto; overflow-y: auto;position: absolute ;">

        <table class=" table">
            <thead class="table-dark" >
            <td><a href="index.php?CONTENIDO=DomiciliosWeb/Domicilios.php"> Menu</a></td> 
            </thead>
            <?= $lista ?>
        </table>
    </div>
   
    <div class=" col-md-7 offset-2 " >
        <table  class=" table  " id="tablita" >
            <?= $listaplatos ?>
        </table>
 </div>
    <div class="col-md-3 " >
        <!-- Inicio tabla de presentación de platos -->
        <form action="index.php?CONTENIDO=DomiciliosWeb/confirmarDomicilio.php&accion=Adicionar" method="post">
            <input type="hidden" name="datosPlatosTabla" id="datosAntiguos">
            <div id="nuevosDatos"  >
                
                <table class=" table" >
                    </tr>
                    <tr>
                        <th>Nombre</th><th>Valor</th><th>Cantidad</th><th>SubT</th>
                    </tr>

                    <tr>
                        
                        <th colspan="3"></th><th><input type="submit" class="btn btn-primary" value="enviar"></th>
                    </tr>
                </table>
                
            </div>
        </form>
        </div>
    </div>
   </div>     
        
        




<div  id="modalInformacionPlato">
    <a href="index.php?CONTENIDO=DomiciliosWeb/Domicilios.php"><button class="btn btn-primary" id="cerrar"> x</button></a>

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

    function cargarDatos(id) {
        var cadenaSQL = "select*from plato where tipo='P' and menu=" + id;
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: "MenuWeb/buscador.php",
            data: {cadenaSQL: cadenaSQL},
            success: function (data) {
                var lista = ""
                var numero = 003;
                lista += "<thead class='table-dark'> <tr><th>Nombres</th><th>Detalles</th><th >Tiempo Preparacion</th><th>Valor</th></thead>"
                if (data.length > 0) {
                    for (var i = 0; i < data.length; i++) {
                        lista += "<tr onclick='modal(" + '"' + data[i].idplato + '"' + ") ' > ";
                        lista += "<td><h4>" + data[i].nombre + "</h4><br>";
                        lista += "<img  id='verfoto' src='" + data[i].foto + "' width='80' height='80' ></td>"
                        lista += "<td>" + data[i].descripcion + "</td>"
                        lista += "<td>" + data[i].tiempopreparacion + " Minutos</td>"
                        lista += "<td> $" + data[i].valor + "</td>"
                        lista += "</tr>"
                        numero += numero;
                    }
                } else
                    lista += "<tr><th>No hay platos en este menu</th></tr>"
                $('#tablita').html(lista)

            }, error: function (data) {
                alert("data");

            }
        });
    }



    function modal(id) {
        $("#modalInformacionPlato").toggle('slow')
        var cadenaSQL = "select*from plato where tipo='P' and idplato='" + id + "'";
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: "MenuWeb/buscador.php",
            data: {cadenaSQL: cadenaSQL},
            success: function (data) {
                $("#foto").attr("src", data[0].foto)
                $("#nombre").html(data[0].nombre)
                $("#detalle").html(data[0].descripcion)
                $("#tiempoPreparacion").html(data[0].tiempopreparacion + " Minutos")
                $("#valor").html(data[0].valor)

            }, error: function (data) {
                alert("data");
            }
        });

    }

</script>