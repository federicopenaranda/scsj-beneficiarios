<?php

/**
 * This is the model class for table "resultado".
 *
 * The followings are the available columns in table 'resultado':
 * @property integer $id_resultado
 * @property integer $fk_id_objetivo_especifico
 * @property string $descripcion_resultado
 * @property string $metas_resultado
 * @property string $indicadores_resultado
 * @property string $medios_verificacion_resultado
 * @property string $supuestos_resultado
 *
 * The followings are the available model relations:
 * @property ObjetivoEspecifico $fkIdObjetivoEspecifico
 * @property ResultadoActividad[] $resultadoActividads
 * @property ResultadoEvaluacion[] $resultadoEvaluacions
 */
class Resultado extends CTQ
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'resultado';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fk_id_objetivo_especifico, descripcion_resultado', 'required'),
			array('fk_id_objetivo_especifico', 'numerical', 'integerOnly'=>true),
			array('metas_resultado, indicadores_resultado, medios_verificacion_resultado, supuestos_resultado', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_resultado, fk_id_objetivo_especifico, descripcion_resultado, metas_resultado, indicadores_resultado, medios_verificacion_resultado, supuestos_resultado', 'safe', 'on'=>'search'),
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
			'fkIdObjetivoEspecifico' => array(self::BELONGS_TO, 'ObjetivoEspecifico', 'fk_id_objetivo_especifico'),
			'resultadoActividads' => array(self::HAS_MANY, 'ResultadoActividad', 'fk_id_resultado'),
			'resultadoEvaluacions' => array(self::HAS_MANY, 'ResultadoEvaluacion', 'fk_id_resultado'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_resultado' => 'Id Resultado',
			'fk_id_objetivo_especifico' => 'Fk Id Objetivo Especifico',
			'descripcion_resultado' => 'Descripcion Resultado',
			'metas_resultado' => 'Metas Resultado',
			'indicadores_resultado' => 'Indicadores Resultado',
			'medios_verificacion_resultado' => 'Medios Verificacion Resultado',
			'supuestos_resultado' => 'Supuestos Resultado',
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

		$criteria->compare('id_resultado',$this->id_resultado);
		$criteria->compare('fk_id_objetivo_especifico',$this->fk_id_objetivo_especifico);
		$criteria->compare('descripcion_resultado',$this->descripcion_resultado,true);
		$criteria->compare('metas_resultado',$this->metas_resultado,true);
		$criteria->compare('indicadores_resultado',$this->indicadores_resultado,true);
		$criteria->compare('medios_verificacion_resultado',$this->medios_verificacion_resultado,true);
		$criteria->compare('supuestos_resultado',$this->supuestos_resultado,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Resultado the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
