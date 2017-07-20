<?php
/**
 * Esta es la clase modelo para la tabla "area_conocimiento_biblioteca".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'area_conocimiento_biblioteca':
 * @property integer $id_area_conocimiento_biblioteca
 * @property string $nombre_area_conocimiento_biblioteca
 * @property string $descripcion_area_conocimiento_biblioteca
 * @property string $codigo_area_conocimiento_biblioteca
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property Biblioteca[] $bibliotecas
 */
class AreaConocimientoBiblioteca extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'area_conocimiento_biblioteca';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('nombre_area_conocimiento_biblioteca, codigo_area_conocimiento_biblioteca', 'required'),
			array('nombre_area_conocimiento_biblioteca', 'length', 'max'=>150),
			array('codigo_area_conocimiento_biblioteca', 'length', 'max'=>45),
			array('descripcion_area_conocimiento_biblioteca', 'safe'),
			array('nombre_area_conocimiento_biblioteca, codigo_area_conocimiento_biblioteca', 'unique','message'=>'Dato invalido valor duplicado'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'bibliotecas' => array(self::HAS_MANY, 'Biblioteca', 'fk_id_area_cononcimiento_biblioteca'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_area_conocimiento_biblioteca' => 'Id Area Conocimiento Biblioteca',
			'nombre_area_conocimiento_biblioteca' => 'Nombre Area Conocimiento Biblioteca',
			'descripcion_area_conocimiento_biblioteca' => 'Descripcion Area Conocimiento Biblioteca',
			'codigo_area_conocimiento_biblioteca' => 'Codigo Area Conocimiento Biblioteca',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AreaConocimientoBiblioteca la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
