<?php
/* @var $this SiteController */
$breadcrumbs = (!Yii::app()->user->isGuest) ? 'Bienvenido' : 'Inicio de sesión';

$this->breadcrumbs = array(
	$breadcrumbs,
);
?>

<?php if(Yii::app()->user->isGuest): ?>
    <h1>Inicio de Sesión</h1>

    <p>Por favor ingrese los datos requeridos:</p>

    <div class="form">
        <?php $form = $this->beginWidget('CActiveForm', array(
                'id'=>'login-form',
                'action' => $this->createUrl('site/login', array()),
                'enableClientValidation'=>true,
                'clientOptions'=>array(
                        'validateOnSubmit'=>true,
                ),
        )) ?>

            <p class="note">Los datos con <span class="required">*</span> son obligatorios.</p>

            <div class="row">
                <?php echo $form->labelEx($model,'username'); ?>
                <?php echo $form->textField($model,'username'); ?>
                <?php echo $form->error($model,'username'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model,'password'); ?>
                <?php echo $form->passwordField($model,'password'); ?>
                <?php echo $form->error($model,'password'); ?>
            </div>

            <div class="row rememberMe">
                <?php echo $form->checkBox($model,'rememberMe'); ?>
                <?php echo $form->label($model,'rememberMe'); ?>
                <?php echo $form->error($model,'rememberMe'); ?>
            </div>

            <div class="row buttons">
                <?php echo CHtml::submitButton('Enviar'); ?>
            </div>

	<?php $this->endWidget(); ?>
    </div><!-- form -->
	
<?php else: ?>
    <center>
        <h1>Bienvenido</h1>
        <p><?php echo Yii::app()->user->fullName ?></p>
    </center>
	
<?php endif ?>
