<?php

class UseDatabase extends CApplicationComponent {

    public function now() {
        $dbname = Yii::app()->params['dataBases'][Yii::app()->session['project']]['dbname'];
        $host = Yii::app()->params['dataBases'][Yii::app()->session['project']]['connectionString'] . $dbname;
        $username = Yii::app()->params['dataBaseConfig']['user'];
        $psw = Yii::app()->params['dataBaseConfig']['pass'];

        Yii::app()->setComponent('db', Yii::createComponent(array(
            'class' => 'CDbConnection',
            'connectionString' => $host,
            'emulatePrepare' => true,
            'username' => $username,
            'password' => $psw,
            'charset' => 'utf8',
            'enableProfiling' => true,
            'enableParamLogging' => true
        )));
    }

}
