<?php

/**
 * This is the model class for table "Mesa".
 *
 * The followings are the available columns in table 'Mesa':
 * @property integer $id
 * @property string $nombre
 * @property integer $estado
 * @property integer $sucursalId
 *
 * The followings are the available model relations:
 * @property Sucursal $sucursal
 * @property Pedido[] $pedidos
 */
class Mesa extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Mesa';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, sucursalId', 'required'),
			array('estado, sucursalId', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombre, estado, sucursalId', 'safe', 'on'=>'search'),
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
			'pedidos' => array(self::HAS_MANY, 'Pedido', 'mesaId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombre' => 'El numero de mesa',
			'estado' => 'Estado actual de la mesa.1: Habilitado, 0: Deshabilitado',
			'sucursalId' => 'Sucursal a la que pertence la mesa',
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
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('estado',$this->estado);
		$criteria->compare('sucursalId',$this->sucursalId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Mesa the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
