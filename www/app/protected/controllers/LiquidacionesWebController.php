<?php

class LiquidacionesWebController extends RController
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
public function actionCambiarEstado()
	{
		$model=LiquidacionesWeb::model()->findByPk($_GET['id']);
		if($model->estado=="PENDIENTE")$model->estado="CANCELADO";else $model->estado="PENDIENTE";
		$model->save();
		echo $model->estado;
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
		$model=new LiquidacionesWeb;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['LiquidacionesWeb']))
		{
			$model->attributes=$_POST['LiquidacionesWeb'];
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

		if(isset($_POST['LiquidacionesWeb']))
		{
			$model->attributes=$_POST['LiquidacionesWeb'];
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
	private function getArrAgrupado($arr,$campo)
	{
		$group = array();
		foreach ( $arr as $value ) 
   		 $group[$value['factura'][$campo]][] = $value;
   		return $group;


	}
	public function actionImprimir()
	{
		$this->layout='//layout/layoutSoloImpresion';
		$model=LiquidacionesWeb::model()->findByPk($_GET['id']);

		$mPDF1 = Yii::app()->ePdf->mpdf();
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
        $items=$this->getArrAgrupado($model->facturas,"idObraSocial");
        foreach($items as $key=>$item){
        		
        		$os=ObrasSociales::model()->findByPk($key);
        		
			$mPDF1->AddPage('','','','','','','','','','','', 'myHeaderx', 'html_myHeader2x', '', '', 1, 1, 0, 0);
			$contenido=$this->renderPartial('resumenFacturas',array('model'=>$model,"os"=>$os->nombreOs,'items'=>$item),true);
			$mPDF1->WriteHTML($contenido);
		}

		$stylesheet = file_get_contents('css/impresion.css');
        $mPDF1->WriteHTML($stylesheet, 1);
        $mPDF1->Output();
	}
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST requesthugo
			$model=$this->loadModel($id);
			$model->quitarFacturas();
			$model->delete();

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
		$model=new LiquidacionesWeb('search');
		$model->estado="PENDIENTE";  // clear any default values
		if(isset($_GET['LiquidacionesWeb'])) $model->attributes=$_GET['LiquidacionesWeb'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	public function agrupadoOs($model)
	{
		$group=array();
		foreach ($model as $key => $liquidacion) 
			foreach ($liquidacion->facturas as $itemFactura) 
			 $group[$itemFactura->factura->idObraSocial][] = $itemFactura->factura;
			
		return $group;
	}
	public function getImporte($items)
	{
		$sum=0;
		foreach ($items as $key => $value) $sum+=$value->importe;
		return $sum;
	}
	private function agrupadoProfesional($arr)
	{
		$group = array();
		foreach ( $arr as $value ) 
   		 $group[$value['idProfesional']][] = $value;
   		return $group;


	}
	private function getImporteProfesional($arr)
	{
		$sum=0;
		foreach ($arr as $key => $value) $sum+=$value->importe;
		return number_format($sum,2);
	}
	public function getDetalle($items)
	{
		$cad="";
		$agrupado=$this->agrupadoProfesional($items);
		foreach ($agrupado as $key => $value) 
			$cad.=Profesionales::model()->findByPk($key)->nombreProfesionales." <b>$".$this->getImporteProfesional($value)." </b>| " ;
		
		return $cad;
	}
	public function actionFacturarPendientes()
	{
		$model=LiquidacionesWeb::model()->getPendientes();
		$groupOs=$this->agrupadoOs($model);
		$this->render('facturarPendientes',array(
			'items'=>$groupOs,
		));
	}
	public function actionVerFacturas()
	{
		$model=new LiquidacionesWeb_facturas();
		$model->unsetAttributes();  // clear any default values
		
		$this->render('verFacturas',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new LiquidacionesWeb('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['LiquidacionesWeb']))
			$model->attributes=$_GET['LiquidacionesWeb'];

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
		$model=LiquidacionesWeb::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='liquidaciones-web-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
