<?php

/**
 * This is the model class for table "PedidoDetalle".
 *
 * The followings are the available columns in table 'PedidoDetalle':
 * @property integer $id
 * @property double $cantidad
 * @property string $valorUnitario
 * @property string $total
 * @property integer $pedidoId
 * @property integer $productoId
 * @property string $observaciones
 * @property integer $detalleTipoMovimientoId
 *
 * The followings are the available model relations:
 * @property Pedido $pedido
 * @property Producto $producto
 * @property DetalleTipoMovimiento $detalleTipoMovimiento
 */
class PedidoDetalle extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'PedidoDetalle';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pedidoId, productoId, detalleTipoMovimientoId', 'required'),
			array('pedidoId, productoId, detalleTipoMovimientoId', 'numerical', 'integerOnly'=>true),
			array('cantidad', 'numerical'),
			array('valorUnitario, total', 'length', 'max'=>20),
			array('observaciones', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, cantidad, valorUnitario, total, pedidoId, productoId, observaciones, detalleTipoMovimientoId', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'pedido' => array(self::BELONGS_TO, 'Pedido', 'pedidoId'),
			'producto' => array(self::BELONGS_TO, 'Producto', 'productoId'),
			'detalleTipoMovimiento' => array(self::BELONGS_TO, 'DetalleTipoMovimiento', 'detalleTipoMovimientoId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'cantidad' => 'Cantidad',
			'valorUnitario' => 'Valor unitario de producto ',
			'total' => 'Cantidad * el valor unitario, da la cantidad en dinero total del detalle',
			'pedidoId' => 'Numero de pedido',
			'productoId' => 'Producto o item del pedido',
			'observaciones' => 'Observaciones',
			'detalleTipoMovimientoId' => 'Indetificado de tipo de detalle',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('cantidad',$this->cantidad);
		$criteria->compare('valorUnitario',$this->valorUnitario,true);
		$criteria->compare('total',$this->total,true);
		$criteria->compare('pedidoId',$this->pedidoId);
		$criteria->compare('productoId',$this->productoId);
		$criteria->compare('observaciones',$this->observaciones,true);
		$criteria->compare('detalleTipoMovimientoId',$this->detalleTipoMovimientoId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PedidoDetalle the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function init()
        {
            if($this->isNewRecord)
            {
                $this->detalleTipoMovimiento = new DetalleTipoMovimiento();
            }
        }
}
