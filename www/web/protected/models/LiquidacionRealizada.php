<?php

/**
 * This is the model class for table "liquidacionRealizada".
 *
 * The followings are the available columns in table 'liquidacionRealizada':
 * @property integer $idliquidacionRealizada
 * @property integer $idProveedor
 * @property string $fecha
 * @property double $valor
 * @property double $aux
 * @property integer $idOrden
 * @property double $sujetoSinFijo
 */
class LiquidacionRealizada extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return LiquidacionRealizada the static model class
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
		return 'liquidacionRealizada';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idProveedor, fecha, valor, aux, idOrden, sujetoSinFijo', 'required'),
			array('idProveedor, idOrden', 'numerical', 'integerOnly'=>true),
			array('valor, aux, sujetoSinFijo', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idliquidacionRealizada, idProveedor, fecha, valor, aux, idOrden, sujetoSinFijo', 'safe', 'on'=>'search'),
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
			'items' => array(self::HAS_MANY, 'ItemsLiquidacion', 'idLiquidacion'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idliquidacionRealizada' => 'Idliquidacion Realizada',
			'idProveedor' => 'Id Proveedor',
			'fecha' => 'Fecha',
			'valor' => 'Valor',
			'aux' => 'Aux',
			'idOrden' => 'Id Orden',
			'sujetoSinFijo' => 'Sujeto Sin Fijo',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function buscar($id,$fechaDesde,$fechaHasta)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$arr=explode('-',$fechaDesde);
		$fechaDesde=$arr[2].'-'.$arr[1].'-'.$arr[0];
		$arr=explode('-',$fechaHasta);
		$fechaHasta=$arr[2].'-'.$arr[1].'-'.$arr[0];
		$criteria->addBetweenCondition('fecha',$fechaDesde,$fechaHasta);

		$criteria->order='t.fecha desc';
		$criteria->compare('idProveedor',$id,false);
		return self::model()->findAll($criteria);
	}
}