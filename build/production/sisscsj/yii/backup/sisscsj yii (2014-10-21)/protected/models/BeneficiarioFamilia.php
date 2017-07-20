<?php

/**
 * This is the model class for table "beneficiario_familia".
 *
 * The followings are the available columns in table 'beneficiario_familia':
 * @property integer $id_beneficiario_familia
 * @property integer $fk_id_beneficiario
 * @property integer $fk_id_familia
 * @property integer $fk_id_tipo_parentesco
 * @property integer $vive_casa_beneficiario_familia
 * @property integer $estado_beneficiario_familia
 * @property string $fecha_creacion_beneficiario_familia
 *
 * The followings are the available model relations:
 * @property Beneficiario $fkIdBeneficiario
 * @property Familia $fkIdFamilia
 * @property TipoParentesco $fkIdTipoParentesco
 */
class BeneficiarioFamilia extends CTQ
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'beneficiario_familia';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fk_id_beneficiario, fk_id_familia, fk_id_tipo_parentesco, estado_beneficiario_familia', 'required'),
			array('fk_id_beneficiario, fk_id_familia, fk_id_tipo_parentesco, vive_casa_beneficiario_familia, estado_beneficiario_familia', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_beneficiario_familia, fk_id_beneficiario, fk_id_familia, fk_id_tipo_parentesco, vive_casa_beneficiario_familia, estado_beneficiario_familia, fecha_creacion_beneficiario_familia', 'safe', 'on'=>'search'),
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
			'fkIdFamilia' => array(self::BELONGS_TO, 'Familia', 'fk_id_familia'),
			'fkIdTipoParentesco' => array(self::BELONGS_TO, 'TipoParentesco', 'fk_id_tipo_parentesco'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_beneficiario_familia' => 'Id Beneficiario Familia',
			'fk_id_beneficiario' => 'Fk Id Beneficiario',
			'fk_id_familia' => 'Fk Id Familia',
			'fk_id_tipo_parentesco' => 'Fk Id Tipo Parentesco',
			'vive_casa_beneficiario_familia' => 'Vive Casa Beneficiario Familia',
			'estado_beneficiario_familia' => 'Estado Beneficiario Familia',
			'fecha_creacion_beneficiario_familia' => 'Fecha Creacion Beneficiario Familia',
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

		$criteria->compare('id_beneficiario_familia',$this->id_beneficiario_familia);
		$criteria->compare('fk_id_beneficiario',$this->fk_id_beneficiario);
		$criteria->compare('fk_id_familia',$this->fk_id_familia);
		$criteria->compare('fk_id_tipo_parentesco',$this->fk_id_tipo_parentesco);
		$criteria->compare('vive_casa_beneficiario_familia',$this->vive_casa_beneficiario_familia);
		$criteria->compare('estado_beneficiario_familia',$this->estado_beneficiario_familia);
		$criteria->compare('fecha_creacion_beneficiario_familia',$this->fecha_creacion_beneficiario_familia,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BeneficiarioFamilia the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
