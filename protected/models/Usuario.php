<?php

/**
 * This is the model class for table "Usuario".
 *
 * The followings are the available columns in table 'Usuario':
 * @property integer $id
 * @property string $nombres
 * @property string $apellidos
 * @property string $documento
 * @property string $telefono
 * @property string $movil
 * @property integer $idPerfil
 * @property string $nombreUsuario
 * @property string $contraseña
 * @property integer $estado
 *
 * The followings are the available model relations:
 * @property Log[] $logs
 * @property Pedido[] $pedidos
 * @property Perfil $idPerfil0
 */
class Usuario extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Usuario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombres, idPerfil, nombreUsuario, contrasena, estado', 'required'),
			array('idPerfil, estado', 'numerical', 'integerOnly'=>true),
			array('nombres, apellidos, documento, telefono, movil, nombreUsuario, contrasena', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('nombres, apellidos, documento, telefono, movil, nombreUsuario', 'safe', 'on'=>'search'),
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
			'logs' => array(self::HAS_MANY, 'Log', 'idUsuario'),
			'pedidos' => array(self::HAS_MANY, 'Pedido', 'idUsuario'),
			'idPerfil0' => array(self::BELONGS_TO, 'Perfil', 'idPerfil'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombres' => 'Nombres',
			'apellidos' => 'Apellidos',
			'documento' => 'Documento de indentidad',
			'telefono' => 'Telefono',
			'movil' => 'Movil',
			'idPerfil' => 'Perfil',
			'nombreUsuario' => 'Nombre de usuario',
			'contrasena' => 'Contraseña',
			'estado' => 'Estado',
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
		$criteria->compare('nombres',$this->nombres,true);
		$criteria->compare('apellidos',$this->apellidos,true);
		$criteria->compare('documento',$this->documento,true);
		$criteria->compare('telefono',$this->telefono,true);
		$criteria->compare('movil',$this->movil,true);
		$criteria->compare('idPerfil',$this->idPerfil);
		$criteria->compare('nombreUsuario',$this->nombreUsuario,true);
		$criteria->compare('contrasena',$this->contrasena,true);
		$criteria->compare('estado', 1);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Usuario the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function getFullName()
	{
		$fullName = "";
		$nombres = split('[[:space:]]', strtolower(trim($this->nombres)));
		$apellidos = split('[[:space:]]', strtolower(trim($this->apellidos)));
		
		foreach($nombres as $nombre)
			$fullName .= ucfirst($nombre) . " "; 
		
		foreach($apellidos as $apellido)
			$fullName .= ucfirst($apellido) . " "; 
			
		return $fullName;
	}
}
