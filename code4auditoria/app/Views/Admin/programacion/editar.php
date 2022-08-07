<div class="container">
    <h3>Editar <?= $nombre ?></h3>
    <?php $validation = \Config\Services::validation(); ?>
    <form action="" method="POST">
        <div class="mb-3 row">
            <label for="personal" class="col-sm-2 col-form-label">Personal</label>
            <div class="col-sm-10">
                <select name="personal" class="form-select" id="personal">
                    <option value="">Seleccionar</option>
                    <?php foreach ($personals as $key => $value) : ?>
                        <option <?php echo (($value["id"] == $f_model["id_personal"]) ? "selected" : "") ?> value="<?= $value["id"] ?>"><?= $value["nombres"]." ".$value["apellidoPaterno"]." ".$value["apellidoMaterno"] ?></option>
                    <?php endforeach; ?>
                </select>

                <?php if ($validation->getError('personal')) { ?>
                    <div class='alert alert-danger mt-2'>
                        <?= $error = $validation->getError('personal'); ?>
                    </div>
                <?php } ?>
            </div>
        </div>

    

        <div class="mb-3 row">
            <label for="ruta" class="col-sm-2 col-form-label">Ruta</label>
            <div class="col-sm-10">
                <select name="ruta" class="form-select" id="ruta">
                    <option value="">Seleccionar</option>
                    <?php foreach ($rutas as $key => $value) : ?>
                        <option <?php echo (($value["id"] == $f_model["id_programacion_ruta"]) ? "selected" : "") ?> value="<?= $value["id"] ?>"><?= $value["descripcion"] ?></option>
                    <?php endforeach; ?>
                </select>

                <?php if ($validation->getError('ruta')) { ?>
                    <div class='alert alert-danger mt-2'>
                        <?= $error = $validation->getError('ruta'); ?>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="fecha_visita" class="col-sm-2 col-form-label">Fecha</label>
            <div class="col-sm-10">
                <input type="date" name="fecha_visita" class="form-control" id="fecha_visita" value="<?= substr($f_model["fecha_visita"],0,10) ?>" required>
                <?php if ($validation->getError('fecha_visita')) { ?>
                    <div class='alert alert-danger mt-2'>
                        <?= $error = $validation->getError('fecha_visita'); ?>
                    </div>
                <?php } ?>
            </div>
        </div>


        <div class="mb-3">
            <input type="submit" name="submit" value="Guardar" class="btn btn-success">
        </div>
    </form>

</div>

<script>

</script>