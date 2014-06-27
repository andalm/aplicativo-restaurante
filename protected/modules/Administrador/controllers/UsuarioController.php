<?php

class UsuarioController extends Controller
{
	protected $log = NULL;
	
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'create','update', 'index','view'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->log->attributes = array(
			'actividad' => 'Detalle usuario # ' . $id,
			'idUsuario' => Yii::app()->user->id,
		);
		
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Usuario;
		$perfiles = Perfil::model()->findAll();

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Usuario']))
		{
			$model->attributes = $_POST['Usuario'];
			$model->nombreUsuario = strtolower($_POST['Usuario']['nombreUsuario']);
			$model->estado = 1;
				
			if($model->validate())
			{
				$model->contrasena = 
					crypt($_POST['Usuario']['contrasena'], $_POST['Usuario']['contrasena'] . Yii::app()->params['salt']);
				
				$this->log->attributes = array(
					'actividad' => 'Creacion de nuevo usuario',
					'idUsuario' => Yii::app()->user->id,
				);
				
				$model->save();
				if($this->log->validate())
					$this->log->save();
				
				$this->redirect(array('view','id'=>$model->id));
			}
		}
		
		$model->contrasena = "";

		$this->render('create',array(
			'model'=>$model,
			'perfiles' => $perfiles,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$perfiles = Perfil::model()->findAll();

		$model->nombreUsuario = strtolower($model->nombreUsuario);
		$model->contrasena = '';
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Usuario']))
		{
			$model->attributes = $_POST['Usuario'];
							
			if($model->validate())
			{
				$model->contrasena = 
					crypt($_POST['Usuario']['contrasena'], $model->contrasena . Yii::app()->params['salt']);
					
				$this->log->attributes = array(
					'actividad' => 'Modificacion de usuario # ' . $id,
					'idUsuario' => Yii::app()->user->id,
				);
				
				$model->save();
				
				if($this->log->validate())
					$this->log->save();
					
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('update',array(
			'model' => $model,
			'perfiles' => $perfiles,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$usuario = $this->loadModel($id);
		
		$usuario->estado = 2;
		
		if($usuario->validate())
		{
			$this->log->attributes = array(
				'actividad' => 'Deshabilitacion de usuario # ' . $id,
				'idUsuario' => Yii::app()->user->id,
			);
				
			$this->log->save();
			
			$usuario->save();
		}
			
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->log->attributes = array(
			'actividad' => 'Acceso lista de usuarios',
			'idUsuario' => Yii::app()->user->id,
		);
		
		//get criteria
		$criteria = new CDbCriteria();
		$criteria->condition = 't.estado = 1';
		$criteria->order = 't.nombres asc';
		$criteria->order = 't.apellidos asc';
		 
		//get count
		$count = Usuario::model()->count($criteria);
		
		//pagination
		$pages = new CPagination($count);
		$pages->setPageSize(4);
		$pages->applyLimit($criteria);
		
		//result to show on page
		$result = Usuario::model()->with(array(
				'idPerfil0' => array(
					'alias' => 'pe',
					'joinType' => 'left JOIN',
					'on' => 'pe.id = t.idPerfil',
				),
			)
		)->findAll($criteria);
		
		$dataProvider = new CArrayDataProvider($result);
		
		//CVarDumper::dump($result);
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			'pages' => $pages
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$this->log->attributes = array(
			'actividad' => 'Acceso a gestion de usuarios',
			'idUsuario' => Yii::app()->user->id,
		);
		
		$model=new Usuario('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Usuario']))
			$model->attributes=$_GET['Usuario'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Usuario the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Usuario::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Usuario $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='usuario-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	protected function beforeAction($action) 
	{          
		if($this->log === NULL)
			$this->log = new Log;
			
        return parent::beforeAction($action);
    }
	
	protected function afterAction($action) 
	{ 
		if($this->log->validate())
			$this->log->save();
			
		return parent::beforeAction($action);
    }
}