<?php

/**
 * This is the model class for table "twitter".
 *
 * The followings are the available columns in table 'twitter':
 * @property integer $twitter_id
 * @property string $fecha_creacion
 * @property integer $usuario_id
 * @property Usuario $usuario
 * @property string $texto
 */
class Twitter extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'twitter_historico';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('fecha_creacion, usuario_id, texto', 'required'),
            array('usuario_id', 'numerical', 'integerOnly' => true),
            array('texto', 'length', 'max' => 140),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('twitter_id, fecha_creacion, usuario_id, texto', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'usuario'=>array(self::BELONGS_TO,'Usuario','usuario_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'twitter_id' => 'Twitter',
            'fecha_creacion' => 'Fecha Creacion',
            'usuario_id' => 'Usuario',
            'texto' => 'Texto',
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

        $criteria->compare('twitter_id', $this->twitter_id);
        $criteria->compare('fecha_creacion', $this->fecha_creacion, true);
        $criteria->compare('usuario_id', $this->usuario_id);
        $criteria->compare('texto', $this->texto, true);
        $criteria->order = 'twitter_id DESC';
        
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Twitter the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
