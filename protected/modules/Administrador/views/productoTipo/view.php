<?php
/* @var $this ProductoTipoController */
/* @var $model ProductoTipo */

$this->breadcrumbs=array(
	'Tipos de Producto'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Lista de tipos', 'url'=>array('index')),
	array('label'=>'Crear tipo', 'url'=>array('create')),
	array('label'=>'Modificar tipo', 'url'=>array('update', 'id'=>$model->id)),	
	array('label'=>'Gestión de tipos de producto', 'url'=>array('admin')),
);
?>

<h1>Vista de tipo de prodcuto #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombre',
	),
)); ?>
