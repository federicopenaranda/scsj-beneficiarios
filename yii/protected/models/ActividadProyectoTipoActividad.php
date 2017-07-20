<?php

/**
 * This is the model class for table "actividad_proyecto_tipo_actividad".
 *
 * The followings are the available columns in table 'actividad_proyecto_tipo_actividad':
 * @property integer $fk_id_actividad_proyecto
 * @property integer $fk_id_tipo_actividad
 */
class ActividadProyectoTipoActividad extends CTQ
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'actividad_proyecto_tipo_actividad';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fk_id_actividad_proyecto, fk_id_tipo_actividad', 'required'),
			array('fk_id_actividad_proyecto, fk_id_tipo_actividad', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('fk_id_actividad_proyecto, fk_id_tipo_actividad', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'fk_id_actividad_proyecto' => 'Fk Id Actividad Proyecto',
			'fk_id_tipo_actividad' => 'Fk Id Tipo Actividad',
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

		$criteria->compare('fk_id_actividad_proyecto',$this->fk_id_actividad_proyecto);
		$criteria->compare('fk_id_tipo_actividad',$this->fk_id_tipo_actividad);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ActividadProyectoTipoActividad the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
