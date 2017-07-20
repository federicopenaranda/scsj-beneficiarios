<?php
/**
 * Esta es la clase modelo para la tabla "beneficiario_asistencia".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'beneficiario_asistencia':
 * @property integer $id_beneficiario_asistencia
 * @property integer $fk_id_asistencia
 * @property integer $fk_id_beneficiario
 * @property integer $fk_id_estado_asistencia
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property Asistencia $fkIdAsistencia
 * @property Beneficiario $fkIdBeneficiario
 * @property EstadoAsistencia $fkIdEstadoAsistencia
 */
class BeneficiarioAsistencia extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'beneficiario_asistencia';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('fk_id_asistencia, fk_id_beneficiario', 'required'),
			array('fk_id_asistencia, fk_id_beneficiario, fk_id_estado_asistencia', 'numerical', 'integerOnly'=>true),			
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'fkIdAsistencia' => array(self::BELONGS_TO, 'Asistencia', 'fk_id_asistencia'),
			'fkIdBeneficiario' => array(self::BELONGS_TO, 'Beneficiario', 'fk_id_beneficiario'),
			'fkIdEstadoAsistencia' => array(self::BELONGS_TO, 'EstadoAsistencia', 'fk_id_estado_asistencia'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_beneficiario_asistencia' => 'Id Beneficiario Asistencia',
			'fk_id_asistencia' => 'Fk Id Asistencia',
			'fk_id_beneficiario' => 'Fk Id Beneficiario',
			'fk_id_estado_asistencia' => 'Fk Id Estado Asistencia',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BeneficiarioAsistencia la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
