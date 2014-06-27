<div data-role="page" id="welcome">
	<div data-role="header">
		<a href="#" class="ui-btn-left ui-alt-icon ui-nodisc-icon ui-btn ui-icon-power ui-btn-icon-notext ui-corner-all" id="logOut">Salir</a>
		<h1>Bienvenido</h1>
	</div>
	<div role="main" class="ui-content">
		<?php if(!Yii::app()->user->isGuest): ?>

			<center>
				<h2><?php echo Yii::app()->user->fullName ?></h2>
				<p>
					<a 
						href="http://restaurante.esspia.com/index.php?r=Mesero/pedido/create" 
						data-role="button" 
						data-icon="plus"
						data-corners="true"
						data-shadow="true" 
						data-iconshadow="true" 
						data-wrapperels="span"
						data-theme="c" 
						class="ui-btn ui-btn-inline ui-icon-plus ui-btn-icon-bottom">
							Hacer Pedido
					</a>
					<a 
						href="http://restaurante.esspia.com/index.php?r=Mesero/pedido/list"
						data-role="button" 
						data-icon="plus"
						data-corners="true"
						data-shadow="true" 
						data-iconshadow="true" 
						data-wrapperels="span"
						data-theme="c" 
						class="ui-btn ui-btn-inline ui-icon-bars ui-btn-icon-bottom">
							Ver Pedidos
					</a>
				</p>
			</center>			
			
		<?php endif ?>
	</div>
	
	<a href="#" onclick="window.open('<?php echo Yii::app()->params['developersUrl'] ?>', '_system');">
		<div data-role="footer" data-position="fixed" class="ui-footer ui-bar-a ui-footer-fixed slideup" role="contentinfo">
			<center><?php echo Yii::app()->params['developersName'] ?></center>
		</div>
	</a>
</div>