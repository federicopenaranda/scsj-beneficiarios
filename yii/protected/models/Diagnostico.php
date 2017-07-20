<?php
/**
 * Esta es la clase modelo para la tabla "diagnostico".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'diagnostico':
 * @property integer $id_diagnostico
 * @property string $nombre_diagnostico
 * @property string $descripcion_diagnostico
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property EvalAtencionMedica[] $evalAtencionMedicas
 */
class Diagnostico extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'diagnostico';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('nombre_diagnostico', 'required'),
			array('nombre_diagnostico', 'length', 'max'=>200),
			array('descripcion_diagnostico', 'safe'),
			array('nombre_diagnostico', 'unique','message'=>'Dato invalido valor duplicado'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'evalAtencionMedicas' => array(self::HAS_MANY, 'EvalAtencionMedica', 'fk_id_diagnostico'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_diagnostico' => 'Id Diagnostico',
			'nombre_diagnostico' => 'Nombre Diagnostico',
			'descripcion_diagnostico' => 'Descripcion Diagnostico',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Diagnostico la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
