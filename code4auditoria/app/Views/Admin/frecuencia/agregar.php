<form method="POST" action="" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="nombrefrecuencia" class="form-label">Nombre de frecuencia</label>
        <input type="text" name="nombrefrecuencia" class="form-control" id="nombrefrecuencia" placeholder="Nombre de frecuencia">
    </div>

    <table class="table">
        <?php foreach ($listMeses as $key => $value) : ?>
            <tr>
                <td><?= $value ?></td>
                <td>
                    <?php

                    foreach ($accionesT as $key2 => $value2) {
                    ?>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="accion[<?= $key ?>][]" type="checkbox" id="inlineCheckbox<?= $value2->id . $key ?>" value="<?= $value2->id ?>">
                            <label class="form-check-label" for="inlineCheckbox<?= $value2->id . $key ?>"><?= $value2->descripcion ?></label>
                        </div>
                    <?php
                    }

                    ?>

                </td>

            <tr>
            <?php endforeach; ?>



    </table>

    <button type="submit" class="btn btn-lg btn-success text-white" name="submit" value="submit">Guardar</button>
</form>