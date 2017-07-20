<?php
/**
 * Esta es la clase modelo para la tabla "usuario_lugar".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'usuario_lugar':
 * @property integer $fk_id_lugar_actividad
 * @property integer $fk_id_usuario
 */
class UsuarioLugar extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'usuario_lugar';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('fk_id_lugar_actividad, fk_id_usuario', 'required'),
			array('fk_id_lugar_actividad, fk_id_usuario', 'numerical', 'integerOnly'=>true),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'fkIdLugarActividad' => array(self::BELONGS_TO, 'LugarActividad', 'fk_id_lugar_actividad'),
			'fkIdUsuario' => array(self::BELONGS_TO, 'Usuario', 'fk_id_usuario'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'fk_id_lugar_actividad' => 'Fk Id Lugar Actividad',
			'fk_id_usuario' => 'Fk Id Usuario',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UsuarioLugar la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
