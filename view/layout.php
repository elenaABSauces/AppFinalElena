<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Aplicacion Final</title>
        <link rel="stylesheet" href="webroot/css/estilo.css">
        <link rel="icon" type="image/x-icon" href="webroot/media/images/favicon.ico">
        <script type="text/javascript" src="webroot/js/scripts.js"></script>

    </head>
    <body>
        <nav class="navInicio">
            <ul class="logoInicio">
                <li id="logo">App Final Elena</li>
            </ul>
            <form class="forNavInicio" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <?php
                if (isset($_SESSION['usuarioDAW216AplicacionFinal'])) {
                    ?>
                    <button class="botonNav" type="submit" name="mtoDepartamentos">Mto Departamentos</button>
                    <button class="botonNav" type="submit" name="editar">Editar Perfil</button>
                    <input class="botonNav" type="submit" value="Detalles" name="detalle" id="detalle">
                    <button class="botonNav" type="submit" name="rest">Rest</button>
                    <button class="botonNav" type="submit"  name="tecnologias">Tecnologías</button>
                    <button class="botonNav" type="submit" name="cerrarSesion">Cerrar Sesion</button>
                    <?php
                } else {
                    ?>
                    <button class="botonNav" type="submit" name="inicioSesion">Iniciar Sesion</button>
                    <?php
                }
                ?>
            </form>
            
        </nav>
        <h2 class="h2"><?php echo $h2?></h2>
        <?php require_once $vistaEnCurso ?>

        <footer>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <table>
                    <tr>
                        <td><a href="https://www.redhat.com/es" target="_blank">Pagina web imitada</a>

                            <img src="webroot/media/images/redhat.png" widht="20" height="20"></td>

                        <td class="derechos"><a href="../../index.html">Elena de Anton &copy; 2020/21</a> 
                        </td>
                        <td><a href="https://github.com/elenaABSauces/AppFinalElena" target="_blank">Github</a>  
                            <img src="webroot/media/images/Github.png" widht="20" height="20"></td>
                        <td>
                        <td><a href="webroot/rss/rss.xml" target="_blank"> <img id="icon-rss" src="webroot/media/images/rss.svg" widht="20" height="20" ></a></td>
                        <td> <a href="docs/cv.pdf" target="_blank">CV</a></td>
                    </tr>
                </table>
            </form>
        </footer>
    </body>
</html>