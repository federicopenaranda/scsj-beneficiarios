<?php

/**
 * This is the model class for table "competencia_monitoreo_actor".
 *
 * The followings are the available columns in table 'competencia_monitoreo_actor':
 * @property integer $id_competencia_monitoreo_actor
 * @property integer $fk_id_tipo_monitoreo_actor
 * @property string $nombre_competencia_monitoreo_actor
 * @property string $descripcion_competencia_monitoreo_actor
 * @property integer $estado_competencia_monitoreo_actor
 *
 * The followings are the available model relations:
 * @property TipoMonitoreoActor $fkIdTipoMonitoreoActor
 * @property CriterioMonitoreoActor[] $criterioMonitoreoActors
 */
class CompetenciaMonitoreoActor extends CTQ
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'competencia_monitoreo_actor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fk_id_tipo_monitoreo_actor, nombre_competencia_monitoreo_actor, estado_competencia_monitoreo_actor', 'required'),
			array('fk_id_tipo_monitoreo_actor, estado_competencia_monitoreo_actor', 'numerical', 'integerOnly'=>true),
			array('nombre_competencia_monitoreo_actor', 'length', 'max'=>145),
			array('descripcion_competencia_monitoreo_actor', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_competencia_monitoreo_actor, fk_id_tipo_monitoreo_actor, nombre_competencia_monitoreo_actor, descripcion_competencia_monitoreo_actor, estado_competencia_monitoreo_actor', 'safe', 'on'=>'search'),
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
			'fkIdTipoMonitoreoActor' => array(self::BELONGS_TO, 'TipoMonitoreoActor', 'fk_id_tipo_monitoreo_actor'),
			'criterioMonitoreoActors' => array(self::HAS_MANY, 'CriterioMonitoreoActor', 'fk_id_competencia_monitoreo_actor'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_competencia_monitoreo_actor' => 'Id Competencia Monitoreo Actor',
			'fk_id_tipo_monitoreo_actor' => 'Fk Id Tipo Monitoreo Actor',
			'nombre_competencia_monitoreo_actor' => 'Nombre Competencia Monitoreo Actor',
			'descripcion_competencia_monitoreo_actor' => 'Descripcion Competencia Monitoreo Actor',
			'estado_competencia_monitoreo_actor' => 'Estado Competencia Monitoreo Actor',
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

		$criteria->compare('id_competencia_monitoreo_actor',$this->id_competencia_monitoreo_actor);
		$criteria->compare('fk_id_tipo_monitoreo_actor',$this->fk_id_tipo_monitoreo_actor);
		$criteria->compare('nombre_competencia_monitoreo_actor',$this->nombre_competencia_monitoreo_actor,true);
		$criteria->compare('descripcion_competencia_monitoreo_actor',$this->descripcion_competencia_monitoreo_actor,true);
		$criteria->compare('estado_competencia_monitoreo_actor',$this->estado_competencia_monitoreo_actor);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CompetenciaMonitoreoActor the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
