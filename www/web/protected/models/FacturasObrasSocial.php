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
	public function getImporteItems()
	{
		$tot=0;
		foreach($this->facturasProfesionales as $item)
			$tot+=$item->importe;
		return $tot;
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
			'tipoCobro' => array(self::BELONGS_TO, 'CobrosTipos', 'idCobroTipo'),
			'facturasObrasSocialItems' => array(self::HAS_MANY, 'FacturasObrasSocialItems', 'idFacturaObraSocial'),
			'facturasProfesionales'=>array(
                self::HAS_MANY,'FacturasProfesional',array('idFacturaProfesional'=>'id'),'through'=>'facturasObrasSocialItems','join'=>'inner join profesionales on profesionales.id=idProfesional','order'=>'profesionales.apellido'
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

	public function rango($fechaDesde,$fechaHasta)
	{
		$criteria=new CDbCriteria;

		$criteria->addBetweenCondition('fecha',$fechaDesde,$fechaHasta);
		$criteria->with=array('obraSocial');
		$criteria->order='obraSocial.nombreOs desc';
		return self::model()->findAll($criteria);
	}
	public function getPendientes($id,$ano)
	{
		$criteria=new CDbCriteria;
		$criteria->compare('idProfesional',$id,false);
		$criteria->compare('estado','PENDIENTE');
		$criteria->compare('YEAR(fecha)',$ano);
		$criteria->order='t.id desc';
		return self::model()->findAll($criteria);
	}

	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$criteria->with=array('obraSocial');
		$criteria->compare('obraSocial.nombreOs',$this->buscar,'OR');
		$criteria->compare('detalle',$this->buscar,true,'OR');
		$criteria->order='t.id desc';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}