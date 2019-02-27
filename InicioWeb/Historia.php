<br><br><br>
<div class="container-fluid" style="font-family: arial;">
    <H3 class="text-center" style="font-weight: bold; font-size: 50px;">HISTORIA RESTAURANTE LA CASITA DEL CUY</H3>
    <br>
    <table style="width: 80%;font-size: 25;" class="table table-hover">
        <tr>
            <td><img  src="Presentacion/imagenes/historia/1historia.png"></td>
            <td>
                La Casita del Cuy nace gracias al empuje y visión de Doña Evila Andrade
                y Don Segundo Bastidas,
                Quienes desde 1983 y tras años de esfuerzo y sacrificio 
                habían logrado sacar adelante el Restaurante El Puente dentro del Mercado Potrerillo 
                logrando distinguirse por la calidad e higiene de sus productos llegando a tener una 
                especial acogida el CUY ASADO, es por esto que en 2005.</td>
        </tr>
        <tr>
            <td colspan="2"><br>
                la familia Bastidas Andrade
                tras encontrar una casa antigua con paredes en adobe y bastante acabada pero con
                bastante potencial deciden emprender un nuevo proyecto, ofrecer el tradicional cuy asado
                de nuestra región sin dejar de lado los servicios de restaurante, para esto don Segundo con
                sus propias manos y habilidades hace los arreglos locativos, las diez mesas en madera e
                incluso las estufas con las
                que empiezan este nuevo camino siendo bien acogidos por la población de la ciudad.
            </td></tr>
        <tr>
            <td colspan="2" >
               <div class="mySlides w3-display-container w3-center">

                                      <img src="Presentacion/imagenes/historia/4historia..png" height="350"width="1100" >
                                        </div>



                                  <div class="mySlides w3-display-container w3-center">

                                      <img src="Presentacion/imagenes/historia/2historia..png"height="350" width="1100">
                                  </div>



                                </UL>
                                        <p>
                                  <div class="mySlides w3-display-container w3-center">
                                      <img src="Presentacion/imagenes/historia/3historia..png"height="350" width="1100" >
                                    </div>

                                  <div class="mySlides w3-display-container w3-center">
                                      <img src="Presentacion/imagenes/historia/1historia.png"height="350" width="1100" >
                                    </div> 
            </td>
        </tr>
        <tr>
            <td>
               Poco a poco va creciendo la clientela y se ve la necesidad de 
               ampliar y hacer uso de otras zonas de aquella casa vieja contando con
               la fortuna de tener clientes fieles y comprensivos que conociendo las
               dificultades y costos que tendría hacer una remodelación 
               apropiada nos acompañaron por años en las viejas instalaciones apenas retocadas.
               <br><br>
               En el año 2015 se inicia la tan esperada remodelación de las instalaciones 
               para dar mayor espacio tanto para los clientes 
               como trabajadores de la Casita del Cuy.
            </td>
            <td>
                <img src="Presentacion/imagenes/historia/5historia..png" height="400" width="400" >
            </td>
        </tr>
        <tr>
            <td colspan="2">
                Finalmente en 2016 abre el nuevo local más moderno 
                dando mayor comodidad a nuestros clientes con la intención de 
                mejorar cada vez más y seguir brindando buenos momentos y la 
                mejor calidad en cada producto, para seguir siendo el lugar preferido 
                de tantas y tantas personas para deleitar su paladar y festejar a los suyos con lo mejor.
            </td>
        </tr>
        <tr>
            <td colspan="2">
        <center>
            <img class="imghistoria" src="Presentacion/imagenes/historia/7historia..png"height="250" width="250" >
            <img class="imghistoria" src="Presentacion/imagenes/historia/8historia..png"height="250" width="250" >
            <img class="imghistoria" src="Presentacion/imagenes/historia/9historia..png"height="250" width="250" >
            <img class="imghistoria" src="Presentacion/imagenes/historia/10historia..png"height="250" width="250" >
        </center>
            </td>
        </tr>
    </table>
    </div>
    <script>
        // Accordion
        function myFunction(id) {
            var x = document.getElementById(id);
            if (x.className.indexOf("w3-show") == -1) {
                x.className += " w3-show";
                x.previousElementSibling.className += " w3-theme-d1";
            } else { 
                x.className = x.className.replace("w3-show", "");
                x.previousElementSibling.className = 
                        x.previousElementSibling.className.replace(" w3-theme-d1", "");
            }
        }
        // Used to toggle the menu on smaller screens when clicking on the menu button
        function openNav() {
            var x = document.getElementById("navDemo");
            if (x.className.indexOf("w3-show") == -1) {
                x.className += " w3-show";
            } else { 
                x.className = x.className.replace(" w3-show", "");
            }
        }
        // Automatic Slideshow - change image every 4 seconds
        var myIndex = 0;
        carousel();
        function carousel() {
            var i;
            var x = document.getElementsByClassName("mySlides");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";  
            }
            myIndex++;
            if (myIndex > x.length) {myIndex = 1}    
            x[myIndex-1].style.display = "block";  
            setTimeout(carousel, 4000);    
        }
            </script>
