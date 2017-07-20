<?php
/**
 * Esta es la clase modelo para la tabla "provincia".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'provincia':
 * @property integer $id_provincia
 * @property integer $fk_id_departamento
 * @property string $nombre_provincia
 * @property string $descripcion_provincia
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property Localidad[] $localidads
 * @property Departamento $fkIdDepartamento
 */
class Provincia extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'provincia';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('fk_id_departamento, nombre_provincia', 'required'),
			array('fk_id_departamento', 'numerical', 'integerOnly'=>true),
			array('nombre_provincia', 'length', 'max'=>100),
			array('descripcion_provincia', 'safe'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'localidads' => array(self::HAS_MANY, 'Localidad', 'fk_id_provincia'),
			'fkIdDepartamento' => array(self::BELONGS_TO, 'Departamento', 'fk_id_departamento'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_provincia' => 'Id Provincia',
			'fk_id_departamento' => 'Fk Id Departamento',
			'nombre_provincia' => 'Nombre Provincia',
			'descripcion_provincia' => 'Descripcion Provincia',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Provincia la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
