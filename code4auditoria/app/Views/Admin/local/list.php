<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js"></script>

<h3>Negocios</h3>

<p>
    <a href="admin/<?= $table ?>/agregar" class="btn btn-warning"><i class="bi bi-plus-lg"></i> Agregar</a>
</p>

<table class="table table-bordered">
    <tr>
        <th>Descripción</th>
        <th>RUC</th>
        <th>Canal</th>
        <th>Zona</th>
        <th>Tipo de vía</th>
        <th>Nombre de vía</th>
        <th>Número</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($lista_datos as $key => $value) : ?>
        <tr> 
            <td><?= $value->descripcion; ?></td>
            <td><?= $value->ruc; ?></td>
            <td><?= $value->c_descripcion; ?></td>
            <td><?= $value->z_descripcion; ?></td>
            <td><?= $value->tv_descripcion; ?></td>
            <td><?= $value->nombre_via; ?></td>
            <td><?= $value->numero; ?></td>
            <td>
                <a href="admin/<?= $table ?>/editar/<?= $value->id ?>" class="btn btn-info"><i class="bi bi-pencil"></i></a>
                
                
                <button elId="<?= $value->id ?>" class="btn btn-danger btnEliminar"><i class="bi bi-trash"></i></button>
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