<?php

/**
 * This is the model class for table "InventarioDetalle".
 *
 * The followings are the available columns in table 'InventarioDetalle':
 * @property integer $id
 * @property double $cantidad
 * @property string $valorUnitario
 * @property string $total
 * @property integer $productoId
 * @property integer $inventarioId
 *
 * The followings are the available model relations:
 * @property Producto $producto
 * @property Inventario $inventario
 */
class InventarioDetalle extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'InventarioDetalle';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('productoId, inventarioId', 'required'),
			array('productoId, inventarioId', 'numerical', 'integerOnly'=>true),
			array('cantidad', 'numerical'),
			array('valorUnitario, total', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, cantidad, valorUnitario, total, productoId, inventarioId', 'safe', 'on'=>'search'),
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
			'producto' => array(self::BELONGS_TO, 'Producto', 'productoId'),
			'inventario' => array(self::BELONGS_TO, 'Inventario', 'inventarioId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'cantidad' => 'cantidad de producto',
			'valorUnitario' => 'valor unitario de producto',
			'total' => 'total: cantidad * valor unitario de producto',
			'productoId' => 'Producto relacionado en el detalle del inventario',
			'inventarioId' => 'Indentificador del inventario',
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
		$criteria->compare('productoId',$this->productoId);
		$criteria->compare('inventarioId',$this->inventarioId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return InventarioDetalle the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
