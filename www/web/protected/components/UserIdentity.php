<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	private $_id;
	public function authenticate()
	{
		$datosUsuario = Usuarios::model()->validarUsuario($this->username, $this->password);
		
		$usuarioValido = (!is_null($datosUsuario))?  true : false;

		if (!$usuarioValido)  $this->errorCode=self::ERROR_PASSWORD_INVALID;
			else { 
			$this->errorCode=self::ERROR_NONE; 
			$this->setState('usuario', $datosUsuario->apellido.' ,'.$datosUsuario->nombre);
			$this->_id= $datosUsuario->id;
			$this->setState('nombre', $datosUsuario->nombre);
			$this->setState('idUsuario', $datosUsuario->id);   //guarda el id usuario
			      }
   
			return !$this->errorCode; 
	}
	public function getId()
        {
                return $this->_id;
        }
}