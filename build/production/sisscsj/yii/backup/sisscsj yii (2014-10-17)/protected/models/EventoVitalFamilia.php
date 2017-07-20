<?php
/**
 * Esta es la clase modelo para la tabla "evento_vital_familia".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'evento_vital_familia':
 * @property integer $id_evento_vital_familia
 * @property integer $fk_id_tipo_evento_vital
 * @property integer $fk_id_familia
 * @property string $fecha_evento_vital_familia
 * @property string $fecha_creacion_evento_vital_familia
 * @property string $observaciones_evento_vital_familia
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property Familia $fkIdFamilia
 * @property TipoEventoVital $fkIdTipoEventoVital
 */
class EventoVitalFamilia extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'evento_vital_familia';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('fk_id_tipo_evento_vital, fk_id_familia, fecha_evento_vital_familia', 'required'),
			array('fk_id_tipo_evento_vital, fk_id_familia', 'numerical', 'integerOnly'=>true),
			array('observaciones_evento_vital_familia', 'safe'),
			#array('fecha_evento_vital_familia','date','format'=>'yyyy-MM-ddT00:00:00','message'=>'Formato invalido para la fecha'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'fkIdFamilia' => array(self::BELONGS_TO, 'Familia', 'fk_id_familia'),
			'fkIdTipoEventoVital' => array(self::BELONGS_TO, 'TipoEventoVital', 'fk_id_tipo_evento_vital'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_evento_vital_familia' => 'Id Evento Vital Familia',
			'fk_id_tipo_evento_vital' => 'Fk Id Tipo Evento Vital',
			'fk_id_familia' => 'Fk Id Familia',
			'fecha_evento_vital_familia' => 'Fecha Evento Vital Familia',
			'fecha_creacion_evento_vital_familia' => 'Fecha Creacion Evento Vital Familia',
			'observaciones_evento_vital_familia' => 'Observaciones Evento Vital Familia',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EventoVitalFamilia la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
