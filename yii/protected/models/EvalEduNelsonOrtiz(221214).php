<?php
/**
 * Esta es la clase modelo para la tabla "eval_edu_nelson_ortiz".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'eval_edu_nelson_ortiz':
 * @property integer $id_nelson_ortiz
 * @property integer $fk_id_tipo_consulta
 * @property integer $fk_id_usuario
 * @property integer $fk_id_beneficiario
 * @property string $fecha_nelson_ortiz
 * @property string $observaciones_nelson_ortiz
 * @property string $motricidad_gruesa_nelson_ortiz
 * @property string $audicion_lenguaje_nelson_ortiz
 * @property string $motricidad_fina_nelson_ortiz
 * @property string $personal_social_nelson_ortiz
 * @property string $fecha_creacion_eval_edu_nelson_ortiz
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property TipoConsulta $fkIdTipoConsulta
 * @property Usuario $fkIdUsuario
 * @property Beneficiario $fkIdBeneficiario
 */
class EvalEduNelsonOrtiz extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'eval_edu_nelson_ortiz';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('fk_id_tipo_consulta, fk_id_beneficiario, fecha_nelson_ortiz', 'required'),
			array('fk_id_tipo_consulta, fk_id_usuario, fk_id_beneficiario', 'numerical', 'integerOnly'=>true),
			array('observaciones_nelson_ortiz, motricidad_gruesa_nelson_ortiz, audicion_lenguaje_nelson_ortiz, motricidad_fina_nelson_ortiz, personal_social_nelson_ortiz', 'safe'),			
			#array('fecha_nelson_ortiz','date','format'=>'yyyy-MM-dd HH:mm:ss','message'=>'Formato invalido para la fecha'),
			array('motricidad_gruesa_nelson_ortiz, audicion_lenguaje_nelson_ortiz, motricidad_fina_nelson_ortiz, personal_social_nelson_ortiz','in','range'=>array('alerta','medio_bajo','medio_alto','alto'),'allowEmpty'=>true,'message'=>'Error de seleccion'),
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
			'id_nelson_ortiz' => 'Id Nelson Ortiz',
			'fk_id_tipo_consulta' => 'Fk Id Tipo Consulta',
			'fk_id_usuario' => 'Fk Id Usuario',
			'fk_id_beneficiario' => 'Fk Id Beneficiario',
			'fecha_nelson_ortiz' => 'Fecha Nelson Ortiz',
			'observaciones_nelson_ortiz' => 'Observaciones Nelson Ortiz',
			'motricidad_gruesa_nelson_ortiz' => 'Motricidad Gruesa Nelson Ortiz',
			'audicion_lenguaje_nelson_ortiz' => 'Audicion Lenguaje Nelson Ortiz',
			'motricidad_fina_nelson_ortiz' => 'Motricidad Fina Nelson Ortiz',
			'personal_social_nelson_ortiz' => 'Personal Social Nelson Ortiz',
			'fecha_creacion_eval_edu_nelson_ortiz' => 'Fecha Creacion Eval Edu Nelson Ortiz',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EvalEduNelsonOrtiz la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
