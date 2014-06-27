<?php
/* @var $this ProductoTipoController */
/* @var $model ProductoTipo */

$this->breadcrumbs=array(
	'Tipos de producto'=>array('index'),
	'Crear tipo',
);

$this->menu=array(
	array('label'=>'Lista de tipos', 'url'=>array('index')),
	array('label'=>'Gestión de tipos de productos', 'url'=>array('admin')),
);
?>

<h1>Crear Tipo de Producto</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>