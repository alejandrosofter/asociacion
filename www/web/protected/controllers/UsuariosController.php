<?php
include(dirname(__FILE__).'/../extensions/SimpleImage.php');
class UsuariosController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */

	public $layout='//layouts/main';
	public $pathImagenesUsuario="/../../images/usuarios/";
	public $widthImagenUsuario=80;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl'
		);
	}
	public function init()
	{
		$this->layout="//layouts/column2";
	}
	public function actionDescargar()
	{
		$model=ArchivosNomencladores::model();
		$model=$model->findByPk($_GET['id']);
		header('Pragma: public');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Content-Transfer-Encoding: binary');
		header('Content-length: '.$model->size);
		header('Content-Type: '.$model->type);
		header('Content-Disposition: attachment; filename='.$model->name);

	        echo $model->data;
	}
	public function actionImagenCode64()
	{
		$targetPath = dirname(__FILE__). $this->pathImagenesUsuario;
		$targetFile = rtrim($targetPath,'/') . '/' . $_POST['imagen'];
		$targetFileTmp = rtrim($targetPath,'/') . '/tmp_' . $_POST['imagen'];
		
   		$image = new SimpleImage();
   		$image->load($targetFile);
   		$image->resize($this->widthImagenUsuario,$this->widthImagenUsuario);
   		$image->save($targetFileTmp);
   		$filedata = file_get_contents($targetFileTmp);
		$post_data = base64_encode($filedata);
		echo $post_data;
	}
	public function actionSubirImagen()
	{
$verifyToken = md5('unique_salt' . $_POST['timestamp']);

if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = dirname(__FILE__). $this->pathImagenesUsuario;
	$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['Filedata']['name'];
	
	// Validate the file type
	$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	
	if (in_array($fileParts['extension'],$fileTypes)) {
		move_uploaded_file($tempFile,$targetFile);
		echo '1';
	} else {
		echo 'Invalid file type.';
	}
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
            array('allow',
            	'actions'=>array('miInicio','facturacion','descargar','retenciones','itemRetencion'),
                'users'=>array('@'),
            ),
            array('deny',
                'users'=>array('*'),
            ),
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
		$model=new Usuarios;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Usuarios']))
		{
			$model->attributes=$_POST['Usuarios'];
			if($model->save()){
				Usuarios::model()->asignarPrivilegios(true,$model->id);
				$this->redirect(array('index','id'=>$model->id));
			}
				
		}	
		$model->fechaAlta=Date('Y-m-d H:i:s');

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

		if(isset($_POST['Usuarios']))
		{
			
			$model->attributes=$_POST['Usuarios'];
			$model->imagen=$_POST['Usuarios']['imagen'];
			if($model->save())
				$this->redirect(array('index','id'=>$model->id));
		}
		$model->fechaAlta=Date('Y-m-d H:i:s');
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

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		
	}
public function actionItemRetencion($id)
	{
		$model=LiquidacionRealizada::model()->findByPk($id);
		$this->render('items',array(
			'model'=>$model->items,
		));
	}
	public function actionFacturacion()
	{
		$fechaDesde=isset($_GET['fechaDesde'])?$_GET['fechaDesde']:Date('01-m-Y');
		$fechaHasta=isset($_GET['fechaHasta'])?$_GET['fechaHasta']:Date('31-m-Y');
		$res=OrdenesTrabajo::model()->buscar(Yii::app()->user->id,$fechaDesde,$fechaHasta);
		
		$this->render('facturacion',array(
			'model'=>$res,'fechaDesde'=>$fechaDesde,'fechaHasta'=>$fechaHasta
		));
	}
	public function actionRetenciones()
	{
		$fechaDesde=isset($_GET['fechaDesde'])?$_GET['fechaDesde']:Date('01-m-Y');
		$fechaHasta=isset($_GET['fechaHasta'])?$_GET['fechaHasta']:Date('31-m-Y');
		$res=LiquidacionRealizada::model()->buscar(Yii::app()->user->id,$fechaDesde,$fechaHasta);
		$this->render('retenciones',array(
			'model'=>$res,'fechaDesde'=>$fechaDesde,'fechaHasta'=>$fechaHasta
		));
	}
	
	public function actionIndex()
	{
		$model=new Usuarios('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Usuarios']))
			$model->attributes=$_GET['Usuarios'];

		$this->render('index',array(
			'model'=>$model,
		));
	}
		private function guardaUsuario($asoc,$usuario)
	{
		$usuario->email=$asoc->email;
		$usuario->idEstado=$asoc->idEstado;
		$usuario->save();

		$u=new AsociadosUsuario;
		$u->idAsociado=$asoc->id;
		$u->idUsuario=$usuario->id;
		$u->save();

	}
	public function actionMiInicio()
	{
		$this->layout='//layouts/column1';
		$id=Yii::app()->user->id;
		$ano=isset($_GET['ano'])?$_GET['ano']:Date('Y');
		$model=Profesionales::model()->findByPk(Yii::app()->user->id);
		$pendientes= $this->renderPartial('_pendientesFacturacion',array('data'=>FacturasProfesional::model()->getPendientes($id,$ano)),true);
		$ultimosPagos=$this->renderPartial('_ultimosPagos',array('model'=>Pagos::model()->getUltimos($id,$ano,1000)),true);
		$porcentajesObraSocial=$this->renderPartial('_graficaFacturacion',array('model'=>FacturasProfesional::model()->porcentajes($id,$ano)),true);
		$profesional=Profesionales::model()->findByPk($id);
		$impuestos=$this->renderPartial('_impuestos',array('model'=>PagosImpuestos::model()->getImpuestos($id,$ano)),true);
		$pendientesCobro=$this->renderPartial('_pendienteCobro',array('model'=>FacturasObrasSocialItems::model()->getPendientes($id,$ano)),true);
		$mensual=FacturasProfesional::model()->getFacturadoMes($id,$ano);

		$nomencladores=ArchivosNomencladores::model()->findAll();
		$this->render('inicio',array('pendienteCobro'=>$pendientesCobro,'nomencladores'=>$nomencladores,'mensual'=>$mensual,'idProfesional'=>$id,'ano'=>$ano,'impuestos'=>$impuestos,'profesional'=>$profesional,'pendientes'=>$pendientes,'ultimosPagos'=>$ultimosPagos,'porcentajesObraSocial'=>$porcentajesObraSocial));
	}
	public function actionMiCuenta()
	{
		$model=$this->loadModel(Yii::app()->user->id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Usuarios']))
		{
			
			$model->attributes=$_POST['Usuarios'];
			$model->imagen=$_POST['Usuarios']['imagen'];
			if($model->save())
				$this->redirect(array('miCuenta','id'=>$model->id));
		}
		
		$model->fechaAlta=Date('Y-m-d H:i:s');
		$this->render('miCuenta',array(
			'model'=>$model,'informe'=>$informe
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Usuarios('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Usuarios']))
			$model->attributes=$_GET['Usuarios'];

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
		$model=Usuarios::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='usuarios-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
