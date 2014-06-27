<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'usuario-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Los campos con <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nombres'); ?>
		<?php echo $form->textField($model,'nombres',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'nombres'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'apellidos'); ?>
		<?php echo $form->textField($model,'apellidos',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'apellidos'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'documento'); ?>
		<?php echo $form->textField($model,'documento',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'documento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telefono'); ?>
		<?php echo $form->textField($model,'telefono',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'telefono'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'movil'); ?>
		<?php echo $form->textField($model,'movil',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'movil'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idPerfil'); ?>
		<?php
			echo $form->dropDownList($model, 'idPerfil',
			Chtml::listData($perfiles, 'id', 'nombre'),
			array('empty'=>'SELECCIÓN DE PERFIL'))
		?>
		<?php echo $form->error($model,'idPerfil'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'nombreUsuario'); ?>
		<?php echo $form->textField($model,'nombreUsuario',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'nombreUsuario'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'contrasena'); ?>
		<?php echo $form->textField($model,'contrasena',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'contrasena'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar cambios'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->