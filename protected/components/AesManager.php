<?php
require_once 'AesSystem.php';

class AesManager extends CApplicationComponent { 
     
    public function encrypt($value) {                
        $aes = new AesSystem(Yii::app()->params['aesSystem']['tokenSystem'], Yii::app()->params['aesSystem']['mode'], Yii::app()->params['aesSystem']['iv']);
        return bin2hex($aes->encrypt($value));  
    }
    
    public function decrypt($value) {                
        $aes = new AesSystem(Yii::app()->params['aesSystem']['tokenSystem'], Yii::app()->params['aesSystem']['mode'], Yii::app()->params['aesSystem']['iv']);        
        return $aes->decrypt(hex2bin($value));       
    }
}