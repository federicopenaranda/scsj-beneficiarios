<?php
/**
 * Esta es la clase modelo para la tabla "donante".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'donante':
 * @property integer $id_donante
 * @property integer $fk_id_tipo_donante
 * @property string $nombre_donante
 * @property string $descripcion_donante
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property Beneficiario[] $beneficiarios
 * @property TipoDonante $fkIdTipoDonante
 */
class Donante extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'donante';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('fk_id_tipo_donante, nombre_donante', 'required'),
			array('fk_id_tipo_donante', 'numerical', 'integerOnly'=>true),
			array('nombre_donante', 'length', 'max'=>150),
			array('descripcion_donante', 'safe'),
			array('nombre_donante', 'unique','message'=>'Dato invalido valor duplicado'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'beneficiarios' => array(self::MANY_MANY, 'Beneficiario', 'beneficiario_donante(fk_id_donante, fk_id_beneficiario)'),
			'fkIdTipoDonante' => array(self::BELONGS_TO, 'TipoDonante', 'fk_id_tipo_donante'),
		);
	}
	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_donante' => 'Id Donante',
			'fk_id_tipo_donante' => 'Fk Id Tipo Donante',
			'nombre_donante' => 'Nombre Donante',
			'descripcion_donante' => 'Descripcion Donante',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Donante la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
