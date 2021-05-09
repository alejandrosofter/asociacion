<?php

class FacturaElectronicaController extends RController
{
	public $layout='//layouts/main';

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
	public function actionVaciarTA()
	{
		$cuit=Settings::model()->getValorSistema('DATOS_EMPRESA_CUIT');
		$archivo="assetsFacturaElectronica/afip.php/src/Afip_res/TA-".$cuit."-wsfe.xml";
		$salida=false;
		if (file_exists($archivo))$salida=unlink($archivo);
		
		
		echo CJSON::encode($salida);
	}
	public function actionDatosComprobante()
	{
		$datosComp=FacturaElectronica::model()->getDatosComprobante($_GET['id']);
		$this->render('datosComprobante',array( 'datosComp'=>$datosComp));
	}
	public function actionDatosComprobanteAFIP()
	{
		$idTipoComprobante=isset($_GET['idTipoComprobante'])?$_GET['idTipoComprobante']:11;
		$res= FacturaElectronica::model()->getDatosComprobanteAFIP($_GET['nro'],$idTipoComprobante);
		echo CJSON::encode($res);
	}
	
	public function actionGetComprobante()
	{
		$nro=$_GET['nro'];
		$idOs=$_GET['idObraSocial'];
		$datosComp=FacturaElectronica::model()->getDatosComprobanteNro($nro,$idOs);
		echo CJSON::encode($datosComp);
	}
	public function actionGenerarPk()
	{
		$archivo="privada.key";
		if (!file_exists($archivo)) 
			$res= exec("openssl genrsa -out ".$archivo." 2048");
		else $res=false;
		$myfile = fopen($archivo, "r") or die("Unable to open file!");
		$data= fread($myfile,filesize($archivo));
		fclose($myfile);
		Settings::model()->setValorSistema("FE_PK",$data);
		$salida=array("archivo"=>$data,"resultado"=>$res);
		echo CJSON::encode($salida);
	}
	public function actionGenerarPedido()
	{
		$cuit=Settings::model()->getValorSistema('DATOS_EMPRESA_CUIT');
		$pk="privada.key";
		$nombreEmpresa="asociacion_";
		$nombreServer="server_";

		$archivo="pedido.csr";
		if (file_exists($archivo)) unlink($archivo);
		$cadenaPedido='openssl req -new -key '.$pk.' -subj "/C=AR/O='.$nombreEmpresa.'/CN='.$nombreServer.'/serialNumber=CUIT '.$cuit.' " -out '.$archivo;
		$res= shell_exec($cadenaPedido);
		$data=$cadenaPedido;
		//$res="error";
		if(file_exists($archivo)) {
			$myfile = fopen($archivo, "r");
			$data= fread($myfile,filesize($archivo));
			fclose($myfile);
			Settings::model()->setValorSistema("FE_PEDIDO",$data);
		}
		
		
		
		
		$salida=array("archivo"=>$data,"resultado"=>$res);
		echo CJSON::encode($salida);
	}
	public function actionTestCertificados()
	{
		$res=FacturaElectronica::model()->testCertificados();
		echo CJSON::encode($res);
	}
	public function actionEscribirCertificadosAfip()
	{
		$certificado=Settings::model()->getValorSistema('FE_CERTIFICADO');
		$pk=Settings::model()->getValorSistema('FE_PK');
		$pathCertificado=__DIR__."/../../assetsFacturaElectronica/afip.php/src/Afip_res/cert";
		$pathPk=__DIR__."/../../assetsFacturaElectronica/afip.php/src/Afip_res/key";
		
		$this->guardarArchivo($pathCertificado,$certificado);
		$this->guardarArchivo($pathPk,$pk);
		echo CJSON::encode($pathCertificado);
	}
	private function guardarArchivo($path,$data)
	{
		$myfile = fopen($path, "w") or die("Unable to open file!");
		fwrite($myfile, $data);
		fclose($myfile);
	}
	public function accessRules()
	{
		return array(
		);
	}
	public function actionIngresar()
	{
		FacturaElectronica::model()->ingresarFactura();
	}


}
