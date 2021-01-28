<?php

/**
 * This is the model class for table "emails".
 *
 * The followings are the available columns in table 'emails':
 * @property integer $id
 * @property string $mensaje
 * @property string $remitente
 * @property string $fecha
 * @property string $estado
 */
class Emails extends CActiveRecord
{
	public $pathImagenes="/../../archivos/comunicados/";
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Emails the static model class
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
		return 'emails';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mensaje, remitente, fecha', 'required'),
			array('estado', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, mensaje, remitente, fecha, estado', 'safe', 'on'=>'search'),
		);
	}

	public function enviarMensajeBase($destinatario,$titulo,$cuerpoMensaje,$remitente=null)
	{
		$parametros['cuerpo']=$cuerpoMensaje;
        if($remitente==null)$remitente= Settings::model()->getValorSistema('DATOS_EMPRESA_EMAILADMIN');
        $parametros['empresa']=Settings::model()->getValorSistema('DATOS_EMPRESA_FANTASIA');
        $parametros['direccion']=Settings::model()->getValorSistema('DATOS_EMPRESA_DIRECCION');
        $parametros['telefono']=Settings::model()->getValorSistema('DATOS_EMPRESA_TELEFONO');
        $parametros['horarios']= Settings::model()->getValorSistema('DATOS_EMPRESA_HORARIOS');
        $parametros['email']= Settings::model()->getValorSistema('DATOS_EMPRESA_EMAILADMIN');
        $parametros['site']= Settings::model()->getValorSistema('DATOS_EMPRESA_SITE');
        $parametros['titulo']=$titulo;
        $parametros['fecha']=Date('d/m/Y');
        self::model()->enviarMail ( $destinatario, Settings::model()->getValorSistema('PLANTILLA_BASE',$parametros,'impresiones'), $titulo, $remitente);
	}
	public function enviarMail($mail,$mensaje,$titulo,$desde,$attachs=null)
	{
		$estado="ENVIADO";
		
		try {
    		Yii::app()->mailer->AddAddress($mail);
			Yii::app()->mailer->Subject = $titulo;
			Yii::app()->mailer->MsgHTML($mensaje);
			Yii::app()->mailer->From=$desde;
			if($attachs!=null)
				foreach($attachs as $file){
					$targetPath = dirname(__FILE__).'/../../archivos/comunicados/';
					$targetFile = rtrim($targetPath,'/') . '/'.$file;
					Yii::app()->mailer->addFile($targetFile);
				}
					
			Yii::app()->mailer->Send();
} catch (Exception $e) {
    $estado="FALLO DE ENVIO";
}
self::ingresa($estado,$mail,$mensaje,Date('Y-m-d H:i:s'));
	}
	private function ingresa($estado,$mail,$mensaje,$fecha)
	{
		$model=new Emails;
		$model->remitente=$mail;
		$model->estado=$estado;
		$model->fecha=$fecha;
		$model->mensaje=$mensaje;
		$model->save();
	}
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
			'mensaje' => 'Mensaje',
			'remitente' => 'Remitente',
			'fecha' => 'Fecha',
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

		$criteria->compare('id',$this->buscar,'OR');
		$criteria->compare('mensaje',$this->buscar,true,'OR');
		$criteria->compare('remitente',$this->buscar,true,'OR');
		$criteria->compare('fecha',$this->buscar,true,'OR');
		$criteria->compare('estado',$this->buscar,true,'OR');
		$criteria->order='t.id desc';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}