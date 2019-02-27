<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once dirname(__FILE__). '/../../Clases/ConectorBD.php';
require_once dirname(__FILE__). '/../../Clases/Plato.php';

$filtro="";
if (isset($_POST['nombre'])&&$_POST['nombre']!=NULL){
    $nombresmenu=$_POST['nombre'];
    $filtro=" and  concat(nombre,idplato) like'%$nombresmenu%'";  
}
if (isset($_POST['tiempopreparacion'])&&$_POST['tiempopreparacion']!=NULL){
    $tiempopreparacion=$_POST['tiempopreparacion'];
    $filtro=" and  tiempopreparacion like'$tiempopreparacion%'";  
}
if (isset($_POST['valor'])&&$_POST['valor']!=NULL){
    $valor=$_POST['valor'];
    $filtro=" and  valor like'$valor%'";  
}

//buscar por menus
//$cadenasql="select idmenu, nombre from menu";
//$datosmenus= ConectorBD::ejecutarQuery($cadenasql, null);
//$optionmenus="";
//if (count($datosmenus)>0){
//    for ($j = 0; $j < count($datosmenus); $j++) {
//    $optionmenus.="<option value='{$datosmenus[$j][0]}'>{$datosmenus[$j][1]}</option>";
//    
//    }  
//}else{
//$optionmenus="<option>No hay</option>";    
//}



 

$datos= Plato::getDatosObjetos(" tipo='P' $filtro", 'idplato');
$listaplato='';
$numero=1;
if (count($datos)>0){
for ($i = 0; $i < count($datos); $i++) {
    $datoplato= $datos[$i];
    $datosmenusoption[$i][0]=$datoplato->getNombreMenus()->getNombre();

    $listaplato.='<tr>';
    $listaplato.="<td>$numero</td>";
    $listaplato.="<td>{$datoplato->getIdplato()}</td>";
    $listaplato.="<td>{$datoplato->getNombre()}</td>";
    $listaplato.="<td>{$datoplato->getDescripcion()}</td>";
    $listaplato.="<td> $ {$datoplato->getValor()} pesos</td>";
    $listaplato.="<td>{$datoplato->getTiempopreparacion()} Minutos</td>";
   $listaplato.="<td>{$datoplato->getNombreMenus()->getNombre()}</td>";
    $listaplato.="<td><img src='{$datoplato->getFoto()}' width='50' height='50'></td>";
    $listaplato.="<td><a href='PrincipalAdmin.php?CONTENIDOADMIN=Configuracion/Platos/formularioplato.php&idplato={$datoplato->getIdplato()}&foto={$datoplato->getFoto()}&accion=Modificar'><img src='Presentacion/imagenes/Modificar.png' title='Modificar'></a> <img src='Presentacion/imagenes/Eliminar.png' title='Eliminar' onclick='Eliminar(".'"'."{$datoplato->getIdplato()}".'"'.")'></td>";
    $listaplato.='</tr>';
    $numero+=1;
}
}else{
    $listaplato.="<td class='text-primary'>No se encontraron resultado para su criterio de busqueda. </td>";
}


?>
<div class="container-fluid ">
  <div class="offset-8 col-md-4   "style="z-index: 100;  margin: 0% 65%; position: absolute;background: #333333;">              <form method="post" >
                    <table class="table-responsive-lg   table-dark table-hover" >
                       <tr> 
                            <th> <img src="presentacion/imagenes/buscarpequeño.png"></span></th><td><input  class="form-control" type="text"  autofocus name="nombre" placeholder="Nombre Plato o Codigo" ></td>                                               <td><input class="btn btn-primary"type="submit" value="BUSCAR"></td>
                        </tr>
                    </table>
                </form>
        <a style='cursor: pointer;color: white;' onClick="muestra_oculta('contenido1')" title="BUSQUEDA AVANZADA" class="btn-dark offset-5"><img src="presentacion/imagenes/lista.png"width="20" height="15"> Busqueda Avanzada </a>
             <!--busqueda avanzada-->
             <div class="contenido1" id="contenido1">
                <form method="post">
                   <table class="table-hover"style="color:white; ">
                        <tr>
                           <td>
                               <div class="input-group-text"> <span class="input-group-text">Menu</span>
                                   <select class="input-group-text" name="menus">
                                       <?=$optionmenus?>
                                   </select>    
                              </div>
                            </td>
                        </tr>
                        <table>
                </form>
                 <form method="post">
                     <table>
                        <tr>
                            <td>
                               <div class="input-group-text"><span class="input-group-text">Valor</span>
                                   <input type="number" name="valor"class="form-control">
                               </div>
                            </td>
                        </tr>
                      </table>
                 </form>
                 <form method="post">
                     <table>
                        <tr>
                           <td>
                                <div class="input-group-text"><span class="input-group-text">Tiempo Preparacion</span>
                                    <input type="number" name="tiempopreparacion"class="form-control">
                                </div>
                            </td>
                        </tr>
                    </table>
                     <input class="btn btn-primary" type="submit"  value="Buscar">
                </form>
              <br>
             

            </div>
    </div> 
     </div>
      
  


<div class="container-fluid  "><br><br>
    <H2 > PLATOS</H2>

    <div class="container-fluid">
    <table class="table table-responsive-lg  table-hover  small">
        <thead class="table-dark "> 
        <th>Numero</th><th>Codigo</th><th>Nombre</th><th>Descripcion</th><th>Valor</th><th>Tiempo Preparacion</th><th>Menu</th><th>Foto</th>      
     <th><a href="PrincipalAdmin.php?CONTENIDOADMIN=Configuracion/Platos/formularioplato.php&accion=Adicionar"><img src="Presentacion/imagenes/Adicionar.png" title="Adicionar"></a></th>
        </thead>
    <?= $listaplato?>
</table>
   </div>

</div>

<script type="text/javascript">
function Eliminar(id){
    if (confirm("Confirmar Eliminación"+id)) 
        location='PrincipalAdmin.php?CONTENIDOADMIN=Configuracion/Platos/actualizarplato.php&accion=Eliminar&idplato='+id;

}
  function muestra_oculta(id){
     if (document.getElementById){ 
       var el = document.getElementById(id); 
        el.style.display = (el.style.display == 'none') ? 'block' : 'none'; 
     }
        }
        window.onload = function(){
        muestra_oculta('contenido1');
   }

</script>