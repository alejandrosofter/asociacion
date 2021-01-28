<?php

/**
 * This is the model class for table "practicas_subCat".
 *
 * The followings are the available columns in table 'practicas_subCat':
 * @property integer $id
 * @property string $nombreSubCat
 */
class PracticasSubCat extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PracticasSubCat the static model class
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
		return 'practicas_subCat';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		array('nombreSubCat', 'length', 'max'=>255),
		array('nombreSubCat','required'),
		// The following rule is used by search().
		// Please remove those attributes that should not be searched.
		array('id, nombreSubCat', 'safe', 'on'=>'search'),
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
			'nombreSubCat' => 'Nombre sub categoria',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('nombreSubCat',$this->nombreSubCat,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}