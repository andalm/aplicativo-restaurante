<div data-role="page" id="updatePedido">
    <div data-role="header">
        <div data-role="controlgroup" data-type="horizontal" class="ui-mini ui-btn-left">
            <a
                href="#" 
                class="ui-alt-icon ui-nodisc-icon ui-btn ui-icon-power ui-btn-icon-notext ui-corner-all" 
                id="logOut">
                    Salir
            </a>
                <a 
                        href="http://restaurante.esspia.com/index.php?r=Mesero" 
                        class="ui-alt-icon ui-nodisc-icon ui-btn ui-icon-home ui-btn-icon-notext ui-corner-all">
                                Inicio
                </a>
        </div>
		<h1>Modificar Pedido No. <?php echo preg_replace('/^(0+)(.+)$/', '$2', $pedido->id) ?></h1>
		<div data-role="controlgroup" data-type="horizontal" class="ui-mini ui-btn-right">
			<a 
				href="#" 
				class="ui-alt-icon ui-nodisc-icon ui-btn ui-icon-back ui-btn-icon-notext ui-corner-all"
				data-rel="back">
					Atrás
			</a>
		</div>
		<div data-role="navbar">
			<ul>
				<?php foreach($productosTipo as $key => $productoTipo): ?>
					<?php $class = ($key == 0) ? "ui-btn-active" : "" ?>
					<li>
						<a href="#" class="<?php echo $class ?>" id="nav-<?php echo preg_replace('/\s+/', '_', $productoTipo->nombre) ?>">							
							<?php echo $productoTipo->nombre ?>
						</a>
					</li>
				<?php endforeach ?>
			</ul>
		</div>
	</div>
	<div role="main" class="ui-content">
		<?php if(!Yii::app()->user->isGuest): ?>
			<?php 
				$this->renderPartial('_form', array(
					'model'=>$model,
					'productosTipo'=>$productosTipo,
					'mesas'=>$mesas,
				)); 
			?>
		<?php endif ?>
	</div>
	<a href="#" onclick="window.open('<?php echo Yii::app()->params['developersUrl'] ?>', '_system');">
		<div data-role="footer" data-position="fixed" class="ui-footer ui-bar-a ui-footer-fixed slideup" role="contentinfo">
			<center><?php echo Yii::app()->params['developersName'] ?></center>
		</div>
	</a>
</div>