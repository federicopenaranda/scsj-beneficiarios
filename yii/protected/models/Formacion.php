<?php

/**
 * This is the model class for table "formacion".
 *
 * The followings are the available columns in table 'formacion':
 * @property integer $id_formacion
 * @property string $nombre_formacion
 * @property string $descripcion_formacion
 *
 * The followings are the available model relations:
 * @property Beneficiario[] $beneficiarios
 */
class Formacion extends CTQ
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'formacion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre_formacion', 'required'),
			array('nombre_formacion', 'length', 'max'=>145),
			array('descripcion_formacion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_formacion, nombre_formacion, descripcion_formacion', 'safe', 'on'=>'search'),
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
			'beneficiarios' => array(self::HAS_MANY, 'Beneficiario', 'fk_id_formacion'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_formacion' => 'Id Formacion',
			'nombre_formacion' => 'Nombre Formacion',
			'descripcion_formacion' => 'Descripcion Formacion',
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

		$criteria->compare('id_formacion',$this->id_formacion);
		$criteria->compare('nombre_formacion',$this->nombre_formacion,true);
		$criteria->compare('descripcion_formacion',$this->descripcion_formacion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Formacion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
