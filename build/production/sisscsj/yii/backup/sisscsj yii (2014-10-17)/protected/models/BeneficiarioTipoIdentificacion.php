<?php
/**
 * Esta es la clase modelo para la tabla "beneficiario_tipo_identificacion".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'beneficiario_tipo_identificacion':
 * @property integer $fk_id_beneficiario
 * @property integer $fk_id_tipo_identificacion
 * @property string $numero_tipo_identificacion
 * @property integer $primario_tipo_identificacion
 */
class BeneficiarioTipoIdentificacion extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'beneficiario_tipo_identificacion';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('fk_id_beneficiario, fk_id_tipo_identificacion, numero_tipo_identificacion, primario_tipo_identificacion', 'required'),
			array('fk_id_beneficiario, fk_id_tipo_identificacion, primario_tipo_identificacion', 'numerical', 'integerOnly'=>true),
			array('numero_tipo_identificacion', 'length', 'max'=>45),
			array('numero_tipo_identificacion', 'unique','message'=>'Dato invalido valor duplicado'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'fkIdBeneficiario' => array(self::BELONGS_TO, 'Beneficiario', 'fk_id_beneficiario'),
			'fkIdIdentificacion' => array(self::BELONGS_TO, 'TipoIdentificacion', 'fk_id_tipo_identificacion'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'fk_id_beneficiario' => 'Llave primaria compuesta:

fk_id_beneficiario y fk_id_tipo_identificacion

No debe existir dos registros del mismo beneficiario con el mismo tipo de documento de identificación.',
			'fk_id_tipo_identificacion' => 'Fk Id Tipo Identificacion',
			'numero_tipo_identificacion' => 'Campo para almacenar el valor o número del tipo de documento de identificación registrado.

Restricciones:
- Debe ser único dentro de la tabla.
- No debe ser un valor nulo.

Tipo de Dato:
- Texto de 45 caracteres de larg',
			'primario_tipo_identificacion' => 'Campo para identificar cual es el tipo de documento de identificación del beneficiario que se utilizará principalmente.

Restricciones:
- No debe ser un valor nulo.

Tipo de Dat',
		);
	}	

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BeneficiarioTipoIdentificacion la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
