<?php
/**
 * Esta es la clase modelo para la tabla "estado_beneficiario".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'estado_beneficiario':
 * @property integer $id_estado_beneficiario
 * @property string $nombre_estado_beneficiario
 * @property string $descripcion_estado_beneficiario
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property BeneficiarioEstadoBeneficiario[] $beneficiarioEstadoBeneficiarios
 */
class EstadoBeneficiario extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'estado_beneficiario';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('nombre_estado_beneficiario', 'required'),
			array('nombre_estado_beneficiario', 'length', 'max'=>200),
			array('descripcion_estado_beneficiario', 'safe'),
			array('nombre_estado_beneficiario', 'unique','message'=>'Dato invalido valor duplicado'),
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
			'beneficiarioEstadoBeneficiarios' => array(self::HAS_MANY, 'BeneficiarioEstadoBeneficiario', 'fk_id_estado_beneficiario'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_estado_beneficiario' => 'Id Estado Beneficiario',
			'nombre_estado_beneficiario' => 'Nombre Estado Beneficiario',
			'descripcion_estado_beneficiario' => 'Descripcion Estado Beneficiario',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EstadoBeneficiario la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
