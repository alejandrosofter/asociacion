<?php

/**
 * This is the model class for table "paraLiquidar".
 *
 * The followings are the available columns in table 'paraLiquidar':
 * @property integer $idparaLiquidar
 * @property string $fecha
 * @property integer $idLiquidacion
 * @property string $detalle
 * @property double $importe
 * @property integer $idProfesional
 * @property string $estado
 * @property string $tipo
 */
class ParaLiquidar extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ParaLiquidar the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'paraLiquidar';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fecha, idLiquidacion, detalle, importe, idProfesional, estado, tipo', 'required'),
			array('idLiquidacion, idProfesional', 'numerical', 'integerOnly'=>true),
			array('importe', 'numerical'),
			array('estado, tipo', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idparaLiquidar, fecha, idLiquidacion, detalle, importe, idProfesional, estado, tipo', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idparaLiquidar' => 'Idpara Liquidar',
			'fecha' => 'Fecha',
			'idLiquidacion' => 'Id Liquidacion',
			'detalle' => 'Detalle',
			'importe' => 'Importe',
			'idProfesional' => 'Id Profesional',
			'estado' => 'Estado',
			'tipo' => 'Tipo',
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

		$criteria->compare('idparaLiquidar',$this->idparaLiquidar);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('idLiquidacion',$this->idLiquidacion);
		$criteria->compare('detalle',$this->detalle,true);
		$criteria->compare('importe',$this->importe);
		$criteria->compare('idProfesional',$this->idProfesional);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('tipo',$this->tipo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}