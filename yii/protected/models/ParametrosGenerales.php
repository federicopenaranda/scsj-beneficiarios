<?php
/**
 * Esta es la clase modelo para la tabla "parametros_generales".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'parametros_generales':
 * @property integer $id_parametro_general
 * @property string $nombre_parametro
 * @property string $valor_parametro
 * @property string $configuracion_parametro
 * @property integer $estado_parametro
 */
class ParametrosGenerales extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'parametros_generales';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('nombre_parametro, valor_parametro', 'required'),
			array('estado_parametro', 'numerical', 'integerOnly'=>true),
			array('nombre_parametro, valor_parametro, configuracion_parametro', 'length', 'max'=>45),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_parametro_general' => 'Id Parametro General',
			'nombre_parametro' => 'Nombre Parametro',
			'valor_parametro' => 'Valor Parametro',
			'configuracion_parametro' => 'Configuracion Parametro',
			'estado_parametro' => 'Estado Parametro',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ParametrosGenerales la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
