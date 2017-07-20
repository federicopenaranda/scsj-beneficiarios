<?php
/**
 * Esta es la clase modelo para la tabla "familia_servicio_basico".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'familia_servicio_basico':
 * @property integer $id_familia_servicio_basico
 * @property integer $fk_id_servicio_basico
 * @property integer $fk_id_familia
 * @property string $observacion_familia_servicio_basico
 * @property integer $estado_familia_servicio_basico
 * @property string $fecha_creacion_familia_servicio_basico
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property Familia $fkIdFamilia
 * @property ServicioBasico $fkIdServicioBasico
 */
class FamiliaServicioBasico extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'familia_servicio_basico';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('fk_id_servicio_basico, fk_id_familia, estado_familia_servicio_basico', 'required'),
			array('fk_id_servicio_basico, fk_id_familia', 'numerical', 'integerOnly'=>true),
			array('observacion_familia_servicio_basico', 'safe'),
			array('estado_familia_servicio_basico','in','range'=>array(true,false,1,0),'allowEmpty'=>true,'message'=>'Error de seleccion'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'fkIdFamilia' => array(self::BELONGS_TO, 'Familia', 'fk_id_familia'),
			'fkIdServicioBasico' => array(self::BELONGS_TO, 'ServicioBasico', 'fk_id_servicio_basico'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_familia_servicio_basico' => 'Id Familia Servicio Basico',
			'fk_id_servicio_basico' => 'Fk Id Servicio Basico',
			'fk_id_familia' => 'Fk Id Familia',
			'observacion_familia_servicio_basico' => 'Observacion Familia Servicio Basico',
			'estado_familia_servicio_basico' => 'Estado Familia Servicio Basico',
			'fecha_creacion_familia_servicio_basico' => 'Fecha Creacion Familia Servicio Basico',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FamiliaServicioBasico la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
}
