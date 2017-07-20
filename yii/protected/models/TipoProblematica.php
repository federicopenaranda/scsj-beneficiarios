<?php
/**
 * Esta es la clase modelo para la tabla "tipo_problematica".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'tipo_problematica':
 * @property integer $id_tipo_problematica
 * @property string $nombre_tipo_problematica
 * @property string $descripcion_tipo_problematica
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property EvalPsicologico[] $evalPsicologicos
 */
class TipoProblematica extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'tipo_problematica';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('nombre_tipo_problematica', 'required'),
			array('nombre_tipo_problematica', 'length', 'max'=>200),
			array('descripcion_tipo_problematica', 'safe'),
			array('nombre_tipo_problematica', 'unique','message'=>'Dato invalido valor duplicado'),
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
			'evalPsicologicos' => array(self::HAS_MANY, 'EvalPsicologico', 'fk_id_tipo_problematica'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_tipo_problematica' => 'Id Tipo Problematica',
			'nombre_tipo_problematica' => 'Nombre Tipo Problematica',
			'descripcion_tipo_problematica' => 'Descripcion Tipo Problematica',
		);
	}	

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TipoProblematica la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
