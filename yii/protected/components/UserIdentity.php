<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;
	
	public function authenticate()
	{
		//$username=strtolower($this->username);
		$record=Usuario::model()->find('login_usuario=?',array($_GET['login_usuario']));
		if($record===null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if(!$record->validatePassword($_GET['password_usuario']))
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
		{
			$this->_id=$record->id_usuario;
			$this->username=$record->nombre_usuario;
			//$this->setState('title',$record->title);
			$this->errorCode=self::ERROR_NONE;
		}
		return $this->errorCode===self::ERROR_NONE;
	}
	public function getId(){
		return $this->_id;
	}
}