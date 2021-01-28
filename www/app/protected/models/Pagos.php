<?php

/**
 * This is the model class for table "pagos".
 *
 * The followings are the available columns in table 'pagos':
 * @property integer $id
 * @property integer $idProfesional
 * @property double $importe
 * @property string $fecha
 * @property string $estado
 *
 * The followings are the available model relations:
 * @property Profesionales $idProfesional0
 * @property PagosItems[] $pagosItems
 * @property Retenciones[] $retenciones
 */
class Pagos extends CActiveRecord
{
	const CANCELADO='CANCELADO';
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Pagos the static model class
	 */
	 public $buscar;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function getPagosMes($fecha,$idProfesional)
	{
		$criteria=new CDbCriteria;

		$criteria->addCondition("idProfesional=".$idProfesional);
		$queryFecha="fecha BETWEEN CONCAT(YEAR('".$fecha."'),'-',MONTH('".$fecha."'),'-01') AND CONCAT(YEAR('".$fecha."'),'-',MONTH('".$fecha."'),'-',DAY('".$fecha."'))";
		$criteria->addCondition($queryFecha);
		$criteria->addCondition("noRetiene=null OR noRetiene<>1");
		echo " ".$queryFecha;
		return self::model()->findAll($criteria);
	}
	public function getPagosImpuestos($desde,$hasta,$idProfesional,$noFacturable,$idOsExcluye,$idOsExcluye2)
	{
		$condExclye="";
		if($idOsExcluye!="")$condExcluye=" AND pagos_items.idObraSocial<>".$idOsExcluye." ";
		if($idOsExcluye2!="")$condExcluye=" AND pagos_items.idObraSocial<>".$idOsExcluye2." ";
		$condFacturable=!$noFacturable?"AND pagos.noRetiene =1":"AND pagos.noRetiene is NULL";
		$consulta2="(SELECT 'PAGO' as tipo,'000' as nroFactura,fecha as fecha,'PAGO A PROFESIONAL' as detalle, pagos.importe as importe,
		(SELECT pagos_impuestos.importe from pagos_impuestos where idPago=pagos.id and idImpuesto=3 ".$condExclye.")  as importeRetenciones,
		(SELECT pagos_impuestos.importe from pagos_impuestos where idPago=pagos.id and idImpuesto=1 ".$condExclye.")  as importeCheque,
		(SELECT (pagos_items.importe) from pagos_items where idPago=pagos.id and idTipoItemPago=122 ".$condExclye.")  as importeCuotaSocial,
		(SELECT sum(pagos_items.importe) from pagos_items where idPago=pagos.id and idTipoItemPago=22 ".$condExclye.")  as importeDebitoOs,
		(SELECT sum(pagos_items.importe) from pagos_items where idPago=pagos.id and idTipoItemPago=42 ".$condExclye.")  as importeDebitos,

		(SELECT sum(pagos_impuestos.importe) from pagos_impuestos where idPago=pagos.id and idImpuesto=2) ".$condExclye." as importeAsociacion,
		
		pagos.estado as estado from pagos
		where (fecha between '".$desde."' AND '".$hasta."') AND pagos.idProfesional=".$idProfesional.")";
		$orden=" order by fecha desc";
		
