<?php
/**
 * Esta es la clase modelo para la tabla "beneficiario_patrocinador".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'beneficiario_patrocinador':
 * @property integer $fk_id_beneficiario
 * @property integer $fk_id_patrocinador
 * @property string $numero_caso_beneficiario_patrocinador
 * @property string $numero_ninio_beneficiario_patrocinador
 * @property string $codigo_donante_beneficiario_patrocinador
 */
class BeneficiarioPatrocinador extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'beneficiario_patrocinador';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('fk_id_beneficiario, fk_id_patrocinador', 'required'),
			array('fk_id_beneficiario, fk_id_patrocinador', 'numerical', 'integerOnly'=>true),
			array('numero_caso_beneficiario_patrocinador, numero_ninio_beneficiario_patrocinador, codigo_donante_beneficiario_patrocinador', 'length', 'max'=>45),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'fkIdBeneficiario' => array(self::BELONGS_TO, 'Beneficiario', 'fk_id_beneficiario'),
			'fkIdPatrocinador' => array(self::BELONGS_TO, 'Patrocinador', 'fk_id_patrocinador'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'fk_id_beneficiario' => 'Fk Id Beneficiario',
			'fk_id_patrocinador' => 'Fk Id Patrocinador',
			'numero_caso_beneficiario_patrocinador' => 'Numero Caso Beneficiario Patrocinador',
			'numero_ninio_beneficiario_patrocinador' => 'Numero Ninio Beneficiario Patrocinador',
			'codigo_donante_beneficiario_patrocinador' => 'Codigo Donante Beneficiario Patrocinador',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BeneficiarioPatrocinador la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
