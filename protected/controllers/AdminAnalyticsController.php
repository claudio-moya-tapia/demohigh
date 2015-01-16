<?php

class AdminAnalyticsController extends Controller {

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
                'actions' => array('menuFix', 'fixer', 'index', 'day', 
                    'dayUrl', 'dayUrlUser', 'descargarUserLogin', 'descargarUserLoginNo',
                    'descargarPartidoExacto','descargarGrupos','descargarOctavos','topNoticias','twitter','descargaAnalytic','bbva','leerarchivo'),
                'users' => array('*'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
    public function actionLeerarchivo($inicio=null,$fin=null){
        
        $session = new CHttpSession;
        $session->open();
        $session['project'] = 'xml';
        
        $start = microtime(true);

        $xml = file_get_contents(utf8_encode("http://portal.mbauc.cl/iit-rayalab-service/xmlUsuario?inicio=".$inicio."&fin=".$fin.""));
        $start2 = round((microtime(true) - $start), 2) . 'segs';
        $name = 'usuarioXML_'.$inicio.'_'.$fin.'_'.$start2;
        $basePath = 'C:/AppServ/www/yii/project/mundialero_v4_dev/json/' . $name . '_tmp.xml';
        $basePathFinal = 'C:/AppServ/www/yii/project/mundialero_v4_dev/json/' . $name . '.xml';
        
        if ($_SERVER['HTTP_HOST'] == '192.168.1.49') {
            //Local
            $basePath = 'C:/AppServ/www/yii/project/mundialero_v4_dev/json/' . $name . '_tmp.xml';
            $basePathFinal = 'C:/AppServ/www/yii/project/mundialero_v4_dev/json/' . $name . '.xml';
        } else {
            //Google
            $basePath = Yii::app()->params['baseUrlGs'] . '/json/' . $name . '_tmp.xml';
            $basePathFinal = Yii::app()->params['baseUrlGs'] . '/json/' . $name . '.xml';
        }

        error_reporting(E_ALL);
        ini_set('display_errors', '1');


        file_put_contents($basePath, $xml);

        $options = [ 'gs' => [ 'Content-Type' => 'text/xml', 'acl' => 'public-read', 'read_cache_expiry_seconds' => 300]];
        $ctx = stream_context_create($options);

        rename($basePath, $basePathFinal, $ctx);
        echo round((microtime(true) - $start), 2) . 'segs';

    }
    public function actionDescargaAnalytic() {
  $sql = 'SELECT *
            FROM analytics_copy WHERE usuario_id != 1';
                     
        $aryNoticia = Yii::app()->db->createCommand($sql)->queryAll();
        $table = '<table>
                        <thead>
                        <tr>
                            <th>Fecha Creacion</th>   
                            <th>Url</th> 
                            <th>Usuario_id</th>
                            <th>Nombre Completo</th>
                            <th>Empresa</th>
                            <th>Area</th>
                        </tr>
                        </thead>
                        <tbody>';
        
        for($i=0;$i<count($aryNoticia);$i++){
            
            $var = Usuario::model()->findByPk($aryNoticia[$i]['usuario_id']);
            $table .= '<tr>
                            <td>' . $aryNoticia[$i]['fecha_creacion'] . '</td>    
                            <td>' . $aryNoticia[$i]['url'] . '</td> 
                            <td>' . $aryNoticia[$i]['usuario_id'] . '</td> 
                            <td>' . Yii::app()->aesManager->decrypt($var->nombre) .' '.Yii::app()->aesManager->decrypt($var->apellido_paterno).''.Yii::app()->aesManager->decrypt($var->apellido_materno). '</td> 
                            <td>' . $aryNoticia[$i]['empresa_nombre'] . '</td> 
                            <td>' . $aryNoticia[$i]['area_nombre'] . '</td> 
                        </tr>';
        }
        
        $table .= '</table>';

        $filename = "Analytycs.xls";
        header('Content-Encoding: UTF-8');
        header('Content-type: text/csv; charset=UTF-8');
        header("Content-Disposition: attachment; filename=$filename");
        header("Pragma: public");
        header("Expires: 0");
        echo "\xEF\xBB\xBF"; // UTF-8 BOM
        echo $table;           
     
        
    }
    public function actionBbva() {
     $sql = 'SELECT COUNT(LG.galeria_id) as totalLikes,G.fecha_creacion,G.titulo, G.imagen
                FROM like_galeria AS LG
                INNER JOIN galeria AS G on LG.galeria_id =  G.galeria_id
                group by LG.galeria_id ORDER BY totalLikes DESC';
                     
        $aryNoticia = Yii::app()->db->createCommand($sql)->queryAll();
        $table = '<table>
                        <thead>
                        <tr>
                            <th>Total de Likes</th>   
                            <th>Fecha Creacion</th> 
                            <th>Titual</th>
                            <th>url</th>
                        </tr>
                        </thead>
                        <tbody>';
        
        for($i=0;$i<count($aryNoticia);$i++){
            
            $var = Usuario::model()->findByPk($aryNoticia[$i]['usuario_id']);
            $table .= '<tr>
                            <td>' . $aryNoticia[$i]['totalLikes'] . '</td>    
                            <td>' . $aryNoticia[$i]['fecha_creacion'] . '</td> 
                            <td>' . $aryNoticia[$i]['titulo'] . '</td> 
                            <td>' . $aryNoticia[$i]['imagen'] . '</td> 
                        </tr>';
        }
        
        $table .= '</table>';

        $filename = "BBVA.xls";
        header('Content-Encoding: UTF-8');
        header('Content-type: text/csv; charset=UTF-8');
        header("Content-Disposition: attachment; filename=$filename");
        header("Pragma: public");
        header("Expires: 0");
        echo "\xEF\xBB\xBF"; // UTF-8 BOM
        echo $table;           
     
        
    }
    public function actionTopnoticias() {
        $sql = 'SELECT COUNT(url) AS totalUrl, url
                FROM analytics_copy
                WHERE url LIKE "%/noticia/%"
                GROUP BY url
                ORDER BY totalUrl DESC';
                     
        $aryNoticia = Yii::app()->db->createCommand($sql)->queryAll();
        $table = '<table>
                        <thead>
                        <tr>
                            <th>Cantidad de visitas</th>   
                            <th>Noticia</th>   
                        </tr>
                        </thead>
                        <tbody>';
        
        for($i=0;$i<count($aryNoticia);$i++){
            $table .= '<tr>
                            <td>' . $aryNoticia[$i]['totalUrl'] . '</td>    
                            <td>' . $aryNoticia[$i]['url'] . '</td> 
                        </tr>';
        }
        
        $table .= '</table>';

        $filename = "Top Noticias.xls";
        header('Content-Encoding: UTF-8');
        header('Content-type: text/csv; charset=UTF-8');
        header("Content-Disposition: attachment; filename=$filename");
        header("Pragma: public");
        header("Expires: 0");
        echo "\xEF\xBB\xBF"; // UTF-8 BOM
        echo $table;           
     
    }
    
    public function actionJugadoresArea() {
        $sql = 'SELECT COUNT(url) AS totalUrl, url
                FROM analytics_copy
                WHERE url LIKE "%/noticia/%"
                GROUP BY url
                ORDER BY totalUrl DESC';
                     
        $aryNoticia = Yii::app()->db->createCommand($sql)->queryAll();
        $table = '<table>
                        <thead>
                        <tr>
                            <th>Cantidad de visitas</th>   
                            <th>Noticia</th>   
                        </tr>
                        </thead>
                        <tbody>';
        
        for($i=0;$i<count($aryNoticia);$i++){
            $table .= '<tr>
                            <td>' . $aryNoticia[$i]['totalUrl'] . '</td>    
                            <td>' . $aryNoticia[$i]['url'] . '</td> 
                        </tr>';
        }
        
        $table .= '</table>';

        $filename = "Top Noticias.xls";
        header('Content-Encoding: UTF-8');
        header('Content-type: text/csv; charset=UTF-8');
        header("Content-Disposition: attachment; filename=$filename");
        header("Pragma: public");
        header("Expires: 0");
        echo "\xEF\xBB\xBF"; // UTF-8 BOM
        echo $table;           
     
    }
    public function actionTwitter() {
        
    
        $sql = 'SELECT *
                FROM twitter_historico
                ORDER BY fecha_creacion DESC';
                     
        $aryTwiterHistorico = Yii::app()->db->createCommand($sql)->queryAll();
        
        $sql = 'SELECT *
        FROM twitter
        ORDER BY fecha_creacion DESC';
                     
        $aryTwiter= Yii::app()->db->createCommand($sql)->queryAll();
        
        $table = '<table>
                        <thead>
                        <tr>
                            <th>Twitter ID</th>   
                            <th>Fecha Creacion</th>  
                            <th>Usuario ID</th>  
                            <th>Texto</th>  
                        </tr>
                        </thead>
                        <tbody>';
        
        for($i=0;$i<count($aryTwiter);$i++){
            
          
            $table .= '<tr>
                            <td>' . $aryTwiter[$i]['twitter_id'] . '</td>    
                            <td>' . $aryTwiter[$i]['fecha_creacion'] . '</td> 
                            <td>' . $aryTwiter[$i]['usuario_id'] . '</td> 
                            <td>' . $aryTwiter[$i]['texto'] . '</td> 
                        </tr>';
        }
        
        for($i=0;$i<count($aryTwiterHistorico);$i++){
            
          
        $table .= '<tr>
                            <td>' . $aryTwiterHistorico[$i]['twitter_id'] . '</td>    
                            <td>' . $aryTwiterHistorico[$i]['fecha_creacion'] . '</td> 
                            <td>' . $aryTwiterHistorico[$i]['usuario_id'] . '</td> 
                            <td>' . $aryTwiterHistorico[$i]['texto'] . '</td> 
                        </tr>';
        }
        
        $table .= '</table>';

        $filename = "Twitter.xls";
        header('Content-Encoding: UTF-8');
        header('Content-type: text/csv; charset=UTF-8');
        header("Content-Disposition: attachment; filename=$filename");
        header("Pragma: public");
        header("Expires: 0");
        echo "\xEF\xBB\xBF"; // UTF-8 BOM
        echo $table;           
     
    }

    public function actionFixer($proyect = null, $base = null) {

        $host = Yii::app()->params['dataBases'][$proyect]['connectionString'] . $base;
        $username = Yii::app()->params['dataBaseConfig']['user'];
        $psw = Yii::app()->params['dataBaseConfig']['pass'];
        Yii::app()->db->setActive(false);
        Yii::app()->db->connectionString = $host;
        Yii::app()->db->username = $username;
        Yii::app()->db->password = $psw;
        Yii::app()->db->setActive(true);

        $sql = 'SELECT p.fecha_actualizacion,u.usuario_id,u.nombre,u.apellido_paterno,u.apellido_materno,u.empresa_id,u.area_id FROM prediccion AS p INNER JOIN usuario AS u ON u.usuario_id = p.usuario_id WHERE p.fecha_actualizacion LIKE "2014-06-14 %%:%%:%%" Group by p.usuario_id';
        $userLogged = Yii::app()->db->createCommand($sql)->queryAll();

        
        foreach ($userLogged as $user) {

            $Empresa = Empresa::model()->findByPk($user['empresa_id']);
            $Area = Area::model()->findByPk($user['area_id']);
            
            $analyticsHOME = new Analytics();
            $analyticsHOME->fecha_creacion = $user['fecha_actualizacion'];
            $analyticsHOME->url = '/home';
            $analyticsHOME->usuario_id = $user['usuario_id'];
            $analyticsHOME->nombre_completo = $user['nombre'].''.$user['apellido_paterno'].''.$user['apellido_materno'];
            $analyticsHOME->empresa_id = $user['empresa_id'];
            $analyticsHOME->empresa_nombre = $Empresa->nombre;
            $analyticsHOME->area_id = $user['area_id'];
            $analyticsHOME->area_nombre = $Area->nombre;
            $analyticsHOME->insert();

            $analyticsJugar = new Analytics();
            $analyticsJugar->fecha_creacion = $user['fecha_actualizacion'];
            $analyticsJugar->url = '/jugar';
            $analyticsJugar->usuario_id = $user['usuario_id'];
            $analyticsJugar->nombre_completo = $user['nombre'].''.$user['apellido_paterno'].''.$user['apellido_materno'];
            $analyticsJugar->empresa_id = $user['empresa_id'];
            $analyticsJugar->empresa_nombre = $Empresa->nombre;
            $analyticsJugar->area_id = $user['area_id'];
            $analyticsJugar->area_nombre = $Area->nombre;
            $analyticsJugar->insert();
        }
    }

    public function actionMenuFix() {

        $arrayBase = Yii::app()->params['dataBases'];
        unset($arrayBase['rayalab']);
        foreach ($arrayBase as $key => $value) {
            $url = 'adminAnalytics/fixer?proyect=' . $key . '&base=' . $value['dbname'];
            echo '<br>' . CHtml::link($key, array($url));
        }
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->layout = 'main_admin';


        $this->render('view');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {

        $usuario = Usuario::model()->findByPk(Yii::app()->user->getId());

        if ($usuario->tipo_usuario_id == 2 || $usuario->tipo_usuario_id == 3) {
            $this->layout = 'main_admin';

            //Users
            $sql = 'select count(usuario_id) as contUsuario from usuario where last_login_time = "0000-00-00 00:00:00";';
            $userLogged = Yii::app()->db->createCommand($sql)->queryRow();
            $usuariosNOHanIngresado = $userLogged['contUsuario'];

            $sql = 'select count(usuario_id) as contUsuario from usuario where last_login_time != "0000-00-00 00:00:00";';
            $userLogged = Yii::app()->db->createCommand($sql)->queryRow();
            $usuariosHanIngresado = $userLogged['contUsuario'];

            $usuariosTotal = $usuariosNOHanIngresado + $usuariosHanIngresado;

            //Page views
            $sql = 'SELECT COUNT(analitycs_id) as hits,COUNT(DISTINCT usuario_id) as usuariosUnicos,YEAR(fecha_creacion) as dateYear, MONTH(fecha_creacion) as dateMonth, DAY(fecha_creacion) as dateDay
                    FROM analytics_copy 
                    GROUP BY YEAR(fecha_creacion), MONTH(fecha_creacion), DAY(fecha_creacion)
                    ORDER BY YEAR(fecha_creacion) DESC, MONTH(fecha_creacion) DESC, DAY(fecha_creacion) DESC;';
            $aryDates = Yii::app()->db->createCommand($sql)->queryAll();

            $aryDateLink = array();

            foreach ($aryDates as $date) {

                if ($date['dateMonth'] < 10) {
                    $month = '0' . $date['dateMonth'];
                } else {
                    $month = $date['dateMonth'];
                }

                if ($date['dateDay'] < 10) {
                    $day = '0' . $date['dateDay'];
                } else {
                    $day = $date['dateDay'];
                }

                $aryDateLink[] = array(
                    'hits' => $date['hits'],
                    'usuariosUnicos' => $date['usuariosUnicos'],
                    'date' => $date['dateYear'] . '-' . $month . '-' . $day,
                    'link' => CHtml::link('Ver mas', array('adminAnalytics/day/?fecha=' . $date['dateYear'] . '-' . $month . '-' . $day))
                );
            }

            $table = '<table class="items">
                        <thead>
                        <tr>
                            <th>Hits</th>
                            <th>Usuarios unicos</th>
                            <th>Fecha</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>';
            foreach ($aryDateLink as $dateLink) {
                $table .= '<tr>
                                <td>' . $dateLink['hits'] . '</td>
                                <td>' . $dateLink['usuariosUnicos'] . '</td>
                                <td>' . $dateLink['date'] . '</td>
                                <td><div class="btn-crear">' . $dateLink['link'] . '</div></td>
                            </tr>';
            }

            $table .= '</tbody></table>';

            $this->render('index', array(
                'table' => $table,
                'usuariosHanIngresado' => $usuariosHanIngresado,
                'usuariosNOHanIngresado' => $usuariosNOHanIngresado,
                'usuariosTotal' => $usuariosTotal
            ));
        } else {
            $this->redirect(array('/home'));
        }
    }

    public function actionDescargarUserLogin() {
        $criteria = new CDbCriteria();
        $criteria->addNotInCondition('last_login_time', array('0000-00-00 00:00:00'));

        $aryUser = Usuario::model()->findAll($criteria);
        $this->descargarUserLoginExcel($aryUser);
    }
    
    public function actionDescargarOctavos() {

//        $arrayBase = Yii::app()->params['dataBases'];
//        
//        foreach ($arrayBase as $project => $base) {     
//            if($project == 'rayalab'){
//                continue;
//            }
//            $this->descargarGrupos($project,$base['dbname']);
//        }
        $project = 'enaex';
        $this->descargarOctavos($project,'mundialero_'.$project);
    }
    
    private function descargarOctavos($project=null,$base=null) {
        
        $host = Yii::app()->params['dataBases'][$project]['connectionString'] . $base;
        $username = Yii::app()->params['dataBaseConfig']['user'];
        $psw = Yii::app()->params['dataBaseConfig']['pass'];
        Yii::app()->db->setActive(false);
        Yii::app()->db->connectionString = $host;
        Yii::app()->db->username = $username;
        Yii::app()->db->password = $psw;
        Yii::app()->db->setActive(true);
        
//        $sql = 'SELECT usuario_id
//                FROM prediccion
//                WHERE
//                versus_id < 49
//                GROUP BY usuario_id
//                ORDER BY usuario_id ASC';
//                      
//        $prediccionUsuarioId = '';
//        foreach (Yii::app()->db->createCommand($sql)->queryAll() as $value) {
//            $prediccionUsuarioId .= $value['usuario_id'].",";
//        }
//        $prediccionUsuarioId = rtrim($prediccionUsuarioId, ',');
        
        //fase grupos
        $sql = 'SELECT usuario_id
                FROM usuario
                WHERE
                last_login_time != "0000-00-00 00:00:00"
                ORDER BY usuario_id ASC';
                      
        
        foreach (Yii::app()->db->createCommand($sql)->queryAll() as $value) {
            $prediccionUsuarioId .= $value['usuario_id'].",";
        }
        $prediccionUsuarioId = rtrim($prediccionUsuarioId, ',');
        
        
//        $sql = 'SELECT 
//                    a.usuario_id,a.total_puntos,a.total_plenos,a.email,
//                    a.rut,d.titulo as pais,c.nombre as empresa,b.nombre as area,a.nombre,a.apellido_paterno
//                FROM usuario a, area b, empresa c, usuario_pais d
//                WHERE 
//                    a.usuario_id IN ('.$prediccionUsuarioId.') AND
//                    b.area_id = a.area_id AND
//                    c.empresa_id = a.empresa_id AND
//                    d.usuario_pais = a.usuario_pais_id
//                ORDER BY 
//                    a.total_puntos DESC, a.total_plenos DESC, a.usuario_id DESC;';
        $sql = 'SELECT 
                    a.usuario_id,a.total_puntos,a.total_plenos,a.email,
                    a.rut,a.nombre,a.apellido_paterno, a.empresa_id, a.area_id, a.usuario_pais_id
                FROM usuario a
                WHERE 
                    a.usuario_id IN ('.$prediccionUsuarioId.')
                ORDER BY 
                    a.total_puntos DESC, a.total_plenos DESC, a.usuario_id DESC;';
        
        $aryUsuario = Yii::app()->db->createCommand($sql)->queryAll();
        
        $table = '<table>
                        <thead>
                        <tr>
                            <th>Usuario ID</th>   
                            <th>Total puntos</th>   
                            <th>Total plenos</th>   
                            <th>Rut</th>   
                            <th>Email</th>   
                            <th>Pais</th>  
                            <th>Empresa</th>  
                            <th>Area</th>  
                            <th>Nombre</th>
                        </tr>
                        </thead>
                        <tbody>';
        
        for($i=0;$i<count($aryUsuario);$i++){
            
            $empresa = Yii::app()->db->createCommand('SELECT nombre as empresa FROM empresa WHERE empresa_id = '.$aryUsuario[$i]['empresa_id'])->queryRow();
            $area = Yii::app()->db->createCommand('SELECT nombre as area FROM area WHERE area_id = '.$aryUsuario[$i]['area_id'])->queryRow();
            $pais = Yii::app()->db->createCommand('SELECT titulo as pais FROM usuario_pais WHERE usuario_pais = '.$aryUsuario[$i]['usuario_pais_id'])->queryRow();
            
            $table .= '<tr>
                            <td>' . $aryUsuario[$i]['usuario_id'] . '</td>    
                            <td>' . $aryUsuario[$i]['total_puntos'] . '</td> 
                            <td>' . $aryUsuario[$i]['total_plenos'] . '</td> 
                            <td>' . Yii::app()->aesManager->decrypt($aryUsuario[$i]['rut']) . '</td>
                            <td>' . Yii::app()->aesManager->decrypt($aryUsuario[$i]['email']) . '</td>
                            <td>' . ucwords($pais['pais']) . '</td> 
                            <td>' . ucwords($empresa['empresa']) . '</td> 
                            <td>' . ucwords($area['area']) . '</td> 
                            <td>' . ucwords(Yii::app()->aesManager->decrypt($aryUsuario[$i]['nombre'])) .' '.ucwords(Yii::app()->aesManager->decrypt($aryUsuario[$i]['apellido_paterno'])).'</td> 
                        </tr>';
        }
        
        $table .= '</table>';

        $filename = "Ganadores_Fase_Octavos_".$project.".xls";
        header('Content-Encoding: UTF-8');
        header('Content-type: text/csv; charset=UTF-8');
        header("Content-Disposition: attachment; filename=$filename");
        header("Pragma: public");
        header("Expires: 0");
        echo "\xEF\xBB\xBF"; // UTF-8 BOM
        echo $table;        
    }
    
    public function actionDescargarGrupos() {

//        $arrayBase = Yii::app()->params['dataBases'];
//        
//        foreach ($arrayBase as $project => $base) {     
//            if($project == 'rayalab'){
//                continue;
//            }
//            $this->descargarGrupos($project,$base['dbname']);
//        }
        $project = 'tmfgroup';
        $this->descargarGrupos($project,'mundialero_'.$project);
    }
    
    
    private function descargarGrupos($project=null,$base=null) {
        
        $host = Yii::app()->params['dataBases'][$project]['connectionString'] . $base;
        $username = Yii::app()->params['dataBaseConfig']['user'];
        $psw = Yii::app()->params['dataBaseConfig']['pass'];
        Yii::app()->db->setActive(false);
        Yii::app()->db->connectionString = $host;
        Yii::app()->db->username = $username;
        Yii::app()->db->password = $psw;
        Yii::app()->db->setActive(true);
        
//        $sql = 'SELECT usuario_id
//                FROM prediccion
//                WHERE
//                versus_id < 49
//                GROUP BY usuario_id
//                ORDER BY usuario_id ASC';
//                      
//        $prediccionUsuarioId = '';
//        foreach (Yii::app()->db->createCommand($sql)->queryAll() as $value) {
//            $prediccionUsuarioId .= $value['usuario_id'].",";
//        }
//        $prediccionUsuarioId = rtrim($prediccionUsuarioId, ',');
        
        //fase grupos
        $sql = 'SELECT usuario_id
                FROM usuario
                WHERE
                last_login_time != "0000-00-00 00:00:00"
                ORDER BY usuario_id ASC';
                      
        
        foreach (Yii::app()->db->createCommand($sql)->queryAll() as $value) {
            $prediccionUsuarioId .= $value['usuario_id'].",";
        }
        $prediccionUsuarioId = rtrim($prediccionUsuarioId, ',');
        
        
//        $sql = 'SELECT 
//                    a.usuario_id,a.total_puntos,a.total_plenos,a.email,
//                    a.rut,d.titulo as pais,c.nombre as empresa,b.nombre as area,a.nombre,a.apellido_paterno
//                FROM usuario a, area b, empresa c, usuario_pais d
//                WHERE 
//                    a.usuario_id IN ('.$prediccionUsuarioId.') AND
//                    b.area_id = a.area_id AND
//                    c.empresa_id = a.empresa_id AND
//                    d.usuario_pais = a.usuario_pais_id
//                ORDER BY 
//                    a.total_puntos DESC, a.total_plenos DESC, a.usuario_id DESC;';
        $sql = 'SELECT 
                    a.usuario_id,a.total_puntos,a.total_plenos,a.email,
                    a.rut,a.nombre,a.apellido_paterno, a.empresa_id, a.area_id, a.usuario_pais_id
                FROM usuario a
                WHERE 
                    a.usuario_id IN ('.$prediccionUsuarioId.')
                ORDER BY 
                    a.total_puntos DESC, a.total_plenos DESC, a.usuario_id DESC;';
        
        $aryUsuario = Yii::app()->db->createCommand($sql)->queryAll();
        
        $table = '<table>
                        <thead>
                        <tr>
                            <th>Usuario ID</th>   
                            <th>Total puntos</th>   
                            <th>Total plenos</th>   
                            <th>Rut</th>   
                            <th>Email</th>   
                            <th>Pais</th>  
                            <th>Empresa</th>  
                            <th>Area</th>  
                            <th>Nombre</th>
                        </tr>
                        </thead>
                        <tbody>';
        
        for($i=0;$i<count($aryUsuario);$i++){
            
            $empresa = Yii::app()->db->createCommand('SELECT nombre as empresa FROM empresa WHERE empresa_id = '.$aryUsuario[$i]['empresa_id'])->queryRow();
            $area = Yii::app()->db->createCommand('SELECT nombre as area FROM area WHERE area_id = '.$aryUsuario[$i]['area_id'])->queryRow();
            $pais = Yii::app()->db->createCommand('SELECT titulo as pais FROM usuario_pais WHERE usuario_pais = '.$aryUsuario[$i]['usuario_pais_id'])->queryRow();
            
            $table .= '<tr>
                            <td>' . $aryUsuario[$i]['usuario_id'] . '</td>    
                            <td>' . $aryUsuario[$i]['total_puntos'] . '</td> 
                            <td>' . $aryUsuario[$i]['total_plenos'] . '</td> 
                            <td>' . Yii::app()->aesManager->decrypt($aryUsuario[$i]['rut']) . '</td>
                            <td>' . Yii::app()->aesManager->decrypt($aryUsuario[$i]['email']) . '</td>
                            <td>' . ucwords($pais['pais']) . '</td> 
                            <td>' . ucwords($empresa['empresa']) . '</td> 
                            <td>' . ucwords($area['area']) . '</td> 
                            <td>' . ucwords(Yii::app()->aesManager->decrypt($aryUsuario[$i]['nombre'])) .' '.ucwords(Yii::app()->aesManager->decrypt($aryUsuario[$i]['apellido_paterno'])).'</td> 
                        </tr>';
        }
        
        $table .= '</table>';

        $filename = "Ganadores_Total_".$project.".xls";
        header('Content-Encoding: UTF-8');
        header('Content-type: text/csv; charset=UTF-8');
        header("Content-Disposition: attachment; filename=$filename");
        header("Pragma: public");
        header("Expires: 0");
        echo "\xEF\xBB\xBF"; // UTF-8 BOM
        echo $table;        
    }

    public function actionDescargarPartidoExacto() {
        $versus = Versus::model()->findAll();
         $table = '<table>
                        <thead>
                        <tr>
                            <th>Partido</th>   
                            <th>Pais a</th> 
                            <th></th> 
                            <th>Pais b</th> 
                            <th>Aciertos</th> 
                        </tr>
                        </thead>
                        <tbody>';

        foreach ($versus as $item) {
            $sql = 'SELECT v.pais_id_a, v.pais_id_b,p.versus_id, COUNT(p.prediccion_id) AS aciertos
                    FROM prediccion AS p
                    INNER JOIN versus AS v ON v.versus_id = p.versus_id
                    WHERE p.versus_id = '.$item->versus_id.' AND p.goles_a = '.$item->goles_a.' AND p.goles_b = '.$item->goles_b.'  Group by p.versus_id';
            $Total = Yii::app()->db->createCommand($sql)->queryAll();

            if($Total != null){
                $paisA = Pais::model()->findByPk($Total[0]['pais_id_a']);
                $paisB = Pais::model()->findByPk($Total[0]['pais_id_b']);   
                $table .= '<tr>
                            <td>' . $Total[0]['versus_id'] . '</td>
                            <td>' . $paisA->nombre . '</td>  
                            <td>VS</td>  
                            <td>' . $paisB->nombre. '</td>  
                            <td>' . $Total[0]['aciertos'] . '</td> 
                        </tr>';
            }else{
                
                $versus = Versus::model()->findByPk($item->versus_id);
                $paisA = Pais::model()->findByPk($versus->pais_id_a);
                $paisB = Pais::model()->findByPk($versus->pais_id_b);
                $table .= '<tr>
                            <td>' . $item->versus_id . '</td>
                            <td>' . $paisA->nombre . '</td>  
                            <td>VS</td>  
                            <td>' . $paisB->nombre. '</td>  
                            <td>0</td> 
                        </tr>';
            }
            
            }
            $table .= '</table>';
            $filename = "Aciertos Partidos.xls";
            header('Content-Encoding: UTF-8');
            header('Content-type: text/csv; charset=UTF-8');
            header("Content-Disposition: attachment; filename=$filename");
            header("Pragma: public");
            header("Expires: 0");
            echo "\xEF\xBB\xBF"; // UTF-8 BOM
            echo $table;
        
//        $sql = 'SELECT * FROM prediccion AS p INNER JOIN usuario AS u ON u.usuario_id = p.usuario_id WHERE p.versus_id = 63 and p.goles_a = 0 and p.goles_b = 3';
//        $userLogged = Yii::app()->db->createCommand($sql)->queryAll();
//        $this->descargarUserPartidoExcel($userLogged);
    }


    private function descargarUserPartidoExcel($aryUser) {
        $user = new Usuario();
        $table = '<table>
                        <thead>
                        <tr>
                            <th>Rut</th>   
                            <th>Email</th> 
                            <th>Nombre</th>
                            <th>Empresa</th>
                            <th>Area</th>
                            <th>Brasil</th>
                            <th>Holanda</th>
                        </tr>
                        </thead>
                        <tbody>';

        foreach ($aryUser as $user) {

            $aryEmpresa = Empresa::model()->findByPk($user['empresa_id']);
            $aryArea = Area::model()->findByPk($user['area_id']);
            $table .= '<tr>
                            <td>' . Yii::app()->aesManager->decrypt($user['rut']) . '</td>    
                            <td>' . Yii::app()->aesManager->decrypt($user['email']) . '</td> 
                            <td>' . Yii::app()->aesManager->decrypt($user['nombre']) . ' ' . Yii::app()->aesManager->decrypt($user['apellido_paterno']) . ' ' . Yii::app()->aesManager->decrypt($user['apellido_materno']) . '</td>                                
                            <td>' . $aryEmpresa->nombre . '</td>
                            <td>' . $aryArea->nombre . '</td> 
                            <td>' . $user['goles_a'] . '</td>
                            <td>' . $user['goles_b'] . '</td> 
                        </tr>';
        }

        $table .= '</table>';

        $filename = "MundialeroInforme_PartidoChile.xls";
        header('Content-Encoding: UTF-8');
        header('Content-type: text/csv; charset=UTF-8');
        header("Content-Disposition: attachment; filename=$filename");
        header("Pragma: public");
        header("Expires: 0");
        echo "\xEF\xBB\xBF"; // UTF-8 BOM
        echo $table;
    }

    public function actionDescargarUserLoginNo() {
        $criteria = new CDbCriteria();
        $criteria->addInCondition('last_login_time', array('0000-00-00 00:00:00'));

        $aryUser = Usuario::model()->findAll($criteria);
        $this->descargarUserLoginExcel($aryUser);
    }

    private function descargarUserLoginExcel($aryUser) {
        $user = new Usuario();
        $table = '<table>
                        <thead>
                        <tr>
                            <th>Usuario ID</th>   
                            <th>Email</th> 
                            <th>Nombre</th>
                            <th>Empresa</th>
                            <th>Area</th>
                        </tr>
                        </thead>
                        <tbody>';

        foreach ($aryUser as $user) {

            $table .= '<tr>
                            <td>' . $user->usuario_id . '</td>    
                            <td>' . Yii::app()->aesManager->decrypt($user->email) . '</td> 
                            <td>' . Yii::app()->aesManager->decrypt($user->nombre) . ' ' . Yii::app()->aesManager->decrypt($user->apellido_paterno) . ' ' . Yii::app()->aesManager->decrypt($user->apellido_materno) . '</td>                                
                            <td>' . $user->empresa->nombre . '</td>
                            <td>' . $user->area->nombre . '</td> 
                        </tr>';
        }

        $table .= '</table>';

        $filename = "MundialeroInforme_usuarios.xls";
        header('Content-Encoding: UTF-8');
        header('Content-type: text/csv; charset=UTF-8');
        header("Content-Disposition: attachment; filename=$filename");
        header("Pragma: public");
        header("Expires: 0");
        echo "\xEF\xBB\xBF"; // UTF-8 BOM
        echo $table;
    }

    public function actionDay($fecha = null, $descargar = null) {

        $usuario = Usuario::model()->findByPk(Yii::app()->user->getId());

        if ($usuario->tipo_usuario_id == 2 || $usuario->tipo_usuario_id == 3) {
            $this->layout = 'main_admin';

            $sql = 'SELECT count(analitycs_id) as hits,COUNT(DISTINCT usuario_id) as usuariosUnicos, url
                    FROM analytics_copy 
                    WHERE fecha_creacion LIKE "' . $fecha . '%"
                    GROUP BY url
                    ORDER BY hits DESC;';
            $aryDates = Yii::app()->db->createCommand($sql)->queryAll();

            $aryDateLink = array();

            foreach ($aryDates as $date) {

                $aryDateLink[] = array(
                    'hits' => $date['hits'],
                    'fecha' => $fecha,
                    'usuariosUnicos' => $date['usuariosUnicos'],
                    'url' => $date['url'],
                    'link' => CHtml::link('Ver mas', array('adminAnalytics/dayUrl/?fecha=' . $fecha . '&url=' . $date['url']))
                );
            }

            $table = '<table class="items">
                        <thead>
                        <tr>
                            <th>Hits</th>
                            <th>Fecha</th>
                            <th>Usuarios unicos</th>
                            <th>Url</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>';
            foreach ($aryDateLink as $dateLink) {
                $table .= '<tr>
                                <td>' . $dateLink['hits'] . '</td>
                                <td>' . $dateLink['fecha'] . '</td>
                                <td>' . $dateLink['usuariosUnicos'] . '</td>
                                <td>' . $dateLink['url'] . '</td>
                                <td><div class="btn-crear">' . $dateLink['link'] . '</div></td>
                            </tr>';
            }

            $table .= '</tbody></table>';

            if ($descargar == 'excel') {

                $sql = 'select fecha_creacion,usuario_id, url, empresa_nombre, area_nombre, nombre_completo
                    from analytics_copy 
                    where 
                    fecha_creacion like "' . $fecha . '%"
                    order by fecha_creacion desc;';
                $aryDates = Yii::app()->db->createCommand($sql)->queryAll();

                $aryDateLink = array();

                foreach ($aryDates as $date) {

                    list($nombre, $apellido) = explode(' ', $date['nombre_completo']);

                    $aryDateLink[] = array(
                        'fecha_creacion' => $date['fecha_creacion'],
                        'url' => $date['url'],
                        'empresa_nombre' => $date['empresa_nombre'],
                        'area_nombre' => $date['area_nombre'],
                        'usuario_id' => $date['usuario_id'],
                        'nombre_completo' => Yii::app()->aesManager->decrypt($nombre) . ' ' . Yii::app()->aesManager->decrypt($apellido),
                    );
                }

                $table = '<table>
                        <thead>
                        <tr>
                            <th>Fecha</th>                                                     
                            <th>Url</th>
                            <th>Empresa</th>
                            <th>Area</th>
                            <th>Usuario ID</th>
                            <th>Nombre</th>                            
                        </tr>
                        </thead>
                        <tbody>';
                foreach ($aryDateLink as $dateLink) {
                    $table .= '<tr>
                                <td>' . $dateLink['fecha_creacion'] . '</td>                                
                                <td>' . $dateLink['url'] . '</td>                                
                                <td>' . $dateLink['empresa_nombre'] . '</td>
                                <td>' . $dateLink['area_nombre'] . '</td>
                                <td>' . $dateLink['usuario_id'] . '</td>
                                <td>' . $dateLink['nombre_completo'] . '</td>                                
                            </tr>';
                }

                $table .= '</tbody></table>';

                $filename = "MundialeroInforme_" . $fecha . ".xls";
                header('Content-Encoding: UTF-8');
                header('Content-type: text/csv; charset=UTF-8');
                header("Content-Disposition: attachment; filename=$filename");
                header("Pragma: public");
                header("Expires: 0");
                echo "\xEF\xBB\xBF"; // UTF-8 BOM
                echo $table;
            } else {
                $this->render('day', array(
                    'table' => $table,
                    'fecha' => $fecha
                ));
            }
        } else {
            $this->redirect(array('/home'));
        }
    }

    public function actionDayUrl($fecha = null, $url = null) {

        $usuario = Usuario::model()->findByPk(Yii::app()->user->getId());

        if ($usuario->tipo_usuario_id == 2 || $usuario->tipo_usuario_id == 3) {
            $this->layout = 'main_admin';

            $sql = 'select DISTINCT usuario_id, count(url) as hits, url, empresa_nombre, area_nombre, nombre_completo
                    from analytics_copy 
                    where 
                    fecha_creacion like "' . $fecha . '%" and
                    url like "%' . $url . '%"
                    group by usuario_id
                    order by hits desc;';
            $aryDates = Yii::app()->db->createCommand($sql)->queryAll();

            $aryDateLink = array();

            foreach ($aryDates as $date) {

                list($nombre, $apellido) = explode(' ', $date['nombre_completo']);

                $aryDateLink[] = array(
                    'hits' => $date['hits'],
                    'empresa_nombre' => $date['empresa_nombre'],
                    'area_nombre' => $date['area_nombre'],
                    'usuario_id' => $date['usuario_id'],
                    'nombre_completo' => Yii::app()->aesManager->decrypt($nombre) . ' ' . Yii::app()->aesManager->decrypt($apellido),
                    'link' => CHtml::link('Ver mas', array('adminAnalytics/dayUrlUser/?fecha=' . $fecha . '&url=' . $date['url'] . '&usuario_id=' . $date['usuario_id']))
                );
            }

            $table = '<table class="items">
                        <thead>
                        <tr>
                            <th>Hits</th>                                                
                            <th>Empresa</th>
                            <th>Area</th>
                            <th>Usuario ID</th>
                            <th>Nombre</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>';
            foreach ($aryDateLink as $dateLink) {
                $table .= '<tr>
                                <td>' . $dateLink['hits'] . '</td>                                
                                <td>' . $dateLink['empresa_nombre'] . '</td>
                                <td>' . $dateLink['area_nombre'] . '</td>
                                <td>' . $dateLink['usuario_id'] . '</td>
                                <td>' . $dateLink['nombre_completo'] . '</td>
                                <td><div class="btn-crear">' . $dateLink['link'] . '</div></td>
                            </tr>';
            }

            $table .= '</tbody></table>';

            $info = $url;
            $this->render('day', array(
                'table' => $table,
                'fecha' => $fecha,
                'info' => $info
            ));
        } else {
            $this->redirect(array('/home'));
        }
    }

    public function actionDayUrlUser($fecha = null, $url = null, $usuario_id = null) {

        $usuario = Usuario::model()->findByPk(Yii::app()->user->getId());

        if ($usuario->tipo_usuario_id == 2 || $usuario->tipo_usuario_id == 3) {
            $this->layout = 'main_admin';

            $sql = 'select fecha_creacion,usuario_id, url, empresa_nombre, area_nombre, nombre_completo
                    from analytics_copy 
                    where 
                    fecha_creacion like "' . $fecha . '%" and
                    url like "%' . $url . '%" and 
                    usuario_id = ' . $usuario_id . '
                    order by fecha_creacion desc;';
            $aryDates = Yii::app()->db->createCommand($sql)->queryAll();

            $aryDateLink = array();

            foreach ($aryDates as $date) {

                list($nombre, $apellido) = explode(' ', $date['nombre_completo']);

                $aryDateLink[] = array(
                    'fecha_creacion' => $date['fecha_creacion'],
                    'url' => $date['url'],
                    'empresa_nombre' => $date['empresa_nombre'],
                    'area_nombre' => $date['area_nombre'],
                    'usuario_id' => $date['usuario_id'],
                    'nombre_completo' => Yii::app()->aesManager->decrypt($nombre) . ' ' . Yii::app()->aesManager->decrypt($apellido),
                );
            }

            $table = '<table class="items">
                        <thead>
                        <tr>
                            <th>Fecha</th>                                                     
                            <th>Empresa</th>
                            <th>Area</th>
                            <th>Usuario ID</th>
                            <th>Nombre</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>';
            foreach ($aryDateLink as $dateLink) {
                $table .= '<tr>
                                <td>' . $dateLink['fecha_creacion'] . '</td>                                
                                <td>' . $dateLink['empresa_nombre'] . '</td>
                                <td>' . $dateLink['area_nombre'] . '</td>
                                <td>' . $dateLink['usuario_id'] . '</td>
                                <td>' . $dateLink['nombre_completo'] . '</td>
                                <td><div class="btn-crear">' . $dateLink['link'] . '</div></td>
                            </tr>';
            }

            $table .= '</tbody></table>';
            $info = CHtml::link($url, array('/adminAnalytics/dayUrl/?fecha=' . $fecha . '&url=' . $url));
            $this->render('day', array(
                'table' => $table,
                'fecha' => $fecha,
                'info' => $info
            ));
        } else {
            $this->redirect(array('/home'));
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Analytics the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Analytics::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

}
