<?php

/**
 * This is the model class for table "caracteristica_monitoreo_pc".
 *
 * The followings are the available columns in table 'caracteristica_monitoreo_pc':
 * @property integer $id_caracteristica_monitoreo_pc
 * @property string $nombre_caracteristica_monitoreo_pc
 * @property string $descripcion_caracteristica_monitoreo_pc
 *
 * The followings are the available model relations:
 * @property AmbitoMonitoreoPc[] $ambitoMonitoreoPcs
 */
class CaracteristicaMonitoreoPc extends CTQ
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'caracteristica_monitoreo_pc';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre_caracteristica_monitoreo_pc', 'required'),
			array('nombre_caracteristica_monitoreo_pc', 'length', 'max'=>145),
			array('descripcion_caracteristica_monitoreo_pc', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_caracteristica_monitoreo_pc, nombre_caracteristica_monitoreo_pc, descripcion_caracteristica_monitoreo_pc', 'safe', 'on'=>'search'),
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
			'ambitoMonitoreoPcs' => array(self::HAS_MANY, 'AmbitoMonitoreoPc', 'fk_id_caracteristica_monitoreo_pc'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_caracteristica_monitoreo_pc' => 'Id Caracteristica Monitoreo Pc',
			'nombre_caracteristica_monitoreo_pc' => 'Nombre Caracteristica Monitoreo Pc',
			'descripcion_caracteristica_monitoreo_pc' => 'Descripcion Caracteristica Monitoreo Pc',
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

		$criteria->compare('id_caracteristica_monitoreo_pc',$this->id_caracteristica_monitoreo_pc);
		$criteria->compare('nombre_caracteristica_monitoreo_pc',$this->nombre_caracteristica_monitoreo_pc,true);
		$criteria->compare('descripcion_caracteristica_monitoreo_pc',$this->descripcion_caracteristica_monitoreo_pc,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CaracteristicaMonitoreoPc the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
