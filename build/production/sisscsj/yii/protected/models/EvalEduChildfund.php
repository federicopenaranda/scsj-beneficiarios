<?php
/**
 * Esta es la clase modelo para la tabla "eval_edu_childfund".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'eval_edu_childfund':
 * @property integer $id_childfund
 * @property integer $fk_id_tipo_consulta
 * @property integer $fk_id_usuario
 * @property integer $fk_id_beneficiario
 * @property string $fecha_childfund
 * @property string $observaciones_childfund
 * @property string $evaluacion_childfund
 * @property string $fecha_creacion_eval_edu_childfund
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property TipoConsulta $fkIdTipoConsulta
 * @property Usuario $fkIdUsuario
 * @property Beneficiario $fkIdBeneficiario
 */
class EvalEduChildfund extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'eval_edu_childfund';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('fk_id_tipo_consulta, fk_id_beneficiario, fecha_childfund, evaluacion_childfund', 'required'),
			array('fk_id_tipo_consulta, fk_id_usuario, fk_id_beneficiario', 'numerical', 'integerOnly'=>true),
			array('observaciones_childfund', 'safe'),
			#array('fecha_childfund','date','format'=>'yyyy-MM-dd HH:mm:ss','message'=>'Formato invalido para la fecha'),
			array('evaluacion_childfund','in','range'=>array('sano','observacion_desarrollo','observacion_crecimiento','observacion_desarrollo_y_crecimiento','riesgo_desarrollo','riesgo_crecimiento','riesgo_desarrollo_y_cremiento'),'allowEmpty'=>true,'message'=>'Error de seleccion'),
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
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_childfund' => 'Id Childfund',
			'fk_id_tipo_consulta' => 'Fk Id Tipo Consulta',
			'fk_id_usuario' => 'Fk Id Usuario',
			'fk_id_beneficiario' => 'Fk Id Beneficiario',
			'fecha_childfund' => 'Fecha Childfund',
			'observaciones_childfund' => 'Observaciones Childfund',
			'evaluacion_childfund' => 'Evaluacion Childfund',
			'fecha_creacion_eval_edu_childfund' => 'Fecha Creacion Eval Edu Childfund',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EvalEduChildfund la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
