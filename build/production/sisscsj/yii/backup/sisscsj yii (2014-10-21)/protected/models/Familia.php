<?php
/**
 * Esta es la clase modelo para la tabla "familia".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'familia':
 * @property integer $id_familia
 * @property string $codigo_familia
 * @property string $codigo_familia_antiguo
 * @property integer $numero_hijos_viven_familia
 * @property integer $estado_familia
 * @property string $fecha_creacion_familia
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property BeneficiarioFamilia[] $beneficiarioFamilias
 * @property EventoVitalFamilia[] $eventoVitalFamilias
 * @property FamiliaDireccion[] $familiaDireccions
 * @property MetodoPlanificacionFamiliar[] $metodoPlanificacionFamiliars
 * @property FamiliaServicioBasico[] $familiaServicioBasicos
 * @property FamiliaTipoCasa[] $familiaTipoCasas
 */
class Familia extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'familia';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('codigo_familia, estado_familia', 'required'),
			array('numero_hijos_viven_familia, estado_familia', 'numerical', 'integerOnly'=>true),
			array('codigo_familia, codigo_familia_antiguo', 'length', 'max'=>45),
			array('codigo_familia', 'unique','message'=>'Dato invalido valor duplicado'),
			array('estado_familia','in','range'=>array(true,false,1,0),'allowEmpty'=>true,'message'=>'Error de seleccion'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'beneficiarioFamilias' => array(self::HAS_MANY, 'BeneficiarioFamilia', 'fk_id_familia'),
			'eventoVitalFamilias' => array(self::HAS_MANY, 'EventoVitalFamilia', 'fk_id_familia'),
			'familiaDireccions' => array(self::HAS_MANY, 'FamiliaDireccion', 'fk_id_familia'),
			'metodoPlanificacionFamiliars' => array(self::MANY_MANY, 'MetodoPlanificacionFamiliar', 'familia_metodo_planificacion_familiar(fk_id_familia, fk_id_metodo_planificacion_familiar)'),
			'familiaServicioBasicos' => array(self::HAS_MANY, 'FamiliaServicioBasico', 'fk_id_familia'),
			'familiaTipoCasas' => array(self::HAS_MANY, 'FamiliaTipoCasa', 'fk_id_familia'),
			//yo para read
			'familiaMetodoPlanificacionFamiliar'=>array(self::HAS_MANY, 'FamiliaMetodoPlanificacionFamiliar', 'fk_id_familia'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_familia' => 'Id Familia',
			'codigo_familia' => 'Codigo Familia',
			'codigo_familia_antiguo' => 'Codigo Familia Antiguo',
			'numero_hijos_viven_familia' => 'Numero Hijos Viven Familia',
			'estado_familia' => 'Estado Familia',
			'fecha_creacion_familia' => 'Fecha Creacion Familia',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Familia la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
