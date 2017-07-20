<?php
/**
 * Esta es la clase modelo para la tabla "tipo_identificacion".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'tipo_identificacion':
 * @property integer $id_tipo_identificacion
 * @property string $nombre_tipo_identificacion
 * @property string $descripcion_tipo_identificacion
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property Beneficiario[] $beneficiarios
 */
class TipoIdentificacion extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'tipo_identificacion';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('nombre_tipo_identificacion', 'required'),
			array('nombre_tipo_identificacion', 'length', 'max'=>200),
			array('descripcion_tipo_identificacion', 'safe'),
			array('nombre_tipo_identificacion', 'unique','message'=>'Dato invalido valor duplicado'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'beneficiarios' => array(self::MANY_MANY, 'Beneficiario', 'beneficiario_tipo_identificacion(fk_id_tipo_identificacion, fk_id_beneficiario)'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_tipo_identificacion' => 'Id Tipo Identificacion',
			'nombre_tipo_identificacion' => 'Nombre del tipo de identificación a registrar. 

Restricciones:
- Debe ser único dentro de la tabla.
- No debe ser un valor nulo.

Tipo de Dato:
- Texto de 45 caracteres de largo',
			'descripcion_tipo_identificacion' => 'Descripción del tipo de identificación que se esta creando.

Restricciones',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TipoIdentificacion la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
