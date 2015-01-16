<?php

/**
 * This is the model class for table "premio".
 *
 * The followings are the available columns in table 'premio':
 * @property integer $premio_id
 * @property string $fecha_creacion
 * @property string $titulo
 * @property string $texto
 * @property string $imagen
 */
class Premio extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'premio';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('titulo, texto, imagen', 'required'),
            array('titulo', 'length', 'max' => 45),
            array('imagen', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('premio_id, fecha_creacion, titulo, texto, imagen', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'premio_id' => 'Premio',
            'fecha_creacion' => 'Fecha Creacion',
            'titulo' => 'Titulo',
            'texto' => 'Texto',
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

        $criteria->compare('premio_id', $this->premio_id);
        $criteria->compare('fecha_creacion', $this->fecha_creacion, true);
        $criteria->compare('titulo', $this->titulo, true);
        $criteria->compare('texto', $this->texto, true);
        $criteria->compare('imagen', $this->imagen, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Premio the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
