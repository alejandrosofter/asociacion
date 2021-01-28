<?php

/**
 * This is the model class for table "ordenesTrabajo".
 *
 * The followings are the available columns in table 'ordenesTrabajo':
 * @property integer $idOrdenTrabajo
 * @property integer $idCliente
 * @property string $descripcionCliente
 * @property string $descripcionEncargado
 * @property integer $idUsuarioEncargado
 * @property string $estadoOrden
 * @property string $fechaIngreso
 * @property string $prioridad
 * @property string $tipoOrden
 * @property integer $diasSolucion
 * @property double $precio
 * @property integer $idUsuarioComision
 */
class OrdenesTrabajo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return OrdenesTrabajo the static model class
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
		return 'ordenesTrabajo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idCliente, descripcionCliente, descripcionEncargado, idUsuarioEncargado, estadoOrden, fechaIngreso, prioridad, tipoOrden, diasSolucion, idUsuarioComision', 'required'),
			array('idCliente, idUsuarioEncargado, diasSolucion, idUsuarioComision', 'numerical', 'integerOnly'=>true),
			array('precio', 'numerical'),
			array('estadoOrden, prioridad, tipoOrden', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idOrdenTrabajo, idCliente, descripcionCliente, descripcionEncargado, idUsuarioEncargado, estadoOrden, fechaIngreso, prioridad, tipoOrden, diasSolucion, precio, idUsuarioComision', 'safe', 'on'=>'search'),
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
			'obraSocial' => array(self::BELONGS_TO, 'Clientes', 'idCliente'),
			'profesional' => array(self::BELONGS_TO, 'Proveedores', 'idUsuarioEncargado'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idOrdenTrabajo' => 'Id Orden Trabajo',
			'idCliente' => 'Id Cliente',
			'descripcionCliente' => 'Descripcion Cliente',
			'descripcionEncargado' => 'Descripcion Encargado',
			'idUsuarioEncargado' => 'Id Usuario Encargado',
			'estadoOrden' => 'Estado Orden',
			'fechaIngreso' => 'Fecha Ingreso',
			'prioridad' => 'Prioridad',
			'tipoOrden' => 'Tipo Orden',
			'diasSolucion' => 'Dias Solucion',
			'precio' => 'Precio',
			'idUsuarioComision' => 'Id Usuario Comision',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function buscar($id,$fechaDesde,$fechaHasta)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$arr=explode('-',$fechaDesde);
		$fechaDesde=$arr[2].'-'.$arr[1].'-'.$arr[0];
		$arr=explode('-',$fechaHasta);
		$fechaHasta=$arr[2].'-'.$arr[1].'-'.$arr[0];
		$criteria->addBetweenCondition('fechaIngreso',$fechaDesde,$fechaHasta);

		$criteria->compare('idUsuarioEncargado',$id,false);
		$criteria->order='t.idOrdenTrabajo desc';
		return self::model()->with('obraSocial','profesional')->findAll($criteria);
	}
}