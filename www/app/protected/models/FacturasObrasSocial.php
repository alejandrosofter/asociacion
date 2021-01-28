<?php

/**
 * This is the model class for table "facturasObrasSocial".
 *
 * The followings are the available columns in table 'facturasObrasSocial':
 * @property integer $id
 * @property string $fecha
 * @property integer $idObraSocial
 * @property double $importe
 * @property string $estado
 * @property string $detalle
 *
 * The followings are the available model relations:
 * @property CobrosObrasSociales[] $cobrosObrasSociales
 * @property ObrasSociales $idObraSocial0
 * @property FacturasObrasSocialItems[] $facturasObrasSocialItems
 */
class FacturasObrasSocial extends CActiveRecord
{
	const PENDIENTE='PENDIENTE';
	const CANCELADO='CANCELADO';
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return FacturasObrasSocial the static model class
	 */
	 public $buscar;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function fechaVtoElectronico(){
		if($this->facturaElectronica->fechaVtoPago)
		return Yii::app()->dateFormatter->format("dd-MM-yyyy",$this->facturaElectronica->fechaVtoPago);
	return "-";
	}
	public function fechaFacturaElectronica(){
		if(isset($this->facturaElectronica->fecha))return Yii::app()->dateFormatter->format("dd-MM-yyyy",$this->facturaElectronica->fecha);
		if(isset($this->facturaElectronica )){

			$date = new DateTime($this->facturaElectronica->vto);
			// return $date->format("d-m-Y");
			$interval = new DateInterval('P10D');
			$date->sub($interval);
			return  $date->format("d-m-Y");
		}
		
	return "-";
	}
	public function formFechaVto()
	{
		$sel="fechaVto_".$this->id;
		$f='<input id="'.$sel.'" placeholder="DD/MM/AAAA" class="input-form" style="width: 70px;font-size: 9px">';
		if($this->obraSocial->realizaFacturaCredito)return $f;
		return "No requiere";
	}
	public function getCuitAfip()
	{
		if(isset($this->obraSocial->obraSocialCargo))return str_replace("-","",$this->obraSocial->obraSocialCargo->cuit);
		return str_replace("-","",$this->obraSocial->cuit);
		

	}
	public function getDeuda($idObraSocial,$estado,$fechaDesde,$fechaHasta)
	{
		$criteria=new CDbCriteria;
		if(isset($idObraSocial) && $idObraSocial!="") $criteria->addCondition("t.idObraSocial=".$idObraSocial);
		if($estado!="") $criteria->addCondition("t.estado='".$estado."'");
		$criteria->with=array('cobrosObrasSociales');
		if($fechaDesde!=""&&$fechaHasta!="")$criteria->addBetweenCondition("fecha",$fechaDesde,$fechaHasta);
		$criteria->order='t.fecha desc';
		return self::model()->findAll($criteria);
	}
	public function getDeudaProfesional($idProfesional)
	{
		$order=" order by facturasObrasSocial.fecha desc";
		$group=" group by facturasObrasSocial.id ";
		$where=" where facturasProfesional.idProfesional=".$idProfesional;
		$having=" having fechaCobro<>''";
		
		// $subConsultaPago="(select sum(if(pagos_items.importe<0,0,pagos_items.importe)) from pagos_items_factura 
		// inner join cobros_items on pagos.id=liquidaciones_pagos.idPago
		// left join pagos_items on pagos_items.idPago = pagos.id
		//  where pagos_items.idObraSocial=facturasProfesional.idObraSocial and  pagos.idProfesional=".$idProfesional." and liquidaciones_pagos.idLiquidacion= liquidaciones_cobros.idLiquidacion) as importePago, ";

		// $subConsultaPago="(select group_concat('hola') from liquidaciones_pagos 
		// inner join pagos on pagos.id=liquidaciones_pagos.idPago
		// left join pagos_items on pagos_items.idPago = pagos.id
		//  where pagos_items.idObraSocial=facturasProfesional.idObraSocial and  pagos.idProfesional=".$idProfesional." ) as importePago, ";
		 
// 		$subConsultaDebitos="(select sum(if(pagos_items.importe<0,pagos_items.importe,0)) from liquidaciones_pagos 
// 		inner join pagos on pagos.id=liquidaciones_pagos.idPago
// 		left join pagos_items on pagos_items.idPago = pagos.id
// 		 where pagos_items.idObraSocial=facturasProfesional.idObraSocial and  pagos.idProfesional=".$idProfesional." and liquidaciones_pagos.idLiquidacion= liquidaciones_cobros.idLiquidacion   ) as debitos, ";
// $subConsultaDebitos="0 as debitos, ";
		$join="left join obras_sociales on obras_sociales.id= facturasObrasSocial.idObraSocial 
		left join facturasObrasSocial_items on facturasObrasSocial_items.idFacturaObraSocial = facturasObrasSocial.id 
		left join facturasProfesional on facturasProfesional.id=facturasObrasSocial_items.idFacturaProfesional 
		left join facturaElectronica on  facturaElectronica.idFacturaObraSocial=facturasObrasSocial.id
		left join cobros_obrasSociales on cobros_obrasSociales.idFactura=facturasObrasSocial.id 
		left join cobros on cobros.id=cobros_obrasSociales.idCobro 
		";
		$q="(SELECT facturasObrasSocial.id as idFacturaObraSocial, sum(facturasProfesional.importe) as importeFactura,facturasObrasSocial.fecha as fecha, facturaElectronica.nroComprobante, cobros_obrasSociales.idCobro as idCobro,  cobros.fecha as fechaCobro, (obras_sociales.nombreOs) as obraSocial,facturasProfesional.idProfesional as idProfesional from facturasObrasSocial 
			".$join.$where.$group.$order.")";
		
