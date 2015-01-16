<?php

class JugarController extends Controller {

    public $layout = '//layouts/column2';

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations            
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'versus', 'paises', 'cuartosOctavos', 'final'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionCuartosOctavos() {
        
        //echo Yii::app()->aesManager->decrypt('392bfd572525dfe1d48885ca5be4b38c');
        $this->render('cuartos_octavos');
    }

    public function actionFinal() {

        $this->render('final');
    }

    /**
     * Solo utilizada para generar el JavaScript estatico necesario
     * para el metodo getPaises() en shared.js
     */
    /* @var $pais Pais */
    public function actionPaises() {
        $listPais = Pais::model()->findAll();
        $jsOutput = "var aryPaises = new Array();";

        foreach ($listPais as $pais) {
            $jsOutput .= "
                
            var grupo = new Grupo();
            grupo.grupo_id = " . $pais->grupo_id . ";
            grupo.nombre = '" . $pais->grupo->nombre . "';

            var pais = new Pais();
            pais.pais_id = " . $pais->pais_id . ";
            pais.nombre = '" . $pais->nombre . "';
            pais.grupo = grupo;

            aryPaises.push(pais);";
        }

        echo $jsOutput;
    }

    /**
     * Solo utilizada para generar el JavaScript estatico necesario
     * para el metodo getVersus() en shared.js
     */
    /* @var $versus Versus */
    public function actionVersus() {

        $listVersus = Versus::model()->findAll();

        $jsOutput = "var aryVersus = new Array();";

        foreach ($listVersus as $versus) {

            if ($versus->pais_id_a != 0) {

                $jsOutput .= "
                
                var grupo = new Grupo();
                grupo.grupo_id = " . $versus->pais_a->grupo_id . ";
                grupo.nombre = '" . $versus->pais_a->grupo->nombre . "';

                var paisA = new Pais();
                paisA.pais_id = " . $versus->pais_id_a . ";
                paisA.nombre = '" . $versus->pais_a->nombre . "';
                paisA.grupo = grupo;

                var paisB = new Pais();
                paisB.pais_id = " . $versus->pais_id_b . ";
                paisB.nombre = '" . $versus->pais_b->nombre . "';
                paisB.grupo = grupo;
                
                //parse fecha
                var dateTimeVersus = new String('" . $versus->fecha . "');
                var aryDateVersus = dateTimeVersus.split(' ');

                var dateVersusFecha = aryDateVersus[0];
                var dateVersusHora = aryDateVersus[1];

                var aryFecha = dateVersusFecha.split('-');
                var aryaHora = dateVersusHora.split(':');

                var year = aryFecha[0];
                var month = parseInt(aryFecha[1]) - 1;
                var day = aryFecha[2];
                var hour = aryaHora[0];
                var mins = aryaHora[1];

                var dateVersus = new Date(year, month, day, hour, mins, 0, 0);

                var versus = new Versus();
                versus.versus_id = " . $versus->versus_id . ";    
                versus.fecha = dateVersus;
                versus.paisA = paisA;
                versus.paisB = paisB;
                versus.golesA = 0;
                versus.golesB = 0;
                versus.ganador = paisA;

                aryVersus.push(versus);";
            }
        }

        echo $jsOutput;
    }

    /* @var $versus Versus */
    /* @var $pais_a Pais */
    /* @var $pais_b Pais */
    /* @var $prediccion Prediccion */

