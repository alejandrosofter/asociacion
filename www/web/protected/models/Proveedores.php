<?php

/**
 * This is the model class for table "proveedores".
 *
 * The followings are the available columns in table 'proveedores':
 * @property integer $idProveedor
 * @property string $nombre
 * @property string $rubro
 * @property string $email
 * @property string $direccion
 * @property string $telefono
 * @property string $celular
 * @property string $cuit
 * @property string $condicionIva
 * @property string $nombreCorto
 * @property string $regimen
 */
class Proveedores extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Proveedores the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function validarUsuario ($usuario,$clave)
	{
		$criteria=new CDbCriteria;
		$criteria->compare('t.cuit', $usuario, false);
		$criteria->compare('t.nombreCorto', $clave, false);
		
		return self::model()->findAll($criteria);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'proveedores';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, direccion, condicionIva, nombreCorto, regimen', 'required'),
			array('nombre, direccion, condicionIva, nombreCorto, regimen', 'length', 'max'=>255),
			array('rubro, email, telefono, celular, cuit', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idProveedor, nombre, rubro, email, direccion, telefono, celular, cuit, condicionIva, nombreCorto, regimen', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idProveedor' => 'Id Proveedor',
			'nombre' => 'Nombre',
			'rubro' => 'Rubro',
			'email' => 'Email',
			'direccion' => 'Direccion',
			'telefono' => 'Telefono',
			'celular' => 'Celular',
			'cuit' => 'Cuit',
			'condicionIva' => 'Condicion Iva',
			'nombreCorto' => 'Nombre Corto',
			'regimen' => 'Regimen',
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

		$criteria->compare('idProveedor',$this->idProveedor);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('rubro',$this->rubro,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('direccion',$this->direccion,true);
		$criteria->compare('telefono',$this->telefono,true);
		$criteria->compare('celular',$this->celular,true);
		$criteria->compare('cuit',$this->cuit,true);
		$criteria->compare('condicionIva',$this->condicionIva,true);
		$criteria->compare('nombreCorto',$this->nombreCorto,true);
		$criteria->compare('regimen',$this->regimen,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}