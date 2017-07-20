<?php
/**
 * Esta es la clase modelo para la tabla "familia_metodo_planificacion_familiar".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'familia_metodo_planificacion_familiar':
 * @property integer $fk_id_familia
 * @property integer $fk_id_metodo_planificacion_familiar
 */
class FamiliaMetodoPlanificacionFamiliar extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'familia_metodo_planificacion_familiar';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('fk_id_familia, fk_id_metodo_planificacion_familiar', 'required'),
			array('fk_id_familia, fk_id_metodo_planificacion_familiar', 'numerical', 'integerOnly'=>true),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'fkIdFamilia' => array(self::BELONGS_TO, 'Familia', 'fk_id_familia'),
			'fkIdMetodoPlanificacionFamiliar' => array(self::BELONGS_TO, 'MetodoPlanificacionFamiliar', 'fk_id_metodo_planificacion_familiar'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'fk_id_familia' => 'Fk Id Familia',
			'fk_id_metodo_planificacion_familiar' => 'Fk Id Metodo Planificacion Familiar',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FamiliaMetodoPlanificacionFamiliar la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
