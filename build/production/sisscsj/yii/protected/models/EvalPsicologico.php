<?php
/**
 * Esta es la clase modelo para la tabla "eval_psicologico".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'eval_psicologico':
 * @property integer $id_psicologico
 * @property integer $fk_id_tipo_consulta
 * @property integer $fk_id_usuario
 * @property integer $fk_id_tipo_problematica
 * @property integer $fk_id_sub_area_referencia
 * @property integer $fk_id_beneficiario
 * @property string $fecha_psicologico
 * @property string $observaciones_psicologico
 * @property string $diagnostico_psicologico
 * @property string $tratamiento_psicologico
 * @property string $fecha_creacion_eval_psicologico
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property TipoConsulta $fkIdTipoConsulta
 * @property Usuario $fkIdUsuario
 * @property Beneficiario $fkIdBeneficiario
 * @property SubArea $fkIdSubAreaReferencia
 * @property TipoProblematica $fkIdTipoProblematica
 */
class EvalPsicologico extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'eval_psicologico';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('fk_id_tipo_consulta, fk_id_tipo_problematica, fk_id_beneficiario, fecha_psicologico', 'required'),
			array('fk_id_tipo_consulta, fk_id_usuario, fk_id_tipo_problematica, fk_id_sub_area_referencia, fk_id_beneficiario', 'numerical', 'integerOnly'=>true),
			array('observaciones_psicologico, diagnostico_psicologico, tratamiento_psicologico', 'safe'),
			#array('fecha_psicologico','date','format'=>'yyyy-MM-dd HH:mm:ss','message'=>'Formato invalido para la fecha'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'fkIdTipoConsulta' => array(self::BELONGS_TO, 'TipoConsulta', 'fk_id_tipo_consulta'),
			'fkIdUsuario' => array(self::BELONGS_TO, 'Usuario', 'fk_id_usuario'),
			'fkIdBeneficiario' => array(self::BELONGS_TO, 'Beneficiario', 'fk_id_beneficiario'),
			'fkIdSubAreaReferencia' => array(self::BELONGS_TO, 'SubArea', 'fk_id_sub_area_referencia'),
			'fkIdTipoProblematica' => array(self::BELONGS_TO, 'TipoProblematica', 'fk_id_tipo_problematica'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_psicologico' => 'Id Psicologico',
			'fk_id_tipo_consulta' => 'Fk Id Tipo Consulta',
			'fk_id_usuario' => 'Fk Id Usuario',
			'fk_id_tipo_problematica' => 'Fk Id Tipo Problematica',
			'fk_id_sub_area_referencia' => 'Fk Id Sub Area Referencia',
			'fk_id_beneficiario' => 'Fk Id Beneficiario',
			'fecha_psicologico' => 'Fecha Psicologico',
			'observaciones_psicologico' => 'Observaciones Psicologico',
			'diagnostico_psicologico' => 'Diagnostico Psicologico',
			'tratamiento_psicologico' => 'Tratamiento Psicologico',
			'fecha_creacion_eval_psicologico' => 'Fecha Creacion Eval Psicologico',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EvalPsicologico la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
