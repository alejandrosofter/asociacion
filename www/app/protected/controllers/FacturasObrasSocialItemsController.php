<?php

class FacturasObrasSocialItemsController extends RController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/main';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}
	public function init()
	{
		$this->layout="//layouts/column1";
	}
	public function actionGetPendientes($idFactura)
	{
		$criteria=new CDbCriteria;
		$factura=FacturasObrasSocial::model()->findByPk($idFactura);
		$criteria->compare('idFacturaObraSocial',$idFactura,false);
		$items=FacturasObrasSocialItems::model()->findAll($criteria);
		if($idFactura=='')return;
		foreach($items as $item){
			$data['profesional']=$item->facturaProfesional->profesional->apellido.' '.$item->facturaProfesional->profesional->nombre;
			$data['importe']=$item->facturaProfesional->importe;
			$data['estado']=CobrosItems::PENDIENTE;
			$data['idTipo']=isset($factura->idCobroTipo)?$factura->idCobroTipo:1;
			$data['tipo']=isset($factura->idCobroTipo)?$factura->tipoCobro->nombreTipoCobro:'-';
			$data['idProfesional']=$item->facturaProfesional->idProfesional;
			$arr[]=$data;
		}
		echo CJSON::encode($arr);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
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
		$model=new FacturasObrasSocialItems;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['FacturasObrasSocialItems']))
		{
			$model->attributes=$_POST['FacturasObrasSocialItems'];
			if($model->save())
				$this->redirect(array('index','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['FacturasObrasSocialItems']))
		{
			$model->attributes=$_POST['FacturasObrasSocialItems'];
			if($model->save())
				$this->redirect(array('index','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();
			
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new FacturasObrasSocialItems('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['FacturasObrasSocialItems']))
			$model->attributes=$_GET['FacturasObrasSocialItems'];
		if(isset($_GET['idFactura']))$model->idFacturaObraSocial=$_GET['idFactura'];
		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new FacturasObrasSocialItems('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['FacturasObrasSocialItems']))
			$model->attributes=$_GET['FacturasObrasSocialItems'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=FacturasObrasSocialItems::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='facturas-obras-social-items-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
