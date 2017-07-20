<?php
/**
 * Esta es la clase modelo para la tabla "sector".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'sector':
 * @property integer $id_sector
 * @property integer $fk_id_zona
 * @property string $nombre_sector
 * @property string $descripcion_sector
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property FamiliaDireccion[] $familiaDireccions
 * @property Zona $fkIdZona
 */
class Sector extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'sector';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('fk_id_zona, nombre_sector', 'required'),
			array('fk_id_zona', 'numerical', 'integerOnly'=>true),
			array('nombre_sector', 'length', 'max'=>100),
			array('descripcion_sector', 'safe'),
			array('nombre_sector', 'unique','message'=>'Dato invalido valor duplicado'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'familiaDireccions' => array(self::HAS_MANY, 'FamiliaDireccion', 'fk_id_sector'),
			'fkIdZona' => array(self::BELONGS_TO, 'Zona', 'fk_id_zona'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_sector' => 'Id Sector',
			'fk_id_zona' => 'Fk Id Zona',
			'nombre_sector' => 'Nombre Sector',
			'descripcion_sector' => 'Descripcion Sector',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Sector la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
