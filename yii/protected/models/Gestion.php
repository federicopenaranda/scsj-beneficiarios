<?php
/**
 * Esta es la clase modelo para la tabla "gestion".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'gestion':
 * @property integer $id_gestion
 * @property integer $estado_gestion
 * @property string $nombre_gestion
 * @property integer $orden_gestion
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property Actividad[] $actividads
 * @property GestionBeneficiario[] $gestionBeneficiarios
 */
class Gestion extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'gestion';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('estado_gestion, nombre_gestion, orden_gestion', 'required'),
			array('estado_gestion, orden_gestion', 'numerical', 'integerOnly'=>true),
			array('nombre_gestion', 'length', 'max'=>45),
			array('nombre_gestion', 'unique','message'=>'Dato invalido valor duplicado'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'actividads' => array(self::HAS_MANY, 'Actividad', 'fk_id_gestion'),
			'gestionBeneficiarios' => array(self::HAS_MANY, 'GestionBeneficiario', 'fk_id_gestion'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_gestion' => 'Id Gestion',
			'estado_gestion' => 'Estado Gestion',
			'nombre_gestion' => 'Nombre Gestion',
			'orden_gestion' => 'Orden Gestion',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Gestion la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
