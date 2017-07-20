<?php

/**
 * This is the model class for table "marco_logico".
 *
 * The followings are the available columns in table 'marco_logico':
 * @property integer $id_marco_logico
 * @property string $fecha_marco_logico
 * @property string $codigo_marco_logico
 *
 * The followings are the available model relations:
 * @property EntidadMarcoLogico[] $entidadMarcoLogicos
 * @property ObjetivoGeneral[] $objetivoGenerals
 */
class MarcoLogico extends CTQ
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'marco_logico';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fecha_marco_logico, codigo_marco_logico', 'required'),
			array('codigo_marco_logico', 'length', 'max'=>150),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_marco_logico, fecha_marco_logico, codigo_marco_logico', 'safe', 'on'=>'search'),
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
			'entidadMarcoLogicos' => array(self::HAS_MANY, 'EntidadMarcoLogico', 'fk_id_marco_logico'),
			'objetivoGenerals' => array(self::HAS_MANY, 'ObjetivoGeneral', 'fk_id_marco_logico'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_marco_logico' => 'Id Marco Logico',
			'fecha_marco_logico' => 'Fecha Marco Logico',
			'codigo_marco_logico' => 'Codigo Marco Logico',
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

		$criteria->compare('id_marco_logico',$this->id_marco_logico);
		$criteria->compare('fecha_marco_logico',$this->fecha_marco_logico,true);
		$criteria->compare('codigo_marco_logico',$this->codigo_marco_logico,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MarcoLogico the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
