<?php

/**
 * This is the model class for table "archivosNomencladores".
 *
 * The followings are the available columns in table 'archivosNomencladores':
 * @property integer $id
 * @property integer $idObraSocial
 * @property string $fechaModificacion
 * @property string $data
 */
class ArchivosNomencladores extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ArchivosNomencladores the static model class
	 */
	 public $buscar;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function getImagenDescarga()
	{

		$src= "images/iconos/famfam/page_white_put.png";
		
		if($this->type==="application/octet-stream")
			$src= "images/iconos/famfam/page_white_error.png";
		if($this->type==="application/pdf")
			$src= "images/iconos/famfam/page_white_acrobat.png";
        return $src;
	}
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'archivosNomencladores';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idObraSocial, fechaModificacion', 'required'),
			array('idObraSocial,idProfesional', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id,idProfesional, idObraSocial,name,type,size, fechaModificacion, data', 'safe', 'on'=>'search'),
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
			'obraSocial' => array(self::BELONGS_TO, 'ObrasSociales', 'idObraSocial'),
			'profesional' => array(self::BELONGS_TO, 'Profesionales', 'idProfesional'),

		);
	}

	public function beforeSave()
	{
		if($file=CUploadedFile::getInstance($this,'data'))
		{
			$this->name=$file->name;
			$this->type=$file->type;
			$this->size=$file->size;
			$this->data=file_get_contents($file->tempName);
		}

	return parent::beforeSave();
	}
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idObraSocial' => 'Obra Social',
			'idProfesional' => 'Profesional',
			'fechaModificacion' => 'Fecha Modificacion',
			'data' => 'Archivo',
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
		$criteria->compare('idObraSocial',$this->buscar,'OR');
		$criteria->compare('fechaModificacion',$this->buscar,true,'OR');
		$criteria->compare('data',$this->buscar,true,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}