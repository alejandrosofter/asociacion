<?php

class FacturasProfesionalNomencladoresController extends RController
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
	public function actioningresarArchivoNomenclador()
	{
		if (isset($_FILES)){
			$dir_subida = '/var/www/appsPhp/archivosExcelNomencladores/';
			$arrNom=explode(".",$_FILES['archivo']['name']);
			$info = new SplFileInfo($_FILES['archivo']['name']);
			
			$nomArchivo=$_POST['idObraSocial'].".".$info->getExtension();
			$fichero_subido = $dir_subida . $nomArchivo;

			if (move_uploaded_file($_FILES['archivo']['tmp_name'], $fichero_subido)) {
				$model=ArchivosExcelNomencladores::model()->getArchivo($_POST['idObraSocial']);
				if(isset($model)){
					$model->fechaActualiza=Date('Y-m-d');
					 $model->nombreArchivo=$nomArchivo;
					$model->save();
				}else{
					$model=new ArchivosExcelNomencladores;
				    $model->idObraSocial=$_POST['idObraSocial'];
				    $model->fechaActualiza=Date('Y-m-d');
				    $model->nombreArchivo=$nomArchivo;
				    $model->save();
				}
			    
			} else {
			    echo "¡Posible ataque de subida de ficheros!\n";
			}

		}
		// if (isset($fil)) {
  //       echo "Vienen archivos!";
  //       print_r($fil);
  //   	}else echo "nanda";
  //   	if(isset($_POST['idObraSocial']))echo $_POST['idObraSocial'];
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
	private function normaliza ($cadena){
		$cadena=preg_replace('/[^a-zA-Z0-9_ -]/s','', utf8_encode($cadena));
	   
	    return $this->quitarTildes($cadena);
}
private function quitarTildes($cadena) {
$no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
$permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
$texto = str_replace($no_permitidas, $permitidas ,$cadena);
return $texto;
}
	private function cargoNomenclador($dataNom,$idObraSocial,$idRangoNomenclador){
		$model=new FacturasProfesionalNomencladores;

		$model->idObraSocial=(int)$idObraSocial;
		$model->idRangoNomenclador=(int)$idRangoNomenclador;
		$model->detalle=$this->normaliza($dataNom['detalle']);
		$model->importe=(float)$dataNom['importe'];
		$model->codigoInterno=(string)$dataNom['codigoInterno'];
		$model->codigoExterno=(string)$dataNom['codigoExterno'];
		
		if($model->save())echo "cargo ".$dataNom['detalle'].$dataNom['codigoInterno'].$dataNom['importe'].$dataNom['codigoExterno']."idObraSocial:".$idObraSocial;
		else print_r($model->getErrors() );

	}
	private function modificoNomenclador($dataNom,$idObraSocial,$idRangoNomenclador){
		$model=$this->buscarNomencaldor($dataNom['codigoInterno'],$idObraSocial,$idRangoNomenclador);

		$model->idObraSocial=(int)$idObraSocial;
		$model->idRangoNomenclador=(int)$idRangoNomenclador;
		$model->detalle=utf8_encode($dataNom['detalle']);
		$model->importe=(float)$dataNom['importe'];
		$model->codigoInterno=(string)$dataNom['codigoInterno'];
		$model->codigoExterno=(string)$dataNom['codigoExterno'];
		
		if($model->save()){
			
		}
			else print_r($model->getErrors() );
		
	}
	private function existeNomenclador($dataNom,$idObraSocial,$idRangoNomenclador)
	{
		$model=$this->buscarNomencaldor($dataNom['codigoInterno'],$idObraSocial,$idRangoNomenclador);
		return isset($model);
	}
	private function buscarNomencaldor($codigoInterno,$idObraSocial,$idRangoNomenclador)
	{
		return FacturasProfesionalNomencladores::model()->buscarNomencaldor($codigoInterno,$idObraSocial,$idRangoNomenclador);
	}
	private function getRango($fecha,$idObraSocial)
	{

	}
	public function actionbuscarNomencaldores()
	{
		$idObraSocial=$_GET['idObraSocial'];
		$idRangoNomenclador=isset($_GET['idRango'])?$_GET['idRango']:0;
		echo CJSON::encode(FacturasProfesionalNomencladores::model()->buscarNomencaldores($idObraSocial,$idRangoNomenclador));
	}
	private function agregarRango($idObraSocial,$fechaDesde,$fechaHasta)
	{
		$model=new FacturasProfesionalRangoNomencladores();
		$model->fechaDesde=$fechaDesde;
		$model->fechaHasta=$fechaHasta;
		$model->idObraSocial=$idObraSocial;
		$model->save();
		return $model->id;

	}
	public function actionimportarNomencladores()
	{
		$noms=$_POST['nomencladores'];
		$idObraSocial=$_POST['idObraSocial'];
		$esNuevo=$_POST['esNuevo'];
		$fechaDesde=$_POST['fechaDesde'];
		$fechaHasta="1900-01-01"	;
		$idRangoNomenclador=$_POST['idRangoNomenclador'];
		if($esNuevo=="true")$idRangoNomenclador=$this->agregarRango($idObraSocial,$fechaDesde, $fechaHasta);
		for($i=0;$i<count($noms);$i++){
			if($this->existeNomenclador($noms[$i],$idObraSocial,$idRangoNomenclador))$this->modificoNomenclador($noms[$i],$idObraSocial,$idRangoNomenclador);
			else $this->cargoNomenclador($noms[$i],$idObraSocial,$idRangoNomenclador);
		}
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
		$model=new FacturasProfesionalNomencladores;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['FacturasProfesionalNomencladores']))
		{
			$model->attributes=$_POST['FacturasProfesionalNomencladores'];
			if($model->save())
				$this->redirect(array('index','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	public function actionImportar()
	{
		$model=new FacturasProfesionalNomencladores;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['FacturasProfesionalNomencladores']))
		{
			$model->attributes=$_POST['FacturasProfesionalNomencladores'];
			
		}

		$this->render('importar',array(
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

		if(isset($_POST['FacturasProfesionalNomencladores']))
		{
			$model->attributes=$_POST['FacturasProfesionalNomencladores'];
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
		$model=new FacturasProfesionalNomencladores('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['FacturasProfesionalNomencladores']))
			$model->attributes=$_GET['FacturasProfesionalNomencladores'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new FacturasProfesionalNomencladores('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['FacturasProfesionalNomencladores']))
			$model->attributes=$_GET['FacturasProfesionalNomencladores'];

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
		$model=FacturasProfesionalNomencladores::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='facturas-profesional-nomencladores-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
