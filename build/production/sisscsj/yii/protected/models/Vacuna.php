<?php
/**
 * Esta es la clase modelo para la tabla "vacuna".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'vacuna':
 * @property integer $id_vacuna
 * @property string $nombre_vacuna
 * @property string $descripcion_vacuna
 * @property integer $estado_vacuna
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property EvalEnfermeria[] $evalEnfermerias
 */
class Vacuna extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'vacuna';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('nombre_vacuna, estado_vacuna', 'required'),
			array('estado_vacuna', 'numerical', 'integerOnly'=>true),
			array('nombre_vacuna', 'length', 'max'=>250),
			array('descripcion_vacuna', 'safe'),
			array('nombre_vacuna', 'unique','message'=>'Dato invalido valor duplicado'),
			array('estado_vacuna','in','range'=>array(true,false,1,0),'allowEmpty'=>true,'message'=>'Error de seleccion'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations(){
		return array(
			'evalEnfermerias' => array(self::HAS_MANY, 'EvalEnfermeria', 'fk_id_vacuna'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels(){
		return array(
			'id_vacuna' => 'Id Vacuna',
			'nombre_vacuna' => 'Nombre Vacuna',
			'descripcion_vacuna' => 'Descripcion Vacuna',
			'estado_vacuna' => 'Estado Vacuna',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Vacuna la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
