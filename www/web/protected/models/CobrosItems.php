<?php

/**
 * This is the model class for table "cobros_items".
 *
 * The followings are the available columns in table 'cobros_items':
 * @property integer $id
 * @property integer $idCobro
 * @property string $detalle
 * @property double $importe
 * @property integer $idTipoItem
 * @property string $estado
 *
 * The followings are the available model relations:
 * @property Cobros $idCobro0
 * @property CobrosTipos $idTipoItem0
 */
class CobrosItems extends CActiveRecord
{
	const PENDIENTE='PENDIENTE';
	const CANCELADO='CANCELADO';
	const ID_COBRO=102;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CobrosItems the static model class
	 */
	 public $buscar;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function ingresar($item,$idCobro,$idFactura)
	{
		$fact=FacturasObrasSocial::model()->findByPk($idFactura);
		$model=new CobrosItems;
		$cobro=Cobros::model()->findByPk($idCobro);
		$tipo=CobrosTipos::model()->findByPk($item['idTipo']);
		$model->idCobro=$idCobro;
		$model->importe=$item['importe'];
		$model->idTipoItem=$item['idTipo'];
		$det=empty($item['detalle'])?'':(' - '.$item['detalle']);
		$fecha=' '.Yii::app()->dateFormatter->format("dd-MM-yyyy",$fact->fecha);
		$model->detalle=$tipo->nombreTipoCobro.' '.$cobro->obraSocial->nombreOs.''.$det.$fecha;
		$model->estado=$item['estado'];
		$model->idProfesional=$item['idProfesional'];
		$model->save();
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cobros_items';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idCobro, idTipoItem', 'numerical', 'integerOnly'=>true),
			array('importe', 'numerical'),
			array('estado', 'length', 'max'=>200),
			array('detalle', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, idCobro, detalle, importe, idTipoItem, estado', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'cobro' => array(self::BELONGS_TO, 'Cobros', 'idCobro'),
			'tipo' => array(self::BELONGS_TO, 'CobrosTipos', 'idTipoItem'),
			'profesional' => array(self::BELONGS_TO, 'Profesionales', 'idProfesional'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idCobro' => 'Id Cobro',
			'detalle' => 'Detalle',
			'importe' => 'Importe',
			'idTipoItem' => 'Id Tipo Item',
			'estado' => 'Estado',
			'idProfesional' => 'Profesional',
		);
	}
	public $total;
	public $debitos;
	public $creditos;
	public function getPendientesProfesional($idProfesional)
	{
		$criteria=new CDbCriteria;
		$criteria->compare('estado',self::PENDIENTE,false);
		$criteria->compare('idProfesional',$idProfesional,false);
		return self::model()->findAll($criteria);
	}
	public function getPendientes($idProfesional=null)
	{
		$criteria=new CDbCriteria;
		$criteria->join='left join profesionales on profesionales.id=t.idProfesional';
		$criteria->compare('estado',self::PENDIENTE,false);
		if($idProfesional!=null)$criteria->compare('idProfesional',$idProfesional,false);
		$criteria->select='t.*,sum(importe) as total,SUM(IF(importe<0,importe,0)) as debitos, SUM(IF(importe>0,importe,0))  as creditos';
		if($idProfesional==null)$criteria->group='t.idProfesional';
		$criteria->order='profesionales.apellido'; 
		
		return self::model()->findAll($criteria);
	}
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('idCobro',$this->idCobro,false);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}