<?php
/**
 * Esta es la clase modelo para la tabla "edades_beneficiario".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'edades_beneficiario':
 * @property integer $id_edades_beneficiario
 * @property string $nombre_edades_beneficiario
 * @property string $descripcion_edades_beneficiario
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property BeneficiarioEstadoBeneficiario[] $beneficiarioEstadoBeneficiarios
 */
class EdadesBeneficiario extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'edades_beneficiario';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('nombre_edades_beneficiario', 'required'),
			array('nombre_edades_beneficiario', 'length', 'max'=>150),
			array('descripcion_edades_beneficiario', 'safe'),
			array('nombre_edades_beneficiario', 'unique','message'=>'Dato invalido valor duplicado'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'beneficiarioEstadoBeneficiarios' => array(self::HAS_MANY, 'BeneficiarioEstadoBeneficiario', 'fk_id_edades_beneficiario'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_edades_beneficiario' => 'Id Edades Beneficiario',
			'nombre_edades_beneficiario' => 'Nombre Edades Beneficiario',
			'descripcion_edades_beneficiario' => 'Descripcion Edades Beneficiario',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EdadesBeneficiario la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
