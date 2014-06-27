<?php

class PedidoController extends Controller
{
	const PEDIDO_ERROR = 0;
	const PEDIDO_SUCESS = 1;
	const PEDIDO_DISPATCHED = 2;
	
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','view', 'create','update','admin', 'list', 'anular'),
				'users'=>array('@'),
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
		$detect = Yii::app()->mobileDetect;
		
		if($detect->isMobile() && !Yii::app()->request->isAjaxRequest)
		{
			$model = new Pedido;
			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model); 
			
			if(isset($_POST['Pedido']))
			{
				$model->attributes = $_POST['Pedido'];
				$model->tiempoInicio = date('Y-m-d H:i:s');
				$model->idUsuario = Yii::app()->user->id;
				
				if($model->validate())
				{
					$model->save();
					$response = array();
					
					foreach($_POST['PedidoDetalle'] as $detalle)
					{
						foreach($detalle['idProducto'] as $key => $producto)
						{
							if(!empty($producto) && isset($detalle['cantidad'][$key]) && $detalle['cantidad'][$key] != 0)
							{
								$consultaProducto = Producto::model()->findByPk($producto);
								$pedidoDetalle = new PedidoDetalle();
								$pedidoDetalle->attributes = array(
									'idProducto' => $producto,
                                                                        'observaciones' => $detalle['observaciones'][$key],
									'cantidad' => $detalle['cantidad'][$key],
									'valorUnitario' => (double)$consultaProducto->getPricePlain(),
									'total' => (double)$consultaProducto->getPricePlain() * (int)$detalle['cantidad'][$key],
									'idPedido' => $model->id,
								);
								$model->total += $pedidoDetalle->total;
																
								if(!$pedidoDetalle->validate())
								{
									$model->delete();
									$response = array(
										'cod' => self::PEDIDO_ERROR,
										'msg' => "Hay error en los items, por favor verifique.",
									);
									break;
								}
								else
                                                                {
                                                                    $pedidoDetalle->save();
                                                                }
									
							}
						}
					}
					
					if($model->total != 0)
					{
						$model->update();
					
						if(count($response) == 0)
							$response = array( 
								'cod' => self::PEDIDO_SUCESS,
								'msg' => "Pedido No. ".$model->id." guardado exitosamente.\nValor total: $".Yii::app()->format->number(
									$model->total
								),
							);
					}
					else
						$response = array(
							'cod' => self::PEDIDO_ERROR,
							'msg' => "Hay errores en el pedido, por favor verifique.",
						);
				}
				else
					$response = array(
						'cod' => self::PEDIDO_ERROR,
						'msg' => "Hay errores en el pedido, por favor verifique.",
					);
					
				echo CJSON::encode($response);
			}
			else
			{
				$model->pedidoDetalles = array(new PedidoDetalle);
				$model->idMesa0 = new Mesa;
				
				$productosTipo = ProductoTipo::model()->with(array(
						'productos' => array(
							'alias' => 'p',
							'joinType' => 'LEFT JOIN',
							'on' => 'p.ProductoTipoId = t.id and p.estado = 1',
						),
					)
				)->findAll();
			
				$mesas = Mesa::model()->findAll();
				
				echo $this->renderPartial('create',array(
					'model'=>$model,
					'productosTipo'=>$productosTipo,
					'mesas'=>$mesas,
				));
			}
			
