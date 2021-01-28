<?php

/**
 * This is the model class for table "itemsLiquidacion".
 *
 * The followings are the available columns in table 'itemsLiquidacion':
 * @property integer $idItemLiquidacion
 * @property integer $idLiquidacion
 * @property integer $idItemparaLiquidar
 */
class ItemsLiquidacion extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ItemsLiquidacion the static model class
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
		return 'itemsLiquidacion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idLiquidacion, idItemparaLiquidar', 'required'),
			array('idLiquidacion, idItemparaLiquidar', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idItemLiquidacion, idLiquidacion, idItemparaLiquidar', 'safe', 'on'=>'search'),
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
			'paraLiquidar' => array(self::BELONGS_TO, 'ParaLiquidar', 'idItemparaLiquidar'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idItemLiquidacion' => 'Id Item Liquidacion',
			'idLiquidacion' => 'Id Liquidacion',
			'idItemparaLiquidar' => 'Id Itempara Liquidar',
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

		$criteria->compare('idItemLiquidacion',$this->idItemLiquidacion);
		$criteria->compare('idLiquidacion',$this->idLiquidacion);
		$criteria->compare('idItemparaLiquidar',$this->idItemparaLiquidar);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}