<?php

/**
 * This is the model class for table "comentario".
 *
 * The followings are the available columns in table 'comentario':
 * @property integer $comentario_id
 * @property integer $articulo_id
 * @property integer $usuario_id
 * @property string $texto
 * @property string $fecha_creacion
 */
class Comentario extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'comentario';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('articulo_id, usuario_id, texto, fecha_creacion', 'required'),
            array('articulo_id, usuario_id', 'numerical', 'integerOnly' => true),
            array('texto', 'length', 'max' => 8000),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('comentario_id, articulo_id, usuario_id, texto, fecha_creacion', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'articulo' => array(self::BELONGS_TO, 'Articulo', 'articulo_id'),
            'usuario' => array(self::BELONGS_TO, 'Usuario', 'usuario_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'comentario_id' => 'Comentario',
            'articulo_id' => 'Articulo',
            'usuario_id' => 'Usuario',
            'texto' => 'Texto',
            'fecha_creacion' => 'Fecha Creacion',
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

        $criteria->compare('comentario_id', $this->comentario_id);
        $criteria->compare('articulo_id', $this->articulo_id);
        $criteria->compare('usuario_id', $this->usuario_id);
        $criteria->compare('texto', $this->texto, true);
        $criteria->compare('fecha_creacion', $this->fecha_creacion, true);
        $criteria->order = 'comentario_id DESC';
                
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Comentario the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
