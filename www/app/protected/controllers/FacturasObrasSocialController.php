<?php

class FacturasObrasSocialController extends RController
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
	private function agrupadoOs($model)
	{
		$group=array();
		foreach ($model as $key => $liquidacion) 
			foreach ($liquidacion->facturas as $itemFactura) 
			 $group[$itemFactura->factura->idObraSocial][] = $itemFactura->factura;
			
		return $group;
	}
	private function getMesLetras($mes)
	{
		$mes=$mes*1;
		$meses=["","Enerto","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
		return $meses[$mes];
	}
	private function getImporteFactura($data)
	{
		$sum=0;
		foreach ($data as $key => $value) $sum+=$value->importe;
		return $sum;
	}
	private function cargarFactura($idObraSocial,$value,$fecha,$detalle)
	{
		$arr=explode('-', $fecha);

		$mes=$this->getMesLetras($arr[1]);
		$ano=date("Y");
		$detalle=isset($detalle)?$detalle:'En concepto de servicios prestados por el mes de '.$mes." del ".$ano;
		$model=new FacturasObrasSocial;
		$model->importe=$this->getImporteFactura($value);
		$model->fecha=$fecha;
		$model->idObraSocial=$idObraSocial;
		$model->estado="PENDIENTE";
		$model->idCobroTipo=2;
		$model->detalle=$detalle;
		$model->save();
		return $model->id;

	}
	private function ingresarLiquidacionesWeb()
	{
		$model=new  FacturasObraSocialLiquidacion;
			$model->idObraSocial=$idObraSocial;
			
	}
	private function ingresarItemsFactura($idFactura,$items)
	{
		foreach ($items as $key => $facturaProfesional) {
			$model=new FacturasObrasSocialItems;
			$model->idFacturaObraSocial=$idFactura;
			$model->idFacturaProfesional=$facturaProfesional->id;
			$model->save();
			$facturaProfesional->estado=FacturasProfesional::FACTURADO;
			$facturaProfesional->save();
		}
	}
	public function actioncancelarIndividualOs()
	{
		LiquidacionesWeb::model()->setPendientesCancelados(null,$_GET['idObraSocial']);
		 
	}
	public function actioningresarIndividualLote()
	{
		$model=LiquidacionesWeb::model()->getPendientesOs($_GET['idObraSocial']);
		$arr=explode('-', $_GET["fechaFactura"]);
		$detalle=$_GET['detalleFactura'];
		$fecha=$arr[2]."-".$arr[1]."-".$arr[0];
		$groupOs=$this->agrupadoOs($model);  
		foreach ($groupOs as $idObraSocial => $value){
			$idFactura=$this->cargarFactura($idObraSocial,$value,$fecha,$detalle);
			$this->ingresarItemsFactura($idFactura,$value);
		}
		LiquidacionesWeb::model()->setPendientesCancelados($idFactura,$_GET['idObraSocial']);
		                  
	}
	public function actioningresarLotePendientes()
	{
		$model=LiquidacionesWeb::model()->getPendientes();
		$arr=explode('-', $_GET["fechaFactura"]);
		$fecha=$arr[2]."-".$arr[1]."-".$arr[0];
		$groupOs=$this->agrupadoOs($model);  
		foreach ($groupOs as $idObraSocial => $value){
			$idFactura=$this->cargarFactura($idObraSocial,$value,$fecha,null);
			$this->ingresarItemsFactura($idFactura,$value);
		}
		LiquidacionesWeb::model()->setPendientesCancelados($idFactura);
		                  
	}
	public function actionAfip()
	{
		$desde=date("Y-m-d");
		$vtoCert=date(Settings::model()->getValorSistema('FE_VTO'));
		$this->render("afip",array('desde'=>$desde,'vtoCert'=>$vtoCert));
	}
	public function actionInforme()
	{
		$this->render('informe');
	}
	public function actionInforme_() 
	{
		$data=FacturasObrasSocial::model()->informe($_GET);
		$this->renderPartial('_informe',array("ocultaCabezal"=>(isset($_GET['ocultaCabezal'])?true:false),"data"=>$data,"fechaDesde"=>$_GET['fechaDesde'],"fechaHasta"=>$_GET['fechaHasta']));
	}
	public function actionComprobantesAfip()
	{
		$model=FacturasObrasSocial::model()->findByPk($_GET['idFactura']);
		$this->render("comprobantesAfip",array('model'=>$model));
	}
	public function actionConsultaRango()
	{
		$desde=$_GET['desde'];
		$hasta=isset($_GET['hasta'])?$_GET['hasta']:$_GET['desde'];
		if($hasta=="")$hasta=$desde;
		
		$q="t.fecha >='".$desde."' and t.fecha <= '".$hasta."'";
		$criteria=new CDbCriteria;
		$criteria->addCondition($q);
		$criteria->with=array("facturaElectronica","obraSocial");
		$data=FacturasObrasSocial::model()->findAll($criteria) ;
		$salida=$this->renderPartial("facturasAfip",array("data"=>$data),true);
		echo CJSON::encode($salida);
	}
	public function actionRecalculaImporte($id)
	{
		$model=FacturasObrasSocial::model()->findByPk($id);
		$model->recalculaImporte();
		$this->redirect(array('index'));
	}
	public function actionIngresoFacturaAfip()
	{
		$vto=isset($_GET['fechaVto'])?$_GET['fechaVto']:"";
		$res=FacturaElectronica::model()->ingresarFactura($_GET['idFactura'],$vto);
		echo CJSON::encode($res);
	}
	public function actionConsultaPendientes()
	{
		$model=FacturasObrasSocial::model()->getPendientes();
		$res=$this->renderPartial("facturasPendientes",array("items"=>$model),true);
		$salida['contenido']=$res;
		$salida['items']=$model;
		echo CJSON::encode($salida);
	}
	public function formatearNum($num,$cant=null)
	{
	    if($num==0) return '';
	    if($num=='') return '';
	    return  '$ '.str_replace(' ',"&nbsp;",str_pad(number_format($num,2),isset($cant)?$cant:30,' ',STR_PAD_LEFT));
	   
	}
	private function getFecha($num)
	{
		$arr=array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
		$num=$num-2;
		if($num<0)$num=11;
		return $arr[$num];
	}
	private function ingresaItemsPago($idPago)
	{
		$sql='select * from itemsLiquidacion inner join paraLiquidar on paraLiquidar.idparaLiquidar = itemsLiquidacion.idItemparaLiquidar 
 where itemsLiquidacion.idLiquidacion='.$idPago;
		$data = Yii::app()->db2->createCommand($sql)->query();
		$total=0;
			foreach($data as $item){
				$model=new PagosItems;
				$model->idPago=$idPago;
				$model->importe=$item['tipo']=='credito'?$item['importe']:(-$item['importe']);
				$model->detalle=$item['detalle'];
				$model->idTipoItemPago=$this->getTipoItem($item['tipo']);
				$model->save();
				$total+=$model->importe;
			}
			$pago=Pagos::model()->findByPk($idPago);
			$pago->importe=$total;
			$pago->save();
	}
	private function ingresaItemsCobro($idCobro)
	{
		$sql='select * from paraLiquidar 
 where idLiquidacion='.$idCobro;
		$data = Yii::app()->db2->createCommand($sql)->query();
		
			foreach($data as $item){
				$model=new CobrosItems;
				$model->idCobro=$idCobro;
				$model->importe=$item['tipo']=='credito'?$item['importe']:(-$item['importe']);
				$model->estado='CANCELADO';
				$model->idProfesional=$item['idProfesional'];
				$model->detalle=$item['detalle'];
				$model->idTipoItem=$this->getTipoItem($item['tipo']);
				$model->save();

			}
	}
	private function getTipoItem($tipo)
	{
		if($tipo=='cobro')return 102;
		if($tipo=='Debito por Obra Social')return 22;
		if($tipo=='CUOTA Obra Social')return 122;
		if($tipo=='Otros Gastos')return 42;
		if($tipo=='Debito')return 62;
		return 42;
	}
	public function actionRipPagos()
	{
		$sql='select * from liquidacionRealizada';
		$data = Yii::app()->db2->createCommand($sql)->query();
		foreach($data as $item){
			$model=new Pagos;
			$model->id=$item['idliquidacionRealizada'];
			$model->fecha=$item['fecha'];
			$model->idProfesional=$item['idProveedor'];
			$model->importe=$item['aux'];
			$model->estado='CANCELADO';

			try {
   if($item['idliquidacionRealizada']>0)
    if($model->save()){
    	$this->ingresaItemsPago($model->id);
    	$retencion=new Retenciones;
    	$retencion->idPago=$model->id;
    	$retencion->importeRetencion=$item['valor'];
    	$retencion->importeBase=$item['aux'];
    	$retencion->save();
    }
    	
    
} catch (Exception $e) {
    echo 'No se pudo: ',  $e->getMessage(), "<br>";
}
			

		}
		echo count ($data);
	}
	public function actionRipCobros()
	{
		$sql='select * from liquidacionFactura';
		$data = Yii::app()->db2->createCommand($sql)->query();
		foreach($data as $item){
			$model=new Cobros;
			$arr=explode('-',$item['fechaLiquidacion']);
			$mes=$this->getFecha($arr[1]);
			$ano=$arr[0];
			$model->id=$item['idLiquidacion'];
			$model->fecha=$item['fechaLiquidacion'];
			$model->detalle='En concepto al mes de '.$mes.' '.$ano;
			$model->importe=$item['importeLiquidacion'];
			$model->estado='CANCELADO';

			try {
    
    $factura=FacturasObrasSocial::model()->findByPk($item['idFacturaSaliente']);
    if($factura!=null){
    	$model->save();
    	$mod=new CobrosObrasSociales;
    	$mod->idObraSocial=$factura->idObraSocial;
    	$mod->idCobro=$model->id;
    	$mod->idFactura=$item['idFacturaSaliente'];
    	$mod->save();
    	$this->ingresaItemsCobro($model->id);
    	$this->ingresarPagos($model->id);

    	$factura=FacturasObrasSocial::model()->findByPk($mod->idFactura);
    	$factura->estado=FacturasObrasSocial::CANCELADO;
    	$factura->save();
    }
} catch (Exception $e) {
    echo 'No se pudo: ',  $e->getMessage(), "<br>";
}
			

		}
		echo count ($data);
	}
	private function ingresarPagos($idCobro)
	{

	}
	public function actionRipFacturasOsItems()
	{
		$this->_ripOsItems($this->ultimoIdHasta(),$this->ultimoIdDesde());
		echo 'desde '.$this->ultimoIdDesde();
		echo 'hasta '.$this->ultimoIdHasta();
	}
	private function ultimoIdDesde()
	{
		$sql='select * from itemsFacturaSaliente order by iditemsFacturaSaliente desc limit 1';
		$data = Yii::app()->db2->createCommand($sql)->query();
		if($data->count()==0)return 1;
		$res= $data->read();
		return $res['iditemsFacturaSaliente'];
	}
	private function total()
	{
		$sql='select * from itemsFacturaSaliente order by iditemsFacturaSaliente desc ';
		$data = Yii::app()->db2->createCommand($sql)->query();
		return count($data);
	}
	private function ultimoIdHasta()
	{
		$sql='select * from facturasObrasSocial_items order by id desc limit 1';
		$data = Yii::app()->db->createCommand($sql)->query();
		if($data->count()==0)return 1;
		$res= $data->read();
		return $res['id'];
	}
	private function _ripOsItems($desde,$hasta)
	{
		$sql='select * from itemsFacturaSaliente';
		$data = Yii::app()->db2->createCommand($sql)->query();
		
		foreach($data as $item){
			$model=new FacturasObrasSocialItems;
			$model->id=$item['iditemsFacturaSaliente'];
			$model->idFacturaObraSocial=$item['idFacturaSaliente'];
			$model->idFacturaProfesional=$item['idElemento'];
			try {
    $model->save();
    $mod=FacturasProfesional::model()->findByPk($item['idElemento']);
    if($mod!=null && $item['iditemsFacturaSaliente']>$desde){
    	$mod->estado='FACTURADO';
    	$mod->save();
    }
} catch (Exception $e) {
    echo 'No se pudo: ',  $e->getMessage(), "<br>";
}
			

		}
		echo "desde ".$desde;
		echo "hasta ".$hasta;
		if($this->ultimoIdDesde()<$this->ultimoIdHasta())
			$this->_ripOsItems($this->ultimoIdDesde(),$this->ultimoIdHasta());
		
	}
	public function actionRipEstadosFacturasOs()
	{
		$sql='select * from facturasSalientes';
		$data = Yii::app()->db2->createCommand($sql)->query();
		foreach($data as $item){
			$model=FacturasObrasSocial::model()->findByPk($item['idFacturaSaliente']);
			if($model!=null){
				$model->estado=$item['estado']=='Pagado'?"CANCELADO":"PENDIENTE";
				$model->save();
			}
			try {
    echo $item['idFacturaSaliente'].' - ';
} catch (Exception $e) {
    echo 'No se pudo: ',  $e->getMessage(), "\n";
}
			

		}
		echo count ($data);
	}
	public function actionRipFacturasOs()
	{
		$sql='select * from facturasSalientes';
		$data = Yii::app()->db2->createCommand($sql)->query();
		foreach($data as $item){
			$model=new FacturasObrasSocial;
			$model->id=$item['idFacturaSaliente'];
			$model->idObraSocial=$item['idCliente'];
			$model->importe=$item['importe'];
			$model->fecha=$item['fecha'];
			$model->estado='CANCELADO';
			$model->detalle=$item['descripcion'];
			try {
    if($item['estado']!='Baja')$model->save();
} catch (Exception $e) {
    echo 'No se pudo: ',  $e->getMessage(), "\n";
}
			

		}
		echo count ($data);
	}
	public function actionRipProfesionales()
	{
		$sql='select * from proveedores';
		$data = Yii::app()->db2->createCommand($sql)->query();
		foreach($data as $item){
			$model=new Profesionales;
			$arr=explode(',',$item['nombre']);
			if(count($arr)==2){
				$model->nombre=trim($arr[1]);
			$model->apellido=trim($arr[0]);
			}else{
				$model->nombre=trim($arr[0]);
			$model->apellido=trim($arr[0]);
			}
			
			$model->id=$item['idProveedor'];
			$model->email=$item['email'];
			$model->telefono=$item['telefono'];
			$model->email=$item['email'];
			$model->cuit=$item['rubro'];
			$model->regimen=$item['regimen'];
			$model->domicilio=utf8_decode($item['direccion']);
			$model->cuit=$item['cuit'];
			$model->dni=$item['rubro'];
			$model->localidad='Comodoro Rivadavia';
			//if($item['facturarObra']!=0)$model->idOsFacturacion=$item['facturarObra'];
			$cond=1;
			if($item['condicionIva']=='Responsable Insc.')$cond=1;
			if($item['condicionIva']=='Resp.Monotributo')$cond=3;
			$model->idCondicionIva=$cond;
			$model->save();

		}
		echo count ($data);
	}
	public function actionRipFacturasProfesional()
	{
		$sql='select * from ordenesTrabajo';
		$data = Yii::app()->db2->createCommand($sql)->query();
		foreach($data as $item){
			$model=new FacturasProfesional;
			$model->id=$item['idOrdenTrabajo'];
			$model->fecha=$item['fechaIngreso'];
			$model->fechaUpdate=$item['fechaIngreso'];
			$model->idProfesional=$item['idUsuarioEncargado'];
			$model->importe=$item['precio'];
			$model->idObraSocial=$item['idCliente'];
			$model->estado='PENDIENTE';
			try {
    $model->save();
} catch (Exception $e) {
    echo 'No se pudo: ',  $e->getMessage(), "<br>";
}
			

		}
		echo count ($data);
	}
	public function actionEstadosCobrosItems()
	{
		$sql='update facturasObrasSocial set estado="CANCELADO"';
		$data = Yii::app()->db->createCommand($sql)->query();
	}
	public function rip()
	{
		$this->actionRipOs();
		$this->actionRipProfesionales();
		$this->actionRipFacturasOs();
		$this->actionRipFacturasProfesional();
		$this->actionRipFacturasOsItems();
		$this->actionRipCobros();
		$this->actionRipPagos();


	}
	public function actionRipOs()
	{
		$sql='select * from clientes';
		$data = Yii::app()->db2->createCommand($sql)->query();
		foreach($data as $item){
			$model=new ObrasSociales;
			$model->nombreOs=$item['nick'];
			$model->id=$item['idCliente'];
			$model->direccion=$item['direccion'];
			$model->telefono=$item['telefono'];
			$model->email=$item['email'];
			$model->cuit=$item['cuit'];
			$model->condicionVenta='contado';
			$model->retiene=0;
			$model->localidad='Comodoro Rivadavia';
			//if($item['facturarObra']!=0)$model->idOsFacturacion=$item['facturarObra'];
			$cond=1;
			if($item['condicionIva']=='Responsable Insc.')$cond=1;
			if($item['condicionIva']=='Exento')$cond=2;
			$model->idCondicionIva=$cond;
			$model->save();

		}
		echo count ($data);
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
	public function actionCambiarEstado()
	{
		$model=FacturasObrasSocial::model()->findByPk($_GET['id']);
		if($model->estado=="PENDIENTE")$model->estado="CANCELADO";else $model->estado="PENDIENTE";
		$model->save();
		echo $model->estado;
	}
	private function _imprimirVista($vista,$facturas,$mPDF1,$duplicado)
	{
		foreach($facturas as $fact){
        			 $mPDF1->Bookmark('Facturas',0);

        		$mPDF1->AddPage('','','','','','','','','','','', 'myHeaderx', 'html_myHeader2x', '', '', 1, 1, 0, 0);
				$mPDF1->WriteHTML($this->renderPartial($vista,array("duplicado"=>$duplicado,'model'=>$fact,'pdf'=>true),true));
				$mPDF1->Bookmark($fact->obraSocial->nombreOs,1);
				
        	}
        	return $mPDF1;
	}
	public function actionExportar()
	{
		//$this->layout='//layout/layoutSoloImpresion';
		$fechaDesde=isset($_POST['fechaDesde'])?$_POST['fechaDesde']:Date('Y-m-d');
		$fechaHasta=isset($_POST['fechaHasta'])?$_POST['fechaHasta']:Date('Y-m-d');
		$duplicado=isset($_POST['facturaDuplicado'])?$_POST['facturaDuplicado']:NULL;
		if(isset($_POST['fechaDesde']))
		{
			$mPDF1 = Yii::app()->ePdf->mpdf();
        	$mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
        	$facturas=FacturasObrasSocial::model()->rango($fechaDesde,$fechaHasta);
        	$i=1;

        	if(isset($_POST['factura'])){
        		$mPDF1=$this->_imprimirVista('/facturasObrasSocial/impresion',$facturas,$mPDF1,false);
        		$mPDF1=$this->_imprimirVista('/facturasObrasSocial/impresion',$facturas,$mPDF1,true);


        	}
        	
        	
        	if(isset($_POST['resumen'])){
    //     		$mPDF1->Bookmark('Comprobantes',0);
    //     		foreach($facturas as $fact){
    //     		$mPDF1->AddPage('','','','','','','','','','','', 'myHeaderx', 'html_myHeader2x', '', '', 1, 1, 0, 0);
				// $mPDF1->WriteHTML($this->renderPartial('/facturasObrasSocial/impresionResumen',array('model'=>$fact,'pdf'=>true),true));
				// $mPDF1->Bookmark($fact->obraSocial->nombreOs,1);
				
    //     	}
        		$mPDF1=$this->_imprimirVista('/facturasObrasSocial/impresionResumen',$facturas,$mPDF1,NULL);
        	}
        	
        	$stylesheet = file_get_contents('css/impresion.css');
        	$mPDF1->WriteHTML($stylesheet, 1);
        	$mPDF1->Output();
		}  
		$this->render('exportar',array('fechaDesde'=>$fechaDesde,'fechaHasta'=>$fechaHasta));
	}
	private function getDatoLinea($texto,$long)
	{
		$texto=substr($texto, 0, $long);
		return str_pad($texto, $long, " ", STR_PAD_RIGHT);
	}
	private function getNroAfiliado($text)
	{
		$text= str_replace("/","",$text);
		$text= str_replace("-","",$text);
		$text= str_replace(".","",$text);
		return $text;
	}
	private function getLineaExportacion($dato)
	{
		$profesional=Profesionales::model()->findByPk($dato['idProfesional']);
		$nom=FacturasProfesionalNomencladores::model()->findByPk($dato['idNomenclador']);
		$fecha=date("d/m/Y", strtotime($dato['fecha']));
		$linea=$this->getDatoLinea($fecha,10);
		$linea.=$this->getDatoLinea("",10);
		$linea.=$this->getDatoLinea($profesional->nroMatriculaNacional,10);
		$linea.=$this->getDatoLinea($profesional->nroMatriculaProvincial,10);
		$linea.=$this->getDatoLinea("17",2);
		$linea.=$this->getDatoLinea($profesional->nombreProfesionales,100);
		$linea.=$this->getDatoLinea($this->getNroAfiliado($dato['nroAfiliado']),11);
		$linea.=$this->getDatoLinea("1",2);
		$linea.=$this->getDatoLinea($nom->codigoInterno,10);
		$linea.=$this->getDatoLinea($dato['cantidad'],3);
		$linea.=$this->getDatoLinea($dato['importe'],9);
		$linea.=$this->getDatoLinea($profesional->nroMatriculaNacional,10);
		$linea.=$this->getDatoLinea($profesional->nroMatriculaProvincial,10);
		$linea.=$this->getDatoLinea("17",2);
		$linea.="\n";

		return $linea;

	}
	private function datosExportacion($data)
	{
		$salida="";
		foreach($data as $dato) $salida.=$this->getLineaExportacion($dato);
		return $salida;
	}
	public function actionexportarTxt()
	{
		$model=FacturasObrasSocial::model()->findByPk($_GET['id']);
		$data=$model->facturasProfesionales;
		$datos=$this->datosExportacion($data);
		$file = "FACTURACION_".$model->obraSocial->nombreOs.".txt";
$txt = fopen($file, "w") or die("Unable to open file!");
fwrite($txt, $datos);
fclose($txt);

header('Content-Description: File Transfer');
header('Content-Disposition: attachment; filename='.basename($file));
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($file));
header("Content-Type: text/plain");
readfile($file);
	}
	public function actionExportar_()
	{
		
	}
	public function actionImprimirResumen($idFactura)
	{
		$this->layout='//layout/layoutSoloImpresion';
		$model=FacturasObrasSocial::model()->findByPk($idFactura);

		$mPDF1 = Yii::app()->ePdf->mpdf();
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
		$mPDF1->AddPage('','','','','','','','','','','', 'myHeaderx', 'html_myHeader2x', '', '', 1, 1, 0, 0);
		$contenido=$this->renderPartial('/facturasObrasSocial/impresionResumen',array('model'=>$model,'pdf'=>true),true);
		$mPDF1->WriteHTML($contenido);

		
  		if($model->facturasProfesionales_group)
    		foreach($model->facturasProfesionales_group as $item){
    			$items=$model->facturasProfesionales(array('condition'=>'idProfesional='.$item->idProfesional,"order"=>"nroOrden"));

  		
		$mPDF1->AddPage('','','','','','','','','','','', 'DETALLE PROFESIONALES', 'DETALLE PROFESIONALES', '', '', 1, 1, 0, 0);
		$contenido=$this->renderPartial('/facturasObrasSocial/_detalleResumen',array('model'=>$item,"nroLiquidacion"=>$model->id,"os"=>$model->obraSocial->nombreOs,"items"=>$items,'pdf'=>true),true);
		$mPDF1->WriteHTML($contenido);
	}
		
		$stylesheet = file_get_contents('css/impresion.css');
        $mPDF1->WriteHTML($stylesheet, 1);
        $mPDF1->Output();
		
	}
	public function actionImprimir($idFactura)
	{
		$this->layout='//layout/layoutSoloImpresion';
		$model=FacturasObrasSocial::model()->findByPk($idFactura);
		$mPDF1 = Yii::app()->ePdf->mpdf();
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
		$mPDF1->AddPage('','','','','','','','','','','', 'myHeaderx', 'html_myHeader2x', '', '', 1, 1, 0, 0);
		$datos=$this->renderPartial('/facturasObrasSocial/impresion',array('model'=>$model,'pdf'=>true),true);
		$datos.=$this->renderPartial('/facturasObrasSocial/impresion',array('model'=>$model,'pdf'=>true,'duplicado'=>true),true);

		$mPDF1->WriteHTML($datos);
		$stylesheet = file_get_contents('css/impresion.css');
        $mPDF1->WriteHTML($stylesheet, 1);
        $mPDF1->Output();
	}
	public function actionGetPendientes($id)
	{
		$criteria=new CDbCriteria;
		$criteria->compare('idObraSocial',$id,false);
		$criteria->compare('estado',FacturasObrasSocial::PENDIENTE,false);
		$criteria->order='t.fecha desc';
		$criteria->with="facturaElectronica";
		$items=FacturasObrasSocial::model()->findAll($criteria);
		if($id==''){
		CJSON::encode(array());
			return;
		}
		echo CJSON::encode($items);
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

	public function actionAgregar()
	{
		$model=new Cobros;
		$modelOs=new CobrosObrasSociales;
		$salida['valido']=true;
		$salida['error']='';
		$salida['cargarOtro']=isset($_POST['cargarOtro']);
		
			$modelOs->idFactura=$_POST['idFactura'];
			$modelOs->idObraSocial=$_POST['idObraSocial'];
			$model->fecha=$_POST['fecha'];
			$model->importe=$_POST['importe'];
			$model->estado=FacturasObrasSocial::PENDIENTE;
			if(!$model->validate()){
				$salida['valido']=false;
				$salida['error']='Hay datos invalidos en el Cobro!';
				echo CJSON::encode($salida);
				return;
			}
			if(!$modelOs->validate()){
				$salida['valido']=false;
				$salida['error']='No ha seleccionado Obra Social o Factura!';
				echo CJSON::encode($salida);
				return;
			}
			$model->save();
			$modelOs->idCobro=$model->id;
			$modelOs->save();
			foreach($_POST['items'] as $item)
				CobrosItems::model()->ingresar($item,$model->id,$_POST['idFactura']);
				
		
		if($modelOs->idFactura){
			$factura=FacturasObrasSocial::model()->findByPk($modelOs->idFactura);
			$factura->estado=FacturasObrasSocial::CANCELADO;
		$factura->save();
		}
// 	/	print_r($salida);
		echo CJSON::encode($salida);
// 		else{
// 			$salida['valido']=false;
// 				$salida['error']='No se ha podido cambiar el estado a la factura!';
// 				echo CJSON::encode($salida);
// 				return;
// 		}
	} 
	public function actionCreate()
	{
		$model=new FacturasObrasSocial; 

		if(isset($_POST['FacturasObrasSocial']))
		{
			$model->attributes=$_POST['FacturasObrasSocial'];
			if($model->save()){
				$refactura=isset($_POST['refacturacion'])?true:false;
				echo FacturasObrasSocialItems::model()->agregar($model->idObraSocial,$model->id,$refactura);
				if(isset($_POST['nuevaCarga'])) $this->redirect(array('create','id'=>$model->id));
					else $this->redirect(array('index','id'=>$model->id));
			}
				
		}
		
		if(isset($_GET['idObraSocial']))$model->idObraSocial=$_GET['idObraSocial']+1;
		$model->fecha=Date('Y-m-d');
		$model->idCobroTipo=2;
		$_POST['nuevaCarga']=true;
		$model->estado=FacturasObrasSocial::PENDIENTE;
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

		if(isset($_POST['FacturasObrasSocial']))
		{
			$model->attributes=$_POST['FacturasObrasSocial'];
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
		$transaction=$model->dbConnection->beginTransaction();
		$this->actualizarItems($id);
		$this->actualizarItemsLiquidacion($id);
		try
		{
			$model->delete();
			$transaction->commit(); 
			}catch(Exception $e){
				  $transaction->rollBack();
				  throw new CHttpException(0,'No se puede quitar la factura por que hay un cobro sobre la misma!. Elimine el cobro de la factura y luego vuelva a intentarlo');
			}
		
	}
	private function actualizarItems($id)
	{
		$itemsFactura=FacturasObrasSocialItems::model()->items($id);
		foreach($itemsFactura as $item){
			$item->facturaProfesional->estado=FacturasProfesional::PENDIENTE;
			$item->facturaProfesional->save();
		}
	}
	private function actualizarItemsLiquidacion($id)
	{
		$itemsFactura=FacturasObraSocialLiquidacionesWeb::model()->items($id);
		foreach($itemsFactura as $item){
			$model=LiquidacionesWeb::model()->findByPk($item->idLiquidacionWeb);
			$model->estado="PENDIENTE";
			if($model->save())$item->delete();
		}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new FacturasObrasSocial('search');
		$model->estado="PENDIENTE";  
		if(isset($_GET['FacturasObrasSocial']))
			$model->attributes=$_GET['FacturasObrasSocial'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new FacturasObrasSocial('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['FacturasObrasSocial']))
			$model->attributes=$_GET['FacturasObrasSocial'];

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
		$model=FacturasObrasSocial::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='facturas-obras-social-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
