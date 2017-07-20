<?php
/**
 * Esta es la clase modelo para la tabla "atencion_medica_enfermedad_comun".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'atencion_medica_enfermedad_comun':
 * @property integer $fk_id_enfermedad_comun
 * @property integer $fk_id_atencion_medica
 */
class AtencionMedicaEnfermedadComun extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'atencion_medica_enfermedad_comun';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('fk_id_enfermedad_comun, fk_id_atencion_medica', 'required'),
			array('fk_id_enfermedad_comun, fk_id_atencion_medica', 'numerical', 'integerOnly'=>true),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'fkIdEnfermedadComun' => array(self::BELONGS_TO, 'EnfermedadComun', 'fk_id_enfermedad_comun'),
			'fkIdEvaltencionMedica' => array(self::BELONGS_TO, 'EvalAtencionMedica', 'fk_id_atencion_medica'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'fk_id_enfermedad_comun' => 'Fk Id Enfermedad Comun',
			'fk_id_atencion_medica' => 'Fk Id Atencion Medica',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AtencionMedicaEnfermedadComun la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
