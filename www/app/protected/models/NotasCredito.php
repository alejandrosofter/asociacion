<?php

/**
 * This is the model class for table "NotasCredito".
 *
 * The followings are the available columns in table 'NotasCredito':
 */

class NotasCredito extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return NotasCredito the static model class
	 */
	 public $buscar;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'notasCredito';
	}
	public function getCuitAfip()
	{
		if(isset($this->obraSocial->obraSocialCargo))return str_replace("-","",$this->obraSocial->obraSocialCargo->cuit);
		return str_replace("-","",$this->obraSocial->cuit);
		

	}
	public function cargoAfip()
	{
		return (isset($this->codigo));
	}
	

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array("anulacion","safe"),
			array('comprobanteAsociado', 'numerical', 'integerOnly'=>true),
			array('idObraSocial, detalle,idTipoComprobanteElectronico, fecha,importe', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('fecha,esNotaDebito,id,anulacion, idObraSocial, importe,detalle', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
		public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'obraSocial' => array(self::BELONGS_TO, 'ObrasSociales', 'idObraSocial'),
			'facturaElectronica' => array(self::HAS_ONE, 'FacturaElectronica', 'idComprobante'),
			'tipoComprobanteElectronico' => array(self::BELONGS_TO, 'TiposComprobantesElectronicos', 'idTipoComprobanteElectronico'),
		);
	}


	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fecha' => 'Fecha',
			'idObraSocial' => 'Obra Social',
			'importe' => '$ Importe',
			'detalle' => 'Detalle',
			'comprobanteAsociado' => 'Nro Comprobante Asociado',
			'idTipoComprobanteElectronico' => 'Tipo Comprobante',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->order="t.id desc";
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	private function getImporte($num)
	{
		return $num;
	}
// $url = Yii::app()->basePath.'/../assetsFacturaElectronica/afip.php/src/Afip.php';
	
	public function ingresarNotaCreditoAfip($id)
	{
		$CUIT_EMISOR=(float) Settings::model()->getValorSistema('DATOS_EMPRESA_CUIT')*1;
		
		$url = Yii::app()->basePath.'/../assetsFacturaElectronica/afip.php/src/Afip.php';

		include $url; 

		$afip = new Afip(array('CUIT' => $CUIT_EMISOR));
		// print_r($afip->ElectronicBilling->GetOptionsTypes());
		// return; 
		$model=$this->model()->findByPk($id);
		$obraSocial=ObrasSociales::model()->findByPk($model->idObraSocial);
		$fecha=str_replace("-", "", $model->fecha);
		
		
		
		
		$PUNTO_VENTA=3;
		$TIPO_COMPROBANTE=$model->tipoComprobanteElectronico->id; //factura C // factura b 6
		// if($obraSocial->realizaFacturaCredito)$TIPO_COMPROBANTE=213;
		$CONCEPTO=1;
		$FECHA_OPCION=($CONCEPTO==2||$CONCEPTO==3)?intval(date('Ymd')):NULL;
		//27116358005
		
		$cuit_=$model->getCuitAfip();

		


		
		$importeTotal=number_format($model->importe,2,".","");
		$importeNeto=number_format($model->importe/1.21,2,".","");
		//$importeIva=number_format($importeTotal-$importeNeto,2,".","");
		$importeIva=number_format(0,2,".","");
		try{
			$ultimoComprobante=FacturaElectronica::model()->getProximoComprobante($model->idObraSocial,$afip,$TIPO_COMPROBANTE);
			
			

		}catch(Exception $e){
			$ultimoComprobante=1;
		}
		
		$cuitReceptor=(float)$cuit_;


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
			'CbteTipo' 		=> $TIPO_COMPROBANTE, // Tipo de comprobante (ver tipos disponibles) 
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
			'FchServHasta' 	=> $FECHA_OPCION, // (Opcional) Fecha de fin del servicio (yyyymmdd), obligatorio para Concepto 2 y 3
			'FchVtoPago' 	=> $FECHA_OPCION, // (Opcional) Fecha de vencimiento del servicio (yyyymmdd), obligatorio para Concepto 2 y 3
			'MonId' 		=> 'PES', //Tipo de moneda usada en el comprobante (ver tipos disponibles)('PES' para pesos argentinos) 
			'MonCotiz' 		=> 1, // Cotización de la moneda usada (1 para pesos argentinos)  
			//'CbtesAsoc' 	=> [],
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
			//'Opcionales' 	=> array(), 
			// 'Compradores' 	=> array( // (Opcional) Detalles de los clientes del comprobante 
			// 	array(
			// 		'DocTipo' 		=> 80, // Tipo de documento (ver tipos disponibles) 
			// 		'DocNro' 		=> $cuitReceptor, // Numero de documento
			// 		'Porcentaje' 	=> 100 // Porcentaje de titularidad del comprador
			// 	)
			// )
);
		print_r($data);
		if($TIPO_COMPROBANTE==212 ||$TIPO_COMPROBANTE==213){
			$comprobanteAsociado=array();
			$compAsociado=isset($_GET['id'])?FacturaElectronica::model()->getDatosComprobanteNro($model->comprobanteAsociado,$model->idObraSocial,$afip):null;
			
		if(isset($compAsociado)){

			$comprobanteAsociado=array(
				array(
				'Tipo' 		=> $compAsociado->CbteTipo, // Tipo de comprobante (ver tipos disponibles) 
				'PtoVta' 	=> $compAsociado->PtoVta, // Punto de venta
				'Nro' 		=> $compAsociado->CbteDesde, // Numero de comprobante
				'Cuit' 		=> $CUIT_EMISOR,// (Opcional) Cuit del emisor del comprobante
				'CbteFch'	=> $compAsociado->CbteFch
				)
		);
			$data['CbtesAsoc']=$comprobanteAsociado;
			// 0070178120000004281944 CBU ASOC
			$opcional=array(
				// array(
				// 	'Id' 		=> 2101, // Codigo de tipo de opcion (ver tipos disponibles) 
				// 	'Valor' 	=> "0070178120000004281944" // Valor 
				// ),
				// array(
				// 	'Id' 		=> 23, // Codigo de tipo de opcion (ver tipos disponibles) 
				// 	'Valor' 	=> "ASOC" // Valor 
				// ),
				array(
					'Id' 		=> 22, // Codigo de tipo de opcion (ver tipos disponibles) 
					'Valor' 	=> $model->anulacion==1?"S":"N" // Valor 
				)
			);
			$data['Opcionales']=$opcional;
		}
			
			
		}
		return FacturaElectronica::model()->ingresarNotaCredito($data,$TIPO_COMPROBANTE,$PUNTO_VENTA,$CONCEPTO,$model,$afip);

	}
}