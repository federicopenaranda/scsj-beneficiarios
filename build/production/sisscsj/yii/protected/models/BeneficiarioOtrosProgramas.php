<?php
/**
 * Esta es la clase modelo para la tabla "beneficiario_otros_programas".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'beneficiario_otros_programas':
 * @property integer $fk_id_beneficiario
 * @property integer $fk_id_otros_programas
 */
class BeneficiarioOtrosProgramas extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'beneficiario_otros_programas';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('fk_id_beneficiario, fk_id_otros_programas', 'required'),
			array('fk_id_beneficiario, fk_id_otros_programas', 'numerical', 'integerOnly'=>true),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'fkIdBeneficiario' => array(self::BELONGS_TO, 'Beneficiario', 'fk_id_beneficiario'),
			'fkIdOtrosProgramas' => array(self::BELONGS_TO, 'OtrosProgramas', 'fk_id_otros_programas'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'fk_id_beneficiario' => 'Fk Id Beneficiario',
			'fk_id_otros_programas' => 'Fk Id Otros Programas',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BeneficiarioOtrosProgramas la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
