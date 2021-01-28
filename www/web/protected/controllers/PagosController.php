<?php

class PagosController extends RController
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
	public function actionDetalleMes()
	{
		$this->layout='//layouts/layoutSolo';
		$mydate=$_GET['fecha'];
		$mes = date("m",strtotime($mydate));
		$ano = date("Y",strtotime($mydate));
		$data=FacturasProfesional::model()->getFacturadoMes($_GET['idProfesional'],$ano,$mes,false);
		$this->render('/usuarios/_detalleFacturadoMes',array('data'=>$data,'mes'=>$mes,'ano'=>$ano));
	}
	public function actionGetPagos()
	{
		$res= Pagos::model()->rango($_GET['fechaDesde'],$_GET['fechaHasta']);
		foreach($res as $pago){
			$aux['id']=$pago->id;
			$aux['profesional']=$pago->profesional->nombreProfesionales;
			$aux['email']=$pago->profesional->email;
			$salida[]=$aux;
		}
		echo CJSON::encode($salida);
	}
	public function actioncalculaRetencion()
	{
		$this->layout='//layouts/layoutSolo';
		$this->render('calculaImpuestos',array());
	}
	public function actionEnviaMail($idPago)
	{
		
        	$pago=Pagos::model()->findByPk($idPago);
        	
        		$mPDF1 = Yii::app()->ePdf->mpdf();
        		$mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
        		$mPDF1->AddPage('','','','','','','','','','','', 'myHeaderx', 'html_myHeader2x', '', '', 1, 1, 0, 0);
        		$mPDF1->Bookmark($pago->profesional->nombreProfesionales,0);
				$mPDF1->WriteHTML($this->renderPartial('/pagos/imprimirPago',array('model'=>$pago,'pdf'=>true),true));

				$salida['email']=$pago->profesional->email;
				$mPDF1->AddPage('','','','','','','','','','','', 'myHeaderx', 'html_myHeader2x', '', '', 1, 1, 0, 0);
				$mPDF1->Bookmark('--->RETENCION',0);
				$mPDF1->WriteHTML($this->renderPartial('/pagos/imprimirRetencion',array('model'=>$pago,'pdf'=>true),true));
				
				$stylesheet = file_get_contents('css/impresion.css');
        		$mPDF1->WriteHTML($stylesheet, 1);
				$data = $mPDF1->Output('data.pdf', 'S');
				$params['fecha']=Date('d-m-Y');
				$params['titulo']='Confirmación de Pago';
				$params['direccion']=Settings::model()->getValorSistema('DATOS_EMPRESA_DIRECCION');
				$params['telefono']=Settings::model()->getValorSistema('DATOS_EMPRESA_TELEFONO');
				$params['emailAdmin']=Settings::model()->getValorSistema('DATOS_EMPRESA_EMAILADMIN');
				$params['cuerpo']=$this->renderPartial('/pagos/comprobanteMail',array(),true);
				$mensaje=Settings::model()->getValorSistema('PLANTILLA_BASE',$params);
		
				$salida['enviado']=Mail::model()->enviarMail($pago->profesional->email,$mensaje,'NUEVO PAGO',Settings::model()->getValorSistema('DATOS_EMPRESA_EMAILADMIN'),array($data));
        		$salida['idPago']=$idPago;
        	echo CJSON::encode($salida);
	}
	public function formatearNum($num)
	{
	    if($num==0) return '';
	    if($num=='') return '';
	    return  '$ '.str_replace(' ',"&nbsp;",str_pad(number_format($num,2),30,' ',STR_PAD_LEFT));
	   
	}
	public function actionMails()
	{
		$this->layout='//layout/layoutSoloImpresion';
		$fechaDesde=isset($_POST['fechaDesde'])?$_POST['fechaDesde']:Date('Y-m-d');
		$fechaHasta=isset($_POST['fechaHasta'])?$_POST['fechaHasta']:Date('Y-m-d');
		
		$this->render('mails',array('fechaDesde'=>$fechaDesde,'fechaHasta'=>$fechaHasta));
	}
	public function actionExportar()
	{
		$this->layout='//layout/layoutSoloImpresion';
		$fechaDesde=isset($_POST['fechaDesde'])?$_POST['fechaDesde']:Date('Y-m-d');
		$fechaHasta=isset($_POST['fechaHasta'])?$_POST['fechaHasta']:Date('Y-m-d');
		if(isset($_POST['fechaDesde']))
		{
			$mPDF1 = Yii::app()->ePdf->mpdf();
        	$mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
        	$pagos=Pagos::model()->rango($fechaDesde,$fechaHasta);
        
        if(isset($_POST['comprobante']))
        	foreach($pagos as $fact){
        		
        		$mPDF1->AddPage('','','','','','','','','','','', 'myHeaderx', 'html_myHeader2x', '', '', 1, 1, 0, 0);
        		$mPDF1->Bookmark($fact->profesional->nombreProfesionales,0);
				$mPDF1->WriteHTML($this->renderPartial('/pagos/imprimirPago',array('model'=>$fact,'pdf'=>true),true));
			}
        
        if(isset($_POST['retencion']))
        	foreach($pagos as $fact){
				$mPDF1->AddPage('','','','','','','','','','','', 'myHeaderx', 'html_myHeader2x', '', '', 1, 1, 0, 0);
				$mPDF1->Bookmark('--->RETENCION',0);
				$mPDF1->WriteHTML($this->renderPartial('/pagos/imprimirRetencion',array('model'=>$fact,'pdf'=>true),true));
				
        	}
        	$stylesheet = file_get_contents('css/impresion.css');
        	$mPDF1->WriteHTML($stylesheet, 1);
        	$mPDF1->Output();
		}  
		$this->render('exportar',array('fechaDesde'=>$fechaDesde,'fechaHasta'=>$fechaHasta));
	}
	public function actionImprimirRetencion($id)
	{
		$this->layout='//layout/layoutSoloImpresion';
		$model=Pagos::model()->findByPk($id);
		$mPDF1 = Yii::app()->ePdf->mpdf();
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
        $mPDF1->AddPage('','','','','','','','','','','', 'myHeaderx', 'html_myHeader2x', '', '', 1, 1, 0, 0);
        
		$mPDF1->WriteHTML($this->renderPartial('/pagos/imprimirRetencion',array('model'=>$model,'pdf'=>true),true));
		$stylesheet = file_get_contents('css/impresion.css');
        $mPDF1->WriteHTML($stylesheet, 1);
        $mPDF1->Output();
	}
	public function actionImprimirPago($id)
	{
		$this->layout='//layout/layoutSoloImpresion';
		$model=Pagos::model()->findByPk($id);
		$mPDF1 = Yii::app()->ePdf->mpdf();
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
        $mPDF1->AddPage('','','','','','','','','','','', 'myHeaderx', 'html_myHeader2x', '', '', 1, 1, 0, 0);
        
		$mPDF1->WriteHTML($this->renderPartial('/pagos/imprimirPago',array('model'=>$model,'pdf'=>true),true));
		$stylesheet = file_get_contents('css/impresion.css');
        $mPDF1->WriteHTML($stylesheet, 1);
        $mPDF1->Output();
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

	public function actionLiquida($id)
	{
			$this->liquida($id);
	}
	private function liquida($id,$noRetiene)
	{
		$model=Pagos::model()->findByPk($id);
		$impuestos=Impuestos::model()->findAll();
		foreach($impuestos as $impuesto)
			PagosItems::model()->ingresaPorImpuesto($model->id,$impuesto,$noRetiene);
	}
	
	public function actionItemsLiquidar($idProfesional)
	{
		$this->layout="//layouts/layoutSolo";
		$this->render('itemsParaLiquidar');
	}
	public function actionCreateLote()
	{
		$model=CobrosItems::model()->getPendientes();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['cargar']))
		{
			$model->attributes=$_POST['Pagos'];
			if($model->save())
				$this->redirect(array('index','id'=>$model->id));
		}
		if(isset($_GET['id']))$model->idProfesional=$_GET['id'];
		$this->render('createLotes',array(
			'model'=>$model,
		));
	}
	public function actionCreate()
	{
		$model=new Pagos;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Pagos']))
		{
			$model->attributes=$_POST['Pagos'];
			if($model->save())
				$this->redirect(array('index','id'=>$model->id));
		}
		$model->fecha=Date('Y-m-d');
		$model->estado=Pagos::CANCELADO;
		if(isset($_GET['id']))$model->idProfesional=$_GET['id'];
		$this->render('create',array(
			'model'=>$model,
		));
	}
	public function actionAgregar()
	{
		echo $this->_agregar($_GET['idProfesional'],$_GET['fecha'],$_GET['importe'],$_GET['items'],$_GET['noAplicaImpuestos'],$_GET['impuestos']);
	}
	private function _agregar($idProfesional,$fecha,$importe,$items,$noAplicaImpuestos,$impuestos)
	{
		$model=new Pagos;
		$salida['valido']=true;
		$salida['error']='';
		$salida['idProfesional']=$this->proximo($idProfesional);
		$model->fecha=$fecha;
		$model->importe=$importe;
		$model->idProfesional=$idProfesional;
		if(!$model->validate()){
				$salida['valido']=false;
				$salida['error']='Hay datos invalidos en el Cobro!';
				return CJSON::encode($salida);
				
		}
		$model->save();
		foreach($items as $item)
			PagosItems::model()->ingresar($item,$model->id);
		if(!$noAplicaImpuestos)$this->liquida($model->id);else $this->ingresaManualImpuestos($impuestos,$model);
		$model->updateImporte();
		return CJSON::encode($salida);
	}
	private function ingresaManualImpuestos($impuestos,$pago)
	{
		foreach($impuestos as $impuesto){
			$imp=Impuestos::model()->findByPk($impuesto['idImpuesto']);
			$model=new PagosImpuestos;
			$model->idPago=$pago->id;
			$model->idImpuesto=$impuesto['idImpuesto'];
			$model->importe=-$impuesto['importe']+0;
			if($model->importe<=0)
			if($imp->esRetencion)$this->ingresaRetencion($impuesto['importe'],$imp,$pago);
			$model->save();
		}
	}
	private function ingresaRetencion($importe,$impuestoRetencion,$pago)
	{
		$model=new Retenciones;
		$model->idPago=$pago->id;
		$model->importeRetencion=$importe;
		$model->importeBase=PagosItems::model()->importeImpuestoRetencion($pago->id,$impuestoRetencion);
		$model->save();
	}
	public function actionAgregarLote()
	{
		foreach($_POST['items'] as $profesional) $this->_agregarIndividual($_POST['noRetiene'],$profesional,isset($_POST['agregados'])?$_POST['agregados']:array());

	}
	public function actionDetalleRetencion()
	{
		$this->layout='//layout/layoutSoloImpresion';
		$model=Pagos::model()->findByPk($_GET['id']);
		$this->render('detalleRetencion',array('model'=>$model));
	}
	private function _agregarIndividual($noRetiene,$profesional,$itemsAgregado)
	{
		$pago=new Pagos;
		$pago->fecha=Date('Y-m-d');
		$pago->idProfesional=$profesional['idProfesional'];
		$pago->estado="CANCELADO";
		$pago->importe=0;
		$pago->save();
		$this->_agregarIndividualItems(CobrosItems::model()->getPendientesProfesional($profesional['idProfesional']),$pago->id);
		$this->_agregarIndividualItemsAgregado($itemsAgregado,$pago->id,$profesional['idProfesional']);
		
		$pago->updateImporte();
		$this->liquida($pago->id,$noRetiene);
	}
	private function _agregarIndividualItemsAgregado($itemsAgregado,$idPago,$idProfesional)
	{
		foreach($itemsAgregado as $item){
			$aux['detalle']=$item['detalle'];
			$aux['idTipo']=$item['idTipo'];
			$aux['importe']=$item['importe'];
			$aux['detalle']=$item['detalle'];
			if($idProfesional==$item['idProfesional'])
				PagosItems::model()->ingresar($aux,$idPago);
		}
	}
	private function _agregarIndividualItems($pendientes,$idPago)
	{
		foreach($pendientes as $item){
			$aux['idItem']=$item->id;
			$aux['detalle']=$item->detalle;
			$aux['idTipo']=$item->idTipoItem;
			$aux['importe']=$item->importe;
			PagosItems::model()->ingresar($aux,$idPago);
		}
	}
	private function proximo($idProfesional)
	{
		$items=Profesionales::model()->findAll();
		for($i=0;$i<count($items);$i++)
			if($idProfesional==$items[$i]->id)
				$aux=$i;
		if($aux<count($items)){
			$it= $items[$aux+1];
			return $it->id;
		}
		return -1;
	}
	public function actionGetPendientes($id)
	{
		$criteria=new CDbCriteria;
		$criteria->compare('idProfesional',$id,false);
		$criteria->compare('estado','PENDIENTE',false);
		$items=CobrosItems::model()->findAll($criteria);
		if($id=='')return;
		$arr=array();
		foreach($items as $item){
			$data['detalle']=$item->detalle;
			$data['importe']=$item->importe;
			$data['idTipo']=$item->idTipoItem;
			$data['tipo']=$item->tipo->nombreTipoCobro;
			$data['idItem']=$item->id;
			$data['id']=$item->id;

			$arr[]=$data;
		}
		echo CJSON::encode($arr);
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

		if(isset($_POST['Pagos']))
		{
			$model->attributes=$_POST['Pagos'];
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
		foreach($model->pagosItems as $item)
			if(isset($item->itemFactura)){
			$itemFactura=CobrosItems::model()->findByPk($item->itemFactura->idItemFacturaOs);
			$itemFactura->estado='PENDIENTE';
			$itemFactura->save();
		}
		$model->delete();
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new Pagos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Pagos']))
			$model->attributes=$_GET['Pagos'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Pagos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Pagos']))
			$model->attributes=$_GET['Pagos'];

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
		$model=Pagos::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='pagos-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
