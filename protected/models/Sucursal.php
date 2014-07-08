<?php

/**
 * This is the model class for table "Sucursal".
 *
 * The followings are the available columns in table 'Sucursal':
 * @property integer $id
 * @property string $nombre
 * @property string $direccion
 * @property string $telefonos
 * @property integer $estado
 * @property integer $municipioId
 * @property integer $paisId
 *
 * The followings are the available model relations:
 * @property Consecutivo[] $consecutivos
 * @property Inventario[] $inventarios
 * @property Mesa[] $mesas
 * @property Municipio $municipio
 * @property Pais $pais
 * @property Usuario[] $usuarios
 */
class Sucursal extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Sucursal';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, direccion, telefonos, municipioId, paisId', 'required'),
			array('estado, municipioId, paisId', 'numerical', 'integerOnly'=>true),
			array('nombre, direccion', 'length', 'max'=>45),
			array('telefonos', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombre, direccion, telefonos, estado, municipioId, paisId', 'safe', 'on'=>'search'),
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
			'consecutivos' => array(self::HAS_MANY, 'Consecutivo', 'sucursalId'),
			'inventarios' => array(self::HAS_MANY, 'Inventario', 'sucursalId'),
			'mesas' => array(self::HAS_MANY, 'Mesa', 'sucursalId'),
			'municipio' => array(self::BELONGS_TO, 'Municipio', 'municipioId'),
			'pais' => array(self::BELONGS_TO, 'Pais', 'paisId'),
			'usuarios' => array(self::HAS_MANY, 'Usuario', 'sucursalId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombre' => 'Nombre de la sucursal',
			'direccion' => 'Direccion en donde se encuentra ubicada la sucursal',
			'telefonos' => 'Telefonos de contacto de la sucursal',
			'estado' => '1: Habilitado, 0: Deshabilitado',
			'municipioId' => 'Ciudad donde se encuentra ubicada la sucursal',
			'paisId' => 'Pais en donde se encuentra ubicada la sucursal',
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
		$criteria->compare('direccion',$this->direccion,true);
		$criteria->compare('telefonos',$this->telefonos,true);
		$criteria->compare('estado',$this->estado);
		$criteria->compare('municipioId',$this->municipioId);
		$criteria->compare('paisId',$this->paisId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Sucursal the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
