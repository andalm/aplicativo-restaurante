<?php
/* @var $this PedidoController */
/* @var $data Pedido */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Array')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->Array), array('view', 'id'=>$data->Array)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total')); ?>:</b>
	<?php echo CHtml::encode($data->total); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tiempoInicio')); ?>:</b>
	<?php echo CHtml::encode($data->tiempoInicio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tiempoFinal')); ?>:</b>
	<?php echo CHtml::encode($data->tiempoFinal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estado')); ?>:</b>
	<?php echo CHtml::encode($data->estado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idMesa')); ?>:</b>
	<?php echo CHtml::encode($data->idMesa); ?>
	<br />


</div>