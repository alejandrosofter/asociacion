<?php

/**
 * This is the model class for table "profesionales".
 *
 * The followings are the available columns in table 'profesionales':
 * @property integer $id
 * @property string $nombre
 * @property string $apellido
 * @property string $email
 * @property string $telefono
 * @property integer $idCondicionIva
 * @property string $cuit
 * @property string $dni
 * @property string $regimen
 * @property string $domicilio
 * @property string $localidad
 *
 * The followings are the available model relations:
 * @property FacturasProfesional[] $facturasProfesionals
 * @property Pagos[] $pagoses
 * @property CondicionIva $idCondicionIva0
 * @property ProfesionalesUsuarios[] $profesionalesUsuarioses
 */
class Profesionales extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Profesionales the static model class
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
		return 'profesionales';
	}
	public function getnombreProfesionales()
	{
		return $this->apellido.' '.$this->nombre;
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idCondicionIva', 'numerical', 'integerOnly'=>true),
			array('nombre, apellido, email, telefono, cuit, dni, regimen, domicilio, localidad', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, nombre, apellido, email, telefono, idCondicionIva, cuit, dni, regimen, domicilio, localidad', 'safe', 'on'=>'search'),
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
			'facturasProfesionals' => array(self::HAS_MANY, 'FacturasProfesional', 'idProfesional'),
			'pagoses' => array(self::HAS_MANY, 'Pagos', 'idProfesional'),
			'condicionIva' => array(self::BELONGS_TO, 'CondicionIva', 'idCondicionIva'),
			'usuario' => array(self::HAS_ONE, 'ProfesionalesUsuarios', 'idProfesional'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombre' => 'Nombre',
			'apellido' => 'Apellido',
			'email' => 'Email',
			'telefono' => 'Telefono',
			'idCondicionIva' => 'Id Condicion Iva',
			'cuit' => 'Cuit',
			'dni' => 'Dni',
			'regimen' => 'Regimen',
			'domicilio' => 'Domicilio',
			'localidad' => 'Localidad',
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
		$criteria->compare('nombre',$this->buscar,true,'OR');
		$criteria->compare('apellido',$this->buscar,true,'OR');
		$criteria->compare('email',$this->buscar,true,'OR');
		$criteria->compare('telefono',$this->buscar,true,'OR');
		$criteria->compare('idCondicionIva',$this->buscar,'OR');
		$criteria->compare('cuit',$this->buscar,true,'OR');
		$criteria->compare('dni',$this->buscar,true,'OR');
		$criteria->compare('regimen',$this->buscar,true,'OR');
		$criteria->compare('domicilio',$this->buscar,true,'OR');
		$criteria->compare('localidad',$this->buscar,true,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}