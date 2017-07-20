<?php
/**
 * Esta es la clase modelo para la tabla "unidad_educativa".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'unidad_educativa':
 * @property integer $id_unidad_educativa
 * @property string $nombre_unidad_educativa
 * @property string $telefono_unidad_educativa
 * @property string $direccion_unidad_educativa
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property Beneficiario[] $beneficiarios
 */
class UnidadEducativa extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'unidad_educativa';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('nombre_unidad_educativa', 'required'),
			array('nombre_unidad_educativa', 'length', 'max'=>250),
			array('telefono_unidad_educativa', 'length', 'max'=>45),
			array('direccion_unidad_educativa', 'safe'),
			array('nombre_unidad_educativa', 'unique','message'=>'Dato invalido valor duplicado'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations(){
		return array(
			'beneficiarios' => array(self::MANY_MANY, 'Beneficiario', 'beneficiario_unidad_educativa(fk_id_unidad_educativa, fk_id_beneficiario)'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels(){
		return array(
			'id_unidad_educativa' => 'Id Unidad Educativa',
			'nombre_unidad_educativa' => 'Nombre Unidad Educativa',
			'telefono_unidad_educativa' => 'Telefono Unidad Educativa',
			'direccion_unidad_educativa' => 'Direccion Unidad Educativa',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UnidadEducativa la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
