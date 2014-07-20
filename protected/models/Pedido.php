<?php

/**
 * This is the model class for table "Pedido".
 *
 * The followings are the available columns in table 'Pedido':
 * @property integer $id
 * @property string $total
 * @property string $tiempoInicio
 * @property string $tiempoFinal
 * @property integer $estado
 * @property integer $usuarioId
 * @property integer $mesaId
 * @property integer $impuestoMovimientoId
 * @property string $propina
 * @property integer $numeroPersonas
 * @property integer $consecutivoId
 *
 * The followings are the available model relations:
 * @property Usuario $usuario
 * @property Mesa $mesa
 * @property ImpuestoMovimiento $impuestoMovimiento
 * @property Consecutivo $consecutivo
 * @property PedidoDetalle[] $pedidoDetalles
 */
class Pedido extends CActiveRecord
{
        const ERROR = 0;
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
			array('tiempoInicio, usuarioId, mesaId, impuestoMovimientoId, consecutivoId', 'required'),
			array('estado, usuarioId, mesaId, impuestoMovimientoId, numeroPersonas, consecutivoId', 'numerical', 'integerOnly'=>true),
			array('total, propina', 'length', 'max'=>20),
			array('tiempoFinal', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, total, tiempoInicio, tiempoFinal, estado, usuarioId, mesaId, impuestoMovimientoId, propina, numeroPersonas, consecutivoId', 'safe', 'on'=>'search'),
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
			'usuario' => array(self::BELONGS_TO, 'Usuario', 'usuarioId'),
			'mesa' => array(self::BELONGS_TO, 'Mesa', 'mesaId'),
			'impuestoMovimiento' => array(self::BELONGS_TO, 'ImpuestoMovimiento', 'impuestoMovimientoId'),
			'consecutivo' => array(self::BELONGS_TO, 'Consecutivo', 'consecutivoId'),
			'pedidoDetalles' => array(self::HAS_MANY, 'PedidoDetalle', 'pedidoId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'total' => 'Valor total del pedido',
			'tiempoInicio' => 'Tiempo en que se toma el pedido',
			'tiempoFinal' => 'Tiempo de despacho del pedido',
			'estado' => '1: Enviado, 2: Despachado, 3: Cancelado',
			'usuarioId' => 'Usuario que realizo el pedido ref tabla usuario',
			'mesaId' => 'Mesa en que se realizo el pedido',
			'impuestoMovimientoId' => 'Impuesto aplicado al pedido',
			'propina' => 'Propina voluntaria dada por el cliente',
			'numeroPersonas' => 'Cantidad de personas en la mesa al momento de hacer pedido',
			'consecutivoId' => 'Identificador del consecutivo que se lleva por cada sucursal',
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
		$criteria->compare('total',$this->total,true);
		$criteria->compare('tiempoInicio',$this->tiempoInicio,true);
		$criteria->compare('tiempoFinal',$this->tiempoFinal,true);
		$criteria->compare('estado',$this->estado);
		$criteria->compare('usuarioId',$this->usuarioId);
		$criteria->compare('mesaId',$this->mesaId);
		$criteria->compare('impuestoMovimientoId',$this->impuestoMovimientoId);
		$criteria->compare('propina',$this->propina,true);
		$criteria->compare('numeroPersonas',$this->numeroPersonas);
		$criteria->compare('consecutivoId',$this->consecutivoId);

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
        
        public function init()
        {
            if($this->isNewRecord)
            {
                $this->pedidoDetalles = [new PedidoDetalle];            
            }
        }
}
