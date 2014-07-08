<?php

/**
 * This is the model class for table "Consecutivo".
 *
 * The followings are the available columns in table 'Consecutivo':
 * @property integer $id
 * @property string $consecutivo
 * @property integer $sucursalId
 *
 * The followings are the available model relations:
 * @property Sucursal $sucursal
 * @property Pedido[] $pedidos
 */
class Consecutivo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Consecutivo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sucursalId', 'required'),
			array('sucursalId', 'numerical', 'integerOnly'=>true),
			array('consecutivo', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, consecutivo, sucursalId', 'safe', 'on'=>'search'),
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
			'sucursal' => array(self::BELONGS_TO, 'Sucursal', 'sucursalId'),
			'pedidos' => array(self::HAS_MANY, 'Pedido', 'consecutivoId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'consecutivo' => 'Numeracion que se da a cada consecutivo de pedido',
			'sucursalId' => 'Identificador de la sucursal',
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
		$criteria->compare('consecutivo',$this->consecutivo,true);
		$criteria->compare('sucursalId',$this->sucursalId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Consecutivo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
