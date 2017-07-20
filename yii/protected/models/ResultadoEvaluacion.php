<?php

/**
 * This is the model class for table "resultado_evaluacion".
 *
 * The followings are the available columns in table 'resultado_evaluacion':
 * @property integer $id_resultado_evaluacion
 * @property integer $fk_id_resultado
 * @property string $tipo_resultado_evaluacion
 * @property string $informacion_cualitativa_resultado_evaluacion
 * @property string $accion_seguimiento_resultado_evaluacion
 * @property string $evaluacion_resultado_evaluacion
 *
 * The followings are the available model relations:
 * @property Resultado $fkIdResultado
 */
class ResultadoEvaluacion extends CTQ
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'resultado_evaluacion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fk_id_resultado, tipo_resultado_evaluacion', 'required'),
			array('fk_id_resultado', 'numerical', 'integerOnly'=>true),
			array('informacion_cualitativa_resultado_evaluacion, accion_seguimiento_resultado_evaluacion, evaluacion_resultado_evaluacion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_resultado_evaluacion, fk_id_resultado, tipo_resultado_evaluacion, informacion_cualitativa_resultado_evaluacion, accion_seguimiento_resultado_evaluacion, evaluacion_resultado_evaluacion', 'safe', 'on'=>'search'),
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
			'fkIdResultado' => array(self::BELONGS_TO, 'Resultado', 'fk_id_resultado'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_resultado_evaluacion' => 'Id Resultado Evaluacion',
			'fk_id_resultado' => 'Fk Id Resultado',
			'tipo_resultado_evaluacion' => 'Tipo Resultado Evaluacion',
			'informacion_cualitativa_resultado_evaluacion' => 'Informacion Cualitativa Resultado Evaluacion',
			'accion_seguimiento_resultado_evaluacion' => 'Accion Seguimiento Resultado Evaluacion',
			'evaluacion_resultado_evaluacion' => 'Evaluacion Resultado Evaluacion',
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

		$criteria->compare('id_resultado_evaluacion',$this->id_resultado_evaluacion);
		$criteria->compare('fk_id_resultado',$this->fk_id_resultado);
		$criteria->compare('tipo_resultado_evaluacion',$this->tipo_resultado_evaluacion,true);
		$criteria->compare('informacion_cualitativa_resultado_evaluacion',$this->informacion_cualitativa_resultado_evaluacion,true);
		$criteria->compare('accion_seguimiento_resultado_evaluacion',$this->accion_seguimiento_resultado_evaluacion,true);
		$criteria->compare('evaluacion_resultado_evaluacion',$this->evaluacion_resultado_evaluacion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ResultadoEvaluacion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
