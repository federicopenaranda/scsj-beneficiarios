<?php

/**
 * This is the model class for table "ambito_monitoreo_pc".
 *
 * The followings are the available columns in table 'ambito_monitoreo_pc':
 * @property integer $id_ambito_monitoreo_pc
 * @property integer $fk_id_caracteristica_monitoreo_pc
 * @property string $nombre_ambito_monitoreo_pc
 * @property string $indicador_ambito_monitoreo_pc
 * @property integer $estado_ambito_monitoreo_pc
 *
 * The followings are the available model relations:
 * @property CaracteristicaMonitoreoPc $fkIdCaracteristicaMonitoreoPc
 * @property ResultadoMonitoreoPc[] $resultadoMonitoreoPcs
 */
class AmbitoMonitoreoPc extends CTQ
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ambito_monitoreo_pc';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fk_id_caracteristica_monitoreo_pc, nombre_ambito_monitoreo_pc, indicador_ambito_monitoreo_pc, estado_ambito_monitoreo_pc', 'required'),
			array('fk_id_caracteristica_monitoreo_pc, estado_ambito_monitoreo_pc', 'numerical', 'integerOnly'=>true),
			array('nombre_ambito_monitoreo_pc', 'length', 'max'=>145),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_ambito_monitoreo_pc, fk_id_caracteristica_monitoreo_pc, nombre_ambito_monitoreo_pc, indicador_ambito_monitoreo_pc, estado_ambito_monitoreo_pc', 'safe', 'on'=>'search'),
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
			'fkIdCaracteristicaMonitoreoPc' => array(self::BELONGS_TO, 'CaracteristicaMonitoreoPc', 'fk_id_caracteristica_monitoreo_pc'),
			'resultadoMonitoreoPcs' => array(self::HAS_MANY, 'ResultadoMonitoreoPc', 'fk_id_ambito_monitoreo_pc'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_ambito_monitoreo_pc' => 'Id Ambito Monitoreo Pc',
			'fk_id_caracteristica_monitoreo_pc' => 'Fk Id Caracteristica Monitoreo Pc',
			'nombre_ambito_monitoreo_pc' => 'Nombre Ambito Monitoreo Pc',
			'indicador_ambito_monitoreo_pc' => 'Indicador Ambito Monitoreo Pc',
			'estado_ambito_monitoreo_pc' => 'Estado Ambito Monitoreo Pc',
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

		$criteria->compare('id_ambito_monitoreo_pc',$this->id_ambito_monitoreo_pc);
		$criteria->compare('fk_id_caracteristica_monitoreo_pc',$this->fk_id_caracteristica_monitoreo_pc);
		$criteria->compare('nombre_ambito_monitoreo_pc',$this->nombre_ambito_monitoreo_pc,true);
		$criteria->compare('indicador_ambito_monitoreo_pc',$this->indicador_ambito_monitoreo_pc,true);
		$criteria->compare('estado_ambito_monitoreo_pc',$this->estado_ambito_monitoreo_pc);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AmbitoMonitoreoPc the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
