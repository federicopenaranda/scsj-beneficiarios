<?php
/**
 * Esta es la clase modelo para la tabla "beneficiario_unidad_educativa".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'beneficiario_unidad_educativa':
 * @property integer $fk_id_unidad_educativa
 * @property integer $fk_id_beneficiario
 * @property string $fecha_creacion_beneficiario_unidad_educativa
 * @property integer $estado_beneficiario_unidad_educativa
 */
class BeneficiarioUnidadEducativa extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'beneficiario_unidad_educativa';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('fk_id_unidad_educativa, fk_id_beneficiario, estado_beneficiario_unidad_educativa', 'required'),
			array('fk_id_unidad_educativa, fk_id_beneficiario', 'numerical', 'integerOnly'=>true),
			array('estado_beneficiario_unidad_educativa','in','range'=>array(true,false,1,0),'allowEmpty'=>true,'message'=>'Error de seleccion'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'fkIdUnidadEducativa' => array(self::BELONGS_TO, 'UnidadEducativa', 'fk_id_unidad_educativa'),
			'fkIdBeneficiario' => array(self::BELONGS_TO, 'Beneficiario', 'fk_id_beneficiario'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'fk_id_unidad_educativa' => 'Fk Id Unidad Educativa',
			'fk_id_beneficiario' => 'Fk Id Beneficiario',
			'fecha_creacion_beneficiario_unidad_educativa' => 'Fecha Creacion Beneficiario Unidad Educativa',
			'estado_beneficiario_unidad_educativa' => 'Estado Beneficiario Unidad Educativa',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BeneficiarioUnidadEducativa la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
