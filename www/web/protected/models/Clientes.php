<?php

/**
 * This is the model class for table "clientes".
 *
 * The followings are the available columns in table 'clientes':
 * @property integer $idCliente
 * @property string $tipoCliente
 * @property string $nombre
 * @property string $apellido
 * @property string $nick
 * @property string $direccion
 * @property string $telefono
 * @property string $celular
 * @property string $recomendado
 * @property string $email
 * @property string $cuit
 * @property string $condicionIva
 * @property integer $facturarObra
 * @property string $nombreCorto
 */
class Clientes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Clientes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'clientes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tipoCliente, nick, direccion, email, condicionIva, facturarObra, nombreCorto', 'required'),
			array('facturarObra', 'numerical', 'integerOnly'=>true),
			array('tipoCliente, nombre, apellido, telefono, celular, recomendado, cuit', 'length', 'max'=>30),
			array('nick', 'length', 'max'=>140),
			array('direccion', 'length', 'max'=>70),
			array('email, condicionIva', 'length', 'max'=>100),
			array('nombreCorto', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idCliente, tipoCliente, nombre, apellido, nick, direccion, telefono, celular, recomendado, email, cuit, condicionIva, facturarObra, nombreCorto', 'safe', 'on'=>'search'),
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
			'idCliente' => 'Id Cliente',
			'tipoCliente' => 'Tipo Cliente',
			'nombre' => 'Nombre',
			'apellido' => 'Apellido',
			'nick' => 'Nick',
			'direccion' => 'Direccion',
			'telefono' => 'Telefono',
			'celular' => 'Celular',
			'recomendado' => 'Recomendado',
			'email' => 'Email',
			'cuit' => 'Cuit',
			'condicionIva' => 'Condicion Iva',
			'facturarObra' => 'Facturar Obra',
			'nombreCorto' => 'Nombre Corto',
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

		$criteria->compare('idCliente',$this->idCliente);
		$criteria->compare('tipoCliente',$this->tipoCliente,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('apellido',$this->apellido,true);
		$criteria->compare('nick',$this->nick,true);
		$criteria->compare('direccion',$this->direccion,true);
		$criteria->compare('telefono',$this->telefono,true);
		$criteria->compare('celular',$this->celular,true);
		$criteria->compare('recomendado',$this->recomendado,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('cuit',$this->cuit,true);
		$criteria->compare('condicionIva',$this->condicionIva,true);
		$criteria->compare('facturarObra',$this->facturarObra);
		$criteria->compare('nombreCorto',$this->nombreCorto,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}