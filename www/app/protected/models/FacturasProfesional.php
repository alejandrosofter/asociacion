<?php

/**
 * This is the model class for table "facturasProfesional".
 *
 * The followings are the available columns in table 'facturasProfesional':
 * @property integer $id
 * @property string $fecha
 * @property string $fechaUpdate
 * @property integer $idProfesional
 * @property double $importe
 * @property integer $idObraSocial
 * @property string $estado
 *
 * The followings are the available model relations:
 * @property FacturasObrasSocialItems[] $facturasObrasSocialItems
 * @property ObrasSociales $idObraSocial0
 * @property Profesionales $idProfesional0
 * @property PagosItemsFacturaProfesional[] $pagosItemsFacturaProfesionals
 */
class FacturasProfesional extends CActiveRecord
{
	const PENDIENTE='PENDIENTE';
	const FACTURADO='FACTURADO';
	const REFACTURACION='REFACTURACION';
	/**
	 * Returns the static model of the specified AR class.const PENDIENTE='PENDIENTE';
	 * @param string $className active record class name.
	 * @return FacturasProfesional the static model class
	 */
	 public $buscar;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function buscarPendientesRango($idRangoNomenclador)
	{
		$rango=FacturasProfesionalRangoNomencladores::model()->findByPk($idRangoNomenclador);
		$criteria=new CDbCriteria;
			$criteria->addCondition("t.fechaConsulta>='".$rango->fechaDesde."' AND estado='PENDIENTE' AND idObraSocial=".$rango->idObraSocial);
			return self::model()->findAll($criteria);
	}
	
	public function getItems($id,$refactura)
	{
			$criteria=new CDbCriteria;
			$criteria->with=array('profesional');
			if($refactura)$criteria->compare('estado',self::REFACTURACION,false);
			else $criteria->compare('estado',self::PENDIENTE,false);
			$criteria->compare('idObraSocial',$id,false);
			$criteria->order='profesional.apellido';
			if($id==null) return array();
			return self::model()->findAll($criteria);

		
	}
	public function getNombreNomenclador()
	{
		if(isset($this->nomenclador))return $this->nomenclador->nombreNomenclador;
		return "-";
	}
	public function datosExportacion($fechaDesde,$fechaHasta,$idObraSocial)
	{
		$criteria=new CDbCriteria;
		$criteria->addBetweenCondition('fecha',$fechaDesde,$fechaHasta,"AND");
			$criteria->addCondition('t.idObraSocial='.$idObraSocial);
			$criteria->order='CAST(t.nroOrden AS unsigned)';
			return self::model()->findAll($criteria);
	}
	public function informe($params)
	{
			$criteria=new CDbCriteria;
			$criteria->with=array('profesional');
			if(isset($params['idProfesional']))if($params['idProfesional']!="")$criteria->addCondition('t.idProfesional='.$params['idProfesional']);
			if($params['idObraSocial']!="")$criteria->addCondition('t.idObraSocial='.$params['idObraSocial']);
			$criteria->addBetweenCondition('fecha',$params['fechaDesde'],$params['fechaHasta'],"AND");
			
			$criteria->order='CAST(t.nroOrden AS unsigned)';
			return self::model()->findAll($criteria);

		
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'facturasProfesional';
	}

