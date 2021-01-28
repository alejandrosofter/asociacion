<?php

/**
 * This is the model class for table "pagos_items".
 *
 * The followings are the available columns in table 'pagos_items':
 * @property integer $id
 * @property integer $idPago
 * @property double $importe
 * @property string $detalle
 * @property integer $idTipoItemPago
 *
 * The followings are the available model relations:
 * @property Pagos $idPago0
 * @property PagosTipos $idTipoItemPago0
 * @property PagosItemsFacturaProfesional[] $pagosItemsFacturaProfesionals
 */
class PagosItems extends CActiveRecord
{
	const ID_TIPO_IMPUESTO=62;
	const ID_TIPO_IMPUESTORETENCION=82;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PagosItems the static model class
	 */
	 public $buscar;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function ingresaPorImpuesto($id,$impuesto,$noRetiene)
	{
		$importe=$this->importeImpuesto($id,$impuesto);
		$model=new PagosImpuestos;
		$model->idPago=$id;
		$model->idImpuesto=$impuesto->id;
		$model->importe=-money_format('%i',($this->getImporte($impuesto,$importe,$id)));
		if($model->importe<0){
			if($impuesto->esRetencion){
				if($noRetiene==0){
					Retenciones::model()->ingresar($model->importe,$importe,$id);
					$model->save();
					}
			}else{
				$model->save();
			}
			
		}
			
		
		$pago=Pagos::model()->findByPk($id);
		$pago->updateImporte();
	}
	private function importeImpuesto($id,$impuesto)
	{
		$items=self::model()->porTipo($id,$impuesto);
		$importe=0;
		foreach($items as $item){
			if($item->tipo->aplicaEnImpuesto)$importe+=$item->importe;
			if(isset($item->itemFactura->facturaObraSocial))
			if($impuesto->esRetencion && $item->itemFactura->facturaObraSocial->obraSocial->retiene==1)
				$importe-=$item->importe; //le resto el mismo importe
		}
		//$impuestosAplicados=PagosImpuestos::model()->getImpuestosAplicados($id);
		return $importe;//+$impuestosAplicados; //sumo ya que el valor que viene es negativo!
	}
	public function importeImpuestoRetencion($id,$impuestoRetencion)
	{
		$items=self::model()->porTipo($id,$impuestoRetencion);
		$importe=0;
		foreach($items as $item){
			if($item->tipo->aplicaEnImpuesto)$importe+=$item->importe;
			if(isset($item->itemFactura->facturaObraSocial))
			if($item->itemFactura->facturaObraSocial->obraSocial->retiene==1)
				$importe-=$item->importe; //le resto el mismo importe
		}
		return $importe;
	}
	private function getImporte($impuesto,$importe,$idPago)
	{
		$pago=Pagos::model()->findByPk($idPago);
		if(!$impuesto->esRetencion)return $importe*$impuesto->porcentaje;
		else return $this->getImporteRetencion($impuesto,$pago);
	}
	public function getImporteRetencion($impuesto,$pago)
	{
		$importe=$this->importeImpuestoRetencion($pago->id,$impuesto);
		
		if($pago->profesional->idCondicionIva==3) return 0; //NO PAGAN LOS MONOTRIBUTISTAS
			if($pago->profesional->regimen=='actual') return $this->porcentualActual($importe,$pago);
		return $this->porcentual94($importe,$pago);
	}
	private function porcentual94($importe,$pago)
	{
		$importeAretener=$this->getImporteRetener($pago->fecha,$pago->idProfesional);
		$importeRetenciones=$this->getImporteRetenenciones($pago->fecha,$pago->idProfesional);
		$diferencia=$importeAretener-self::IMPORTE_NO_SUJETO_94;
		
		$imp=($diferencia*self::PORCENTAJE_94)+$importeRetenciones;

		
		$detalle='<b>DETALLE DE LA RETENCION COD 94</b> <br>';
		$detalle.='<b>LIQUIDACION</b>  :$ '.number_format($importeAretener,2).' <br>';
		$detalle.='<b>MONTO NO SUJETO A RETENCION</b>  :$ '.number_format(self::IMPORTE_NO_SUJETO_94,2).' <br>';
		$detalle.='<b>RETENCIONES</b> :$ '.number_format($importeRetenciones,2).' <br>';
		$detalle.='<b>DIFERENCIA</b> :$ '.number_format($diferencia,2).' <br>';
		$detalle.='<b><big>CALCULO ((DIFERECIA*'.self::PORCENTAJE_94.')-RETENCIONES):</big></b><br>';
		$detalle.='RETENCION: '.number_format($imp,2).'<br>';
		$mod=new RetencionesDetalle;
		$mod->idPago=$pago->id;
		$mod->detalle=$detalle;
		$mod->save();
		return $imp;
	}
	private function getImporteRetenenciones($fecha,$idProfesional)
	{
		$totalRetenciones=0;
		$pagos=Pagos::model()->getPagosMes($fecha,$idProfesional);
		foreach($pagos as $pago)
			$totalRetenciones+=$pago->getImporteRetenciones();
		return $totalRetenciones;
	}
	
