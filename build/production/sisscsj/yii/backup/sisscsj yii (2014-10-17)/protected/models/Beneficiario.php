<?php
/**
 * Esta es la clase modelo para la tabla "beneficiario".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'beneficiario':
 * @property integer $id_beneficiario
 * @property integer $fk_id_religion
 * @property integer $fk_id_entidad_salud
 * @property integer $fk_id_escolaridad
 * @property string $codigo_beneficiario
 * @property string $numero_identificacion_beneficiario
 * @property string $primer_nombre_beneficiario
 * @property string $segundo_nombre_beneficiario
 * @property string $apellido_paterno_beneficiario
 * @property string $apellido_materno_beneficiario
 * @property string $fecha_nacimiento_beneficiario
 * @property string $sexo_beneficiario
 * @property integer $numero_hijo_beneficiario
 * @property string $fotografia_beneficiario
 * @property string $observacion_beneficiario
 * @property integer $trabaja_beneficiario
 * @property integer $carnet_de_salud_beneficiario
 * @property integer $libreta_escolar_beneficiario
 * @property string $informacion_relevante_beneficiario
 * @property string $fecha_creacion_beneficiario
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property Religion $fkIdReligion
 * @property EntidadSalud $fkIdEntidadSalud
 * @property Escolaridad $fkIdEscolaridad
 * @property ActividadFavorita[] $actividadFavoritas
 * @property BeneficiarioAsistencia[] $beneficiarioAsistencias
 * @property Donante[] $donantes
 * @property BeneficiarioEntidad[] $beneficiarioEntidads
 * @property BeneficiarioEstadoBeneficiario[] $beneficiarioEstadoBeneficiarios
 * @property BeneficiarioEstadoCivil[] $beneficiarioEstadoCivils
 * @property BeneficiarioFamilia[] $beneficiarioFamilias
 * @property Idioma[] $idiomas
 * @property BeneficiarioOcupacion[] $beneficiarioOcupacions
 * @property OtrosProgramas[] $otrosProgramases
 * @property Patrocinador[] $patrocinadors
 * @property BeneficiarioTelefono[] $beneficiarioTelefonos
 * @property TipoIdentificacion[] $tipoIdentificacions
 * @property BeneficiarioTrabajo[] $beneficiarioTrabajos
 * @property UnidadEducativa[] $unidadEducativas
 * @property EvalAtencionMedica[] $evalAtencionMedicas
 * @property EvalComputacion[] $evalComputacions
 * @property EvalEduChildfund[] $evalEduChildfunds
 * @property EvalEduNelsonOrtiz[] $evalEduNelsonOrtizs
 * @property EvalEnfermeria[] $evalEnfermerias
 * @property EvalNutricion[] $evalNutricions
 * @property EvalOdontologia[] $evalOdontologias
 * @property EvalPedagogico[] $evalPedagogicos
 * @property EvalPsicologico[] $evalPsicologicos
 * @property GestionBeneficiario[] $gestionBeneficiarios
 * @property Parentesco[] $parentescos
 * @property Parentesco[] $parentescos1
 * @property UsuarioBeneficiario[] $usuarioBeneficiarios
 */
