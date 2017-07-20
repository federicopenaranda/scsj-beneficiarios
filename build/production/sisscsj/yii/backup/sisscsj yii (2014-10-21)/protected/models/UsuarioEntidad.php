<?php
/**
 * Esta es la clase modelo para la tabla "usuario_entidad".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'usuario_entidad':
 * @property integer $id_usuario_entidad
 * @property integer $fk_id_usuario
 * @property integer $fk_id_entidad
 * @property string $fecha_registro_usuario_entidad
 * @property integer $estado_usuario_entidad
 * @property string $fecha_creacion_usuario_entidad
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property Entidad $fkIdEntidad
 * @property Usuario $fkIdUsuario
 */
class UsuarioEntidad extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'usuario_entidad';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('fk_id_usuario, fk_id_entidad, fecha_registro_usuario_entidad, estado_usuario_entidad', 'required'),
			array('fk_id_usuario, fk_id_entidad, estado_usuario_entidad', 'numerical', 'integerOnly'=>true),
			#array('fecha_registro_usuario_entidad','date','format'=>'yyyy-MM-dd','message'=>'Formato invalido para la fecha'),
			array('estado_usuario_entidad','in','range'=>array(true,false,1,0),'allowEmpty'=>true,'message'=>'Error de seleccion'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'fkIdEntidad' => array(self::BELONGS_TO, 'Entidad', 'fk_id_entidad'),
			'fkIdUsuario' => array(self::BELONGS_TO, 'Usuario', 'fk_id_usuario'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_usuario_entidad' => 'Id Usuario Entidad',
			'fk_id_usuario' => 'Fk Id Usuario',
			'fk_id_entidad' => 'Fk Id Entidad',
			'fecha_registro_usuario_entidad' => 'Fecha Registro Usuario Entidad',
			'estado_usuario_entidad' => 'Estado Usuario Entidad',
			'fecha_creacion_usuario_entidad' => 'Fecha Creacion Usuario Entidad',
		);
	}	

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UsuarioEntidad la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
