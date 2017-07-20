<?php
/**
 * Esta es la clase modelo para la tabla "log_sistema".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'log_sistema':
 * @property integer $id_log_sistema
 * @property integer $fk_id_usuario
 * @property string $accion_sistema
 * @property string $valor_accion_sistema
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property Usuario $fkIdUsuario
 */
class LogSistema extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'log_sistema';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('fk_id_usuario, accion_sistema, valor_accion_sistema', 'required'),
			array('fk_id_usuario', 'numerical', 'integerOnly'=>true),
			array('accion_sistema, valor_accion_sistema', 'length', 'max'=>45),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'fkIdUsuario' => array(self::BELONGS_TO, 'Usuario', 'fk_id_usuario'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_log_sistema' => 'Id Log Sistema',
			'fk_id_usuario' => 'Fk Id Usuario',
			'accion_sistema' => 'Accion Sistema',
			'valor_accion_sistema' => 'Valor Accion Sistema',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LogSistema la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
