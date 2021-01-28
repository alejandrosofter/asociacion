<?php

/**
 * This is the model class for table "emails".
 *
 * The followings are the available columns in table 'emails':
 * @property integer $id
 * @property string $emisor
 * @property string $receptor
 * @property string $mensaje
 * @property string $fecha
 * @property string $estado
 */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception; 
// require dirname(__FILE__).'/../../vendor/autoload.php';
require dirname(__FILE__).'/../../vendor/phpmailer/phpmailer/src/Exception.php';
require dirname(__FILE__).'/../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require dirname(__FILE__).'/../../vendor/phpmailer/phpmailer/src/SMTP.php';
class Mail extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Mail the static model class
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
			array('emisor, receptor, estado', 'length', 'max'=>255),
			array('mensaje, fecha', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, emisor, receptor, mensaje, fecha, estado', 'safe', 'on'=>'search'),
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
			'emisor' => 'Emisor',
			'receptor' => 'Receptor',
			'mensaje' => 'Mensaje',
			'fecha' => 'Fecha',
			'estado' => 'Estado',
		);
	}

	public function enviarMensajeBase($destinatario,$cuerpoMensaje,$titulo,$remitente=null)
	{
		$parametros['cuerpo']=$cuerpoMensaje;
        if($remitente==null)$remitente= Settings::model()->getValorSistema('DATOS_EMPRESA_EMAILADMIN');
        $parametros['empresa']=Settings::model()->getValorSistema('DATOS_EMPRESA_FANTASIA');
        $parametros['direccion']=Settings::model()->getValorSistema('DATOS_EMPRESA_DIRECCION');
        $parametros['telefono']=Settings::model()->getValorSistema('DATOS_EMPRESA_TELEFONO');
        $parametros['horariosAtencion']= Settings::model()->getValorSistema('DATOS_EMPRESA_HORARIOS');
        $parametros['emailAdmin']= Settings::model()->getValorSistema('DATOS_EMPRESA_EMAILADMIN');
        $parametros['site']= Settings::model()->getValorSistema('DATOS_EMPRESA_SITE');
        $parametros['titulo']= $titulo;
        $parametros['fecha']= Date('d-m-Y H:i');
        self::model()->enviarMail ( $destinatario, Settings::model()->getValorSistema('PLANTILLA_BASE',$parametros,'impresiones'), $titulo, $remitente);
	}

	public function enviarMail($_mail,$mensaje,$titulo,$desde,$attachs=null)
	{
    $enviado=true;
    $error="";
    try {
    //Server settings
    $mail = new PHPMailer(true); // create a new object
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = false;
    $mail->SMTPAuth = true;
    $mail->do_debug = 0; // debugging: 1 = errors and messages, 2 = messages only
   
    $mail->SMTPSecure = Settings::model()->getValorSistema('EMAIL_SECURE');//'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = Settings::model()->getValorSistema('EMAIL_HOST');//"smtp.gmail.com";
    $mail->Port = Settings::model()->getValorSistema('EMAIL_PORT')*1; // or 587
    $mail->IsHTML(true);
    $mail->Username = Settings::model()->getValorSistema('EMAIL_USUARIO');//"alejandronovillo1984@gmail.com";
    $mail->Password = Settings::model()->getValorSistema('EMAIL_CLAVE');//"piteroski";
    $mail->SetFrom($desde, 'COMPROBANTE DE PAGO ASOCIACION OFTALMOLOGA');
    $mail->Subject = $titulo;
    $mail->Body = utf8_decode($mensaje);
    $emails=explode(";", $_mail);
    for($i=0;$i<count($emails);$i++)
    	$mail->addAddress($emails[$i], '');     // Add a recipient
   // $mail->addAddress('ellen@example.com');               // Name is optional
   // $mail->addReplyTo('info@example.com', 'Information');
   // $mail->addCC('cc@example.com');
   // $mail->addBCC('bcc@example.com');

    //Attachments
      if($attachs)
			foreach($attachs as $arch)
    		 $mail->AddStringAttachment($arch, 'COMPROBANTE.pdf', 'base64', 'application/pdf'); //$mail->addAttachment($arch);
   // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content

    $enviado=$mail->send();
} catch (Exception $e) {
      $enviado=false;
      echo $e->getMessage();
   $error= $e->getMessage();
}
    $sal['error']=$enviado;
$sal['mensaje']=$error;

           return $sal;
    
	}
	private function ingresa($estado,$mail,$mensaje,$titulo,$desde,$fecha)
	{
		$model=new Mail;
		$model->emisor=$desde;
		$model->receptor=$mail;
		$model->estado=$estado;
		$model->fecha=$fecha;
		$model->mensaje=$mensaje;
		$model->save();
	}
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('emisor',$this->emisor,true);
		$criteria->compare('receptor',$this->receptor,true);
		$criteria->compare('mensaje',$this->mensaje,true);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('estado',$this->estado,true);
		$criteria->order='id desc';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}