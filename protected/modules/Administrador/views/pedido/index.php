<?php
/* @var $this PedidoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pedidos',
);
?>

<h1>Pedidos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
