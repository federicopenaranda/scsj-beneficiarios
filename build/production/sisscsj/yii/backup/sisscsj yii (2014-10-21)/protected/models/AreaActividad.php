<?php
/**
 * Esta es la clase modelo para la tabla "area_actividad".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'area_actividad':
 * @property integer $id_area_actividad
 * @property string $nombre_area_actividad
 * @property string $descripcion_area_actividad
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property SubArea[] $subAreas
 */
class AreaActividad extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'area_actividad';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('nombre_area_actividad', 'required'),
			array('nombre_area_actividad', 'length', 'max'=>200),
			array('descripcion_area_actividad', 'safe'),
			array('nombre_area_actividad', 'unique','message'=>'Dato invalido valor duplicado'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'subAreas' => array(self::HAS_MANY, 'SubArea', 'fk_id_area_actividad'),
		);
	}
	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_area_actividad' => 'Id Area Actividad',
			'nombre_area_actividad' => 'Nombre Area Actividad',
			'descripcion_area_actividad' => 'Descripcion Area Actividad',
		);
	}
		
	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AreaActividad la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
