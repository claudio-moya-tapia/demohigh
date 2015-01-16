<?php

/**
 * This is the model class for table "documento".
 *
 * The followings are the available columns in table 'documento':
 * @property integer $documento_id
 * @property integer $tipo_documento_id
 * @property string $fecha_creacion
 * @property string $nombre
 * @property string $mimetype
 * @property string $extension
 * @property string $peso
 * @property string $url
 */
class Documento extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'documento';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tipo_documento_id, fecha_creacion, nombre, mimetype, extension, peso, url', 'required'),
			array('tipo_documento_id', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>255),
			array('mimetype, extension, peso', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('documento_id, tipo_documento_id, fecha_creacion, nombre, mimetype, extension, peso, url', 'safe', 'on'=>'search'),
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
			'documento_id' => 'Documento',
			'tipo_documento_id' => 'Tipo Documento',
			'fecha_creacion' => 'Fecha Creacion',
			'nombre' => 'Nombre',
			'mimetype' => 'Mimetype',
			'extension' => 'Extension',
			'peso' => 'Peso',
			'url' => 'Url',
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

		$criteria->compare('documento_id',$this->documento_id);
		$criteria->compare('tipo_documento_id',$this->tipo_documento_id);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('mimetype',$this->mimetype,true);
		$criteria->compare('extension',$this->extension,true);
		$criteria->compare('peso',$this->peso,true);
		$criteria->compare('url',$this->url,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Documento the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
