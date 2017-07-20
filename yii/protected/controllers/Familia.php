<?php
/**
 * Esta es la clase modelo para la tabla "familia".
 *
 * Las siguientes son las columnas disponibles en la tabla 'familia':
 * @property integer $id_familia
 * @property string $codigo_familia
 * @property string $codigo_familia_antiguo
 * @property integer $numero_hijos_viven_familia
 * @property integer $estado_familia
 * @property string $fecha_creacion_familia
 *
 * Lo siguiente son las relaciones de modelo disponibles:
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
	 * @return string retorna el nombre de tabla de base de datos asociado
	 */
	public function tableName()
	{
		return 'familia';
	}

	/**
	 * @return array reglas de validación para los atributos de modelo.
	 */
	public function rules()
	{
		// NOTA: sólo se debe definir reglas para los atributos que 
		// Recibirán entradas del usuario.
		return array(
			array('codigo_familia, estado_familia, fecha_creacion_familia', 'required'),
			array('numero_hijos_viven_familia, estado_familia', 'numerical', 'integerOnly'=>true),
			array('codigo_familia, codigo_familia_antiguo', 'length', 'max'=>45),
			array('id_familia, codigo_familia, codigo_familia_antiguo, numero_hijos_viven_familia, estado_familia, fecha_creacion_familia', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array reglas relacionales.
	 */
	public function relations()
	{
		// NOTA: sólo se debe definir reglas para los atributos que 
        // Recibirán entradas del usuario.
		return array(
			'beneficiarioFamilias' => array(self::HAS_MANY, 'BeneficiarioFamilia', 'fk_id_familia'),
			'eventoVitalFamilias' => array(self::HAS_MANY, 'EventoVitalFamilia', 'fk_id_familia'),
			'familiaDireccions' => array(self::HAS_MANY, 'FamiliaDireccion', 'fk_id_familia'),
			'metodoPlanificacionFamiliars' => array(self::MANY_MANY, 'MetodoPlanificacionFamiliar', 'familia_metodo_planificacion_familiar(fk_id_familia, fk_id_metodo_planificacion_familiar)'),
			'familiaServicioBasicos' => array(self::HAS_MANY, 'FamiliaServicioBasico', 'fk_id_familia'),
			'familiaTipoCasas' => array(self::HAS_MANY, 'FamiliaTipoCasa', 'fk_id_familia'),
		);
	}

	/**
	 * @return array etiquetas de atributos personalizados (nombre => etiqueta)
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
     * Devuelve el modelo estático de la clase AR especificado. 
     * Tenga en cuenta que usted debe tener este método exacto en todos sus descendientes CActiveRecord! 
     * @ Param string $ className registro activo nombre de la clase. 
     * @ Return Familia la clase modelo estático
    */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
