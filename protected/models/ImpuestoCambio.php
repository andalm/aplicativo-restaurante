<?php

/**
 * This is the model class for table "ImpuestoCambio".
 *
 * The followings are the available columns in table 'ImpuestoCambio':
 * @property integer $id
 * @property string $fecha
 * @property double $porcentaje
 * @property integer $impuestoId
 *
 * The followings are the available model relations:
 * @property Impuesto $impuesto
 * @property ImpuestoMovimiento[] $impuestoMovimientos
 */
class ImpuestoCambio extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ImpuestoCambio';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fecha, impuestoId', 'required'),
			array('impuestoId', 'numerical', 'integerOnly'=>true),
			array('porcentaje', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fecha, porcentaje, impuestoId', 'safe', 'on'=>'search'),
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
			'impuesto' => array(self::BELONGS_TO, 'Impuesto', 'impuestoId'),
			'impuestoMovimientos' => array(self::HAS_MANY, 'ImpuestoMovimiento', 'impuestoCambioId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fecha' => 'Fecha en el que se realizo el cambio en el impuesto',
			'porcentaje' => 'Procentaje a pagar por el impuesto',
			'impuestoId' => 'Identificador del impuesto',
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
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('porcentaje',$this->porcentaje);
		$criteria->compare('impuestoId',$this->impuestoId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ImpuestoCambio the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
