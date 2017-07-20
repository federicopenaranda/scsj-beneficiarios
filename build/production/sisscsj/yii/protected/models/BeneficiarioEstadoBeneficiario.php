<?php

/**
 * This is the model class for table "beneficiario_estado_beneficiario".
 *
 * The followings are the available columns in table 'beneficiario_estado_beneficiario':
 * @property integer $id_beneficiario_estado_beneficiario
 * @property integer $fk_id_estado_beneficiario
 * @property integer $fk_id_beneficiario
 * @property integer $fk_id_beneficiario_tipo
 * @property integer $fk_id_edades_beneficiario
 * @property integer $fk_id_tipo_actor_beneficiario
 * @property string $fecha_asignacion_estado_beneficiario
 * @property string $observaciones_beneficiario_estado_beneficiario
 * @property string $fecha_creacion_beneficiario_estado_beneficiario
 * @property string $modalidad_estado_beneficiario
 *
 * The followings are the available model relations:
 * @property Beneficiario $fkIdBeneficiario
 * @property EstadoBeneficiario $fkIdEstadoBeneficiario
 * @property BeneficiarioTipo $fkIdBeneficiarioTipo
 * @property EdadesBeneficiario $fkIdEdadesBeneficiario
 * @property TipoActorBeneficiario $fkIdTipoActorBeneficiario
 */
class BeneficiarioEstadoBeneficiario extends CTQ
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'beneficiario_estado_beneficiario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fk_id_estado_beneficiario, fk_id_beneficiario, fk_id_beneficiario_tipo, fk_id_edades_beneficiario, fk_id_tipo_actor_beneficiario', 'required'),
			array('fk_id_estado_beneficiario, fk_id_beneficiario, fk_id_beneficiario_tipo, fk_id_edades_beneficiario, fk_id_tipo_actor_beneficiario', 'numerical', 'integerOnly'=>true),
			array('observaciones_beneficiario_estado_beneficiario', 'safe'),
			array('fecha_asignacion_estado_beneficiario, modalidad_estado_beneficiario', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_beneficiario_estado_beneficiario, fk_id_estado_beneficiario, fk_id_beneficiario, fk_id_beneficiario_tipo, fk_id_edades_beneficiario, fk_id_tipo_actor_beneficiario, fecha_asignacion_estado_beneficiario, observaciones_beneficiario_estado_beneficiario, fecha_creacion_beneficiario_estado_beneficiario, modalidad_estado_beneficiario', 'safe', 'on'=>'search'),
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
			'fkIdEstadoBeneficiario' => array(self::BELONGS_TO, 'EstadoBeneficiario', 'fk_id_estado_beneficiario'),
			'fkIdBeneficiarioTipo' => array(self::BELONGS_TO, 'BeneficiarioTipo', 'fk_id_beneficiario_tipo'),
			'fkIdEdadesBeneficiario' => array(self::BELONGS_TO, 'EdadesBeneficiario', 'fk_id_edades_beneficiario'),
			'fkIdTipoActorBeneficiario' => array(self::BELONGS_TO, 'TipoActorBeneficiario', 'fk_id_tipo_actor_beneficiario'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_beneficiario_estado_beneficiario' => 'Id Beneficiario Estado Beneficiario',
			'fk_id_estado_beneficiario' => 'Fk Id Estado Beneficiario',
			'fk_id_beneficiario' => 'Fk Id Beneficiario',
			'fk_id_beneficiario_tipo' => 'Fk Id Beneficiario Tipo',
			'fk_id_edades_beneficiario' => 'Fk Id Edades Beneficiario',
			'fk_id_tipo_actor_beneficiario' => 'Fk Id Tipo Actor Beneficiario',
			'fecha_asignacion_estado_beneficiario' => 'Fecha Asignacion Estado Beneficiario',
			'observaciones_beneficiario_estado_beneficiario' => 'Observaciones Beneficiario Estado Beneficiario',
			'fecha_creacion_beneficiario_estado_beneficiario' => 'Fecha Creacion Beneficiario Estado Beneficiario',
			'modalidad_estado_beneficiario' => 'Modalidad Estado Beneficiario',
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

		$criteria->compare('id_beneficiario_estado_beneficiario',$this->id_beneficiario_estado_beneficiario);
		$criteria->compare('fk_id_estado_beneficiario',$this->fk_id_estado_beneficiario);
		$criteria->compare('fk_id_beneficiario',$this->fk_id_beneficiario);
		$criteria->compare('fk_id_beneficiario_tipo',$this->fk_id_beneficiario_tipo);
		$criteria->compare('fk_id_edades_beneficiario',$this->fk_id_edades_beneficiario);
		$criteria->compare('fk_id_tipo_actor_beneficiario',$this->fk_id_tipo_actor_beneficiario);
		$criteria->compare('fecha_asignacion_estado_beneficiario',$this->fecha_asignacion_estado_beneficiario,true);
		$criteria->compare('observaciones_beneficiario_estado_beneficiario',$this->observaciones_beneficiario_estado_beneficiario,true);
		$criteria->compare('fecha_creacion_beneficiario_estado_beneficiario',$this->fecha_creacion_beneficiario_estado_beneficiario,true);
		$criteria->compare('modalidad_estado_beneficiario',$this->modalidad_estado_beneficiario,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BeneficiarioEstadoBeneficiario the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
