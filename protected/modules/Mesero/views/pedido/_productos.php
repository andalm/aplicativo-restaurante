<?php foreach($pedido->pedidoDetalles as $detalle): ?>
    <div class="ui-field-contain" style="border-bottom: thin solid #ddd;">
        <span>Item #<?php echo $indice+1 ?></span>
        <?php
            echo $form->dropDownList(
                $detalle, 
                "[$productoxTipo->nombreFormato][$indice]productoId",
                Chtml::listData($productoxTipo->productos, 'id', 'nombrePrecio'),
                array(
                    'empty'=>'SELECCIÓN DE PRODUCTO',
                )
            )
        ?>
        <?php echo $detalle->getAttributeLabel("cantidad") ?>
        
        <?php
            echo $form->numberField($detalle, "[$productoxTipo->nombreFormato][$indice]cantidad", [         
                'value' => ($detalle->isNewRecord) ? '' : $detalle->cantidad,
                'placeholder' => $detalle->getAttributeLabel("cantidad")
            ])
        ?>
        <?php echo $detalle->getAttributeLabel("observaciones") ?>
        
        <?php
            echo $form->textArea($detalle, "[$productoxTipo->nombreFormato][$indice]observaciones", [
                'placeholder' => $detalle->getAttributeLabel("observaciones")
            ])  
        ?>
        
        <fieldset data-role="controlgroup">
        <?php 
            echo $form->radioButtonList(
                $detalle,
                'detalleTipoMovimientoId', 
                obtenerTiposDetalle(),
                array(
                    'template'=>'{input}{label}',
                    'separator'=> '',
                )
            )
        ?>
        </fieldset>
        
        <?php if($indice > 0): ?>
            <br>
            <input type="button" data-inline="true" value="Eliminar Item #<?php echo $indice+1 ?>" id="Elimnar" server="true">
        <?php endif ?>
    </div>
    <?php $indice++; ?>
<?php endforeach ?>
<input type="hidden" value="<?php echo count($pedido->pedidoDetalles) ?>" id="cuentaItems">
