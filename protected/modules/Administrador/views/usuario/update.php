<?php
/* @var $this UsuarioController */
/* @var $model Usuario */

$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Lista de Usuarios', 'url'=>array('index')),
	array('label'=>'Crear Usuario', 'url'=>array('create')),
	array('label'=>'Detalle de Usuario', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Gestión de Usuarios', 'url'=>array('admin')),
);
?>

<h1>Actualizar Usuario <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'perfiles' => $perfiles)); ?>