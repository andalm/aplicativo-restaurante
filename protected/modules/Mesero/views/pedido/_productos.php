<?php foreach($model->pedidoDetalles as $key2 => $detalle): ?>
                        <?php $nombre = preg_replace('/\s+/', '_', $productoTipo->nombre) ?>
                        <div class="ui-field-contain" style="border-bottom: thin solid #ddd;">
                            <span>Item #<?php echo $i ?></span>
                            <?php
                                echo $form->dropDownList(
                                    $detalle, 'idProducto',
                                    Chtml::listData($productoTipo->productos, 'id', 'concatenedprice'),
                                    array(
                                        'empty'=>'SELECCIÓN DE PRODUCTO',
                                        'name'=> 'PedidoDetalle['.$nombre.'][idProducto]['.$key2.']',
                                    )
                                )
                            ?>

                            <?php
                                echo $form->numberField($detalle, 'cantidad', array(                                   
                                    'name' => 'PedidoDetalle['.$nombre.'][cantidad]['.$key2.']',
                                    'value' => ($detalle->cantidad == 0) ? '' : $detalle->cantidad,
                                    'placeholder' => 'Cantidad'
                                ))
                            ?>
                            
                           <?php
                                echo $form->textArea($detalle, 'observaciones', array(                                   
                                    'name' => 'PedidoDetalle['.$nombre.'][observaciones]['.$key2.']',
                                    'placeholder' => 'Observaciones'
                                ))
                            ?>
                            
                            <?php if($key2 > 0): ?>
                                    <br>
                                    <input type="button" data-inline="true" value="Eliminar Item #<?php echo $key2+1 ?>" id="Elimnar" server="true">
                            <?php endif ?>
                        </div>
                        <?php $i++; ?>
		<?php endforeach ?>
<input type="hidden" value="<?php echo count($model->pedidoDetalles)-1 ?>" id="cuentaItems">

