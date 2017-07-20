<?php
/**
 * Esta es la clase modelo para la tabla "entidad_salud".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'entidad_salud':
 * @property integer $id_entidad_salud
 * @property string $nombre_entidad_salud
 * @property string $observaciones_entidad_salud
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property Beneficiario[] $beneficiarios
 */
class EntidadSalud extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'entidad_salud';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('nombre_entidad_salud', 'required'),
			array('nombre_entidad_salud', 'length', 'max'=>250),
			array('observaciones_entidad_salud', 'safe'),
			array('nombre_entidad_salud', 'unique','message'=>'Dato invalido valor duplicado'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'beneficiarios' => array(self::HAS_MANY, 'Beneficiario', 'fk_id_entidad_salud'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_entidad_salud' => 'Id Entidad Salud',
			'nombre_entidad_salud' => 'Nombre Entidad Salud',
			'observaciones_entidad_salud' => 'Observaciones Entidad Salud',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EntidadSalud la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

