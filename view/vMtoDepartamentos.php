<main id="main-mtoDepartamentos">
    <form id="form-mtoDepartamentos-buscador" name="form-mtoDepartamentos-buscador" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" method="post">
        <div class="input-field-container">
            <p>Busqueda por Código o Descripción</p>
            <input type="text" id="DescDepartamento" name="DescDepartamento"  value="<?php echo $busquedaDepartamento ?>"  optional>
        </div>
        <div class="select-field-container">
            <p>Estado del departamento: <p>
                <br>
                <select name="BusquedaPor">
                    <option value="todos" <?php echo ($criterioBusqueda == "todos") ? "selected" : null ?> > Todos </option>
                    <option value="alta" <?php echo ($criterioBusqueda == "alta") ? "selected" : null ?> > Alta </option>
                    <option value="baja" <?php echo ($criterioBusqueda == "baja") ? "selected" : null ?> > Baja </option>
                </select>
        </div>
        <div class="input-field-container">
            <p>Busqueda por páginación: <p>
                <input type="text" id="PagDepartamento" name="PagDepartamento"  value="EN CONSTRUCCIÓN"  optional>

        </div>
        <div>
            <button class="form-button" type="submit" name="Buscar">Buscar</button>
        </div>
    </form>

    <article id="container-departamentos">
        <form id="form-mtoDepartamentos" name="form-mtoDepartamentos" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <table id="table-departamentos">
                <thead>
                    <tr>
                        <th>CodDepartamento</th>
                        <th>DescDepartamento</th>
                        <th>FechaCreacion</th>
                        <th>FechaBaja</th>
                        <th>VolumenNegocio</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (count($aDepartamentos) > 0) {
                        foreach ($aDepartamentos as $departamento => $oDepartamento) {
                            $codDepartamento = $oDepartamento->codDepartamento;
                            ?>
                            <tr class="<?php echo (($oDepartamento->fechaBajaDepartamento) == null) ? "alta" : "baja"; ?>">
                                <td><?php echo $codDepartamento ?></td>
                                <td><?php echo $oDepartamento->descDepartamento ?></td>
                                <td><?php echo date('d/m/Y', $oDepartamento->fechaCreacionDepartamento) ?></td>
                                <td><?php echo (($oDepartamento->fechaBajaDepartamento) == null) ? "NULL" : date('d/m/Y', $oDepartamento->fechaBajaDepartamento); ?></td>
                                <td><?php echo $oDepartamento->volumenDeNegocio ?></td>
                                <td>
                                    <button name="ConsultarModificarDepartamento" value="<?php echo $codDepartamento ?>"><img src="webroot/media/images/img-editar.svg" alt="imagen editar consultar departamento"></button>
                                    <button name="EliminarDepartamento" value="<?php echo $codDepartamento ?>"><img src="webroot/media/images/img-eliminar.svg" alt="imagen eliminar departamento"></button>
                                    <?php if ($oDepartamento->fechaBajaDepartamento == null) { ?>
                                        <button name="BajaLogicaDepartamento" value="<?php echo $codDepartamento ?>"><img src="webroot/media/images/img-baja-logica.svg" alt="baja logica"></button>
                                    <?php } else { ?>
                                        <button name="RehabilitacionDepartamento" value="<?php echo $codDepartamento ?>"><img src="webroot/media/images/img-rehabilitacion.svg" alt="rehabilitacion"></button>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td id="busqueda-no-encontrada" colspan="5">No se ha encontrado ningun departamento con los criterios de la busqueda</td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </form>
        <form id="form-mtoDepartamentos-paginacion" name="form-mtoDepartamentos-paginacion" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

            <div>
                <button class="form-button" type="submit" name="InsertarDepartamento"> Insertar</button>
                <button class="form-button" type="submit" name="ImportarDepartamentos"> Importar</button>
                <button class="form-button" type="submit" name="ExportarDepartamentos"> Exportar</button>
            </div>

            <div id="paginacion-container">
                <?php if (count($aDepartamentos) > 0) { ?>
                    <button <?php echo ($paginaActual == 1) ? "hidden" : null; ?> type="submit" name="paginaInicial" value="1"><img class="imgPaginacion" src="webroot/media/images/pagInicial.png" alt=""></button>
                    <button <?php echo ($paginaActual == 1) ? "hidden" : null; ?> type="submit" name="retrocederPagina" value="<?php echo $paginaActual - 1; ?>"><img class="imgPaginacion" src="webroot/media/images/pagAnterior.png" alt=""></button>
                    <span> <?php echo $paginaActual . " de " . $paginasTotales ?> </span>
                    <button <?php echo ($paginaActual >= $paginasTotales) ? "hidden" : null; ?> type="submit" name="avanzarPagina" value="<?php echo $paginaActual + 1; ?>"><img class="imgPaginacion" src="webroot/media/images/pagSiguiente.svg" alt=""></button>
                    <button <?php echo ($paginaActual >= $paginasTotales) ? "hidden" : null; ?> type="submit" name="paginaFinal" value="<?php echo $paginasTotales ?>"><img class="imgPaginacion" src="webroot/media/images/pagFinal.png" alt=""></button>
                <?php } ?>
            </div>

            <div>
                <button class="form-button" type="submit" name="Volver">Volver</button>
            </div>
        </form>
        <form name="logout" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <button class="volver" type="submit" name='volver'>Volver</button>
        </form>
        </div>
    </article>
</main>