<?php

class AdminVersusController extends Controller {

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
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'checkStatus','cuartos'),
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
    
    public function actionCuartos(){
        $arrayBase = Yii::app()->params['dataBases'];

        foreach ($arrayBase as $key => $value) {
            $this->updateCuartos($key,$value['dbname']);
        }
    }
    
    public function updateCuartos($proyect,$base){
        $host = Yii::app()->params['dataBases'][$proyect]['connectionString'] . $base;
        $username = Yii::app()->params['dataBaseConfig']['user'];
        $psw = Yii::app()->params['dataBaseConfig']['pass'];
        Yii::app()->db->setActive(false);
        Yii::app()->db->connectionString = $host;
        Yii::app()->db->username = $username;
        Yii::app()->db->password = $psw;
        Yii::app()->db->setActive(true);
        
        $sql = "REPLACE INTO versus (versus_id, fecha, pais_id_a, pais_id_b, goles_a, goles_b, ganador, canplay) VALUES (49, '2014-06-28 12:00:00', 1, 7, 0, 0, 0, 1);
                REPLACE INTO versus (versus_id, fecha, pais_id_a, pais_id_b, goles_a, goles_b, ganador, canplay) VALUES (50, '2014-06-28 16:00:00', 9, 13, 0, 0, 0, 1);
                REPLACE INTO versus (versus_id, fecha, pais_id_a, pais_id_b, goles_a, goles_b, ganador, canplay) VALUES (51, '2014-06-29 12:00:00', 6, 3, 0, 0, 0, 1);
                REPLACE INTO versus (versus_id, fecha, pais_id_a, pais_id_b, goles_a, goles_b, ganador, canplay) VALUES (52, '2014-06-29 16:00:00', 14, 10, 0, 0, 0, 1);";
        
        Yii::app()->db->createCommand($sql)->query();
    }
    
    public function actionCheckStatus() {
        $this->layout = 'main_admin';
        $usuario = Usuario::model()->findByPk(Yii::app()->user->getId());
        if ($usuario->tipo_usuario_id == 2 || $usuario->tipo_usuario_id == 3) {

            $arrayBase = Yii::app()->params['dataBases'];

            $aryAllVersus = array();
            $aryTmp = array();

            foreach ($arrayBase as $key => $value) {
                $aryAllVersus[$value['dbname']] = $this->checkStatusVersus($key,$value['dbname']);
            }

            //33 proyectos
            //posible for ->64 o 33 veces (?)
            for ($i = 0; $i < 64; $i++) {
                foreach ($aryAllVersus as $proyecto => $aryVersusNew) {
                    $e = 0;
                    foreach ($aryVersusNew as $versus) {

                        if ($e == $i) {
                            $aryTmp[] = array(
                                'versus' => $this->Swit($versus->pais_id_a) . ' vs ' . $this->Swit($versus->pais_id_b),
                                'proyecto' => $proyecto,
                                'fecha' => $versus->fecha,
                                'pais_A' => $this->Swit($versus->pais_id_a),
                                'pais_B' => $this->Swit($versus->pais_id_b),
                                'goles_A' => $versus->goles_a,
                                'goles_B' => $versus->goles_b,
                                'ganador' => $this->Swit($versus->ganador),
                                'canplay' => $versus->canplay,
                            );
                        }
                        $e++;
                    }
                }
            }
            //aramar tabla
            $table = '<table class="items">
                        <thead>
                        <tr>
                            <th>Versus</th>
                            <th>Proyecto</th>
                            <th>Fecha</th>
                            <th>Pais A</th>
                            <th>Pais B</th>
                            <th>Goles A</th>
                            <th>Goles B</th>
                            <th>Ganador</th>
                            <th>Can Play?</th>
                        </tr>
                        </thead>
                        <tbody>';
            foreach ($aryTmp as $item) {

                $table .= '<tr>
                            <td>' . $item['versus'] . '</td>                                
                            <td>' . $item['proyecto'] . '</td> 
                            <td>' . $item['fecha'] . '</td>                                
                            <td>' . $item['pais_A'] . '</td>
                            <td>' . $item['pais_B'] . '</td> 
                            <td>' . $item['goles_A'] . '</td>                                
                            <td>' . $item['goles_B'] . '</td>
                            <td>' . $item['ganador'] . '</td> 
                            <td>' . $item['canplay'] . '</td> 
                        </tr>';
            }

            $table .= '</tbody></table>';
            echo $table;
        } else {
            header('Location: ' . '../../home');
        }
    }

    private function Swit($valor) {
        switch ($valor) {
            case 1:
                $pais = 'Brasil';
                break;
            case 2:
                $pais = 'Croacia';
                break;
            case 3:
                $pais = 'México';
                break;
            case 4:
                $pais = 'Camerún';
                break;
            case 5:
                $pais = 'España';
                break;
            case 6:
                $pais = 'Holanda';
                break;
            case 7:
                $pais = 'Chile';
                break;
            case 8:
                $pais = 'Australia';
                break;
            case 9:
                $pais = 'Colombia';
                break;
            case 10:
                $pais = 'Grecia';
                break;
            case 11:
                $pais = 'Costa de Marfil';
                break;
            case 12:
                $pais = 'Japón';
                break;
            case 13:
                $pais = 'Uruguay';
                break;
            case 14:
                $pais = 'Costa Rica';
                break;
            case 15:
                $pais = 'Inglaterra';
                break;
            case 16:
                $pais = 'Italia';
                break;
            case 17:
                $pais = 'Suiza';
                break;
            case 18:
                $pais = 'Ecuador';
                break;
            case 19:
                $pais = 'Francia';
                break;
            case 20:
                $pais = 'Honduras';
                break;
            case 21:
                $pais = 'Argentina';
                break;
            case 22:
                $pais = 'Bosnia Herzegovina';
                break;
            case 23:
                $pais = 'Irán';
                break;
            case 24:
                $pais = 'Nigeria';
                break;
            case 25:
                $pais = 'Alemania';
                break;
            case 26:
                $pais = 'Portugal';
                break;
            case 27:
                $pais = 'Ghana';
                break;
            case 28:
                $pais = 'Estados Unidos';
                break;
            case 29:
                $pais = 'Bélgica';
                break;
            case 30:
                $pais = 'Argelia';
                break;
            case 31:
                $pais = 'Rusia';
                break;
            case 32:
                $pais = 'Corea del Sur';
                break;

            default:
                $pais = ' ';
                break;
        }

        return $pais;
    }

    private function checkStatusVersus($proyect,$base) {
                
        $host = Yii::app()->params['dataBases'][$proyect]['connectionString'] . $base;
        $username = Yii::app()->params['dataBaseConfig']['user'];
        $psw = Yii::app()->params['dataBaseConfig']['pass'];
        Yii::app()->db->setActive(false);
        Yii::app()->db->connectionString = $host;
        Yii::app()->db->username = $username;
        Yii::app()->db->password = $psw;
        Yii::app()->db->setActive(true);

        $criteria = new CDbCriteria();
        $criteria->order = 'versus_id ASC';
        $aryVersus = Versus::model()->findAll($criteria);

//        $aryVersusOut = array();
//        $aryVersusTmp = array();
//        foreach ($aryVersus as $versus){
//            $aryVersusTmp[] = array(
//                'fecha'=>$versus->fecha,
//                'pais_A'=>$versus->pais_a->nombre,
//                'pais_B'=>$versus->pais_b->nombre,
//                'goles_A'=>$versus->goles_a,
//                'goles_B'=>$versus->goles_b,
//                'ganador'=>$versus->ganador,
//                'pais_B'=>$versus->pais_b->nombre,
//            );
//            
//        }
        return $aryVersus;
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $this->layout = 'main_admin';
        $usuario = Usuario::model()->findByPk(Yii::app()->user->getId());
        if ($usuario->tipo_usuario_id == 2 || $usuario->tipo_usuario_id == 3) {
            $model = $this->loadModel($id);
            if (isset($_POST['Versus'])) {

                $model->attributes = $_POST['Versus'];

                if ($model->save()) {
                    $arrayBase = Yii::app()->params['dataBases'];
                    unset($arrayBase['rayalab']);
                    foreach ($arrayBase as $key => $value) {
                        $this->updateVersus($model, $key, $value['dbname']);
                    }
                }
                
                $this->setSystemUpdateTime();
                $this->redirect(array('/adminUsuario/totalPuntos'));
            }

            $this->render('update', array(
                'model' => $model,
            ));
        } else {
            header('Location: ' . '../../home');
        }
    }
    
    private function setSystemUpdateTime(){
        $options = [ 'gs' => [ 'Content-Type' => 'application/javascript', 'acl' => 'public-read', 'read_cache_expiry_seconds'=>300]];
        $ctx = stream_context_create($options);
        
        $ranking = 'systemUpdateTime';
                 
        if($_SERVER['HTTP_HOST'] == '192.168.1.49'){
            //Local
            $basePath = 'C:/AppServ/www/yii/project/mundialero_v4_dev/json/'.$ranking.'_tmp.js';
            $basePathFinal = 'C:/AppServ/www/yii/project/mundialero_v4_dev/json/'.$ranking.'.js';
                        
        }else{
            //Google
            $basePath = Yii::app()->params['baseUrlGs'].'/json/'.$ranking.'_tmp.js';            
            $basePathFinal = Yii::app()->params['baseUrlGs'].'/json/'.$ranking.'.js';            
        }
        
        $fecha = new DateTime('NOW');
        
        file_put_contents($basePath, $fecha->format('YmdHis'));

        rename($basePath, $basePathFinal, $ctx);
    }

    public function updateVersus($model, $proyect, $base) {

        $host = Yii::app()->params['dataBases'][$proyect]['connectionString'] . $base;
        $username = Yii::app()->params['dataBaseConfig']['user'];
        $psw = Yii::app()->params['dataBaseConfig']['pass'];
        Yii::app()->db->setActive(false);
        Yii::app()->db->connectionString = $host;
        Yii::app()->db->username = $username;
        Yii::app()->db->password = $psw;
        Yii::app()->db->setActive(true);

        $criteria = new CDbCriteria();
        $criteria->compare('versus_id', $model->versus_id);
        $versus = Versus::model()->find($criteria);
        $versus->goles_a = $model->goles_a;
        $versus->goles_b = $model->goles_b;
        $versus->ganador = $model->ganador;
        $versus->canplay = $model->canplay;
        $versus->update();
    }

    /**
     * Manages all models.
     */
    public function actionAdmin($pais_id_a = null, $pais_id_b = null) {
        $this->layout = 'main_admin';
        $usuario = Usuario::model()->findByPk(Yii::app()->user->getId());
        if ($usuario->tipo_usuario_id == 2 || $usuario->tipo_usuario_id == 3) {
            $model = new Versus('search');
            $model->unsetAttributes();  // clear any default values
            $model->setAttribute('pais_id_a', $pais_id_a);
            $model->setAttribute('pais_id_b', $pais_id_b);

            if (isset($_GET['Versus']))
                $model->attributes = $_GET['Versus'];

            $this->render('admin', array(
                'model' => $model,
            ));
        }else {
            header('Location: ' . '../home');
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Versus the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Versus::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Versus $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'versus-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
