<?php

/**
 * This is the model class for table "ImpuestoMovimiento".
 *
 * The followings are the available columns in table 'ImpuestoMovimiento':
 * @property integer $id
 * @property double $porcentaje
 * @property string $total
 * @property integer $impuestoCambioId
 *
 * The followings are the available model relations:
 * @property ImpuestoCambio $impuestoCambio
 * @property Pedido[] $pedidos
 */
class ImpuestoMovimiento extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ImpuestoMovimiento';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('impuestoCambioId', 'required'),
			array('impuestoCambioId', 'numerical', 'integerOnly'=>true),
			array('porcentaje', 'numerical'),
			array('total', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, porcentaje, total, impuestoCambioId', 'safe', 'on'=>'search'),
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
			'impuestoCambio' => array(self::BELONGS_TO, 'ImpuestoCambio', 'impuestoCambioId'),
			'pedidos' => array(self::HAS_MANY, 'Pedido', 'impuestoMovimientoId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'porcentaje' => 'Procentaje por defecto o aplicado por el usuario que captutra el pedido',
			'total' => 'Total de importe a pagar al aplicar el impuesto',
			'impuestoCambioId' => 'Cambio aplicado al impuesto',
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
		$criteria->compare('porcentaje',$this->porcentaje);
		$criteria->compare('total',$this->total,true);
		$criteria->compare('impuestoCambioId',$this->impuestoCambioId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ImpuestoMovimiento the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
