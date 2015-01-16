<?php

/**
 * This is the model class for table "like_galeria".
 *
 * The followings are the available columns in table 'like_galeria':
 * @property integer $like_galeria_id
 * @property integer $galeria_id
 * @property integer $usuario_id
 * @property string $fecha_creacion
 */
class LikeGaleria extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'like_galeria';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('galeria_id, usuario_id, fecha_creacion', 'required'),
			array('galeria_id, usuario_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('like_galeria_id, galeria_id, usuario_id, fecha_creacion', 'safe', 'on'=>'search'),
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
                    'galeria' => array(self::BELONGS_TO, 'Galeria', 'galeria_id'),
                    'usuario' => array(self::BELONGS_TO, 'Usuario', 'usuario_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'like_galeria_id' => 'Like Galeria',
			'galeria_id' => 'Galeria',
			'usuario_id' => 'Usuario',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('like_galeria_id',$this->like_galeria_id);
		$criteria->compare('galeria_id',$this->galeria_id);
		$criteria->compare('usuario_id',$this->usuario_id);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LikeGaleria the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
