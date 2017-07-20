<?php
/**
 * Esta es la clase modelo para la tabla "familia_tipo_casa".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'familia_tipo_casa':
 * @property integer $id_familia_tipo_casa
 * @property integer $fk_id_familia
 * @property integer $fk_id_tipo_cocina
 * @property integer $fk_id_tipo_casa
 * @property string $observacion_familia_tipo_casa
 * @property integer $estado_familia_tipo_casa
 * @property string $fecha_registro_familia_tipo_casa
 * @property integer $cuartos_multiuso_familia_tipo_casa
 * @property integer $ambientes_familia_tipo_casa
 * @property string $fecha_creacion_familia_tipo_casa
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property Familia $fkIdFamilia
 * @property TipoCasa $fkIdTipoCasa
 * @property TipoCocina $fkIdTipoCocina
 */
class FamiliaTipoCasa extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'familia_tipo_casa';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('fk_id_familia, fk_id_tipo_cocina, fk_id_tipo_casa, ambientes_familia_tipo_casa', 'required'),
			array('fk_id_familia, fk_id_tipo_cocina, ambientes_familia_tipo_casa', 'numerical', 'integerOnly'=>true),
			array('observacion_familia_tipo_casa, fecha_registro_familia_tipo_casa', 'safe'),
			#array('fecha_registro_familia_tipo_casa','date','format'=>'yyyy-MM-ddT00:00:00','message'=>'Formato invalido para la fecha'),
			array('estado_familia_tipo_casa, cuartos_multiuso_familia_tipo_casa','in','range'=>array(true,false,1,0),'allowEmpty'=>true,'message'=>'Error de seleccion'),
			#array('estado_familia_tipo_casa','default','setOnEmpty'=>1),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'fkIdFamilia' => array(self::BELONGS_TO, 'Familia', 'fk_id_familia'),
			'fkIdTipoCasa' => array(self::BELONGS_TO, 'TipoCasa', 'fk_id_tipo_casa'),
			'fkIdTipoCocina' => array(self::BELONGS_TO, 'TipoCocina', 'fk_id_tipo_cocina'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_familia_tipo_casa' => 'Id Familia Tipo Casa',
			'fk_id_familia' => 'Fk Id Familia',
			'fk_id_tipo_cocina' => 'Fk Id Tipo Cocina',
			'fk_id_tipo_casa' => 'Fk Id Tipo Casa',
			'observacion_familia_tipo_casa' => 'Observacion Familia Tipo Casa',
			'estado_familia_tipo_casa' => 'Estado Familia Tipo Casa',
			'fecha_registro_familia_tipo_casa' => 'Fecha Registro Familia Tipo Casa',
			'cuartos_multiuso_familia_tipo_casa' => 'Cuartos Multiuso Familia Tipo Casa',
			'ambientes_familia_tipo_casa' => 'Ambientes Familia Tipo Casa',
			'fecha_creacion_familia_tipo_casa' => 'Fecha Creacion Familia Tipo Casa',
		);
	}
		
	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FamiliaTipoCasa la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
