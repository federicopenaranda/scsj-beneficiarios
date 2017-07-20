<?php
/**
 * Esta es la clase modelo para la tabla "estado_civil".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'estado_civil':
 * @property integer $id_estado_civil
 * @property string $nombre_estado_civil
 * @property string $descripcion_estado_civil
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property BeneficiarioEstadoCivil[] $beneficiarioEstadoCivils
 */
class EstadoCivil extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'estado_civil';
	}
	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('nombre_estado_civil', 'required'),
			array('nombre_estado_civil', 'length', 'max'=>200),
			array('descripcion_estado_civil', 'safe'),
			array('nombre_estado_civil', 'unique','message'=>'Dato invalido valor duplicado'),
			//array('atributo','date','format'=>'yyyy-MM-dd HH:mm:ss','message'=>'Formato invalido para la fecha'),
			//array('atributo','in','range'=>array('valor1','valor2'),'allowEmpty'=>true,'message'=>'Error de seleccion'),
		
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'beneficiarioEstadoCivils' => array(self::HAS_MANY, 'BeneficiarioEstadoCivil', 'fk_id_estado_civil'),
		);
	}
	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_estado_civil' => 'Id Estado Civil',
			'nombre_estado_civil' => 'Nombre del Estado civil que puede registrarse en la base de datos.',
			'descripcion_estado_civil' => 'Descripcion Estado Civil',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EstadoCivil la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
