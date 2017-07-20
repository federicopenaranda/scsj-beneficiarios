<?php
/**
 * Esta es la clase modelo para la tabla "beneficiario_entidad".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'beneficiario_entidad':
 * @property integer $id_beneficiario_entidad
 * @property integer $fk_id_beneficiario
 * @property integer $fk_id_entidad
 * @property string $fecha_vinculacion_beneficiario_entidad
 * @property string $fecha_retiro_beneficiario_entidad
 * @property string $razon_retiro_beneficiario
 * @property integer $estado_beneficiario_entidad
 * @property string $fecha_creacion_beneficiario_entidad
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property Beneficiario $fkIdBeneficiario
 * @property Entidad $fkIdEntidad
 */
class BeneficiarioEntidad extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'beneficiario_entidad';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('fk_id_beneficiario, fk_id_entidad, fecha_vinculacion_beneficiario_entidad, estado_beneficiario_entidad', 'required'),
			array('fk_id_beneficiario, fk_id_entidad, estado_beneficiario_entidad', 'numerical', 'integerOnly'=>true),
			array('razon_retiro_beneficiario', 'length', 'max'=>45),
			array('fecha_retiro_beneficiario_entidad', 'safe'),
			#array('fecha_vinculacion_beneficiario_entidad','date','format'=>'yyyy-MM-dd','message'=>'Formato invalido para la fecha'),
			#array('fecha_retiro_beneficiario_entidad','date','format'=>'yyyy-MM-dd','message'=>'Formato invalido para la fecha'),
			array('estado_beneficiario_entidad','in','range'=>array(true,false),'allowEmpty'=>true,'message'=>'Error de seleccion'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'fkIdBeneficiario' => array(self::BELONGS_TO, 'Beneficiario', 'fk_id_beneficiario'),
			'fkIdEntidad' => array(self::BELONGS_TO, 'Entidad', 'fk_id_entidad'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_beneficiario_entidad' => 'Id Beneficiario Entidad',
			'fk_id_beneficiario' => 'Fk Id Beneficiario',
			'fk_id_entidad' => 'Fk Id Entidad',
			'fecha_vinculacion_beneficiario_entidad' => 'Fecha Vinculacion Beneficiario Entidad',
			'fecha_retiro_beneficiario_entidad' => 'Fecha Retiro Beneficiario Entidad',
			'razon_retiro_beneficiario' => 'Razon Retiro Beneficiario',
			'estado_beneficiario_entidad' => 'Estado Beneficiario Entidad',
			'fecha_creacion_beneficiario_entidad' => 'Fecha Creacion Beneficiario Entidad',
		);
	}
		
	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BeneficiarioEntidad la clase modelo estatico
	 */
	public static function model($className=__CLASS__){
		return parent::model($className);
	}
}
