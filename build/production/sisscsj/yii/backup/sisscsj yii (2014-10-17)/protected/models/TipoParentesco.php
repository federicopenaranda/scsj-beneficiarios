<?php

/**
 * This is the model class for table "tipo_parentesco".
 *
 * The followings are the available columns in table 'tipo_parentesco':
 * @property integer $id_tipo_parentesco
 * @property string $nombre_tipo_parentesco
 * @property string $descripcion_tipo_parentesco
 *
 * The followings are the available model relations:
 * @property BeneficiarioFamilia[] $beneficiarioFamilias
 */
class TipoParentesco extends CTQ
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tipo_parentesco';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre_tipo_parentesco', 'required'),
			array('nombre_tipo_parentesco', 'length', 'max'=>200),
			array('descripcion_tipo_parentesco', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_tipo_parentesco, nombre_tipo_parentesco, descripcion_tipo_parentesco', 'safe', 'on'=>'search'),
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
			'beneficiarioFamilias' => array(self::HAS_MANY, 'BeneficiarioFamilia', 'fk_id_tipo_parentesco'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_tipo_parentesco' => 'Id Tipo Parentesco',
			'nombre_tipo_parentesco' => 'Nombre Tipo Parentesco',
			'descripcion_tipo_parentesco' => 'Descripcion Tipo Parentesco',
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

		$criteria->compare('id_tipo_parentesco',$this->id_tipo_parentesco);
		$criteria->compare('nombre_tipo_parentesco',$this->nombre_tipo_parentesco,true);
		$criteria->compare('descripcion_tipo_parentesco',$this->descripcion_tipo_parentesco,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TipoParentesco the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