		return Yii::app()->db->createCommand($consulta2.$orden)->queryAll();
	}
	public function getImporteRetenciones()
	{
		$total=0;
		foreach($this->impuestos as $item)
			if($item->idImpuesto==3)$total+=$item->importe;
			
		return $total;
	}
	public function getImporteSinRetencion()
	{
		$total=0;
		foreach($this->pagosItems as $item)$total+=$item->importe;
		foreach($this->impuestos as $item)
			if($item->idImpuesto!=3)$total+=$item->importe;
			
		return $total;
	}
	public function getRetencionesInternas()
	{
		return PagosImpuestos::model()->getImpuestosAplicados($this->id,false);
	}
	public function rango($fechaDesde,$fechaHasta)
	{
		$criteria=new CDbCriteria;
		$criteria->with=array('profesional');
		$criteria->addBetweenCondition('fecha',$fechaDesde,$fechaHasta);
		$criteria->order='profesional.apellido asc';
		return self::model()->findAll($criteria);
	}

	/**
	 * @return string the associated database table namer
	 */
	public function tableName()
	{
		return 'pagos';
	}
	public function updateImporte()
	{
		$this->importe=$this->importeItems();
		$this->save();
	}
	public function anual($id,$ano)
	{
		$sal=array();
		for($i=0;$i<12;$i++){
			$criteria=new CDbCriteria;
			if($id!=null)$criteria->compare('idProfesional',$id,false);
			$criteria->compare('YEAR(fecha)',$ano,false);
			$criteria->compare('MONTH(fecha)',($i+1),false);
			$criteria->select='t.*,round(SUM(importe),2) as importe';
			$res= self::model()->findAll($criteria);
			if(count($res)>0)$sal[]=$res[0]->importe; else $sal[]=0;
		}
		return $sal;
		
	}
	private function importeItems()
	{	
		$importe=0;
		$model=Pagos::model()->findByPk($this->id);
		$impuestos=Pagos::model()->findByPk($this->id);
    foreach($model->pagosItems as $item)$importe+=$item->importe;
		foreach($model->impuestos as $item)$importe+=$item->importe;	
		return $importe;
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idProfesional,noRetiene', 'numerical', 'integerOnly'=>true),
			array('importe', 'numerical'),
			array('importe,idProfesional,fecha', 'required'),
			array('estado', 'length', 'max'=>255),
			array('fecha,noRetiene', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id,noRetiene, idProfesional, importe, fecha, estado', 'safe', 'on'=>'search'),
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
			'profesional' => array(self::BELONGS_TO, 'Profesionales', 'idProfesional'),
			'pagosItems2' => array(self::HAS_MANY, 'PagosItems', 'idPago',"group"=>"pagosItems2.detalle","select"=>"pagosItems2.*, SUM(pagosItems2.importe) as importe"),
			'pagosItems' => array(self::HAS_MANY, 'PagosItems', 'idPago'),
			'impuestos' => array(self::HAS_MANY, 'PagosImpuestos', 'idPago'),
			'retencion' => array(self::HAS_ONE, 'Retenciones', 'idPago'),
			'retencionDetalle' => array(self::HAS_ONE, 'RetencionesDetalle', 'idPago'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idProfesional' => 'Profesional',
			'importe' => 'Importe',
			'fecha' => 'Fecha',
			'estado' => 'Estado',
		);
	}
	public function getImporteDebitos()
	{
		$sum=0;
		foreach ($this->pagosItems as $key => $value)
			if(($value->idTipoItemPago<>2) && ($value->idTipoItemPago<>122) && ($value->idTipoItemPago<>102 ))$sum+=$value->importe;
		return $sum;
	}
	public function getImporteCreditos()
	{
		$sum=0;
		foreach ($this->pagosItems as $key => $value)
			if(($value->idTipoItemPago==2) || ($value->idTipoItemPago==102 ))$sum+=$value->importe;
		return $sum;
	}
	public function getImporteRetencion()
	{
		$sum=0;
		foreach ($this->impuestos as $key => $value)
			if($value->idImpuesto==3)$sum+=$value->importe;
		return $sum*-1;
	}
	public function getImporteAsoc()
	{
		$sum=0;
		foreach ($this->impuestos as $key => $value)
			if($value->idImpuesto==1)$sum+=$value->importe;
		return $sum*-1;
	}
	public function getImporteCheq()
	{
		$sum=0;
		foreach ($this->impuestos as $key => $value)
			if($value->idImpuesto==2)$sum+=$value->importe;
		return $sum*-1;
	}
	public function getUltimos($id,$ano,$cantidad)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$criteria->compare('idProfesional',$id,false);
		$criteria->compare('YEAR(fecha)',$ano,false);
		$criteria->limit=$cantidad;
		$criteria->order='t.fecha desc';
		return self::model()->findAll($criteria);
	}
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$criteria->with=array('profesional');
		$criteria->compare('profesional.apellido',$this->buscar,true,'OR');
		$criteria->compare('profesional.nombre',$this->buscar,true,'OR');
		$criteria->order='t.id desc';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function pagosLiquidacion($idLiquidacion)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
$liqui=Liquidaciones::model()->findByPk($idLiquidacion);
		$criteria=new CDbCriteria;
		$criteria->with=array('profesional');
		$criteria->compare('profesional.apellido',$this->buscar,true,'OR');
		$criteria->compare('profesional.nombre',$this->buscar,true,'OR');
		$criteria->addCondition("t.id in (".$liqui->pagos.")");
		$criteria->order='t.id desc';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}