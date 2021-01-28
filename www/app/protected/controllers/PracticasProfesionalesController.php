<?php

class PracticasProfesionalesController extends Controller
{
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
		);
	}
	public function init()
	{
		$this->layout="//layouts/column1";
	}
	public function actionUltimas()
	{
		$ultimas=PracticasProfesionales::model()->ultimas(10);
		$this->renderPartial('ultimas',array('ultimas'=>$ultimas));
	}
	public function actionModificarEnLote()
	{
		
		$this->render('modificarEnLote',array());
	}
	public function actionModificarItemsLote()
	{
		if(isset($_GET['items']))
		foreach($_GET['items'] as $id){
			$model=PracticasProfesionales::model()->findByPk($id);
			$model->mes=$_GET['mes'];
			$model->ano=$_GET['ano'];
			$model->save();
		}
	}
	public function actionBuscarParaModificar()
	{
		$solo=isset($_GET['soloMias'])?true:false;
		$data=PracticasProfesionales::model()->buscarParaModificar($_GET['desdeMes'],$_GET['hastaAno'],$solo);
		$dat=$this->renderPartial("ultimas",array("ultimas"=>$data));
		echo $dat;
	}
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array();
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
		$model=new PracticasProfesionales;

		if(isset($_POST['PracticasProfesionales']))
		{
			$model->attributes=$_POST['PracticasProfesionales'];
			$model->ipCarga=PracticasProfesionales::model()->getIpCliente();
			if($model->save())
			{	$cargarOtro = isset($_POST['cargarOtro']);
			if ($cargarOtro) $this->redirect(array('create','idProfesional'=>$model->idProfesional,'cargarOtro'=>$cargarOtro,'idObraSocial'=>$model->idObraSocial,'mes'=>$model->mes,'ano'=>$model->ano));
			else $this->redirect(array('index','id'=>$model->id));
			}
		}
		$model->idProfesional = isset($_GET['idProfesional']) ? $_GET['idProfesional'] : null;
		$model->idObraSocial = isset($_GET['idObraSocial']) ? $_GET['idObraSocial'] : null;
		$model->mes = isset($_GET['mes']) ? $_GET['mes'] : (Date('m')*1);
		$model->ano = isset($_GET['ano']) ? $_GET['ano'] : (Date('Y')*1);
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

		if(isset($_POST['PracticasProfesionales']))
		{
			$model->attributes=$_POST['PracticasProfesionales'];
			$model->ipCarga=PracticasProfesionales::model()->getIpCliente();
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

	public function actionRipFechas()
	{
		$model=new PracticasProfesionales;
		$data=$model->findAll();
		echo count($data).' record';
		$query = "update practicas_profesionales set mes=MONTH(fecha), ano=YEAR(fecha)";
		$rows = Yii::app()->db->createCommand($query)->query();	
	}
	public function actionIndex()
	{
		$model=new PracticasProfesionales('search');
		$model->unsetAttributes();

		if(isset($_GET['PracticasProfesionales']))
		$model->attributes=$_GET['PracticasProfesionales'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new PracticasProfesionales('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['PracticasProfesionales']))
		$model->attributes=$_GET['PracticasProfesionales'];

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
		$model=PracticasProfesionales::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='practicas-profesionales-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
