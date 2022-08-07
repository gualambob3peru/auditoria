<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js"></script>

<h3>Listado de rutas programadas</h3>
<h4>Ruta : <?php echo $ruta["descripcion"] ?></h4>

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Ruta</th>
        <th>Fecha Registro</th>
    </tr>

    <?php foreach ($locales as $key => $value) : ?>
        <tr> 
            <td><?= $value->l_id; ?></td>
            <td><?= $value->l_descripcion; ?></td>
            <td><?= $value->fechaRegistro; ?></td>
            <td>
                <a href="admin/programacionRuta/rutaCategoria/<?php echo $id_programacion_ruta?>/<?= $value->l_id ?>" class="btn btn-success text-white"><i class="bi bi-distribute-vertical"></i></a>
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