<?php
/**
 * Esta es la clase modelo para la tabla "eval_odontologia".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'eval_odontologia':
 * @property integer $id_odontologia
 * @property integer $fk_id_tipo_consulta
 * @property integer $fk_id_usuario
 * @property integer $fk_id_beneficiario
 * @property string $fecha_odontologia
 * @property string $observaciones_odontologia
 * @property double $cpitn_odontologia
 * @property string $higiene_odontologia
 * @property double $indice_may_c_odontologia
 * @property double $indice_may_p_odontologia
 * @property double $indice_may_d_odontologia
 * @property double $indice_may_o_odontologia
 * @property double $indice_min_c_odontologia
 * @property double $indice_min_e_odontologia
 * @property double $indice_min_o_odontologia
 * @property string $fecha_creacion_eval_odontologia
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property TipoConsulta $fkIdTipoConsulta
 * @property Usuario $fkIdUsuario
 * @property Beneficiario $fkIdBeneficiario
 */
class EvalOdontologia extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'eval_odontologia';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('fk_id_tipo_consulta, fk_id_beneficiario, fecha_odontologia', 'required'),
			array('fk_id_tipo_consulta, fk_id_usuario, fk_id_beneficiario', 'numerical', 'integerOnly'=>true),
			array('cpitn_odontologia, indice_may_c_odontologia, indice_may_p_odontologia, indice_may_d_odontologia, indice_may_o_odontologia, indice_min_c_odontologia, indice_min_e_odontologia, indice_min_o_odontologia', 'numerical'),
			array('observaciones_odontologia, higiene_odontologia', 'safe'),
			#array('fecha_odontologia','date','format'=>'yyyy-MM-dd HH:mm:ss','message'=>'Formato invalido para la fecha'),
			array('higiene_odontologia','in','range'=>array('buena','regular','mala'),'allowEmpty'=>true,'message'=>'Error de seleccion'),
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
			'id_odontologia' => 'Id Odontologia',
			'fk_id_tipo_consulta' => 'Fk Id Tipo Consulta',
			'fk_id_usuario' => 'Fk Id Usuario',
			'fk_id_beneficiario' => 'Fk Id Beneficiario',
			'fecha_odontologia' => 'Fecha Odontologia',
			'observaciones_odontologia' => 'Observaciones Odontologia',
			'cpitn_odontologia' => 'Cpitn Odontologia',
			'higiene_odontologia' => 'Higiene Odontologia',
			'indice_may_c_odontologia' => 'Indice May C Odontologia',
			'indice_may_p_odontologia' => 'Indice May P Odontologia',
			'indice_may_d_odontologia' => 'Indice May D Odontologia',
			'indice_may_o_odontologia' => 'Indice May O Odontologia',
			'indice_min_c_odontologia' => 'Indice Min C Odontologia',
			'indice_min_e_odontologia' => 'Indice Min E Odontologia',
			'indice_min_o_odontologia' => 'Indice Min O Odontologia',
			'fecha_creacion_eval_odontologia' => 'Fecha Creacion Eval Odontologia',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EvalOdontologia la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
