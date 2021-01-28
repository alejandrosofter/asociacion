<?php

class PagosItemsController extends RController
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
	public function actionripInfo()
	{
		$model=PagosItems::model()->todos();
		echo "RIPEANDO ITEMS: ".count($model); 
		for($i=0;$i<count($model);$i++){
			$idOs=$this->buscarOs($model[$i]->detalle);
			if($idOs){
				$model[$i]->idObraSocial=$idOs;
				$model[$i]->save();
			} else echo "NO ENCONTRE obra social con ".$model[$i]->detalle."<BR>";
		}
	}
	private function buscarOs($detalle)
	{
		$model=ObrasSociales::model()->todas();
		
		for($i=0;$i<count($model);$i++)
			if(strpos($detalle, $model[$i]->nombreOs)!==false)
				return $model[$i]->id;
		return false;
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
		$model=new PagosItems;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PagosItems']))
		{
			$model->attributes=$_POST['PagosItems'];
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

		if(isset($_POST['PagosItems']))
		{
			$model->attributes=$_POST['PagosItems'];
			if($model->save())
				$this->redirect(array('index','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	public function actionVer($id)
	{
		$model=new PagosItems;
		$model->idPago=$id;
		
		$this->render('/pagosItems/index',array(
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
		$pagoItem=$this->loadModel($id);
		
		$pago=Pagos::model()->findByPk($pagoItem->idPago);
		$pago->importe-=$pagoItem->importe;
		$pago->save();
		$pagoItem->delete();
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new PagosItems('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['PagosItems']))
			$model->attributes=$_GET['PagosItems'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new PagosItems('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['PagosItems']))
			$model->attributes=$_GET['PagosItems'];

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
		$model=PagosItems::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='pagos-items-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
