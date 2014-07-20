<div data-role="page" id="addPedido">
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
        
        <h1>Nuevo Pedido</h1>

        <div data-role="controlgroup" data-type="horizontal" class="ui-mini ui-btn-right">
            <a 
                href="#" 
                class="ui-alt-icon ui-nodisc-icon ui-btn ui-icon-back ui-btn-icon-notext ui-corner-all"
                data-rel="back">
                    Atrás
            </a>
        </div>
        
        <div data-role="navbar">
            <?php echo ulMenu($porductosxTipo, "ui-btn-active") ?>
        </div>
        
    </div> 

    <div role="main" class="ui-content">
        <?php if(!Yii::app()->user->isGuest): ?>
           <?php 
                $this->renderPartial('_form', array(
                    'pedido' => pedido,
                    '$porductosxTipo' => $porductosxTipo,
                    'mesas' => $mesas,
                ))
            ?>
        <?php endif ?>
    </div>

   <?php $this->renderPartial("_footer") ?>
</div>