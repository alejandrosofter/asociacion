<?php

/**
 * This is the model class for table "practicas".
 *
 * The followings are the available columns in table 'practicas':
 * @property integer $id
 * @property integer $codigo
 * @property string $descripcion
 */
class Practicas extends CActiveRecord
{
	public $idCategoria;
	public $idSubCategoria;
	public $nombreCategoria;
	public $nombreSubCategoria;
	public $codigoObraSocial;
	public $codigoPractica;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Practicas the static model class
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
		return 'practicas';
	}

	public function getNombrePractica()
	{
		$cod= $this->codigo;
		$cod.=$this->codigoObraSocial==''?'':' (Cod OS) '.$this->codigoObraSocial;
		return $cod;
	}
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		array('codigo,idCategoria,idSubCategoria,codigoObraSocial', 'numerical', 'integerOnly'=>true),
		array('codigo', 'safe'),
		//array('nombreSubCat','required'),
		array('id, codigo, descripcion', 'safe', 'on'=>'search'),
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
			'categoria' => array(self::BELONGS_TO, 'PracticasCategoria', 'idCategoria'),
			'subCategoria' => array(self::BELONGS_TO, 'PracticasSubCat', 'idSubCategoria'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'codigo' => 'Codigo',
			'descripcion' => 'Descripcion',
			'idCategoria' => 'Categoria',
			'idSubCategoria' => 'Sub categoria',
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
		$criteria->compare('codigo',$this->codigo);
		$criteria->compare('descripcion',$this->descripcion,true);

		$criteria->join='left join practicas_categoria on t.idCategoria = practicas_categoria.id
						 left join practicas_subCat on t.idSubCategoria = practicas_subCat.id';
		$criteria->select='t.*, practicas_categoria.nombreCategoria as nombreCategoria,
								practicas_subCat.nombreSubCat as nombreSubCategoria';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function codigos ()
	{
		// funcion hecha para que al crear una practica profesional te concatene los 2 codigos.
		$criteria=new CDbCriteria;
		$criteria->select='t.*, concat(t.codigo," ",if (isnull (t.codigoObraSocial), " ", t.codigoObraSocial )) as codigoPractica';
		return self::model()->findAll($criteria);
	}
}