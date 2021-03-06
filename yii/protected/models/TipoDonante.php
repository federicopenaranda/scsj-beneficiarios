<?php
/**
 * Esta es la clase modelo para la tabla "tipo_donante".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'tipo_donante':
 * @property integer $id_tipo_donante
 * @property string $nombre_tipo_donante
 * @property string $descripcion_tipo_donante
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property Donante[] $donantes
 */
class TipoDonante extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'tipo_donante';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('nombre_tipo_donante', 'required'),
			array('nombre_tipo_donante', 'length', 'max'=>100),
			array('descripcion_tipo_donante', 'safe'),
			array('nombre_tipo_donante', 'unique','message'=>'Dato invalido valor duplicado'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations(){
		return array(
			'donantes' => array(self::HAS_MANY, 'Donante', 'fk_id_tipo_donante'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels(){
		return array(
			'id_tipo_donante' => 'Id Tipo Donante',
			'nombre_tipo_donante' => 'Nombre Tipo Donante',
			'descripcion_tipo_donante' => 'Descripcion Tipo Donante',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TipoDonante la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
