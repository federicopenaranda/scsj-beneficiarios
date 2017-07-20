<?php

/**
 * This is the model class for table "parentesco".
 *
 * The followings are the available columns in table 'parentesco':
 * @property integer $fk_id_beneficiario
 * @property integer $fk_id_beneficiario1
 * @property integer $responsable_beneficiario
 *
 * The followings are the available model relations:
 * @property Beneficiario $fkIdBeneficiario
 * @property Beneficiario $fkIdBeneficiario1
 */
class Parentesco extends CTQ
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'parentesco';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fk_id_beneficiario, fk_id_beneficiario1, responsable_beneficiario', 'required'),
			array('fk_id_beneficiario, fk_id_beneficiario1, responsable_beneficiario', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('fk_id_beneficiario, fk_id_beneficiario1, responsable_beneficiario', 'safe', 'on'=>'search'),
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
			'fkIdBeneficiario1' => array(self::BELONGS_TO, 'Beneficiario', 'fk_id_beneficiario1'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'fk_id_beneficiario' => 'Fk Id Beneficiario',
			'fk_id_beneficiario1' => 'Fk Id Beneficiario1',
			'responsable_beneficiario' => 'Responsable Beneficiario',
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

		$criteria->compare('fk_id_beneficiario',$this->fk_id_beneficiario);
		$criteria->compare('fk_id_beneficiario1',$this->fk_id_beneficiario1);
		$criteria->compare('responsable_beneficiario',$this->responsable_beneficiario);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Parentesco the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
