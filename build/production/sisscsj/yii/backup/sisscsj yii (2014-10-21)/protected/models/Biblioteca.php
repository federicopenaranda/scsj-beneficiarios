<?php
/**
 * Esta es la clase modelo para la tabla "biblioteca".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'biblioteca':
 * @property integer $id_biblioteca
 * @property integer $fk_id_usuario
 * @property integer $fk_id_area_cononcimiento_biblioteca
 * @property integer $fk_id_escolaridad
 * @property string $tipo_usuario_biblioteca
 * @property string $sexo_usuario_biblioteca
 * @property string $fecha_consulta_biblioteca
 * @property string $observaciones_biblioteca
 * @property string $fecha_creacion_biblioteca
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property AreaConocimientoBiblioteca $fkIdAreaCononcimientoBiblioteca
 * @property Escolaridad $fkIdEscolaridad
 * @property Usuario $fkIdUsuario
 */
class Biblioteca extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'biblioteca';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('fk_id_area_cononcimiento_biblioteca, fk_id_escolaridad, tipo_usuario_biblioteca, sexo_usuario_biblioteca, fecha_consulta_biblioteca', 'required'),
			array('fk_id_usuario, fk_id_area_cononcimiento_biblioteca, fk_id_escolaridad', 'numerical', 'integerOnly'=>true),
			array('observaciones_biblioteca', 'safe'),
			#array('fecha_consulta_biblioteca','date','format'=>'yyyy-MM-dd','message'=>'Formato invalido para la fecha'),
			array('tipo_usuario_biblioteca','in','range'=>array('beneficiario','comunidad','educador_funcionario','entorno_familiar','otros'),'allowEmpty'=>true,'message'=>'Error de seleccion'),
			array('sexo_usuario_biblioteca','in','range'=>array('f','m'),'allowEmpty'=>true,'message'=>'Error de seleccion'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'fkIdAreaCononcimientoBiblioteca' => array(self::BELONGS_TO, 'AreaConocimientoBiblioteca', 'fk_id_area_cononcimiento_biblioteca'),
			'fkIdEscolaridad' => array(self::BELONGS_TO, 'Escolaridad', 'fk_id_escolaridad'),
			'fkIdUsuario' => array(self::BELONGS_TO, 'Usuario', 'fk_id_usuario'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_biblioteca' => 'Id Biblioteca',
			'fk_id_usuario' => 'Fk Id Usuario',
			'fk_id_area_cononcimiento_biblioteca' => 'Fk Id Area Cononcimiento Biblioteca',
			'fk_id_escolaridad' => 'Fk Id Escolaridad',
			'tipo_usuario_biblioteca' => 'Tipo Usuario Biblioteca',
			'sexo_usuario_biblioteca' => 'Sexo Usuario Biblioteca',
			'fecha_consulta_biblioteca' => 'Fecha Consulta Biblioteca',
			'observaciones_biblioteca' => 'Observaciones Biblioteca',
			'fecha_creacion_biblioteca' => 'Fecha Creacion Biblioteca',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Biblioteca la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