		return  Yii::app()->db->createCommand($q)->queryAll();
	}
	public function informe($params)
	{
			$criteria=new CDbCriteria;
			$criteria->with=array('obraSocial');
			if(isset($params['idObraSocial']))$criteria->compare('idObraSocial',$params['idObraSocial'],"AND");
			$criteria->addBetweenCondition('fecha',$params['fechaDesde'],$params['fechaHasta'],"AND");
			
			$criteria->order='t.fecha';
			return self::model()->findAll($criteria);

		
	}
	public function getColor()
	{
		if($this->estado=="PENDIENTE")return "red";else return "green";
	}
	public function getImporteItems()
	{
		$tot=0;
		foreach($this->facturasProfesionales as $item)
			$tot+=$item->importe;
		return $tot;
	}
	public function tieneElectronica()
	{
		if(isset($this->facturaElectronica))
		if($this->facturaElectronica)return 1;
	if($this->id==4058) return 1;
		return 0;
	}
	public function tieneFacturaElectronica()
	{
		if($this->facturaElectronica)return "CAE: ".$this->facturaElectronica->codigo." Vto: ".$this->facturaElectronica->vto ;
		return "no";
	}
	public function recalculaImporte()
	{
		$this->importe=$this->getImporteItems();
		$this->save();
	}
	
	public function anual($ano)
	{
		$sal=array();
		for($i=0;$i<12;$i++){
			$criteria=new CDbCriteria;
			$criteria->compare('YEAR(fecha)',$ano,false);
			$criteria->compare('MONTH(fecha)',($i+1),false);
			$criteria->select='t.*,round(SUM(importe),2) as importe';
			$res= self::model()->findAll($criteria);
			if(count($res)>0)$sal[]=$res[0]->importe; else $sal[]=0;
		}
		return $sal;
	}
	

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'facturasObrasSocial';
	}
	public function getEstados()
	{
		return array('PENDIENTE'=>'PENDIENTE','CANCELADA'=>'CANCELADA');
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idObraSocial', 'numerical', 'integerOnly'=>true),
			array('importe', 'numerical'),
			array('estado', 'length', 'max'=>255),
			array('fecha,idCobroTipo, detalle', 'safe'),
			array('fecha, idObraSocial,importe', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, fecha,idCobroTipo, idObraSocial, importe, estado, detalle', 'safe', 'on'=>'search'),
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
			'cobrosObrasSociales' => array(self::HAS_MANY, 'CobrosObrasSociales', 'idFactura'),
			'obraSocial' => array(self::BELONGS_TO, 'ObrasSociales', 'idObraSocial'),
			'facturaElectronica' => array(self::HAS_ONE, 'FacturaElectronica', 'idFacturaObraSocial'),
			'tipoCobro' => array(self::BELONGS_TO, 'CobrosTipos', 'idCobroTipo'),
			'facturasObrasSocialItems' => array(self::HAS_MANY, 'FacturasObrasSocialItems', 'idFacturaObraSocial'),
			'facturasProfesionales'=>array(
                self::HAS_MANY,'FacturasProfesional',array('idFacturaProfesional'=>'id'),'through'=>'facturasObrasSocialItems','join'=>'inner join profesionales on profesionales.id=idProfesional','order'=>'profesionales.apellido'
            ),
            'facturasProfesionales_group'=>array(
                self::HAS_MANY,'FacturasProfesional',array('idFacturaProfesional'=>'id'),'through'=>'facturasObrasSocialItems','join'=>'inner join profesionales on profesionales.id=idProfesional',"select"=>"SUM(facturasProfesionales_group.importe) as importe,profesionales.id as idProfesional ",'order'=>'profesionales.apellido',"group"=>"idProfesional"
            ),
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
			'importe' => 'Importe',
			'estado' => 'Estado',
			'detalle' => 'Detalle',
			'idCobroTipo' => 'Imputar a...',
		);
	}
	private function impagasAnual($anio,$agrupa,$agrupaOs,$idObraSocial)
	{
		$suma=$agrupa?"SUM(facturasObrasSocial.importe) as total, ":"";
		$group=$agrupa?" group by anoFactura ":"";
		if($agrupaOs)$group=" group by facturasObrasSocial.idObraSocial";
		$order=$agrupa?"":" order by fechaFactura ";
		$where=" where facturasObrasSocial.estado='PENDIENTE' and YEAR(facturasObrasSocial.fecha)=".$anio." ";
		if($idObraSocial!=null)$where.=" AND facturasObrasSocial.idObraSocial=".$idObraSocial;
		$join=" left join obras_sociales on obras_sociales.id=facturasObrasSocial.idObraSocial ";
		
		$q="(SELECT ".$suma."'' as fechaCobro,'' as anoCobro, facturasObrasSocial.idObraSocial as idObraSocial,obras_sociales.nombreOs as nombreObraSocial, YEAR(facturasObrasSocial.fecha) as anoFactura,facturasObrasSocial.detalle as detalleFactura,facturasObrasSocial.fecha as fechaFactura,facturasObrasSocial.importe as importeFactura,facturasObrasSocial.estado as estado from facturasObrasSocial
			".$join.$where.$group.$order.")";
		// return $q;
		return  Yii::app()->db->createCommand($q)->queryAll();
	}
	private function impagasAnualCancelados($anio,$agrupa,$agrupaOs,$idObraSocial)
	{
		$anioPosterior=$anio+1;
		$suma=$agrupa?"SUM(facturasObrasSocial.importe) as total, ":"";
		$group=$agrupa?" group by anoFactura ":"";
		if($agrupaOs)$group=" group by facturasObrasSocial.idObraSocial";
		$order=$agrupa?"":" order by fechaFactura ";
		$where=" where facturasObrasSocial.estado='CANCELADO' and YEAR(facturasObrasSocial.fecha)=".$anio."  and (isNull(cobros.fecha) or  YEAR(cobros.fecha)=".$anioPosterior.") ";
		if($idObraSocial!=null)$where.=" AND facturasObrasSocial.idObraSocial=".$idObraSocial;
		$having=" having fechaCobro<>''";
		$join="left join cobros_obrasSociales on cobros_obrasSociales.idFactura = facturasObrasSocial.id 
		left join cobros on cobros.id=cobros_obrasSociales.idCobro 
		left join obras_sociales on obras_sociales.id=facturasObrasSocial.idObraSocial ";
		$q="(SELECT ".$suma."cobros.fecha as fechaCobro,YEAR(cobros.fecha) as anoCobro, facturasObrasSocial.idObraSocial as idObraSocial,obras_sociales.nombreOs as nombreObraSocial, YEAR(facturasObrasSocial.fecha) as anoFactura,facturasObrasSocial.detalle as detalleFactura,facturasObrasSocial.fecha as fechaFactura,facturasObrasSocial.importe as importeFactura,facturasObrasSocial.estado as estado from facturasObrasSocial 
			".$join.$where.$group.$having.$order.")";
		// return $q;
		return  Yii::app()->db->createCommand($q)->queryAll();
	}
	public function getFacturasImpagas($anio,$agrupa,$agrupaOs,$idObraSocial)
	{
		$pendientes=$this->impagasAnual($anio,$agrupa,$agrupaOs,$idObraSocial);
		$cancelada=$this->impagasAnualCancelados($anio,$agrupa,$agrupaOs,$idObraSocial);
		$group=$agrupa?" group by anoFactura ":"";
		$q=$pendientes." UNION ".$cancelada;

		return  Yii::app()->db->createCommand($q)->queryAll();
		return array_merge($pendientes,$cancelada);

	}
	public function getFacturasImpagas_pendientes($anio,$agrupa,$agrupaOs,$idObraSocial)
	{
		$pendientes=$this->impagasAnual($anio,$agrupa,$agrupaOs,$idObraSocial);
		return ($pendientes);

	}
	public function getFacturasImpagas_canceladas($anio,$agrupa,$agrupaOs,$idObraSocial)
	{
		$cancelada=$this->impagasAnualCancelados($anio,$agrupa,$agrupaOs,$idObraSocial);

		return ($cancelada);

	}
	public function rango($fechaDesde,$fechaHasta)
	{
		$criteria=new CDbCriteria;

		$criteria->addBetweenCondition('fecha',$fechaDesde,$fechaHasta);
		$criteria->with=array('obraSocial');
		$criteria->order='obraSocial.nombreOs asc';
		return self::model()->findAll($criteria);
	}
	public function getNroFactura()
	{
		if(isset($this->facturaElectronica))return $this->facturaElectronica->nroComprobante;
		return "-";
	}
public function getPendientes($id)
	{

		$criteria=new CDbCriteria;
		$criteria->with=array('obraSocial');
		$criteria->addCondition("t.estado='PENDIENTE' AND t.idObraSocial=".$id);
		$criteria->order='t.id desc';
		return FacturasObrasSocial::model()->findAll($criteria);
	}
	public function search()
	{

		$criteria=new CDbCriteria;
		$criteria->with=array('obraSocial');
		$criteria->compare('obraSocial.nombreOs',$this->buscar,'OR');
		if($this->estado!="")$criteria->addCondition("t.estado='".$this->estado."'");
		$criteria->compare('detalle',$this->buscar,true,'OR');
		$criteria->compare('t.id',$this->buscar,true,'OR');
		$criteria->order='t.id desc';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}