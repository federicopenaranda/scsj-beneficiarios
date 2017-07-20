<?php

/**
 * This is the model class for table "eval_nutricion".
 *
 * The followings are the available columns in table 'eval_nutricion':
 * @property integer $id_nutricion
 * @property integer $fk_id_tipo_consulta
 * @property integer $fk_id_usuario
 * @property integer $fk_id_beneficiario
 * @property string $fecha_nutricion
 * @property string $observaciones_nutricion
 * @property double $peso_nutricion
 * @property double $talla_nutricion
 * @property string $peso_talla_nutricion
 * @property string $talla_edad_nutricion
 *
 * The followings are the available model relations:
 * @property TipoConsulta $fkIdTipoConsulta
 * @property Usuario $fkIdUsuario
 * @property Beneficiario $fkIdBeneficiario
 */
class EvalNutricion extends CTQ
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'eval_nutricion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fk_id_tipo_consulta, fk_id_beneficiario, fecha_nutricion', 'required'),
			array('fk_id_tipo_consulta, fk_id_usuario, fk_id_beneficiario', 'numerical', 'integerOnly'=>true),
			array('peso_nutricion, talla_nutricion', 'numerical'),
			array('observaciones_nutricion, peso_talla_nutricion, talla_edad_nutricion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_nutricion, fk_id_tipo_consulta, fk_id_usuario, fk_id_beneficiario, fecha_nutricion, observaciones_nutricion, peso_nutricion, talla_nutricion, peso_talla_nutricion, talla_edad_nutricion', 'safe', 'on'=>'search'),
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
			'id_nutricion' => 'Id Nutricion',
			'fk_id_tipo_consulta' => 'Fk Id Tipo Consulta',
			'fk_id_usuario' => 'Fk Id Usuario',
			'fk_id_beneficiario' => 'Fk Id Beneficiario',
			'fecha_nutricion' => 'Fecha Nutricion',
			'observaciones_nutricion' => 'Observaciones Nutricion',
			'peso_nutricion' => 'Peso Nutricion',
			'talla_nutricion' => 'Talla Nutricion',
			'peso_talla_nutricion' => 'Peso Talla Nutricion',
			'talla_edad_nutricion' => 'Talla Edad Nutricion',
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

		$criteria->compare('id_nutricion',$this->id_nutricion);
		$criteria->compare('fk_id_tipo_consulta',$this->fk_id_tipo_consulta);
		$criteria->compare('fk_id_usuario',$this->fk_id_usuario);
		$criteria->compare('fk_id_beneficiario',$this->fk_id_beneficiario);
		$criteria->compare('fecha_nutricion',$this->fecha_nutricion,true);
		$criteria->compare('observaciones_nutricion',$this->observaciones_nutricion,true);
		$criteria->compare('peso_nutricion',$this->peso_nutricion);
		$criteria->compare('talla_nutricion',$this->talla_nutricion);
		$criteria->compare('peso_talla_nutricion',$this->peso_talla_nutricion,true);
		$criteria->compare('talla_edad_nutricion',$this->talla_edad_nutricion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EvalNutricion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
