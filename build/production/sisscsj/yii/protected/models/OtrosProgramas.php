<?php
/**
 * Esta es la clase modelo para la tabla "otros_programas".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'otros_programas':
 * @property integer $id_otros_programas
 * @property string $nombre_otros_programas
 * @property string $sigla_otros_programas
 * @property string $descripcion_otros_programas
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property Beneficiario[] $beneficiarios
 */
class OtrosProgramas extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'otros_programas';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('nombre_otros_programas, sigla_otros_programas', 'required'),
			array('nombre_otros_programas', 'length', 'max'=>200),
			array('sigla_otros_programas', 'length', 'max'=>45),
			array('descripcion_otros_programas', 'safe'),
			array('nombre_otros_programas, sigla_otros_programas', 'unique','message'=>'Dato invalido valor duplicado'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'beneficiarios' => array(self::MANY_MANY, 'Beneficiario', 'beneficiario_otros_programas(fk_id_otros_programas, fk_id_beneficiario)'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_otros_programas' => 'Id Otros Programas',
			'nombre_otros_programas' => 'Nombre Otros Programas',
			'sigla_otros_programas' => 'Sigla Otros Programas',
			'descripcion_otros_programas' => 'Descripcion Otros Programas',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OtrosProgramas la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
