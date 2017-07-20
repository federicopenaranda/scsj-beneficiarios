<?php
/**
 * Esta es la clase modelo para la tabla "lugar_actividad".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'lugar_actividad':
 * @property integer $id_lugar_actividad
 * @property integer $fk_id_tipo_lugar
 * @property string $nombre_lugar_actividad
 * @property string $descripcion_lugar_actividad
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property Actividad[] $actividads
 * @property TipoLugar $fkIdTipoLugar
 */
class LugarActividad extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'lugar_actividad';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('fk_id_tipo_lugar, nombre_lugar_actividad', 'required'),
			array('fk_id_tipo_lugar', 'numerical', 'integerOnly'=>true),
			array('nombre_lugar_actividad', 'length', 'max'=>200),
			array('descripcion_lugar_actividad', 'safe'),
			array('nombre_lugar_actividad', 'unique','message'=>'Dato invalido valor duplicado'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'actividads' => array(self::MANY_MANY, 'Actividad', 'actividad_lugar_actividad(fk_id_lugar_actividad, fk_id_actividad)'),
			'fkIdTipoLugar' => array(self::BELONGS_TO, 'TipoLugar', 'fk_id_tipo_lugar'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_lugar_actividad' => 'Id Lugar Actividad',
			'fk_id_tipo_lugar' => 'Fk Id Tipo Lugar',
			'nombre_lugar_actividad' => 'Nombre Lugar Actividad',
			'descripcion_lugar_actividad' => 'Descripcion Lugar Actividad',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LugarActividad la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
