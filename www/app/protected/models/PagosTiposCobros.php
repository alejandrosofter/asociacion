<?php

/**
 * This is the model class for table "pagos_tipos_cobros".
 *
 * The followings are the available columns in table 'pagos_tipos_cobros':
 * @property integer $id
 * @property integer $idTipoPago
 * @property integer $idTipoCobro
 *
 * The followings are the available model relations:
 * @property CobrosTipos $idTipoCobro0
 * @property PagosTipos $idTipoPago0
 */
class PagosTiposCobros extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PagosTiposCobros the static model class
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
		return 'pagos_tipos_cobros';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idTipoPago, idTipoCobro', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, idTipoPago, idTipoCobro', 'safe', 'on'=>'search'),
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
			'tipoCobro' => array(self::BELONGS_TO, 'CobrosTipos', 'idTipoCobro'),
			'tipoPago' => array(self::BELONGS_TO, 'PagosTipos', 'idTipoPago'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idTipoPago' => 'Tipo Pago',
			'idTipoCobro' => 'Tipo Cobro',
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

		$criteria->compare('idTipoPago',$this->idTipoPago,false);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}