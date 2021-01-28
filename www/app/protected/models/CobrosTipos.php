<?php

/**
 * This is the model class for table "cobros_tipos".
 *
 * The followings are the available columns in table 'cobros_tipos':
 * @property integer $id
 * @property string $nombreTipoCobro
 *
 * The followings are the available model relations:
 * @property CobrosItems[] $cobrosItems
 */
class CobrosTipos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CobrosTipos the static model class
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
		return 'cobros_tipos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombreTipoCobro', 'length', 'max'=>255),
			array('aplicaEnImpuesto','safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id,aplicaEnImpuesto, nombreTipoCobro', 'safe', 'on'=>'search'),
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
			'cobrosItems' => array(self::HAS_MANY, 'CobrosItems', 'idTipoItem'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombreTipoCobro' => 'Nombre Tipo Cobro',
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
		$criteria->compare('nombreTipoCobro',$this->buscar,true,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function buscarTipos()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->order="t.nombreTipoCobro";

		return self::model()->findAll($criteria);
	}
}