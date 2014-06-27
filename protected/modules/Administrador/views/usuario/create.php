<?php
/* @var $this UsuarioController */
/* @var $model Usuario */

$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Lista de Usuarios', 'url'=>array('index')),
	array('label'=>'Gestión de Usuarios', 'url'=>array('admin')),
);
?>

<h1>Crear Usuario</h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'perfiles' => $perfiles)); ?>