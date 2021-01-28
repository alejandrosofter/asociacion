<?php

/**
 * This is the model class for table "obras_sociales".
 *
 * The followings are the available columns in table 'obras_sociales':
 * @property integer $id
 * @property string $nombreOs
 * @property string $email
 * @property string $contacto
 *
 * The followings are the available model relations:
 * @property CobrosObrasSociales[] $cobrosObrasSociales
 * @property FacturasObrasSocial[] $facturasObrasSocials
 * @property FacturasProfesional[] $facturasProfesionals
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
	public function getCondicionesVenta()
	{
		return array('Contado'=>'Contado','Cta Cte'=>'Cta Cte');
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombreOs, direccion,idOsFacturacion,cuit, contacto', 'length', 'max'=>255),
			array('nombreOs,realizaFacturacion,idCondicionIva,condicionVenta,retiene,telefono,estado,localidad','required'),
			array('email,preCodigo,importar_codigoInterno,importar_codigoExterno,importar_detalle,importar_importe,realizaFacturaCredito','safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,importar_codigoInterno,estado,importar_codigoExterno,importar_detalle,importar_importe, realizaFacturaCredito,idCondicionIva,condicionVenta,direccion,nombreCorto,idOsFacturacion,cuit,id, nombreOs, email, contacto', 'safe', 'on'=>'search'),
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
			'obraSocialCargo' => array(self::BELONGS_TO, 'ObrasSociales', 'idOsFacturacion'),
			'condicionIva' => array(self::BELONGS_TO, 'CondicionIva', 'idCondicionIva'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombreOs' => 'Nombre Obra Social',
			'email' => 'Email',
			'idOsFacturacion' => 'Facturación a Cargo...',
			'contacto' => 'Contacto',
			'retiene' => 'No Retiene',
			'idCondicionIva'=>'Condición Iva',
			'preCodigo'=>'Prefijo Noms.',
			"realizaFacturaCredito"=>"Factura como MiPyMes?"
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

		$criteria->compare('nombreOs',$this->buscar,true,'OR');
		$criteria->compare('nombreCorto',$this->buscar,true,'OR');
		$criteria->order='nombreOs';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function todas()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		return self::model()->findAll($criteria);
	}
	
}