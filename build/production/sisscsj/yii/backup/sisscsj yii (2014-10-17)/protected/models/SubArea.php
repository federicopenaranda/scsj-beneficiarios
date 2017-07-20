<?php
/**
 * Esta es la clase modelo para la tabla "sub_area".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'sub_area':
 * @property integer $id_sub_area
 * @property integer $fk_id_area_actividad
 * @property string $nombre_sub_area
 * @property string $descripcion_sub_area
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property Actividad[] $actividads
 * @property EvalPsicologico[] $evalPsicologicos
 * @property AreaActividad $fkIdAreaActividad
 */
class SubArea extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'sub_area';
	}
	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('fk_id_area_actividad, nombre_sub_area', 'required'),
			array('fk_id_area_actividad', 'numerical', 'integerOnly'=>true),
			array('nombre_sub_area', 'length', 'max'=>45),
			array('descripcion_sub_area', 'safe'),
			array('nombre_sub_area', 'unique','message'=>'Dato invalido valor duplicado'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'actividads' => array(self::MANY_MANY, 'Actividad', 'actividad_area_actividad(fk_id_sub_area, fk_id_actividad)'),
			'evalPsicologicos' => array(self::HAS_MANY, 'EvalPsicologico', 'fk_id_sub_area_referencia'),
			'fkIdAreaActividad' => array(self::BELONGS_TO, 'AreaActividad', 'fk_id_area_actividad'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_sub_area' => 'Id Sub Area',
			'fk_id_area_actividad' => 'Fk Id Area Actividad',
			'nombre_sub_area' => 'Nombre Sub Area',
			'descripcion_sub_area' => 'Descripcion Sub Area',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SubArea la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
