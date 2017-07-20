<?php
/**
 * Esta es la clase modelo para la tabla "servicio_basico".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'servicio_basico':
 * @property integer $id_servicio_basico
 * @property string $nombre_servicio_basico
 * @property string $descripcion_servicio_basico
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property FamiliaServicioBasico[] $familiaServicioBasicos
 */
class ServicioBasico extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'servicio_basico';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('nombre_servicio_basico', 'required'),
			array('nombre_servicio_basico', 'length', 'max'=>200),
			array('descripcion_servicio_basico', 'safe'),
			array('nombre_servicio_basico', 'unique','message'=>'Dato invalido valor duplicado'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'familiaServicioBasicos' => array(self::HAS_MANY, 'FamiliaServicioBasico', 'fk_id_servicio_basico'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_servicio_basico' => 'Id Servicio Basico',
			'nombre_servicio_basico' => 'Nombre Servicio Basico',
			'descripcion_servicio_basico' => 'Descripcion Servicio Basico',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ServicioBasico la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
