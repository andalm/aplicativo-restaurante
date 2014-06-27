<?php
/* @var $this UsuarioController */
/* @var $model Usuario */

$this->breadcrumbs=array(
	'Usuarios' => array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Lista de Usuarios', 'url'=>array('index')),
	array('label'=>'Crear Usuario', 'url'=>array('create')),
	array('label'=>'Actualizar Usuario', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar Usuario', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Está seguro que desea eliminar éste usuario?')),
	array('label'=>'Gestión de Usuarios', 'url'=>array('admin')),
);
?>

<h1>Detalle Usuario #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombres',
		'apellidos',
		'documento',
		'telefono',
		'movil',
		array(
            'label' => $model->idPerfil0->getAttributeLabel('nombre'),
            'value' => $model->idPerfil0->nombre,
        ),
		'nombreUsuario',
	),
)); ?>
