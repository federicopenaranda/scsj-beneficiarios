<?php
/**
 * Esta es la clase modelo para la tabla "beneficiario_telefono".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'beneficiario_telefono':
 * @property integer $id_beneficiario_telefono
 * @property integer $fk_id_beneficiario
 * @property string $numero_beneficiario_telefono
 * @property string $tipo_telefono
 * @property integer $emergencia_beneficiario_telefono
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property Beneficiario $fkIdBeneficiario
 */
class BeneficiarioTelefono extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'beneficiario_telefono';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('fk_id_beneficiario, numero_beneficiario_telefono, tipo_telefono, emergencia_beneficiario_telefono', 'required'),
			array('fk_id_beneficiario, emergencia_beneficiario_telefono', 'numerical', 'integerOnly'=>true),
			array('numero_beneficiario_telefono', 'length', 'max'=>45),
			array('tipo_telefono','in','range'=>array('celular','fijo'),'allowEmpty'=>true,'message'=>'Error de seleccion'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'fkIdBeneficiario' => array(self::BELONGS_TO, 'Beneficiario', 'fk_id_beneficiario'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_beneficiario_telefono' => 'Id Beneficiario Telefono',
			'fk_id_beneficiario' => 'Fk Id Beneficiario',
			'numero_beneficiario_telefono' => 'Numero Beneficiario Telefono',
			'tipo_telefono' => 'Tipo Telefono',
			'emergencia_beneficiario_telefono' => 'Emergencia Beneficiario Telefono',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BeneficiarioTelefono la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
