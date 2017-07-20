<?php

/**
 * This is the model class for table "resultado_monitoreo_pc".
 *
 * The followings are the available columns in table 'resultado_monitoreo_pc':
 * @property integer $id_resultado_monitoreo_pc
 * @property integer $fk_id_monitoreo_punto_comunitario
 * @property integer $fk_id_ambito_monitoreo_pc
 * @property string $resultado_monitoreo_pc
 *
 * The followings are the available model relations:
 * @property MonitoreoPuntoComunitario $fkIdMonitoreoPuntoComunitario
 * @property AmbitoMonitoreoPc $fkIdAmbitoMonitoreoPc
 */
class ResultadoMonitoreoPc extends CTQ
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'resultado_monitoreo_pc';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fk_id_monitoreo_punto_comunitario, fk_id_ambito_monitoreo_pc, resultado_monitoreo_pc', 'required'),
			array('fk_id_monitoreo_punto_comunitario, fk_id_ambito_monitoreo_pc', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_resultado_monitoreo_pc, fk_id_monitoreo_punto_comunitario, fk_id_ambito_monitoreo_pc, resultado_monitoreo_pc', 'safe', 'on'=>'search'),
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
			'fkIdMonitoreoPuntoComunitario' => array(self::BELONGS_TO, 'MonitoreoPuntoComunitario', 'fk_id_monitoreo_punto_comunitario'),
			'fkIdAmbitoMonitoreoPc' => array(self::BELONGS_TO, 'AmbitoMonitoreoPc', 'fk_id_ambito_monitoreo_pc'), 
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_resultado_monitoreo_pc' => 'Id Resultado Monitoreo Pc',
			'fk_id_monitoreo_punto_comunitario' => 'Fk Id Monitoreo Punto Comunitario',
			'fk_id_ambito_monitoreo_pc' => 'Fk Id Ambito Monitoreo Pc',
			'resultado_monitoreo_pc' => 'Resultado Monitoreo Pc',
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

		$criteria->compare('id_resultado_monitoreo_pc',$this->id_resultado_monitoreo_pc);
		$criteria->compare('fk_id_monitoreo_punto_comunitario',$this->fk_id_monitoreo_punto_comunitario);
		$criteria->compare('fk_id_ambito_monitoreo_pc',$this->fk_id_ambito_monitoreo_pc);
		$criteria->compare('resultado_monitoreo_pc',$this->resultado_monitoreo_pc,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ResultadoMonitoreoPc the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function ambitopc($offset,$limit,$condition,$property,$direction){
        $sql="SELECT DISTINCT
resultado_monitoreo_pc.id_resultado_monitoreo_pc,
resultado_monitoreo_pc.fk_id_monitoreo_punto_comunitario,
resultado_monitoreo_pc.fk_id_ambito_monitoreo_pc,
resultado_monitoreo_pc.resultado_monitoreo_pc,
ambito_monitoreo_pc.nombre_ambito_monitoreo_pc,
ambito_monitoreo_pc.indicador_ambito_monitoreo_pc,
caracteristica_monitoreo_pc.nombre_caracteristica_monitoreo_pc
FROM
resultado_monitoreo_pc
INNER JOIN ambito_monitoreo_pc ON resultado_monitoreo_pc.fk_id_ambito_monitoreo_pc = ambito_monitoreo_pc.id_ambito_monitoreo_pc
INNER JOIN caracteristica_monitoreo_pc ON ambito_monitoreo_pc.fk_id_caracteristica_monitoreo_pc = caracteristica_monitoreo_pc.id_caracteristica_monitoreo_pc
WHERE ".$condition." ORDER BY ".$property." ".$direction." limit ".$offset.",".$limit;
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
}
