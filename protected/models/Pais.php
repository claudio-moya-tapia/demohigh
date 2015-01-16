<?php

/**
 * This is the model class for table "pais".
 *
 * The followings are the available columns in table 'pais':
 * @property integer $pais_id
 * @property string $nombre
 * @property integer $grupo_id
 * @property string $imagen_small
 * @property string $imagen_big
 * @property Grupo $grupo
 */
class Pais extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'pais';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('nombre, grupo_id', 'required'),
            array('grupo_id', 'numerical', 'integerOnly' => true),
            array('nombre', 'length', 'max' => 45),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('pais_id, nombre, grupo_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'grupo' => array(self::BELONGS_TO, 'Grupo', 'grupo_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'pais_id' => 'Pais',
            'nombre' => 'Nombre',
            'grupo_id' => 'Grupo',
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

        $criteria->compare('pais_id', $this->pais_id);
        $criteria->compare('nombre', $this->nombre, true);
        $criteria->compare('grupo_id', $this->grupo_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Pais the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
