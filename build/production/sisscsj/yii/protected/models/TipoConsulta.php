<?php
/**
 * Esta es la clase modelo para la tabla "tipo_consulta".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'tipo_consulta':
 * @property integer $id_tipo_consulta
 * @property string $nombre_tipo_consulta
 * @property string $descripcion_tipo_consulta
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property EvalAtencionMedica[] $evalAtencionMedicas
 * @property EvalEduChildfund[] $evalEduChildfunds
 * @property EvalEduNelsonOrtiz[] $evalEduNelsonOrtizs
 * @property EvalEnfermeria[] $evalEnfermerias
 * @property EvalNutricion[] $evalNutricions
 * @property EvalOdontologia[] $evalOdontologias
 * @property EvalPsicologico[] $evalPsicologicos
 */
class TipoConsulta extends CTQ
{
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName()
	{
		return 'tipo_consulta';
	}

	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules()
	{
		return array(
			array('nombre_tipo_consulta', 'required'),
			array('nombre_tipo_consulta', 'length', 'max'=>200),
			array('descripcion_tipo_consulta', 'safe'),
			array('nombre_tipo_consulta', 'unique','message'=>'Dato invalido valor duplicado'),
		);
	}

	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations()
	{
		return array(
			'evalAtencionMedicas' => array(self::HAS_MANY, 'EvalAtencionMedica', 'fk_id_tipo_consulta'),
			'evalEduChildfunds' => array(self::HAS_MANY, 'EvalEduChildfund', 'fk_id_tipo_consulta'),
			'evalEduNelsonOrtizs' => array(self::HAS_MANY, 'EvalEduNelsonOrtiz', 'fk_id_tipo_consulta'),
			'evalEnfermerias' => array(self::HAS_MANY, 'EvalEnfermeria', 'fk_id_tipo_consulta'),
			'evalNutricions' => array(self::HAS_MANY, 'EvalNutricion', 'fk_id_tipo_consulta'),
			'evalOdontologias' => array(self::HAS_MANY, 'EvalOdontologia', 'fk_id_tipo_consulta'),
			'evalPsicologicos' => array(self::HAS_MANY, 'EvalPsicologico', 'fk_id_tipo_consulta'),
		);
	}

	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_tipo_consulta' => 'Id Tipo Consulta',
			'nombre_tipo_consulta' => 'Nombre Tipo Consulta',
			'descripcion_tipo_consulta' => 'Descripcion Tipo Consulta',
		);
	}	
	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TipoConsulta la clase modelo estatico
	 */
	public static function model($className=__CLASS__){
		return parent::model($className);
	}
}
