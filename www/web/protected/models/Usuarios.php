<?php

/**
 * This is the model class for table "usuarios".
 *
 * The followings are the available columns in table 'usuarios':
 * @property integer $id
 * @property string $nombreUsuario
 * @property string $clave
 * @property string $fechaAlta
 * @property string $email
 * @property string $imagen
 * @property integer $esAdministrativo
 * @property integer $idEstado
 *
 * The followings are the available model relations:
 * @property ProfesionalesUsuarios[] $profesionalesUsuarioses
 * @property Estados $idEstado0
 */
class Usuarios extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Usuarios the static model class
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
		return 'usuarios';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('esAdministrativo, idEstado', 'numerical', 'integerOnly'=>true),
			array('nombreUsuario, clave, email', 'length', 'max'=>255),
			array('fechaAlta, imagen', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, nombreUsuario, clave, fechaAlta, email, imagen, esAdministrativo, idEstado', 'safe', 'on'=>'search'),
		);
	}

	public function validarUsuario($usuario,$clave)
	{
		$usu=$this->buscar($usuario,$clave);
		if(count($usu)>0)return $usu[0]->profesionalUsuario->profesional;
		return null;
	}
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'profesionalUsuario' => array(self::HAS_ONE, 'ProfesionalesUsuarios', 'idUsuario'),
			'estado' => array(self::BELONGS_TO, 'Estados', 'idEstado'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombreUsuario' => 'Nombre Usuario',
			'clave' => 'Clave',
			'fechaAlta' => 'Fecha Alta',
			'email' => 'Email',
			'imagen' => 'Imagen',
			'esAdministrativo' => 'Es Administrativo',
			'idEstado' => 'Id Estado',
		);
	}

	public function buscar($usuario,$clave)
	{
		$criteria=new CDbCriteria;

		$criteria->compare('nombreUsuario',$usuario,false);
		$criteria->compare('clave',$clave,false);

		return self::model()->findAll($criteria);
	}
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->buscar,'OR');
		$criteria->compare('nombreUsuario',$this->buscar,true,'OR');
		$criteria->compare('clave',$this->buscar,true,'OR');
		$criteria->compare('fechaAlta',$this->buscar,true,'OR');
		$criteria->compare('email',$this->buscar,true,'OR');
		$criteria->compare('imagen',$this->buscar,true,'OR');
		$criteria->compare('esAdministrativo',$this->buscar,'OR');
		$criteria->compare('idEstado',$this->buscar,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}