<?php

/**
 * This is the model class for table "biblioteca".
 *
 * The followings are the available columns in table 'biblioteca':
 * @property integer $id_biblioteca
 * @property integer $fk_id_usuario
 * @property integer $fk_id_area_cononcimiento_biblioteca
 * @property integer $fk_id_curso
 * @property integer $fk_id_nivel
 * @property integer $fk_id_turno
 * @property string $tipo_usuario_biblioteca
 * @property string $sexo_usuario_biblioteca
 * @property string $fecha_consulta_biblioteca
 * @property string $observaciones_biblioteca
 * @property string $fecha_creacion_biblioteca
 *
 * The followings are the available model relations:
 * @property AreaConocimientoBiblioteca $fkIdAreaCononcimientoBiblioteca
 * @property Usuario $fkIdUsuario
 * @property Curso $fkIdCurso
 * @property Nivel $fkIdNivel
 * @property Turno $fkIdTurno
 */
class Biblioteca extends CTQ
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'biblioteca';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fk_id_area_cononcimiento_biblioteca, fk_id_curso, fk_id_nivel, fk_id_turno, tipo_usuario_biblioteca, sexo_usuario_biblioteca, fecha_consulta_biblioteca', 'required'),
			array('fk_id_usuario, fk_id_area_cononcimiento_biblioteca, fk_id_curso, fk_id_nivel, fk_id_turno', 'numerical', 'integerOnly'=>true),
			array('observaciones_biblioteca', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_biblioteca, fk_id_usuario, fk_id_area_cononcimiento_biblioteca, fk_id_curso, fk_id_nivel, fk_id_turno, tipo_usuario_biblioteca, sexo_usuario_biblioteca, fecha_consulta_biblioteca, observaciones_biblioteca, fecha_creacion_biblioteca', 'safe', 'on'=>'search'),
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
			'fkIdAreaCononcimientoBiblioteca' => array(self::BELONGS_TO, 'AreaConocimientoBiblioteca', 'fk_id_area_cononcimiento_biblioteca'),
			'fkIdUsuario' => array(self::BELONGS_TO, 'Usuario', 'fk_id_usuario'),
			'fkIdCurso' => array(self::BELONGS_TO, 'Curso', 'fk_id_curso'),
			'fkIdNivel' => array(self::BELONGS_TO, 'Nivel', 'fk_id_nivel'),
			'fkIdTurno' => array(self::BELONGS_TO, 'Turno', 'fk_id_turno'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_biblioteca' => 'Id Biblioteca',
			'fk_id_usuario' => 'Fk Id Usuario',
			'fk_id_area_cononcimiento_biblioteca' => 'Fk Id Area Cononcimiento Biblioteca',
			'fk_id_curso' => 'Fk Id Curso',
			'fk_id_nivel' => 'Fk Id Nivel',
			'fk_id_turno' => 'Fk Id Turno',
			'tipo_usuario_biblioteca' => 'Tipo Usuario Biblioteca',
			'sexo_usuario_biblioteca' => 'Sexo Usuario Biblioteca',
			'fecha_consulta_biblioteca' => 'Fecha Consulta Biblioteca',
			'observaciones_biblioteca' => 'Observaciones Biblioteca',
			'fecha_creacion_biblioteca' => 'Fecha Creacion Biblioteca',
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

		$criteria->compare('id_biblioteca',$this->id_biblioteca);
		$criteria->compare('fk_id_usuario',$this->fk_id_usuario);
		$criteria->compare('fk_id_area_cononcimiento_biblioteca',$this->fk_id_area_cononcimiento_biblioteca);
		$criteria->compare('fk_id_curso',$this->fk_id_curso);
		$criteria->compare('fk_id_nivel',$this->fk_id_nivel);
		$criteria->compare('fk_id_turno',$this->fk_id_turno);
		$criteria->compare('tipo_usuario_biblioteca',$this->tipo_usuario_biblioteca,true);
		$criteria->compare('sexo_usuario_biblioteca',$this->sexo_usuario_biblioteca,true);
		$criteria->compare('fecha_consulta_biblioteca',$this->fecha_consulta_biblioteca,true);
		$criteria->compare('observaciones_biblioteca',$this->observaciones_biblioteca,true);
		$criteria->compare('fecha_creacion_biblioteca',$this->fecha_creacion_biblioteca,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Biblioteca the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
