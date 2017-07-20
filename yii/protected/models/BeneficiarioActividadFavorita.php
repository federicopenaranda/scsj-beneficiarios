<?php
/**
 * Esta es la clase modelo para la tabla "beneficiario_actividad_favorita".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'beneficiario_actividad_favorita':
 * @property integer $fk_id_actividad_favorita
 * @property integer $fk_id_beneficiario
 */
class BeneficiarioActividadFavorita extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName(){
		return 'beneficiario_actividad_favorita';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('fk_id_actividad_favorita, fk_id_beneficiario', 'required'),
			array('fk_id_actividad_favorita, fk_id_beneficiario', 'numerical', 'integerOnly'=>true),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations(){
		return array(
			'fkIdAtividadFavorita' => array(self::BELONGS_TO, 'ActividadFavorita', 'fk_id_actividad_favorita'),
			'fkIdBeneficiario' => array(self::BELONGS_TO, 'Beneficiario', 'fk_id_beneficiario'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels(){
		return array(
			'fk_id_actividad_favorita' => 'Fk Id Actividad Favorita',
			'fk_id_beneficiario' => 'Fk Id Beneficiario',
		);
	}
		
	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BeneficiarioActividadFavorita la clase modelo estatico
	 */
	public static function model($className=__CLASS__){
		return parent::model($className);
	}
}
