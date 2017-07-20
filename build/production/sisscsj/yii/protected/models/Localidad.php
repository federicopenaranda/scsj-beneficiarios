<?php
/**
 * Esta es la clase modelo para la tabla "localidad".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'localidad':
 * @property integer $id_localidad
 * @property integer $fk_id_provincia
 * @property string $nombre_localidad
 * @property string $descripcion_localidad
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property Provincia $fkIdProvincia
 * @property Zona[] $zonas
 */
class Localidad extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'localidad';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('fk_id_provincia, nombre_localidad', 'required'),
			array('fk_id_provincia', 'numerical', 'integerOnly'=>true),
			array('nombre_localidad', 'length', 'max'=>100),
			array('descripcion_localidad', 'length', 'max'=>45),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'fkIdProvincia' => array(self::BELONGS_TO, 'Provincia', 'fk_id_provincia'),
			'zonas' => array(self::HAS_MANY, 'Zona', 'fk_id_localidad'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_localidad' => 'Id Localidad',
			'fk_id_provincia' => 'Fk Id Provincia',
			'nombre_localidad' => 'Nombre Localidad',
			'descripcion_localidad' => 'Descripcion Localidad',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Localidad la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
