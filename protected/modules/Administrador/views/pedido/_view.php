<?php
/* @var $this PedidoController */
/* @var $data Pedido */
$class = (count($data->pedidos) > 0) ? "mesaDeshabilitada" : "mesaHabilitada";
?>

<?php echo CHtml::link(CHtml::encode($data->nombre), array('view', 'id'=>$data->id), array(
        'class' => 'mesa mesaHabilitada'
 )) ?>