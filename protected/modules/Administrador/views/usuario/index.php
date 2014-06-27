<?php
/* @var $this UsuarioController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Usuarios',
);

$this->menu=array(
	array('label'=>'Crear Usuario', 'url'=>array('create')),
	array('label'=>'Gestión de Usuarios', 'url'=>array('admin')),
);
?>

<h1>Usuarios</h1>

<?php 

$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'ajaxUpdate'=>false,
	'enablePagination'=>false,
	'pagerCssClass' => 'result-list',
	'summaryText' => 'Total '. $pages->itemCount .' usuarios registrados',
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
