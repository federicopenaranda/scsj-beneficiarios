<?php
/**
 * Esta es la clase modelo para la tabla "departamento".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'departamento':
 * @property integer $id_departamento
 * @property string $nombre_departamento
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property Provincia[] $provincias
 */
class Departamento extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'departamento';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('nombre_departamento', 'required'),
			array('nombre_departamento', 'length', 'max'=>45),
			array('nombre_departamento', 'unique','message'=>'Dato invalido valor duplicado'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'provincias' => array(self::HAS_MANY, 'Provincia', 'fk_id_departamento'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_departamento' => 'Id Departamento',
			'nombre_departamento' => 'Nombre Departamento',
		);
	}	

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Departamento la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
