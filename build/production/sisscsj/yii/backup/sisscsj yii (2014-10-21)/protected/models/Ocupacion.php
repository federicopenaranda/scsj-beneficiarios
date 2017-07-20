<?php
/**
 * Esta es la clase modelo para la tabla "ocupacion".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'ocupacion':
 * @property integer $id_ocupacion
 * @property string $nombre_ocupacion
 * @property string $descripcion_ocupacion
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property BeneficiarioOcupacion[] $beneficiarioOcupacions
 */
class Ocupacion extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'ocupacion';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('nombre_ocupacion', 'required'),
			array('nombre_ocupacion', 'length', 'max'=>100),
			array('descripcion_ocupacion', 'safe'),
			array('nombre_ocupacion', 'unique','message'=>'Dato invalido valor duplicado'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'beneficiarioOcupacions' => array(self::HAS_MANY, 'BeneficiarioOcupacion', 'fk_id_ocupacion'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_ocupacion' => 'Id Ocupacion',
			'nombre_ocupacion' => 'Nombre Ocupacion',
			'descripcion_ocupacion' => 'Descripcion Ocupacion',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Ocupacion la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
