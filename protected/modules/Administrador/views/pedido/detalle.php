<?php
    $this->breadcrumbs=array(
            'Pedidos'=>array('index'),
            "Detalle de pedido No. " . $model->id,
    );

    $this->menu=array(
            array('label'=>'Lista de Pedidos', 'url'=>array('index')),
    );
?>
<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Cantidad</th>
            <th>V. Unitario</th>
            <th>Total</th>
            <th>Comentarios</th>
        </tr>        
    </thead>
    <tbody>
       <?php foreach($model->pedidoDetalles as $detalle): ?>
        <tr>
            <td><?php echo $detalle->idProducto0->nombre ?></td>
            <td><?php echo $detalle->cantidad ?></td>
            <td><?php echo Yii::app()->format->number($detalle->valorUnitario) ?></td>
            <td><?php echo Yii::app()->format->number($detalle->total) ?></td>
            <td><?php echo $detalle->observaciones ?></td>
        </tr>            
       <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <th></th>
            <th></th>
            <th>Total Pedido</th>
            <th><?php echo $model->total ?></th>
        </tr>        
    </tfoot>
</table>
    