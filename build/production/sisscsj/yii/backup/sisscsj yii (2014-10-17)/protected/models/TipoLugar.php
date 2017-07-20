<?php
/**
 * Esta es la clase modelo para la tabla "tipo_lugar".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'tipo_lugar':
 * @property integer $id_tipo_lugar
 * @property string $nombre_tipo_lugar
 * @property string $descripcion_tipo_lugar
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property LugarActividad[] $lugarActividads
 */
class TipoLugar extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'tipo_lugar';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('nombre_tipo_lugar', 'required'),
			array('nombre_tipo_lugar', 'length', 'max'=>200),
			array('descripcion_tipo_lugar', 'safe'),
			array('nombre_tipo_lugar', 'unique','message'=>'Dato invalido valor duplicado'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'lugarActividads' => array(self::HAS_MANY, 'LugarActividad', 'fk_id_tipo_lugar'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_tipo_lugar' => 'Id Tipo Lugar',
			'nombre_tipo_lugar' => 'Nombre Tipo Lugar',
			'descripcion_tipo_lugar' => 'Descripcion Tipo Lugar',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TipoLugar la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
