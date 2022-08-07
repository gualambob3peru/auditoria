<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js"></script>

<div class="container">
    <h3>Agregar Local a ruta</h3>
    <?php $validation = \Config\Services::validation(); ?>
    <form action="" method="POST">
    <div class="mb-3 row">
            <label for="local" class="col-sm-2 col-form-label">Local</label>
            <div class="col-sm-10">
                <select name="local" class="form-select" id="local">
                    <option value="">Seleccionar</option>
                    <?php foreach($locals as $key=>$value): ?>
                        <option value="<?= $value["id"] ?>"><?= $value["descripcion"] ?></option>
                    <?php endforeach; ?>
                </select>

                <?php if ($validation->getError('local')) { ?>
                    <div class='alert alert-danger mt-2'>
                        <?= $error = $validation->getError('local'); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        
        <div class="mb-3">
            <input type="submit" name="submit" value="Agregar" class="btn btn-success text-white">
            <a href="admin/ruta" class="btn btn-danger text-white">Cancelar</a>
        </div>
    </form>
    <hr>
    <div class="row">
        <div class="col-md-6">
            <table class="table table-bordered">
                <tr>
                    <th>Local</th>
                    <th>Acción</th>
                </tr>
                
                <?php foreach($ruta_locales as $key=>$value): ?>
                <tr>
                <td><?= $value->l_descripcion; ?></td>
                <td><button elId="<?= $value->id ?>" class="btn btn-danger btnEliminar"><i class="bi bi-trash"></i></button></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>

</div>

<div class="modal" tabindex="-1" id="modalEliminar">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Desea eliminar?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <a class="btn btn-primary" id="btnOkEliminar">Aceptar</a>
            </div>
        </div>
    </div>
</div>

<script>
    let modalEliminar = new bootstrap.Modal(document.getElementById('modalEliminar'), {});
    let btnEliminarAll = document.getElementsByClassName('btnEliminar');
    
    for(let i=0; i<btnEliminarAll.length;i++){
        btnEliminarAll[i].onclick = function(){
            let id = this.getAttribute('elId');

            document.getElementById('btnOkEliminar').setAttribute('href','admin/<?= $table?>/eliminarLocal/'+id);
            modalEliminar.show();

        }
    }
   
</script>