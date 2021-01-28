<?php

/**
 * This is the model class for table "tablaRetenciones".
 *
 * The followings are the available columns in table 'tablaRetenciones':
 * @property integer $idImpuesto
 * @property double $masDe
 * @property double $a
 * @property double $agregadoEfectivo
 * @property double $agregadoPorcentaje
 * @property double $exedenteEfectivo
 *
 * The followings are the available model relations:
 * @property Retenciones[] $retenciones
 */
class TablaRetenciones extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TablaRetenciones the static model class
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
		return 'tablaRetenciones';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('masDe, a, agregadoEfectivo, agregadoPorcentaje, exedenteEfectivo', 'required'),
			array('masDe, a, agregadoEfectivo, agregadoPorcentaje, exedenteEfectivo', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,idImpuesto, masDe, a, agregadoEfectivo, agregadoPorcentaje, exedenteEfectivo', 'safe', 'on'=>'search'),
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
			'retenciones' => array(self::HAS_MANY, 'Retenciones', 'idTablaRetencion'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idImpuesto' => 'Id Impuesto',
			'masDe' => 'Mas De',
			'a' => 'A',
			'agregadoEfectivo' => 'Agregado Efectivo',
			'agregadoPorcentaje' => 'Agregado Porcentaje',
			'exedenteEfectivo' => 'Exedente Efectivo',
		);
	}

	public function porImporte($importe)
	{
		$criteria=new CDbCriteria;
		$criteria->addCondition('masDe<='.$importe.' AND a>='.$importe);
		$res=self::model()->findAll($criteria);
		if(count($res)>0)return $res[0];
		return null;
	}
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('idImpuesto',$this->buscar,'OR');
		$criteria->compare('masDe',$this->buscar,'OR');
		$criteria->compare('a',$this->buscar,'OR');
		$criteria->compare('agregadoEfectivo',$this->buscar,'OR');
		$criteria->compare('agregadoPorcentaje',$this->buscar,'OR');
		$criteria->compare('exedenteEfectivo',$this->buscar,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}