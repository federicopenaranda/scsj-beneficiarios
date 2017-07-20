<?php
/**
 * Esta es la clase modelo para la tabla "beneficiario_tipo".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'beneficiario_tipo':
 * @property integer $id_beneficiario_tipo
 * @property string $nombre_beneficiario_tipo
 * @property string $descripcion_beneficiario_tipo
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property BeneficiarioEstadoBeneficiario[] $beneficiarioEstadoBeneficiarios
 */
class BeneficiarioTipo extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'beneficiario_tipo';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('nombre_beneficiario_tipo', 'required'),
			array('nombre_beneficiario_tipo', 'length', 'max'=>200),
			array('descripcion_beneficiario_tipo', 'safe'),
			array('nombre_beneficiario_tipo', 'unique','message'=>'Dato invalido valor duplicado'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'beneficiarioEstadoBeneficiarios' => array(self::HAS_MANY, 'BeneficiarioEstadoBeneficiario', 'fk_id_beneficiario_tipo'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_beneficiario_tipo' => 'Id Beneficiario Tipo',
			'nombre_beneficiario_tipo' => 'Nombre Beneficiario Tipo',
			'descripcion_beneficiario_tipo' => 'Descripcion Beneficiario Tipo',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BeneficiarioTipo la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
