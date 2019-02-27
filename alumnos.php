<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once dirname(__FILE__).'/Clases/conectorBD.php';
require_once dirname(__FILE__).'/Clases/Alumnos.php';

function getdatos(){
    $datos= Alumnos::getdatosenobjetos();
    $lista='';
    for ($i = 0; $i < count($datos); $i++) {
            $alumnosbagos= $datos[$i]; 
            $axiliar='';
            $genero='';
            if ($alumnosbagos->getActivo()=='1') {
                $axiliar='Activo';
            } else {
                $axiliar='inactivo';
            }
            if ($alumnosbagos->getSexo()=='M') {
                $genero='Masculino';
            }else{
                $genero='Femenino';
            }
        $lista.='<tr> ';
        $lista.="<td>{$alumnosbagos->getCodigo()} </td>"; 
        $lista.="<td>{$alumnosbagos->getNombres()} </td>"; 
        $lista.="<td>{$alumnosbagos->getApellidos()} </td>"; 
        $lista.="<td>{$alumnosbagos->getFechanacimiento()} </td>"; 
        $lista.="<td>{$genero} </td>"; 
        $lista.="<td>{$alumnosbagos->getEmail()} </td>"; 
        $lista.="<td>{$axiliar} </td>"; 
        $lista.="<td><button onclick='cargarDatos({$alumnosbagos->getCodigo()})' class='btn btn-link' >Modificar</button> <button onclick='eliminar({$alumnosbagos->getCodigo()})' class='btn btn-link'>Eliminar</button></td>"; 
        $lista.="</tr> ";   
    }
    return $lista;
}

?>



<div class="container">
    <h3 class="text-center display-4">LISTADO DE LOS ALUMNOS</h3>
    <table class="table" id="tablausuarios">
        <thead class="thead-dark">
            <tr>
            <th>CODIGO</th>
            <th>NOMBRES</th>
            <th>APELLIDOS</th>
            <th>FECHA DE NACIMIENTO</th>
            <th>SEXO</th>
            <th>EMAIL</th>
            <th>ACTIVO</th>
            <th><button onclick="adicionar()">ADICIONAR</button></th>
        </tr>
        </thead>
        <?= getdatos() ?>


    </table>
</div>

<div  id="ventanaModal">
    <img src="imagenes/letter-x.png" style="float: right" id="btnCerrar" >
    <div id="contenidoModal" class="container">
        
        <h3 id="textoAccion" class="text-center display-5">Ni mierda</h3>
        
        <form class="form">
            <div class="form-group">
                <label for="codigo">Codigo</label>
                <input id="codigo" type="number" name="codigo" class="form-control" disabled="">
            </div>
            <div class="form-group">
                <label for="nombres">Nombres</label>
                <input id="nombres" type="text" name="nombres" class="form-control">
            </div>
            <div class="form-group">
                <label for="apellidos">Apellidos</label>
                <input id="apellidos" type="text" name="apellidos" class="form-control">
            </div>
            <div class="form-group">
                <label for="fechaNacimiento">Fecha Nacimiento</label>
                <input id="fechaNacimiento" type="text" name="fechaNacimiento" class="form-control">
            </div>
            <div class="form-group">
                <label for="sexo">Sexo</label>
                <input id="sexo" type="text" name="sexo" class="form-control">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="activo">Activo</label>
                <input id="activo" type="text" name="activo" class="form-control">
            </div>
            
        </form>
        <div class="form-group">
            <input type="submit" value="Guardar" id="btnAccion" class="btn btn-primary">
        </div>
    </div>
    
</div>

