<?php

class ComunicadosController extends RController
{
	public $pathImagenes="/../../archivos/comunicados/";
	public $widthImagen=500;
	public $widthImagenThum=80;

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
		$this->layout="//layouts/column2admin";
		$model=new Comunicados;
		$model->fecha=Date('Y-m-d');
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Comunicados']))
		{
			$model->attributes=$_POST['Comunicados'];
			if($model->save()){
				ComunicadosArchivos::model()->cargar(isset($_POST['imagenes'])?$_POST['imagenes']:array(),$model->id);
				if($model->enviaMail==1)$this->enviarMensajesSocios($model,isset($_POST['imagenes'])?$_POST['imagenes']:array());
				$this->redirect(array('index','id'=>$model->id));

			}
				
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	public function actionSubirImagenes()
	{
		$verifyToken = md5('unique_salt' . $_POST['timestamp']);

			$fileParts = pathinfo($_FILES['Filedata']['name']);

			$tempFile = $_FILES['Filedata']['tmp_name'];
			$targetPath = dirname(__FILE__). $this->pathImagenes;
			$nombre=microtime();
			$nombre=str_replace(' ','',$nombre);
			$nombre=str_replace('.','',$nombre);
			$nombreArchivo=$nombre.'.'. strtolower($fileParts['extension']);

			$targetFile = rtrim($targetPath,'/') . '/'.$nombreArchivo;
			move_uploaded_file($tempFile,$targetFile);
			echo $nombreArchivo;
		   		
		
	}
	private function enviarMensajesSocios($model,$archivos)
	{
		$socios=Proveedores::model()->findAll();
		$art=Articulos::model()->findByPk(3);
		$salida=$art->contenido;
		$params['cuerpo']=$model->mensaje;
		$params['titulo']='COMUNICADO';
		$params['fecha']=Date('d-m-Y');
		foreach($params as $campo=>$item)
			$salida = str_replace("%".$campo, $item,$salida);
		$mensaje=$salida;
		foreach($socios as $socio)Emails::model()->enviarMail($socio->email,$mensaje,'NUEVO COMUNICADO','asoc.australdeoftalmologia@gmail.com',$archivos);

	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$this->layout="//layouts/column2admin";
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Comunicados']))
		{
			$model->attributes=$_POST['Comunicados'];
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
		
			$this->loadModel($id)->delete();

				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->layout="//layouts/column2admin";
		$model=new Comunicados('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Comunicados']))
			$model->attributes=$_GET['Comunicados'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Comunicados('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Comunicados']))
			$model->attributes=$_GET['Comunicados'];

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
		$model=Comunicados::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='comunicados-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
