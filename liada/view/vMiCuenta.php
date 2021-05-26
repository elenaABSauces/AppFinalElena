<div id="imagenPerfil">
    <?php
        if($imagenUsuario==null){                                       //Si la imagende usuario en la tabla esta vacia le digo que me ponga una por defecto
            echo '<img class="imgpreview" id="preview" src = "./webroot/images/user.svg' . base64_encode($imagenUsuario) . '" width = "120px" height="120px"/>';
        }else{
            echo '<img class="imgpreview" id="preview" src = "data:image/png;base64,' . base64_encode($imagenUsuario) . '" width = "120px" height="120px"/>'; 
        }
    ?>
<div>
      <h3>Editar perfil</h3>
        <div>
              
            <form action = "<?php echo $_SERVER['PHP_SELF']; ?>" method = "post"  enctype="multipart/form-data">        
                
                <div>   
                    <label>Usuario 🔒</label>	
                    <input  type="text" name="CodUsuario" value="<?php echo $codUsuario; ?>" style="background: #D3CAC4;" readonly>
                    <br><br>
                </div>
                
                <div>           
                    <label>Descripción del usuario</label>   
                    <input type="text" name="DescUsuario" value="<?php echo $descUsuario; ?>">
                     <?php echo ($aErrores['DescUsuario']!=null) ? "<span class='error'>".$aErrores['DescUsuario']."</span>" : null; ?>     
                    <br><br>
                </div>
                
                <div>   
                    <label>Numero de conexiones 🔒</label>	
                        <input type="text" name="NumConexiones" value="<?php echo $numConexiones; ?>" style="background: #D3CAC4;" readonly>
                    <br><br>
                </div>   
                <?php
                    if($numConexiones>1){
                ?>
                    <div>   
                        <label>Ultima fecha de conexion 🔒</label>	
                            <input type="text" name="FechaHoraUltimaConexion" value="<?php echo (date('d/m/Y H:i:s')); ?>" style="background: #D3CAC4;" readonly>
                    <br><br>
                    </div> 
                <?php
                    }
                ?>
                <div class="imagen">           
                    <label for="imagen">Imagen de perfil</label>   
                    <input type="file" onchange="document.getElementById('preview').src = window.URL.createObjectURL(this.files[0])" id="imagen" name="imagen">
                    <?php echo ($aErrores['ImagenUsuario']!=null) ? "<span class='error'>".$aErrores['ImagenUsuario']."</span>" : null; ?>
                    <br><br>
                </div>
                
                    <input type="submit"  value="CAMBIAR CONTRASEÑA" name="cambiarPassword" class="contraseña">
                    <br>
                <div>
                    <input type="submit" value="Aceptar" name="aceptar" class="aceptar">
                    <input type="submit" value="Cancelar" name="cancelar" class="cancelar">
                </div>

               

            </form>
</div>