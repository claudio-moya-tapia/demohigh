<?php

/**
 * This is the model class for table "articulo".
 *
 * The followings are the available columns in table 'articulo':
 * @property integer $articulo_id
 * @property string $fecha_creacion
 * @property string $fecha_actualizacion
 * @property string $titulo
 * @property string $bajada
 * @property string $texto
 * @property string $imagen
 * @property integer $tipo_destacado_id
 * @property TipoDestacado $tipo_destacado
 * @property integer $orden
 * @property integer $estado_articulo_id
 * @property integer $origen_id
 */
class Articulo extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'articulo';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('titulo, bajada, texto, imagen', 'required'),
            array('tipo_destacado_id, estado_articulo_id, origen_id', 'numerical', 'integerOnly' => true),
            array('titulo', 'length', 'max' => 45),
            array('imagen,bajada', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('articulo_id, fecha_creacion, fecha_actualizacion, titulo, texto, imagen, tipo_destacado_id, estado_articulo_id, origen_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'tipo_destacado' => array(self::BELONGS_TO, 'TipoDestacado', 'tipo_destacado_id'),
            'estado_articulo' => array(self::BELONGS_TO, 'EstadoArticulo', 'estado_articulo_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'articulo_id' => 'Articulo',
            'fecha_creacion' => 'Fecha Creacion',
            'fecha_actualizacion' => 'Fecha Actualizacion',
            'titulo' => 'Titulo',
            'texto' => 'Texto',
            'imagen' => 'Imagen',
            'tipo_destacado_id' => 'Destacado',
            'estado_articulo_id' => 'Estado Articulo',
            'origen_id' => 'Origen',
            
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

        $criteria->compare('articulo_id', $this->articulo_id);
        $criteria->compare('fecha_creacion', $this->fecha_creacion, true);
        $criteria->compare('fecha_actualizacion', $this->fecha_actualizacion, true);
        $criteria->compare('titulo', $this->titulo, true);
        $criteria->compare('texto', $this->texto, true);
        $criteria->compare('imagen', $this->imagen, true);
        $criteria->compare('tipo_destacado_id', $this->tipo_destacado_id);
        $criteria->compare('estado_articulo_id', $this->estado_articulo_id);
        $criteria->compare('origen_id', $this->origen_id);
        $criteria->order = 'articulo_id DESC';
        
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Articulo the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
