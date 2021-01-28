<?php

/**
 * This is the model class for table "pagos".
 *
 * The followings are the available columns in table 'pagos':
 * @property integer $id
 * @property integer $idProfesional
 * @property double $importe
 * @property string $fecha
 * @property string $estado
 *
 * The followings are the available model relations:
 * @property Profesionales $idProfesional0
 * @property PagosImpuestos[] $pagosImpuestoses
 * @property PagosItems[] $pagosItems
 * @property Retenciones[] $retenciones
 * @property RetencionesDetalle[] $retencionesDetalles
 */
class Pagos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Pagos the static model class
	 */
	 public $buscar;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function getUltimos($id,$ano,$cantidad)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$criteria->compare('idProfesional',$id,false);
		$criteria->compare('YEAR(fecha)',$ano);
		$criteria->limit=$cantidad;
		$criteria->order='t.fecha desc';
		return self::model()->findAll($criteria);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pagos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idProfesional', 'numerical', 'integerOnly'=>true),
			array('importe', 'numerical'),
			array('estado', 'length', 'max'=>255),
			array('fecha', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, idProfesional, importe, fecha, estado', 'safe', 'on'=>'search'),
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
			'profesional' => array(self::BELONGS_TO, 'Profesionales', 'idProfesional'),
			'impuestos' => array(self::HAS_MANY, 'PagosImpuestos', 'idPago'),
			'pagosItems' => array(self::HAS_MANY, 'PagosItems', 'idPago'),
			'retenciones' => array(self::HAS_MANY, 'Retenciones', 'idPago'),
			'retencion' => array(self::HAS_ONE, 'Retenciones', 'idPago'),
			'retencionesDetalles' => array(self::HAS_MANY, 'RetencionesDetalle', 'idPago'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idProfesional' => 'Id Profesional',
			'importe' => 'Importe',
			'fecha' => 'Fecha',
			'estado' => 'Estado',
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
		$criteria->compare('idProfesional',$this->buscar,'OR');
		$criteria->compare('importe',$this->buscar,'OR');
		$criteria->compare('fecha',$this->buscar,true,'OR');
		$criteria->compare('estado',$this->buscar,true,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}