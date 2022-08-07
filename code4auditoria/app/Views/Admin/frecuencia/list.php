
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!--
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>-->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>


<style>
    table td{
        
    }
</style>
    <script>
    $(function() {

        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})


        $('#miTabla').DataTable({
            "order": [[ 1, "desc" ]],
            "language": {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "",
                "sInfoEmpty": "",
                "sInfoFiltered": "",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Ãšltimo",
                    "sNext": ">",
                    "sPrevious": "<"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                },
                "buttons": {
                    "copy": "Copiar",
                    "colvis": "Visibilidad"
                }
            },
            dom: 'Bfrtip',
            buttons: [
               
            ]
        });

    });
    </script>


<h3>Frecuencias</h3>

<a class="btn btn-success text-white" href="admin/frecuencia/agregar"><i class="bi bi-plus-lg"></i> Frecuencia</a>

<table class="table" id="miTabla" style="font-size:14px">
    <thead>

        <tr>
            <th  style="text-align: center;">Número</th>
            <th  style="text-align: center;">Descripción</th>
            <th  style="text-align: center;">Meses</th>
            <th  style="text-align: center;">Acción</th>
        </tr>
    </thead>
    <tbody>
    
        <?php foreach($frecuencias as $key=>$value): ?>
        <tr>
            <td><span><?= $value->id; ?> </span></td>
            <td><span><?= $value->descripcion; ?> </span></td>
            <td>
                <table class=" table-bordered table-sm" style="margin:0 auto;">
                    <thead>
                        <tr>
                            <?php foreach($meses as $key2=>$mes): ?>
                            <th style="text-align: center;background:#ddd"><?= $mes?></th>
                            <?php endforeach; ?>

                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php foreach($meses as $key2=>$value2): ?>
                            <td style="width: 75px;text-align:center">
                                <?php foreach($value->meses as $key3=>$value3): ?>
                                    <?php if($value->meses[$key3]->fecha == $key2 + 1):?>
                                        <?php foreach($value->meses[$key3]->acciones as $key4=>$value4): ?>
                                            <span><?= $value4->simbolo?></span>
                                        <?php endforeach; ?>   
                                    <?php else: ?>
                                        
                                    <?php endif;?>
                                <?php endforeach; ?>        

                            
                               
                                
                           </td>
                            <?php endforeach; ?>
                        </tr>
                    </tbody>
                </table>
            </td>
            <td>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="admin/frecuencia/editar/<?php echo $value->id?>" class="btn btn-info text-white"><i class="bi bi-pencil"></i></a>
                    <button type="button" class="btn btn-danger text-white"><i class="bi bi-trash"></i></button>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="modal" tabindex="-1" id="modalEliminar">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mt-2 ms-2">
                    <div class="col-md-12">

                        <span class="badge bg-danger">Escriba la palabra eliminar para eliminar</span>
                    </div>
                </div>
                    
                <div class="row mt-2 ms-2 text-center">
                    <input type="text" id="inputEliminar" class="form-control ">
                </div>
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
    let modalAprobar = new bootstrap.Modal(document.getElementById('modalAprobar'), {});
    let btnEliminarAll = document.getElementsByClassName('btnEliminar');
    let btnAprobarAll = document.getElementsByClassName('btnAprobar');
    
    $("body").on("click",".btnVisuali",function(){
        let id= $(this).attr("elId");
        $("#idElAprobado").val(id);
    });

    for(let i=0; i<btnEliminarAll.length;i++){
        btnEliminarAll[i].onclick = function(){
            let id = this.getAttribute('elId');

            document.getElementById('btnOkEliminar').setAttribute('href','admin/oc/eliminar/'+id);
            modalEliminar.show();

        }
    }

    for(let i=0; i<btnAprobarAll.length;i++){
        btnAprobarAll[i].onclick = function(){
            let id = this.getAttribute('elId');
            $("#btnOkAprobar").attr("elId",id);
            //document.getElementById('btnOkAprobar').setAttribute('href','admin/oc/aprobar/'+id);
            modalAprobar.show();

        }
    }

    $("body").on("click","#btnOkAprobar",function(){
        let elId = $(this).attr("elId");
        $.ajax({
            url:"admin/oc/ajaxAprobar",
            data:{
                id:elId
            },
            type:"post",
            dataType:"json",
            success : function(response){
          
                if(response.respuesta == "1"){
                    modalAprobar.hide();
                    
                    alert("Aprobación exitosa");
                    let inn = $(".btnAprobar[elId='"+elId+"']").parents("tr").eq(0).find(".bi-exclamation-circle-fill").eq(0);
                    inn.addClass("bi-check-circle-fill").addClass("text-success").removeClass("bi-exclamation-circle-fill").removeClass("text-warning");
                    $(".btnAprobar[elId='"+elId+"']").remove();
                }else{
                    alert("No se pudo aprobar la orden, Inténtelo nuevamente");
                }
            }
        });
    });

    btnOkEliminar.onclick = function(e){
        if(inputEliminar.value == "eliminar"){
            return true;
        }else{
            return false;
        }
    }
     setInterval(function(){
        let id = $("#idElAprobado").val();

        $.ajax({
            url: "admin/oc/ajaxCambiarEstado",
            data : {id:id},
            dataType: "json",
            type : "post",
            success: function(response){
                if(response.respuesta!= null){

                    let orden = response.respuesta ;
                
                    if(orden.estado == "1"){
                        let inn = $(".btnAprobar[elId='"+id+"']").parents("tr").eq(0).find(".bi-exclamation-circle-fill").eq(0);
                        inn.addClass("bi-check-circle-fill").addClass("text-success").removeClass("bi-exclamation-circle-fill").removeClass("text-warning");
                        $(".btnAprobar[elId='"+id+"']").remove();
                    }
                }
            }
        });
     },1000);
   
</script>