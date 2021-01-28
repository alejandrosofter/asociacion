<?php

/**
 * This is the model class for table "pagosOsde".
 *
 * The followings are the available columns in table 'pagosOsde':
 * @property integer $id
 * @property string $prestadorEfector
 * @property string $afiliado
 * @property string $prestacion
 * @property string $tipoPrestacion
 * @property integer $cantidadPrestaciones
 * @property string $fecha
 * @property string $delegacionOrdenes
 * @property integer $numeroOrden
 * @property string $tipoOrden
 * @property double $importeEspecialista
 * @property integer $cantidadAyudante
 * @property double $importeAnestecista
 * @property integer $cantidadAnestecista
 * @property double $importeGastos
 * @property integer $cantidadGastos
 * @property double $importeTotal
 * @property integer $profesionPrescriptor
 * @property integer $numeroMatriculaPrescriptor
 * @property string $letraProvinciaPrescriptor
 * @property integer $profesionEfector
 * @property integer $numeroMatriculaEfector
 * @property string $letraProvinciaEfector
 * @property integer $numeroTransaccion
 * @property string $prestadorPrescriptor
 * @property string $plan
 * @property integer $condicionIva
 * @property string $legajoInterno
 * @property string $codigoOperador
 * @property integer $filialTerminal
 * @property integer $delegacionTerminal
 * @property integer $numeroTerminal
 * @property string $fechaTransaccion
 * @property integer $provinciaTerminal
 * @property integer $condicionIvaEfector
 * @property string $nombreBeneficiario
 */
