<?php 
    if(!isset($_COOKIE['aceptarPolitica'])){
?>
    <div class="ventana-cookie" id="ventana-cookie">
        <div class="content">
            <div class="content-text">Este sitio utiliza cookies para obtener la mejor experiencia en nuestra web.
                <div class="content-buttons">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <input type="submit"id="boton-cerrar" name="aceptar" value="aceptar">
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php 
    }
?>

<main class="mainPrincipal">
    <div class="slideshow-container">
        
        
    </div>
    
    
</main>