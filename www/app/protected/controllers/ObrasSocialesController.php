<?php

class ObrasSocialesController extends RController
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

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function actionDeuda()
	{
		$this->render('deudas',array( ));
	}
	public function actionGetDeuda()
	{
		$data=FacturasObrasSocial::model()->getDeuda($_GET['idObraSocial'],$_GET['estado'],isset($_GET['fechaDesde'])?$_GET['fechaDesde']:"",isset($_GET['fechaHasta'])?$_GET['fechaHasta']:"");
		$this->renderPartial('_deudas',array("datos"=>$data));
	}
	
	public function getDebitoFactura($data)
	{
		if(count($data->cobrosObrasSociales)>0)return $data->cobrosObrasSociales[0]->cobro->importeDebitos;
		return 0;
	}
	public function getImporteCobrado($data)
	{
		if(count($data->cobrosObrasSociales)>0)return $data->cobrosObrasSociales[0]->cobro->importe;
		return 0;
	}
	public function getImporteSaldo($data)
	{
		$importePago=0;
		if(count($data->cobrosObrasSociales)>0)$importePago= $data->cobrosObrasSociales[0]->cobro->importe;
		return $importePago-$data->importe;
	}
	public function getCantidadDiasFactura($data)
	{
		$date1 = new DateTime($data->fecha);
		$date2 = new DateTime(Date("Y-m-d"));
		return $date1->diff($date2)->days;
	}
	public function getFechaCobro($data)
	{
		if(count($data->cobrosObrasSociales)>0){
			$date1 = new DateTime($data->fecha);
		$date2 = new DateTime($data->cobrosObrasSociales[0]->cobro->fecha);
		$dias= $date1->diff($date2)->days;
			return Yii::app()->dateFormatter->format("dd-MM-yyyy",$data->cobrosObrasSociales[0]->cobro->fecha)." (".$dias.")" ;
		}
		return "";
	}
	public function accessRules()
	{
		return array(
		);
	}
	public function actionbuscarColumnas()
	{
		$model=ObrasSociales::model()->findByPk($_GET['idObraSocial']);
		echo CJSON::encode($model);
	}
	public function actionGetObraSocial()
	{
		$model=ObrasSociales::model()->findByPk($_GET['idObraSocial']);
		echo CJSON::encode($model);
	}
	public function actionguardarDatosObraSocial()
	{
		$model=ObrasSociales::model()->findByPk($_GET['idObraSocial']);
		$model->importar_codigoInterno=$_GET['codigoInterno'];
		$model->importar_codigoExterno=$_GET['codigoExterno'];
		$model->importar_detalle=$_GET['detalle'];
		$model->importar_importe=$_GET['importe'];
		if ($model->save())
		echo "okk!";

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
	public function actionCtaCte()
	{
		$this->render('ctaCte',array());
	}
	private function getSaldo($id)
	{
		$facturas=FacturasObrasSocial::model()->getPendientes($id);
		$sum=0;
		for ($i=0; $i < count($facturas); $i++) 
			$sum+=$facturas[$i]->importe;
		return $sum;
	}
	public function actionCtaCte_()
	{
		$model=ObrasSociales::model()->findByPk($_GET['idObraSocial']);
		$saldo=$this->getSaldo($_GET['idObraSocial']);
		$consulta1="(SELECT 'FACTURA' as tipo,'000' as nroFactura, fecha as fecha,detalle as detalle, importe as importe, estado as estado from facturasObrasSocial where idObraSocial=".$_GET['idObraSocial'].") UNION ";
		$consulta2="(SELECT 'COBRO' as tipo,'000' as nroFactura,fecha as fecha,cobros.detalle as detalle, -importe as importe, estado as estado from cobros_obrasSociales inner join cobros on cobros.id = cobros_obrasSociales.idCobro where cobros_obrasSociales.idObraSocial=".$_GET['idObraSocial'].")";
		$orden=" order by fecha";
		$res = Yii::app()->db->createCommand($consulta1.$consulta2.$orden)->queryAll();
		//$res=$command->execute();
		$this->renderPartial('ctaCte_',array("model"=>$model,"saldo"=>number_format($saldo,2),"cuenta"=>array_reverse($this->saldarArray($res))) );
	}
	private function saldarArray($arr)
	{
		$salida=[];
		$sum=0;
		for ($i=0; $i < count($arr) ; $i++) { 
			$value=$arr[$i];
			$sum+=$value['importe'];
			$value['saldo']=$sum;
			$salida[]=$value;
		}
		return $salida;
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new ObrasSociales;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ObrasSociales']))
		{
			$model->attributes=$_POST['ObrasSociales'];
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

		if(isset($_POST['ObrasSociales']))
		{
			$model->attributes=$_POST['ObrasSociales'];
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

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new ObrasSociales('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ObrasSociales']))
			$model->attributes=$_GET['ObrasSociales'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ObrasSociales('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ObrasSociales']))
			$model->attributes=$_GET['ObrasSociales'];

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
		$model=ObrasSociales::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='obras-sociales-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
