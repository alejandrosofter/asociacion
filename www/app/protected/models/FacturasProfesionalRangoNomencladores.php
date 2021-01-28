<?php

/**
 * This is the model class for table "facturasProfesional_rangoNomencladores".
 *
 * The followings are the available columns in table 'facturasProfesional_rangoNomencladores':
 * @property integer $id
 * @property string $fechaDesde
 * @property string $fechaHasta
 */
class FacturasProfesionalRangoNomencladores extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return FacturasProfesionalRangoNomencladores the static model class
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
		return 'facturasProfesional_rangoNomencladores';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function getNombreRango()
	{
		return Yii::app()->dateFormatter->format("dd-MM-yyyy",$this->fechaDesde)." ---> ".Yii::app()->dateFormatter->format("dd-MM-yyyy",$this->fechaHasta);
	}
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fechaDesde, fechaHasta,idObraSocial', 'safe'),
			array('fechaDesde,idObraSocial', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, fechaDesde, fechaHasta', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function buscar($idObraSocial)
	{
		$criteria=new CDbCriteria;
		$criteria->addCondition("idObraSocial=".$idObraSocial);
		// $criteria->compare('idObraSocial',$idObraSocial,'AND');
		$criteria->order="t.fechaHasta desc";
		return $this->model()->findAll($criteria);
	}
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
				'os' => array(self::BELONGS_TO, 'ObrasSociales', 'idObraSocial'),
		);
	}
	public function getNombreOs()
	{
		return isset($this->os)?$this->os->nombreOs:"-";
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fechaDesde' => 'Fecha Desde',
			'fechaHasta' => 'Fecha Hasta',
			'idObraSocial' => 'Obra Social',
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
		if(isset($this->idObraSocial))$criteria->addCondition("idObraSocial=".$this->idObraSocial);
		// $criteria->compare('idObraSocial',$this->idObraSocial,true,'AND');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}