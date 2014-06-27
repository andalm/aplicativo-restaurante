<?php
/* @var $this ProductoTipoController */
/* @var $model ProductoTipo */

$this->breadcrumbs=array(
	'Tipos de producto'=>array('index'),
	'Gestión de tipos de producto',
);

$this->menu=array(
	array('label'=>'Lista de tipos', 'url'=>array('index')),
	array('label'=>'Crear tipo', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#producto-tipo-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Gestión de Tipos de Producto</h1>

<?php echo CHtml::link('Búsqueda Avanzada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'producto-tipo-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'nombre',
		array(
			'class'=>'CButtonColumn',
			'template' => '{update}{view}',
		),
	),
)); ?>
