<?php
/**
 * Esta es la clase modelo para la tabla "beneficiario_ocupacion".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'beneficiario_ocupacion':
 * @property integer $id_beneficiario_ocupacion
 * @property integer $fk_id_beneficiario
 * @property integer $fk_id_ocupacion
 * @property string $fecha_beneficiario_ocupacion
 * @property integer $estado_beneficiario_ocupacion
 * @property string $observacion_beneficiario_ocupacion
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property Beneficiario $fkIdBeneficiario
 * @property Ocupacion $fkIdOcupacion
 */
class BeneficiarioOcupacion extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'beneficiario_ocupacion';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('fk_id_beneficiario, fk_id_ocupacion, estado_beneficiario_ocupacion', 'required'),
			array('fk_id_beneficiario, fk_id_ocupacion, estado_beneficiario_ocupacion', 'numerical', 'integerOnly'=>true),
			array('observacion_beneficiario_ocupacion', 'safe'),
			#array('fecha_beneficiario_ocupacion','date','format'=>'yyyy-MM-ddT00:00:00','message'=>'Formato invalido para la fecha'),
			array('estado_beneficiario_ocupacion','in','range'=>array(true,false,1,0),'allowEmpty'=>true,'message'=>'Error de seleccion'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'fkIdBeneficiario' => array(self::BELONGS_TO, 'Beneficiario', 'fk_id_beneficiario'),
			'fkIdOcupacion' => array(self::BELONGS_TO, 'Ocupacion', 'fk_id_ocupacion'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_beneficiario_ocupacion' => 'Id Beneficiario Ocupacion',
			'fk_id_beneficiario' => 'Fk Id Beneficiario',
			'fk_id_ocupacion' => 'Fk Id Ocupacion',
			'fecha_beneficiario_ocupacion' => 'Fecha Beneficiario Ocupacion',
			'estado_beneficiario_ocupacion' => 'Estado Beneficiario Ocupacion',
			'observacion_beneficiario_ocupacion' => 'Observacion Beneficiario Ocupacion',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BeneficiarioOcupacion la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
