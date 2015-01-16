<?php

require_once 'google/appengine/api/cloud_storage/CloudStorageTools.php';

use google\appengine\api\cloud_storage\CloudStorageTools;

class DocumentoController extends Controller {

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
                'actions' => array('create', 'update', 'formulario', 'uploader', 'getGSUrl'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionFormulario() {

        $this->layout = false;
        $options = [ 'gs_bucket_name' => 'mundialerotest1.appspot.com'];
        $upload_url = CloudStorageTools::createUploadUrl('/documento/uploader', $options);

        echo '<form action="' . $upload_url . '" enctype="multipart/form-data" method="post">
					Files to upload: <br>
				   <input type="file" name="uploaded_files" size="40">
				   <input type="submit" value="Send">
				</form>';
    }

    public function actionUploader() {
        
        $gs_name = $_FILES['uploaded_files']['tmp_name'];
        //move_uploaded_file($gs_name, 'gs://mundialerotest1.appspot.com/new_photo.jpg');
    }

    public function actionGetGSUrl($resize = 100) {
        $options = [ 'gs_bucket_name' => Yii::app()->params['gsBucket']];
        $url = CloudStorageTools::createUploadUrl('/documento/create?resize=' . $resize, $options);

        echo CJSON::encode(array('url' => $url));
    }

    /**
     * Creates a new model.
     */
    public function actionCreate($resize = 100) {

        if ($UploadFile = CUploadedFile::getInstanceByName('Filedata')) {
            Yii::app()->useDatabase->now();
            $gsHttpBase = Yii::app()->params['baseUrlImg']; //'http://mundialerotest1.appspot.com.storage.googleapis.com';
            $gsRoot = Yii::app()->params['baseUrlGs']; //'gs://mundialerotest1.appspot.com';
            $imageName = '';
            $imageSource = '';
            $imageRootGS = '';
            $imageDestiny = '';
            $DateTime = new DateTime('NOW');

            $imageName = date('Y_m_d_H_i_s_') . '_' . rand(100000, 999999) . '.' . $UploadFile->getExtensionName();
            $imageRootGS = $gsRoot . '/' . $imageName;
            $UploadFile->saveAs($imageRootGS);

            $dir = $this->uploadCreateDateFolder();

            $imageDestiny = $dir . $imageName;

            $options = [ 'gs' => [ 'Content-Type' => 'image/jpeg', 'acl' => 'public-read']];
            $ctx = stream_context_create($options);
            rename($imageRootGS, $imageDestiny, $ctx);

            //Image Resize
            $fileContent = file_get_contents(CloudStorageTools::getImageServingUrl($imageDestiny, ['size' => intval($resize)]));
            file_put_contents($gsRoot . '/' . $imageName, $fileContent);

            $options = [ 'gs' => [ 'Content-Type' => 'image/jpeg', 'acl' => 'public-read']];
            $ctx = stream_context_create($options);
            rename($imageRootGS, $imageDestiny, $ctx);

            $httpOriginal = str_replace($gsHttpBase, '', CloudStorageTools::getPublicUrl($imageDestiny, false));

            $Documento = new Documento();
            $Documento->tipo_documento_id = 1;
            $Documento->fecha_creacion = $DateTime->format('Y-m-d H:i:s');
            $Documento->nombre = $UploadFile->getName();
            $Documento->mimetype = 'image/jpeg';
            $Documento->extension = $UploadFile->getExtensionName();
            $Documento->peso = $UploadFile->getSize();
            $Documento->url = $httpOriginal;
            $Documento->insert();

            $response = array(
                'documento_id' => $Documento->documento_id,
                'tipo_documento_id' => $Documento->tipo_documento_id,
                'fecha_creacion' => $Documento->fecha_creacion,
                'nombre' => $Documento->nombre,
                'mimetype' => $Documento->mimetype,
                'extension' => $Documento->extension,
                'peso' => $Documento->peso,
                'url' => $httpOriginal
            );
        } else {
            $response = array(
                'documento_id' => '',
                'tipo_documento_id' => '',
                'fecha_creacion' => '',
                'nombre' => '',
                'mimetype' => '',
                'extension' => '',
                'peso' => '',
                'url' => ''
            );
        }

        $this->layout = false;
        echo CJSON::encode($response);
    }

    private function uploadCreateDateFolder() {
        /**
         * Crear directorio de la fecha de hoy
         */
        $folderDate = array(date('Y'), date('m'), date('d'));
        //$dir = Yii::getPathOfAlias('webroot') . '/upload/';
        $dir = Yii::app()->params['baseUrlGs'] . '/upload/';

        foreach ($folderDate as $f => $folder) {
            $directorio = $dir . $folder;
            if (!is_dir($directorio)) {
                mkdir($directorio, 0777, true);
                chmod($directorio, 0777);
                $dir .= $folder . '/';
            } else {
                $dir .= $folder . '/';
            }
        }

        return $dir;
    }

   
    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Documento the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Documento::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Documento $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'documento-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
