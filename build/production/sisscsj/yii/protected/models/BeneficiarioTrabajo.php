<?php
/**
 * Esta es la clase modelo para la tabla "beneficiario_trabajo".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'beneficiario_trabajo':
 * @property integer $id_beneficiario_trabajo
 * @property integer $fk_id_beneficiario
 * @property integer $monto_ingreso_beneficiario_trabajo
 * @property string $tipo_trabajo_beneficiario_trabajo
 * @property integer $estado_beneficiario_trabajo
 * @property string $fecha_creacion_beneficiario_trabajo
 * @property string $descripcion_beneficiario_trabajo
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property Beneficiario $fkIdBeneficiario
 */
class BeneficiarioTrabajo extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'beneficiario_trabajo';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('fk_id_beneficiario, tipo_trabajo_beneficiario_trabajo, estado_beneficiario_trabajo', 'required'),
			array('fk_id_beneficiario, monto_ingreso_beneficiario_trabajo', 'numerical', 'integerOnly'=>true),
			array('descripcion_beneficiario_trabajo', 'safe'),
			array('tipo_trabajo_beneficiario_trabajo','in','range'=>array('eventual','permanente',"eventual","permanente"),'allowEmpty'=>true,'message'=>'Error de seleccion'),
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
			'id_beneficiario_trabajo' => 'Id Beneficiario Trabajo',
			'fk_id_beneficiario' => 'Fk Id Beneficiario',
			'monto_ingreso_beneficiario_trabajo' => 'Monto Ingreso Beneficiario Trabajo',
			'tipo_trabajo_beneficiario_trabajo' => 'Tipo Trabajo Beneficiario Trabajo',
			'estado_beneficiario_trabajo' => 'Estado Beneficiario Trabajo',
			'fecha_creacion_beneficiario_trabajo' => 'Fecha Creacion Beneficiario Trabajo',
			'descripcion_beneficiario_trabajo' => 'Descripcion Beneficiario Trabajo',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BeneficiarioTrabajo la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
