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
 *
 * The followings are the available model relations:
 * @property FacturasProfesional[] $facturasProfesionals
 * @property Pagos[] $pagoses
 * @property CondicionIva $idCondicionIva0
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

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idCondicionIva', 'numerical', 'integerOnly'=>true),
			array('nombre, apellido, email, telefono, cuit, dni', 'length', 'max'=>255),
			// The following rule is used by search().
			array('regimen,nroMatriculaProvincial,nroMatriculaNacional,domicilio,localidad,idCondicionIva,nombre,apellido,cuit','required'),
			array('cuit','unique'),
			// Please remove those attributes that should not be searched.
			array('buscar,regimen,id, nombre, apellido, email, telefono, idCondicionIva, cuit, dni', 'safe', 'on'=>'search'),
		);
	}
	public function getnombreProfesionales()
	{
		if(isset($this)) return $this->apellido.' '.$this->nombre;
		return "s/n";
	}

	public function getRegimenes()
	{
		return array('actual'=>'COD-116','cod64'=>'COD-94');
	}
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'facturasProfesionals' => array(self::HAS_MANY, 'FacturasProfesional', 'idProfesional'),
			'pagoses' => array(self::HAS_MANY, 'Pagos', 'idProfesional'),
			'usuarioProfesional' => array(self::HAS_ONE, 'ProfesionalesUsuarios', 'idProfesional'),
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
			'nombre' => 'Nombre',
			'apellido' => 'Apellido',
			'email' => 'Email',
			'telefono' => 'Telefono',
			'idCondicionIva' => 'Condicion Iva',
			'cuit' => 'Cuit',
			'dni' => 'Dni',
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

		$criteria->compare('nombre',$this->buscar,true,'OR');
		$criteria->compare('apellido',$this->buscar,true,'OR');
		$criteria->compare('email',$this->buscar,true,'OR');
		$criteria->order='apellido';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}