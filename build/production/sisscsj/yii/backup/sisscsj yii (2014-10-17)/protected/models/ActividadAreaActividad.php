<?php
/**
 * Esta es la clase modelo para la tabla "actividad_area_actividad".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'actividad_area_actividad':
 * @property integer $fk_id_actividad
 * @property integer $fk_id_sub_area
 */
class ActividadAreaActividad extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'actividad_area_actividad';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('fk_id_actividad, fk_id_sub_area', 'required'),
			array('fk_id_actividad, fk_id_sub_area', 'numerical', 'integerOnly'=>true),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations(){
		return array(
			'fkIdAtividad' => array(self::BELONGS_TO, 'Actividad', 'fk_id_actividad'),
			'fkIdSubarea' => array(self::BELONGS_TO, 'SubArea', 'fk_id_sub_area'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'fk_id_actividad' => 'Fk Id Actividad',
			'fk_id_sub_area' => 'Fk Id Sub Area',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ActividadAreaActividad la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
