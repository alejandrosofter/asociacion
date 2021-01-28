<?php

/**
 * This is the model class for table "facturasObraSocial_liquidacionesWeb".
 *
 * The followings are the available columns in table 'facturasObraSocial_liquidacionesWeb':
 * @property integer $id
 * @property integer $idLiquidacionWeb
 * @property integer $idFacturaObraSocial
 */
class FacturasObraSocialLiquidacionesWeb extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return FacturasObraSocialLiquidacionesWeb the static model class
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
		return 'facturasObraSocial_liquidacionesWeb';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array(' idFacturaObraSocial', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, idLiquidacionWeb, idFacturaObraSocial', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'idLiquidacionWeb' => 'Id Liquidacion Web',
			'idFacturaObraSocial' => 'Id Factura Obra Social',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function items($idFactura)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$criteria->addCondition('idFacturaObraSocial='.$idFactura);

		return $this->model()->findAll($criteria);
	}
}