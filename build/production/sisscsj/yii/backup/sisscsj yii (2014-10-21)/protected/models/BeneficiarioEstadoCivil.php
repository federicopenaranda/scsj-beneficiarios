<?php
/**
 * Esta es la clase modelo para la tabla "beneficiario_estado_civil".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'beneficiario_estado_civil':
 * @property integer $id_beneficiario_estado_civil
 * @property integer $fk_id_estado_civil
 * @property integer $fk_id_beneficiario
 * @property string $fecha_asignacion_beneficiario_estado_civil
 * @property integer $estado_beneficiario_estado_civil
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property Beneficiario $fkIdBeneficiario
 * @property EstadoCivil $fkIdEstadoCivil
 */
class BeneficiarioEstadoCivil extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'beneficiario_estado_civil';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('fk_id_estado_civil, fk_id_beneficiario, fecha_asignacion_beneficiario_estado_civil, estado_beneficiario_estado_civil', 'required'),
			array('fk_id_estado_civil, fk_id_beneficiario', 'numerical', 'integerOnly'=>true),
			#array('fecha_asignacion_beneficiario_estado_civil','date','format'=>'yyyy-MM-dd HH:mm:ss','message'=>'Formato invalido para la fecha'),
			array('estado_beneficiario_estado_civil','in','range'=>array(true,false,1,0),'allowEmpty'=>true,'message'=>'Error de seleccion'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'fkIdBeneficiario' => array(self::BELONGS_TO, 'Beneficiario', 'fk_id_beneficiario'),
			'fkIdEstadoCivil' => array(self::BELONGS_TO, 'EstadoCivil', 'fk_id_estado_civil'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_beneficiario_estado_civil' => 'Id Beneficiario Estado Civil',
			'fk_id_estado_civil' => 'Fk Id Estado Civil',
			'fk_id_beneficiario' => 'Fk Id Beneficiario',
			'fecha_asignacion_beneficiario_estado_civil' => 'Fecha Asignacion Beneficiario Estado Civil',
			'estado_beneficiario_estado_civil' => 'Estado Beneficiario Estado Civil',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BeneficiarioEstadoCivil la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
