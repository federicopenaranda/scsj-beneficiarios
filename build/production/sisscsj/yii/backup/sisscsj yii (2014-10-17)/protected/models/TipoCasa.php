<?php
/**
 * Esta es la clase modelo para la tabla "tipo_casa".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'tipo_casa':
 * @property integer $id_tipo_casa
 * @property string $nombre_tipo_casa
 * @property string $descripcion_tipo_casa
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property FamiliaTipoCasa[] $familiaTipoCasas
 */
class TipoCasa extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'tipo_casa';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('nombre_tipo_casa', 'required'),
			array('nombre_tipo_casa', 'length', 'max'=>200),
			array('descripcion_tipo_casa', 'safe'),
			array('nombre_tipo_casa', 'unique','message'=>'Dato invalido valor duplicado'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'familiaTipoCasas' => array(self::HAS_MANY, 'FamiliaTipoCasa', 'fk_id_tipo_casa'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_tipo_casa' => 'Id Tipo Casa',
			'nombre_tipo_casa' => 'Nombre Tipo Casa',
			'descripcion_tipo_casa' => 'Descripcion Tipo Casa',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TipoCasa la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
