<?php

/**
 * This is the model class for table "eval_pedagogico".
 *
 * The followings are the available columns in table 'eval_pedagogico':
 * @property integer $id_pedagogico
 * @property integer $fk_id_usuario
 * @property integer $fk_id_beneficiario
 * @property string $fecha_pedagogico
 * @property string $observaciones_pedagogico
 * @property string $matematicas_pedagogico
 * @property string $lenguaje_pedagogico
 * @property string $desarrollo_habilidades_pedagogico
 * @property string $ciencias_vida_pedagogico
 * @property string $idiomas_pedagogico
 * @property string $tecnologia_pedagogico
 * @property string $fecha_creacion_eval_pedagogico
 *
 * The followings are the available model relations:
 * @property Usuario $fkIdUsuario
 * @property Beneficiario $fkIdBeneficiario
 */
class EvalPedagogico extends CTQ
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'eval_pedagogico';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fk_id_beneficiario, fecha_pedagogico', 'required'),
			array('fk_id_usuario, fk_id_beneficiario', 'numerical', 'integerOnly'=>true),
			array('observaciones_pedagogico, matematicas_pedagogico, lenguaje_pedagogico, desarrollo_habilidades_pedagogico, ciencias_vida_pedagogico, idiomas_pedagogico, tecnologia_pedagogico', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_pedagogico, fk_id_usuario, fk_id_beneficiario, fecha_pedagogico, observaciones_pedagogico, matematicas_pedagogico, lenguaje_pedagogico, desarrollo_habilidades_pedagogico, ciencias_vida_pedagogico, idiomas_pedagogico, tecnologia_pedagogico, fecha_creacion_eval_pedagogico', 'safe', 'on'=>'search'),
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
			'id_pedagogico' => 'Id Pedagogico',
			'fk_id_usuario' => 'Fk Id Usuario',
			'fk_id_beneficiario' => 'Fk Id Beneficiario',
			'fecha_pedagogico' => 'Fecha Pedagogico',
			'observaciones_pedagogico' => 'Observaciones Pedagogico',
			'matematicas_pedagogico' => 'Matematicas Pedagogico',
			'lenguaje_pedagogico' => 'Lenguaje Pedagogico',
			'desarrollo_habilidades_pedagogico' => 'Desarrollo Habilidades Pedagogico',
			'ciencias_vida_pedagogico' => 'Ciencias Vida Pedagogico',
			'idiomas_pedagogico' => 'Idiomas Pedagogico',
			'tecnologia_pedagogico' => 'Tecnologia Pedagogico',
			'fecha_creacion_eval_pedagogico' => 'Fecha Creacion Eval Pedagogico',
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

		$criteria->compare('id_pedagogico',$this->id_pedagogico);
		$criteria->compare('fk_id_usuario',$this->fk_id_usuario);
		$criteria->compare('fk_id_beneficiario',$this->fk_id_beneficiario);
		$criteria->compare('fecha_pedagogico',$this->fecha_pedagogico,true);
		$criteria->compare('observaciones_pedagogico',$this->observaciones_pedagogico,true);
		$criteria->compare('matematicas_pedagogico',$this->matematicas_pedagogico,true);
		$criteria->compare('lenguaje_pedagogico',$this->lenguaje_pedagogico,true);
		$criteria->compare('desarrollo_habilidades_pedagogico',$this->desarrollo_habilidades_pedagogico,true);
		$criteria->compare('ciencias_vida_pedagogico',$this->ciencias_vida_pedagogico,true);
		$criteria->compare('idiomas_pedagogico',$this->idiomas_pedagogico,true);
		$criteria->compare('tecnologia_pedagogico',$this->tecnologia_pedagogico,true);
		$criteria->compare('fecha_creacion_eval_pedagogico',$this->fecha_creacion_eval_pedagogico,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EvalPedagogico the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
