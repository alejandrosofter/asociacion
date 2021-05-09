<?php
class FacturaElectronica extends CActiveRecord
{


	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'facturaElectronica';
	}
	public function rules()
	{
		return array(
			array('idFacturaObraSocial', 'length', 'max'=>255),
			array('vto, codigo,fecha,nroComprobante,tipoComprobante,puntoVenta,fechaVtoPago,concepto', 'safe'),
			array('buscar,id,fecha, idFacturaObraSocial,fechaVtoPago,nroComprobante,tipoComprobante,puntoVenta,concepto, vto, codigo', 'safe', 'on'=>'search')
		);
	}
	public function relations()
	{
		return array(
			'obraSocial' => array(self::BELONGS_TO, 'ObrasSociales', 'idFacturaObraSocial'),
		);
	}
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idFacturaObraSocial' => 'idFacturaObraSocial',
			'vto' => 'Vyo',
			'codigo' => 'cod',
		);
	}
	private function getImporte($num)
	{

		$arr=explode(".", $num);
		if($num==0){
			$arr[0]="0";
			$arr[1]="0";
		}

		$parteEntera=str_pad($arr[0], 13, "0", STR_PAD_LEFT);
		$parteDecimal=str_pad($arr[1], 2, "0", STR_PAD_LEFT);
		//return $parteEntera.$parteDecimal;
		return $num;
	}
	public function testCertificados()
	{
		$url = Yii::app()->basePath.'/../assetsFacturaElectronica/afip.php/src/Afip.php';
		include_once $url; 
		$CUIT_EMISOR=(float) Settings::model()->getValorSistema('DATOS_EMPRESA_CUIT');

		$afip = new Afip(array('CUIT' => $CUIT_EMISOR));
		$data=array("error"=>"","datos"=>NULL);
		try{
			$data['datos']=$afip->ElectronicBilling->GetVoucherTypes();
		}catch(Exception $e){
			$data['error']=$e->getMessage();
		}
		return $data;
	}
	public function ingresarNotaCredito($data,$TIPO_COMPROBANTE,$PUNTO_VENTA,$CONCEPTO,$model,$afip)
	{
		$CUIT_EMISOR=(float) Settings::model()->getValorSistema('DATOS_EMPRESA_CUIT')*1;
		
		if(!isset($afip) ){
			$url = Yii::app()->basePath.'/../assetsFacturaElectronica/afip.php/src/Afip.php';
			include_once $url; 
			$afip = new Afip(array('CUIT' => $CUIT_EMISOR));
		}
		$CBU_EMISOR=(float) Settings::model()->getValorSistema('DATOS_EMPRESA_CBU')*1;
		
		try{

			$resultado= array("error"=>false,"datos"=>$afip->ElectronicBilling->CreateVoucher($data));
			
			
				$model->vto=$resultado["datos"]['CAEFchVto'];
				$model->codigo=$resultado["datos"]['CAE'];
				$model->nroComprobante=$data['CbteDesde'];
				$model->tipoComprobante=$TIPO_COMPROBANTE;
				$model->puntoVenta=$PUNTO_VENTA;
				$model->concepto=$CONCEPTO;
				$model->save();
			
			
			return $resultado;
		}catch (Exception $e){
			echo $e->getMessage();
			return array("error"=>true,"datos"=>$e->getMessage()); 
		}
	}
	public function getDatosComprobante($idFacturaObraSocial,$afip=null)
	{
		$CUIT_EMISOR=(float) Settings::model()->getValorSistema('DATOS_EMPRESA_CUIT')*1;
		
		if(!isset($afip) ){
			$url = Yii::app()->basePath.'/../assetsFacturaElectronica/afip.php/src/Afip.php';
			include_once $url; 
			$afip = new Afip(array('CUIT' => $CUIT_EMISOR));
		}
				$model=FacturasObrasSocial::model()->findByPk($idFacturaObraSocial);
		$factura=$model->facturaElectronica;
		$PUNTO_VENTA=3;
		$TIPO_COMPROBANTE=11;
		$CBU_EMISOR=(float) Settings::model()->getValorSistema('DATOS_EMPRESA_CBU')*1;
		
		$voucher_info = $afip->ElectronicBilling->GetVoucherInfo($factura->nroComprobante,$PUNTO_VENTA,$TIPO_COMPROBANTE); //Devuelve la información del comprobante 1 para el punto de venta 1 y el tipo de comprobante 6 (Factura B)
		return $voucher_info;
	}
	public function getDatosComprobanteAFIP($nro,$idTipoComprobante,$afip=null)
	{
		$CUIT_EMISOR=(float) Settings::model()->getValorSistema('DATOS_EMPRESA_CUIT')*1;
		
		if(!isset($afip) ){
			$url = Yii::app()->basePath.'/../assetsFacturaElectronica/afip.php/src/Afip.php';
			include_once $url; 
			$afip = new Afip(array('CUIT' => $CUIT_EMISOR));
		}
		
		$PUNTO_VENTA=3;
		$TIPO_COMPROBANTE=$idTipoComprobante;//$model->realizaFacturaCredito?211:11;
		
		$CBU_EMISOR=(float) Settings::model()->getValorSistema('DATOS_EMPRESA_CBU')*1;

		return $afip->ElectronicBilling->GetVoucherInfo($nro*1,$PUNTO_VENTA,$TIPO_COMPROBANTE); //Devuelve la información del comprobante 1 para el punto de venta 1 y el tipo de comprobante 6 (Factura B)
		

	}
	public function getDatosComprobanteNro($nro,$idOs,$afip=null)
	{
		$CUIT_EMISOR=(float) Settings::model()->getValorSistema('DATOS_EMPRESA_CUIT')*1;
		
		if(!isset($afip) ){
			$url = Yii::app()->basePath.'/../assetsFacturaElectronica/afip.php/src/Afip.php';
			include_once $url; 
			$afip = new Afip(array('CUIT' => $CUIT_EMISOR));
		}
		$model=ObrasSociales::model()->findByPk($idOs);

		$PUNTO_VENTA=3;
		$TIPO_COMPROBANTE=11;//$model->realizaFacturaCredito?211:11;
		
		$CBU_EMISOR=(float) Settings::model()->getValorSistema('DATOS_EMPRESA_CBU')*1;

		$voucher_info = $afip->ElectronicBilling->GetVoucherInfo($nro*1,$PUNTO_VENTA,$TIPO_COMPROBANTE); //Devuelve la información del comprobante 1 para el punto de venta 1 y el tipo de comprobante 6 (Factura B)
		$voucher_info->obraSocial=$model->nombreOs;
		$voucher_info->idObraSocial=$model->id;
		// return array("nro"=>$nro,"PV"=>$PUNTO_VENTA,"TIPO"=>$TIPO_COMPROBANTE);
		$TIPO_COMPROBANTE=211;
		if(!isset($voucher_info))$voucher_info = $afip->ElectronicBilling->GetVoucherInfo($nro*1,$PUNTO_VENTA,$TIPO_COMPROBANTE);
		return $voucher_info;

	}
	public function getProximoComprobante($idOs,$afip,$TIPO_COMPROBANTE=null)
	{
		$CUIT_EMISOR=(float) Settings::model()->getValorSistema('DATOS_EMPRESA_CUIT')*1;
		
		if(!isset($afip) ){
			$url = Yii::app()->basePath.'/../assetsFacturaElectronica/afip.php/src/Afip.php';
			include_once $url; 
			$afip = new Afip(array('CUIT' => $CUIT_EMISOR));
		}
		$model=ObrasSociales::model()->findByPk($idOs);

		$PUNTO_VENTA=3;

		if(!isset($TIPO_COMPROBANTE))$TIPO_COMPROBANTE=$model->realizaFacturaCredito?211:11;
		$CBU_EMISOR=(float) Settings::model()->getValorSistema('DATOS_EMPRESA_CBU')*1;
		
		$voucher_info = $afip->ElectronicBilling->GetLastVoucher($PUNTO_VENTA, $TIPO_COMPROBANTE)+1;

		return $voucher_info;

	}
	public function ingresarFactura($id,$vto)
	{
		$url = Yii::app()->basePath.'/../assetsFacturaElectronica/afip.php/src/Afip.php';
		include_once $url; 
		$model=FacturasObrasSocial::model()->findByPk($id);
		$fecha=str_replace("-", "", Date('Y-m-d'));
		$arrVto=explode("/", $vto);
		$PUNTO_VENTA=3;
		$TIPO_COMPROBANTE=11; //factura C // factura b 6 //201 factura de credito electronica mipymes
		$CBU_EMISOR=Settings::model()->getValorSistema('DATOS_EMPRESA_CBU');
		
		$CONCEPTO=1;
		$FECHA_OPCION=($CONCEPTO==2||$CONCEPTO==3)?intval(date('Ymd')):NULL;
		$minimoFc=Settings::model()->getValorSistema('DATOS_EMPRESA_MINIMO_FC')*1;

		// $FECHA_VTO_PAGO=date("Y-m-")."10";
		// if(strtotime($FECHA_VTO_PAGO) < strtotime(Date("Y-m-d")))
		// 	$FECHA_VTO_PAGO=date("Y-m-")."20";
		// $FECHA_VTO_PAGO=intval(date('Ymd', strtotime("+2 months", strtotime($FECHA_VTO_PAGO))));
		$fechaVto=Date('Y-m-d');
		if(count($arrVto)>1)$fechaVto=$arrVto[2]."-".$arrVto[1]."-".$arrVto[0];

		$FECHA_VTO_PAGO=count($arrVto)>1?intval($arrVto[2]."".$arrVto[1]."".$arrVto[0]):$fechaVto;

		$CUIT_EMISOR=(float) Settings::model()->getValorSistema('DATOS_EMPRESA_CUIT')*1;
		//27116358005
		$cuit_=$model->getCuitAfip();
		

		$afip = new Afip(array('CUIT' => $CUIT_EMISOR));
		
		$importeTotal=number_format($model->importe,2,".","");
		$importeNeto=number_format($model->importe/1.21,2,".","");
		//$importeIva=number_format($importeTotal-$importeNeto,2,".","");
		$importeIva=number_format(0,2,".","");
		try{
			$ultimoComprobante=$afip->ElectronicBilling->GetLastVoucher($PUNTO_VENTA, $TIPO_COMPROBANTE)+1;
		}catch(Exception $e){
			$ultimoComprobante=1;
		}
		$cuitReceptor=(float)$model->getCuitAfip();
		// $tipos=$afip->ElectronicBilling->GetVoucherTypes();
		// print_r($tipos);
		// return;
		//  echo " total:".$this->getImporte($importeTotal);
		//  echo " importeNeto:".$this->getImporte($importeNeto);
		//  echo " importeIva:".$this->getImporte($importeIva);
		// return;
		
		$data = array(
			'CantReg' 		=> 1, // Cantidad de comprobantes a registrar
			'PtoVta' 		=> $PUNTO_VENTA, // Punto de venta
			'CbteTipo'=> $TIPO_COMPROBANTE ,
			'Concepto' 		=> $CONCEPTO, // Concepto del Comprobante: (1)Productos, (2)Servicios, (3)Productos y Servicios
			'DocTipo' 		=> 80, // Tipo de documento del comprador (ver tipos disponibles)
			'DocNro' 		=> $cuitReceptor, // Numero de documento del comprador
			'CbteDesde' 	=> $ultimoComprobante, // Numero de comprobante o numero del primer comprobante en caso de ser mas de uno
			'CbteHasta' 	=> $ultimoComprobante, // Numero de comprobante o numero del ultimo comprobante en caso de ser mas de uno
			'CbteFch' 		=> $fecha, //intval(date('Ymd')), // (Opcional) Fecha del comprobante (yyyymmdd) o fecha actual si es nulo
			'ImpTotal' 		=> $this->getImporte($importeTotal), // Importe total del comprobante
			'ImpTotConc' 	=> 0, // Importe neto no gravado
			'ImpNeto' 		=> $this->getImporte($importeTotal), // Importe neto gravado
			'ImpOpEx' 		=> 0, // Importe exento de IVA
			'ImpIVA' 		=> $this->getImporte($importeIva), //Importe total de IVA
			'ImpTrib' 		=> 0, //Importe total de tributos
			'FchServDesde' 	=> $FECHA_OPCION, // (Opcional) Fecha de inicio del servicio (yyyymmdd), obligatorio para Concepto 2 y 3
			"Opcionales"	=> NULL,
			'FchServHasta' 	=> $FECHA_OPCION, // (Opcional) Fecha de fin del servicio (yyyymmdd), obligatorio para Concepto 2 y 3
			
			'MonId' 		=> 'PES', //Tipo de moneda usada en el comprobante (ver tipos disponibles)('PES' para pesos argentinos) 
			'MonCotiz' 		=> 1, // Cotización de la moneda usada (1 para pesos argentinos)  
			// 'CbtesAsoc' 	=> array( // (Opcional) Comprobantes asociados
			// array(
			// 	'Tipo' 		=> $TIPO_COMPROBANTE, // Tipo de comprobante (ver tipos disponibles) 
			// 	'PtoVta' 	=> $PUNTO_VENTA, // Punto de venta
			// 	'Nro' 		=> $ultimoComprobante, // Numero de comprobante
			// 	'Cuit' 		=> $CUIT_EMISOR // (Opcional) Cuit del emisor del comprobante
			// 	)
			// ),
			// 'Tributos' 		=> array( // (Opcional) Tributos asociados al comprobante
			// 	array(
			// 		'Id' 		=>  99, // Id del tipo de tributo (ver tipos disponibles) 
			// 		'Desc' 		=> 'Ingresos Brutos', // (Opcional) Descripcion
			// 		'BaseImp' 	=> 150, // Base imponible para el tributo
			// 		'Alic' 		=> 5.2, // Alícuota
			// 		'Importe' 	=> 7.8 // Importe del tributo
			// 	)
			// ), 
			// 'Iva' 			=> array( // (Opcional) Alícuotas asociadas al comprobante
			// 	array(
			// 		'Id' 		=> 5, // Id del tipo de IVA (ver tipos disponibles) 
			// 		'BaseImp' 	=> $this->getImporte($importeNeto), // Base imponible
			// 		'Importe' 	=> $this->getImporte($importeIva) // Importe 
			// 	)
			// ), 
			
			// 'Compradores' 	=> array( // (Opcional) Detalles de los clientes del comprobante 
			// 	array(
			// 		'DocTipo' 		=> 80, // Tipo de documento (ver tipos disponibles) 
			// 		'DocNro' 		=> $cuitReceptor, // Numero de documento
			// 		'Porcentaje' 	=> 100 // Porcentaje de titularidad del comprador
			// 	)
			// )
);
		if($model->obraSocial->realizaFacturaCredito && ($model->importe>$minimoFc)){
			$TIPO_COMPROBANTE=211;
			$data['Opcionales'] = array( // (Opcional) Campos auxiliares
				array(
					'Id' 		=> 2101, // Codigo de tipo de opcion (ver tipos disponibles) 
					'Valor' 	=> $CBU_EMISOR // Valor 
				),
				array(
					'Id' 		=> 27, // Codigo de tipo de opcion (ver tipos disponibles) 
					'Valor' 	=> "SCA" // Valor 
				)
			) ;
			$data["CbteTipo"]=$TIPO_COMPROBANTE;
			$data['FchVtoPago'] = $FECHA_VTO_PAGO;
			try{
			$ultimoComprobante=$afip->ElectronicBilling->GetLastVoucher($PUNTO_VENTA, $TIPO_COMPROBANTE)+1;
		}catch(Exception $e){
			$ultimoComprobante=1;
		}
		$data['CbteDesde']=$ultimoComprobante;
		$data['CbteHasta']=$ultimoComprobante;
			

			
		}
		$data[]=array('CbteTipo'=> $TIPO_COMPROBANTE );
		try{

			$resultado= array("error"=>false,"datos"=>$afip->ElectronicBilling->CreateVoucher($data));
			$factura=new FacturaElectronica;
			$factura->fecha=$fecha;
			$factura->idFacturaObraSocial=$model->id;
			$factura->vto=$resultado["datos"]['CAEFchVto'];
			$factura->codigo=$resultado["datos"]['CAE'];
			$factura->nroComprobante=$ultimoComprobante;
			$factura->tipoComprobante=$TIPO_COMPROBANTE;
			$factura->puntoVenta=$PUNTO_VENTA;
			$factura->fechaVtoPago=$fechaVto;
			$factura->concepto=$CONCEPTO;
			$factura->save();
			return $resultado;
		}catch (Exception $e){
			return array("error"=>true,"datos"=>$e->getMessage()); 
		}

	}



}