<?php

/**
 * This is the model class for table "monitoreo_actor".
 *
 * The followings are the available columns in table 'monitoreo_actor':
 * @property integer $id_monitoreo_actor
 * @property integer $fk_id_usuario
 * @property integer $fk_id_tipo_monitoreo_actor
 * @property string $fecha_monitoreo_actor
 * @property string $analisis_monitoreo_actor
 *
 * The followings are the available model relations:
 * @property EvaluacionMonitoreoActor[] $evaluacionMonitoreoActors
 * @property Usuario $fkIdUsuario
 * @property TipoMonitoreoActor $fkIdTipoMonitoreoActor
 */
class MonitoreoActor extends CTQ
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'monitoreo_actor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fk_id_tipo_monitoreo_actor, fecha_monitoreo_actor', 'required'),
			array('fk_id_usuario, fk_id_tipo_monitoreo_actor', 'numerical', 'integerOnly'=>true),
			array('analisis_monitoreo_actor', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_monitoreo_actor, fk_id_usuario, fk_id_tipo_monitoreo_actor, fecha_monitoreo_actor, analisis_monitoreo_actor', 'safe', 'on'=>'search'),
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
			'evaluacionMonitoreoActors' => array(self::HAS_MANY, 'EvaluacionMonitoreoActor', 'fk_id_monitoreo_actor'),
			'fkIdUsuario' => array(self::BELONGS_TO, 'Usuario', 'fk_id_usuario'),
			'fkIdTipoMonitoreoActor' => array(self::BELONGS_TO, 'TipoMonitoreoActor', 'fk_id_tipo_monitoreo_actor'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_monitoreo_actor' => 'Id Monitoreo Actor',
			'fk_id_usuario' => 'Fk Id Usuario',
			'fk_id_tipo_monitoreo_actor' => 'Fk Id Tipo Monitoreo Actor',
			'fecha_monitoreo_actor' => 'Fecha Monitoreo Actor',
			'analisis_monitoreo_actor' => 'Analisis Monitoreo Actor',
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

		$criteria->compare('id_monitoreo_actor',$this->id_monitoreo_actor);
		$criteria->compare('fk_id_usuario',$this->fk_id_usuario);
		$criteria->compare('fk_id_tipo_monitoreo_actor',$this->fk_id_tipo_monitoreo_actor);
		$criteria->compare('fecha_monitoreo_actor',$this->fecha_monitoreo_actor,true);
		$criteria->compare('analisis_monitoreo_actor',$this->analisis_monitoreo_actor,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MonitoreoActor the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