    public function actionIndex() {

//        if(Yii::app()->session['project'] == 'dcv'){
//            
//            $usuario = Usuario::model()->findByPk(Yii::app()->user->id);
//            $area_id = $usuario->area_id;
//            $criteria = new CDbCriteria();
//            $criteria->addInCondition('empresa_id', array('2'));
//            $criteria->addInCondition('area_id', array($area_id));
//            $usuario = Usuario::model()->find($criteria);
//            $usuario_id = $usuario->usuario_id;
//                         
//        }else{
//            $usuario_id = Yii::app()->user->id;
//        }
//        
//        $criteria = new CDbCriteria();            
//        $criteria->order = 'pais_a.grupo_id ASC, fecha ASC';        
//        $listVersus = Versus::model()
//                ->with('pais_a')
//                ->findAll($criteria);
//                
//        $criteria = new CDbCriteria();
//        $criteria->compare('usuario_id', $usuario_id);
//        $listPrediccion = Prediccion::model()->findAll($criteria);
//                
//        $listGrupos = array();
//        $aryTabla = array();
//        $prediccionEmpty = new Prediccion();
//                
//        foreach($listVersus as $versus){
//            
//            if($versus->pais_a != 0){
//                
//                $listGrupos[$versus->pais_a->grupo->nombre]['grupo_id'] = $versus->pais_a->grupo->grupo_id;
//                $listGrupos[$versus->pais_a->grupo->nombre]['versus'][] = $versus;                        
//                $listGrupos[$versus->pais_a->grupo->nombre]['tabla_posiciones'][$versus->pais_id_a] = $versus->pais_id_a;            
//                $aryTabla[$versus->pais_id_a]['PJ'] = 0;
//                $aryTabla[$versus->pais_id_a]['PG'] = 0;
//                $aryTabla[$versus->pais_id_a]['PE'] = 0;
//                $aryTabla[$versus->pais_id_a]['PP'] = 0;
//                $aryTabla[$versus->pais_id_a]['GF'] = 0;
//                $aryTabla[$versus->pais_id_a]['GC'] = 0;
//                $aryTabla[$versus->pais_id_a]['DIF'] = 0;
//                $aryTabla[$versus->pais_id_a]['PTS'] = 0;
//
//                $listGrupos[$versus->pais_a->grupo->nombre]['tabla_posiciones'][$versus->pais_id_b] = $versus->pais_id_b;
//                $aryTabla[$versus->pais_id_b]['PJ'] = 0;
//                $aryTabla[$versus->pais_id_b]['PG'] = 0;
//                $aryTabla[$versus->pais_id_b]['PE'] = 0;
//                $aryTabla[$versus->pais_id_b]['PP'] = 0;
//                $aryTabla[$versus->pais_id_b]['GF'] = 0;
//                $aryTabla[$versus->pais_id_b]['GC'] = 0;
//                $aryTabla[$versus->pais_id_b]['DIF'] = 0;
//                $aryTabla[$versus->pais_id_b]['PTS'] = 0;
//
//                $listGrupos[$versus->pais_a->grupo->nombre]['predicciones'][$versus->versus_id] = $prediccionEmpty;
//                foreach($listPrediccion as $prediccion){                  
//                    if($versus->versus_id == $prediccion->versus_id){
//                        $listGrupos[$versus->pais_a->grupo->nombre]['predicciones'][$versus->versus_id] = $prediccion;
//                        break;
//                    }
//                }    
//            }
//        }
//        
//        foreach($listGrupos as $grupoNombre=>$aryVersus){
//                       
//            foreach($aryVersus['tabla_posiciones'] as $pais_id){
//                                
//                foreach($aryVersus['versus'] as $versus){
//                     
//                    if( ($versus->pais_id_a == $pais_id) || ($versus->pais_id_b == $pais_id) ){
//                                                                        
//                        if($versus->pais_id_a == $pais_id){
//                            $aryTabla[$pais_id]['nombre'] = $versus->pais_a->nombre;
//                            $aryTabla[$pais_id]['bandera'] = $versus->pais_a->imagen_small;
//                        }else if($versus->pais_id_b == $pais_id){
//                            $aryTabla[$pais_id]['nombre'] = $versus->pais_b->nombre;
//                            $aryTabla[$pais_id]['bandera'] = $versus->pais_b->imagen_small;
//                        }
//                    }
//                }
//            }
//        }
//        
//        $this->render('index',array(
//            'listVersus'=>$listVersus,
//            'listGrupos'=>$listGrupos,
//            'aryTabla'=>$aryTabla,
//            'listPrediccion'=>$listPrediccion
//        ));

        $this->render('index_estatico');
    }

}
