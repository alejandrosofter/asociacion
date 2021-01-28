<?php

/**
 * This is the model class for table "liquidaciones_cobros".
 *
 * The followings are the available columns in table 'liquidaciones_cobros':
 * @property integer $id
 * @property integer $idCobro
 * @property integer $idLiquidacion
 *
 * The followings are the available model relations:
 * @property Liquidaciones $idLiquidacion0
 */
class LiquidacionesCobros extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return LiquidacionesCobros the static model class
	 */
	 public $buscar;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function tieneCobros($idCobro)
	{
		$criteria=new CDbCriteria;
		$criteria->addCondition("t.idCobro=".$idCobro);
		return count(self::model()->findAll($criteria)) > 0;
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'liquidaciones_cobros';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idCobro, idLiquidacion', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, idCobro, idLiquidacion', 'safe', 'on'=>'search'),
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
			'idLiquidacion0' => array(self::BELONGS_TO, 'Liquidaciones', 'idLiquidacion'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idCobro' => 'Id Cobro',
			'idLiquidacion' => 'Id Liquidacion',
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
		$criteria->compare('idCobro',$this->buscar,'OR');
		$criteria->compare('idLiquidacion',$this->buscar,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}