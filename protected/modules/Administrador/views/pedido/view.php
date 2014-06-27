<?php
/* @var $this PedidoController */
/* @var $model Pedido */

$this->breadcrumbs=array(
	'Pedidos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Lista de Pedidos', 'url'=>array('index')),
);
?>

<h1>Pedios de la Mesa <?php echo $mesa ?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pedido-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'total',
		array(
                    'name' => "idUsuario0",
                    'header' => $model->getAttributeLabel('idUsuario'),
                    'value' => '$data->idUsuario0->getFullName()',
                ),
		array(
			'class'=>'CButtonColumn',
                        'template' => '{view}{dispatch}{delete}',
                        'buttons' => array(
                            'dispatch' => array(
                                'label'=>'Despachar',
                                'imageUrl'=>Yii::app()->request->baseUrl.'/images/dispatch.png',
                                'url'=>'Yii::app()->createUrl("/Administrador/pedido/update", array("id" => $data->id, "idm" => $data->idMesa))',
                            ),
                            'delete' => array(
                                'label'=>'Anular',
                                'url'=>'Yii::app()->createUrl("/Administrador/pedido/delete", array("id" => $data->id))',
                            ),
                            'view' => array(
                                'label'=>'Ver',
                                'url'=>'Yii::app()->createUrl("/Administrador/pedido/detalle", array("id" => $data->id))',
                                'options'=>array(
                                    'target'=>'_blanck',
                                ),
                            ),
                        ),
		),
	),
)); ?>
