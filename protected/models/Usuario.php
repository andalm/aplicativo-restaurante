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
 * @property integer $perfilId
 * @property string $nombreUsuario
 * @property string $contrasena
 * @property integer $estado
 * @property integer $sucursalId
 *
 * The followings are the available model relations:
 * @property Log[] $logs
 * @property Pedido[] $pedidos
 * @property Perfil $perfil
 * @property Sucursal $sucursal
 */
class Usuario extends CActiveRecord
{
        /**
         * @var integer usuarios activos 
         */
        const HABILITADO = 1;

        /**
         * @var integer usuarios inactivos (eliminados)
         */
        const DESHABILITADO = 0;
        
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
			array('nombres, perfilId, nombreUsuario, contrasena, sucursalId', 'required'),
			array('perfilId, estado, sucursalId', 'numerical', 'integerOnly'=>true),
			array('nombres, apellidos, documento, telefono, movil, nombreUsuario, contrasena', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombres, apellidos, documento, telefono, movil, perfilId, nombreUsuario, contrasena, estado, sucursalId', 'safe', 'on'=>'search'),
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
			'logs' => array(self::HAS_MANY, 'Log', 'usuarioId'),
			'pedidos' => array(self::HAS_MANY, 'Pedido', 'usuarioId'),
			'perfil' => array(self::BELONGS_TO, 'Perfil', 'perfilId'),
			'sucursal' => array(self::BELONGS_TO, 'Sucursal', 'sucursalId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombres' => 'Nombre del usuario',
			'apellidos' => 'Apellido del usuario',
			'documento' => 'Documento de indentidad del usuario',
			'telefono' => 'Telefono/s fijo del usuario',
			'movil' => 'Numero/s movil del usuario',
			'perfilId' => 'Perfil del usuario en el sistema',
			'nombreUsuario' => 'Nombre de usuario (para autentificacion en el sistema)',
			'contrasena' => 'Contraseña para autentificacion en el sistema',
			'estado' => 'Estado actual del usuario. 1: Habilitado, 0: Deshabilitado',
			'sucursalId' => 'Sucursal a la que pertenece el usuario',
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
		$criteria->compare('perfilId',$this->perfilId);
		$criteria->compare('nombreUsuario',$this->nombreUsuario,true);
		$criteria->compare('contrasena',$this->contrasena,true);
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
	 * @return Usuario the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function init()
        {
            if($this->isNewRecord)
            {
                $this->pedidos = array(new Pedido());
                $this->prefil = new Perfil();
                $this->sucursal = new Sucursal();
                $this->logs = array(new Log());
            }        
        }
        
        public function getfullName()
        {
            return $this->nombres . " " . $this->apellidos;
        }
}
