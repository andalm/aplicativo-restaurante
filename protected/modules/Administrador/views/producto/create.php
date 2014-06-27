<?php
/* @var $this ProductoController */
/* @var $model Producto */

$this->breadcrumbs=array(
	'Productos'=>array('index'),
	'Crear Producto',
);

$this->menu=array(
	array('label'=>'Lista Productos', 'url'=>array('index')),
	array('label'=>'Gestión de Productos', 'url'=>array('admin')),
);
?>

<h1>Crear Producto</h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'productoTipo'=>$productoTipo)); ?>