			Yii::app()->end();
		}
		else
			throw new CHttpException(404,'Página no encontrada.');
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
            $detect = Yii::app()->mobileDetect;
            
            if($detect->isMobile() && !Yii::app()->request->isAjaxRequest)
            {
                $model = $this->loadModel($id);
                
                // Uncomment the following line if AJAX validation is needed
                // $this->performAjaxValidation($model);

                if(isset($_POST['Pedido']))
                {
                    if($model->validate())
                    {
                        PedidoDetalle::model()->deleteAll(
                            'idPedido = :idPedido',
                            array(':idPedido' => $model->id)
                        );

                        $response = array();

                        foreach($_POST['PedidoDetalle'] as $detalle)
                        {
                            foreach($detalle['idProducto'] as $key => $producto)
                            {
                                if(!empty($producto) && isset($detalle['cantidad'][$key]) && $detalle['cantidad'][$key] != 0)
                                {
                                    $consultaProducto = Producto::model()->findByPk($producto);
                                    $pedidoDetalle = new PedidoDetalle();
                                    $pedidoDetalle->attributes = array(
                                            'idProducto' => $producto,
                                            'cantidad' => $detalle['cantidad'][$key],
                                            'observaciones' => $detalle['observaciones'][$key],
                                            'valorUnitario' => (double)$consultaProducto->getPricePlain(),
                                            'total' => (double)$consultaProducto->getPricePlain() * (int)$detalle['cantidad'][$key],
                                            'idPedido' => $model->id,
                                    );                                    
                                    $model->total += $pedidoDetalle->total;

                                    if(!$pedidoDetalle->validate())
                                    {
                                        $model->delete();
                                        $response = array(
                                            'cod' => self::PEDIDO_ERROR,
                                            'msg' => "Hay error en los items, por favor verifique.",
                                        );
                                        break;
                                    }
                                    else
                                    {
                                        $pedidoDetalle->save();
                                    }                                            
                                }
                            }
                        }

                        if($model->total != 0)
                        {
                            $model->update();

                            if(count($response) == 0)
                            {
                                $response = array( 
                                    'cod' => self::PEDIDO_SUCESS,
                                    'msg' => "Pedido No. " . 
                                            $model->id . 
                                            " modficado exitosamente.\nValor total: $" . 
                                            Yii::app()->format->number($model->total),
                                );
                            }                                   
                        }
                        else
                        {
                           $response = array(
                                'cod' => self::PEDIDO_ERROR,
                                'msg' => "Hay errores en el pedido, por favor verifique.",
                            ); 
                        }                               
                    }
                    else
                    {
                       $response = array(
                            'cod' => self::PEDIDO_ERROR,
                            'msg' => "Hay errores en el pedido, por favor verifique.",
                        ); 
                    }
                    
                    echo CJSON::encode($response);
                }
                else
                {
                    $productosTipo = ProductoTipo::model()->with(
                        array(
                            'productos' => array(
                                'alias' => 'p',
                                'joinType' => 'LEFT JOIN',
                                'on' => 'p.ProductoTipoId = t.id and p.estado = 1',
                            ),
                        )
                    )->findAll();

                    $mesas = Mesa::model()->findAll();

                    echo $this->renderPartial('update', array(
                        'model' => $model,
                        'productosTipo' => $productosTipo,
                        'mesas' => $mesas,
                    ));
                }

                Yii::app()->end();
            }
            else
            {
                throw new CHttpException(404,'Página no encontrada.');
            }               
        }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Pedido the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model = Pedido::model()->find(array(
			'condition' => 'id = :id and estado = :estado and idUsuario = :usuario',
			'params' => array(':id' => $id, ':estado' => Pedido::ENVIADO, ':usuario' => Yii::app()->user->id)
		));
		
		if($model===null)
                {
                    throw new CHttpException(404,'The requested page does not exist.');
                }
                
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Pedido $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='pedido-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionList()
	{
            $detect = Yii::app()->mobileDetect;
            
            if($detect->isMobile() && !Yii::app()->request->isAjaxRequest)
            {
		$model = Pedido::model()->findAll(array(
			'condition' => 'estado = :estado and idUsuario = :usuario',
			'params' => array(':estado' => Pedido::ENVIADO, ':usuario' => Yii::app()->user->id)
		));
		
		echo $this->renderPartial('list',array(
			'model' => $model,
		));
            }
            
            Yii::app()->end();
	}
        
        /**
         * Anula pediddos por el id
         * 
         * @param integer $id
         */
        public function actionAnular($id)
        {
            $detect = Yii::app()->mobileDetect;
            
            if($detect->isMobile() && !Yii::app()->request->isAjaxRequest)
            {
                $model = $this->loadModel($id);
                $model->estado = Pedido::CANCELADO;
                $model->tiempoFinal = date('Y-m-d H:i:s');
                
                if($model->validate())
                    $model->update(array(
                        'estado',
                        'tiempoFinal'
                    ));

                $model = Pedido::model()->findAll(array(
                            'condition' => 'estado = :estado and idUsuario = :usuario',
                            'params' => array(':estado' => Pedido::ENVIADO, ':usuario' => Yii::app()->user->id)
                    ));

                echo $this->renderPartial('list',array(
                        'model' => $model,
                ));
            }
            
            Yii::app()->end();
        }
}
