<?php

class SiteController extends Controller
{
	protected $log = NULL;
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$model = new LoginForm;
		
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		
		$this->render('index', array(
			'model' => $model,
		));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$detect = Yii::app()->mobileDetect;
		$model = new LoginForm;
		
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes = $_POST['LoginForm'];
			$model->username = strtolower($_POST['LoginForm']['username']);
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
			{
				if(Yii::app()->user->getState('idPerfil') == 1 || 
				   Yii::app()->user->getState('idPerfil') == 2)
				{
					$log->attributes = array(
						'actividad' => 'Inicio de sesion (Movil: ' . $detect->isMobile() . ')',
						'idUsuario' => Yii::app()->user->getId(),
					);			
				}
				else
				{
					Yii::app()->user->logout();
					throw new CHttpException(404,'Perfil no identificado.');
				}
			}
		}
		else
			Yii::app()->user->logout();
			
		if($detect->isMobile() && !Yii::app()->request->isAjaxRequest)
		{
			if(!Yii::app()->user->isGuest)
				echo $this->renderPartial('application.modules.Mesero.views.default.index', array());
			else
				throw new CHttpException(403,'Perfil no identificado.');
			
			Yii::app()->end();
		}
		else
			$this->render('index', array(
				'model' => $model,
			));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		$detect = Yii::app()->mobileDetect;
		
		$this->log->attributes = array(
			'actividad' => 'Fin de sesion',
			'idUsuario' => Yii::app()->user->id,
		);
			
		Yii::app()->user->logout();
		
		if($detect->isMobile() && !Yii::app()->request->isAjaxRequest)
		{
			echo "Log Out";
			Yii::app()->end();
		}
		else
			$this->redirect(Yii::app()->homeUrl);
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