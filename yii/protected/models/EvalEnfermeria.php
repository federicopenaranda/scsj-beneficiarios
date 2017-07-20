<?php
/**
 * Esta es la clase modelo para la tabla "eval_enfermeria".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'eval_enfermeria':
 * @property integer $id_enfermeria
 * @property integer $fk_id_tipo_consulta
 * @property integer $fk_id_usuario
 * @property integer $fk_id_vacuna
 * @property integer $fk_id_beneficiario
 * @property string $fecha_enfermeria
 * @property string $observaciones_enfermeria
 * @property string $fecha_creacion_enfermeria
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property TipoConsulta $fkIdTipoConsulta
 * @property Usuario $fkIdUsuario
 * @property Beneficiario $fkIdBeneficiario
 * @property Vacuna $fkIdVacuna
 */
class EvalEnfermeria extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'eval_enfermeria';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('fk_id_tipo_consulta, fk_id_vacuna, fk_id_beneficiario, fecha_enfermeria', 'required'),
			array('fk_id_tipo_consulta, fk_id_usuario, fk_id_vacuna, fk_id_beneficiario', 'numerical', 'integerOnly'=>true),
			array('observaciones_enfermeria', 'safe'),
			#array('fecha_enfermeria','date','format'=>'yyyy-MM-dd HH:mm:ss','message'=>'Formato invalido para la fecha'),
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
			'fkIdVacuna' => array(self::BELONGS_TO, 'Vacuna', 'fk_id_vacuna'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_enfermeria' => 'Id Enfermeria',
			'fk_id_tipo_consulta' => 'Fk Id Tipo Consulta',
			'fk_id_usuario' => 'Fk Id Usuario',
			'fk_id_vacuna' => 'Fk Id Vacuna',
			'fk_id_beneficiario' => 'Fk Id Beneficiario',
			'fecha_enfermeria' => 'Fecha Enfermeria',
			'observaciones_enfermeria' => 'Observaciones Enfermeria',
			'fecha_creacion_enfermeria' => 'Fecha Creacion Enfermeria',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EvalEnfermeria la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
