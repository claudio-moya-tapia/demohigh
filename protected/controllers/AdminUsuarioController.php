<?php

class AdminUsuarioController extends Controller {

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
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'buscarPuntos', 'cargaUsuario', 'usuarioImage',
                    'fixPrediccion', 'menuPrediccion',
                    'fix', 'updateTotalPuntosPorProyecto', 'ajaxPartidoPuntos', 'menuPuntos', 'menuBackup',
                    'updateTotalPuntosPorProyecto', 'updateTotalPuntos', 'backupTotalPuntos',
                    'totalPuntos', 'ajaxTotalPuntos','AjaxPuntosOctavos'
                ),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('*'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionMenuPrediccion() {
        $arrayBase = Yii::app()->params['dataBases'];
        unset($arrayBase['rayalab']);
        foreach ($arrayBase as $key => $value) {
            $url = 'adminUsuario/fixPrediccion?project=' . $key . '&base=' . $value['dbname'];
            echo '<br>' . CHtml::link($key, array($url)) . ' - ' . $url;
        }
    }

    public function actionFixPrediccion($project = null, $base = null) {
        $host = Yii::app()->params['dataBases'][$project]['connectionString'] . $base;
        $username = Yii::app()->params['dataBaseConfig']['user'];
        $psw = Yii::app()->params['dataBaseConfig']['pass'];
        Yii::app()->db->setActive(false);
        Yii::app()->db->connectionString = $host;
        Yii::app()->db->username = $username;
        Yii::app()->db->password = $psw;
        Yii::app()->db->setActive(true);

        $aryVersus = array();
        for ($i = 1; $i <= 48; $i++) {
            $aryVersus[] = $i;
        }

        $criteria = new CDbCriteria();
        $criteria->order = 'usuario_id ASC, versus_id ASC, fecha_actualizacion ASC, prediccion_id ASC';
        $listPrediccion = Prediccion::model()->findAll($criteria);

        $aryPrediccion = array();
        $aryPrediccionCount = array();
        $i = 1;
        foreach ($listPrediccion as $prediccion) {
            //echo '<br> '.$i.' - '.$prediccion->prediccion_id;
            $aryPrediccion[$prediccion->usuario_id][$prediccion->versus_id] += 1;
            $i++;
        }

        foreach ($aryPrediccion as $usuario_id => $aryUsuarioVersus) {

            foreach ($aryUsuarioVersus as $versus_id => $count) {
                if ($count > 1) {
                    $aryPrediccionCount[$usuario_id][$versus_id] = $count;
                }
            }
        }

        foreach ($aryPrediccionCount as $usuario_id => $aryUsuarioVersus) {

            foreach ($aryUsuarioVersus as $versus_id => $count) {

                $i = 1;
                foreach ($listPrediccion as $prediccion) {
                    if ($prediccion->usuario_id == $usuario_id) {
                        if ($prediccion->versus_id == $versus_id) {

                            if ($i < $count) {
                                $aryPrediccionId[] = $prediccion->prediccion_id;
                                $i++;
                            }
                        }
                    }
                }
            }
        }

        if (count($aryPrediccionId) > 0) {
            //$sql = 'DELETE FROM '.$base.'.prediccion WHERE prediccion_id IN ('.  implode(',',$aryPrediccionId).');';
            //Yii::app()->db->createCommand($sql)->query();
            //echo '-- Predicciones corregidas: '.count($aryPrediccionId).'<br>'.$sql.'<br>';
        }
    }

    public function actionTotalPuntos() {
        $usuario = Usuario::model()->findByPk(Yii::app()->user->getId());
        if ($usuario->tipo_usuario_id == 3) {
            $this->layout = 'main_admin';
            $this->render('total_puntos');
        }
    }
    public function actionAjaxPuntosOctavos() {
        $criteria = new CDbCriteria();
        $criteria->order = 'total_puntos desc';
        $aryUsuario = Usuario::model()->findAll($criteria);
           $table = '<table>
                        <thead>
                        <tr>
                            <th>Usuario Id</th> 
                            <th>Rut</th>   
                            <th>Email</th> 
                            <th>Nombre</th>
                            <th>Empresa</th>
                            <th>Area</th>
                            <th>Puntos Totales</th>
                            <th>Puntos Plenos</th>
                        </tr>
                        </thead>
                        <tbody>';
        foreach ($aryUsuario as $usr) {
          
            $aryEmpresa = Empresa::model()->findByPk($usr->empresa_id);
            $aryArea = Area::model()->findByPk($usr->area_id);
            $table .= '<tr>
                            <td>' . $usr->usuario_id . '</td> 
                            <td>' . Yii::app()->aesManager->decrypt($usr->rut) . '</td>    
                            <td>' . Yii::app()->aesManager->decrypt($usr->email) . '</td> 
                            <td>' . Yii::app()->aesManager->decrypt($usr->nombre) . ' ' . Yii::app()->aesManager->decrypt($usr->apellido_paterno) . ' ' . Yii::app()->aesManager->decrypt($usr->apellido_materno) . '</td>                                
                            <td>' . $aryEmpresa->nombre . '</td>
                            <td>' . $aryArea->nombre . '</td> 
                            <td>' . $usr->total_puntos . '</td> 
                            <td>' . $usr->total_plenos . '</td> 
                        </tr>';
        }
        $table .= '</table>';

        $filename = "MundialeroInforme_PartidosPuntosOctavos.xls";
        header('Content-Encoding: UTF-8');
        header('Content-type: text/csv; charset=UTF-8');
        header("Content-Disposition: attachment; filename=$filename");
        header("Pragma: public");
        header("Expires: 0");
        echo "\xEF\xBB\xBF"; // UTF-8 BOM
        echo $table;
        
    }
    public function actionAjaxPartidoPuntos($fecha) {

        $aryUsuario = array();
        $aryUsuarioPlenos = array();

        $criteria = new CDbCriteria();
        $criteria->addSearchCondition('fecha', $fecha);
        $aryVersus = Versus::model()->findAll($criteria);

        foreach ($aryVersus as $versus) {

            $criteria = new CDbCriteria();
            $criteria->select = 'usuario_id, versus_id, goles_a, goles_b';
            $criteria->compare('versus_id', $versus->versus_id);
            $aryPrediccion = Prediccion::model()->findAll($criteria);

            foreach ($aryPrediccion as $prediccion) {

                $calculoPuntos = $this->calcularTotalPuntos($versus, $prediccion);
                $aryUsuario[$prediccion->usuario_id] += $calculoPuntos->puntosTotal;
                $aryUsuarioPlenos[$prediccion->usuario_id] += $calculoPuntos->puntosPlenos;
            }
        }

        $table = '<table>
                        <thead>
                        <tr>
                            <th>Rut</th>   
                            <th>Email</th> 
                            <th>Nombre</th>
                            <th>Empresa</th>
                            <th>Area</th>
                            <th>Puntos Totales</th>
                        </tr>
                        </thead>
                        <tbody>';

        foreach ($aryUsuario as $usr => $item) {
            $Usrs = Usuario::model()->findByPk($usr);
            $aryEmpresa = Empresa::model()->findByPk($Usrs->empresa_id);
            $aryArea = Area::model()->findByPk($Usrs->area_id);
            $table .= '<tr>
                            <td>' . Yii::app()->aesManager->decrypt($Usrs->rut) . '</td>    
                            <td>' . Yii::app()->aesManager->decrypt($Usrs->email) . '</td> 
                            <td>' . Yii::app()->aesManager->decrypt($Usrs->nombre) . ' ' . Yii::app()->aesManager->decrypt($Usrs->apellido_paterno) . ' ' . Yii::app()->aesManager->decrypt($Usrs->apellido_materno) . '</td>                                
                            <td>' . $aryEmpresa->nombre . '</td>
                            <td>' . $aryArea->nombre . '</td> 
                            <td>' . $item . '</td> 
                        </tr>';
        }
        $table .= '</table>';

        $filename = "MundialeroInforme_PartidosDelDiaPuntajeTotal.xls";
        header('Content-Encoding: UTF-8');
        header('Content-type: text/csv; charset=UTF-8');
        header("Content-Disposition: attachment; filename=$filename");
        header("Pragma: public");
        header("Expires: 0");
        echo "\xEF\xBB\xBF"; // UTF-8 BOM
        echo $table;
    }

    private function ajaxTotalPuntosOctavos($project = null, $base = null) {
        $host = Yii::app()->params['dataBases'][$project]['connectionString'] . $base;
        $username = Yii::app()->params['dataBaseConfig']['user'];
        $psw = Yii::app()->params['dataBaseConfig']['pass'];
        Yii::app()->db->setActive(false);
        Yii::app()->db->connectionString = $host;
        Yii::app()->db->username = $username;
        Yii::app()->db->password = $psw;
        Yii::app()->db->setActive(true);

        $aryUsuario = array();
        $aryUsuarioPlenos = array();
        $totalPuntos = 0;

        $criteria = new CDbCriteria();
        $criteria->compare('canplay', '0');
        $criteria->compare('versus_id >', '48');
        $aryVersus = Versus::model()->findAll($criteria);

        $canUpdate = false;

        if ($project == 'bancochile') {
            $puntos = 10;
        } else {
            $puntos = 0;
        }

        foreach ($aryVersus as $versus) {

            $criteria = new CDbCriteria();
            $criteria->select = 'usuario_id, versus_id, goles_a, goles_b';
            $criteria->compare('versus_id', $versus->versus_id);
            $aryPrediccion = Prediccion::model()->findAll($criteria);

            foreach ($aryPrediccion as $prediccion) {
                $canUpdate = true;

                $calculoPuntos = $this->calcularTotalPuntos($versus, $prediccion);
                $aryUsuario[$prediccion->usuario_id] += $calculoPuntos->puntosTotal;
                $aryUsuarioPlenos[$prediccion->usuario_id] += $calculoPuntos->puntosPlenos;
            }
        }

        if ($canUpdate) {

            //Update total puntos
            $aryUsuarioId = array();
            $sql = 'UPDATE ' . $base . '.usuario 
                    SET total_puntos_octavos = CASE usuario_id ';

            foreach ($aryUsuario as $usuario_id => $totalPuntos) {
                $aryUsuarioId[] = $usuario_id;
                $sql .= ' WHEN ' . $usuario_id . ' THEN ' . ($totalPuntos + $puntos);
            }

            $sql .= ' END ';
            $sql .= ' WHERE usuario_id IN ( ' . implode(',', $aryUsuarioId) . ' );';
            Yii::app()->db->createCommand($sql)->query();

            //Update total plenos
            $aryUsuarioId = array();
            $sql = 'UPDATE ' . $base . '.usuario 
                    SET total_plenos_octavos = CASE usuario_id ';

            foreach ($aryUsuarioPlenos as $usuario_id => $totalPlenos) {
                $aryUsuarioId[] = $usuario_id;
                $sql .= ' WHEN ' . $usuario_id . ' THEN ' . $totalPlenos;
            }

            $sql .= ' END ';
            $sql .= ' WHERE usuario_id IN ( ' . implode(',', $aryUsuarioId) . ' );';
            Yii::app()->db->createCommand($sql)->query();

            $status = 'Actualizado';
        } else {
            $status = 'No ejecutado';
        }
    }
    
    private function ajaxTotalPuntosBancochile($project = null, $base = null) {
        $host = Yii::app()->params['dataBases'][$project]['connectionString'] . $base;
        $username = Yii::app()->params['dataBaseConfig']['user'];
        $psw = Yii::app()->params['dataBaseConfig']['pass'];
        Yii::app()->db->setActive(false);
        Yii::app()->db->connectionString = $host;
        Yii::app()->db->username = $username;
        Yii::app()->db->password = $psw;
        Yii::app()->db->setActive(true);

        $aryUsuario = array();
        $aryUsuarioPlenos = array();
        $totalPuntos = 0;

        $criteria = new CDbCriteria();
        $criteria->compare('canplay', '0');
        $criteria->compare('versus_id >', '48');
        $aryVersus = Versus::model()->findAll($criteria);

        $canUpdate = false;

        if ($project == 'bancochile') {
            $puntos = 10;
        } else {
            $puntos = 0;
        }

        foreach ($aryVersus as $versus) {
            
            $criteria = new CDbCriteria();
            $criteria->select = 'usuario_id, versus_id, goles_a, goles_b';
            $criteria->compare('versus_id', $versus->versus_id);
            $aryPrediccion = Prediccion::model()->findAll($criteria);

            foreach ($aryPrediccion as $prediccion) {
                $canUpdate = true;

                $calculoPuntos = $this->calcularTotalPuntos($versus, $prediccion);
                                
                $aryUsuario[$prediccion->usuario_id] += $calculoPuntos->puntosTotal;
                $aryUsuarioPlenos[$prediccion->usuario_id] += $calculoPuntos->puntosPlenos;
            }
        }

        if ($canUpdate) {

            //Update total puntos
            $aryUsuarioId = array();
            $sql = 'UPDATE ' . $base . '.usuario 
                    SET total_puntos = CASE usuario_id ';

            foreach ($aryUsuario as $usuario_id => $totalPuntos) {
                $aryUsuarioId[] = $usuario_id;
                
                if ($project == 'raya') {
                    
//                    10 puntos a Matias Casanova
//                    9 puntos a Olatz
//                    8 puntos a Sebastian Vildosola
//                    7 puntos a Maria Jose Palacios
//                    6 puntos a Diego Lopez
//                    5 puntos a cristobal jorquera
//                    5 puntos a Javiera Heider
//                    3 puntos a Alejandro Silberstein
//                    2 puntos a Rodrigo Soto
//                    1 puntos a Pascal Verhaselt
                    
                    switch ($usuario_id) {
                        case 8:
                            $puntos = 10;
                            break;
                        case 32:
                            $puntos = 9;
                            break;
                        case 20:
                            $puntos = 8;
                            break;
                        case 7:
                            $puntos = 7;
                            break;
                        case 24:
                            $puntos = 6;
                            break;
                        case 57:
                            $puntos = 5;
                            break;
                        case 44:
                            $puntos = 5;
                            break;
                        case 42:
                            $puntos = 3;
                            break;
                        case 43:
                            $puntos = 2;
                            break;
                        case 52:
                            $puntos = 1;
                            break;
                        default:
                            $puntos = 0;
                            break;
                    }
                }
                                
                $sql .= ' WHEN ' . $usuario_id . ' THEN ' . ($totalPuntos + $puntos);
            }

            $sql .= ' END ';
            $sql .= ' WHERE usuario_id IN ( ' . implode(',', $aryUsuarioId) . ' );';
            Yii::app()->db->createCommand($sql)->query();

            //Update total plenos
            $aryUsuarioId = array();
            $sql = 'UPDATE ' . $base . '.usuario 
                    SET total_plenos = CASE usuario_id ';

            foreach ($aryUsuarioPlenos as $usuario_id => $totalPlenos) {
                $aryUsuarioId[] = $usuario_id;
                $sql .= ' WHEN ' . $usuario_id . ' THEN ' . $totalPlenos;
            }

            $sql .= ' END ';
            $sql .= ' WHERE usuario_id IN ( ' . implode(',', $aryUsuarioId) . ' );';
            Yii::app()->db->createCommand($sql)->query();

            $status = 'Actualizado';
        } else {
            $status = 'No ejecutado';
        }
    }

    /* @var $prediccion Prediccion */
    /* @var $versus Versus */

    public function actionAjaxTotalPuntos($project = null, $base = null) {

        if ($project == 'cristal') {
            $this->ajaxTotalPuntosOctavos($project, $base);
        }

        if ( ($project == 'bancochile') || ($project == 'raya') ) {
            $this->ajaxTotalPuntosBancochile($project, $base);
        } else {

            $start = microtime(true);

            $host = Yii::app()->params['dataBases'][$project]['connectionString'] . $base;
            $username = Yii::app()->params['dataBaseConfig']['user'];
            $psw = Yii::app()->params['dataBaseConfig']['pass'];
            Yii::app()->db->setActive(false);
            Yii::app()->db->connectionString = $host;
            Yii::app()->db->username = $username;
            Yii::app()->db->password = $psw;
            Yii::app()->db->setActive(true);

            $aryUsuario = array();
            $aryUsuarioPlenos = array();
            $totalPuntos = 0;

            $criteria = new CDbCriteria();
            $criteria->compare('canplay', '0');
            $aryVersus = Versus::model()->findAll($criteria);

            $canUpdate = false;

            if ($project == 'bancochile') {
                $puntos = 10;
            } else {
                $puntos = 0;
            }

            foreach ($aryVersus as $versus) {

                $criteria = new CDbCriteria();
                $criteria->select = 'usuario_id, versus_id, goles_a, goles_b';
                $criteria->compare('versus_id', $versus->versus_id);
                $aryPrediccion = Prediccion::model()->findAll($criteria);

                foreach ($aryPrediccion as $prediccion) {
                    $canUpdate = true;

                    $calculoPuntos = $this->calcularTotalPuntos($versus, $prediccion);
                    $aryUsuario[$prediccion->usuario_id] += $calculoPuntos->puntosTotal;
                    $aryUsuarioPlenos[$prediccion->usuario_id] += $calculoPuntos->puntosPlenos;
                }
            }

            if ($canUpdate) {

                //Update total puntos
                $aryUsuarioId = array();
                $sql = 'UPDATE ' . $base . '.usuario 
                    SET total_puntos = CASE usuario_id ';

                foreach ($aryUsuario as $usuario_id => $totalPuntos) {
                    $aryUsuarioId[] = $usuario_id;
                    $sql .= ' WHEN ' . $usuario_id . ' THEN ' . ($totalPuntos + $puntos);
                }

                $sql .= ' END ';
                $sql .= ' WHERE usuario_id IN ( ' . implode(',', $aryUsuarioId) . ' );';
                Yii::app()->db->createCommand($sql)->query();

                //Update total plenos
                $aryUsuarioId = array();
                $sql = 'UPDATE ' . $base . '.usuario 
                    SET total_plenos = CASE usuario_id ';

                foreach ($aryUsuarioPlenos as $usuario_id => $totalPlenos) {
                    $aryUsuarioId[] = $usuario_id;
                    $sql .= ' WHEN ' . $usuario_id . ' THEN ' . $totalPlenos;
                }

                $sql .= ' END ';
                $sql .= ' WHERE usuario_id IN ( ' . implode(',', $aryUsuarioId) . ' );';
                Yii::app()->db->createCommand($sql)->query();

                $status = 'Actualizado';
            } else {
                $status = 'No ejecutado';
            }

            $response = new stdClass();
            $response->status = $status;
            $response->time = round((microtime(true) - $start), 2) . 'segs';

            header('Content-type: text/json');
            header('Content-type: application/json');
            echo CJSON::encode($response);
        }
    }

    public function actionBackupTotalPuntos($versus_id = null, $proyect = null, $base = null) {

        $canExecute = true;

        if ($versus_id == null) {
            $canExecute = false;
        }

        if ($proyect == null) {
            $canExecute = false;
        }

        if ($base == null) {
            $canExecute = false;
        }

        if ($canExecute) {
            $host = Yii::app()->params['dataBases'][$proyect]['connectionString'] . $base;
            $username = Yii::app()->params['dataBaseConfig']['user'];
            $psw = Yii::app()->params['dataBaseConfig']['pass'];
            Yii::app()->db->setActive(false);
            Yii::app()->db->connectionString = $host;
            Yii::app()->db->username = $username;
            Yii::app()->db->password = $psw;
            Yii::app()->db->setActive(true);

            $aryUsuarios = Usuario::model()->findAll();

            $aryUsuarioId = array();
            $sql = 'UPDATE ' . $base . '.usuario 
                SET total_puntos = CASE usuario_id ';

            $canUpdate = false;
            foreach ($aryUsuarios as $usuario) {
                $canUpdate = true;
                $aryUsuarioId[] = $usuario->usuario_id;
                $sql .= ' WHEN ' . $usuario->usuario_id . ' THEN ' . $usuario->total_puntos;
            }

            $sql .= ' END ';
            $sql .= ' WHERE usuario_id IN ( ' . implode(',', $aryUsuarioId) . ' );';


            if ($canUpdate) {
                echo '<br>-- BackupTotalPuntos proyect: ' . $proyect . ' <br> ' . $sql;
            } else {
                echo '<br>-- proyect: ' . $proyect . ' ERROR<br> ';
            }
        } else {
            echo 'error';
        }
    }

    public function actionMenuPuntos($versus_id = null) {
        //adminUsuario/updateTotalPuntosPorProyecto?versus_id=2&proyect=rayalab&base=mundialero_rayalab

        $arrayBase = Yii::app()->params['dataBases'];
        unset($arrayBase['rayalab']);
        foreach ($arrayBase as $key => $value) {
            $url = 'adminUsuario/updateTotalPuntosPorProyecto?versus_id=' . $versus_id . '&proyect=' . $key . '&base=' . $value['dbname'];
            echo '<br>' . CHtml::link($key, array($url)) . ' - ' . $url;
        }
    }

    public function actionMenuBackup($versus_id = null) {
        //adminUsuario/updateTotalPuntosPorProyecto?versus_id=2&proyect=rayalab&base=mundialero_rayalab

        $arrayBase = Yii::app()->params['dataBases'];
        unset($arrayBase['rayalab']);
        foreach ($arrayBase as $key => $value) {
            $url = 'adminUsuario/backupTotalPuntos?versus_id=' . $versus_id . '&proyect=' . $key . '&base=' . $value['dbname'];
            echo '<br>' . CHtml::link($key, array($url)) . ' - ' . $url;
        }
    }

    public function actionUpdateTotalPuntosPorProyecto($versus_id = null, $proyect = null, $base = null) {

        $canExecute = true;

        if ($versus_id == null) {
            $canExecute = false;
        }

        if ($proyect == null) {
            $canExecute = false;
        }

        if ($base == null) {
            $canExecute = false;
        }


        if ($canExecute) {

            $host = Yii::app()->params['dataBases'][$proyect]['connectionString'] . $base;
            $username = Yii::app()->params['dataBaseConfig']['user'];
            $psw = Yii::app()->params['dataBaseConfig']['pass'];
            Yii::app()->db->setActive(false);
            Yii::app()->db->connectionString = $host;
            Yii::app()->db->username = $username;
            Yii::app()->db->password = $psw;
            Yii::app()->db->setActive(true);

            $versusModel = Versus::model()->findByPk($versus_id);

            $criteria = new CDbCriteria();
            $criteria->select = 'usuario_id, versus_id, goles_a, goles_b';
            $criteria->compare('versus_id', $versus_id);
            $aryPrediccion = Prediccion::model()->findAll($criteria);

            $aryUsuarioId = array();
            $sql = 'UPDATE ' . $base . '.usuario 
                    SET total_puntos = CASE usuario_id ';

            $canUpdate = false;
            foreach ($aryPrediccion as $prediccion) {

                $totalPuntos = $this->calcularTotalPuntos($versusModel, $prediccion);

                if ($totalPuntos > 0) {
                    $canUpdate = true;
                    $aryUsuarioId[] = $prediccion['usuario_id'];
                    $sql .= ' WHEN ' . $prediccion['usuario_id'] . ' THEN total_puntos+' . $totalPuntos;
                }
            }

            $sql .= ' END ';
            $sql .= ' WHERE usuario_id IN ( ' . implode(',', $aryUsuarioId) . ' );';

//            $aryUsuarioId = array();
//            $sql = '';
//
//            $canUpdate = false;
//            foreach ($aryPrediccion as $prediccion) {
//
//                $totalPuntos = $this->calcularTotalPuntos($versusModel, $prediccion);
//
//                if ($totalPuntos > 0) {
//                    $canUpdate = true;
//                    $aryUsuarioId[] = $prediccion['usuario_id'];
//                    $sql .= '<brUPDATE ' . $base . '.usuario SET total_puntos = total_puntos+'.$totalPuntos.' WHERE usuario_id = '.$prediccion['usuario_id'].';';
//                    //$sql .= ' WHEN ' . $prediccion['usuario_id'] . ' THEN total_puntos+' . $totalPuntos;
//                }
//            }

            if ($canUpdate) {
                Yii::app()->db->createCommand($sql)->query();
                echo '<br>-- UpdateTotalPuntosPorProyecto proyect: ' . $proyect . ' <br> ' . $sql;
            } else {
                echo '<br>-- UpdateTotalPuntosPorProyecto proyect: ' . $proyect . ' ERROR<br> ';
            }

            //        
            //        if($canUpdate){
            //            Yii::app()->db->createCommand($sql)->query();
            //        
            //            echo '<br>proyect: '.$proyect.' <br> '.$sql;
            //        }else{
            //            echo '<br>proyect: '.$proyect.' ERROR <br> ';
            //        }
        } else {
            echo 'Error';
        }
    }

    public function actionUpdateTotalPuntos($versus_id = null) {
        $arrayBase = Yii::app()->params['dataBases'];
        unset($arrayBase['rayalab']);
        foreach ($arrayBase as $key => $value) {
            $this->updateTotalPuntos($versus_id, $key, $value['dbname']);
        }
    }

    private function updateTotalPuntos($versus_id = null, $proyect = null, $base = null) {
        $host = Yii::app()->params['dataBases'][$proyect]['connectionString'] . $base;
        $username = Yii::app()->params['dataBaseConfig']['user'];
        $psw = Yii::app()->params['dataBaseConfig']['pass'];
        Yii::app()->db->setActive(false);
        Yii::app()->db->connectionString = $host;
        Yii::app()->db->username = $username;
        Yii::app()->db->password = $psw;
        Yii::app()->db->setActive(true);

        $versusModel = Versus::model()->findByPk($versus_id);

        $criteria = new CDbCriteria();
        $criteria->select = 'usuario_id, versus_id, goles_a, goles_b';
        $criteria->compare('versus_id', $versus_id);
        $aryPrediccion = Prediccion::model()->findAll($criteria);

        $aryUsuarioId = array();
        $sql = 'UPDATE ' . $base . '.usuario 
                SET total_puntos = CASE usuario_id ';

        $canUpdate = false;
        foreach ($aryPrediccion as $prediccion) {

            $calculoPuntos = $this->calcularTotalPuntos($versusModel, $prediccion);
            $totalPuntos = $calculoPuntos->puntosTotal;
            $puntosPlenos = $calculoPuntos->puntosPlenos;

            if ($totalPuntos > 0) {
                $canUpdate = true;
                $aryUsuarioId[] = $prediccion['usuario_id'];
                $sql .= ' WHEN ' . $prediccion['usuario_id'] . ' THEN total_puntos+' . $totalPuntos;
            }
        }

        $sql .= ' END ';
        $sql .= ' WHERE usuario_id IN ( ' . implode(',', $aryUsuarioId) . ' );';


        if ($canUpdate) {
            echo '<br>proyect: ' . $proyect . ' <br> ' . $sql;
        } else {
            echo '<br>proyect: ' . $proyect . ' ERROR<br> ';
        }

//        
//        if($canUpdate){
//            Yii::app()->db->createCommand($sql)->query();
//        
//            echo '<br>proyect: '.$proyect.' <br> '.$sql;
//        }else{
//            echo '<br>proyect: '.$proyect.' ERROR <br> ';
//        }
    }

    private function calcularTotalPuntos($versusModel, $prediccion) {
        $versus = new stdClass();
        $versus->resultadoA = $versusModel->goles_a;
        $versus->resultadoB = $versusModel->goles_b;
        $versus->ganadorPais_id = $versusModel->ganador;
        $versus->paisAPais_id = $versusModel->pais_id_a;
        $versus->paisBPais_id = $versusModel->pais_id_b;
        $versus->prediccionA = $prediccion['goles_a'];
        $versus->prediccionB = $prediccion['goles_b'];
        $versus->PTSganadorA = 0;
        $versus->PTSganadorB = 0;
        $versus->PTSempate = 0;
        $versus->PTSscoreA = 0;
        $versus->PTSscoreB = 0;

        if ($versus->resultadoA > $versus->resultadoB) {
            $versus->ganadorPais_id = $versusModel->pais_id_a;
        }

        if ($versus->resultadoA < $versus->resultadoB) {
            $versus->ganadorPais_id = $versusModel->pais_id_b;
        }

        if ($versus->resultadoA == $versus->resultadoB) {
            $versus->ganadorPais_id = 0;
        }


        $puntos = 0;
        $puntosPlenos = 0;

        //REGLA 1 puntos a ganador o empate
        //Ganador A
        if ($versus->ganadorPais_id == $versus->paisAPais_id) {

            if ($versus->prediccionA > $versus->prediccionB) {
                $puntos += 3;
                $versus->PTSganadorA = 3;
            }
        }

        //Ganador B
        if ($versus->ganadorPais_id == $versus->paisBPais_id) {

            if ($versus->prediccionA < $versus->prediccionB) {
                $puntos += 3;
                $versus->PTSganadorB = 3;
            }
        }

        //Empate
        if ($versus->ganadorPais_id == 0) {

            if ($versus->prediccionA == $versus->prediccionB) {
                $puntos += 3;
                $versus->PTSempate = 3;
            }
        }

        //REGLA 2
        //Puntaje por Score 1: Si acierta a los goles que convirtió el equipo A
        if ($versus->resultadoA == $versus->prediccionA) {

            if ($versus->resultadoA == 0) {
                $puntos += 1;
                $versus->PTSscoreA = 1;
            }

            if ($versus->resultadoA == 1) {
                $puntos += 1;
                $versus->PTSscoreA = 1;
            }

            //
            if ($versus->resultadoA > 1 && $versus->resultadoA < 5) {
                $puntos += intval($versus->resultadoA);
                $versus->PTSscoreA = $versus->resultadoA;
            }

            if ($versus->resultadoA >= 5) {
                $puntos += 5;
                $versus->PTSscoreA = 5;
            }
        }

        //Puntaje por Score 2: Si acierta a los goles que convirtió el equipo B
        if ($versus->resultadoB == $versus->prediccionB) {

            if ($versus->resultadoB == 0) {
                $puntos += 1;
                $versus->PTSscoreB = 1;
            }

            if ($versus->resultadoB == 1) {
                $puntos += 1;
                $versus->PTSscoreB = 1;
            }

            if ($versus->resultadoB > 1 && $versus->resultadoB < 5) {
                $puntos += intval($versus->resultadoB);
                $versus->PTSscoreB = $versus->resultadoB;
            }

            if ($versus->resultadoB >= 5) {
                $puntos += 5;
                $versus->PTSscoreB = 5;
            }
        }

        if (($versus->resultadoA == $prediccion->goles_a) && ($versus->resultadoB == $prediccion->goles_b)) {
            $puntosPlenos += 1;
        }

        $versus->puntosPlenos = $puntosPlenos;
        $versus->puntosGanador = $versus->PTSganadorA + $versus->PTSganadorB + $versus->PTSempate;
        $versus->puntosGolesGanador = $versus->PTSscoreA;
        $versus->puntosGolesPerdedor = $versus->PTSscoreB;
        $versus->puntosTotal = $versus->puntosGanador + $versus->puntosGolesGanador + $versus->puntosGolesPerdedor;

        return $versus;
    }

    public function actionFix() {
        $sql = '
            SELECT 
                a.fecha_actualizacion as fecha_actualizacion, 
                b.usuario_id, 
                b.nickname, 
                b.rut, 
                b.nombre, 
                b.apellido_paterno, 
                b.apellido_materno
            FROM 
            prediccion a, 
            usuario b
            WHERE
            b.usuario_id = a.usuario_id
            GROUP BY a.usuario_id';

        $aryItems = Yii::app()->db->createCommand($sql)->queryAll();
        $count = 1;


        $table = '<table border="1">';
        $table .= '<thead>';
        $table .= '<tr>';
        $table .= '<th>count</th>';
        $table .= '<th>fecha_actualizacion</th>';
        $table .= '<th>usuario_id</th>';
        $table .= '<th>nickname</th>';
        $table .= '<th>rut</th>';
        $table .= '<th>nombre</th>';
        $table .= '<th>apellido_paterno</th>';
        $table .= '<th>apellido_materno</th>';
        $table .= '</tr>';
        $table .= '</thead>';
        $table .= '<tbody>';

        foreach ($aryItems as $item) {
            $table .= '<tr>';
            $table .= '<td>' . $count . '</td>';
            $table .= '<td>' . $item['fecha_actualizacion'] . '</td>';
            $table .= '<td>' . $item['usuario_id'] . '</td>';
            $table .= '<td>' . $item['nickname'] . '</td>';
            $table .= '<td>' . Yii::app()->aesManager->decrypt($item['rut']) . '</td>';
            $table .= '<td>' . Yii::app()->aesManager->decrypt($item['nombre']) . '</td>';
            $table .= '<td>' . Yii::app()->aesManager->decrypt($item['apellido_paterno']) . '</td>';
            $table .= '<td>' . Yii::app()->aesManager->decrypt($item['apellido_materno']) . '</td>';
            $table .= '</tr>';
            $count++;
        }

        $table .= '</tbody>';
        $table .= '</table>';

        echo $table;
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->layout = 'main_admin';
        $usuario = Usuario::model()->findByPk($id);
        if ($usuario->tipo_usuario_id == 2 || $usuario->tipo_usuario_id == 3) {
            $this->render('view', array(
                'model' => $this->loadModel($id),
            ));
        } else {
            header('Location: ' . '../home');
        }
    }

    function file_exists_remote($url) {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_NOBODY, true);
        $result = curl_exec($curl);
        $ret = false;
        if ($result !== false) {
            $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            if ($statusCode == 200) {
                $ret = true;
            }
        }
        curl_close($curl);
        return $ret;
    }

    public function actionUsuarioImage() {
        $listUsuario = Usuario::model()->findAll();

        foreach ($listUsuario as $item) {
            $proyect = Yii::app()->session['project'];
            $rut = Yii::app()->aesManager->decrypt($item->rut);
            $url = Yii::app()->params['baseUrlImg'] . '/images/' . $proyect . '/' . $rut . '.jpg';
            $exist = $this->file_exists_remote($url);

            if ($exist) {
                //echo '<br>ok '.$url;
                $img = '/images/' . $proyect . '/' . $rut . '.jpg';
                $usuario = Usuario::model()->findByPk($item->usuario_id);
                $usuario->setAttribute('imagen', '/images/' . $proyect . '/' . $rut . '.jpg');
                $usuario->update();
            } else {
                //echo '<br>no existe la imagen ' . $url . '';
            }
        }
    }

    public function actionCargaUsuario() {
        $this->layout = 'main_admin';
        $msg = '';

        if (isset($_POST['AdminUsuario'])) {

            $aryUsuario = $this->getCSV();

            if ($aryUsuario['error'] == '') {

                //inactivar todos los usuarios                
                Usuario::model()->updateAll(array('tipo_estado_usuario_id' => 2));

                //default user
                $usuarioDefault = Usuario::model()->findByPk(1);

                if ($usuarioDefault == null) {
                    $usuarioDefault = new Usuario();
                    $usuarioDefault->rut = Yii::app()->aesManager->encrypt('rayalab');
                    $usuarioDefault->user = Yii::app()->aesManager->encrypt('rayalab');
                    $usuarioDefault->pass = Yii::app()->aesManager->encrypt('#$L4-kJiTHa76229|');
                    $usuarioDefault->nombre = Yii::app()->aesManager->encrypt('rayalab');
                    $usuarioDefault->apellido_paterno = Yii::app()->aesManager->encrypt('');
                    $usuarioDefault->apellido_materno = Yii::app()->aesManager->encrypt('');
                    $usuarioDefault->email = Yii::app()->aesManager->encrypt('cm@rayalab.cl');
                    $usuarioDefault->last_login_time = '2014-05-27 17:00:00';
                    $usuarioDefault->fecha_nacimiento = '1982-11-01';
                    $usuarioDefault->nickname = 'rayalab';
                    $usuarioDefault->area_id = 1;
                    $usuarioDefault->empresa_id = 1;
                    $usuarioDefault->tipo_estado_usuario_id = 1;
                    $usuarioDefault->tipo_usuario_id = 3;
                    $usuarioDefault->usuario_pais_id = 1;
                    $usuarioDefault->insert();
                } else {
                    $usuarioDefault->tipo_estado_usuario_id = 1;
                    $usuarioDefault->update();
                }

                //ingresa y activa nuevos usuarios
                $countUserNew = 0;
                $countUserOld = 0;
                $countAreaNew = 0;
                $countEmpresaNew = 0;
                $countPaisNew = 0;
                foreach ($aryUsuario['usuario'] as $usuario) {

                    $rut = Yii::app()->aesManager->encrypt($usuario['rut']);

                    $criteria = new CDbCriteria();
                    $criteria->addSearchCondition('rut', $rut);

                    if (Usuario::model()->count($criteria) == 0) {
                        if ($usuario['empresa'] != '') {

                            $criteria = new CDbCriteria();
                            $criteria->addSearchCondition('nombre', $usuario['empresa'], false);
                            $empresa = Empresa::model()->find($criteria);

                            if ($empresa == null) {
                                $empresa = new Empresa();
                                $empresa->nombre = $usuario['empresa'];
                                $empresa->insert();
                                $countEmpresaNew++;
                            }
                        }

                        if ($usuario['area'] != '') {

                            $criteria = new CDbCriteria();
                            $criteria->addSearchCondition('nombre', $usuario['area'], false);
                            $area = Area::model()->find($criteria);

                            if ($area == null) {
                                $area = new Area();
                                $area->nombre = $usuario['area'];
                                $area->insert();
                                $countAreaNew++;
                            }
                        }

                        if ($usuario['pais'] != '') {

                            $criteria = new CDbCriteria();
                            $criteria->addSearchCondition('titulo', $usuario['pais'], false);
                            $pais = UsuarioPais::model()->find($criteria);

                            if ($pais == null) {
                                $pais = new UsuarioPais();
                                $pais->titulo = $usuario['pais'];
                                $pais->insert();
                                $countPaisNew++;
                            }
                        }

                        list($day, $month, $year) = explode('-', $usuario['fecha_nacimiento']);
                        $email = strtolower($usuario['email']);
                        $verificarRut = substr($usuario['rut'], 0, 1);

                        $usuarioNew = new Usuario();
                        $pass = str_replace('-', '', $usuario['rut']);

                        if ($verificarRut == "0") {
                            $usuarioNew->rut = substr($usuario['rut'], 1);
                            $usuarioNew->user = substr($usuario['rut'], 1);
                        } else {
                            $usuarioNew->rut = $usuario['rut'];
                            $usuarioNew->user = $usuario['rut'];
                        }

                        $usuarioNew->pass = $pass;
                        $usuarioNew->nombre = strtolower($usuario['nombre']);
                        $usuarioNew->apellido_paterno = strtolower($usuario['apellido_paterno']);
                        $usuarioNew->apellido_materno = strtolower($usuario['apellido_materno']);
                        $usuarioNew->email = $email;
                        $usuarioNew->fecha_nacimiento = $year . '-' . $month . '-' . $day;
                        $usuarioNew->nickname = $usuario['nickname'];
                        $usuarioNew->area_id = $area->area_id;
                        $usuarioNew->empresa_id = $empresa->empresa_id;
                        $usuarioNew->tipo_estado_usuario_id = 1;
                        $usuarioNew->tipo_usuario_id = 1;
                        $usuarioNew->usuario_pais_id = $pais->usuario_pais;

                        //encrypt
                        $usuarioNew->user = Yii::app()->aesManager->encrypt($usuarioNew->user);
                        $usuarioNew->pass = Yii::app()->aesManager->encrypt($usuarioNew->pass);
                        $usuarioNew->rut = Yii::app()->aesManager->encrypt($usuarioNew->rut);
                        $usuarioNew->nombre = Yii::app()->aesManager->encrypt($usuarioNew->nombre);
                        $usuarioNew->apellido_paterno = Yii::app()->aesManager->encrypt($usuarioNew->apellido_paterno);
                        $usuarioNew->apellido_materno = Yii::app()->aesManager->encrypt($usuarioNew->apellido_materno);
                        $usuarioNew->email = Yii::app()->aesManager->encrypt($usuarioNew->email);

                        $usuarioNew->insert();

                        $countUserNew++;
                    } else {

                        $usuarioOld = Usuario::model()->find($criteria);
                        $usuarioOld->tipo_estado_usuario_id = 1;
                        $usuarioOld->update();
                        $countUserOld++;
                    }
                }

                if ($countUserNew > 0) {
                    $msg .= '<br>Se cargaron ' . $countUserNew . ' nuevos usuarios.';
                } else {
                    $msg .= '<br>No se cargaron nuevos usuarios.';
                }

                if ($countUserOld > 0) {
                    $msg .= '<br>Se actualizaron ' . $countUserOld . ' usuarios.';
                }

                $criteria = new CDbCriteria();
                $criteria->compare('tipo_estado_usuario_id', 2);
                $countUserInactive = Usuario::model()->count($criteria);

                if ($countUserInactive > 0) {
                    $msg .= '<br>Se desactivaron ' . $countUserInactive . ' cuentas de usuarios.';
                }

                if ($countEmpresaNew > 0) {
                    $msg .= '<br>Se cargaron ' . $countEmpresaNew . ' nuevas empresas.';
                }

                if ($countAreaNew > 0) {
                    $msg .= '<br>Se cargaron ' . $countAreaNew . ' nuevas areas.';
                }
            } else {
                $msg = $aryUsuario['error'];
            }
        }
        $this->render('cargaUsuario', array('msg' => $msg));
    }

    private function getCSV() {

        $aryDatos = array();
        $aryDatos['error'] = '';

        $fila = 1;


        if (file_exists($_FILES['AdminUsuario']['tmp_name']['usuariosCSV'])) {

            $lines = file($_FILES['AdminUsuario']['tmp_name']['usuariosCSV'], FILE_IGNORE_NEW_LINES);

            foreach ($lines as $key => $value) {
                $item = implode(',', str_getcsv($value));
                list($rut, $fechaNacimiento, $nombre, $apellidoPaterno, $apellidoMaterno, $email, $empresa, $area, $pais, $nickname) = explode(';', $item);

                if ($fila == 1) {

                    //check encabezados
                    if ($rut != 'rut') {
                        $aryDatos['error'] = 'Formato CSV inválido. Columna incorrecta: rut';
                        break;
                    }

                    if ($fechaNacimiento != 'fecha_nacimiento') {
                        $aryDatos['error'] = 'Formato CSV inválido. Columna incorrecta: fecha_nacimiento';
                        break;
                    }

                    if ($nombre != 'nombre') {
                        $aryDatos['error'] = 'Formato CSV inválido. Columna incorrecta: nombre';
                        break;
                    }

                    if ($apellidoPaterno != 'apellido_paterno') {
                        $aryDatos['error'] = 'Formato CSV inválido. Columna incorrecta: apellido_paterno';
                        break;
                    }

                    if ($apellidoMaterno != 'apellido_materno') {
                        $aryDatos['error'] = 'Formato CSV inválido. Columna incorrecta: apellido_materno';
                        break;
                    }

                    if ($email != 'email') {
                        $aryDatos['error'] = 'Formato CSV inválido. Columna incorrecta: email';
                        break;
                    }
                    if ($empresa != 'empresa') {
                        $aryDatos['error'] = 'Formato CSV inválido. Columna incorrecta: empresa';
                        break;
                    }

                    if ($area != 'area') {
                        $aryDatos['error'] = 'Formato CSV inválido. Columna incorrecta: area';
                        break;
                    }

                    if ($pais != 'pais') {
                        $aryDatos['error'] = 'Formato CSV inválido. Columna incorrecta: pais';
                        break;
                    }

                    if ($nickname != 'nickname') {
                        $aryDatos['error'] = 'Formato CSV inválido. Columna incorrecta: nickname';
                        break;
                    }
                } else {

                    $nombreClean = trim(mb_strtolower(utf8_encode($nombre), 'UTF-8'));
                    $apellidoPaternoClean = trim(mb_strtolower(utf8_encode($apellidoPaterno), 'UTF-8'));
                    $apellidoMaternoClean = trim(mb_strtolower(utf8_encode($apellidoMaterno), 'UTF-8'));
                    $areaClean = trim(mb_strtolower(utf8_encode($area), 'UTF-8'));
                    $empresaClean = trim(mb_strtolower(utf8_encode($empresa), 'UTF-8'));
                    $rutClean = trim(mb_strtolower(utf8_encode($rut), 'UTF-8'));
                    $paisClean = trim(mb_strtolower(utf8_encode($pais), 'UTF-8'));
                    $nicknameClean = trim(mb_strtolower(utf8_encode($nickname), 'UTF-8'));

                    $aryDatos['usuario'][] = array(
                        'nombre' => $nombreClean,
                        'apellido_paterno' => $apellidoPaternoClean,
                        'apellido_materno' => $apellidoMaternoClean,
                        'email' => $email,
                        'area' => $areaClean,
                        'empresa' => $empresaClean,
                        'fecha_nacimiento' => $fechaNacimiento,
                        'rut' => $rutClean,
                        'pais' => $paisClean,
                        'nickname' => $nicknameClean
                    );
                }

                $fila++;
            }
        } else {
            $aryDatos['error'] = 'Debe adjuntar un archivo CSV válido.';
        }

        return $aryDatos;
    }

    public function actionBuscarPuntos() {

        $this->layout = 'main_admin';
        $model = new Usuario();

        $this->render('buscarpuntos', array(
            'model' => $model,
        ));
    }

    public function actionCreate() {

        $this->layout = 'main_admin';
        $model = new Usuario();

        $usuario = Usuario::model()->findByPk(Yii::app()->user->getId());

        if ($usuario->tipo_usuario_id == 2 || $usuario->tipo_usuario_id == 3) {

            if (isset($_POST['Usuario'])) {
                $model->attributes = $_POST['Usuario'];
                $model->pass = Yii::app()->aesManager->encrypt($_POST['Usuario']['user']);
                ;
                $model->user = Yii::app()->aesManager->encrypt($_POST['Usuario']['user']);
                $model->nombre = Yii::app()->aesManager->encrypt($_POST['Usuario']['nombre']);
                $model->apellido_paterno = Yii::app()->aesManager->encrypt($_POST['Usuario']['apellido_paterno']);
                $model->apellido_materno = Yii::app()->aesManager->encrypt($_POST['Usuario']['apellido_materno']);
                $model->rut = Yii::app()->aesManager->encrypt($_POST['Usuario']['rut']);
                $model->email = Yii::app()->aesManager->encrypt($_POST['Usuario']['email']);
                $model->imagen = $_POST['Usuario']['imagen'];

                if ($model->save()) {
                    Yii::app()->cacheUsers->now();
                    $this->redirect(array('admin'));
                }
            }

            $criteria = new CDbCriteria();
            $criteria->order = 'nombre';
            $listArea = CHtml::listData(Area::model()->findAll($criteria), 'area_id', 'nombre');

            $criteria = new CDbCriteria();
            $criteria->order = 'titulo';
            $listTipoEstado = CHtml::listData(TipoEstadoUsuario::model()->findAll($criteria), 'tipo_estado_usuario_id', 'titulo');

            $listTipoUsuario = array();
            $listTipoUsuario[1] = 'Usuario';
            $listTipoUsuario[2] = 'Administrador';

            if (Yii::app()->user->getId() == 1) {
                $listTipoUsuario[3] = 'Super Administrador';
            }

            $this->render('create', array(
                'model' => $model,
                'listArea' => $listArea,
                'listTipoEstado' => $listTipoEstado,
                'listTipoUsuario' => $listTipoUsuario
            ));
        }
    }

    public function actionUpdate($id) {
        $this->layout = 'main_admin';
        $model = $this->loadModel($id)
                ->with('usuario')
                ->with('estado_usuario')
                ->with('area')
                ->with('empresa')
                ->with('tipo_usuario')
                ->with('usuario_pais');

        $usuario = Usuario::model()->findByPk(Yii::app()->user->getId());

        if ($usuario->tipo_usuario_id == 2 || $usuario->tipo_usuario_id == 3) {

            $canEdit = true;
            if ($id == 1) {

                if (Yii::app()->user->getId() != $id) {
                    $canEdit = false;
                }
            }

            if ($canEdit) {

                if (isset($_POST['Usuario'])) {

                    if (trim($_POST['Usuario']['pass']) == '') {
                        $pass = $model->pass;
                        $last_login_time = $model->last_login_time;
                    } else {
                        $pass = Yii::app()->aesManager->encrypt($_POST['Usuario']['pass']);
                        $date = new DateTime('NOW');
                        $last_login_time = $date->format('Y-m-d H:i:s');
                    }

                    $model->attributes = $_POST['Usuario'];
                    $model->last_login_time = $last_login_time;
                    $model->pass = $pass;
                    $model->user = Yii::app()->aesManager->encrypt($_POST['Usuario']['user']);
                    $model->nombre = Yii::app()->aesManager->encrypt($_POST['Usuario']['nombre']);
                    $model->apellido_paterno = Yii::app()->aesManager->encrypt($_POST['Usuario']['apellido_paterno']);
                    $model->apellido_materno = Yii::app()->aesManager->encrypt($_POST['Usuario']['apellido_materno']);
                    $model->nickname = $_POST['Usuario']['nickname'];
                    $model->rut = Yii::app()->aesManager->encrypt($_POST['Usuario']['rut']);
                    $model->email = Yii::app()->aesManager->encrypt($_POST['Usuario']['email']);
                    $model->imagen = $_POST['Usuario']['imagen'];

                    if ($model->save()) {
                        Yii::app()->cacheUsers->now();
                        $this->redirect(array('admin'));
                    }
                }

                $criteria = new CDbCriteria();
                $criteria->order = 'nombre';
                $listArea = CHtml::listData(Area::model()->findAll($criteria), 'area_id', 'nombre');

                $criteria = new CDbCriteria();
                $criteria->order = 'titulo';
                $listTipoEstado = CHtml::listData(TipoEstadoUsuario::model()->findAll($criteria), 'tipo_estado_usuario_id', 'titulo');

                $criteria = new CDbCriteria();

                $listTipoUsuario = array();
                $listTipoUsuario[1] = 'Usuario';
                $listTipoUsuario[2] = 'Administrador';

                if (Yii::app()->user->getId() == 1) {
                    $listTipoUsuario[3] = 'Super Administrador';
                }

                $model->user = Yii::app()->aesManager->decrypt($model->user);
                $model->pass = '';
                $model->nombre = Yii::app()->aesManager->decrypt($model->nombre);
                $model->apellido_paterno = Yii::app()->aesManager->decrypt($model->apellido_paterno);
                $model->apellido_materno = Yii::app()->aesManager->decrypt($model->apellido_materno);
                $model->rut = Yii::app()->aesManager->decrypt($model->rut);
                $model->nickname = $model->nickname;
                $model->email = Yii::app()->aesManager->decrypt($model->email);

                $this->render('update', array(
                    'model' => $model,
                    'listArea' => $listArea,
                    'listTipoEstado' => $listTipoEstado,
                    'listTipoUsuario' => $listTipoUsuario
                ));
            } else {
                header('Location: ' . '../../adminPanel');
            }
        } else {
            header('Location: ' . '../../home');
        }
    }

    public function actionDelete($id) {
        $this->layout = 'main_admin';
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionIndex() {
        $this->layout = 'main_admin';
        $dataProvider = new CActiveDataProvider('Usuario');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAdmin() {
        $this->layout = 'main_admin';
        $usuario = Usuario::model()->findByPk(Yii::app()->user->getId());

        if ($usuario->tipo_usuario_id == 2 || $usuario->tipo_usuario_id == 3) {
            $model = new Usuario('search');
            $model->unsetAttributes();  // clear any default values
            if (isset($_GET['Usuario']))
                $model->attributes = $_GET['Usuario'];

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
     * @return Usuario the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $this->layout = 'main_admin';
        $model = Usuario::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Usuario $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'usuario-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
