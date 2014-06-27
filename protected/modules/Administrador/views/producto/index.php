<?php
/* @var $this ProductoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Productos',
);

$this->menu=array(
	array('label'=>'Crear Producto', 'url'=>array('create')),
	array('label'=>'Gestión de Productos', 'url'=>array('admin')),
);
?>

<h1>Productos</h1>

<?php 

$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'ajaxUpdate'=>false,
	'enablePagination'=>false,
	'pagerCssClass' => 'result-list',
	'summaryText' => 'Total '. $pages->itemCount .' productos registrados',
)); 

$this->widget('CLinkPager', array(
	'header' => '',
	'firstPageLabel' => '&lt;&lt;',
	'prevPageLabel' => '&lt;',
	'nextPageLabel' => '&gt;',
	'lastPageLabel' => '&lt;&lt;',
	'pages' => $pages,
));

?>
