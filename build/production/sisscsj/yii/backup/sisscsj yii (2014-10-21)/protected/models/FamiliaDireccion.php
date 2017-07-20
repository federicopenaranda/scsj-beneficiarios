<?php
/**
 * Esta es la clase modelo para la tabla "familia_direccion".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'familia_direccion':
 * @property integer $id_familia_direccion
 * @property integer $fk_id_sector
 * @property integer $fk_id_familia
 * @property string $direccion_familia_direccion
 * @property string $fecha_creacion_famillia_direccion
 * @property integer $estado_familia_direccion
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property Familia $fkIdFamilia
 * @property Sector $fkIdSector
 */
class FamiliaDireccion extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'familia_direccion';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('fk_id_familia, estado_familia_direccion', 'required'),
			array('fk_id_sector, fk_id_familia', 'numerical', 'integerOnly'=>true),
			array('direccion_familia_direccion', 'safe'),
			array('estado_familia_direccion','in','range'=>array(true,false,1,0),'allowEmpty'=>true,'message'=>'Error de seleccion'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'fkIdFamilia' => array(self::BELONGS_TO, 'Familia', 'fk_id_familia'),
			'fkIdSector' => array(self::BELONGS_TO, 'Sector', 'fk_id_sector'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_familia_direccion' => 'Id Familia Direccion',
			'fk_id_sector' => 'Fk Id Sector',
			'fk_id_familia' => 'Fk Id Familia',
			'direccion_familia_direccion' => 'Direccion Familia Direccion',
			'fecha_creacion_famillia_direccion' => 'Fecha Creacion Famillia Direccion',
			'estado_familia_direccion' => 'Estado Familia Direccion',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FamiliaDireccion la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
