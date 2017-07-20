<?php
/**
 * Esta es la clase modelo para la tabla "asistencia".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'asistencia':
 * @property integer $id_asistencia
 * @property integer $fk_id_usuario
 * @property integer $fk_id_actividad
 * @property string $fecha_asistencia
 * @property string $fecha_creacion_asistencia
 * @property string $observaciones_asistencia
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property Actividad $fkIdActividad
 * @property Usuario $fkIdUsuario
 * @property BeneficiarioAsistencia[] $beneficiarioAsistencias
 * @property PersonalAsistencia[] $personalAsistencias
 */
class Asistencia extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'asistencia';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			//array('fecha_asistencia', 'required'),
			array('fk_id_usuario, fk_id_actividad', 'numerical', 'integerOnly'=>true),
			array('observaciones_asistencia', 'safe'),
			#array('fecha_asistencia','date','format'=>'yyyy-MM-dd','message'=>'Formato invalido para la fecha'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'fkIdActividad' => array(self::BELONGS_TO, 'Actividad', 'fk_id_actividad'),
			'fkIdUsuario' => array(self::BELONGS_TO, 'Usuario', 'fk_id_usuario'),
			'beneficiarioAsistencias' => array(self::HAS_MANY, 'BeneficiarioAsistencia', 'fk_id_asistencia'),
			'personalAsistencias' => array(self::HAS_MANY, 'PersonalAsistencia', 'fk_id_asistencia'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_asistencia' => 'Id Asistencia',
			'fk_id_usuario' => 'Fk Id Usuario',
			'fk_id_actividad' => 'Fk Id Actividad',
			'fecha_asistencia' => 'Fecha Asistencia',
			'fecha_creacion_asistencia' => 'Fecha Creacion Asistencia',
			'observaciones_asistencia' => 'Observaciones Asistencia',
		);
	}
		
	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Asistencia la clase modelo estatico
	 */
	public static function model($className=__CLASS__){
		return parent::model($className);
	}
}
