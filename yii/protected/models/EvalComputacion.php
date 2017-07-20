<?php
/**
 * Esta es la clase modelo para la tabla "eval_computacion".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'eval_computacion':
 * @property integer $id_eval_computacion
 * @property integer $fk_id_usuario
 * @property integer $fk_id_beneficiario
 * @property string $tipo_eval_computacion
 * @property string $fecha_eval_computacion
 * @property string $evaluacion_computacion
 * @property string $observaciones_eval_computacion
 * @property string $fecha_creacion_eval_computacion
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property Beneficiario $fkIdBeneficiario
 * @property Usuario $fkIdUsuario
 */
class EvalComputacion extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'eval_computacion';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('fk_id_beneficiario, tipo_eval_computacion, fecha_eval_computacion, evaluacion_computacion', 'required'),
			array('fk_id_usuario, fk_id_beneficiario', 'numerical', 'integerOnly'=>true),
			array('observaciones_eval_computacion', 'safe'),
			#array('fecha_eval_computacion','date','format'=>'yyyy-MM-dd','message'=>'Formato invalido para la fecha'),
			array('tipo_eval_computacion','in','range'=>array('inicial','final'),'allowEmpty'=>true,'message'=>'Error de seleccion'),
			array('evaluacion_computacion','in','range'=>array('desarrollo_aceptable','desarrollo_optimo','desarrollo_pleno','en_desarrollo'),'allowEmpty'=>true,'message'=>'Error de seleccion'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'fkIdBeneficiario' => array(self::BELONGS_TO, 'Beneficiario', 'fk_id_beneficiario'),
			'fkIdUsuario' => array(self::BELONGS_TO, 'Usuario', 'fk_id_usuario'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_eval_computacion' => 'Id Eval Computacion',
			'fk_id_usuario' => 'Fk Id Usuario',
			'fk_id_beneficiario' => 'Fk Id Beneficiario',
			'tipo_eval_computacion' => 'Tipo Eval Computacion',
			'fecha_eval_computacion' => 'Fecha Eval Computacion',
			'evaluacion_computacion' => 'Evaluacion Computacion',
			'observaciones_eval_computacion' => 'Observaciones Eval Computacion',
			'fecha_creacion_eval_computacion' => 'Fecha Creacion Eval Computacion',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EvalComputacion la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
