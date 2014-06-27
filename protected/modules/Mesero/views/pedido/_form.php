<?php
/* @var $this PedidoController */
/* @var $model Pedido */
/* @var $form CActiveForm */
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id' => 'pedido-form',
	'action' => $this->createAbsoluteUrl(Yii::app()->controller->id.'/'.Yii::app()->controller->action->id.'&id='.$model->id),
	'method' => 'post',
	'htmlOptions' => array('data-ajax' => 'false'),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
    <div class="row" id="contentProductos">
        <?php foreach($productosTipo as $key => $productoTipo): ?>
            <?php $style = ($key != 0) ? "display: none" : "" ?>
            <?php $i = 1 ?>
            <div class="row" id="items-<?php echo preg_replace('/\s+/', '_', $productoTipo->nombre) ?>" style="<?php echo $style ?>">
                <h3><?php echo $productoTipo->nombre ?></h3>
                    <?php 
                         if(!$model->isNewRecord)
                         {
                            $pedidoDetalles = PedidoDetalle::model()->with(
                                array(
                                        'idProducto0' => array(
                                        'alias' => 'p',
                                        'joinType' => 'INNER JOIN',
                                        'on' => 'p.ProductoTipoId = '. $productoTipo->id .
                                                ' and p.estado = 1 and idPedido = ' . $model->id,
                                    ),
                                )
                              )->findAll();
                            
                            if(count($pedidoDetalles) > 0)
                                $model->pedidoDetalles = $pedidoDetalles;
                            else
                                $model->pedidoDetalles = array(new PedidoDetalle());
                          }
                    ?>
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
             </div>
        <?php endforeach ?>
    </div>

    <div class="row" style="text-align: center;">
        <input type="button" data-inline="true" value="Agregar Item" id="agregar">
    </div>

    <div class="row">
        <?php
            echo $form->dropDownList(
                $model, 'idMesa',
                Chtml::listData($mesas, 'id', 'nombre'),
                array('empty'=>'SELECCIÓN DE MESA')
            )
        ?>
        <?php echo $form->error($model,'idMesa'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Modificar'); ?>
    </div>
<?php $this->endWidget(); ?>
</div><!-- form -->