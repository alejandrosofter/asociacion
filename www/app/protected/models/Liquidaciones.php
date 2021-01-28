<?php

/**
 * This is the model class for table "liquidaciones".
 *
 * The followings are the available columns in table 'liquidaciones':
 * @property integer $id
 * @property string $fecha
 * @property string $pagos
 * @property string $cobros
 * @property double $importe
 */
class Liquidaciones extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Liquidaciones the static model class
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
		return 'liquidaciones';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fecha, pagos, cobros, importe', 'required'),
			array('importe', 'numerical'),
			array('pagos, cobros', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, fecha, pagos, cobros, importe', 'safe', 'on'=>'search'),
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
			'fecha' => 'Fecha',
			'pagos' => 'Pagos',
			'cobros' => 'Cobros',
			'importe' => 'Importe',
		);
	}

public function getOsLiquido()
{
	$arrLab=array();
	$arrCo=$this->cobros($this->id);
	foreach($arrCo as $itemCobro){
		$arrLab[]=$itemCobro->getObrasSociales(false);
		
	}
		
	return implode(", ",$arrLab);
}
	public function quitarPagos()
	{
		$arrCo=explode(",",$this->pagos);
	foreach($arrCo as $idPago){
		$pagos=Pagos::model()->findByPk($idPago);
		$pagos->delete();
	}
	}
	public function pagos($id)
	{
		$liquidacion=Liquidaciones::model()->findByPk($id);
		$arrCo=explode(",",$liquidacion->pagos);
		$arrPagos=array();
	foreach($arrCo as $idPago){
    $pago=Pagos::model()->findByPk($idPago);
    if($pago) $arrPagos[]=Pagos::model()->findByPk($idPago)->with(array("profesional"));
		
	}
		
		
		return $arrPagos;
	}
	public function cobros($id)
	{
		$liquidacion=Liquidaciones::model()->findByPk($id);
		$arrCo=explode(",",$liquidacion->cobros);
		$arr=array();
		foreach($arrCo as $id){
		    $ob=Cobros::model()->findByPk($id);
		    if($ob) $arr[]=$ob;
		}
		
		
		return $arr;
	}
		public function cambiarEstadoCobros()
	{
		$arrCo=explode(",",$this->cobros);
	foreach($arrCo as $idCobro){
	$cobro=Cobros::model()->findByPk($idCobro);
		$cobro->estado="PENDIENTE";
		$cobro->save();
	}
	}
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->buscar,'OR');
		$criteria->compare('fecha',$this->buscar,true,'OR');
		$criteria->compare('pagos',$this->buscar,true,'OR');
		$criteria->compare('cobros',$this->buscar,true,'OR');
		$criteria->compare('importe',$this->buscar,'OR');
	$criteria->order="fecha desc";
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}