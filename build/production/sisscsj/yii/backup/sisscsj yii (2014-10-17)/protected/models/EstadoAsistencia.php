<?php
/**
 * Esta es la clase modelo para la tabla "estado_asistencia".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'estado_asistencia':
 * @property integer $id_estado_asistencia
 * @property string $nombre_estado_asistencia
 * @property string $descripcion_estado_asistencia
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property BeneficiarioAsistencia[] $beneficiarioAsistencias
 * @property PersonalAsistencia[] $personalAsistencias
 */
class EstadoAsistencia extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'estado_asistencia';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('nombre_estado_asistencia', 'required'),
			array('nombre_estado_asistencia', 'length', 'max'=>100),
			array('descripcion_estado_asistencia', 'safe'),
			array('nombre_estado_asistencia', 'unique','message'=>'Dato invalido valor duplicado'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'beneficiarioAsistencias' => array(self::HAS_MANY, 'BeneficiarioAsistencia', 'fk_id_estado_asistencia'),
			'personalAsistencias' => array(self::HAS_MANY, 'PersonalAsistencia', 'fk_id_estado_asistencia'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_estado_asistencia' => 'Id Estado Asistencia',
			'nombre_estado_asistencia' => 'Nombre Estado Asistencia',
			'descripcion_estado_asistencia' => 'Descripcion Estado Asistencia',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EstadoAsistencia la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
