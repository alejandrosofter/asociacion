<?php

class NotasCreditoController extends RController
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
	public function actionCargarAfip()
	{
		$res=NotasCredito::model()->ingresarNotaCreditoAfip($_GET['id']);
		if($res['error']) print_r($res);
		else $this->redirect(array('index'));
	}
	
	public function actionImprimir($id)
	{
		$this->layout='//layout/layoutSoloImpresion';
		$model=NotasCredito::model()->findByPk($id);
		$mPDF1 = Yii::app()->ePdf->mpdf();
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
		$mPDF1->AddPage('','','','','','','','','','','', 'myHeaderx', 'html_myHeader2x', '', '', 1, 1, 0, 0);
		$mPDF1->WriteHTML($this->renderPartial('/notasCredito/impresion',array('model'=>$model,'pdf'=>true),true));
		$mPDF1->WriteHTML($this->renderPartial('/notasCredito/impresion',array("duplicado"=>true,'model'=>$model,'pdf'=>true),true));
		$stylesheet = file_get_contents('css/impresion.css');
        $mPDF1->WriteHTML($stylesheet, 1);
        $mPDF1->Output();
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
		$model=new NotasCredito;
		//$this->layout="//layouts/column2admin";
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		
		if(isset($_POST['NotasCredito']))
		{
			
			$model->attributes=$_POST['NotasCredito'];

			if($model->save()){
				$this->redirect(array('index','id'=>$model->id));
			}
			// 	
		}
		if(isset($_GET['id'])) {
			$mFactura=FacturasObrasSocial::model()->findByPk($_GET['id']);
			$model->comprobanteAsociado=$_GET['id'];
			$model->importe=$mFactura->importe;
			$model->idObraSocial=$mFactura->idObraSocial;
			$model->fecha=Date("Y-m-d");
			if(isset($mFactura->facturaElectronica))
			$model->detalle="EN CONCEPTO DE NOTA DE CREDITO POR COMPROBANTE ".$mFactura->facturaElectronica->nroComprobante." - ".Yii::app()->dateFormatter->format("dd-MM-yyyy",$mFactura->facturaElectronica->fecha)." $ ".Yii::app()->numberFormatter->formatCurrency($mFactura->importe,"");
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

		if(isset($_POST['NotasCredito']))
		{
			$model->attributes=$_POST['NotasCredito'];
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

			$this->redirect("index.php?r=notasCredito");
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new NotasCredito('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['NotasCredito']))
			$model->attributes=$_GET['NotasCredito'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new NotasCredito('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['NotasCredito']))
			$model->attributes=$_GET['NotasCredito'];

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
		$model=NotasCredito::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='NotasCredito-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
