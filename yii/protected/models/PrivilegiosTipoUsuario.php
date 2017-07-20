<?php
/**
 * Esta es la clase modelo para la tabla "privilegios_tipo_usuario".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'privilegios_tipo_usuario':
 * @property integer $fk_id_privilegios_usuario
 * @property integer $fk_id_tipo_usuario
 * @property integer $estado_privilegio_tipo_usuario
 */
class PrivilegiosTipoUsuario extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'privilegios_tipo_usuario';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('fk_id_privilegios_usuario, fk_id_tipo_usuario, estado_privilegio_tipo_usuario', 'required'),
			array('fk_id_privilegios_usuario, fk_id_tipo_usuario, estado_privilegio_tipo_usuario', 'numerical', 'integerOnly'=>true),
		);
	}
	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'fkIdPrivilegiosUsuario' => array(self::BELONGS_TO, 'PrivilegiosUsuario', 'fk_id_privilegios_usuario'),
			'TipoUsuario' => array(self::BELONGS_TO, 'TipoUsuario', 'fk_id_tipo_usuario'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'fk_id_privilegios_usuario' => 'Fk Id Privilegios Usuario',
			'fk_id_tipo_usuario' => 'Fk Id Tipo Usuario',
			'estado_privilegio_tipo_usuario' => 'Estado Privilegio Tipo Usuario',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PrivilegiosTipoUsuario la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
