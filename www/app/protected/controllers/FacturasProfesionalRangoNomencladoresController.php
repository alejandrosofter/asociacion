<?php

class FacturasProfesionalRangoNomencladoresController extends RController
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

	public function actionRecalculaImporte()
	{

		$data=FacturasProfesional::model()->buscarPendientesRango($_GET['id']);
		$this->render('recalcularImporte',array("idRangoNuevo"=>$_GET['id'],
			'model'=>$data,
		));
	}
	public function nuevoImporte($datos,$idRango)
	{
		$nuevo=0;
		if(isset($datos->nomenclador)){
			$codigo=$datos->nomenclador->codigoInterno;
			$nuevo= FacturasProfesionalNomencladores::model()->buscarNuevoImporte($codigo,$idRango);
		}
		
		if($datos->esDoble)$nuevo=$nuevo*2;
		if($datos->es50)$nuevo=$nuevo/1.5;
		if($datos->es75)$nuevo=$nuevo/1.75;
		return $nuevo;
	}
	public function actionCreate()
	{
		$model=new FacturasProfesionalRangoNomencladores;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['FacturasProfesionalRangoNomencladores']))
		{
			$model->attributes=$_POST['FacturasProfesionalRangoNomencladores'];
			if($model->save())
				$this->redirect(array('/facturasProfesionalNomencladores/index'));
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

		if(isset($_POST['FacturasProfesionalRangoNomencladores']))
		{
			$model->attributes=$_POST['FacturasProfesionalRangoNomencladores'];
			if($model->save())
				$this->redirect(array('index'));
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
		$model=new FacturasProfesionalRangoNomencladores('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['FacturasProfesionalRangoNomencladores']))
			$model->attributes=$_GET['FacturasProfesionalRangoNomencladores'];

		$this->render('index',array( 'model'=>$model));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new FacturasProfesionalRangoNomencladores('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['FacturasProfesionalRangoNomencladores']))
			$model->attributes=$_GET['FacturasProfesionalRangoNomencladores'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	public function actiongetRangos()
	{
		echo CJSON::encode(FacturasProfesionalRangoNomencladores::model()->buscar($_GET['idObraSocial']));
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=FacturasProfesionalRangoNomencladores::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='facturas-profesional-rango-nomencladores-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
