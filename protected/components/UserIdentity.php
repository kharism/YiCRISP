<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    var $user;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		
        $user = User::model()->findByAttributes(array("email"=>$this->username));
        
        if ($user==null)
        $this->errorCode = self::ERROR_USERNAME_INVALID;
        else if($user->password != md5($this->password))
        {$this->errorCode=self::ERROR_PASSWORD_INVALID;}
        else
        {
            $this->errorCode=self::ERROR_NONE;
            $user->password = md5($this->password);
        }
        $this->user = $user;
        return !$this->errorCode;
	}
    public function getId(){
        if($this->user!==null)
            return $this->user->id;
        else
            return null;
    }
    public function getName() {
        if($this->user!==null)
            return $this->user->username;
        else
            return parent::getName();
    }
    public function isAdmin(){
        var_dump($this->user->groups);
        die();
    }
}