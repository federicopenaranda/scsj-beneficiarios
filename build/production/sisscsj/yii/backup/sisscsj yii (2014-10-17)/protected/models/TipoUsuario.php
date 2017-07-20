<?php
/**
 * Esta es la clase modelo para la tabla "tipo_usuario".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'tipo_usuario':
 * @property integer $id_tipo_usuario
 * @property string $nombre_tipo_usuario
 * @property string $descripcion_tipo_usuario
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property PrivilegiosUsuario[] $privilegiosUsuarios
 * @property Usuario[] $usuarios
 */
class TipoUsuario extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'tipo_usuario';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('nombre_tipo_usuario', 'required'),
			array('nombre_tipo_usuario', 'length', 'max'=>150),
			array('descripcion_tipo_usuario', 'safe'),
			array('nombre_tipo_usuario', 'unique','message'=>'Dato invalido valor duplicado'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations(){
		return array(
			'privilegiosUsuarios' => array(self::MANY_MANY, 'PrivilegiosUsuario', 'privilegios_tipo_usuario(fk_id_tipo_usuario, fk_id_privilegios_usuario)'),
			'usuarios' => array(self::HAS_MANY, 'Usuario', 'fk_id_tipo_usuario'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels(){
		return array(
			'id_tipo_usuario' => 'Id Tipo Usuario',
			'nombre_tipo_usuario' => 'Nombre Tipo Usuario',
			'descripcion_tipo_usuario' => 'Descripcion Tipo Usuario',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TipoUsuario la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
