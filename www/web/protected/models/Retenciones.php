<?php

/**
 * This is the model class for table "retenciones".
 *
 * The followings are the available columns in table 'retenciones':
 * @property integer $id
 * @property integer $idPago
 * @property double $importeRetencion
 * @property double $importeBase
 * @property integer $idTablaRetencion
 *
 * The followings are the available model relations:
 * @property Pagos $idPago0
 * @property TablaRetenciones $idTablaRetencion0
 */
class Retenciones extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Retenciones the static model class
	 */
	 public $buscar;
	public function getImporteRetencionesMes($fecha,$campo,$idProfesional)
	{
		$arrFecha=explode('-',$fecha);
		$fi=$arrFecha[0].'-'.$arrFecha[1].'-01';
		$ff=$arrFecha[0].'-'.$arrFecha[1].'-31';
		$criteria=new CDbCriteria;
		$criteria->with=array('pago');
		$criteria->addBetweenCondition('pago.fecha',$fi,$ff);
		$criteria->compare('pago.idProfesional',$idProfesional,false);
		$res=Retenciones::model()->findAll($criteria);
		$sum=0;
		foreach($res as $item)
			$sum+=$item->$campo;
		return $sum;

	}
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	const IMPORTE_MIN=90;
	public function ingresar($importePorcentaje,$importe,$idPago)
	{
		if($importe>self::IMPORTE_MIN){
			$tabla=TablaRetenciones::model()->porImporte($importe);
			$model=new Retenciones;
			$model->idPago=$idPago;
			$model->importeRetencion=$importePorcentaje;
			$model->importeBase=$importe;
			if($tabla!=null)
			$model->idTablaRetencion=$tabla->idImpuesto;
			$model->save();
		}
	}
	public function porPago($idPago)
	{
		$criteria=new CDbCriteria;

		$criteria->compare('idPago',$idPago,false);
		$res=self::model()->findAll($criteria);
		if(count($res)==0)return null;
		return $res[0];
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'retenciones';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idPago', 'numerical', 'integerOnly'=>true),
			array('importeRetencion, importeBase', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, idPago, importeRetencion, importeBase, idTablaRetencion', 'safe', 'on'=>'search'),
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
			'pago' => array(self::BELONGS_TO, 'Pagos', 'idPago'),
			'tabla' => array(self::BELONGS_TO, 'TablaRetenciones', 'idTablaRetencion'),
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
			'importeRetencion' => 'Importe Retencion',
			'importeBase' => 'Importe Base',
			'idTablaRetencion' => 'Id Tabla Retencion',
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

		$criteria->compare('id',$this->buscar,'OR');
		$criteria->compare('idPago',$this->buscar,'OR');
		$criteria->compare('importeRetencion',$this->buscar,'OR');
		$criteria->compare('importeBase',$this->buscar,'OR');
		$criteria->compare('idTablaRetencion',$this->buscar,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}