<?php
/**
 * Esta es la clase modelo para la tabla "gestion_beneficiario".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'gestion_beneficiario':
 * @property integer $id_gestion_beneficiario
 * @property integer $fk_id_beneficiario
 * @property integer $fk_id_gestion
 * @property integer $estado_gestion_beneficiario
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property Beneficiario $fkIdBeneficiario
 * @property Gestion $fkIdGestion
 * @property UsuarioBeneficiario[] $usuarioBeneficiarios
 */
class GestionBeneficiario extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'gestion_beneficiario';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('fk_id_beneficiario, fk_id_gestion, estado_gestion_beneficiario', 'required'),
			array('fk_id_beneficiario, fk_id_gestion, estado_gestion_beneficiario', 'numerical', 'integerOnly'=>true),
			array('estado_gestion_beneficiario','in','range'=>array(true,false,1,0),'allowEmpty'=>true,'message'=>'Error de seleccion'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'fkIdBeneficiario' => array(self::BELONGS_TO, 'Beneficiario', 'fk_id_beneficiario'),
			'fkIdGestion' => array(self::BELONGS_TO, 'Gestion', 'fk_id_gestion'),
			'usuarioBeneficiarios' => array(self::HAS_MANY, 'UsuarioBeneficiario', 'fk_id_gestion_beneficiario'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_gestion_beneficiario' => 'Id Gestion Beneficiario',
			'fk_id_beneficiario' => 'Fk Id Beneficiario',
			'fk_id_gestion' => 'Fk Id Gestion',
			'estado_gestion_beneficiario' => 'Estado Gestion Beneficiario',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return GestionBeneficiario la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
