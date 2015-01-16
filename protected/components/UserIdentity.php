<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    private $_id = NULL;

    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    public function authenticate() {
        $criteria = new CDbCriteria;
        $criteria->condition = 'user = :user';
        $criteria->params = array(':user' => $this->username);

        $user = Usuario::model()->find($criteria);
                        
        if (!isset($this->username) || NUll === $user || !isset($this->password)) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } else if ($this->password !== $user->pass) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else {
            $this->errorCode = self::ERROR_NONE;
            $this->_id = $user->usuario_id;
            $lastLoginTime = date('Y-m-d H:i:s');
            $this->setState('lastLoginTime', $lastLoginTime);            
            $user->last_login_time = $lastLoginTime;
            $user->saveAttributes(array('last_login_time'));            
        }

        return !$this->errorCode;
    }

    public function getId() {
        return $this->_id;
    }
}