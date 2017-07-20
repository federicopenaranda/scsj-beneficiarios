<?php

/**
 * This is the model class for table "objetivo_especifico".
 *
 * The followings are the available columns in table 'objetivo_especifico':
 * @property integer $id_objetivo_especifico
 * @property integer $fk_id_objetivo_general
 * @property string $descripcion_objetivo_especifico
 * @property string $logica_intervencion_objetivo_especifico
 * @property string $metas_objetivo_especifico
 * @property string $indicadores_objetivo_especifico
 * @property string $medios_verificacion_objetivo_especifico
 * @property string $supuestos_objetivo_especifico
 *
 * The followings are the available model relations:
 * @property ObjetivoGeneral $fkIdObjetivoGeneral
 * @property Resultado[] $resultados
 */
class ObjetivoEspecifico extends CTQ
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'objetivo_especifico';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fk_id_objetivo_general, descripcion_objetivo_especifico', 'required'),
			array('fk_id_objetivo_general', 'numerical', 'integerOnly'=>true),
			array('logica_intervencion_objetivo_especifico, metas_objetivo_especifico, indicadores_objetivo_especifico, medios_verificacion_objetivo_especifico, supuestos_objetivo_especifico', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_objetivo_especifico, fk_id_objetivo_general, descripcion_objetivo_especifico, logica_intervencion_objetivo_especifico, metas_objetivo_especifico, indicadores_objetivo_especifico, medios_verificacion_objetivo_especifico, supuestos_objetivo_especifico', 'safe', 'on'=>'search'),
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
			'fkIdObjetivoGeneral' => array(self::BELONGS_TO, 'ObjetivoGeneral', 'fk_id_objetivo_general'),
			'resultados' => array(self::HAS_MANY, 'Resultado', 'fk_id_objetivo_especifico'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_objetivo_especifico' => 'Id Objetivo Especifico',
			'fk_id_objetivo_general' => 'Fk Id Objetivo General',
			'descripcion_objetivo_especifico' => 'Descripcion Objetivo Especifico',
			'logica_intervencion_objetivo_especifico' => 'Logica Intervencion Objetivo Especifico',
			'metas_objetivo_especifico' => 'Metas Objetivo Especifico',
			'indicadores_objetivo_especifico' => 'Indicadores Objetivo Especifico',
			'medios_verificacion_objetivo_especifico' => 'Medios Verificacion Objetivo Especifico',
			'supuestos_objetivo_especifico' => 'Supuestos Objetivo Especifico',
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

		$criteria->compare('id_objetivo_especifico',$this->id_objetivo_especifico);
		$criteria->compare('fk_id_objetivo_general',$this->fk_id_objetivo_general);
		$criteria->compare('descripcion_objetivo_especifico',$this->descripcion_objetivo_especifico,true);
		$criteria->compare('logica_intervencion_objetivo_especifico',$this->logica_intervencion_objetivo_especifico,true);
		$criteria->compare('metas_objetivo_especifico',$this->metas_objetivo_especifico,true);
		$criteria->compare('indicadores_objetivo_especifico',$this->indicadores_objetivo_especifico,true);
		$criteria->compare('medios_verificacion_objetivo_especifico',$this->medios_verificacion_objetivo_especifico,true);
		$criteria->compare('supuestos_objetivo_especifico',$this->supuestos_objetivo_especifico,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ObjetivoEspecifico the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
