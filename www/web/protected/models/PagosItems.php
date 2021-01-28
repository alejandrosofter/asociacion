<?php

/**
 * This is the model class for table "pagos_items".
 *
 * The followings are the available columns in table 'pagos_items':
 * @property integer $id
 * @property integer $idPago
 * @property double $importe
 * @property string $detalle
 * @property integer $idTipoItemPago
 *
 * The followings are the available model relations:
 * @property Pagos $idPago0
 * @property CobrosTipos $idTipoItemPago0
 * @property PagosItemsFactura[] $pagosItemsFacturas
 */
class PagosItems extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PagosItems the static model class
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
		return 'pagos_items';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idPago, idTipoItemPago', 'numerical', 'integerOnly'=>true),
			array('importe', 'numerical'),
			array('detalle', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, idPago, importe, detalle, idTipoItemPago', 'safe', 'on'=>'search'),
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
			'idPago0' => array(self::BELONGS_TO, 'Pagos', 'idPago'),
			'idTipoItemPago0' => array(self::BELONGS_TO, 'CobrosTipos', 'idTipoItemPago'),
			'pagosItemsFacturas' => array(self::HAS_MANY, 'PagosItemsFactura', 'idPagoItem'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idPago' => 'Id Pago',
			'importe' => 'Importe',
			'detalle' => 'Detalle',
			'idTipoItemPago' => 'Id Tipo Item Pago',
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
		$criteria->compare('idPago',$this->buscar,'OR');
		$criteria->compare('importe',$this->buscar,'OR');
		$criteria->compare('detalle',$this->buscar,true,'OR');
		$criteria->compare('idTipoItemPago',$this->buscar,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}