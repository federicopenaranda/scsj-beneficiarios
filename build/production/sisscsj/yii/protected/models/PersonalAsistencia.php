<?php
/**
 * Esta es la clase modelo para la tabla "personal_asistencia".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'personal_asistencia':
 * @property integer $id_personal_asistencia
 * @property integer $fk_id_asistencia
 * @property integer $fk_id_usuario
 * @property integer $fk_id_estado_asistencia
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property Asistencia $fkIdAsistencia
 * @property EstadoAsistencia $fkIdEstadoAsistencia
 * @property Usuario $fkIdUsuario
 */
class PersonalAsistencia extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'personal_asistencia';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('fk_id_asistencia', 'required'),
			array('fk_id_asistencia, fk_id_usuario, fk_id_estado_asistencia', 'numerical', 'integerOnly'=>true),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'fkIdAsistencia' => array(self::BELONGS_TO, 'Asistencia', 'fk_id_asistencia'),
			'fkIdEstadoAsistencia' => array(self::BELONGS_TO, 'EstadoAsistencia', 'fk_id_estado_asistencia'),
			'fkIdUsuario' => array(self::BELONGS_TO, 'Usuario', 'fk_id_usuario'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_personal_asistencia' => 'Id Personal Asistencia',
			'fk_id_asistencia' => 'Fk Id Asistencia',
			'fk_id_usuario' => 'Fk Id Usuario',
			'fk_id_estado_asistencia' => 'Fk Id Estado Asistencia',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PersonalAsistencia la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
