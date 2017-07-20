<?php

/**
 * This is the model class for table "beneficiario_patrocinador".
 *
 * The followings are the available columns in table 'beneficiario_patrocinador':
 * @property integer $id_beneficiario_patrocinador
 * @property integer $fk_id_beneficiario
 * @property string $numero_caso_beneficiario_patrocinador
 * @property string $numero_ninio_beneficiario_patrocinador
 * @property string $codigo_donante_beneficiario_patrocinador
 * @property string $nombre_patrocinador_beneficiario_patrocinador
 *
 * The followings are the available model relations:
 * @property Beneficiario $fkIdBeneficiario
 */
class BeneficiarioPatrocinador extends CTQ
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'beneficiario_patrocinador';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fk_id_beneficiario', 'required'),
			array('fk_id_beneficiario', 'numerical', 'integerOnly'=>true),
			array('numero_caso_beneficiario_patrocinador, numero_ninio_beneficiario_patrocinador, codigo_donante_beneficiario_patrocinador, nombre_patrocinador_beneficiario_patrocinador', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_beneficiario_patrocinador, fk_id_beneficiario, numero_caso_beneficiario_patrocinador, numero_ninio_beneficiario_patrocinador, codigo_donante_beneficiario_patrocinador, nombre_patrocinador_beneficiario_patrocinador', 'safe', 'on'=>'search'),
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
			'id_beneficiario_patrocinador' => 'Id Beneficiario Patrocinador',
			'fk_id_beneficiario' => 'Fk Id Beneficiario',
			'numero_caso_beneficiario_patrocinador' => 'Numero Caso Beneficiario Patrocinador',
			'numero_ninio_beneficiario_patrocinador' => 'Numero Ninio Beneficiario Patrocinador',
			'codigo_donante_beneficiario_patrocinador' => 'Codigo Donante Beneficiario Patrocinador',
			'nombre_patrocinador_beneficiario_patrocinador' => 'Nombre Patrocinador Beneficiario Patrocinador',
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

		$criteria->compare('id_beneficiario_patrocinador',$this->id_beneficiario_patrocinador);
		$criteria->compare('fk_id_beneficiario',$this->fk_id_beneficiario);
		$criteria->compare('numero_caso_beneficiario_patrocinador',$this->numero_caso_beneficiario_patrocinador,true);
		$criteria->compare('numero_ninio_beneficiario_patrocinador',$this->numero_ninio_beneficiario_patrocinador,true);
		$criteria->compare('codigo_donante_beneficiario_patrocinador',$this->codigo_donante_beneficiario_patrocinador,true);
		$criteria->compare('nombre_patrocinador_beneficiario_patrocinador',$this->nombre_patrocinador_beneficiario_patrocinador,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BeneficiarioPatrocinador the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
