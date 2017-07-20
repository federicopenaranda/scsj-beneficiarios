<?php

/**
 * This is the model class for table "beneficiario_unidad_educativa".
 *
 * The followings are the available columns in table 'beneficiario_unidad_educativa':
 * @property string $id_beneficiario_unidad_educativa
 * @property integer $fk_id_unidad_educativa
 * @property integer $fk_id_beneficiario
 * @property string $fecha_creacion_beneficiario_unidad_educativa
 * @property integer $estado_beneficiario_unidad_educativa
 *
 * The followings are the available model relations:
 * @property Beneficiario $fkIdBeneficiario
 * @property UnidadEducativa $fkIdUnidadEducativa
 */
class BeneficiarioUnidadEducativa extends CTQ
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'beneficiario_unidad_educativa';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fk_id_unidad_educativa, fk_id_beneficiario, estado_beneficiario_unidad_educativa', 'required'),
			array('fk_id_unidad_educativa, fk_id_beneficiario, estado_beneficiario_unidad_educativa', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_beneficiario_unidad_educativa, fk_id_unidad_educativa, fk_id_beneficiario, fecha_creacion_beneficiario_unidad_educativa, estado_beneficiario_unidad_educativa', 'safe', 'on'=>'search'),
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
			'fkIdBeneficiario' => array(self::BELONGS_TO, 'Beneficiario', 'fk_id_beneficiario'),
			'fkIdUnidadEducativa' => array(self::BELONGS_TO, 'UnidadEducativa', 'fk_id_unidad_educativa'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_beneficiario_unidad_educativa' => 'Id Beneficiario Unidad Educativa',
			'fk_id_unidad_educativa' => 'Fk Id Unidad Educativa',
			'fk_id_beneficiario' => 'Fk Id Beneficiario',
			'fecha_creacion_beneficiario_unidad_educativa' => 'Fecha Creacion Beneficiario Unidad Educativa',
			'estado_beneficiario_unidad_educativa' => 'Estado Beneficiario Unidad Educativa',
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

		$criteria->compare('id_beneficiario_unidad_educativa',$this->id_beneficiario_unidad_educativa,true);
		$criteria->compare('fk_id_unidad_educativa',$this->fk_id_unidad_educativa);
		$criteria->compare('fk_id_beneficiario',$this->fk_id_beneficiario);
		$criteria->compare('fecha_creacion_beneficiario_unidad_educativa',$this->fecha_creacion_beneficiario_unidad_educativa,true);
		$criteria->compare('estado_beneficiario_unidad_educativa',$this->estado_beneficiario_unidad_educativa);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BeneficiarioUnidadEducativa the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    public function getNameKey() {
		return 'id_beneficiario_unidad_educativa';
    }
    
    public function getNameFKey() {
    	return array(
				'fk_id_beneficiario'=>array('beneficiario','id_beneficiario'),
				'fk_id_unidad_educativa'=>array('unidad_educativa','id_unidad_educativa'),
		);
    }
    
    public function getHasOne(){
		return array(
		);
	}
    
    public function getBelonsTo(){
		return array(
				'Beneficiario',
				'UnidadEducativa',
		);
	}

	public function getHasMany(){
		return array(
		);
	}

	public function getManyMany(){
		return array(
		);
	}
}
