<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once dirname(__FILE__)."/../Clases/ConectorBD.php";
require_once dirname(__FILE__)."/../Clases/Plato.php";
require_once dirname(__FILE__)."/../Clases/Menu.php";
//por el metodo que trae
$idcomanda='';

foreach ($_GET as $variable => $valor) ${$variable}=$valor;
foreach ($_POST as $variable => $valor) ${$variable}=$valor;
?>
<center>
<div>  
    <h2><?=strtoupper($accion)?> PLATO</h2>
    
    <form name="comandaFormulario" method="POST" action="PrincipalAdmin.php?CONTENIDOADMIN=Comandas/comandaPlatoActualizar.php">
       
        <table>
            <tr><th>Menu</th><th><select name="menu" onchange="cargar(this.value)"><?= Menu::listaOpcciones()?> </select></th></tr>
            <tr><th>plato</th><th><select name="plato" onchange=""><option>Lista de platos</option></select></th></tr>
            <tr><th>cantidad</th><th><input type="number" name="cantida" id="cantida" value="" onkeyup="calcularvalor()"></th></tr>
            <tr><th>valor</th><th><input id="valor" type="number" name="val" value="" onkeyup="calcularvalor()"></th></tr>
            <tr><th>subtotal</th><th><lavel id="subtotal" ></lavel></th></tr>
          
        </table>
       
        <input type="hidden" name="idcomanda" value="<?= $idcomanda ?>">
        <input type="submit" name="accion" value="<?= $accion?>">
       
    </form>
</div>
 </center>
<script type="text/javascript">
    <?= Plato::arreglo()?>
        function cargar(valor){
            document.comandaFormulario.plato.length=1;//nombre del formulario y nombre de donde sale el objeto
            for(var i =0; i<plato.length; i++){
                if(value=plato[i][2]==valor){
                    document.comandaFormulario.plato.length++;
                    document.comandaFormulario.plato.options[document.comandaFormulario.plato.length-1].value=plato[i][0];
                    document.comandaFormulario.plato.options[document.comandaFormulario.plato.length-1].text=plato[i][1];                    
                }         
            }
        }
        function calcularvalor(){
            num1=parseFloat(document.getElementById('cantida').value);
            num2=parseFloat(document.getElementById('valor').value);
            total=num1*num2;
            document.getElementById('subtotal').innerHTML=total;
            }
</script>