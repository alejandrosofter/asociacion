<?php

/**
 * This is the model class for table "pagos_impuestos".
 *
 * The followings are the available columns in table 'pagos_impuestos':
 * @property integer $id
 * @property integer $idImpuesto
 * @property double $importe
 * @property integer $idPago
 *
 * The followings are the available model relations:
 * @property Impuestos $idImpuesto0
 * @property Pagos $idPago0
 */
class PagosImpuestos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PagosImpuestos the static model class
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
		return 'pagos_impuestos';
	}
	public function getImpuestos($id,$ano)
	{
			$criteria=new CDbCriteria;
			$criteria->with=array('pago');
			if($id!=null)$criteria->compare('pago.idProfesional',$id,false);
			$criteria->compare('YEAR(pago.fecha)',$ano,false);
			$criteria->select='t.*, SUM(t.importe) as importe';
			$criteria->group='t.idImpuesto';
			return self::model()->findAll($criteria);
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idImpuesto, idPago', 'numerical', 'integerOnly'=>true),
			array('importe', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, idImpuesto, importe, idPago', 'safe', 'on'=>'search'),
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
			'impuesto' => array(self::BELONGS_TO, 'Impuestos', 'idImpuesto'),
			'pago' => array(self::BELONGS_TO, 'Pagos', 'idPago'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idImpuesto' => 'Id Impuesto',
			'importe' => 'Importe',
			'idPago' => 'Id Pago',
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
		$criteria->compare('idImpuesto',$this->buscar,'OR');
		$criteria->compare('importe',$this->buscar,'OR');
		$criteria->compare('idPago',$this->buscar,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}