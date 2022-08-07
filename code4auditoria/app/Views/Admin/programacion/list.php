<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<h3>Programación de rutas</h3>

<p>
    <a href="admin/<?= $table ?>/agregar" class="btn btn-warning"><i class="bi bi-plus-lg"></i> Agregar <?= $table ?></a>
</p>

<table class="table table-bordered">
    <tr>
        <th>Auditor</th>

        <th>Ruta</th>
        <th>Fecha</th>
    </tr>

    <?php foreach ($lista_datos as $key => $value) : ?>
        <tr> 
            <td><?= $value->nombres; ?></td>
            <td><?= $value->r_descripcion; ?></td>
            <td><?= $value->fecha_visita; ?></td>
            <td>
                <a href="admin/<?= $table ?>/editar/<?= $value->id ?>" class="btn btn-info"><i class="bi bi-pencil text-white"></i></a>
                
                <button elId="<?= $value->id ?>" class="btn btn-success btnProgramar"><i class="bi bi-arrow-down-square  text-white"></i></button>
                
                <button elId="<?= $value->id ?>" class="btn btn-danger btnEliminar"><i class="bi bi-trash  text-white"></i></button>
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

    $(function(){
       $(".btnProgramar").click(function(){
           var id_programacion = $(this).attr("elId");
           $.ajax({
               url : "admin/programacion/programar",
               type : "post",
               data : {id_programacion : id_programacion},
               dataType : "json",
               error : function(we){
                    alert("Inténtelo de nuevo")
               },
               success : function (response){
                   alert("La ruta ha sido procesada correctamente")
               }
           });
       });
    })
   
</script>