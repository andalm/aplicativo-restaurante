<?php
/* @var $this ProductoTipoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tipos de producto',
);

$this->menu=array(
	array('label'=>'Crear tipo', 'url'=>array('create')),
	array('label'=>'Gestión de tipos de producto', 'url'=>array('admin')),
);
?>

<h1>Tipos de producto</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
