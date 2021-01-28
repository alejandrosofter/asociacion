<?php

class ProfesionalesController extends RController
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

	public function accessRules()
	{
		return array(
		);
	}
	public function actionDeuda()
	{ 
		$this->render('deuda',array( ));
	}
	public function actionGetDeuda()
	{
		$data=FacturasObrasSocial::model()->getDeudaProfesional($_GET['idProfesional']);
		$data=$this->getPagosCobros($data);
		
		$this->renderPartial('_deuda',array("datos"=>$data));
	}
	private function getPagosCobros($data)
	{
		for($i=0;$i<count($data);$i++)
			if(isset($data[$i]["idCobro"])) {
				$data[$i]["importePago"]=$this->getImportePago($data[$i]["idCobro"],$data[$i]["idProfesional"],false);
				$data[$i]["importeDebita"]=$this->getImporteDebitos($data[$i]["idCobro"],$data[$i]["idProfesional"],false);
		}else{
			$data[$i]["importeDebita"]=0;
			$data[$i]["importePago"]=0;
		}
		return $data;
	}
	private function getImporteDebitos($idCobro,$idProfesional,$arr)
	{
		return CobrosItems::model()->consultarPagos($idCobro,$idProfesional,$arr,true);
	}
	private function getImportePago($idCobro,$idProfesional,$arr)
	{
		return CobrosItems::model()->consultarPagos($idCobro,$idProfesional,$arr,false);
		
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
		// if(count($data->cobrosObrasSociales)>0)return $data->importe - $data->cobrosObrasSociales[0]->cobro->importe;
		return 0;
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
		$model=new Profesionales;
		$modelUsuario=new Usuarios;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Profesionales']))
		{
			$model->attributes=$_POST['Profesionales'];
			$modelUsuario->attributes=$_POST['Usuarios'];
			if($model->validate()&&$modelUsuario->validate()){
				$model->save();
				$modelUsuario->email=$model->email;
				$modelUsuario->save();
				$ps=new ProfesionalesUsuarios;
				$ps->idUsuario=$modelUsuario->id;
				$ps->idProfesional=$model->id;
				$ps->save();
				Usuarios::model()->asignarPrivilegios(false,$modelUsuario->id,'profesionales');
				$this->redirect(array('index','id'=>$model->id));
			
			}
				
		}

		$this->render('create',array(
			'model'=>$model,'modelUsuario'=>$modelUsuario,
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
		$modelUsuario=$model->usuarioProfesional;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Profesionales']))
		{
			$model->attributes=$_POST['Profesionales'];
			$usuario=isset($modelUsuario->usuario->id)?$modelUsuario->usuario:new Usuarios;
			$usuario->attributes= $_POST['Usuarios'];
			if($model->validate() ){
				// $usuario->save();
				$model->save();
				// if($modelUsuario==null){
				// 	$modelUsuario=new ProfesionalesUsuarios;
				// 	$modelUsuario->idUsuario=$usuario->id;
				// 	$modelUsuario->idProfesional=$model->id;
				// 	$modelUsuario->save();
				// 	Usuarios::model()->asignarPrivilegios(false,$usuario->id,'profesionales');
				// }
				
				$this->redirect(array('index','id'=>$model->id));
			}
				
		}

		$this->render('update',array(
			'model'=>$model,'modelUsuario'=>isset($modelUsuario->usuario)?$modelUsuario->usuario:new Usuarios,
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
		$model=new Profesionales('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Profesionales']))
			$model->attributes=$_GET['Profesionales'];

		$this->render('index',array(
			'model'=>$model,
		));
	}
	public function actionctacte()
	{
		
		$this->render('ctaCte',array( ));
	}
	public function actionCtaCte_()
	{
		$model=Profesionales::model()->findByPk($_GET['idProfesional']);
		//$saldo=$this->getSaldo($_GET['idObraSocial']);
		$consulta1="(SELECT 'FACTURA' as tipo,'000' as nroFactura, fecha as fecha,'FACTURACION del periodo cargado ' as detalle, sum(-importe) as importe,0 as importeRetenciones,0 as importeAsociacion,0 as importeCheque, estado as estado from facturasObrasSocial where YEAR(fecha)=".$_GET['ano']." AND idObraSocial=".$_GET['idProfesional']." group by fecha) UNION ";
		$consulta2="(SELECT 'PAGO' as tipo,'000' as nroFactura,fecha as fecha,'PAGO A PROFESIONAL' as detalle, pagos.importe as importe,
		(SELECT pagos_impuestos.importe from pagos_impuestos where idPago=pagos.id and idImpuesto=3) as importeRetenciones,
		(SELECT pagos_impuestos.importe from pagos_impuestos where idPago=pagos.id and idImpuesto=1) as importeCheque,
		(SELECT pagos_impuestos.importe from pagos_impuestos where idPago=pagos.id and idImpuesto=2) as importeAsociacion,
		
		pagos.estado as estado from pagos
		where YEAR(fecha)=".$_GET['ano']." AND pagos.idProfesional=".$_GET['idProfesional']." group by pagos.id)";
		$orden=" order by fecha";
		$res = Yii::app()->db->createCommand($consulta1.$consulta2.$orden)->queryAll();
		//$res=$command->execute();
		$this->renderPartial('_ctaCte',array("model"=>$model,"saldo"=>number_format(0,2),"cuenta"=>array_reverse($this->saldarArray($res))) );
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
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Profesionales('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Profesionales']))
			$model->attributes=$_GET['Profesionales'];

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
		$model=Profesionales::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='profesionales-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
