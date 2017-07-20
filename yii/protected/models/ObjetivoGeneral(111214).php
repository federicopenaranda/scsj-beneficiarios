<?php

/**
 * This is the model class for table "objetivo_general".
 *
 * The followings are the available columns in table 'objetivo_general':
 * @property integer $id_objetivo_general
 * @property integer $fk_id_marco_logico
 * @property string $descripcion_objetivo_general
 *
 * The followings are the available model relations:
 * @property ObjetivoEspecifico[] $objetivoEspecificos
 * @property MarcoLogico $fkIdMarcoLogico
 */
class ObjetivoGeneral extends CTQ
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'objetivo_general';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fk_id_marco_logico, descripcion_objetivo_general', 'required'),
			array('fk_id_marco_logico', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_objetivo_general, fk_id_marco_logico, descripcion_objetivo_general', 'safe', 'on'=>'search'),
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
			'objetivoEspecificos' => array(self::HAS_MANY, 'ObjetivoEspecifico', 'fk_id_objetivo_general'),
			'fkIdMarcoLogico' => array(self::BELONGS_TO, 'MarcoLogico', 'fk_id_marco_logico'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_objetivo_general' => 'Id Objetivo General',
			'fk_id_marco_logico' => 'Fk Id Marco Logico',
			'descripcion_objetivo_general' => 'Descripcion Objetivo General',
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

		$criteria->compare('id_objetivo_general',$this->id_objetivo_general);
		$criteria->compare('fk_id_marco_logico',$this->fk_id_marco_logico);
		$criteria->compare('descripcion_objetivo_general',$this->descripcion_objetivo_general,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ObjetivoGeneral the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
