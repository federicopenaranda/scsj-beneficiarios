<?php
/**
 * Esta es la clase modelo para la tabla "religion".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'religion':
 * @property integer $id_religion
 * @property string $nombre_religion
 * @property string $descripcion_religion
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property Beneficiario[] $beneficiarios
 */
class Religion extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'religion';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('nombre_religion', 'required'),
			array('nombre_religion', 'length', 'max'=>200),
			array('descripcion_religion', 'safe'),
			array('nombre_religion', 'unique','message'=>'Dato invalido valor duplicado'),
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
			'beneficiarios' => array(self::HAS_MANY, 'Beneficiario', 'fk_id_religion'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_religion' => 'Id Religion',
			'nombre_religion' => 'Nombre Religion',
			'descripcion_religion' => 'Descripcion Religion',
		);
	}	

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Religion la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
