<?php

class DefaultController extends Controller
{
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
				'actions'=>array('index'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function actionIndex()
	{
		$detect = Yii::app()->mobileDetect;
		
		if ($detect->isMobile() && !Yii::app()->request->isAjaxRequest)
        {
            echo $this->renderPartial('index', array());
            Yii::app()->end();
        }
        else
        {
            throw new CHttpException(404, 'Página no encontrada.');
        }
    }
}