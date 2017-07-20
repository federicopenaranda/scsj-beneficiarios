<?php
/**
 * Esta es la clase modelo para la tabla "tipo_actividad".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'tipo_actividad':
 * @property integer $id_tipo_actividad
 * @property string $nombre_tipo_actividad
 * @property string $descripcion_tipo_actividad
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property Actividad[] $actividads
 */
class TipoActividad extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'tipo_actividad';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('nombre_tipo_actividad', 'required'),
			array('nombre_tipo_actividad', 'length', 'max'=>200),
			array('descripcion_tipo_actividad', 'safe'),
			array('nombre_tipo_actividad', 'unique','message'=>'Dato invalido valor duplicado'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'actividads' => array(self::MANY_MANY, 'Actividad', 'actividad_tipo_actividad(fk_id_tipo_actividad, fk_id_actividad)'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_tipo_actividad' => 'Id Tipo Actividad',
			'nombre_tipo_actividad' => 'Nombre Tipo Actividad',
			'descripcion_tipo_actividad' => 'Descripcion Tipo Actividad',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TipoActividad la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
