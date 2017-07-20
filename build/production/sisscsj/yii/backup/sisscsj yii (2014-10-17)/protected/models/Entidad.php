<?php
/**
 * Esta es la clase modelo para la tabla "entidad".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'entidad':
 * @property integer $id_entidad
 * @property integer $fk_id_tipo_entidad
 * @property string $nombre_entidad
 * @property string $fecha_inicio_actividades_entidad
 * @property string $fecha_fin_actividades_entidad
 * @property string $direccion_entidad
 * @property string $observaciones_entidad
 * @property string $fecha_creacion_entidad
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property BeneficiarioEntidad[] $beneficiarioEntidads
 * @property TipoEntidad $fkIdTipoEntidad
 * @property EntidadEstadoEntidad[] $entidadEstadoEntidads
 * @property UsuarioEntidad[] $usuarioEntidads
 */
class Entidad extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'entidad';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('fk_id_tipo_entidad, nombre_entidad, fecha_inicio_actividades_entidad', 'required'),
			array('fk_id_tipo_entidad', 'numerical', 'integerOnly'=>true),
			array('nombre_entidad', 'length', 'max'=>200),
			array('fecha_fin_actividades_entidad, direccion_entidad, observaciones_entidad', 'safe'),
			array('nombre_entidad', 'unique','message'=>'Dato invalido valor duplicado'),
			#array('fecha_inicio_actividades_entidad','date','format'=>'yyyy-MM-dd','message'=>'Formato invalido para la fecha'),
			#array('fecha_fin_actividades_entidad','date','format'=>'yyyy-MM-dd','message'=>'Formato invalido para la fecha'),			
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'beneficiarioEntidads' => array(self::HAS_MANY, 'BeneficiarioEntidad', 'fk_id_entidad'),
			'fkIdTipoEntidad' => array(self::BELONGS_TO, 'TipoEntidad', 'fk_id_tipo_entidad'),
			'entidadEstadoEntidads' => array(self::HAS_MANY, 'EntidadEstadoEntidad', 'fk_id_entidad'),
			'usuarioEntidads' => array(self::HAS_MANY, 'UsuarioEntidad', 'fk_id_entidad'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
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
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Entidad la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
