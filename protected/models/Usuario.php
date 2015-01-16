<?php

/**
 * This is the model class for table "usuario".
 *
 * The followings are the available columns in table 'usuario':
 * @property integer $usuario_id
 * @property string $fecha_nacimiento
 * @property string $fecha_creacion
 * @property string $last_login_time
 * @property string $user
 * @property string $pass
 * @property string $rut
 * @property string $nombre
 * @property string $apellido_paterno
 * @property string $apellido_materno
 * @property string $nickname
 * @property string $email
 * @property integer $empresa_id
 * @property Empresa $empresa
 * @property integer $area_id
 * @property Area $area
 * @property string $imagen
 * @property integer $total_puntos
 * @property integer $total_jugados
 * @property integer $total_plenos
 * @property integer $rank
 * @property string $amigos_usuario_id
 * @property integer $tipo_estado_usuario_id
 * @property integer $tipo_usuario_id
 * @property int $usuario_pais_id
 * @property UsuarioPais $usuario_pais 
 */
class Usuario extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'usuario';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(            
            array('empresa_id, area_id, tipo_estado_usuario_id, tipo_usuario_id, usuario_pais_id', 'numerical', 'integerOnly' => true),
            //array('user, pass, nickname', 'length', 'max' => 255),
            //array('rut, nombre, apellido_paterno, apellido_materno, email, imagen', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('usuario_id, fecha_nacimiento, fecha_creacion, last_login_time, user, pass, rut, nombre, apellido_paterno, apellido_materno, nickname, email, empresa_id, area_id, tipo_estado_usuario_id, tipo_usuario_id, usuario_pais_id, imagen', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'empresa'=>array(self::BELONGS_TO,'Empresa','empresa_id'),
            'area'=>array(self::BELONGS_TO,'Area','area_id'),
            'tipo_estado_usuario'=>array(self::BELONGS_TO,'TipoEstadoUsuario','tipo_estado_usuario_id'),
            'tipo_usuario'=>array(self::BELONGS_TO,'TipoUsuario','tipo_usuario_id'),
            'usuario_pais'=>array(self::BELONGS_TO,'UsuarioPais','usuario_pais_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'usuario_id' => 'Usuario',
            'fecha_nacimiento' => 'Fecha Nacimiento',
            'fecha_creacion' => 'Fecha Creacion',
            'last_login_time' => 'Last Login Time',
            'user' => 'User',
            'pass' => 'Pass',
            'rut' => 'Rut',
            'nombre' => 'Nombre',
            'apellido_paterno' => 'Apellido Paterno',
            'apellido_materno' => 'Apellido Materno',
            'nickname' => 'Nickname',
            'email' => 'Email',
            'empresa_id' => 'Empresa',
            'area_id' => 'Area',
            'tipo_estado_usuario_id' => 'Tipo Estado Usuario',
            'tipo_usuario_id' => 'Tipo Usuario',
            'usuario_pais_id' => 'Usuario Pais',
            'imagen' => 'Imagen',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('usuario_id', $this->usuario_id);
        $criteria->compare('fecha_nacimiento', $this->fecha_nacimiento, true);
        $criteria->compare('fecha_creacion', $this->fecha_creacion, true);
        $criteria->compare('last_login_time', $this->last_login_time, true);
        $criteria->compare('user' ,Yii::app()->aesManager->encrypt(strtolower($this->user)), true);
        $criteria->compare('pass', Yii::app()->aesManager->encrypt(strtolower($this->pass)), true);
        $criteria->compare('rut', Yii::app()->aesManager->encrypt(strtolower($this->rut)), true);
        $criteria->compare('nombre', Yii::app()->aesManager->encrypt(strtolower($this->nombre)), true);
        $criteria->compare('apellido_paterno', Yii::app()->aesManager->encrypt(strtolower($this->apellido_paterno)), true);
        $criteria->compare('apellido_materno', Yii::app()->aesManager->encrypt(strtolower($this->apellido_materno)), true);
        $criteria->compare('nickname', Yii::app()->aesManager->encrypt(strtolower($this->nickname)), true);
        $criteria->compare('email', Yii::app()->aesManager->encrypt(strtolower($this->email)), true);
        $criteria->compare('empresa_id', $this->empresa_id);
        $criteria->compare('area_id', $this->area_id);
        $criteria->compare('tipo_usuario_id', $this->tipo_usuario_id);
        $criteria->compare('tipo_estado_usuario', $this->tipo_estado_usuario_id);
        $criteria->compare('usuario_pais', $this->usuario_pais_id);
        $criteria->compare('imagen', $this->imagen, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Usuario the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
