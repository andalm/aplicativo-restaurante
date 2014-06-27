<div data-role="page" id="listPedido">
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
		<h1>Listado de Pedidos</h1>
		<div data-role="controlgroup" data-type="horizontal" class="ui-mini ui-btn-right">
			<a 	href="#" 
				class="ui-alt-icon ui-nodisc-icon ui-btn ui-icon-back ui-btn-icon-notext ui-corner-all"
				data-rel="back">
					Atrás
			</a>
		</div>
	</div>
	<div role="main" class="ui-content">
		<?php if(count($model) > 0): ?>
			<ul data-role="listview" data-split-icon="gear" data-split-theme="a" data-inset="true">
				<?php foreach($model as $pedido): ?>
					<li>
						<a href="#">
							<h2>Pedido No. <?php echo preg_replace('/^(0+)(.+)$/', '$2', $pedido->id) ?></h2>
							<p><?php echo $pedido->idMesa0->nombre ?></p>
						</a>
						<a href="#<?php echo $pedido->id ?>" data-rel="popup" data-position-to="window" data-transition="pop">Detalle de pedido</a>
					</li>
				<?php endforeach ?>
			</ul>
			<?php foreach($model as $pedido): ?>
				<div data-role="popup" id="<?php echo $pedido->id ?>" data-theme="a" data-overlay-theme="b" class="ui-content" style="max-width:340px; padding-bottom:2em;">
					<h3>Pedido No. <?php echo preg_replace('/^(0+)(.+)$/', '$2', $pedido->id) ?></h3>
					<p><?php echo $pedido->idMesa0->nombre ?></p>
					<a href="#" class="ui-shadow ui-btn ui-corner-all ui-btn-b ui-icon-check ui-btn-icon-left ui-btn-inline ui-mini">
						Valor: $<?php echo $pedido->total ?>
					</a>
					<br>
					<a
						href="http://restaurante.esspia.com/index.php?r=Mesero/pedido/update&id=<?php echo $pedido->id ?>"
						data-role="button"  
						class="ui-shadow ui-btn ui-corner-all ui-btn-inline ui-mini">Editar</a>
					<a 
                                            href="http://restaurante.esspia.com/index.php?r=Mesero/pedido/anular&id=<?php echo $pedido->id ?>"
                                            data-role="button" 
                                            class="ui-shadow ui-btn ui-corner-all ui-btn-inline ui-mini"
                                            >Anular</a>
					<a href="#listPedido" class="ui-shadow ui-btn ui-corner-all ui-btn-inline ui-mini">Atrás</a>
				</div>
			<?php endforeach ?>
		<?php else: ?>
			<center><h3>No hay pedidos disponibles</h3></center>
		<?php endif ?>
	</div>
	<a href="#" onclick="window.open('<?php echo Yii::app()->params['developersUrl'] ?>', '_system');">
		<div data-role="footer" data-position="fixed" class="ui-footer ui-bar-a ui-footer-fixed slideup" role="contentinfo">
			<center><?php echo Yii::app()->params['developersName'] ?></center>
		</div>
	</a>
</div>