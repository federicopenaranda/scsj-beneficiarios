<?php
/**
 * Esta es la clase modelo para la tabla "actividad_favorita".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'actividad_favorita':
 * @property integer $id_actividad_favorita
 * @property string $nombre_actividad_favorita
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property Beneficiario[] $beneficiarios
 */
class ActividadFavorita extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'actividad_favorita';
	}
	
	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('nombre_actividad_favorita', 'required'),
			array('nombre_actividad_favorita', 'length', 'max'=>200),
			array('nombre_actividad_favorita', 'unique'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'beneficiarios' => array(self::MANY_MANY, 'Beneficiario', 'beneficiario_actividad_favorita(fk_id_actividad_favorita, fk_id_beneficiario)'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_actividad_favorita' => 'Id Actividad Favorita',
			'nombre_actividad_favorita' => 'Nombre Actividad Favorita',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ActividadFavorita la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
