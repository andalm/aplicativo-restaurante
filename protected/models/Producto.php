<?php

/**
 * This is the model class for table "Producto".
 *
 * The followings are the available columns in table 'Producto':
 * @property integer $id
 * @property string $nombre
 * @property string $valor
 * @property integer $estado
 * @property integer $productoTipoId
 * @property string $imagen
 *
 * The followings are the available model relations:
 * @property InventarioDetalle[] $inventarioDetalles
 * @property PedidoDetalle[] $pedidoDetalles
 * @property ProductoTipo $productoTipo
 */
class Producto extends CActiveRecord
{
   const HABILITADO = 1;
   const DESHABILITADO = 0;
   
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Producto';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, productoTipoId', 'required'),
			array('estado, productoTipoId', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>45),
			array('valor', 'length', 'max'=>10),
			array('imagen', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombre, valor, estado, productoTipoId, imagen', 'safe', 'on'=>'search'),
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
			'inventarioDetalles' => array(self::HAS_MANY, 'InventarioDetalle', 'productoId'),
			'pedidoDetalles' => array(self::HAS_MANY, 'PedidoDetalle', 'productoId'),
			'productoTipo' => array(self::BELONGS_TO, 'ProductoTipo', 'productoTipoId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombre' => 'Nombre del producto',
			'valor' => 'Valor del producto',
			'estado' => '1: Habilitado, 0: Deshabilitado',
			'productoTipoId' => 'Tipo de producto, del producto en cuestion',
			'imagen' => 'Imagen del producto',
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
		$criteria->compare('valor',$this->valor,true);
		$criteria->compare('estado',$this->estado);
		$criteria->compare('productoTipoId',$this->productoTipoId);
		$criteria->compare('imagen',$this->imagen,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Producto the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
