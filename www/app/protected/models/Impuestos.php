<?php

/**
 * This is the model class for table "impuestos".
 *
 * The followings are the available columns in table 'impuestos':
 * @property integer $id
 * @property string $nombreImpuesto
 * @property double $porcentaje
 * @property string $descripcion
 */
class Impuestos extends CActiveRecord
{
	const IDRETENCION=42;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Impuestos the static model class
	 */
	 public $buscar;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function getRetencion()
	{
		return self::model()->findByPk(self::IDRETENCION);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'impuestos';
	}
	

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('porcentaje,esRetencion', 'numerical'),
			array('nombreImpuesto', 'length', 'max'=>255),
			array('descripcion', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id,esRetencion, nombreImpuesto, porcentaje, descripcion', 'safe', 'on'=>'search'),
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
			'tipos' => array(self::HAS_MANY, 'ImpuestosTipos', 'idImpuesto'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombreImpuesto' => 'Nombre Impuesto',
			'porcentaje' => 'Porcentaje',
			'descripcion' => 'Descripción',
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
		$criteria->compare('nombreImpuesto',$this->buscar,true,'OR');
		$criteria->compare('porcentaje',$this->buscar,'OR');
		$criteria->compare('descripcion',$this->buscar,true,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}