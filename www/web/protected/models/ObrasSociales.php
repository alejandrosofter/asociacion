<?php

/**
 * This is the model class for table "obras_sociales".
 *
 * The followings are the available columns in table 'obras_sociales':
 * @property integer $id
 * @property string $nombreOs
 * @property string $email
 * @property string $contacto
 * @property string $direccion
 * @property string $nombreCorto
 * @property integer $idOsFacturacion
 * @property string $cuit
 * @property integer $retiene
 * @property string $localidad
 * @property string $telefono
 * @property integer $idCondicionIva
 * @property string $condicionVenta
 *
 * The followings are the available model relations:
 * @property CobrosObrasSociales[] $cobrosObrasSociales
 * @property FacturasObrasSocial[] $facturasObrasSocials
 * @property FacturasProfesional[] $facturasProfesionals
 * @property ObrasSociales $idOsFacturacion0
 * @property ObrasSociales[] $obrasSociales
 */
class ObrasSociales extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ObrasSociales the static model class
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
		return 'obras_sociales';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idOsFacturacion, retiene, idCondicionIva', 'numerical', 'integerOnly'=>true),
			array('nombreOs, email, contacto, direccion, nombreCorto, cuit, localidad, telefono, condicionVenta', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, nombreOs, email, contacto, direccion, nombreCorto, idOsFacturacion, cuit, retiene, localidad, telefono, idCondicionIva, condicionVenta', 'safe', 'on'=>'search'),
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
			'cobrosObrasSociales' => array(self::HAS_MANY, 'CobrosObrasSociales', 'idObraSocial'),
			'facturasObrasSocials' => array(self::HAS_MANY, 'FacturasObrasSocial', 'idObraSocial'),
			'facturasProfesionals' => array(self::HAS_MANY, 'FacturasProfesional', 'idObraSocial'),
			'idOsFacturacion0' => array(self::BELONGS_TO, 'ObrasSociales', 'idOsFacturacion'),
			'obrasSociales' => array(self::HAS_MANY, 'ObrasSociales', 'idOsFacturacion'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombreOs' => 'Nombre Os',
			'email' => 'Email',
			'contacto' => 'Contacto',
			'direccion' => 'Direccion',
			'nombreCorto' => 'Nombre Corto',
			'idOsFacturacion' => 'Id Os Facturacion',
			'cuit' => 'Cuit',
			'retiene' => 'Retiene',
			'localidad' => 'Localidad',
			'telefono' => 'Telefono',
			'idCondicionIva' => 'Id Condicion Iva',
			'condicionVenta' => 'Condicion Venta',
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
		$criteria->compare('nombreOs',$this->buscar,true,'OR');
		$criteria->compare('email',$this->buscar,true,'OR');
		$criteria->compare('contacto',$this->buscar,true,'OR');
		$criteria->compare('direccion',$this->buscar,true,'OR');
		$criteria->compare('nombreCorto',$this->buscar,true,'OR');
		$criteria->compare('idOsFacturacion',$this->buscar,'OR');
		$criteria->compare('cuit',$this->buscar,true,'OR');
		$criteria->compare('retiene',$this->buscar,'OR');
		$criteria->compare('localidad',$this->buscar,true,'OR');
		$criteria->compare('telefono',$this->buscar,true,'OR');
		$criteria->compare('idCondicionIva',$this->buscar,'OR');
		$criteria->compare('condicionVenta',$this->buscar,true,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}