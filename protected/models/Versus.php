<?php

/**
 * This is the model class for table "versus".
 *
 * The followings are the available columns in table 'versus':
 * @property integer $versus_id
 * @property string $fecha 
 * @property integer $grupo_id
 * @property integer $pais_id_a
 * @property Pais $pais_a
 * @property integer $pais_id_b
 * @property Pais $pais_b
 * @property integer $goles_a
 * @property integer $goles_b
 * @property integer $ganador
 * @property Pais $ganador_pais
 */
class Versus extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'versus';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('fecha', 'required'),
            array('pais_id_a, pais_id_b, goles_a, goles_b, ganador, canplay', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('versus_id, fecha, pais_id_a, pais_id_b, goles_a, goles_b, ganador', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'pais_a' => array(self::BELONGS_TO, 'Pais', 'pais_id_a'),
            'pais_b' => array(self::BELONGS_TO, 'Pais', 'pais_id_b'),
            'ganador_pais' => array(self::BELONGS_TO, 'Pais', 'ganador'),
        );        
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'versus_id' => 'Versus',
            'fecha' => 'Fecha',
            'pais_id_a' => 'Pais A',
            'pais_id_b' => 'Pais B',
            'goles_a' => 'Goles A',
            'goles_b' => 'Goles B',
            'ganador' => 'Ganador',
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
        $criteria->with = array('pais_a','pais_b');
        $criteria->addSearchCondition('pais_a.nombre', $this->pais_id_a);
        $criteria->addSearchCondition('pais_b.nombre', $this->pais_id_b);
        
        $criteria->compare('fecha', $this->fecha, true);        
        $criteria->compare('goles_a', $this->goles_a);
        $criteria->compare('goles_b', $this->goles_b);
        $criteria->compare('ganador', $this->ganador);

        return new CActiveDataProvider($this, array(
                'criteria'=>$criteria,
        ));      
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Versus the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