	public function ultimas($idObraSocial,$cantidad)
	{
		$criteria=new CDbCriteria;
		$fecha=Date('Y-m-d');
		$criteria->compare('idObraSocial',$idObraSocial,false);
		$criteria->addCondition("MONTH(t.fecha)=MONTH(NOW()) AND YEAR(t.fecha)=YEAR(NOw())");
		$criteria->addCondition("ipCarga='".$_SERVER['SERVER_ADDR']."'");
		$criteria->addCondition("estado='PENDIENTE'");
		$criteria->order='t.id desc';
		$criteria->limit=$cantidad;
		return self::model()->findAll($criteria);
	}
	public function getFacturadoMes($idProfesional,$ano,$mes=false,$agrupa=true)
	{
		$criteria=new CDbCriteria;
		$criteria->with=array('obraSocial');
		$criteria->compare('idProfesional',$idProfesional,false);
		$criteria->compare('YEAR(fecha)',$ano,false);
		$criteria->compare('obraSocial.realizaFacturacion',1,false);
		if($mes)$criteria->compare('MONTH(fecha)',$mes,false);
		$criteria->order='t.id desc';
		if($agrupa){
			$criteria->group="MONTH(fecha)";
			$criteria->select='t.*,SUM(importe) as importe';
		}
		return self::model()->findAll($criteria);
	}
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idProfesional,esDoble,es50,es75,es100, idRangoNomenclador, idObraSocial,importeFijo', 'numerical', 'integerOnly'=>true),
			//array('importe', 'numerical','allowEmpty'=>false),
			array('estado', 'length', 'max'=>255),
			array('fecha,fechaConsulta,esDoble,es50,es75,es100, ipCarga,importeFijo, idRangoNomenclador,fechaUpdate', 'safe'),
			array('fecha, fechaConsulta,idProfesional,importe,idNomenclador,idRangoNomenclador,paciente,nroOrden,nroAfiliado,idObraSocial', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, fecha, fechaUpdate, idProfesional, importe, idObraSocial, estado', 'safe', 'on'=>'search'),
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
			'facturasObrasSocialItems' => array(self::HAS_MANY, 'FacturasObrasSocialItems', 'idFacturaProfesional'),
			'obraSocial' => array(self::BELONGS_TO, 'ObrasSociales', 'idObraSocial'),
			'nomenclador' => array(self::BELONGS_TO, 'FacturasProfesionalNomencladores', 'idNomenclador'),
			'profesional' => array(self::BELONGS_TO, 'Profesionales', 'idProfesional'),
			'pagosItemsFacturaProfesionals' => array(self::HAS_MANY, 'PagosItemsFacturaProfesional', 'idFacturaProfesional'),
		);
	}
	public function getExtras()
	{
		if($this->es50)return "%50";
		if($this->es75)return "%75";
		if($this->es100)return "%100";
	}
	public function getEstados()
	{
		
		$salida= array('PENDIENTE'=>'PENDIENTE','FACTURADO'=>'FACTURADO','REFACTURACION'=>'REFACTURACION');
		return $salida;
	}
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fecha' => 'Fecha Sys',
			'fechaConsulta' => 'Fecha Consulta/Estudio',
			'idProfesional' => 'Profesional',
			'importe' => 'Importe',
			'idObraSocial' => 'Obra Social',
			'estado' => 'Estado',
			'idRangoNomenclador' => 'Rango Nomenclador',
			'idNomenclador' => 'Nomenclador',
			'esDoble' => 'Consulta doble?...',
			'es100' => 'Al 100%',
			'es75' => 'Al 75%',
			'es50' => 'Al 50%',

		);
	}
	public function anual($id,$ano)
	{
		$sal=array();
		for($i=0;$i<12;$i++){
			$criteria=new CDbCriteria;
			$criteria->compare('idProfesional',$id,false);
			$criteria->compare('YEAR(fecha)',$ano,false);
			$criteria->compare('MONTH(fecha)',($i+1),false);
			$criteria->select='t.*,round(SUM(importe),2) as importe';
			$res= self::model()->findAll($criteria);
			if(count($res)>0)$sal[]=$res[0]->importe; else $sal[]=0;
		}
		return $sal;
		
	}
	public function porcentajes($id,$ano)
	{
		$criteria=new CDbCriteria;
		$criteria->compare('idProfesional',$id,false);
		$criteria->compare('YEAR(fecha)',$ano,false);
		$criteria->group='t.idObraSocial';
		$criteria->select='t.*,SUM(importe) as importe';
		$criteria->order='t.id desc';
		return self::model()->findAll($criteria);
	}
	public function getPendientes($id,$ano)
	{
		$criteria=new CDbCriteria;
		$criteria->compare('idProfesional',$id,false);
		$criteria->compare('estado',self::PENDIENTE,false);
		$criteria->compare('YEAR(fecha)',$ano,false);
		$criteria->order='t.id desc';
		return self::model()->findAll($criteria);
	}

	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$criteria->with=array('profesional','obraSocial');
		$criteria->compare('profesional.nombre',$this->buscar,true,'OR');
		$criteria->compare('profesional.apellido',$this->buscar,true,'OR');
		$criteria->compare('obraSocial.nombreOs',$this->buscar,true,'OR');
		$criteria->compare('t.id',$this->buscar,true,'OR');
		$criteria->order='t.estado desc, t.id desc';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}