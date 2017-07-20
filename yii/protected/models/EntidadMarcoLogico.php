<?php

/**
 * This is the model class for table "entidad_marco_logico".
 *
 * The followings are the available columns in table 'entidad_marco_logico':
 * @property integer $id_entidad_marco_logico
 * @property integer $fk_id_entidad
 * @property integer $fk_id_marco_logico
 * @property integer $estado_entidad_marco_logico
 *
 * The followings are the available model relations:
 * @property MarcoLogico $fkIdMarcoLogico
 * @property Entidad $fkIdEntidad
 */
class EntidadMarcoLogico extends CTQ
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'entidad_marco_logico';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fk_id_entidad, fk_id_marco_logico, estado_entidad_marco_logico', 'required'),
			array('fk_id_entidad, fk_id_marco_logico, estado_entidad_marco_logico', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_entidad_marco_logico, fk_id_entidad, fk_id_marco_logico, estado_entidad_marco_logico', 'safe', 'on'=>'search'),
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
			'fkIdMarcoLogico' => array(self::BELONGS_TO, 'MarcoLogico', 'fk_id_marco_logico'),
			'fkIdEntidad' => array(self::BELONGS_TO, 'Entidad', 'fk_id_entidad'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_entidad_marco_logico' => 'Id Entidad Marco Logico',
			'fk_id_entidad' => 'Fk Id Entidad',
			'fk_id_marco_logico' => 'Fk Id Marco Logico',
			'estado_entidad_marco_logico' => 'Estado Entidad Marco Logico',
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

		$criteria->compare('id_entidad_marco_logico',$this->id_entidad_marco_logico);
		$criteria->compare('fk_id_entidad',$this->fk_id_entidad);
		$criteria->compare('fk_id_marco_logico',$this->fk_id_marco_logico);
		$criteria->compare('estado_entidad_marco_logico',$this->estado_entidad_marco_logico);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EntidadMarcoLogico the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
