<?php

/**
 * This is the model class for table "comunicados_archivos".
 *
 * The followings are the available columns in table 'comunicados_archivos':
 * @property integer $id
 * @property integer $idComunicado
 * @property string $nombreArchivo
 * @property string $fecha
 */
class ComunicadosArchivos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ComunicadosArchivos the static model class
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
		return 'comunicados_archivos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idComunicado', 'numerical', 'integerOnly'=>true),
			array('nombreArchivo', 'length', 'max'=>255),
			array('fecha', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, idComunicado, nombreArchivo, fecha', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'idComunicado' => 'Id Comunicado',
			'nombreArchivo' => 'Nombre Archivo',
			'fecha' => 'Fecha',
		);
	}
	public function cargar($archivos,$id)
	{
		foreach($archivos as $arch){
			$model=new ComunicadosArchivos;
			$model->idComunicado=$id;
			$model->nombreArchivo=$arch;
			$model->fecha=Date('Y-m-d H:i:s');
			$model->save();
		}
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
		$criteria->compare('idComunicado',$this->buscar,'OR');
		$criteria->compare('nombreArchivo',$this->buscar,true,'OR');
		$criteria->compare('fecha',$this->buscar,true,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}