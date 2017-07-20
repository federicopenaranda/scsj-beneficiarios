<?php

/**
 * This is the model class for table "entidad".
 *
 * The followings are the available columns in table 'entidad':
 * @property integer $id_entidad
 * @property integer $fk_id_tipo_entidad
 * @property string $nombre_entidad
 * @property string $fecha_inicio_actividades_entidad
 * @property string $fecha_fin_actividades_entidad
 * @property string $direccion_entidad
 * @property string $observaciones_entidad
 * @property string $fecha_creacion_entidad
 *
 * The followings are the available model relations:
 * @property BeneficiarioEntidad[] $beneficiarioEntidads
 * @property TipoEntidad $fkIdTipoEntidad
 * @property EntidadEstadoEntidad[] $entidadEstadoEntidads
 * @property MarcoLogico[] $marcoLogicos
 * @property UsuarioEntidad[] $usuarioEntidads
 */
class Entidad extends CTQ
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'entidad';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fk_id_tipo_entidad, nombre_entidad, fecha_inicio_actividades_entidad, fecha_creacion_entidad', 'required'),
			array('fk_id_tipo_entidad', 'numerical', 'integerOnly'=>true),
			array('nombre_entidad', 'length', 'max'=>200),
			array('fecha_fin_actividades_entidad, direccion_entidad, observaciones_entidad', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_entidad, fk_id_tipo_entidad, nombre_entidad, fecha_inicio_actividades_entidad, fecha_fin_actividades_entidad, direccion_entidad, observaciones_entidad, fecha_creacion_entidad', 'safe', 'on'=>'search'),
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
			'beneficiarioEntidads' => array(self::HAS_MANY, 'BeneficiarioEntidad', 'fk_id_entidad'),
			'fkIdTipoEntidad' => array(self::BELONGS_TO, 'TipoEntidad', 'fk_id_tipo_entidad'),
			'entidadEstadoEntidads' => array(self::HAS_MANY, 'EntidadEstadoEntidad', 'fk_id_entidad'),
			'marcoLogicos' => array(self::HAS_MANY, 'MarcoLogico', 'fk_id_entidad'),
			'usuarioEntidads' => array(self::HAS_MANY, 'UsuarioEntidad', 'fk_id_entidad'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_entidad' => 'Id Entidad',
			'fk_id_tipo_entidad' => 'Fk Id Tipo Entidad',
			'nombre_entidad' => 'Nombre Entidad',
			'fecha_inicio_actividades_entidad' => 'Fecha Inicio Actividades Entidad',
			'fecha_fin_actividades_entidad' => 'Fecha Fin Actividades Entidad',
			'direccion_entidad' => 'Direccion Entidad',
			'observaciones_entidad' => 'Observaciones Entidad',
			'fecha_creacion_entidad' => 'Fecha Creacion Entidad',
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

		$criteria->compare('id_entidad',$this->id_entidad);
		$criteria->compare('fk_id_tipo_entidad',$this->fk_id_tipo_entidad);
		$criteria->compare('nombre_entidad',$this->nombre_entidad,true);
		$criteria->compare('fecha_inicio_actividades_entidad',$this->fecha_inicio_actividades_entidad,true);
		$criteria->compare('fecha_fin_actividades_entidad',$this->fecha_fin_actividades_entidad,true);
		$criteria->compare('direccion_entidad',$this->direccion_entidad,true);
		$criteria->compare('observaciones_entidad',$this->observaciones_entidad,true);
		$criteria->compare('fecha_creacion_entidad',$this->fecha_creacion_entidad,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Entidad the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
