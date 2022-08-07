<div class="container">
    <h3>Editar <?= $nombre?></h3>
    <?php $validation = \Config\Services::validation(); ?>
    <form action="" method="POST">
      

        <div class="mb-3 row">
            <label for="categoria" class="col-sm-2 col-form-label">Categoría</label>
            <div class="col-sm-10">
                <select name="categoria" class="form-select" id="categoria">
                    <option value="">Seleccionar</option>
                    <?php foreach($categorias as $key=>$value): ?>
                        <option <?php echo (($value["id"] == $f_model["id_categoria"])?"selected":"") ?> value="<?= $value["id"] ?>"><?= $value["descripcion"] ?></option>
                    <?php endforeach; ?>
                </select>

                <?php if ($validation->getError('categoria')) { ?>
                    <div class='alert alert-danger mt-2'>
                        <?= $error = $validation->getError('categoria'); ?>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="frecuencia" class="col-sm-2 col-form-label">Frecuencia</label>
            <div class="col-sm-10">
                <select name="frecuencia" class="form-select" id="frecuencia">
                    <option value="">Seleccionar</option>
                    <?php foreach($frecuencias as $key=>$value): ?>
                        <option <?php echo (($value["id"] == $f_model["id_frecuencia"])?"selected":"") ?> value="<?= $value["id"] ?>"><?= $value["descripcion"] ?></option>
                    <?php endforeach; ?>
                </select>

                <?php if ($validation->getError('frecuencia')) { ?>
                    <div class='alert alert-danger mt-2'>
                        <?= $error = $validation->getError('frecuencia'); ?>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="canal" class="col-sm-2 col-form-label">Canal</label>
            <div class="col-sm-10">
                <select name="canal" class="form-select" id="canal">
                    <option value="">Seleccionar</option>
                    <?php foreach($canals as $key=>$value): ?>
                        <option <?php echo (($value["id"] == $f_model["id_canal"])?"selected":"") ?> value="<?= $value["id"] ?>"><?= $value["descripcion"] ?></option>
                    <?php endforeach; ?>
                </select>

                <?php if ($validation->getError('canal')) { ?>
                    <div class='alert alert-danger mt-2'>
                        <?= $error = $validation->getError('canal'); ?>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="zona" class="col-sm-2 col-form-label">Zona</label>
            <div class="col-sm-10">
                <select name="zona" class="form-select" id="zona">
                    <option value="">Seleccionar</option>
                    <?php foreach($zonas as $key=>$value): ?>
                        <option <?php echo (($value["id"] == $f_model["id_zona"])?"selected":"") ?> value="<?= $value["id"] ?>"><?= $value["descripcion"] ?></option>
                    <?php endforeach; ?>
                </select>

                <?php if ($validation->getError('zona')) { ?>
                    <div class='alert alert-danger mt-2'>
                        <?= $error = $validation->getError('zona'); ?>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="fechaInicio" class="col-sm-2 col-form-label">Fecha Inicio</label>
            <div class="col-sm-10">
                <input type="date" name="fechaInicio" class="form-select" id="fechaInicio" value="<?php echo $f_model["fechaInicio"] ?>">
                   
                <?php if ($validation->getError('fechaInicio')) { ?>
                    <div class='alert alert-danger mt-2'>
                        <?= $error = $validation->getError('fechaInicio'); ?>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="fechaFin" class="col-sm-2 col-form-label">Fecha Fin</label>
            <div class="col-sm-10">
                <input type="date" name="fechaFin" class="form-select" id="fechaFin" value="<?php echo $f_model["fechaFin"] ?>">
                   
                <?php if ($validation->getError('fechaFin')) { ?>
                    <div class='alert alert-danger mt-2'>
                        <?= $error = $validation->getError('fechaFin'); ?>
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