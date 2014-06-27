<?php

/**
 * This is the model class for table "PedidoDetalle".
 *
 * The followings are the available columns in table 'PedidoDetalle':
 * @property integer $id
 * @property double $cantidad
 * @property string $valorUnitario
 * @property string $total
 * @property string $idPedido
 * @property integer $idProducto
 * @property string $observaciones
 *
 * The followings are the available model relations:
 * @property Pedido $idPedido0
 * @property Producto $idProducto0
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
			array('idPedido, idProducto', 'required'),
			array('idProducto', 'numerical', 'integerOnly'=>true),
			array('cantidad', 'numerical'),
			array('valorUnitario, total', 'length', 'max'=>20),
			array('idPedido', 'length', 'max'=>11),
                        array('observaciones', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, cantidad, valorUnitario, total, idPedido, idProducto, observaciones', 'safe', 'on'=>'search'),
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
			'idPedido0' => array(self::BELONGS_TO, 'Pedido', 'idPedido'),
			'idProducto0' => array(self::BELONGS_TO, 'Producto', 'idProducto'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'cantidad' => 'Cantidad de producto',
			'valorUnitario' => 'Valor unitario de producto ',
			'total' => 'Cantidad * el valor unitario, da la cantidad en dinero total del detalle',
			'idPedido' => 'Numero de pedido',
			'idProducto' => 'Producto o item del pedido',
                        'observaciones' => 'Observaciones',
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
		$criteria->compare('idPedido',$this->idPedido,true);
		$criteria->compare('idProducto',$this->idProducto);
                $criteria->compare('observaciones',$this->observaciones,true);

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
}
