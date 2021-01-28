<?php

/**
 * This is the model class for table "pagos_items_factura".
 *
 * The followings are the available columns in table 'pagos_items_factura':
 * @property integer $id
 * @property integer $idPagoItem
 * @property integer $idItemFacturaOs
 *
 * The followings are the available model relations:
 * @property FacturasObrasSocialItems $idItemFacturaOs0
 * @property PagosItems $idPagoItem0
 */
class PagosItemsFactura extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PagosItemsFactura the static model class
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
		return 'pagos_items_factura';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idPagoItem, idItemFacturaOs', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, idPagoItem, idItemFacturaOs', 'safe', 'on'=>'search'),
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
			'itemFactura' => array(self::BELONGS_TO, 'FacturasObrasSocialItems', 'idItemFacturaOs'),
			'itemCobro' => array(self::BELONGS_TO, 'CobrosItems', 'idItemFacturaOs'),
			'idPagoItem0' => array(self::BELONGS_TO, 'PagosItems', 'idPagoItem'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idPagoItem' => 'Id Pago Item',
			'idItemFacturaOs' => 'Id Item Factura Os',
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
		$criteria->compare('idPagoItem',$this->buscar,'OR');
		$criteria->compare('idItemFacturaOs',$this->buscar,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}