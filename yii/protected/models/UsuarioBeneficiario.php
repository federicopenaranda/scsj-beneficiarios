<?php

/**
 * This is the model class for table "usuario_beneficiario".
 *
 * The followings are the available columns in table 'usuario_beneficiario':
 * @property integer $id_usuario_beneficiario
 * @property integer $fk_id_usuario
 * @property integer $fk_id_gestion_beneficiario
 * @property string $fecha_asignacion_usuario_beneficiario
 * @property integer $estado_usuario_beneficiario
 * @property string $fecha_creacion_usuario_beneficiario
 *
 * The followings are the available model relations:
 * @property Usuario $fkIdUsuario
 * @property GestionBeneficiario $fkIdGestionBeneficiario
 */
class UsuarioBeneficiario extends CTQ
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usuario_beneficiario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fk_id_usuario, fk_id_gestion_beneficiario, fecha_asignacion_usuario_beneficiario, estado_usuario_beneficiario', 'required'),
			array('fk_id_usuario, fk_id_gestion_beneficiario, estado_usuario_beneficiario', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_usuario_beneficiario, fk_id_usuario, fk_id_gestion_beneficiario, fecha_asignacion_usuario_beneficiario, estado_usuario_beneficiario, fecha_creacion_usuario_beneficiario', 'safe', 'on'=>'search'),
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
			'fkIdUsuario' => array(self::BELONGS_TO, 'Usuario', 'fk_id_usuario'),
			'fkIdGestionBeneficiario' => array(self::BELONGS_TO, 'GestionBeneficiario', 'fk_id_gestion_beneficiario'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_usuario_beneficiario' => 'Id Usuario Beneficiario',
			'fk_id_usuario' => 'Fk Id Usuario',
			'fk_id_gestion_beneficiario' => 'Fk Id Gestion Beneficiario',
			'fecha_asignacion_usuario_beneficiario' => 'Fecha Asignacion Usuario Beneficiario',
			'estado_usuario_beneficiario' => 'Estado Usuario Beneficiario',
			'fecha_creacion_usuario_beneficiario' => 'Fecha Creacion Usuario Beneficiario',
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

		$criteria->compare('id_usuario_beneficiario',$this->id_usuario_beneficiario);
		$criteria->compare('fk_id_usuario',$this->fk_id_usuario);
		$criteria->compare('fk_id_gestion_beneficiario',$this->fk_id_gestion_beneficiario);
		$criteria->compare('fecha_asignacion_usuario_beneficiario',$this->fecha_asignacion_usuario_beneficiario,true);
		$criteria->compare('estado_usuario_beneficiario',$this->estado_usuario_beneficiario);
		$criteria->compare('fecha_creacion_usuario_beneficiario',$this->fecha_creacion_usuario_beneficiario,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UsuarioBeneficiario the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
