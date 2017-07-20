<?php
/**
 * Esta es la clase modelo para la tabla "idioma".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'idioma':
 * @property integer $id_idioma
 * @property string $nombre_idioma
 * @property string $descripcion_idioma
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property Beneficiario[] $beneficiarios
 */
class Idioma extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'idioma';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('nombre_idioma', 'required'),
			array('nombre_idioma', 'length', 'max'=>200),
			array('descripcion_idioma', 'safe'),
			array('nombre_idioma', 'unique','message'=>'Dato invalido valor duplicado'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'beneficiarios' => array(self::MANY_MANY, 'Beneficiario', 'beneficiario_idioma(fk_id_idioma, fk_id_beneficiario)'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_idioma' => 'Id Idioma',
			'nombre_idioma' => 'Nombre Idioma',
			'descripcion_idioma' => 'Descripcion Idioma',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Idioma la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
