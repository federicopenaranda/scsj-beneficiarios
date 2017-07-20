<?php

/**
 * This is the model class for table "historia_social".
 *
 * The followings are the available columns in table 'historia_social':
 * @property integer $id_historia_social
 * @property integer $fk_id_beneficiario
 * @property string $historia_social
 * @property string $dinamica_familiar_historia_social
 * @property string $situacion_actual_historia_social
 * @property integer $estado_historia_social
 *
 * The followings are the available model relations:
 * @property Beneficiario $fkIdBeneficiario
 */
class HistoriaSocial extends CTQ
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'historia_social';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fk_id_beneficiario, estado_historia_social', 'required'),
			array('fk_id_beneficiario, estado_historia_social', 'numerical', 'integerOnly'=>true),
			array('historia_social, dinamica_familiar_historia_social, situacion_actual_historia_social', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_historia_social, fk_id_beneficiario, historia_social, dinamica_familiar_historia_social, situacion_actual_historia_social, estado_historia_social', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_historia_social' => 'Id Historia Social',
			'fk_id_beneficiario' => 'Fk Id Beneficiario',
			'historia_social' => 'Historia Social',
			'dinamica_familiar_historia_social' => 'Dinamica Familiar Historia Social',
			'situacion_actual_historia_social' => 'Situacion Actual Historia Social',
			'estado_historia_social' => 'Estado Historia Social',
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

		$criteria->compare('id_historia_social',$this->id_historia_social);
		$criteria->compare('fk_id_beneficiario',$this->fk_id_beneficiario);
		$criteria->compare('historia_social',$this->historia_social,true);
		$criteria->compare('dinamica_familiar_historia_social',$this->dinamica_familiar_historia_social,true);
		$criteria->compare('situacion_actual_historia_social',$this->situacion_actual_historia_social,true);
		$criteria->compare('estado_historia_social',$this->estado_historia_social);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return HistoriaSocial the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    public function getNameKey() {
		return 'id_historia_social';
    }
    
    public function getNameFKey() {
    	return array(
				'fk_id_beneficiario'=>array('beneficiario','id_beneficiario'),
		);
    }
    
    public function getHasOne(){
		return array(
		);
	}
    
    public function getBelonsTo(){
		return array(
				'Beneficiario',
		);
	}

	public function getHasMany(){
		return array(
		);
	}

	public function getManyMany(){
		return array(
		);
	}
}
