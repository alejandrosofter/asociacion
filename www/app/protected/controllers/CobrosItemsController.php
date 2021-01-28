<?php

class CobrosItemsController extends RController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.getPend
	 
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
		public function actionGetUnico($id)
	{
		$model=CobrosItems::model()->findByPk($id);
		
		echo CJSON::encode($model);
	}
	public function actionModificar($id,$importe,$detalle,$idTipo)
	{
		$model=CobrosItems::model()->findByPk($id);
		$model->idTipoItem=$idTipo;
		$model->importe=$importe;
		$model->detalle=$detalle;
		echo CJSON::encode($model->save());
	}
	public function actionAgregarItem($importe,$detalle,$idTipo,$idProfesional)
	{
		$model=new CobrosItems();
		$model->idTipoItem=$idTipo;
		if($idTipo==22 || $idTipo==42 || $idTipo==122)$importe=-$importe;
		$model->importe=$importe;
		$model->detalle=$detalle;
		$model->estado="PENDIENTE";
		$model->idProfesional=$idProfesional;
		$model->idCobro=$this->getIdCobroPendiente();
		
		echo CJSON::encode($model->save());
	}
	private function getIdCobroPendiente()
	{
		$pendientes=Cobros::model()->getPendientes();
		if(count($pendientes)>0){
			$cobro=$pendientes[0];
			return $cobro->id;
		}
		return -1;
	}
	public function init()
	{
		$this->layout="//layouts/column1";
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
		$model=new CobrosItems;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['CobrosItems']))
		{
			$model->attributes=$_POST['CobrosItems'];
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

		if(isset($_POST['CobrosItems']))
		{
			$model->attributes=$_POST['CobrosItems'];
			if($model->save())
				$this->redirect(array('index','id'=>$model->idCobro));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	public function actionAgregar()
	{
		$model=new CobrosItems;
		$model->idProfesional=$_GET['idProfesional'];
		$model->detalle=$_GET['detalle'];
		$model->idTipoItem=$_GET['idTipoItem'];
		$model->estado='PENDIENTE';
		$model->idCobro=$_GET['idCobro'];
		$model->importe=$_GET['importe'];
		$model->save();
	}
		public function actionQuitar($id)
	{
		$model=CobrosItems::model()->findByPk($id);
	return $model->delete();
	}
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
		$model=new CobrosItems('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CobrosItems']))
			$model->attributes=$_GET['CobrosItems'];
		$model->idCobro=$_GET['id'];
		$this->render('index',array(
			'model'=>$model,"idCobro"=>$_GET['id']
		));
	}
	public function actionRenombrar($id)
	{
		$model=Cobros::model()->findByPk($id);
		foreach($model->cobrosItems as $item){
			$item->detalle=$item->tipo->nombreTipoCobro.' '.$model->obraSocial->nombreOs;
			$item->save();
		}
		$this->redirect(array('/cobros/index'));

	}
	public function actionModificarItem($id,$campo,$value)
	{
		$model=CobrosItems::model()->findByPk($id);
		$model->$campo=$value;
		if(!$model->save()){
			echo 'salva'.$model->$campo;
		}
		if($campo=='importe'){
			$cobro=Cobros::model()->findByPk($model->idCobro);
			$cobro->updateImporte();
		}
	}
	public function actionGetPendientes()
	{
		$model=CobrosItems::model()->getPendientes();
		$sal=array();
		foreach($model as $item){
			$aux['idProfesional']=$item->idProfesional;
			$aux['profesional']=isset($item->profesional)?$item->profesional->nombreProfesionales:"Sin Profesional";
			$aux['debitos']=$item->debitos;
			$aux['creditos']=$item->creditos;
			$aux['condicionIva']=isset($item->profesional)?$item->profesional->condicionIva->nombreIva:"Sin Profesional";
			$aux['regimen']=isset($item->profesional)?$item->profesional->regimen:"Sin Profesional";
			$aux['id']=$item->id;
			$sal[]=$aux;
		}
		echo CJSON::encode($sal);
	}
	public function actionAdmin()
	{
		$model=new CobrosItems('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CobrosItems']))
			$model->attributes=$_GET['CobrosItems'];

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
		$model=CobrosItems::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='cobros-items-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
