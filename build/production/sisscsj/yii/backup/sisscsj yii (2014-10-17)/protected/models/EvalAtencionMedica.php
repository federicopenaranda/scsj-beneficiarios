<?php
/**
 * Esta es la clase modelo para la tabla "eval_atencion_medica".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'eval_atencion_medica':
 * @property integer $id_atencion_medica
 * @property integer $fk_id_tipo_consulta
 * @property integer $fk_id_usuario
 * @property integer $fk_id_diagnostico
 * @property integer $fk_id_beneficiario
 * @property string $fecha_atencion_medica
 * @property string $observaciones_atencion_medica
 * @property string $fecha_creacion_eval_atencion_medica
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property EnfermedadComun[] $enfermedadComuns
 * @property Beneficiario $fkIdBeneficiario
 * @property Diagnostico $fkIdDiagnostico
 * @property TipoConsulta $fkIdTipoConsulta
 * @property Usuario $fkIdUsuario
 */
class EvalAtencionMedica extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'eval_atencion_medica';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('fk_id_tipo_consulta, fk_id_diagnostico, fk_id_beneficiario, fecha_atencion_medica', 'required'),
			array('fk_id_tipo_consulta, fk_id_usuario, fk_id_diagnostico, fk_id_beneficiario', 'numerical', 'integerOnly'=>true),
			array('observaciones_atencion_medica', 'safe'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'enfermedadComuns' => array(self::MANY_MANY, 'EnfermedadComun', 'atencion_medica_enfermedad_comun(fk_id_atencion_medica, fk_id_enfermedad_comun)'),
			'fkIdBeneficiario' => array(self::BELONGS_TO, 'Beneficiario', 'fk_id_beneficiario'),
			'fkIdDiagnostico' => array(self::BELONGS_TO, 'Diagnostico', 'fk_id_diagnostico'),
			'fkIdTipoConsulta' => array(self::BELONGS_TO, 'TipoConsulta', 'fk_id_tipo_consulta'),
			'fkIdUsuario' => array(self::BELONGS_TO, 'Usuario', 'fk_id_usuario'),
			
			'atencionMedicaEnfermedadComuns'=>array(self::HAS_MANY,'AtencionMedicaEnfermedadComun','fk_id_atencion_medica'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_atencion_medica' => 'Id Atencion Medica',
			'fk_id_tipo_consulta' => 'Fk Id Tipo Consulta',
			'fk_id_usuario' => 'Fk Id Usuario',
			'fk_id_diagnostico' => 'Fk Id Diagnostico',
			'fk_id_beneficiario' => 'Fk Id Beneficiario',
			'fecha_atencion_medica' => 'Fecha Atencion Medica',
			'observaciones_atencion_medica' => 'Observaciones Atencion Medica',
			'fecha_creacion_eval_atencion_medica' => 'Fecha Creacion Eval Atencion Medica',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EvalAtencionMedica la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
