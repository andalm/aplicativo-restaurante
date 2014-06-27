<?php

/**
 * This is the model class for table "Producto".
 *
 * The followings are the available columns in table 'Producto':
 * @property integer $id
 * @property string $nombre
 * @property string $valor
 * @property integer $estado
 * @property integer $ProductoTipoId
 *
 * The followings are the available model relations:
 * @property PedidoDetalle[] $pedidoDetalles
 * @property ProductoTipo $productoTipo
 */
class Producto extends CActiveRecord
{
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
			array('nombre, estado, ProductoTipoId', 'required'),
			array('estado, ProductoTipoId', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>45),
			array('valor', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombre, valor, estado, ProductoTipoId', 'safe', 'on'=>'search'),
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
			'pedidoDetalles' => array(self::HAS_MANY, 'PedidoDetalle', 'idProducto'),
			'productoTipo' => array(self::BELONGS_TO, 'ProductoTipo', 'ProductoTipoId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombre' => 'Nombre',
			'valor' => 'Valor',
			'estado' => 'Estado',
			'ProductoTipoId' => 'Tipo de producto',
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
		$criteria->compare('estado', 1, true);
		$criteria->compare('ProductoTipoId',$this->ProductoTipoId);

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
	
	public function afterFind() 
	{
		$this->valor = Yii::app()->format->number($this->valor);
		return parent::afterFind();
	}
	
	public function getConcatenedPrice()
	{
		return $this->nombre.' - $'.$this->valor;
	}
	
	public function getPricePlain()
	{
		return preg_replace('.\,.', '$1$3', $this->valor);
	}
}
