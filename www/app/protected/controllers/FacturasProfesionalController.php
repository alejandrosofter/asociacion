<?php

class FacturasProfesionalController extends RController
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
	public function actionmodificarFacturas()
	{
		$facts=$_GET['facturas'];
		foreach($facts as $item){
			$factura=FacturasProfesional::model()->findByPk($item['idFactura']);
			$factura->importe=$item['importeNuevo'];
			$factura->save();
		}
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
	public function actionGetDatosFactura()
	{
		$model=FacturasProfesional::model()->findByPk($_GET['idFactura']);
		echo CJSON::encode($model);
	}
	public function actionInforme()
	{
		$this->render('informe');
	}
	public function actionExportar()
	{
		$this->render('exportar');
	}
	public function actionInforme_()
	{
		$data=FacturasProfesional::model()->informe($_GET);
		$this->renderPartial('_informe',array("data"=>$data,"idObraSocial"=>$_GET['idObraSocial'],"idProfesional"=>isset($_GET['idProfesional'])?$_GET['idProfesional']:0,"fechaDesde"=>$_GET['fechaDesde'],"fechaHasta"=>$_GET['fechaHasta']));
	}
	
	
	public function actionQuitarFactura()
	{
		$model=FacturasProfesional::model()->findByPk($_GET['idFactura']);
		$model->delete();
	}
	public function actionUltimas()
	{
		$ultimas=FacturasProfesional::model()->ultimas($_GET['idObraSocial'],$_GET['cantidad']);
		$this->renderPartial('_ultimas',array('ultimas'=>$ultimas));
	}
	public function actionGetItems($idObraSocial,$refacturado)
	{
		$arr=array();
		$refactura=$refacturado=="true"?true:false;
		$items=FacturasProfesional::model()->getItems($idObraSocial,$refactura);
		$arr['vista']=$this->renderPartial('_items',array('items'=>$items),true);
		$arr['items']=$items;
		$arr['importe']=$this->getImporte($items);
		echo CJSON::encode($arr);
	}
	private function getImporte($items)
	{
		$imp=0;
		foreach($items as $it) $imp+=$it->importe;
		return $imp;
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
		$model=new FacturasProfesional;
		$model->fecha=Date('Y-m-d');
		
		$model->ipCarga=$_SERVER['SERVER_ADDR'];
		$model->estado="PENDIENTE";
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_GET['id'])){
			$ultimo=FacturasProfesional::model()->findByPk($_GET['id']);
			$model->idProfesional=$ultimo->idProfesional;
			$model->idObraSocial=$ultimo->idObraSocial;
			$model->estado=$ultimo->estado;
			$model->fecha=$ultimo->fecha;
		}
		if(isset($_POST['FacturasProfesional']))
		{
			$model->attributes=$_POST['FacturasProfesional'];
			if($model->save()){
				if(isset($_POST['nuevaCarga']))
					$this->redirect(array('create','id'=>$model->id));
					else $this->redirect(array('index','id'=>$model->id));
			}else print_r($model->getErrors());
			
				
		}
		
		$_POST['nuevaCarga']=true;
		$this->render('create',array(
			'model'=>$model,
		));
	}
	private function getUltimo()
	{
		$criteria=new CDbCriteria;
		$criteria->order='t.id desc';
		$criteria->limit=1;
		$mod=FacturasProfesional::model()->findAll($criteria);
		if(count($mod)==0)return null;
		return $mod[0];
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

		if(isset($_POST['FacturasProfesional']))
		{
			$model->attributes=$_POST['FacturasProfesional'];
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
		$model=$this->loadModel($id);
		$res=true;
		try{
			$model->delete();
		}catch (Exception $exception){
			$res=false;
		}
		echo CJSON::encode($res);
		
		// $model=FacturasProfesional::model()->findByPk($_GET['id']);
		// $model->delete();
			
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new FacturasProfesional('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['FacturasProfesional']))
			$model->attributes=$_GET['FacturasProfesional'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new FacturasProfesional('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['FacturasProfesional']))
			$model->attributes=$_GET['FacturasProfesional'];

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
		$model=FacturasProfesional::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='facturas-profesional-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
