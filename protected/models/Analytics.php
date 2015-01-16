<?php

/**
 * This is the model class for table "analytics".
 *
 * The followings are the available columns in table 'analytics':
 * @property string $analitycs_id
 * @property string $fecha_creacion
 * @property string $url
 * @property integer $usuario_id
 * @property string $nombre_completo
 * @property integer $empresa_id
 * @property string $empresa_nombre
 * @property integer $area_id
 * @property string $area_nombre
 */
class Analytics extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'analytics';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fecha_creacion, url, usuario_id, nombre_completo, empresa_id, empresa_nombre, area_id, area_nombre', 'required'),
			array('usuario_id, empresa_id, area_id', 'numerical', 'integerOnly'=>true),
			array('url, nombre_completo', 'length', 'max'=>255),
			array('empresa_nombre, area_nombre', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('analitycs_id, fecha_creacion, url, usuario_id, nombre_completo, empresa_id, empresa_nombre, area_id, area_nombre', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'analitycs_id' => 'Analitycs',
			'fecha_creacion' => 'Fecha Creacion',
			'url' => 'Url',
			'usuario_id' => 'Usuario',
			'nombre_completo' => 'Nombre Completo',
			'empresa_id' => 'Empresa',
			'empresa_nombre' => 'Empresa Nombre',
			'area_id' => 'Area',
			'area_nombre' => 'Area Nombre',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('analitycs_id',$this->analitycs_id,true);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('usuario_id',$this->usuario_id);
		$criteria->compare('nombre_completo',$this->nombre_completo,true);
		$criteria->compare('empresa_id',$this->empresa_id);
		$criteria->compare('empresa_nombre',$this->empresa_nombre,true);
		$criteria->compare('area_id',$this->area_id);
		$criteria->compare('area_nombre',$this->area_nombre,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Analytics the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
