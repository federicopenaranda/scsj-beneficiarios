<?php
/**
 * Esta es la clase modelo para la tabla "estado_entidad".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'estado_entidad':
 * @property integer $id_estado_entidad
 * @property string $nombre_estado_entidad
 * @property string $descripcion_estado_entidad
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property EntidadEstadoEntidad[] $entidadEstadoEntidads
 */
class EstadoEntidad extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'estado_entidad';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('nombre_estado_entidad', 'required'),
			array('nombre_estado_entidad', 'length', 'max'=>200),
			array('descripcion_estado_entidad', 'safe'),
			array('nombre_estado_entidad', 'unique','message'=>'Dato invalido valor duplicado'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'entidadEstadoEntidads' => array(self::HAS_MANY, 'EntidadEstadoEntidad', 'fk_id_estado_entidad'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_estado_entidad' => 'Id Estado Entidad',
			'nombre_estado_entidad' => 'Nombre Estado Entidad',
			'descripcion_estado_entidad' => 'Descripcion Estado Entidad',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EstadoEntidad la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
