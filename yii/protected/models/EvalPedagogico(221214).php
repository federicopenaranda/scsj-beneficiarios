<?php
/**
 * Esta es la clase modelo para la tabla "eval_pedagogico".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'eval_pedagogico':
 * @property integer $id_pedagogico
 * @property integer $fk_id_usuario
 * @property integer $fk_id_beneficiario
 * @property string $fecha_pedagogico
 * @property string $observaciones_pedagogico
 * @property string $matematicas_pedagogico
 * @property string $lenguaje_pedagogico
 * @property string $personal_social_pedagogico
 * @property string $desarrollo_habilidades_pedagogico
 * @property string $fecha_creacion_eval_pedagogico
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property Usuario $fkIdUsuario
 * @property Beneficiario $fkIdBeneficiario
 */
class EvalPedagogico extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'eval_pedagogico';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('fk_id_beneficiario, fecha_pedagogico', 'required'),
			array('fk_id_usuario, fk_id_beneficiario', 'numerical', 'integerOnly'=>true),
			array('observaciones_pedagogico, matematicas_pedagogico, lenguaje_pedagogico, personal_social_pedagogico, desarrollo_habilidades_pedagogico', 'safe'),
			#array('fecha_pedagogico','date','format'=>'yyyy-MM-dd HH:mm:ss','message'=>'Formato invalido para la fecha'),
			array('matematicas_pedagogico,lenguaje_pedagogico,personal_social_pedagogico,desarrollo_habilidades_pedagogico','in','range'=>array('desarrollo_aceptable','desarrollo_optimo','desarrollo_pleno','en_desarrollo'),'allowEmpty'=>true,'message'=>'Error de seleccion'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
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
			'id_pedagogico' => 'Id Pedagogico',
			'fk_id_usuario' => 'Fk Id Usuario',
			'fk_id_beneficiario' => 'Fk Id Beneficiario',
			'fecha_pedagogico' => 'Fecha Pedagogico',
			'observaciones_pedagogico' => 'Observaciones Pedagogico',
			'matematicas_pedagogico' => 'Matematicas Pedagogico',
			'lenguaje_pedagogico' => 'Lenguaje Pedagogico',
			'personal_social_pedagogico' => 'Personal Social Pedagogico',
			'desarrollo_habilidades_pedagogico' => 'Desarrollo Habilidades Pedagogico',
			'fecha_creacion_eval_pedagogico' => 'Fecha Creacion Eval Pedagogico',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EvalPedagogico la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
