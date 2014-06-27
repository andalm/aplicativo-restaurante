<?php
/* @var $this ProductoController */
/* @var $model Producto */

$this->breadcrumbs=array(
	'Productos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Lista de Productos', 'url'=>array('index')),
	array('label'=>'Crear Producto', 'url'=>array('create')),
	array('label'=>'Detalle de Producto', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Gestión de Productos', 'url'=>array('admin')),
);
?>

<h1>Update Producto <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'productoTipo'=>$productoTipo)); ?>