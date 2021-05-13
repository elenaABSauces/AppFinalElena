<main class="mainRest">
    <div id="inicio">
        <h1>Rest</h1>
           <div id="formulario-rest">
                <div id="inasa">
                    <p>APOD: Astronomy Picture of the Day</p>
                    <form name="nasa" id="nasa" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                        <p>
                            <label for="fecha">Elige una fecha para ver la imagen:</label>
                            <input id="fecha" type="date" name="fecha" max="<?php echo date('Y-m-d') ?>" value="<?php echo date('Y-m-d') ?>">
                        </p>
                        <div class="botones">
                            <input type="submit" value="Buscar" name="enviar">
                        </div>
                    </form>
                    <?php
                            if(isset($aServicioAPOD["correcto"])){
                                
                                ?>
                    <p><?php echo $aServicioAPOD["correcto"]['title'] ?></p>
                    <img src="<?php echo $aServicioAPOD["correcto"]['url'] ?>" widht="500" height="300"/>
                    <p><?php echo $aServicioAPOD["correcto"]['explanation'] ?></p>
                    <?php
                            }else{
                                ?>
                            <p>Error: <?php $aServicioAPOD["incorrecto"]?></p>
                            <?php
                            }
                                ?>
                    <a href="https://github.com/nasa/apod-api" target="_blank">Documentacion del servicio Imagen Nasa</a>
                </div>
                    <br>
                    <br>
                    <div id="elefante">
                        <p>Descubre los Elefantes</p>
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
                            <?php
                            if(isset($aElefante["correcto"])){
                                
                                ?>
                            <img src="<?php echo $aElefante["correcto"]["image"]?>" widht="500" height="300"/>
                            <p>Nombre: <?php echo $aElefante["correcto"]["name"]?></p>
                            <p>Fecha Nacimiento: <?php echo $aElefante["correcto"]["dob"]?></p>
                            <p>Especie: <?php echo $aElefante["correcto"]["species"]?></p>
                            <p><a href="<?php echo $aElefante["correcto"]["wikilink"]?>" target="_blank">Link con más informacion:</a><p>
                            <p>Información: <?php echo $aElefante["correcto"]["note"]?></p><!-- comment --><!-- comment -->
                            <?php
                            }else{
                                ?>
                            <p>Error: <?php $aElefante["incorrecto"]?></p>
                            <?php
                            }
                                ?>
                            
                        </div>
                        <a href="https://elephant-api.herokuapp.com/" target="_blank">Documentación del servicio Elefante</a>
                    </div>
        
        
        <br>
        <form class="forNavInicio" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <input class="boton" type="submit" value="volver" name="volver">
        </form>
    </div>
</main>