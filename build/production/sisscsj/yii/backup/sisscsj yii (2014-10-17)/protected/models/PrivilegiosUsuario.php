<?php
/**
 * Esta es la clase modelo para la tabla "privilegios_usuario".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'privilegios_usuario':
 * @property integer $id_privilegios_usuario
 * @property string $nombre_privilegio_usuario
 * @property string $accion_privilegio_usuario
 * @property string $opciones_privilegio_usuario
 * @property string $funcion_privilegio_usuario
 * @property string $descripcion_privilegios_usuario
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property TipoUsuario[] $tipoUsuarios
 */
class PrivilegiosUsuario extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'privilegios_usuario';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('nombre_privilegio_usuario, accion_privilegio_usuario', 'required'),
			array('nombre_privilegio_usuario', 'length', 'max'=>150),
			array('accion_privilegio_usuario, opciones_privilegio_usuario, funcion_privilegio_usuario', 'length', 'max'=>500),
			array('descripcion_privilegios_usuario', 'safe'),
			array('nombre_privilegio_usuario', 'unique','message'=>'Dato invalido valor duplicado'),
			//array('atributo','date','format'=>'yyyy-MM-dd HH:mm:ss','message'=>'Formato invalido para la fecha'),
			//array('atributo','in','range'=>array('valor1','valor2'),'allowEmpty'=>true,'message'=>'Error de seleccion'),
		
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations(){
		return array(
			'tipoUsuarios' => array(self::MANY_MANY, 'TipoUsuario', 'privilegios_tipo_usuario(fk_id_privilegios_usuario, fk_id_tipo_usuario)'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_privilegios_usuario' => 'Id Privilegios Usuario',
			'nombre_privilegio_usuario' => 'Nombre Privilegio Usuario',
			'accion_privilegio_usuario' => 'Accion Privilegio Usuario',
			'opciones_privilegio_usuario' => 'Opciones Privilegio Usuario',
			'funcion_privilegio_usuario' => 'Funcion Privilegio Usuario',
			'descripcion_privilegios_usuario' => 'Descripcion Privilegios Usuario',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PrivilegiosUsuario la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
