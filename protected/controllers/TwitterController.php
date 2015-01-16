<?php

class TwitterController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('@'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('ajaxCreate', 'ajaxList'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /* @var $twitter Twitter */
    public function actionAjaxCreate($texto = null) {

        $this->layout = null;
        
        if (!Yii::app()->user->isGuest) {
            
            $newTexto = strip_tags($texto);
                        
            if(strlen($newTexto) > 0){
                
                $aryChuchadas = array(
                    'pico'=>'#%&$!',
                    'poto'=>'#%&$!',
                    'chucha'=>'#%&$!',
                    'xuxa'=>'#%&$!',
                    'ctm'=>'#%&$!',
                    'weon'=>'#%&$!',
                    'tula'=>'#%&$!',
                    'pene'=>'#%&$!',
                    'zorra'=>'#%&$!',
                    'sacoweas'=>'#%&$!',
                    'caca'=>'#%&$!',
                    'pichi'=>'#%&$!',
                    'puta'=>'#%&$!',
                    'uta'=>'#%&$!',
                    'wea'=>'#%&$!',
                    'cago'=>'#%&$!',
                    'wn'=>'#%&$!',
                    'won'=>'#%&$!',
                    'culiao'=>'#%&$!',
                    'culiado'=>'#%&$!',
                    'huevon'=>'#%&$!',
                    'qliao'=>'#%&$!',
                    'mierda'=>'#%&$!',
                );
                
                $newTextoClean = strtr($newTexto, $aryChuchadas);
                
                if( strpos($newTextoClean, '#%&$!') !== false){
                    
                    if(Yii::app()->session['project'] == 'bbva'){
                        $addTweet = false;
                    }else{
                        $addTweet = true;
                    }
                    
                }else{
                    $addTweet = true;
                }
                
                if($addTweet){
                    $fechaCreacion = new DateTime('NOW');
                    Yii::app()->useDatabase->now();
                    $twitter = new Twitter();
                    $twitter->fecha_creacion = $fechaCreacion->format('Y-m-d H:i:s');
                    $twitter->usuario_id = Yii::app()->user->id;
                    $twitter->texto = $newTextoClean;            
                    $twitter->save();

                    //Insert into historico & Delete old tweets
                    $maxTweets = 20;

                    $sql = 'INSERT IGNORE INTO twitter_historico (twitter_id, fecha_creacion, usuario_id, texto) 
                            SELECT twitter_id, fecha_creacion, usuario_id, texto
                            FROM
                                twitter
                            WHERE
                                twitter_id < (
                                    SELECT MIN(a.twitter_id) as minimo
                                    FROM (
                                            SELECT twitter_id
                                            FROM twitter
                                            ORDER BY twitter_id DESC
                                            LIMIT 0 , '.$maxTweets.'
                                        ) as a
                                    );
                            DELETE 
                            FROM
                                twitter
                            WHERE
                                twitter_id < (
                                    SELECT MIN(a.twitter_id) as minimo
                                    FROM (
                                            SELECT 
                                                twitter_id
                                            FROM
                                                twitter
                                            ORDER BY twitter_id DESC
                                            LIMIT 0 , '.$maxTweets.'
                                        ) as a
                                    );';

                    Yii::app()->db->createCommand($sql)->query();
                }
                
                $status = 'ok';
                
            }else{
                $status = 'error';
            }
                        
            header('Content-type: text/json');
            header('Content-type: application/json');
            echo CJSON::encode(array('status'=>$status));
        }
    }

    public function actionAjaxList() {

        $this->layout = null;
        
        if (!Yii::app()->user->isGuest) {
            $this->getTweets();
        }
    }

    private function getTweets(){
        Yii::app()->useDatabase->now();
        $criteria = new CDbCriteria();            
        $criteria->order = 'twitter_id ASC';
        $listTwitter = Twitter::model()->findAll($criteria);

        $aryTwitter = array();
        foreach($listTwitter as $twitter){
            $aryTwitter[] = array(
                'twitter_id'=>$twitter->twitter_id,
                'fecha'=>$twitter->fecha_creacion,
                'usuario'=>'@'.$twitter->usuario->nickname,
                'texto'=>$twitter->texto
            );
        }

        header('Content-type: text/json');
        header('Content-type: application/json');
        echo CJSON::encode($aryTwitter);  
    }
}