<script type="text/javascript">
    $('#btnCerrar').click(function (){
        $('#ventanaModal').slideUp();
    });
    
    function cargarDatos(codigo){
        $('#textoAccion').html("MODIFICAR USUARIO");
        $('#btnAccion').val("Modificar");
        var cadenaSQL="select*from alumnos where codigo="+codigo;
        $.ajax({
            type: 'POST',
            data: {accion: "consultar",cadenaSQL: cadenaSQL},
            url: "consulta.php",
            success: function (data) {
              dataType: 'json',
              console.log(data)
                limpiar();
                $('#ventanaModal').slideDown();
                $('#codigo').val(data[0].codigo);
                $('#nombres').val(data[0].nombres);
                $('#apellidos').val(data[0].apellidos);
                $('#fechaNacimiento').val(data[0]. fechanacimiento);
                $('#sexo').val(data[0].sexo);
                $('#email').val(data[0].email);
                $('#activo').val(data[0].activo);
            },error: function () {
                alert("error")  
            }
            
            
        })
    }
    
    
    
    
    function adicionar(){
        limpiar();
        $('#textoAccion').html("ADICIONAR USUARIO");
        $('#btnAccion').val("Adicionar");
        $('#ventanaModal').slideDown();
    }
    
    
    
    function limpiar(){
        $('#codigo').val("");
        $('#nombres').val("");
        $('#apellidos').val("");
        $('#fechaNacimiento').val("");
        $('#sexo').val("");
        $('#email').val("");
        $('#activo').val("");
    }
    
    
    //detectar el click en el boton de accion modificar o adicionar...... acordaraste
    
    $('#btnAccion').click(function (){
        if($('#btnAccion').val()=="Modificar"){
            modificarInformacion();
        }else{
            adicionarInformacion();
        }
    })
    
    function  modificarInformacion(){
       
        var cadenaSQL="update alumnos set nombres='"+$('#nombres').val()+"', "+
                "apellidos='"+$('#apellidos').val()+"', fechanacimiento='"+$('#fechaNacimiento').val()+"', "+
                "sexo='"+$('#sexo').val()+"', email='"+$('#email').val()+"', activo='"+$('#activo').val()+"' "+
                "where codigo="+$('#codigo').val();
        
        $.ajax({
            type: 'POST',
            data: {accion: "modificar",cadenaSQL: cadenaSQL},
            url: "consulta.php",
            success: function (data) {
                $('#ventanaModal').slideUp();
                recargarTabla();  
            },error: function () {
                
            } 
        })
    }
    
    function adicionarInformacion(){
        var cadenaSQL="insert into alumnos (nombres,apellidos,fechanacimiento,sexo,email,activo) values"+
                "('"+$('#nombres').val()+"','"+$('#apellidos').val()+"','"+$('#fechaNacimiento').val()+"',"+
                "'"+$('#sexo').val()+"','"+$('#email').val()+"','"+$('#activo').val()+"')";
        alert(cadenaSQL)
        $.ajax({
            type: 'POST',
            data: {accion: "query",cadenaSQL: cadenaSQL},
            url: "consulta.php",
            success: function (data) {
                $('#ventanaModal').slideUp();        
                recargarTabla();  
                
                
            },error: function () {
                alert("hola")
            } 
        })
    }
    
    function eliminar(id){
        var cadenaSQL="delete from alumnos where codigo="+id;
           $.ajax({
            type: 'POST',
            data: {accion: "query",cadenaSQL: cadenaSQL},
            url: "consulta.php",
            success: function (data) {
                recargarTabla();  
                
                
            },error: function () {
                alert("hola")
            } 
        })
        
        
    }
    
    
    function recargarTabla(){
        $.ajax({
            type: 'POST',
            data: {accion: "obtenerTabla"},
            url: "consulta.php",
            success: function (data) {
                $('#tablausuarios').html(data);
            },error: function () {
                
            } 
        })
    }
    
    
</script>

<style>
    #ventanaModal{
        position: fixed;
        top: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,.8);
        display: none;
    }
    #contenidoModal{
        width: 80%;
        background: white;
        margin-top: 10px;
        border-radius: 5px;
        max-height: 90%;
        overflow: hidden;
        overflow-y: auto;
    }
    
</style>