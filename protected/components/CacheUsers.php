<?php
class CacheUsers extends CApplicationComponent {
    public function now(){
        Yii::app()->useDatabase->now();
        
        $options = [ 'gs' => [ 'Content-Type' => 'application/javascript', 'acl' => 'public-read', 'read_cache_expiry_seconds'=>300]];
        $ctx = stream_context_create($options);
        
        $project = Yii::app()->session['project'];
        $ranking = 'checkL';
        
        $sql = 'SELECT user as u, last_login_time as l FROM usuario WHERE tipo_estado_usuario_id = 1;';        
                
        if($_SERVER['HTTP_HOST'] == '192.168.1.49'){
            //Local
            $basePath = 'C:/AppServ/www/yii/project/mundialero_v4_dev/json/'.$project.'/'.$ranking.'_tmp.js';
            $basePathFinal = 'C:/AppServ/www/yii/project/mundialero_v4_dev/json/'.$project.'/'.$ranking.'.js';
                        
        }else{
            //Google
            $basePath = Yii::app()->params['baseUrlGs'].'/json/'.$project.'/'.$ranking.'_tmp.js';            
            $basePathFinal = Yii::app()->params['baseUrlGs'].'/json/'.$project.'/'.$ranking.'.js';            
        }
        
        file_put_contents($basePath, CJSON::encode(Yii::app()->db->createCommand($sql)->queryAll()));

        rename($basePath, $basePathFinal, $ctx);
    }
}