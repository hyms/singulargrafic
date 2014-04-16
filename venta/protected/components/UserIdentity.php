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
	private $_tipo;
	public function authenticate(){
		$username=strtolower($this->username);
		$user=Users::model()->find('LOWER(username)=?',array($username),'estado=0');
		
		if($user===null)
		{$this->errorCode=self::ERROR_USERNAME_INVALID; }
		else if(!$user->validatePassword($this->password))
		{$this->errorCode=self::ERROR_PASSWORD_INVALID;}
		else{
			$this->_id=$user->id;
			$this->username=$user->username;
			
			$this->errorCode=self::ERROR_NONE;
			
			/*Consultamos los datos del usuario por el username ($user->username) */
			$info_usuario = Users::model()->findByPk($user->id);
			//Yii::app()->user->setState('user_type',$user->tipo);
			$this->setState('name', $user->username);
			$this->setState('role',$user->tipo);
			
			//$info_usuario->fechaLogin=date("Y-m-d H:i:s");
			$sql = "update users set fechaLogin = now() where id='$user->id'";
			$connection = Yii::app() -> db;
			$command = $connection -> createCommand($sql);
			$command -> execute();
			
	
		}
		return $this->errorCode==self::ERROR_NONE;
	}
	
	public function getId(){
		return $this->_id;
	}
	
	public function getTipo(){
		return $this->_tipo;
	}
	/*public function authenticate()
	{
		$users=array(
			// username => password
			'demo'=>'demo',
			'admin'=>'admin',
		);
		if(!isset($users[$this->username]))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif($users[$this->username]!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
		return !$this->errorCode;
	}*/
}