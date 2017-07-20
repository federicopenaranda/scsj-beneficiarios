<?php

/**
 * This is the model class for table "tipo_monitoreo_actor".
 *
 * The followings are the available columns in table 'tipo_monitoreo_actor':
 * @property integer $id_tipo_monitoreo_actor
 * @property string $nombre_tipo_monitoreo_actor
 * @property string $descripcion_tipo_monitoreo_actor
 * @property integer $estado_tipo_monitoreo_actor
 *
 * The followings are the available model relations:
 * @property CompetenciaMonitoreoActor[] $competenciaMonitoreoActors
 * @property MonitoreoActor[] $monitoreoActors
 */
class TipoMonitoreoActor extends CTQ
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tipo_monitoreo_actor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre_tipo_monitoreo_actor, estado_tipo_monitoreo_actor', 'required'),
			array('estado_tipo_monitoreo_actor', 'numerical', 'integerOnly'=>true),
			array('nombre_tipo_monitoreo_actor', 'length', 'max'=>145),
			array('descripcion_tipo_monitoreo_actor', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_tipo_monitoreo_actor, nombre_tipo_monitoreo_actor, descripcion_tipo_monitoreo_actor, estado_tipo_monitoreo_actor', 'safe', 'on'=>'search'),
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
			'competenciaMonitoreoActors' => array(self::HAS_MANY, 'CompetenciaMonitoreoActor', 'fk_id_tipo_monitoreo_actor'),
			'monitoreoActors' => array(self::HAS_MANY, 'MonitoreoActor', 'fk_id_tipo_monitoreo_actor'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_tipo_monitoreo_actor' => 'Id Tipo Monitoreo Actor',
			'nombre_tipo_monitoreo_actor' => 'Nombre Tipo Monitoreo Actor',
			'descripcion_tipo_monitoreo_actor' => 'Descripcion Tipo Monitoreo Actor',
			'estado_tipo_monitoreo_actor' => 'Estado Tipo Monitoreo Actor',
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

		$criteria->compare('id_tipo_monitoreo_actor',$this->id_tipo_monitoreo_actor);
		$criteria->compare('nombre_tipo_monitoreo_actor',$this->nombre_tipo_monitoreo_actor,true);
		$criteria->compare('descripcion_tipo_monitoreo_actor',$this->descripcion_tipo_monitoreo_actor,true);
		$criteria->compare('estado_tipo_monitoreo_actor',$this->estado_tipo_monitoreo_actor);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TipoMonitoreoActor the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
