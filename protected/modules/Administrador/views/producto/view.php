<?php
/* @var $this ProductoController */
/* @var $model Producto */

$this->breadcrumbs=array(
	'Productos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Lista de Productos', 'url'=>array('index')),
	array('label'=>'Crear Producto', 'url'=>array('create')),
	array('label'=>'Actualizar Producto', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar Producto', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Está seguro que desea elimnar este producto?')),
	array('label'=>'Gestión de Producto', 'url'=>array('admin')),
);
?>

<h1>Detalle de Producto #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombre',
		'valor',
		array(
            'label' => $model->productoTipo->getAttributeLabel('nombre') . " de tipo",
            'value' => $model->productoTipo->nombre,
        ),
	),
)); ?>
