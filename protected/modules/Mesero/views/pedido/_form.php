<?php
/* @var $this PedidoController */
/* @var $model Pedido */
/* @var $form CActiveForm */
?>
<div class="form">
    <?php 
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'pedido-form',
            'action' => $this->createAbsoluteUrl(
                Yii::app()->controller->id.'/'.Yii::app()->controller->action->id . '&id=' . $pedido->id
            ),
            'method' => 'post',
            'htmlOptions' => array('data-ajax' => 'false'),
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.
            'enableAjaxValidation' => false,
        ))
    ?>
        <div class="row" id="contentProductos">
            <?php foreach($porductosxTipo as $key => $productoxTipo): ?>
                <?php $style = ($key != 0) ? "display: none" : "" ?>            
                <div class="row" id="items-<?php echo $productoxTipo->id ?>" style="<?php echo $style ?>">
                    <h3><?php echo $productoxTipo->nombre ?></h3>
                   <?php 
                        $this->renderPartial("_productos", [
                            "productoxTipo" => $productoxTipo,
                            "pedido" => $pedido,
                            "indice" => 0,
                            "form" => $form,
                        ])
                    ?>
                </div>
            <?php endforeach ?>
        </div>

        <div class="row" style="text-align: center;">
            <input type="button" data-inline="true" value="Agregar Item" id="agregar">
        </div>
        
        <div class="row">
            <?php
                echo $form->dropDownList(
                    $pedido, 'mesaId',
                    Chtml::listData($mesas, 'id', 'nombre'),
                    array('empty' => 'SELECCIÓN DE MESA')
                )
            ?>
            <?php echo $form->error($pedido, 'mesaId') ?>
        </div>
        
        <div class="row">
            <?php echo $pedido->getAttributeLabel("numeroPersonas") ?>
            <?php 
                echo $form->numberField($pedido, "numeroPersonas", [
                    "placeholder" => $pedido->getAttributeLabel("numeroPersonas"),
                    "value" => ($pedido->isNewRecord) ? "" : $pedido->numeroPersonas,
                ]) 
            ?>
            <?php echo $form->error($pedido, 'numeroPersonas') ?>
        </div>
        
        <div class="row">
            <?php echo $pedido->getAttributeLabel("propina") ?>
            <?php 
                echo $form->numberField($pedido, "propina", [
                    "placeholder" => $pedido->getAttributeLabel("propina"),
                    "value" => ($pedido->isNewRecord) ? "" : $pedido->propina,
                ]) 
            ?>
            <?php echo $form->error($pedido, 'propina') ?>
        </div>
    
        <div class="row buttons">
            <?php echo CHtml::submitButton($pedido->isNewRecord ? 'Guardar' : 'Modificar') ?>
        </div>
    <?php $this->endWidget(); ?>
</div>
<!-- form -->