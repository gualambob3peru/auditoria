<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js"></script>

<h3>Listado categorias del local</h3>
<h4>Local : <?php echo $local["descripcion"]?></h4>
<h5>Zona : <?php echo $local["z_descripcion"]?></h5>
<h5>Canal : <?php echo $local["c_descripcion"]?></h5>

<form method="POST">
    <div class="row">
        <div class="col-md-2">
           
            <select name="id_categoria" id="" class="form-select">
                <option value="">Seleccionar</option>
                <?php foreach($contratos as $key=>$value): ?>
                <option value="<?= $value["id_categoria"] ?>"><?php echo $value["c_descripcion"] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-2">
        <input class="btn btn-info" type="submit" name="submit" value="Agregar">
        </div>
    </div>
</form>

<br>
<br>

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Categoria</th>
        <th>Fecha Registro</th>
    </tr>

    <?php foreach ($categorias as $key => $value) : ?>
        <tr> 
            <td><?= $value->id; ?></td>
            <td><?= $value->c_descripcion; ?></td>
            <td><?= $value->fechaRegistro; ?></td>
            <td>
                <a class="btn btn-danger text-white"><i class="bi bi-trash"></i></a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>


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

            document.getElementById('btnOkEliminar').setAttribute('href','admin/<?= $table?>/eliminar/'+id);
            modalEliminar.show();

        }
    }
   
</script>