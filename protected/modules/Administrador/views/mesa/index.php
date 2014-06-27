<?php
/* @var $this MesaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Mesas',
);

$this->menu=array(
	array('label'=>'Crear Mesa', 'url'=>array('create')),
	array('label'=>'Gestión de Mesas', 'url'=>array('admin')),
);
?>

<h1>Mesas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
