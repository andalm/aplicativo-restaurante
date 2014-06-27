<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html lang="<?php echo Yii::app()->language ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
			<!-- blueprint CSS framework -->
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" >
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" >
		<!--[if lt IE 8]>
			<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" >
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" >

		<title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>
	<body>

		<div class="container" id="page">

			<div id="header">
				<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
			</div><!-- header -->

			<div id="mainmenu">
				<?php $this->widget('zii.widgets.CMenu',array(
					'items'=>array(
						array('label'=>'Inicio', 'url'=>array('/site/index'), 'visible' => Yii::app()->user->isGuest),
						array(
							'label' => 'Usuarios', 
							'url' => array(
								'/Administrador/usuario'
							), 
							'visible' => Yii::app()->user->getState('idPerfil') == 1),
						array(
							'label' => 'Tipos de Producto', 
							'url' => array(
								'/Administrador/productoTipo'
							), 
							'visible' => Yii::app()->user->getState('idPerfil') == 1),
						array(
							'label' => 'Productos', 
							'url' => array(
								'/Administrador/producto'
							), 
							'visible' => Yii::app()->user->getState('idPerfil') == 1),
                                                array(
							'label' => 'Mesas', 
							'url' => array(
								'/Administrador/mesa'
							), 
							'visible' => Yii::app()->user->getState('idPerfil') == 1),
						array(
							'label' => 'Pedidos', 
							'url' => array(
								'/Administrador/pedido'
							), 
							'visible' => Yii::app()->user->getState('idPerfil') == 1),
						array('label'=>'Salir ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
					),
				)); ?>
			</div><!-- mainmenu -->
			<?php if(isset($this->breadcrumbs)):?>
				<?php $this->widget('zii.widgets.CBreadcrumbs', array(
					'links'=>$this->breadcrumbs,
				)); ?><!-- breadcrumbs -->
			<?php endif?>

			<?php echo $content; ?>

			<div class="clear"></div>

			<div id="footer">
				Copyright &copy; <?php echo date('Y'); ?> por 
				<?php echo CHtml::link(
					Yii::app()->params['developersName'], 
					Yii::app()->params['developersUrl'], 
					array("target" => "_blank" )
				) ?>.
				<br/>
				Todos los derechos reservados.<br/>
				<?php echo Yii::powered(); ?>
			</div><!-- footer -->

		</div><!-- page -->

	</body>
</html>
