<?php

/**
 * This is the model class for table "beneficiario".
 *
 * The followings are the available columns in table 'beneficiario':
 * @property integer $id_beneficiario
 * @property integer $fk_id_religion
 * @property integer $fk_id_entidad_salud
 * @property integer $fk_id_curso
 * @property integer $fk_id_nivel
 * @property integer $fk_id_turno
 * @property string $codigo_beneficiario
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
 * The followings are the available model relations:
 * @property Religion $fkIdReligion
 * @property EntidadSalud $fkIdEntidadSalud
 * @property Curso $fkIdCurso
 * @property Nivel $fkIdNivel
 * @property Turno $fkIdTurno
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
 * @property BeneficiarioPatrocinador[] $beneficiarioPatrocinadors
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
 */
class Beneficiario extends CTQ
{
	public $fotografia_beneficiario;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'beneficiario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('codigo_beneficiario, primer_nombre_beneficiario, sexo_beneficiario, trabaja_beneficiario', 'required'),
			array('fk_id_religion, fk_id_entidad_salud, fk_id_curso, fk_id_nivel, fk_id_turno, numero_hijo_beneficiario, trabaja_beneficiario, carnet_de_salud_beneficiario, libreta_escolar_beneficiario', 'numerical', 'integerOnly'=>true),
			array('codigo_beneficiario, primer_nombre_beneficiario, segundo_nombre_beneficiario, apellido_paterno_beneficiario, apellido_materno_beneficiario', 'length', 'max'=>45),
			array('fotografia_beneficiario', 'length', 'max'=>300),
			array('fecha_nacimiento_beneficiario, observacion_beneficiario, informacion_relevante_beneficiario', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_beneficiario, fk_id_religion, fk_id_entidad_salud, fk_id_curso, fk_id_nivel, fk_id_turno, codigo_beneficiario, primer_nombre_beneficiario, segundo_nombre_beneficiario, apellido_paterno_beneficiario, apellido_materno_beneficiario, fecha_nacimiento_beneficiario, sexo_beneficiario, numero_hijo_beneficiario, fotografia_beneficiario, observacion_beneficiario, trabaja_beneficiario, carnet_de_salud_beneficiario, libreta_escolar_beneficiario, informacion_relevante_beneficiario, fecha_creacion_beneficiario', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'fkIdReligion' => array(self::BELONGS_TO, 'Religion', 'fk_id_religion'),
			'fkIdEntidadSalud' => array(self::BELONGS_TO, 'EntidadSalud', 'fk_id_entidad_salud'),
			'fkIdCurso' => array(self::BELONGS_TO, 'Curso', 'fk_id_curso'),
			'fkIdNivel' => array(self::BELONGS_TO, 'Nivel', 'fk_id_nivel'),
			'fkIdTurno' => array(self::BELONGS_TO, 'Turno', 'fk_id_turno'),
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
			'beneficiarioPatrocinadors' => array(self::HAS_MANY, 'BeneficiarioPatrocinador', 'fk_id_beneficiario'),
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
			//yo
			'beneficiarioTipos' => array(self::HAS_MANY, 'BeneficiarioTipo', 'beneficiario_estado_beneficiario(fk_id_beneficiario,fk_id_beneficiario_tipo)'),
			'beneficiarioTipoIdentificacions' => array(self::HAS_MANY, 'BeneficiarioTipoIdentificacion', 'fk_id_beneficiario'),
			//read
			'beneficiarioIdiomas' => array(self::HAS_MANY, 'BeneficiarioIdioma', 'fk_id_beneficiario'),
			'beneficiarioActividadFavoritas'=>array(self::HAS_MANY, 'BeneficiarioActividadFavorita', 'fk_id_beneficiario'),			'beneficiarioOtrosProgramas'=>array(self::HAS_MANY, 'BeneficiarioOtrosProgramas', 'fk_id_beneficiario'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_beneficiario' => 'Id Beneficiario',
			'fk_id_religion' => 'Fk Id Religion',
			'fk_id_entidad_salud' => 'Fk Id Entidad Salud',
			'fk_id_curso' => 'Fk Id Curso',
			'fk_id_nivel' => 'Fk Id Nivel',
			'fk_id_turno' => 'Fk Id Turno',
			'codigo_beneficiario' => 'Codigo Beneficiario',
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
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_beneficiario',$this->id_beneficiario);
		$criteria->compare('fk_id_religion',$this->fk_id_religion);
		$criteria->compare('fk_id_entidad_salud',$this->fk_id_entidad_salud);
		$criteria->compare('fk_id_curso',$this->fk_id_curso);
		$criteria->compare('fk_id_nivel',$this->fk_id_nivel);
		$criteria->compare('fk_id_turno',$this->fk_id_turno);
		$criteria->compare('codigo_beneficiario',$this->codigo_beneficiario,true);
		$criteria->compare('primer_nombre_beneficiario',$this->primer_nombre_beneficiario,true);
		$criteria->compare('segundo_nombre_beneficiario',$this->segundo_nombre_beneficiario,true);
		$criteria->compare('apellido_paterno_beneficiario',$this->apellido_paterno_beneficiario,true);
		$criteria->compare('apellido_materno_beneficiario',$this->apellido_materno_beneficiario,true);
		$criteria->compare('fecha_nacimiento_beneficiario',$this->fecha_nacimiento_beneficiario,true);
		$criteria->compare('sexo_beneficiario',$this->sexo_beneficiario,true);
		$criteria->compare('numero_hijo_beneficiario',$this->numero_hijo_beneficiario);
		$criteria->compare('fotografia_beneficiario',$this->fotografia_beneficiario,true);
		$criteria->compare('observacion_beneficiario',$this->observacion_beneficiario,true);
		$criteria->compare('trabaja_beneficiario',$this->trabaja_beneficiario);
		$criteria->compare('carnet_de_salud_beneficiario',$this->carnet_de_salud_beneficiario);
		$criteria->compare('libreta_escolar_beneficiario',$this->libreta_escolar_beneficiario);
		$criteria->compare('informacion_relevante_beneficiario',$this->informacion_relevante_beneficiario,true);
		$criteria->compare('fecha_creacion_beneficiario',$this->fecha_creacion_beneficiario,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Beneficiario the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
