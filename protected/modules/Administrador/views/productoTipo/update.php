<?php
/* @var $this ProductoTipoController */
/* @var $model ProductoTipo */

$this->breadcrumbs=array(
	'Tipos de producto'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Modificar',
);

$this->menu=array(
	array('label'=>'Lista de tipos', 'url'=>array('index')),
	array('label'=>'Crear tipo', 'url'=>array('create')),
	array('label'=>'Vista de tipo de prodcuto', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Gestión de tipos de producto', 'url'=>array('admin')),
);
?>

<h1>Modificar tipo de producto <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>