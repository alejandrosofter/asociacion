<?php

/**
 * This is the model class for table "articulos".
 *
 * The followings are the available columns in table 'articulos':
 * @property integer $idObraSocial	
 * @property date $fechaActualiza
  * @property string $nombreArchivo

 */
class ArchivosExcelNomencladores extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Articulos the static model class
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
		return 'archivosExcelNomencladores';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fechaActualiza,nombreArchivo', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,idObraSocial,nombreArchivo, fechaActualiza', 'safe', 'on'=>'search'),
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
			'idObraSocial' => 'ID',
			'fechaActualiza' => 'fechaActualiza',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.Archivo
	 */
	public function getArchivo($idOs)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->addCondition('idObraSocial='.$idOs);

		$res= self::model()->findAll($criteria);
		if(count($res)>0)return $res[0];
	}
}