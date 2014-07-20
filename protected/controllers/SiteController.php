<?php

class SiteController extends Controller
{
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
                if(!$model->validate() && !$model->login())
                {
                    Yii::app()->user->logout();
                }
            }
            
            $this->respuestaMovil();            
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
            
            $log = new Log();
            $log->attributes = [
                'actividad' => 'Salida de la aplicación',
                'usuarioId' => Yii::app()->user->id,
            ];
            $log->save();
            
            Yii::app()->user->logout();
            
            if($detect->isMobile())
            {
                Yii::app()->end();
            }
            else
            {
                $this->redirect(Yii::app()->homeUrl);
            }
	}
        
        public function respuestaMovil()
        {
            $detect = Yii::app()->mobileDetect;
           
            if($detect->isMobile())
            {
                if(!Yii::app()->user->isGuest)
                {
                    $this->renderPartial(
                        'application.modules.Mesero.views.default.index', 
                        array()
                    );
                }
                else
                {
                    throw new CHttpException(403,'No autorizado.');
                }
                
                Yii::app()->end();
            }
        }
}
