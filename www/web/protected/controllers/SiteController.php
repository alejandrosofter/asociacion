<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	public function actionClave()
	{
		if(isset($_POST['mail'])){
			
		}
		$this->render('clave',array());
	}
	public function actionIndex()
	{
		
		$this->render('index',array());
	}
	public function actionSocios()
	{
		
		$this->render('socios',array());
	}
	public function actionAutoridades()
	{
		
		$this->render('autoridades',array());
	}
	public function actionObrasSociales()
	{
		
		$this->render('obrasSociales',array());
	}
	public function actionDondeEstamos()
	{
		$this->render('dondeEstamos');
	}
	public function actionContacto()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		Yii::import('ext.EUserFlash');
		if(isset($_POST['message']))
		if($this->emailValido($_POST['email'])&&$this->valido($_POST['message'])&&$this->valido($_POST['name'])&&$this->valido($_POST['subject'])){
			$mensajeCliente="Gracias por utilizar nuestra WEB, en la brevedad nos contactaremos con ud. <br> Nombre:".$_POST['name'].'<br> Asunto:'.$_POST['subject']."<br> Mensaje:".$_POST['message']."<br> Email:".$_POST['email'];
			$mensajeEmpresa="Han realizado un comentario en la WEB: <br> Nombre:".$_POST['name'].'<br> Asunto:'.$_POST['subject']."<br> Mensaje:".$_POST['message']."<br> Email:".$_POST['email'];
			Emails::model()->enviarMensajeBase( Settings::model()->getValorSistema('DATOS_EMPRESA_EMAILADMIN'),'Contacto Web',$mensajeEmpresa,$_POST['email']);
			Emails::model()->enviarMensajeBase($_POST['email'],'Contacto Web Insercon',$mensajeCliente);
			$this->redirect('index.php?r=site/contacto');
		}else{
			if(isset($_POST['message']))EUserFlash::setErrorMessage('Hay datos incompletos en el formulario, por favor completelos e intente nuevamente.');
		}
		
		 $this->render('contacto');
	}
	private function valido($dato)
	{
		if($dato=='')
            return false;
         return true;
	}
	private function emailValido($mail)
	{
		$validator = new CEmailValidator;
                if($validator->validateValue($mail))
                     return true;
         return false;
	}

	public function actionLinks()
	{
		$this->render('links');
	}
	public function actionAcerca()
	{
		$this->render('quienesSomos');
	}
	public function actionHistoria()
	{
		$this->render('historia');
	}
	public function actionAdministrador()
	{
		$this->layout="//layouts/column2admin";
		$this->render('administrador');
	}


	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}
	

	public function actionLoginAdmin()
	{
		$model=new LoginForm;
		
		 $model->username=isset($_POST['usuario'])?$_POST['usuario']:'';
		 $model->password=isset($_POST['clave'])?$_POST['clave']:'';
		 
				if(isset($_POST['LoginForm']))
				{
					$model->attributes=$_POST['LoginForm'];
					// validate user input and redirect to the previous page if valid
					if($model->username=='andy' && $model->password=='andy8399')
						$this->redirect('index.php?r=site/administrador');
				}
				// display the login form
				$this->render('loginAdmin',array('model'=>$model));
			
	}
	public function actionLogin()
	{
		$model=new LoginForm;
		if(isset($_POST['ajax'])){
		
		 $model->username=isset($_POST['usuario'])?$_POST['usuario']:'';
		 $model->password=isset($_POST['clave'])?$_POST['clave']:'';
		 if($model->validate() && $model->login())
				echo 1;
			else echo 0;
			}else{
				if(isset($_POST['LoginForm']))
				{
					$model->attributes=$_POST['LoginForm'];
					// validate user input and redirect to the previous page if valid
					if($model->validate() && $model->login())
						$this->redirect('index.php?r=usuarios/miInicio');
				}
				// display the login form
				$this->render('login2',array('model'=>$model));
			}
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}