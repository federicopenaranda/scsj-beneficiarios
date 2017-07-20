<?php
/**
 * Esta es la clase modelo para la tabla "beneficiario_estado_beneficiario".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'beneficiario_estado_beneficiario':
 * @property integer $id_beneficiario_estado_beneficiario
 * @property integer $fk_id_estado_beneficiario
 * @property integer $fk_id_beneficiario
 * @property integer $fk_id_beneficiario_tipo
 * @property integer $fk_id_edades_beneficiario
 * @property integer $fk_id_tipo_actor_beneficiario
 * @property string $fecha_asignacion_estado_beneficiario
 * @property string $observaciones_beneficiario_estado_beneficiario
 * @property string $fecha_creacion_beneficiario_estado_beneficiario
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property Beneficiario $fkIdBeneficiario
 * @property BeneficiarioTipo $fkIdBeneficiarioTipo
 * @property EdadesBeneficiario $fkIdEdadesBeneficiario
 * @property EstadoBeneficiario $fkIdEstadoBeneficiario
 * @property TipoActorBeneficiario $fkIdTipoActorBeneficiario
 */
class BeneficiarioEstadoBeneficiario extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'beneficiario_estado_beneficiario';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('fk_id_estado_beneficiario, fk_id_beneficiario, fk_id_beneficiario_tipo, fk_id_edades_beneficiario, fk_id_tipo_actor_beneficiario', 'required'),
			array('fk_id_estado_beneficiario, fk_id_beneficiario, fk_id_beneficiario_tipo, fk_id_edades_beneficiario, fk_id_tipo_actor_beneficiario', 'numerical', 'integerOnly'=>true),
			array('observaciones_beneficiario_estado_beneficiario', 'length', 'max'=>45),
			array('fecha_asignacion_estado_beneficiario', 'safe'),
			#array('fecha_asignacion_estado_beneficiario','date','format'=>'yyyy-MM-ddT00:00:00','message'=>'Formato invalido para la fecha'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'fkIdBeneficiario' => array(self::BELONGS_TO, 'Beneficiario', 'fk_id_beneficiario'),
			'fkIdBeneficiarioTipo' => array(self::BELONGS_TO, 'BeneficiarioTipo', 'fk_id_beneficiario_tipo'),
			'fkIdEdadesBeneficiario' => array(self::BELONGS_TO, 'EdadesBeneficiario', 'fk_id_edades_beneficiario'),
			'fkIdEstadoBeneficiario' => array(self::BELONGS_TO, 'EstadoBeneficiario', 'fk_id_estado_beneficiario'),
			'fkIdTipoActorBeneficiario' => array(self::BELONGS_TO, 'TipoActorBeneficiario', 'fk_id_tipo_actor_beneficiario'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_beneficiario_estado_beneficiario' => 'Id Beneficiario Estado Beneficiario',
			'fk_id_estado_beneficiario' => 'Fk Id Estado Beneficiario',
			'fk_id_beneficiario' => 'Fk Id Beneficiario',
			'fk_id_beneficiario_tipo' => 'Fk Id Beneficiario Tipo',
			'fk_id_edades_beneficiario' => 'Fk Id Edades Beneficiario',
			'fk_id_tipo_actor_beneficiario' => 'Fk Id Tipo Actor Beneficiario',
			'fecha_asignacion_estado_beneficiario' => 'Fecha Asignacion Estado Beneficiario',
			'observaciones_beneficiario_estado_beneficiario' => 'Observaciones Beneficiario Estado Beneficiario',
			'fecha_creacion_beneficiario_estado_beneficiario' => 'Fecha Creacion Beneficiario Estado Beneficiario',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BeneficiarioEstadoBeneficiario la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
