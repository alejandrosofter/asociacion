<?php

/**
 * This is the model class for table "cobros_obrasSociales".
 *
 * The followings are the available columns in table 'cobros_obrasSociales':
 * @property integer $id
 * @property integer $idObraSocial
 * @property integer $idFactura
 * @property integer $idCobro
 *
 * The followings are the available model relations:
 * @property FacturasObrasSocial $idFactura0
 * @property Cobros $idCobro0
 * @property ObrasSociales $idObraSocial0
 */
class CobrosObrasSociales extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CobrosObrasSociales the static model class
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
		return 'cobros_obrasSociales';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idObraSocial, idFactura', 'numerical', 'integerOnly'=>true),
			array('idObraSocial','required'),
			// Please remove those attributes that should not be searched.
			array('buscar,id, idObraSocial, idFactura, idCobro', 'safe', 'on'=>'search'),
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
			'factura' => array(self::BELONGS_TO, 'FacturasObrasSocial', 'idFactura'),
			'cobro' => array(self::BELONGS_TO, 'Cobros', 'idCobro'),
			'obraSocial' => array(self::BELONGS_TO, 'ObrasSociales', 'idObraSocial'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idObraSocial' => 'Obra Social',
			'idFactura' => 'Factura',
			'idCobro' => 'Id Cobro',
		);
	}

	public function getObra()
	{
		return $this->obraSocial->nombreOs;
	}
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->buscar,'OR');
		$criteria->compare('idObraSocial',$this->buscar,'OR');
		$criteria->compare('idFactura',$this->buscar,'OR');
		$criteria->compare('idCobro',$this->buscar,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}