<?php

/**
 * This is the model class for table "Pedido".
 *
 * The followings are the available columns in table 'Pedido':
 * @property string $id
 * @property string $total
 * @property string $tiempoInicio
 * @property string $tiempoFinal
 * @property integer $estado
 * @property integer $idUsuario
 * @property integer $idMesa
 *
 * The followings are the available model relations:
 * @property Mesa $idMesa0
 * @property Usuario $idUsuario0
 * @property PedidoDetalle[] $pedidoDetalles
 */
class Pedido extends CActiveRecord
{
	const ENVIADO = 1;
	const DESPACHADO = 2;
	const CANCELADO = 3;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Pedido';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tiempoInicio, estado, idUsuario, idMesa', 'required'),
			array('estado, idUsuario, idMesa', 'numerical', 'integerOnly'=>true),
			array('id', 'length', 'max'=>11),
			array('total', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, total, tiempoInicio, tiempoFinal, estado, idUsuario, idMesa', 'safe', 'on'=>'search'),
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
			'idMesa0' => array(self::BELONGS_TO, 'Mesa', 'idMesa'),
			'idUsuario0' => array(self::BELONGS_TO, 'Usuario', 'idUsuario'),
			'pedidoDetalles' => array(self::HAS_MANY, 'PedidoDetalle', 'idPedido'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Consecutivo',
			'total' => 'Total',
			'tiempoInicio' => 'Tiempo en que se toma el pedido',
			'tiempoFinal' => 'Tiempo de despacho del pedido',
			'estado' => '1: Enviado, 2: Despachado, 3: Cancelado',
			'idUsuario' => 'Mesero',
			'idMesa' => 'Mesa',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('total',$this->total,true);
		$criteria->compare('tiempoInicio',$this->tiempoInicio,true);
		$criteria->compare('tiempoFinal',$this->tiempoFinal,true);
                $criteria->addCondition('estado = ' . Pedido::ENVIADO);
		$criteria->compare('idUsuario',$this->idUsuario);
		$criteria->compare('idMesa',$this->idMesa);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Pedido the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function afterFind() 
	{
		$this->total = Yii::app()->format->number($this->total);
		return parent::afterFind();
	}
}
