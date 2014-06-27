<?php
/* @var $this MesaController */
/* @var $model Mesa */

$this->breadcrumbs=array(
	'Mesas'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Lista de Mesas', 'url'=>array('index')),
	array('label'=>'Gestión de Mesas', 'url'=>array('admin')),
);
?>

<h1>Crear Mesa</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>