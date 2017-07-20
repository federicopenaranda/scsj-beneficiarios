<?php

/**
 * This is the model class for table "beneficiario_estado_civil".
 *
 * The followings are the available columns in table 'beneficiario_estado_civil':
 * @property integer $id_beneficiario_estado_civil
 * @property integer $fk_id_estado_civil
 * @property integer $fk_id_beneficiario
 * @property string $fecha_asignacion_beneficiario_estado_civil
 * @property integer $estado_beneficiario_estado_civil
 *
 * The followings are the available model relations:
 * @property Beneficiario $fkIdBeneficiario
 * @property EstadoCivil $fkIdEstadoCivil
 */
class BeneficiarioEstadoCivil extends CTQ
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'beneficiario_estado_civil';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fk_id_estado_civil, fk_id_beneficiario, estado_beneficiario_estado_civil', 'required'),
			array('fk_id_estado_civil, fk_id_beneficiario, estado_beneficiario_estado_civil', 'numerical', 'integerOnly'=>true),
			array('fecha_asignacion_beneficiario_estado_civil', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_beneficiario_estado_civil, fk_id_estado_civil, fk_id_beneficiario, fecha_asignacion_beneficiario_estado_civil, estado_beneficiario_estado_civil', 'safe', 'on'=>'search'),
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
			'fkIdBeneficiario' => array(self::BELONGS_TO, 'Beneficiario', 'fk_id_beneficiario'),
			'fkIdEstadoCivil' => array(self::BELONGS_TO, 'EstadoCivil', 'fk_id_estado_civil'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_beneficiario_estado_civil' => 'Id Beneficiario Estado Civil',
			'fk_id_estado_civil' => 'Fk Id Estado Civil',
			'fk_id_beneficiario' => 'Fk Id Beneficiario',
			'fecha_asignacion_beneficiario_estado_civil' => 'Fecha Asignacion Beneficiario Estado Civil',
			'estado_beneficiario_estado_civil' => 'Estado Beneficiario Estado Civil',
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

		$criteria->compare('id_beneficiario_estado_civil',$this->id_beneficiario_estado_civil);
		$criteria->compare('fk_id_estado_civil',$this->fk_id_estado_civil);
		$criteria->compare('fk_id_beneficiario',$this->fk_id_beneficiario);
		$criteria->compare('fecha_asignacion_beneficiario_estado_civil',$this->fecha_asignacion_beneficiario_estado_civil,true);
		$criteria->compare('estado_beneficiario_estado_civil',$this->estado_beneficiario_estado_civil);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BeneficiarioEstadoCivil the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
