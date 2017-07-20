<?php
/**
 * Esta es la clase modelo para la tabla "actividad".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'actividad':
 * @property integer $id_actividad
 * @property integer $fk_id_usuario
 * @property integer $fk_id_gestion
 * @property integer $fk_id_lugar_actividad
 * @property string $titulo_actividad
 * @property string $fecha_inicio_actividad
 * @property string $fecha_fin_actividad
 * @property string $descripcion_actividad
 * @property string $fecha_creacion_actividad
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property Gestion $fkIdGestion
 * @property LugarActividad $fkIdLugarActividad
 * @property Usuario $fkIdUsuario
 * @property SubArea[] $subAreas
 * @property TipoActividad[] $tipoActividads
 * @property Asistencia[] $asistencias
 */
class Actividad extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'actividad';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('fk_id_gestion, fk_id_lugar_actividad, titulo_actividad, fecha_inicio_actividad, descripcion_actividad', 'required'),
			array('fk_id_usuario, fk_id_gestion, fk_id_lugar_actividad', 'numerical', 'integerOnly'=>true),
			array('titulo_actividad', 'length', 'max'=>200),
			array('fecha_fin_actividad', 'safe'),
			#array('fecha_inicio_actividad, fecha_fin_actividad','date','format'=>'yyyy-MM-dd HH:mm:ss','message'=>'Formato invalido para la fecha'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'fkIdGestion' => array(self::BELONGS_TO, 'Gestion', 'fk_id_gestion'),
			'fkIdLugarActividad' => array(self::BELONGS_TO, 'LugarActividad', 'fk_id_lugar_actividad'),
			'fkIdUsuario' => array(self::BELONGS_TO, 'Usuario', 'fk_id_usuario'),
			'subAreas' => array(self::MANY_MANY, 'SubArea', 'actividad_area_actividad(fk_id_actividad, fk_id_sub_area)'),
			'tipoActividads' => array(self::MANY_MANY, 'TipoActividad', 'actividad_tipo_actividad(fk_id_actividad, fk_id_tipo_actividad)'),
			'asistencias' => array(self::HAS_MANY, 'Asistencia', 'fk_id_actividad'),
			
			//yo
			'actividadTipoActividads'=>array(self::HAS_MANY,'ActividadTipoActividad','fk_id_actividad'),
			'actividadAreaActividads'=>array(self::HAS_MANY,'ActividadAreaActividad','fk_id_actividad'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_actividad' => 'Id Actividad',
			'fk_id_usuario' => 'Fk Id Usuario',
			'fk_id_gestion' => 'Fk Id Gestion',
			'fk_id_lugar_actividad' => 'Fk Id Lugar Actividad',
			'titulo_actividad' => 'Titulo Actividad',
			'fecha_inicio_actividad' => 'Fecha Inicio Actividad',
			'fecha_fin_actividad' => 'Fecha Fin Actividad',
			'descripcion_actividad' => 'Descripcion Actividad',
			'fecha_creacion_actividad' => 'Fecha Creacion Actividad',
		);
	}
		
	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Actividad la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
