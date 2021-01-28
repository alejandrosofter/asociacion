<?php

/**
 * This is the model class for table "liquidacionesWeb".
 *
 * The followings are the available columns in table 'liquidacionesWeb':
 * @property string $id
 * @property integer $idProfesional
 * @property string $detalle
 * @property string $fechaComienzo
 * @property string $fechaEntrega
 * @property integer $nroLiquidacion
 * @property string $idUsuarioWeb
 * @property string $estado
 *
 * The followings are the available model relations:
 * @property LiquidacionesWebFacturas[] $liquidacionesWebFacturases
 */
class LiquidacionesWeb extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return LiquidacionesWeb the static model class
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
		return 'liquidacionesWeb';
	}
	public function setPendientesCancelados($idFacturaObraSocial,$idObraSocial)
	{
		$arr=LiquidacionesWeb::model()->getPendientes($idObraSocial*1);

		foreach ($arr as $key => $liquidacionWeb) {
			if(isset($idFacturaObraSocial)){
				// $model=new LiquidacionesWeb_facturas;
				// $model->idFacturaObraSocial=$idFacturaObraSocial;
				// $model->idLiquidacionWeb=$liquidacionWeb->id;
// no se que paso ahi
				if(true){
					$liquidacionWeb->estado="CANCELADA";
					$liquidacionWeb->save();
				}	
			// }
			

			
		}
	}
}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idProfesional, nroLiquidacion', 'numerical', 'integerOnly'=>true),
			array('id, idUsuarioWeb, estado', 'length', 'max'=>50),
			array('fechaComienzo,detalle, fechaEntrega', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id,detalle, idProfesional, detalle, fechaComienzo, fechaEntrega, nroLiquidacion, idUsuarioWeb, estado', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function quitarFacturas()
	{
		
		foreach($this->facturas as $item)$item->factura->delete();
	}
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'profesional' => array(self::BELONGS_TO, 'Profesionales', 'idProfesional'),
			'facturas' => array(self::HAS_MANY, 'LiquidacionesWeb_facturas', 'idLiquidacionWeb'),
			
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idProfesional' => 'Id Profesional',
			'detalle' => 'Detalle',
			'fechaComienzo' => 'Fecha Comienzo',
			'fechaEntrega' => 'Fecha Entrega',
			'nroLiquidacion' => 'Nro Liquidacion',
			'idUsuarioWeb' => 'Id Usuario Web',
			'estado' => 'Estado',
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
		if($this->estado!="") $criteria->addCondition('estado="'.$this->estado.'"');
		if($this->idProfesional!="") $criteria->addCondition('idProfesional="'.$this->idProfesional.'"');
		$criteria->order="t.fechaEntrega desc";
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function getPendientes($idOs=null)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		if($idOs!=null)$criteria->addCondition('idObraSocial='.$idOs);
		$criteria->addCondition('estado="PENDIENTE"');

		return $this->model()->findAll($criteria);
	}
	public function getPendientesOs($idOs)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$criteria->addCondition('estado="PENDIENTE" AND idObraSocial='.$idOs);

		return $this->model()->findAll($criteria);
	}
}