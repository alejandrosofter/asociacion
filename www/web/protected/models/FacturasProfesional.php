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
 * @property Profesionales $idProfesional0
 * @property ObrasSociales $idObraSocial0
 */
class FacturasProfesional extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return FacturasProfesional the static model class
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
		return 'facturasProfesional';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idProfesional, idObraSocial', 'numerical', 'integerOnly'=>true),
			array('importe', 'numerical'),
			array('estado', 'length', 'max'=>255),
			array('fecha, fechaUpdate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, fecha, fechaUpdate, idProfesional, importe, idObraSocial, estado', 'safe', 'on'=>'search'),
		);
	}
	public function getFacturadoMes($idProfesional,$ano,$mes=false,$agrupa=true)
	{
		$criteria=new CDbCriteria;
		$criteria->with=array('obraSocial');
		$criteria->compare('idProfesional',$idProfesional,false);
		$criteria->compare('YEAR(fecha)',$ano,false);
		//$criteria->compare('obraSocial.realizaFacturacion',1,false);
		if($mes)$criteria->compare('MONTH(fecha)',$mes,false);
		$criteria->order='t.id desc';
		if($agrupa){
			$criteria->group="MONTH(fecha)";
			$criteria->select='t.*,SUM(importe) as importe';
		}
		return self::model()->findAll($criteria);
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
			'profesional' => array(self::BELONGS_TO, 'Profesionales', 'idProfesional'),
			'obraSocial' => array(self::BELONGS_TO, 'ObrasSociales', 'idObraSocial'),
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
			'fechaUpdate' => 'Fecha Update',
			'idProfesional' => 'Id Profesional',
			'importe' => 'Importe',
			'idObraSocial' => 'Id Obra Social',
			'estado' => 'Estado',
		);
	}
	public function porcentajes($id,$ano)
	{
		$criteria=new CDbCriteria;
		$criteria->compare('idProfesional',$id,false);
		$criteria->compare('YEAR(fecha)',$ano);
		$criteria->group='t.idObraSocial';
		$criteria->select='t.*,SUM(importe) as importe';
		$criteria->order='t.id desc';
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
		$criteria->compare('fecha',$this->buscar,true,'OR');
		$criteria->compare('fechaUpdate',$this->buscar,true,'OR');
		$criteria->compare('idProfesional',$this->buscar,'OR');
		$criteria->compare('importe',$this->buscar,'OR');
		$criteria->compare('idObraSocial',$this->buscar,'OR');
		$criteria->compare('estado',$this->buscar,true,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}