class PagosOsde extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PagosOsde the static model class
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
		return 'pagosOsde';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cantidadPrestaciones, numeroOrden, cantidadAyudante, cantidadAnestecista, cantidadGastos, profesionPrescriptor, numeroMatriculaPrescriptor, profesionEfector, numeroMatriculaEfector, numeroTransaccion, condicionIva, filialTerminal, delegacionTerminal, numeroTerminal, provinciaTerminal, condicionIvaEfector', 'numerical', 'integerOnly'=>true),
			array('importeEspecialista, importeAnestecista, importeGastos, importeTotal', 'numerical'),
			array('prestadorEfector, afiliado, prestacion, tipoPrestacion, delegacionOrdenes, tipoOrden, letraProvinciaPrescriptor, letraProvinciaEfector, prestadorPrescriptor, plan, legajoInterno, codigoOperador, nombreBeneficiario', 'length', 'max'=>50),
			array('fecha, fechaTransaccion', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, prestadorEfector, afiliado, prestacion, tipoPrestacion, cantidadPrestaciones, fecha, delegacionOrdenes, numeroOrden, tipoOrden, importeEspecialista, cantidadAyudante, importeAnestecista, cantidadAnestecista, importeGastos, cantidadGastos, importeTotal, profesionPrescriptor, numeroMatriculaPrescriptor, letraProvinciaPrescriptor, profesionEfector, numeroMatriculaEfector, letraProvinciaEfector, numeroTransaccion, prestadorPrescriptor, plan, condicionIva, legajoInterno, codigoOperador, filialTerminal, delegacionTerminal, numeroTerminal, fechaTransaccion, provinciaTerminal, condicionIvaEfector, nombreBeneficiario', 'safe', 'on'=>'search'),
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
			'prestadorEfector' => 'Prestador Efector',
			'afiliado' => 'Afiliado',
			'prestacion' => 'Prestacion',
			'tipoPrestacion' => 'Tipo Prestacion',
			'cantidadPrestaciones' => 'Cantidad Prestaciones',
			'fecha' => 'Fecha',
			'delegacionOrdenes' => 'Delegacion Ordenes',
			'numeroOrden' => 'Numero Orden',
			'tipoOrden' => 'Tipo Orden',
			'importeEspecialista' => 'Importe Especialista',
			'cantidadAyudante' => 'Cantidad Ayudante',
			'importeAnestecista' => 'Importe Anestecista',
			'cantidadAnestecista' => 'Cantidad Anestecista',
			'importeGastos' => 'Importe Gastos',
			'cantidadGastos' => 'Cantidad Gastos',
			'importeTotal' => 'Importe Total',
			'profesionPrescriptor' => 'Profesion Prescriptor',
			'numeroMatriculaPrescriptor' => 'Numero Matricula Prescriptor',
			'letraProvinciaPrescriptor' => 'Letra Provincia Prescriptor',
			'profesionEfector' => 'Profesion Efector',
			'numeroMatriculaEfector' => 'Numero Matricula Efector',
			'letraProvinciaEfector' => 'Letra Provincia Efector',
			'numeroTransaccion' => 'Numero Transaccion',
			'prestadorPrescriptor' => 'Prestador Prescriptor',
			'plan' => 'Plan',
			'condicionIva' => 'Condicion Iva',
			'legajoInterno' => 'Legajo Interno',
			'codigoOperador' => 'Codigo Operador',
			'filialTerminal' => 'Filial Terminal',
			'delegacionTerminal' => 'Delegacion Terminal',
			'numeroTerminal' => 'Numero Terminal',
			'fechaTransaccion' => 'Fecha Transaccion',
			'provinciaTerminal' => 'Provincia Terminal',
			'condicionIvaEfector' => 'Condicion Iva Efector',
			'nombreBeneficiario' => 'Nombre Beneficiario',
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

		$criteria->compare('id',$this->buscar,'OR');
		$criteria->compare('prestadorEfector',$this->buscar,true,'OR');
		$criteria->compare('afiliado',$this->buscar,true,'OR');
		$criteria->compare('prestacion',$this->buscar,true,'OR');
		$criteria->compare('tipoPrestacion',$this->buscar,true,'OR');
		$criteria->compare('cantidadPrestaciones',$this->buscar,'OR');
		$criteria->compare('fecha',$this->buscar,true,'OR');
		$criteria->compare('delegacionOrdenes',$this->buscar,true,'OR');
		$criteria->compare('numeroOrden',$this->buscar,'OR');
		$criteria->compare('tipoOrden',$this->buscar,true,'OR');
		$criteria->compare('importeEspecialista',$this->buscar,'OR');
		$criteria->compare('cantidadAyudante',$this->buscar,'OR');
		$criteria->compare('importeAnestecista',$this->buscar,'OR');
		$criteria->compare('cantidadAnestecista',$this->buscar,'OR');
		$criteria->compare('importeGastos',$this->buscar,'OR');
		$criteria->compare('cantidadGastos',$this->buscar,'OR');
		$criteria->compare('importeTotal',$this->buscar,'OR');
		$criteria->compare('profesionPrescriptor',$this->buscar,'OR');
		$criteria->compare('numeroMatriculaPrescriptor',$this->buscar,'OR');
		$criteria->compare('letraProvinciaPrescriptor',$this->buscar,true,'OR');
		$criteria->compare('profesionEfector',$this->buscar,'OR');
		$criteria->compare('numeroMatriculaEfector',$this->buscar,'OR');
		$criteria->compare('letraProvinciaEfector',$this->buscar,true,'OR');
		$criteria->compare('numeroTransaccion',$this->buscar,'OR');
		$criteria->compare('prestadorPrescriptor',$this->buscar,true,'OR');
		$criteria->compare('plan',$this->buscar,true,'OR');
		$criteria->compare('condicionIva',$this->buscar,'OR');
		$criteria->compare('legajoInterno',$this->buscar,true,'OR');
		$criteria->compare('codigoOperador',$this->buscar,true,'OR');
		$criteria->compare('filialTerminal',$this->buscar,'OR');
		$criteria->compare('delegacionTerminal',$this->buscar,'OR');
		$criteria->compare('numeroTerminal',$this->buscar,'OR');
		$criteria->compare('fechaTransaccion',$this->buscar,true,'OR');
		$criteria->compare('provinciaTerminal',$this->buscar,'OR');
		$criteria->compare('condicionIvaEfector',$this->buscar,'OR');
		$criteria->compare('nombreBeneficiario',$this->buscar,true,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}