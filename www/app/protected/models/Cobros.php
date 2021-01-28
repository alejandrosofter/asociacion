<?php

/**
 * This is the model class for table "cobros".
 *
 * The followings are the available columns in table 'cobros':
 * @property integer $id
 * @property string $fecha
 * @property string $detalle
 * @property double $importe
 *
 * The followings are the available model relations:
 * @property CobrosItems[] $cobrosItems
 * @property CobrosObrasSociales[] $cobrosObrasSociales
 */
class Cobros extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Cobros the static model class
	 */
	 public $buscar;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function getColor()
	{
		if($this->estado=="PENDIENTE")return "red";else return "green";
	}
	public function getFormaPagos()
	{
		return array('TRANSFERENCIA'=>'TRANSFERENCIA','CHEQUE'=>'CHEQUE');
	}
	public function cargarItemsFactura()
	{
		foreach($this->cobrosObrasSociales as $item) $this->cargarItemsCobro($item->factura);
	}
	private function cargarItemsCobro($factura)
	{
		$items=$factura->facturasObrasSocialItems;
		foreach($items as $item){
			$model=new CobrosItems();
			$model->idCobro=$this->id;
			$model->detalle="COBRO ".$item->facturaObraSocial->obraSocial->nombreOs." ".$factura->fecha;
			$model->importe=$item->facturaProfesional->importe;
			$model->idTipoItem=2;
			$model->estado="PENDIENTE";
			$model->idProfesional=$item->facturaProfesional->idProfesional;
			$model->save();
		}
	}
	public function getImporteItems()
	{
		$tot=0;
		foreach($this->cobrosItems as $item)
			$tot+=$item->importe;
		return $tot;
	}
	public function recalculaImporte()
	{
		$this->importe=$this->getImporteItems();
		$this->save();
	}
	public function anual($ano)
	{
		$sal=array();
		for($i=0;$i<12;$i++){
			$criteria=new CDbCriteria;
			$criteria->compare('YEAR(fecha)',$ano,false);
			$criteria->compare('MONTH(fecha)',($i+1),false);
			$criteria->select='t.*,round(SUM(importe),2) as importe';
			$res= self::model()->findAll($criteria);
			if(count($res)>0)$sal[]=$res[0]->importe; else $sal[]=0;
		}
		return $sal;
		
	}
	public function getDetalleFactura()
	{
		$items=$this->cobrosObrasSociales;
		$sal="";
		if($items)
			for ($i=0; $i < count($items); $i++) { 
				$link="index.php?r=facturasObrasSocial/imprimirResumen&idFactura=".$items[$i]->idFactura;
				$sal.="<a class='imprime' target='_blank' data-fancybox-type='iframe' href='".$link."'><small><b>".$items[$i]->obraSocial->nombreOs." </b> | ".Yii::app()->dateFormatter->format("dd-MM-yyyy",$items[$i]->factura->fecha)." | ".$items[$i]->factura->detalle." $ ".$items[$i]->factura->importe." | NRO ".$items[$i]->factura->getNroFactura()."<br></small></a>" ;
			}
		return CHtml::decode($sal);
	}
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cobros';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('importe', 'numerical'),
			array('fecha,importeDebitos,nroOperacion,formaPago,importe', 'required'),
			array('fecha,estado,bancoEmisor,nroOperacion,formaPago,importeDebitos, detalle', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,estado,id,importeDebitos, fecha, detalle, importe', 'safe', 'on'=>'search'),
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
			'cobrosItems' => array(self::HAS_MANY, 'CobrosItems', 'idCobro'),
			'cobroOs' => array(self::HAS_ONE, 'CobrosObrasSociales', 'idCobro'),
			'obraSocial' => array(self::HAS_ONE, 'ObrasSociales', array('idObraSocial'=>'id'),'through'=>'cobroOs'),
			'cobrosObrasSociales' => array(self::HAS_MANY, 'CobrosObrasSociales', 'idCobro'),
		);
	}
	public function consultarProfesionalesCobro($idcobros)
	{ 
		$ids="";
		foreach($idcobros as $id)
			$ids.=$id.", ";
		$ids=rtrim($ids,", ");
		//echo $ids;
		$criteria=new CDbCriteria;
		$criteria->with=array("profesional");
		$criteria->order="profesional.apellido asc";
		$criteria->addCondition("idCobro in(".$ids.")");
		return CobrosItems::model()->findAll($criteria);
	}
	public function updateImporte()
	{
		$this->importe=$this->importeItems();
		$this->save();
	}
	public function getObrasSociales2()
	{
		$items=$this->cobrosObrasSociales;
		$sal="";
		$sal.=count($items);
		if($items)
			for ($i=0; $i < count($items); $i++) { 
				$sal.="<small><b>".$items[$i]->obraSocial->nombreOs." </b> | ".Yii::app()->dateFormatter->format("dd-MM-yyyy",$items[$i]->factura->fecha)." | ".$items[$i]->factura->detalle." $ ".$items[$i]->factura->importe." | NRO ".$items[$i]->factura->getNroFactura()."<br></small>" ;
			}
		return CHtml::decode($sal);
	}
	public function getObrasSociales($abrebia)
	{
		$items=$this->cobrosObrasSociales;
		$sal="";
		$sal.="<small>(".count($items).")</small>";
		if($items)
			for ($i=0; $i < count($items); $i++) { 
				$abrebiado="<small><b>".$items[$i]->obraSocial->nombreOs."</small></b>";
				$completo="<small><b>".$items[$i]->obraSocial->nombreOs." </b> | ".Yii::app()->dateFormatter->format("dd-MM-yyyy",$items[$i]->factura->fecha)." | ".$items[$i]->factura->detalle." $ ".$items[$i]->factura->importe." | NRO ".$items[$i]->factura->getNroFactura()."<br></small>" ;
				$sal.=$abrebia?$abrebiado:$completo;

			}
		return CHtml::decode($sal);
	}

	private function importeItems()
	{	
		$importe=0;
		$cobro=Cobros::model()->findByPk($this->id);
		foreach($cobro->cobrosItems as $item)$importe+=$item->importe;
		return $importe;
	}
	public function getPendientes()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.1538

		$criteria=new CDbCriteria;
		$criteria->with=array('obraSocial');
		$criteria->addCondition("t.estado='PENDIENTE'");
		$criteria->order='t.id desc';
		return Cobros::model()->findAll($criteria);
	}

public function getCancelados()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.1538

		$criteria=new CDbCriteria;
		$criteria->with=array('obraSocial');
		$criteria->addCondition("t.estado='CANCELADO'");
		$criteria->order='t.id desc';
		return Cobros::model()->findAll($criteria);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fecha' => 'Fecha',
			'detalle' => 'Detalle',
			'importe' => 'Importe TOTAL',
			'importeDebitos' => 'Importe DEBITOS',
			'bancoEmisor' => 'Banco Emisor',
			'formaPago' => 'Forma de Pago',
			'nroOperacion' => 'Nro operacion',
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
		$criteria->with=array('obraSocial');
		$criteria->compare('obraSocial.nombreOs',$this->buscar,true,'OR');
		if($this->estado!="")$criteria->addCondition("t.estado='".$this->estado."'");
		$criteria->order='t.id desc';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}