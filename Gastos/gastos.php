<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div style="width: 400px; z-index: 10000; position: fixed; bottom: 99px">
<center><h1>GASTOS PARA EL DIA <?=$_SESSION['fecha']; ?></h1></center>
<center>
    <form method='post' action='PrincipalAdmin.php?CONTENIDOADMIN=Caja/caja.php'>
    <table>
        <tr>
            <td>
                <label>INGRESE EL VALOR DEL GASTO</label>
            </td>  
            <td>
              <input type='number' value='' name='valor'>
            </td>  
        </tr>
        
        <tr>
            <td>
                <label>INGRESE LA DESCRIPCION DEL GASTO</label>
            </td>  
            <td>
                <textarea  name='descripcion'></textarea>
            </td>  
        </tr>
        <tr>
            <td colspan='2'>
               <center>
                   <input type='hidden' value='<?=$_SESSION['user']?>' name='usuario'>
                   <input type='hidden' value="<?=$_SESSION['fecha']?>" name='fecha'>
                   <input type='submit' value='Abrir' name='accion'>
               </center>
          </td>
        </tr>
    </table>    
</form>
</center>
</div>
