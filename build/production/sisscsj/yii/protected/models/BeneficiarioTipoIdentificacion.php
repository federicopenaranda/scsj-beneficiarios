<?php

/**
 * This is the model class for table "beneficiario_tipo_identificacion".
 *
 * The followings are the available columns in table 'beneficiario_tipo_identificacion':
 * @property string $id_beneficiario_tipo_identificacion
 * @property integer $fk_id_beneficiario
 * @property integer $fk_id_tipo_identificacion
 * @property string $numero_tipo_identificacion
 * @property integer $primario_tipo_identificacion
 *
 * The followings are the available model relations:
 * @property Beneficiario $fkIdBeneficiario
 * @property TipoIdentificacion $fkIdTipoIdentificacion
 */
class BeneficiarioTipoIdentificacion extends CTQ
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'beneficiario_tipo_identificacion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fk_id_beneficiario, fk_id_tipo_identificacion, numero_tipo_identificacion, primario_tipo_identificacion', 'required'),
			array('fk_id_beneficiario, fk_id_tipo_identificacion, primario_tipo_identificacion', 'numerical', 'integerOnly'=>true),
			array('numero_tipo_identificacion', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_beneficiario_tipo_identificacion, fk_id_beneficiario, fk_id_tipo_identificacion, numero_tipo_identificacion, primario_tipo_identificacion', 'safe', 'on'=>'search'),
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
			'fkIdTipoIdentificacion' => array(self::BELONGS_TO, 'TipoIdentificacion', 'fk_id_tipo_identificacion'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_beneficiario_tipo_identificacion' => 'Id Beneficiario Tipo Identificacion',
			'fk_id_beneficiario' => 'Fk Id Beneficiario',
			'fk_id_tipo_identificacion' => 'Fk Id Tipo Identificacion',
			'numero_tipo_identificacion' => 'Numero Tipo Identificacion',
			'primario_tipo_identificacion' => 'Primario Tipo Identificacion',
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

		$criteria->compare('id_beneficiario_tipo_identificacion',$this->id_beneficiario_tipo_identificacion,true);
		$criteria->compare('fk_id_beneficiario',$this->fk_id_beneficiario);
		$criteria->compare('fk_id_tipo_identificacion',$this->fk_id_tipo_identificacion);
		$criteria->compare('numero_tipo_identificacion',$this->numero_tipo_identificacion,true);
		$criteria->compare('primario_tipo_identificacion',$this->primario_tipo_identificacion);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BeneficiarioTipoIdentificacion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    public function getNameKey() {
		return 'id_beneficiario_tipo_identificacion';
    }
    
    public function getNameFKey() {
    	return array(
				'fk_id_beneficiario'=>array('beneficiario','id_beneficiario'),
				'fk_id_tipo_identificacion'=>array('tipo_identificacion','id_tipo_identificacion'),
		);
    }
    
    public function getHasOne(){
		return array(
		);
	}
    
    public function getBelonsTo(){
		return array(
				'Beneficiario',
				'TipoIdentificacion',
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
