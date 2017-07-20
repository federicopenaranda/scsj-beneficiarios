<?php
/**
 * Esta es la clase modelo para la tabla "tipo_actor_beneficiario".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'tipo_actor_beneficiario':
 * @property integer $id_tipo_actor_beneficiario
 * @property string $nombre_tipo_actor_beneficiario
 * @property string $descripcion_tipo_actor_beneficiario
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property BeneficiarioEstadoBeneficiario[] $beneficiarioEstadoBeneficiarios
 */
class TipoActorBeneficiario extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'tipo_actor_beneficiario';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('nombre_tipo_actor_beneficiario', 'required'),
			array('nombre_tipo_actor_beneficiario', 'length', 'max'=>150),
			array('descripcion_tipo_actor_beneficiario', 'safe'),
			array('nombre_tipo_actor_beneficiario', 'unique','message'=>'Dato invalido valor duplicado'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations(){
		return array(
			'beneficiarioEstadoBeneficiarios' => array(self::HAS_MANY, 'BeneficiarioEstadoBeneficiario', 'fk_id_tipo_actor_beneficiario'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_tipo_actor_beneficiario' => 'Id Tipo Actor Beneficiario',
			'nombre_tipo_actor_beneficiario' => 'Nombre Tipo Actor Beneficiario',
			'descripcion_tipo_actor_beneficiario' => 'Descripcion Tipo Actor Beneficiario',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TipoActorBeneficiario la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
