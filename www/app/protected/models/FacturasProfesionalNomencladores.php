<?php

/**
 * This is the model class for table "facturasProfesional_nomencladores".
 *
 * The followings are the available columns in table 'facturasProfesional_nomencladores':
 * @property integer $id
 * @property integer $codigoInterno
 * @property integer $codigoExterno
 * @property string $detalle
 * @property double $importe
 */
class FacturasProfesionalNomencladores extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return FacturasProfesionalNomencladores the static model class
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
		return 'facturasProfesional_nomencladores';
	}
	public function buscarNuevoImporte($codigo,$idRango)
	{
		$criteria=new CDbCriteria;
			$criteria->addCondition("codigoInterno='".$codigo."' AND idRangoNomenclador=".$idRango);
			$res= self::model()->findAll($criteria);
			if(count($res)>0)return $res[0]->importe;
			return 0;
	}
	public function getNombreNomenclador()
	{
		$ext=isset($this->codigoExterno)?"":$this->codigoExterno;
		$detalle=utf8_decode(substr($this->detalle, 0,20))." INT: ";
		return $detalle.$this->codigoInterno."|".$ext;
	}
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idObraSocial', 'numerical', 'integerOnly'=>true),
			array('importe,idRangoNomenclador', 'numerical'),
			array('codigoExterno,codigoInterno,idRangoNomenclador', 'safe'),
			// The following rule is used by search().
			array("idObraSocial,detalle,importe","required"),
			// Please remove those attributes that should not be searched.
			array('buscar,id, codigoInterno,codigoExterno,idObraSocial, detalle, importe', 'safe', 'on'=>'search'),
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
			'os' => array(self::BELONGS_TO, 'ObrasSociales', 'idObraSocial'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'codigoInterno' => 'Codigo Interno',
			'codigoExterno' => 'Codigo Externo',
			'detalle' => 'Detalle',
			'importe' => 'Importe',
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

		$criteria->compare('codigoInterno',$this->codigoInterno,'OR');
		$criteria->compare('codigoExterno',$this->codigoExterno,'OR');
		$criteria->compare('idObraSocial',$this->idObraSocial,'OR');
		$criteria->compare('idRangoNomenclador',$this->idRangoNomenclador,'AND');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function buscarNomencaldor($codigoInterno,$idObraSocial,$idRangoNomenclador)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('codigoInterno',$codigoInterno,'AND');
		$criteria->compare('idObraSocial',$idObraSocial,'AND');
		$criteria->compare('idRangoNomenclador',$idRangoNomenclador,'AND');

		$res=self::model()->findAll($criteria);
		return count($res)>0?$res[0]:null;
	}
	public function buscarNomencaldores($idObraSocial,$idRangoNomenclador)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('idObraSocial',$idObraSocial,'AND');
		$criteria->compare('idRangoNomenclador',$idRangoNomenclador,'AND');

		return self::model()->findAll($criteria);
	}
}