<div class="container">
    <h3>Agregar <?= $nombre?></h3>
    <?php $validation = \Config\Services::validation(); ?>
    <form action="" method="POST">
        <div class="mb-3 row">
            <label for="descripcion" class="col-sm-2 col-form-label">Descripción</label>
            <div class="col-sm-10">
                <input type="text" name="descripcion" class="form-control" id="descripcion" value="" required>
                <?php if ($validation->getError('descripcion')) { ?>
                    <div class='alert alert-danger mt-2'>
                        <?= $error = $validation->getError('descripcion'); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        
        <div class="mb-3 row">
            <label for="sku" class="col-sm-2 col-form-label">SKU</label>
            <div class="col-sm-10">
                <input type="text" name="sku" class="form-control" id="sku" value="" required>
                <?php if ($validation->getError('sku')) { ?>
                    <div class='alert alert-danger mt-2'>
                        <?= $error = $validation->getError('sku'); ?>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="categoria" class="col-sm-2 col-form-label">Categoría</label>
            <div class="col-sm-10">
                <select name="categoria" class="form-select" id="categoria">
                    <option value="">Seleccionar</option>
                    <?php foreach($categorias as $key=>$value): ?>
                        <option value="<?= $value["id"] ?>"><?= $value["descripcion"] ?></option>
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
            <label for="magnitud" class="col-sm-2 col-form-label">Magnitud</label>
            <div class="col-sm-10">
                <select name="magnitud" class="form-select" id="magnitud">
                    <option value="">Seleccionar</option>
                    <?php foreach($magnitudes as $key=>$value): ?>
                    
                        <option value="<?= $value["id"] ?>"><?= $value["descripcion"] ?></option>
                    <?php endforeach; ?>
                </select>

                <?php if ($validation->getError('magnitud')) { ?>
                    <div class='alert alert-danger mt-2'>
                        <?= $error = $validation->getError('magnitud'); ?>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="valor" class="col-sm-2 col-form-label">Valor</label>
            <div class="col-sm-10">
                <input type="text" name="valor" class="form-control" id="valor" value="" required>
                <?php if ($validation->getError('valor')) { ?>
                    <div class='alert alert-danger mt-2'>
                        <?= $error = $validation->getError('valor'); ?>
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