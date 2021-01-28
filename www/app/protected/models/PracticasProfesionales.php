<?php
class PracticasProfesionales extends CActiveRecord
{
	public $nombreProfesional;
	public $ObraSocial;
	public $idPractica;
	public $descripcionPractica;
	public $mostrarPractica;
	public $nombre;
	public $apellido;
	public $practica;
	public $codigoPractica;
	public $codigo;
	public $nombreObraSocial;

	public $buscar;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function getAnoPracticaVieja()
	{
		$fechaAux=explode('-',$this->fecha);
		if($this->fecha=='')return '';
		$mes=$this->getMes($fechaAux[1]);
		$ano=$fechaAux[0];
		return $ano;
	}
	public function getMesLetras($mes)
	{
		return $this->getMes($mes);
	}
	public function getFechaPractica()
	{
		
		$mes=$this->getMes($this->mes);
		$ano=$this->ano;
		return '<b>'.$mes.'</b> '.$ano;
	}
	public function meses()
	{
		return array(1=>'Enero',2=>'Febrero',3=>'Marzo',4=>'Abril',5=>'Mayo',6=>'Junio',7=>'Julio',8=>'Agosto',9=>'Septiembre',10=>'Octubre',11=>'Noviembre',12=>'Diciembre');

	}

	private function getMes($mes)
	{
		foreach($this->meses() as $key=>$valor)
			if($key==$mes) return $valor;
	}
	public function tableName()
	{
		return 'practicas_profesionales';
	}
	public function ultimas($cantidad)
	{
		$criteria=new CDbCriteria;
		$criteria->addCondition("ipCarga='".PracticasProfesionales::model()->getIpCliente()."'");
	//	$criteria->compare('idObraSocial',$idObraSocial,false);
		//$criteria->compare('estado','PENDIENTE',false);
		$criteria->order='t.id desc';
		$criteria->limit=$cantidad;
		return self::model()->findAll($criteria);
	}

	public function rules()
	{
		return array(
		array('idPractica,idProfesional, idObraSocial, cantidad', 'numerical', 'integerOnly'=>true),
		array('fecha,ipCarga', 'safe'),
		array('id, fecha,buscar, idProfesional, idObraSocial, cantidad', 'safe', 'on'=>'search'),
		array('idPractica,idProfesional,idObraSocial,cantidad,mes,ano','required'),
		);
	}

	public function relations()
	{
		return array(
			'profesional' => array(self::BELONGS_TO, 'Profesionales', 'idProfesional'),
			'obraSocial' => array(self::BELONGS_TO, 'ObrasSociales', 'idObraSocial'),
			'prac' => array(self::BELONGS_TO, 'Practicas', 'idPractica'),
		);
	}
	public function getIpCliente()
	{
		$ip='';
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}
return $ip;
	}
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fecha' => 'Fecha',
			'idProfesional' => 'Profesional',
			'idObraSocial' => 'Obra Social',
			'cantidad' => 'Cantidad',
			'idPractica' => 'Practica',
		);
	}
public function buscarParaModificar($desdeMes,$ano,$solo)
	{
		$criteria=new CDbCriteria;
		$criteria->addCondition("mes=".$desdeMes." AND ano=".$ano);
		if($solo)$criteria->addCondition("ipCarga='".PracticasProfesionales::model()->getIpCliente()."'");
		$criteria->order=('id desc');

		return self::model()->findAll($criteria);
	}
	public function search()
	{
		$criteria=new CDbCriteria;
		$criteria->compare('obras_sociales.nombreOs',$this->buscar,true,'OR');
		$criteria->compare('profesionales.apellido',$this->buscar,true,'OR');

		$criteria->order=('id desc');

		$criteria->join='left join profesionales on t.idProfesional = profesionales.id
						 left join obras_sociales on t.idObraSocial = obras_sociales.id
						 left join practicas on t.idPractica = practicas.id';
		$criteria->select='t.*,concat(profesionales.apellido," ",profesionales.nombre) as nombreProfesional,
						   obras_sociales.nombreOs as ObraSocial,
						   practicas.descripcion as descripcionPractica,
						   practicas.codigo as codigoPractica';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function detalleObraSocial($idObraSocial,$mesInicio,$anoInicio,$mesFin,$anoFin)
	{
		$criteria=new CDbCriteria;
		$fechaInicio=$anoInicio."-".$mesInicio."-01";
		$fechaFin=$anoFin."-".$mesFin."-01";
		$criteria->compare('t.idObraSocial',$idObraSocial);
		$criteria->group='t.idPractica, t.idObraSocial';
		$criteria->order='obras_sociales.nombreOs, practicas.codigo';
		$criteria->join='left join obras_sociales on t.idObraSocial = obras_sociales.id
						 left join practicas on t.idPractica = practicas.id';
		$criteria->select='t.*,obras_sociales.nombreOs as nombreObraSocial,
							   sum(t.cantidad) as cantidad,
							   practicas.descripcion as mostrarPractica,
							   practicas.codigo as codigo';	
		$criteria->addCondition("DATE(CONCAT(t.ano,'-',t.mes,'-01')) BETWEEN DATE('".$fechaInicio."') AND DATE('".$fechaFin."')");
		return self::model()->findAll($criteria);
	}

	public function detalleProfesional($idProfesional,$idObra,$mesInicio,$mesFin,$anoInicio,$anoFin)
	{
		$fechaInicio=$anoInicio."-".$mesInicio."-01";
		$fechaFin=$anoFin."-".$mesFin."-01";
		
		$criteria=new CDbCriteria;
		$criteria->compare('t.idProfesional',$idProfesional);
		$criteria->compare('t.idObraSocial',$idObra);
		$criteria->group='t.idProfesional,t.idObraSocial,t.idPractica';
		$criteria->order='concat(profesionales.apellido," ",profesionales.nombre), practicas.codigo';
		$criteria->join='left join profesionales on t.idProfesional = profesionales.id
						left join obras_sociales on t.idObraSocial = obras_sociales.id
						 left join practicas on t.idPractica = practicas.id';
		$criteria->select='t.*,concat(profesionales.apellido," ",profesionales.nombre) as nombreProfesional,
								obras_sociales.nombreOs as nombreObraSocial,
							   practicas.descripcion as practica,
							   practicas.codigo as codigo,
							   sum(t.cantidad) as cantidad';
			
		$criteria->addCondition("DATE(CONCAT(t.ano,'-',t.mes,'-01')) BETWEEN DATE('".$fechaInicio."') AND DATE('".$fechaFin."')");

		return self::model()->findAll($criteria);
	}

	public function detallePracticas($fechaInicio,$fechaFin)
	{
		$criteria=new CDbCriteria;
		$criteria->group='t.idPractica';
		$criteria->join='left join practicas on t.idPractica = practicas.id';
		$criteria->select='t.*, practicas.descripcion as practica,
								sum(t.cantidad) as cantidad,
								practicas.codigo as codigo';

		$criteria->addBetweenCondition('fecha',$fechaInicio,$fechaFin);
		return self::model()->findAll($criteria);
	}
}