<?php
/**
 * Esta es la clase modelo para la tabla "entidad_estado_entidad".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'entidad_estado_entidad':
 * @property integer $id_entidad_estado_entidad
 * @property integer $fk_id_entidad
 * @property integer $fk_id_estado_entidad
 * @property string $fecha_creacion_estado_entidad
 * @property integer $estado_entidad_estado_entidad
 * @property string $observaciones_entidad_estado_entidad
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property Entidad $fkIdEntidad
 * @property EstadoEntidad $fkIdEstadoEntidad
 */
class EntidadEstadoEntidad extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'entidad_estado_entidad';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('fk_id_entidad, fk_id_estado_entidad, estado_entidad_estado_entidad', 'required'),
			array('fk_id_entidad, fk_id_estado_entidad, estado_entidad_estado_entidad', 'numerical', 'integerOnly'=>true),
			array('observaciones_entidad_estado_entidad', 'safe'),
			array('estado_entidad_estado_entidad','in','range'=>array(true,false,1,0),'allowEmpty'=>true,'message'=>'Error de seleccion'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'fkIdEntidad' => array(self::BELONGS_TO, 'Entidad', 'fk_id_entidad'),
			'fkIdEstadoEntidad' => array(self::BELONGS_TO, 'EstadoEntidad', 'fk_id_estado_entidad'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_entidad_estado_entidad' => 'Id Entidad Estado Entidad',
			'fk_id_entidad' => 'Fk Id Entidad',
			'fk_id_estado_entidad' => 'Fk Id Estado Entidad',
			'fecha_creacion_estado_entidad' => 'Fecha Creacion Estado Entidad',
			'estado_entidad_estado_entidad' => 'Estado Entidad Estado Entidad',
			'observaciones_entidad_estado_entidad' => 'Observaciones Entidad Estado Entidad',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EntidadEstadoEntidad la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
