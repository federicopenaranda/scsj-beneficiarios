<?php
/**
 * Esta es la clase modelo para la tabla "metodo_planificacion_familiar".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'metodo_planificacion_familiar':
 * @property integer $id_metodo_planificacion_familiar
 * @property string $nombre_metodo_planificacion_familiar
 * @property string $descripcion_metodo_planificacion_familiar
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property Familia[] $familias
 */
class MetodoPlanificacionFamiliar extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'metodo_planificacion_familiar';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('nombre_metodo_planificacion_familiar', 'required'),
			array('nombre_metodo_planificacion_familiar', 'length', 'max'=>200),
			array('descripcion_metodo_planificacion_familiar', 'safe'),
			array('nombre_metodo_planificacion_familiar', 'unique','message'=>'Dato invalido valor duplicado'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'familias' => array(self::MANY_MANY, 'Familia', 'familia_metodo_planificacion_familiar(fk_id_metodo_planificacion_familiar, fk_id_familia)'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_metodo_planificacion_familiar' => 'Id Metodo Planificacion Familiar',
			'nombre_metodo_planificacion_familiar' => 'Nombre Metodo Planificacion Familiar',
			'descripcion_metodo_planificacion_familiar' => 'Descripcion Metodo Planificacion Familiar',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MetodoPlanificacionFamiliar la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
