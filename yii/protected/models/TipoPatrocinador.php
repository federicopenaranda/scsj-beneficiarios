<?php
/**
 * Esta es la clase modelo para la tabla "tipo_patrocinador".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'tipo_patrocinador':
 * @property integer $id_tipo_patrocinador
 * @property string $nombre_tipo_patrocinador
 * @property string $descripcion_tipo_patrocinador
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property Patrocinador[] $patrocinadors
 */
class TipoPatrocinador extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'tipo_patrocinador';
	}
	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('nombre_tipo_patrocinador', 'required'),
			array('nombre_tipo_patrocinador', 'length', 'max'=>100),
			array('descripcion_tipo_patrocinador', 'safe'),
			array('nombre_tipo_patrocinador', 'unique','message'=>'Dato invalido valor duplicado'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'patrocinadors' => array(self::HAS_MANY, 'Patrocinador', 'fk_id_tipo_patrocinador'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_tipo_patrocinador' => 'Id Tipo Patrocinador',
			'nombre_tipo_patrocinador' => 'Nombre Tipo Patrocinador',
			'descripcion_tipo_patrocinador' => 'Descripcion Tipo Patrocinador',
		);
	}	

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TipoPatrocinador la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
