<?php

/**
 * This is the model class for table "prediccion".
 *
 * The followings are the available columns in table 'prediccion':
 * @property integer $prediccion_id 
 * @property string $fecha_actualizacion
 * @property integer $usuario_id
 * @property integer $versus_id
 * @property integer $goles_a
 * @property integer $goles_b
 */
class Prediccion extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'prediccion';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('fecha_actualizacion, usuario_id, versus_id', 'required'),
            array('usuario_id, versus_id, goles_a, goles_b', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('prediccion_id, fecha_actualizacion, usuario_id, versus_id, goles_a, goles_b', 'safe', 'on' => 'search'),
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
            'prediccion_id' => 'Prediccion',            
            'fecha_actualizacion' => 'Fecha Actualizacion',
            'usuario_id' => 'Usuario',
            'versus_id' => 'Versus',
            'goles_a' => 'Goles A',
            'goles_b' => 'Goles B',
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

        $criteria->compare('prediccion_id', $this->prediccion_id);        
        $criteria->compare('fecha_actualizacion', $this->fecha_actualizacion, true);
        $criteria->compare('usuario_id', $this->usuario_id);
        $criteria->compare('versus_id', $this->versus_id);
        $criteria->compare('goles_a', $this->goles_a);
        $criteria->compare('goles_b', $this->goles_b);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Prediccion the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
