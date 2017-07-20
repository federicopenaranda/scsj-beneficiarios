<?php
/**
 * Esta es la clase modelo para la tabla "escolaridad".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'escolaridad':
 * @property integer $id_escolaridad
 * @property string $nombre_escolaridad
 * @property string $descripcion_escolaridad
 * @property string $turno_escolaridad
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property Beneficiario[] $beneficiarios
 */
class Escolaridad extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'escolaridad';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('nombre_escolaridad, turno_escolaridad', 'required'),
			array('nombre_escolaridad', 'length', 'max'=>150),
			array('descripcion_escolaridad', 'safe'),
			array('turno_escolaridad','in','range'=>array('manana','tarde','noche'),'allowEmpty'=>true,'message'=>'Error de seleccion'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'beneficiarios' => array(self::HAS_MANY, 'Beneficiario', 'fk_id_escolaridad'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_escolaridad' => 'Id Escolaridad',
			'nombre_escolaridad' => 'Nombre Escolaridad',
			'descripcion_escolaridad' => 'Descripcion Escolaridad',
			'turno_escolaridad' => 'Turno Escolaridad',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Escolaridad la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
