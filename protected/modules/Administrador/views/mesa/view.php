<?php
/* @var $this MesaController */
/* @var $model Mesa */

$this->breadcrumbs=array(
	'Mesas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Lista de Mesas', 'url'=>array('index')),
	array('label'=>'Crear Mesa', 'url'=>array('create')),
	array('label'=>'Actualizar Mesa', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar Mesa', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Está seguro que desea eliminar éste item?')),
	array('label'=>'Gestión de Mesas', 'url'=>array('admin')),
);
?>

<h1>Vista de Mesa #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombre',
	),
)); ?>
