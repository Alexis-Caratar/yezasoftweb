/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function cargarDatosTabla(nombre, vrUnitario) {

    var estadoAdicionPlato = true //Estado que nos inidica cuando debemos agreagar un nuevo plato
    var datosNuevos="" //Inicializamos una variable donde vamos a contener los nuevos datos
    var datosCajaAntiguos = document.getElementById("datosAntiguos") //relacionamos la variable datosCajaAntiguos para acceder a sus atributos
    var cadenaDatosAntiguos = datosCajaAntiguos.value //Optenemos la cadena del hiiden que guarda los datos antiguos 
    var ArrayDatosAntiguos = cadenaDatosAntiguos.split("||")//Cortamos la cadenaDetasAntiguos en el delimintador ||
    datosCajaAntiguos.value = ""//Reciniciamos los datos del hiden que contendra los datos nuevos
    if (cadenaDatosAntiguos.length > 0) {//Verificamos que la cadena no este vacia
        for (var i = 0; i < ArrayDatosAntiguos.length; i++) {//Iniciomos rrecorriendo todos los datos generados a partir de la cadenaDatosAntiguos
            var datosPlato = ArrayDatosAntiguos[i].split("|")//Cortamos la cadena  para obetener los datos del plato
            if (datosCajaAntiguos.value.length > 0) {//volbemos a verificar que el hiden este vacion 
                datosCajaAntiguos.value += "||"//Agregamos un delimintador para agregar nuevos datos de un plato
            }
            
            if (datosPlato[0] == nombre) {//Verificamos si lo encontro
                estadoAdicionPlato = false //Cambiamos el estado
                //datosPlato = ArrayDatosAntiguos[indiceBusqueda].split("|")//apuntasmo al item encontrado
                var cantidad = parseInt(datosPlato[2]) + 1//Incrementamos la cantidad
                var subTotalPlato = parseInt(datosPlato[1]) * cantidad//Calculamos el subtotal
                datosNuevos += "<tr><td>" + datosPlato[0] + "</td><td>" + datosPlato[1] + "</td><td>" + cantidad + "</td><td>" + subTotalPlato + "</td></tr>"//Aumentamos la fila midificada.
                datosCajaAntiguos.value += datosPlato[0] + '|' + datosPlato[1] + '|' + cantidad//Adicionamos el plato al hidden
            } else {
                var subTotalPlato = parseInt(datosPlato[1]) * parseInt(datosPlato[2])//Calculamos el subtatal
                datosNuevos += "<tr><td>" + datosPlato[0] + "</td><td>" + datosPlato[1] + "</td><td>" + datosPlato[2] + "</td><td>" + subTotalPlato + "</td></tr>"//Agregamos el plato
                datosCajaAntiguos.value += datosPlato[0] + '|' + datosPlato[1] + '|' + datosPlato[2]//Adicionamos el plato al hidden
            }
        }
    } else {//Adicionamos el primer plato
        datosNuevos = "<tr><td>" + nombre + "</td><td>" + vrUnitario + "</td><td>1</td><td>" + vrUnitario + "</td></tr>"
        datosCajaAntiguos.value = nombre + '|' + vrUnitario + '|1'
        estadoAdicionPlato = false
    }

    if (estadoAdicionPlato) {//Si el estado es true podemos adicionar el nuevo plato
        datosCajaAntiguos.value += "||"//Agregamos un delimintador para agregar nuevos datos de un plato
        datosNuevos += "<tr><td>" + nombre + "</td><td>" + vrUnitario + "</td><td>1</td><td>" + vrUnitario + "</td></tr>"
        datosCajaAntiguos.value += nombre + '|' + vrUnitario + '|1'
    }

    document.getElementById('nuevosDatos').innerHTML = "<table class='table'><tr style='background-color: #49b795'><th colspan='4'><center>PLATOS</center></th></tr><tr><th>Nombre</th><th>Vr Unitario</th><th>Cantidad</th><th>Sub</th></tr><tr>" + datosNuevos + "<tr><th colspan='3'></th><th><a href=''><button class='btn btn-primary'>Enviar</button></a></th></tr></table>"//Cargamos las platos
}