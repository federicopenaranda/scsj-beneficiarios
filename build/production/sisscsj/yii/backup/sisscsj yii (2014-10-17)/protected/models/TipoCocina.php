<?php
/**
 * Esta es la clase modelo para la tabla "tipo_cocina".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'tipo_cocina':
 * @property integer $id_tipo_cocina
 * @property string $nombre_tipo_cocina
 * @property string $descripcion_tipo_cocina
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property FamiliaTipoCasa[] $familiaTipoCasas
 */
class TipoCocina extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'tipo_cocina';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('nombre_tipo_cocina', 'required'),
			array('nombre_tipo_cocina', 'length', 'max'=>200),
			array('descripcion_tipo_cocina', 'safe'),
			array('nombre_tipo_cocina', 'unique','message'=>'Dato invalido valor duplicado'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'familiaTipoCasas' => array(self::HAS_MANY, 'FamiliaTipoCasa', 'fk_id_tipo_cocina'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_tipo_cocina' => 'Id Tipo Cocina',
			'nombre_tipo_cocina' => 'Nombre Tipo Cocina',
			'descripcion_tipo_cocina' => 'Descripcion Tipo Cocina',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TipoCocina la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
