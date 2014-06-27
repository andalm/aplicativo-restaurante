<?php
/* @var $this MesaController */
/* @var $model Mesa */

$this->breadcrumbs=array(
	'Mesas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Lsita de Mesas', 'url'=>array('index')),
	array('label'=>'Crear Mesa', 'url'=>array('create')),
	array('label'=>'Vista de Mesa', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Gestión de Mesas', 'url'=>array('admin')),
);
?>

<h1>Actualizar Mesa <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>