<?php

/**
 * This is the model class for table "facturasObrasSocial_items".
 *
 * The followings are the available columns in table 'facturasObrasSocial_items':
 * @property integer $id
 * @property integer $idFacturaObraSocial
 * @property integer $idFacturaProfesional
 *
 * The followings are the available model relations:
 * @property FacturasProfesional $idFacturaProfesional0
 * @property FacturasObrasSocial $idFacturaObraSocial0
 */
class FacturasObrasSocialItems extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return FacturasObrasSocialItems the static model class
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
		return 'facturasObrasSocial_items';
	}

	public function agregar($idObraSocial,$idFactura)
	{
		$items=FacturasProfesional::model()->getItems($idObraSocial);
		foreach($items as $item){
			$model=new FacturasObrasSocialItems;
			$model->idFacturaObraSocial=$idFactura;
			$model->idFacturaProfesional=$item->id;
			$model->save();
			$item->estado=FacturasProfesional::FACTURADO;
			$item->save();
		}
	}
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idFacturaObraSocial, idFacturaProfesional', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, idFacturaObraSocial, idFacturaProfesional', 'safe', 'on'=>'search'),
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
			'facturaProfesional' => array(self::BELONGS_TO, 'FacturasProfesional', 'idFacturaProfesional'),
			
			'facturaObraSocial' => array(self::BELONGS_TO, 'FacturasObrasSocial', 'idFacturaObraSocial'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idFacturaObraSocial' => 'Id Factura Obra Social',
			'idFacturaProfesional' => 'Id Factura Profesional',
		);
	}

	public function items($id)
	{
		$criteria=new CDbCriteria;

		$criteria->compare('idFacturaObraSocial',$id,false);
		return self::model()->findAll($criteria);
	}
	public function getPendientes($idProfesional,$ano)
	{
		$criteria=new CDbCriteria;
		$criteria->with=array('facturaObraSocial','facturaProfesional');
		$criteria->compare('facturaProfesional.idProfesional',$idProfesional,false);
		$criteria->compare('facturaObraSocial.estado',"PENDIENTE",false);
		$criteria->compare('YEAR(facturaObraSocial.fecha)',$ano);
		$criteria->order='t.id desc';
		return self::model()->findAll($criteria);
	}
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('idFacturaObraSocial',$this->idFacturaObraSocial,false);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}