	private function getImporteRetener($fecha,$idProfesional)
	{
		$total=0;
		$pagos=Pagos::model()->getPagosMes($fecha,$idProfesional);
		foreach($pagos as $pago)
			$total+=$pago->getImporteSinRetencion();
		return $total;
	}
	const IMPORTE_NO_SUJETO_94=67170; //ESTABA EN 5000 // cambio de 30000
	const PORCENTAJE_94=0.02;
	const IMPORTE_NO_SUJETO_116= 16830; // PASA DE 1200 a 30000
	private function porcentualActual($importe,$pago)
	{
		$importeAretener=$this->getImporteRetener($pago->fecha,$pago->idProfesional);
		$importeRetenciones=$this->getImporteRetenenciones($pago->fecha,$pago->idProfesional);
		$diferencia=$importeAretener-self::IMPORTE_NO_SUJETO_116;

		$tabla=TablaRetenciones::model()->porImporte($diferencia);
		if($tabla==null)return 0;
		$final=(($diferencia-$tabla->exedenteEfectivo)*$tabla->agregadoPorcentaje);
		$imp=$final+$tabla->agregadoEfectivo+$importeRetenciones; // EL IMPORTE RETENCIONES VIENE NEGATIVO

		$detalle='<big><b>DETALLE DE LA RETENCION COD 116</b></big> <br>';
		$detalle.='<b>LIQUIDACION</b>  :$ '.number_format($importeAretener,2).' <br>';
		$detalle.='<b>RETENCIONES</b> :$ '.number_format($importeRetenciones,2).' <br>';
		$detalle.='<b>MONTO NO SUJETO A RETENCION</b>  :$ '.number_format(self::IMPORTE_NO_SUJETO_116,2).' <br>';
		$detalle.='<b>DIFERENCIA</b> :$ '.number_format($diferencia,2).' <br>';

		$detalle.='<b>APLICACION TABLA</b><br>';
		$detalle.='MONTO FIJO: '.number_format($tabla->agregadoEfectivo,2).'<br>';
		$detalle.='PORCENTAJE: '.number_format($tabla->agregadoPorcentaje,2).'<br>';
		$detalle.='EXENDENTE: '.number_format($tabla->exedenteEfectivo,2).'<br>';
		
		$detalle.='CALCULO (DIFERENCIA-EXENDENTE)*PORCENTAJE + MONTO FIJO - RETENCIONES <br>';
		$detalle.='RETENCION: '.number_format($imp,2).'<br>';
		$mod=new RetencionesDetalle;
		$mod->idPago=$pago->id;
		$mod->detalle=$detalle;
		$mod->save();
		return $imp;
	}	
	public function porTipo($id,$impuesto)
	{
		$criteria=new CDbCriteria;
		//if(count($impuesto->tipos)==0)return array();
		//foreach($impuesto->tipos as $it)
		//	$criteria->addCondition('t.idTipoItemPago="'.$it->idTipoCobro.'"','OR');
		
		$criteria->addCondition('idPago='.$id,"AND");
			
		return self::model()->findAll($criteria);
	}
	public function todos()
	{
		$criteria=new CDbCriteria;
		//if(count($impuesto->tipos)==0)return array();
		//foreach($impuesto->tipos as $it)
		//	$criteria->addCondition('t.idTipoItemPago="'.$it->idTipoCobro.'"','OR');
		
		$criteria->addCondition('idObraSocial=0');
			
		return self::model()->findAll($criteria);
	}
	public function ingresar2($item,$id)
	{
		$model=new PagosItems;
		$model->idPago=$id;
		$model->importe=$item['importe'];
		$model->detalle=$item['detalle'];
		$model->idTipoItemPago=$item['idTipo'];
		$model->save();
		
	}
	public function ingresar($item,$id,$conItem=true)
	{
		$model=new PagosItems;
		$model->idPago=$id;
		$model->importe=$item['importe'];
		$model->detalle=$item['detalle'];
		$model->idTipoItemPago=$item['idTipo'];
		$model->idObraSocial=$item['idObraSocial'];
		$model->save();
		if(isset($item['idItem'])&&$item['idItem']!=0){
			$mod=new PagosItemsFactura;
			$mod->idPagoItem=$model->id;
			$mod->idItemFacturaOs=$item['idItem'];
			$mod->save();
			$modelItem=CobrosItems::model()->findByPk($item['idItem']);
		
			$modelItem->estado=CobrosItems::CANCELADO;
			$modelItem->save();
		}
	}
	public function tableName()
	{
		return 'pagos_items';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idPago, idTipoItemPago', 'numerical', 'integerOnly'=>true),
			array('importe', 'numerical'),
			array('detalle,idItemCobro', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id,idObraSocial, idPago, importe, detalle, idTipoItemPago', 'safe', 'on'=>'search'),
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
			'idPago0' => array(self::BELONGS_TO, 'Pagos', 'idPago'),
			'tipo' => array(self::BELONGS_TO, 'CobrosTipos', 'idTipoItemPago'),
			'itemFactura' => array(self::HAS_ONE, 'PagosItemsFactura', 'idPagoItem'),
			'impuestos' => array(self::HAS_MANY, 'ImpuestosTipos', 'idTipoItemPago'),

		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idPago' => 'Id Pago',
			'importe' => 'Importe',
			'detalle' => 'Detalle',
			'idTipoItemPago' => 'Id Tipo Item Pago',
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

		$criteria->compare('idPago',$this->idPago,false);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}