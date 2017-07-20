<?php
/**
 * Esta es la clase modelo para la tabla "zona".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'zona':
 * @property integer $id_zona
 * @property integer $fk_id_localidad
 * @property string $nombre_zona
 * @property string $descripcion_zona
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property Sector[] $sectors
 * @property Localidad $fkIdLocalidad
 */
class Zona extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'zona';
	}
	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('fk_id_localidad, nombre_zona', 'required'),
			array('fk_id_localidad', 'numerical', 'integerOnly'=>true),
			array('nombre_zona', 'length', 'max'=>150),
			array('descripcion_zona', 'safe'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'sectors' => array(self::HAS_MANY, 'Sector', 'fk_id_zona'),
			'fkIdLocalidad' => array(self::BELONGS_TO, 'Localidad', 'fk_id_localidad'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_zona' => 'Id Zona',
			'fk_id_localidad' => 'Fk Id Localidad',
			'nombre_zona' => 'Nombre Zona',
			'descripcion_zona' => 'Descripcion Zona',
		);
	}	

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Zona la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
