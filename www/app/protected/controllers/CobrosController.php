<?php

class CobrosController extends RController
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
	public function actionConsultaPendientes()
	{
		$model=Cobros::model()->getPendientes();
		$res=$this->renderPartial("cobrosPendientes",array("items"=>$model),true);
			$salida['contenido']=$res;
		$salida['items']=$model;
		echo CJSON::encode($salida);
	}
	private function array_group_by(array $arr, callable $key_selector) {
  $result = array();
  foreach ($arr as $i) {
    $key = call_user_func($key_selector, $i);
    $result[$key][] = $i;
  }  
  return $result;
}
	private function getItemsAccor($item)
	{
		$moldeItems='<table class="table table-condensed">
        <tr><th>Detalle</th><th style="width:80px">$ Importe</th><th style="width:70px"></th></tr> ';
			$total=0;
			foreach($item as $it){
				$clase=$it->importe<0?"error":"";
				$moldeItems.='<tr class="'.$clase.'" id="filaItems_'.$it->id.'"><td>'.$it->detalle.'</td><td> $'.number_format($it->importe,2).'</td><td >
				<img style="cursor:pointer" onclick="quitarItemProfesional('.$it->id.','.$it->idProfesional.')" src="images/iconos/famfam/0.png"/>
				<img style="cursor:pointer" onclick="editarItemProfesional('.$it->id.','.$it->idProfesional.')" src="images/iconos/famfam/pencil.png"/>
				</td></tr>';
				$total+=$it->importe;
			}
		//	foreach($item as $it)$molde.="<tr><td>".$it->detalle."</td><td>$ ".number_format($it->importe,2)."</td></tr>";
    $moldeItems.='</table>';
		return $moldeItems;
	}
	public function actionSetearIdObraSocialPagos()
	{
		$arr=Cobros::model()->getCancelados();
		for($i=0;$i<count($arr);$i++){
			echo "SETEANDO ".$arr[$i]->id;
		}
	}
	private function getImporteTotalProf($item)
	{
			$total=0;
			foreach($item as $it){
				$total+=$it->importe>0?$it->importe:0;
			}
		
		return number_format($total,2);
	}
	private function getImporteCreditoProf($item)
	{
			$total=0;
			foreach($item as $it){
				$total+=$it->importe>0?$it->importe:0;
			}
		
		return number_format($total,2);
	}
		private function getImportetotalDebito($item)
	{
			$total=0;
			foreach($item as $it){
				if($it->importe<0) $total+=$it->importe;
			}
		
		return number_format($total,2);
	}
	public function actiongetProfesionalesCobros()
	{
		$ids=isset($_POST['idCobros'])?$_POST['idCobros']:array();
		$idProfesional=isset($_POST['idProfesional'])?$_POST['idProfesional']:0;
		if(count($ids)==0){
			$resultados["datos"]="No hay seleccion de COBROS para liquidar!";
			$resultados["res"]=array();
			echo CJSON::encode($resultados);
			return;
			
		}
		$res=Cobros::model()->consultarProfesionalesCobro($ids);
		
		$newarray=array();
		//$agrupe=$this->array_group_by($res, function($i){  return $i["idProfesional"] });
		foreach($res as $key => $value){
			 $newarray[$value['idProfesional']][$key] = $value;
		}
		$salida="";
	//	usort($newarray, function($a,$b){return strcmp($a->apellido, $b->apellido);});
		foreach($newarray as $key=>$item){
			$pro=Profesionales::model()->findByPk($key);
			$nombreProf='<b>'.$pro->apellido."</b>, ".$pro->nombre;
			$auxProf="";
			$debita=$this->getImportetotalDebito($item)<0?("<span style='background-color:red;color:white'><b><big> $ ".$this->getImportetotalDebito($item)."</big></b></span>"):"";
			$credito=' <span style="background-color:yellow;color:black"> <b><big>$'.$this->getImporteCreditoProf($item)."</big></b></span>";
			$totalProf=' <span style="background-color:yellow;color:black">TOTAL <b><big>$'.$this->getImporteTotalProf($item)."</big></b></span>";
		  $abierto=$key==$idProfesional?"in":'';
			$table=$debita.$credito;
			$moldeHeader='<div class="accordion-group ">
											<div class="accordion-heading"> 
												<a class="accordion-toggle cabezal" data-toggle="collapse" data-parent="#acordeonProf" href="#itemMolde_'.$key.'"><span class="badge">'.count($item).'</span> '.$nombreProf.' <span style="float:right">'.$table.'   </span></a> 
												
											 </div>';
		
		$moldeItems=	' <div id="itemMolde_'.$key.'" class="accordion-body collapse '.$abierto.'">
												<div class="accordion-inner">
												<a style="float:right" class="btn btn-success btn-mini" onclick="agregarItemProfesional('.$key.')"><b>AGREGAR</b> ITEM</a>
											 '.$this->getItemsAccor($item).'
											</div>
										</div>
								</div>';
			$script='<script>	</script>';
			$salida.=$moldeHeader.$moldeItems.$script;
		}
		$resultados["datos"]=$salida;
			$resultados["res"]=$newarray;
		$resultados["resultados"]=$res;
		
		echo CJSON::encode($resultados);
		
	}
	public function actiongetCobrosPendientes()
	{
		$criteria=new CDbCriteria;
		$criteria->compare('estado','PENDIENTE',false);
		$items=Cobros::model()->findAll($criteria);
		$arr=array();
		foreach($items as $item){
			$data['fecha']=$item->fecha;
			$data['importe']=$item->importe;
			$data['os']=$item->getObrasSociales(true);
			$data['noRetiene']=false;
			$data['id']=$item->id;

			$arr[]=$data;
		}
		echo CJSON::encode($arr);
	}
	public function init()
	{
		$this->layout="//layouts/column1";
	}
	public function actionRecalculaImporte($id)
	{
		$model=Cobros::model()->findByPk($id);
		$model->recalculaImporte();
		$this->redirect(array('index'));
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
	private function guardarFacturasOs($id,$items)
	{
		for ($i=0; $i < count($items) ; $i++) { 
			$fact=FacturasObrasSocial::model()->findByPk($items[$i]['id']);
			$model=new CobrosObrasSociales();
			$model->idObraSocial=$fact->idObraSocial;
			$model->idFactura=$fact->id;
			$model->idCobro=$id;
			if($model->save()){
				$fact->estado="CANCELADO";
				$fact->save();
			}
		}
	}
	public function actionAsignarItems()
	{
		$model=Cobros::model()->findByPk($_GET['idCobro']);
		$model->cargarItemsFactura();
	}
	public function actionCreate()
	{
		$model=new Cobros;
		$modelObra=new CobrosObrasSociales;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$model->fecha=Date('Y-m-d');
		$items=isset($_POST['items'])?$_POST['items']:[];
		if(isset($_POST['Cobros']))
		{
			$model->attributes=$_POST['Cobros'];
			$model->estado="PENDIENTE";
			if($model->save()){
				$this->guardarFacturasOs($model->id,$items);
				$model->cargarItemsFactura();
				$this->redirect(array('index','id'=>$model->id));
			}
		}
		
		$idObraSocial=isset($_POST['idObraSocial'])?$_POST['idObraSocial']:[];
		$this->render('create',array(
			'model'=>$model,'idObraSocial'=>$idObraSocial,'modelObra'=>$modelObra,"items"=>$items
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

		if(isset($_POST['Cobros']))
		{
			$model->attributes=$_POST['Cobros'];
			if($model->save())
				$this->redirect(array('index','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,'modelObra'=>$modelObra
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	private function cambiarEstadoFacturas($model)
	{
		foreach ($model->cobrosObrasSociales as $key => $value) {
			$value->factura->estado=FacturasObrasSocial::PENDIENTE;
			$value->factura->save();
		}
	}
	public function actionDelete($id)
	{
		$model=$this->loadModel($id);
		$this->cambiarEstadoFacturas($model);
		$model->delete();

	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new Cobros();
		$model->estado="PENDIENTE";  
		if(isset($_GET['Cobros'])) $model->attributes=$_GET['Cobros'];
		
		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Cobros('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Cobros']))
			$model->attributes=$_GET['Cobros'];

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
		$model=Cobros::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='cobros-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
