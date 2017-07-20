<?php

/**
 * This is the model class for table "actividad_proyecto".
 *
 * The followings are the available columns in table 'actividad_proyecto':
 * @property integer $id_actividad_proyecto
 * @property integer $fk_id_usuario
 * @property integer $fk_id_lugar_actividad
 * @property integer $fk_id_gestion
 * @property string $titulo_actividad_proyecto
 * @property string $fecha_inicio_actividad_proyecto
 * @property string $fecha_fin_actividad_proyecto
 * @property string $descripcion_actividad_proyecto
 * @property string $fecha_creacion_actividad_proyecto
 *
 * The followings are the available model relations:
 * @property LugarActividad $fkIdLugarActividad
 * @property Gestion $fkIdGestion
 * @property Usuario $fkIdUsuario
 * @property TipoActividad[] $tipoActividads
 * @property ActividadTipoParticipante[] $actividadTipoParticipantes
 * @property Resultado[] $resultados
 */
class ActividadProyecto extends CTQ
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'actividad_proyecto';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fk_id_lugar_actividad, fk_id_gestion, titulo_actividad_proyecto, fecha_inicio_actividad_proyecto, descripcion_actividad_proyecto', 'required'),
			array('fk_id_usuario, fk_id_lugar_actividad, fk_id_gestion', 'numerical', 'integerOnly'=>true),
			array('titulo_actividad_proyecto', 'length', 'max'=>200),
			array('fecha_fin_actividad_proyecto', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_actividad_proyecto, fk_id_usuario, fk_id_lugar_actividad, fk_id_gestion, titulo_actividad_proyecto, fecha_inicio_actividad_proyecto, fecha_fin_actividad_proyecto, descripcion_actividad_proyecto, fecha_creacion_actividad_proyecto', 'safe', 'on'=>'search'),
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
			'fkIdLugarActividad' => array(self::BELONGS_TO, 'LugarActividad', 'fk_id_lugar_actividad'),
			'fkIdGestion' => array(self::BELONGS_TO, 'Gestion', 'fk_id_gestion'),
			'fkIdUsuario' => array(self::BELONGS_TO, 'Usuario', 'fk_id_usuario'),
			'tipoActividads' => array(self::MANY_MANY, 'TipoActividad', 'actividad_proyecto_tipo_actividad(fk_id_actividad_proyecto, fk_id_tipo_actividad)'),
			'actividadTipoParticipantes' => array(self::HAS_MANY, 'ActividadTipoParticipante', 'fk_id_actividad_proyecto'),
			'resultados' => array(self::MANY_MANY, 'Resultado', 'resultado_actividad(fk_id_actividad_proyecto, fk_id_resultado)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_actividad_proyecto' => 'Id Actividad Proyecto',
			'fk_id_usuario' => 'Fk Id Usuario',
			'fk_id_lugar_actividad' => 'Fk Id Lugar Actividad',
			'fk_id_gestion' => 'Fk Id Gestion',
			'titulo_actividad_proyecto' => 'Titulo Actividad Proyecto',
			'fecha_inicio_actividad_proyecto' => 'Fecha Inicio Actividad Proyecto',
			'fecha_fin_actividad_proyecto' => 'Fecha Fin Actividad Proyecto',
			'descripcion_actividad_proyecto' => 'Descripcion Actividad Proyecto',
			'fecha_creacion_actividad_proyecto' => 'Fecha Creacion Actividad Proyecto',
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

		$criteria->compare('id_actividad_proyecto',$this->id_actividad_proyecto);
		$criteria->compare('fk_id_usuario',$this->fk_id_usuario);
		$criteria->compare('fk_id_lugar_actividad',$this->fk_id_lugar_actividad);
		$criteria->compare('fk_id_gestion',$this->fk_id_gestion);
		$criteria->compare('titulo_actividad_proyecto',$this->titulo_actividad_proyecto,true);
		$criteria->compare('fecha_inicio_actividad_proyecto',$this->fecha_inicio_actividad_proyecto,true);
		$criteria->compare('fecha_fin_actividad_proyecto',$this->fecha_fin_actividad_proyecto,true);
		$criteria->compare('descripcion_actividad_proyecto',$this->descripcion_actividad_proyecto,true);
		$criteria->compare('fecha_creacion_actividad_proyecto',$this->fecha_creacion_actividad_proyecto,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ActividadProyecto the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
