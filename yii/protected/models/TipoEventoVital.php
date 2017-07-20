<?php
/**
 * Esta es la clase modelo para la tabla "tipo_evento_vital".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'tipo_evento_vital':
 * @property integer $id_tipo_evento_vital
 * @property string $nombre_tipo_evento_vital
 * @property string $descripcion_tipo_evento_vital
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property EventoVitalFamilia[] $eventoVitalFamilias
 */
class TipoEventoVital extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'tipo_evento_vital';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('nombre_tipo_evento_vital', 'required'),
			array('nombre_tipo_evento_vital', 'length', 'max'=>200),
			array('descripcion_tipo_evento_vital', 'safe'),
			array('nombre_tipo_evento_vital', 'unique','message'=>'Dato invalido valor duplicado'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'eventoVitalFamilias' => array(self::HAS_MANY, 'EventoVitalFamilia', 'fk_id_tipo_evento_vital'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_tipo_evento_vital' => 'Id Tipo Evento Vital',
			'nombre_tipo_evento_vital' => 'Nombre Tipo Evento Vital',
			'descripcion_tipo_evento_vital' => 'Descripcion Tipo Evento Vital',
		);
	}	

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TipoEventoVital la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
