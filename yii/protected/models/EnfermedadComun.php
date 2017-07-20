<?php
/**
 * Esta es la clase modelo para la tabla "enfermedad_comun".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'enfermedad_comun':
 * @property integer $id_enfermedad_comun
 * @property string $nombre_enfermedad_comun
 * @property string $descripcion_enfermedad_comun
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property EvalAtencionMedica[] $evalAtencionMedicas
 */
class EnfermedadComun extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'enfermedad_comun';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('nombre_enfermedad_comun', 'required'),
			array('nombre_enfermedad_comun', 'length', 'max'=>250),
			array('descripcion_enfermedad_comun', 'safe'),
			array('nombre_enfermedad_comun', 'unique','message'=>'Dato invalido valor duplicado'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'evalAtencionMedicas' => array(self::MANY_MANY, 'EvalAtencionMedica', 'atencion_medica_enfermedad_comun(fk_id_enfermedad_comun, fk_id_atencion_medica)'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_enfermedad_comun' => 'Id Enfermedad Comun',
			'nombre_enfermedad_comun' => 'Nombre Enfermedad Comun',
			'descripcion_enfermedad_comun' => 'Descripcion Enfermedad Comun',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EnfermedadComun la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
