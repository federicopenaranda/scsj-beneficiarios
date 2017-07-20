<?php

/**
 * This is the model class for table "monitoreo_punto_comunitario".
 *
 * The followings are the available columns in table 'monitoreo_punto_comunitario':
 * @property integer $id_monitoreo_punto_comunitario
 * @property integer $fk_id_usuario
 * @property integer $fk_id_usuario_responsable
 * @property integer $fk_id_lugar_actividad
 * @property string $fecha_monitoreo_punto_comunitario
 * @property string $analisis_monitoreo_punto_comunitario
 *
 * The followings are the available model relations:
 * @property LugarActividad $fkIdLugarActividad
 * @property Usuario $fkIdUsuarioResponsable
 * @property Usuario $fkIdUsuario
 * @property ResultadoMonitoreoPc[] $resultadoMonitoreoPcs
 */
class MonitoreoPuntoComunitario extends CTQ
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'monitoreo_punto_comunitario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fk_id_usuario, fk_id_usuario_responsable, fk_id_lugar_actividad, fecha_monitoreo_punto_comunitario', 'required'),
			array('fk_id_usuario, fk_id_usuario_responsable, fk_id_lugar_actividad', 'numerical', 'integerOnly'=>true),
			array('analisis_monitoreo_punto_comunitario', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_monitoreo_punto_comunitario, fk_id_usuario, fk_id_usuario_responsable, fk_id_lugar_actividad, fecha_monitoreo_punto_comunitario, analisis_monitoreo_punto_comunitario', 'safe', 'on'=>'search'),
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
			'fkIdLugarActividad' => array(self::BELONGS_TO, 'LugarActividad', 'fk_id_lugar_actividad'),
			'fkIdUsuarioResponsable' => array(self::BELONGS_TO, 'Usuario', 'fk_id_usuario_responsable'),
			'fkIdUsuario' => array(self::BELONGS_TO, 'Usuario', 'fk_id_usuario'),
			'resultadoMonitoreoPcs' => array(self::HAS_MANY, 'ResultadoMonitoreoPc', 'fk_id_monitoreo_punto_comunitario'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_monitoreo_punto_comunitario' => 'Id Monitoreo Punto Comunitario',
			'fk_id_usuario' => 'Fk Id Usuario',
			'fk_id_usuario_responsable' => 'Fk Id Usuario Responsable',
			'fk_id_lugar_actividad' => 'Fk Id Lugar Actividad',
			'fecha_monitoreo_punto_comunitario' => 'Fecha Monitoreo Punto Comunitario',
			'analisis_monitoreo_punto_comunitario' => 'Analisis Monitoreo Punto Comunitario',
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

		$criteria->compare('id_monitoreo_punto_comunitario',$this->id_monitoreo_punto_comunitario);
		$criteria->compare('fk_id_usuario',$this->fk_id_usuario);
		$criteria->compare('fk_id_usuario_responsable',$this->fk_id_usuario_responsable);
		$criteria->compare('fk_id_lugar_actividad',$this->fk_id_lugar_actividad);
		$criteria->compare('fecha_monitoreo_punto_comunitario',$this->fecha_monitoreo_punto_comunitario,true);
		$criteria->compare('analisis_monitoreo_punto_comunitario',$this->analisis_monitoreo_punto_comunitario,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MonitoreoPuntoComunitario the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	//REPORTES
	public function consulta11_de_rep6($id_monitoreo_punto_comunitario){
        $sql="SELECT
la.nombre_lugar_actividad AS punto_comunitario,
mpc.fecha_monitoreo_punto_comunitario AS fecha,
CONCAT(u.nombre_usuario,' ',u.apellido_usuario) AS usuario,
cmp.nombre_caracteristica_monitoreo_pc AS caracteristica,
amp.nombre_ambito_monitoreo_pc AS ambito,
amp.indicador_ambito_monitoreo_pc AS indicadores,
rmp.resultado_monitoreo_pc AS resultado,
mpc.fk_id_usuario_responsable AS usuario_responsable
FROM
monitoreo_punto_comunitario AS mpc
LEFT JOIN resultado_monitoreo_pc AS rmp ON rmp.fk_id_monitoreo_punto_comunitario = mpc.id_monitoreo_punto_comunitario
LEFT JOIN ambito_monitoreo_pc AS amp ON rmp.fk_id_ambito_monitoreo_pc = amp.id_ambito_monitoreo_pc
LEFT JOIN caracteristica_monitoreo_pc AS cmp ON amp.fk_id_caracteristica_monitoreo_pc = cmp.id_caracteristica_monitoreo_pc
LEFT JOIN lugar_actividad AS la ON mpc.fk_id_lugar_actividad = la.id_lugar_actividad
LEFT JOIN usuario AS u ON mpc.fk_id_usuario = u.id_usuario
where mpc.id_monitoreo_punto_comunitario = ".$id_monitoreo_punto_comunitario;
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
	public function consulta12_de_rep6($fk_id_usuario){
        $sql = "SELECT
CONCAT(u.nombre_usuario,' ',u.apellido_usuario) AS responsable
FROM
usuario AS u WHERE u.id_usuario=".$fk_id_usuario;
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
}
