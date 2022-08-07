
<form method="POST" action="" enctype="multipart/form-data">
    <table class="table">
        <?php foreach($listMeses as $key=>$value): ?>
            <tr>
                <td><?= $value ?></td>
                <td>
                    <?php 
                    $a = 0;
                        foreach ($frecuencia->meses as $key3 => $value3){
                            
                            if($value3->fecha - 1 == $key){
                                $a = 1;
                               foreach ($accionesT as $key2 => $value2) { 
                                    $checked = "";
                                    foreach ($value3->acciones as $key4 => $value4) {
                                        if($value4->id == $value2->id){
                                            $checked = "checked";break;
                                        }else{
                                            $checked = "";
                                        }
                                    }

                                   ?>
                                   <div class="form-check form-check-inline">
                                       <input class="form-check-input" name="accion[<?=$key?>][]" type="checkbox" id="inlineCheckbox<?= $value2->id.$key ?>" value="<?= $value2->id ?>" <?=$checked?>>
                                       <label class="form-check-label" for="inlineCheckbox<?= $value2->id.$key ?>"><?= $value2->descripcion ?></label>
                                   </div>
                             
                                    <?php
                               }
            
                            }else{
                                
                            }
                        }
                    if($a!=1){ 
                        foreach ($accionesT as $key2 => $value2) { 
                        ?>
                            <div class="form-check form-check-inline">
                                       <input class="form-check-input" name="accion[<?=$key?>][]" type="checkbox" id="inlineCheckbox<?= $value2->id.$key ?>" value="<?= $value2->id ?>">
                                       <label class="form-check-label" for="inlineCheckbox<?= $value2->id.$key ?>"><?= $value2->descripcion ?></label>
                                   </div>
                        <?php
                        }
                    }
                    ?>

                 </td>
              
            <tr>
        <?php endforeach; ?>

     
            
    </table>

    <button type="submit" class="btn btn-lg btn-success text-white" name="submit" value="submit">Guardar</button>                     
</form>