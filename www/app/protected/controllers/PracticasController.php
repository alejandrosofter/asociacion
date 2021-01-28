<?php

class PracticasController extends Controller
{
	public $layout='//layouts/column2';

	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	public function accessRules()
	{
		return array();
	}
	public function init()
	{
		$this->layout="//layouts/column1";
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

	public function actionCreate()
	{
		$model=new Practicas;

		if(isset($_POST['Practicas']))
		{
			$model->attributes=$_POST['Practicas'];
			if($model->save())
			$this->redirect(array('index','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		if(isset($_POST['Practicas']))
		{
			$model->attributes=$_POST['Practicas'];
			if($model->save())
			$this->redirect(array('index','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			$this->loadModel($id)->delete();

			if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
		throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	public function actionIndex()
	{
		$model=new Practicas('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Practicas']))
		$model->attributes=$_GET['Practicas'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	public function actionAdmin()
	{
		$model=new Practicas('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Practicas']))
		$model->attributes=$_GET['Practicas'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function loadModel($id)
	{
		$model=Practicas::model()->findByPk($id);
		if($model===null)
		throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='practicas-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
