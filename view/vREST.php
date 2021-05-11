<main class="mainRest">
    <div id="inicio">
        <h1>Rest</h1>
           <div id="formulario-rest">
                    <h2>APOD: Astronomy Picture of the Day</h2>
              
                <div id="inasa">
                    <form name="nasa" id="nasa" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                        <p>
                            <label for="fecha">Elige una fecha para ver la imagen:</label>
                            <input id="fecha" type="date" name="fecha" max="<?php echo date('Y-m-d') ?>" value="<?php echo date('Y-m-d') ?>">
                        </p>
                        <div class="botones">
                            <input type="submit" value="Buscar" name="enviar">
                        </div>
                    </form>
                    
                    <h3><?php echo $aServicioAPOD['title'] ?></h3>
                    <img src="<?php echo $aServicioAPOD['url'] ?>" widht="500" height="300"/>
                    <p><?php echo $aServicioAPOD['explanation'] ?></p>
                    <a href="https://github.com/nasa/apod-api" target="_blank">Documentacion del servicio Imagen Nasa</a>
                </div>
                    <div id="elefante">
                        <form name="elefante" id="elefante" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                            <label for="sexo">Seleciona un sexo: </label>
                            <select id="sexo" name="sexo">
                              <option value="female">Femenino</option>
                              <option value="male">Masculino</option>
                            </select>
                            <div class="botones">
                                <input type="submit" value="Mostrar Elefante" name="enviar">
                            </div>
                        </form><!-- -->
                        <div>
                            <img src="<?php echo $aElefante["image"]?>" widht="500" height="300"/>
                            <p>Nombre: <?php echo $aElefante["name"]?></p>
                            <p>Fecha Nacimiento: <?php echo $aElefante["dob"]?></p>
                            <p>Especie: <?php echo $aElefante["species"]?></p>
                            <p><a href="<?php echo $aElefante["wikilink"]?>" target="_blank">Link con más informacion:</a><p>
                            <p>Información: <?php echo $aElefante["note"]?></p><!-- comment --><!-- comment -->
                        </div>
                        <a href="https://elephant-api.herokuapp.com/" target="_blank">Documentación del servicio Elefante</a>
                    </div>
        
        
        <br>
        <form class="forNavInicio" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <input class="boton" type="submit" value="volver" name="volver">
        </form>
    </div>
</main>