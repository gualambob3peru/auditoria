<div class="container">
    <h3>Agregar <?= $nombre ?></h3>
    <?php $validation = \Config\Services::validation(); ?>
    <form action="" method="POST">
     

        <div class="mb-3 row">
            <label for="id_ruta" class="col-sm-2 col-form-label">Ruta</label>
            <div class="col-sm-10">
                <select name="id_ruta" class="form-select" id="id_ruta">
                    <option value="">Seleccionar</option>
                    <?php foreach ($rutas as $key => $value) : ?>
                        <option  value="<?= $value["id"] ?>"><?= $value["descripcion"] ?></option>
                    <?php endforeach; ?>
                </select>

                <?php if ($validation->getError('id_ruta')) { ?>
                    <div class='alert alert-danger mt-2'>
                        <?= $error = $validation->getError('id_ruta'); ?>
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