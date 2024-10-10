<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	
	 public $layout='//layouts/web';
	
	
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}
	
	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}


	public function actionIndex()
	{

		$this->render('index');
	}
	private function ripGrafica($data,$label,$color)
	{
		return array("label"=>$label,"backgroundColor"=>$color,"data"=>$data);
	}
	public function actionGetAnual()
	{
		$idImpuestoGanancia=1;// 4.5 ASOCIACION
		$idImpuestoCheque=2;// 0.6 cheque
		$idImpuestoRetencion=3;// GANANCIA ASOCIACION
		$facturacion=$this->ripGrafica(FacturasObrasSocial::model()->anual($_GET['ano']),"FACTURACION","#2c906a");
		$cobros=$this->ripGrafica(Cobros::model()->anual($_GET['ano']),"COBROS","#f0b629");
		$ganancia=$this->ripGrafica(PagosImpuestos::model()->anual($_GET['ano'],$idImpuestoGanancia),"4.5 % ASOCIACION","#d45a97");
		$cheques=$this->ripGrafica(PagosImpuestos::model()->anual($_GET['ano'],$idImpuestoCheque),"0.6 % CHEQUES","#d45a97");
		$retenciones=$this->ripGrafica(PagosImpuestos::model()->anual($_GET['ano'],$idImpuestoRetencion),"RETENCIONES","#ec1c1c");
		$pagos=$this->ripGrafica(Pagos::model()->anual(null,$_GET['ano']),"PAGADO","#81b7d3");
		$datos[]=$facturacion;
		$datos[]=$cobros;
		$datos[]=$ganancia;
		$datos[]=$cheques;
		$datos[]=$retenciones;
		$datos[]=$pagos;
		echo CJSON::encode($datos);
	}
	public function actionAuditoria()
	{
		$anio=isset($_GET['anio'])?$_GET['anio']:Date("Y");
		$this->render('auditoria',array("anio"=>$anio));
	}
	public function actionAuditoriaPendientes_()
	{
		$ano=isset($_GET['ano'])?$_GET['ano']:Date("Y");
		$agrupa=isset($_GET['agrupa'])?true:false;
		$agrupaOs=isset($_GET['agrupaOs'])?true:false;
		$idObraSocial=isset($_GET['idObraSocial'])?$_GET['idObraSocial']:false;

		$pendientes=FacturasObrasSocial::model()->getFacturasImpagas_pendientes($ano,$agrupa,$agrupaOs,$idObraSocial);
		$canceladas=FacturasObrasSocial::model()->getFacturasImpagas_canceladas($ano,$agrupa,$agrupaOs,$idObraSocial);
		$cabezal=$this->renderPartial("cabezal",array("titulo"=>"PENDIENTES AL ".$ano),true);
		$this->renderPartial('auditoriaPendientes_',array("ano"=>$ano,"pendientes"=>$pendientes,"canceladas"=>$canceladas,"agrupa"=>$agrupa,"agrupaOs"=>$agrupaOs,"cabezal"=>$cabezal));
		

		
	}
	private function getOs($data)
	{
		$sal=[];
		foreach($data as $lab=>$dat)
			$sal[]=$dat['nombreObraSocial'];
		return $sal;
	}
	private function getValor($data)
	{
		$sal=[];
		foreach($data as $lab=>$dat)
			$sal[]=$dat['total']*1;
		return $sal;
	}
	public function actionConsultaPendientesAnual()
	{
		$ano=isset($_GET['ano'])?$_GET['ano']:Date("Y");
		$agrupa=isset($_GET['agrupa'])?true:false;
		$agrupaOs=isset($_GET['agrupaOs'])?true:false;
		$idObraSocial=isset($_GET['idObraSocial'])?$_GET['idObraSocial']:null;

		$pendientes=FacturasObrasSocial::model()->getFacturasImpagas($ano,$agrupa,$agrupaOs,$idObraSocial);
		$data=array("os"=>$this->getOs($pendientes),"data"=>$this->getValor($pendientes));
		
		echo CJSON::encode($data);
		
	}
	public function actionLogin()
	{
		$model=new LoginForm;
		$this->layout = '//layouts/layoutLogin';
		$invalido=false;
		if(isset($_POST['username']))
		{
			
			$model->username=$_POST['username'];
			$model->password=$_POST['password'];
			// validate user input and redirect to the previous page if valid
			if($model->login())
				$this->redirect('index.php?r=usuarios/cuenta');
				else $invalido =true;
		}
		// display the login form
		$this->render('login',array('model'=>$model,'invalido'=>$invalido));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect('index.php?r=usuarios/cuenta');
	}
}