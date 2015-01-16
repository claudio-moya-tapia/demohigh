<?php

class NoticiaController extends Controller {

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
                'actions' => array('index', 'view', 'destacados', 'indexMobile'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /* @var $articulo Articulo */

    public function actionDestacados() {               
        header('Content-type: text/json');
        header('Content-type: application/json');
        echo CJSON::encode($this->getDestacados());
    }
    
    private function getDestacados(){
        $memcache = new Memcache;
        $memcache->addserver('localhost');
        $cacheKey = Yii::app()->session['project'];
        $keyNoticiaDestacados = $cacheKey.'.noticia.destacados';
        
        $aryDestacado = $memcache->get($keyNoticiaDestacados);
        if ($aryDestacado === false) {
            Yii::app()->useDatabase->now();
            $criteria = new CDbCriteria();
            $criteria->select = 'articulo_id,titulo,imagen';
            $criteria->compare('tipo_destacado_id', '1');
            $criteria->compare('estado_articulo_id', '1');
            $criteria->order = 'articulo_id DESC';
            $listArticulo = Articulo::model()->findAll($criteria);

            foreach ($listArticulo as $articulo) {
                $url = Yii::app()->params['baseUrl'] . '/noticia/' . $articulo->articulo_id . '?' . $articulo->titulo;
                $img = Yii::app()->params['baseUrlImg'] . $articulo->imagen;
                $titulo = $articulo->titulo;

                $aryDestacado[] = array(
                    'content' => "<div class='slide_inner'><a class='photo_link' href='" . $url . "'><img class='photo' src='" . $img . "' alt='destacado'></a><a class='caption' href='" . $url . "'>" . $titulo . "</a></div>",
                    'content_button' => "<div class='thumb'><a href='" . $url . "'><img src='" . $img . "' alt='destacado'></a></div><p><a href='" . $url . "'>" . $titulo . "</a></p>"
                );
            }
            $memcache->set($keyNoticiaDestacados, $aryDestacado, false, 600);
        }
        
        return $aryDestacado;
    }

    public function actionIndex() {
        Yii::app()->useDatabase->now();
        $criteria = new CDbCriteria();
        $criteria->order = 'articulo_id DESC';
        $criteria->compare('estado_articulo_id', '1');
        $listArticulo = Articulo::model()->findAll($criteria);

        $this->render('index', array(
            'listArticulo' => $listArticulo
        ));
    }

    public function actionView($id) {
        Yii::app()->useDatabase->now();
        $criteria = new CDbCriteria;
        $criteria->compare('articulo_id', $id);
        $listLike = Like::model()->findAll($criteria);

        $articulo = Articulo::model()->findByPk($id);
        
        if (isset($_POST['Comentario'])) {
            $comentarios = new Comentario();
            $fechaCreacion = new DateTime('NOW');
            $comentarios->usuario_id = Yii::app()->user->id;
            $comentarios->texto = $_POST['Comentario']['texto'];
            $comentarios->fecha_creacion = $fechaCreacion->format('Y-m-d H:i:s');
            $comentarios->articulo_id = $id;
            $comentarios->insert();
        }
        
        $criteria = new CDbCriteria;
        $criteria->compare('articulo_id', $id);
        $criteria->order = 'comentario_id DESC';
        $listComentarios = Comentario::model()->findAll($criteria);
        
        $comentario = new Comentario();
                
        $this->render('view', array(
            'listLike' => $listLike,
            'articulo' => $articulo,
            'comentario' => $comentario,
            'listComentarios' => $listComentarios
        ));
    }

}
