<?php

class LiquidacionesController extends RController
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
	
	function my_sort_function($a, $b)
	{
			return $a->profesional->apellido < $b->profesional->apellido;
	}
	
	public function actionMails($id)
	{
		$this->layout='//layout/layoutSoloImpresion';
		$this->render('mails',array());
	}
		public function actionPagos($id)
	{
		$arr=array();
		$salida=Liquidaciones::model()->pagos($id);
		foreach($salida as $it){
			$sal['profesional']=$it->profesional;
			$sal['id']=$it->id;
			$arr[]=$sal;
		}
		echo CJSON::encode($arr);
	}
	public function actionExportar()
	{
		$this->layout='//layout/layoutSoloImpresion';

			$mPDF1 = Yii::app()->ePdf->mpdf();
        	$mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
        	$fact=Liquidaciones::model()->findByPk($_GET['id']);
        	$pagos=Liquidaciones::model()->pagos($_GET['id']);
        	$cobros=Liquidaciones::model()->cobros($_GET['id']);
        	@usort($pagos,function($a, $b) { return $a->profesional->apellido > $b->profesional->apellido; });
          //////////////************************/***//


		if(isset($_GET['retencion']))
        	{
        		//************************ IMPRIMO PAGOS **************************************//
        	$mPDF1->AddPage('L');
        	$mPDF1->Bookmark("RESUMEN PAGOS",0);
			$mPDF1->WriteHTML($this->renderPartial('/pagos/imprimirResumenPagos_',array('model'=>$fact,'pagos'=>$pagos),true));
			//*************************
        		foreach($pagos as $fact){
				$mPDF1->AddPage('','','','','','','','','','','', 'myHeaderx', 'html_myHeader2x', '', '', 1, 1, 0, 0);
				$mPDF1->Bookmark('--->RETENCION',0);
				$mPDF1->WriteHTML($this->renderPartial('/pagos/imprimirRetencion',array('model'=>$fact,'pdf'=>true),true));
				
        	}
        	}else{

        	//************************ IMPRIMO COBROS **************************************//
        	$mPDF1->AddPage('','','','','','','','','','','', 'myHeaderx', 'html_myHeader2x', '', '', 1, 1, 0, 0);
        	$mPDF1->Bookmark("COBROS ASOCIADOS",0);
			$mPDF1->WriteHTML($this->renderPartial('/cobros/imprimirCobros',array('model'=>$fact,'cobros'=>$cobros),true));
			//*************************          //////////////************************/***//

        	//************************ IMPRIMO PAGOS **************************************//
        	$mPDF1->AddPage('L');
        	$mPDF1->Bookmark("RESUMEN PAGOS",0);
			$mPDF1->WriteHTML($this->renderPartial('/pagos/imprimirResumenPagos_',array('model'=>$fact,'pagos'=>$pagos),true));
			//*************************

        		foreach($pagos as $fact){
	        		$mPDF1->AddPage('','','','','','','','','','','', 'myHeaderx', 'html_myHeader2x', '', '', 1, 1, 0, 0);
	        		$mPDF1->Bookmark($fact->profesional->nombreProfesionales,0);
					$mPDF1->WriteHTML($this->renderPartial('/pagos/imprimirPago',array('model'=>$fact,'pdf'=>true),true));
				}
        	}
        	
        
        
        	$stylesheet = file_get_contents('css/impresion.css');
        	$mPDF1->WriteHTML($stylesheet, 1);
        	$mPDF1->Output();
		 
		//$this->render('exportar',array('fechaDesde'=>$fechaDesde,'fechaHasta'=>$fechaHasta));
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

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Liquidaciones']))
		{
			$model->attributes=$_POST['Liquidaciones'];
			if($model->save())
				$this->redirect(array('update','id'=>$model->id));
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
		
			// we only allow deletion via POST request
		$model=	$this->loadModel($id);
    $model->quitarPagos();
    $model->cambiarEstadoCobros();
    $model->delete();

	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new Liquidaciones('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Liquidaciones'])) $model->attributes=$_GET['Liquidaciones'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	
	public function loadModel($id)
	{
		$model=Liquidaciones::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='articulos-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
