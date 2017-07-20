<?php
/**
 * Esta es la clase modelo para la tabla "patrocinador".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'patrocinador':
 * @property integer $id_patrocinador
 * @property integer $fk_id_tipo_patrocinador
 * @property string $nombre_patrocinador
 * @property string $apellido_patrocinador
 * @property string $codigo_patrocinador
 * @property string $observaciones_patrocinador
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property Beneficiario[] $beneficiarios
 * @property TipoPatrocinador $fkIdTipoPatrocinador
 */
class Patrocinador extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'patrocinador';
	}
	
	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('fk_id_tipo_patrocinador, nombre_patrocinador, apellido_patrocinador', 'required'),
			array('fk_id_tipo_patrocinador', 'numerical', 'integerOnly'=>true),
			array('nombre_patrocinador, apellido_patrocinador', 'length', 'max'=>200),
			array('codigo_patrocinador', 'length', 'max'=>45),
			array('observaciones_patrocinador', 'safe'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'beneficiarios' => array(self::MANY_MANY, 'Beneficiario', 'beneficiario_patrocinador(fk_id_patrocinador, fk_id_beneficiario)'),
			'fkIdTipoPatrocinador' => array(self::BELONGS_TO, 'TipoPatrocinador', 'fk_id_tipo_patrocinador'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_patrocinador' => 'Id Patrocinador',
			'fk_id_tipo_patrocinador' => 'Fk Id Tipo Patrocinador',
			'nombre_patrocinador' => 'Nombre Patrocinador',
			'apellido_patrocinador' => 'Apellido Patrocinador',
			'codigo_patrocinador' => 'Codigo Patrocinador',
			'observaciones_patrocinador' => 'Observaciones Patrocinador',
		);
	}

	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Patrocinador la clase modelo estatico
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