class Beneficiario extends CTQ
{
	public $fotografia_beneficiario;
	/**
	 * @return string retorna el nombre de la tabla de datos asociado al modelo
	 */
	public function tableName(){
		return 'beneficiario';
	}
	/**
	 * @return array retorna las reglas de validacion de los atributos del modelo.
	 */
	public function rules(){
		return array(
			array('fk_id_religion, fk_id_entidad_salud, fk_id_escolaridad, codigo_beneficiario, numero_identificacion_beneficiario, primer_nombre_beneficiario, apellido_paterno_beneficiario, sexo_beneficiario, trabaja_beneficiario', 'required'),
			array('fk_id_religion, fk_id_entidad_salud, fk_id_escolaridad, numero_hijo_beneficiario, trabaja_beneficiario, carnet_de_salud_beneficiario, libreta_escolar_beneficiario', 'numerical', 'integerOnly'=>true),
			array('codigo_beneficiario, numero_identificacion_beneficiario, primer_nombre_beneficiario, segundo_nombre_beneficiario, apellido_paterno_beneficiario, apellido_materno_beneficiario', 'length', 'max'=>45),
			array('fotografia_beneficiario', 'length', 'max'=>300),
			array('fecha_nacimiento_beneficiario, observacion_beneficiario, informacion_relevante_beneficiario', 'safe'),
			array('codigo_beneficiario, numero_identificacion_beneficiario', 'unique','message'=>'Dato invalido valor duplicado'),
			#array('fecha_nacimiento_beneficiario', 'date', 'format'=>'yyyy-MM-ddT00:00:00','message'=>'Formato invalido para la fecha'),
			array('sexo_beneficiario','in','range'=>array('f','m'),'allowEmpty'=>true,'message'=>'Error de seleccion'),
			array('trabaja_beneficiario, carnet_de_salud_beneficiario, libreta_escolar_beneficiario','in','range'=>array(true,false,1,0),'allowEmpty'=>true,'message'=>'Error de seleccion'),
		);
	}
	/**
	 * @return array retorna las reglas relacionales.
	 */
	public function relations(){
		return array(
			'fkIdReligion' => array(self::BELONGS_TO, 'Religion', 'fk_id_religion'),
			'fkIdEntidadSalud' => array(self::BELONGS_TO, 'EntidadSalud', 'fk_id_entidad_salud'),
			'fkIdEscolaridad' => array(self::BELONGS_TO, 'Escolaridad', 'fk_id_escolaridad'),
			'actividadFavoritas' => array(self::MANY_MANY, 'ActividadFavorita', 'beneficiario_actividad_favorita(fk_id_beneficiario, fk_id_actividad_favorita)'),
			'beneficiarioAsistencias' => array(self::HAS_MANY, 'BeneficiarioAsistencia', 'fk_id_beneficiario'),
			'donantes' => array(self::MANY_MANY, 'Donante', 'beneficiario_donante(fk_id_beneficiario, fk_id_donante)'),
			'beneficiarioEntidads' => array(self::HAS_MANY, 'BeneficiarioEntidad', 'fk_id_beneficiario'),
			'beneficiarioEstadoBeneficiarios' => array(self::HAS_MANY, 'BeneficiarioEstadoBeneficiario', 'fk_id_beneficiario'),
			'beneficiarioEstadoCivils' => array(self::HAS_MANY, 'BeneficiarioEstadoCivil', 'fk_id_beneficiario'),
			'beneficiarioFamilias' => array(self::HAS_MANY, 'BeneficiarioFamilia', 'fk_id_beneficiario'),
			'idiomas' => array(self::MANY_MANY, 'Idioma', 'beneficiario_idioma(fk_id_beneficiario, fk_id_idioma)'),
			'beneficiarioOcupacions' => array(self::HAS_MANY, 'BeneficiarioOcupacion', 'fk_id_beneficiario'),
			'otrosProgramases' => array(self::MANY_MANY, 'OtrosProgramas', 'beneficiario_otros_programas(fk_id_beneficiario, fk_id_otros_programas)'),
			'patrocinadors' => array(self::MANY_MANY, 'Patrocinador', 'beneficiario_patrocinador(fk_id_beneficiario, fk_id_patrocinador)'),
			'beneficiarioTelefonos' => array(self::HAS_MANY, 'BeneficiarioTelefono', 'fk_id_beneficiario'),
			'tipoIdentificacions' => array(self::MANY_MANY, 'TipoIdentificacion', 'beneficiario_tipo_identificacion(fk_id_beneficiario, fk_id_tipo_identificacion)'),
			'beneficiarioTrabajos' => array(self::HAS_MANY, 'BeneficiarioTrabajo', 'fk_id_beneficiario'),
			'unidadEducativas' => array(self::MANY_MANY, 'UnidadEducativa', 'beneficiario_unidad_educativa(fk_id_beneficiario, fk_id_unidad_educativa)'),
			'evalAtencionMedicas' => array(self::HAS_MANY, 'EvalAtencionMedica', 'fk_id_beneficiario'),
			'evalComputacions' => array(self::HAS_MANY, 'EvalComputacion', 'fk_id_beneficiario'),
			'evalEduChildfunds' => array(self::HAS_MANY, 'EvalEduChildfund', 'fk_id_beneficiario'),
			'evalEduNelsonOrtizs' => array(self::HAS_MANY, 'EvalEduNelsonOrtiz', 'fk_id_beneficiario'),
			'evalEnfermerias' => array(self::HAS_MANY, 'EvalEnfermeria', 'fk_id_beneficiario'),
			'evalNutricions' => array(self::HAS_MANY, 'EvalNutricion', 'fk_id_beneficiario'),
			'evalOdontologias' => array(self::HAS_MANY, 'EvalOdontologia', 'fk_id_beneficiario'),
			'evalPedagogicos' => array(self::HAS_MANY, 'EvalPedagogico', 'fk_id_beneficiario'),
			'evalPsicologicos' => array(self::HAS_MANY, 'EvalPsicologico', 'fk_id_beneficiario'),
			'gestionBeneficiarios' => array(self::HAS_MANY, 'GestionBeneficiario', 'fk_id_beneficiario'),
			'parentescos' => array(self::HAS_MANY, 'Parentesco', 'fk_id_beneficiario'),
			'parentescos1' => array(self::HAS_MANY, 'Parentesco', 'fk_id_beneficiario1'),
			'usuarioBeneficiarios' => array(self::HAS_MANY, 'UsuarioBeneficiario', 'fk_id_beneficiario'),
			//yo
			'beneficiarioTipos' => array(self::HAS_MANY, 'BeneficiarioTipo', 'beneficiario_estado_beneficiario(fk_id_beneficiario,fk_id_beneficiario_tipo)'),
			'beneficiarioTipoIdentificacions' => array(self::HAS_MANY, 'BeneficiarioTipoIdentificacion', 'fk_id_beneficiario'),
			//read
			'beneficiarioIdiomas' => array(self::HAS_MANY, 'BeneficiarioIdioma', 'fk_id_beneficiario'),
			'beneficiarioActividadFavoritas'=>array(self::HAS_MANY, 'BeneficiarioActividadFavorita', 'fk_id_beneficiario'),			'beneficiarioOtrosProgramas'=>array(self::HAS_MANY, 'BeneficiarioOtrosProgramas', 'fk_id_beneficiario'),
		);
	}
	/**
	 * @return array retorna etiquetas de atributos personalizados (name=>label)
	 */
	public function attributeLabels(){
		return array(
			'id_beneficiario' => 'Id Beneficiario',
			'fk_id_religion' => 'Fk Id Religion',
			'fk_id_entidad_salud' => 'Fk Id Entidad Salud',
			'fk_id_escolaridad' => 'Fk Id Escolaridad',
			'codigo_beneficiario' => 'Codigo Beneficiario',
			'numero_identificacion_beneficiario' => 'Numero Identificacion Beneficiario',
			'primer_nombre_beneficiario' => 'Primer Nombre Beneficiario',
			'segundo_nombre_beneficiario' => 'Segundo Nombre Beneficiario',
			'apellido_paterno_beneficiario' => 'Apellido Paterno Beneficiario',
			'apellido_materno_beneficiario' => 'Apellido Materno Beneficiario',
			'fecha_nacimiento_beneficiario' => 'Fecha Nacimiento Beneficiario',
			'sexo_beneficiario' => 'Sexo Beneficiario',
			'numero_hijo_beneficiario' => 'Numero Hijo Beneficiario',
			'fotografia_beneficiario' => 'Fotografia Beneficiario',
			'observacion_beneficiario' => 'Observacion Beneficiario',
			'trabaja_beneficiario' => 'Trabaja Beneficiario',
			'carnet_de_salud_beneficiario' => 'Carnet De Salud Beneficiario',
			'libreta_escolar_beneficiario' => 'Libreta Escolar Beneficiario',
			'informacion_relevante_beneficiario' => 'Informacion Relevante Beneficiario',
			'fecha_creacion_beneficiario' => 'Fecha Creacion Beneficiario',
		);
	}	
	/**
	 * Devuelve el modelo estatico de la clase AR especificado.
	 * Tenga en cuenta que usted debe tener este metodo exacto en todas sus CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Beneficiario la clase modelo estatico
	 */
	public static function model($className=__CLASS__){
		return parent::model($className);
	}
}
