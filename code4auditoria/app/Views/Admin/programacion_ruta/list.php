<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js"></script>

<h3>Configuración de rutas</h3>

<p>
    <a href="admin/programacionRuta/agregar" class="btn btn-warning"><i class="bi bi-plus-lg"></i> Agregar Ruta</a>
</p>

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Ruta</th>
        <th>Fecha Registro</th>
    </tr>

    <?php foreach ($lista_datos as $key => $value) : ?>
        <tr> 
            <td><?= $value->id; ?></td>
            <td><?= $value->r_descripcion; ?></td>
            <td><?= $value->fechaRegistro; ?></td>
            <td>
                <!--<a href="admin/programacionRuta/editar/<?= $value->id ?>" class="btn btn-info text-white"><i class="bi bi-pencil"></i></a> -->

                <a href="admin/programacionRuta/rutas/<?= $value->id_ruta ?>" class="btn btn-success text-white"><i class="bi bi-distribute-vertical"></i></a>
                
                
                <button elId="<?= $value->id ?>" class="btn btn-danger btnEliminar text-white"><i class="bi bi-trash"></i></button>
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