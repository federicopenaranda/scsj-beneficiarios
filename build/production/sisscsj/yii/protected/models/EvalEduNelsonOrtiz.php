<?php

/**
 * This is the model class for table "eval_edu_nelson_ortiz".
 *
 * The followings are the available columns in table 'eval_edu_nelson_ortiz':
 * @property integer $id_nelson_ortiz
 * @property integer $fk_id_tipo_consulta
 * @property integer $fk_id_usuario
 * @property integer $fk_id_beneficiario
 * @property string $fecha_nelson_ortiz
 * @property string $observaciones_nelson_ortiz
 * @property string $motricidad_gruesa_nelson_ortiz
 * @property string $audicion_lenguaje_nelson_ortiz
 * @property string $motricidad_fina_nelson_ortiz
 * @property string $personal_social_nelson_ortiz
 * @property string $total_nelson_ortiz
 * @property string $fecha_creacion_eval_edu_nelson_ortiz
 *
 * The followings are the available model relations:
 * @property TipoConsulta $fkIdTipoConsulta
 * @property Usuario $fkIdUsuario
 * @property Beneficiario $fkIdBeneficiario
 */
class EvalEduNelsonOrtiz extends CTQ
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'eval_edu_nelson_ortiz';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fk_id_tipo_consulta, fk_id_beneficiario, fecha_nelson_ortiz', 'required'),
			array('fk_id_tipo_consulta, fk_id_usuario, fk_id_beneficiario', 'numerical', 'integerOnly'=>true),
			array('observaciones_nelson_ortiz, motricidad_gruesa_nelson_ortiz, audicion_lenguaje_nelson_ortiz, motricidad_fina_nelson_ortiz, personal_social_nelson_ortiz, total_nelson_ortiz', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_nelson_ortiz, fk_id_tipo_consulta, fk_id_usuario, fk_id_beneficiario, fecha_nelson_ortiz, observaciones_nelson_ortiz, motricidad_gruesa_nelson_ortiz, audicion_lenguaje_nelson_ortiz, motricidad_fina_nelson_ortiz, personal_social_nelson_ortiz, total_nelson_ortiz, fecha_creacion_eval_edu_nelson_ortiz', 'safe', 'on'=>'search'),
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
			'fkIdTipoConsulta' => array(self::BELONGS_TO, 'TipoConsulta', 'fk_id_tipo_consulta'),
			'fkIdUsuario' => array(self::BELONGS_TO, 'Usuario', 'fk_id_usuario'),
			'fkIdBeneficiario' => array(self::BELONGS_TO, 'Beneficiario', 'fk_id_beneficiario'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_nelson_ortiz' => 'Id Nelson Ortiz',
			'fk_id_tipo_consulta' => 'Fk Id Tipo Consulta',
			'fk_id_usuario' => 'Fk Id Usuario',
			'fk_id_beneficiario' => 'Fk Id Beneficiario',
			'fecha_nelson_ortiz' => 'Fecha Nelson Ortiz',
			'observaciones_nelson_ortiz' => 'Observaciones Nelson Ortiz',
			'motricidad_gruesa_nelson_ortiz' => 'Motricidad Gruesa Nelson Ortiz',
			'audicion_lenguaje_nelson_ortiz' => 'Audicion Lenguaje Nelson Ortiz',
			'motricidad_fina_nelson_ortiz' => 'Motricidad Fina Nelson Ortiz',
			'personal_social_nelson_ortiz' => 'Personal Social Nelson Ortiz',
			'total_nelson_ortiz' => 'Total Nelson Ortiz',
			'fecha_creacion_eval_edu_nelson_ortiz' => 'Fecha Creacion Eval Edu Nelson Ortiz',
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

		$criteria->compare('id_nelson_ortiz',$this->id_nelson_ortiz);
		$criteria->compare('fk_id_tipo_consulta',$this->fk_id_tipo_consulta);
		$criteria->compare('fk_id_usuario',$this->fk_id_usuario);
		$criteria->compare('fk_id_beneficiario',$this->fk_id_beneficiario);
		$criteria->compare('fecha_nelson_ortiz',$this->fecha_nelson_ortiz,true);
		$criteria->compare('observaciones_nelson_ortiz',$this->observaciones_nelson_ortiz,true);
		$criteria->compare('motricidad_gruesa_nelson_ortiz',$this->motricidad_gruesa_nelson_ortiz,true);
		$criteria->compare('audicion_lenguaje_nelson_ortiz',$this->audicion_lenguaje_nelson_ortiz,true);
		$criteria->compare('motricidad_fina_nelson_ortiz',$this->motricidad_fina_nelson_ortiz,true);
		$criteria->compare('personal_social_nelson_ortiz',$this->personal_social_nelson_ortiz,true);
		$criteria->compare('total_nelson_ortiz',$this->total_nelson_ortiz,true);
		$criteria->compare('fecha_creacion_eval_edu_nelson_ortiz',$this->fecha_creacion_eval_edu_nelson_ortiz,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EvalEduNelsonOrtiz the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
