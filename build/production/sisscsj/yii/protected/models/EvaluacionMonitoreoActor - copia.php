<?php

/**
 * This is the model class for table "evaluacion_monitoreo_actor".
 *
 * The followings are the available columns in table 'evaluacion_monitoreo_actor':
 * @property integer $id_evaluacion_monitoreo_actor
 * @property integer $fk_id_beneficiario
 * @property integer $fk_id_monitoreo_actor
 * @property integer $fk_id_criterio_monitoreo_actor
 * @property integer $evaluacion_monitoreo_actor
 *
 * The followings are the available model relations:
 * @property MonitoreoActor $fkIdMonitoreoActor
 * @property CriterioMonitoreoActor $fkIdCriterioMonitoreoActor
 * @property Beneficiario $fkIdBeneficiario
 */
class EvaluacionMonitoreoActor extends CTQ
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'evaluacion_monitoreo_actor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fk_id_beneficiario, fk_id_monitoreo_actor, fk_id_criterio_monitoreo_actor, evaluacion_monitoreo_actor', 'required'),
			array('fk_id_beneficiario, fk_id_monitoreo_actor, fk_id_criterio_monitoreo_actor, evaluacion_monitoreo_actor', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_evaluacion_monitoreo_actor, fk_id_beneficiario, fk_id_monitoreo_actor, fk_id_criterio_monitoreo_actor, evaluacion_monitoreo_actor', 'safe', 'on'=>'search'),
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
			'fkIdMonitoreoActor' => array(self::BELONGS_TO, 'MonitoreoActor', 'fk_id_monitoreo_actor'),
			'fkIdCriterioMonitoreoActor' => array(self::BELONGS_TO, 'CriterioMonitoreoActor', 'fk_id_criterio_monitoreo_actor'),
			'fkIdBeneficiario' => array(self::BELONGS_TO, 'Beneficiario', 'fk_id_beneficiario'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_evaluacion_monitoreo_actor' => 'Id Evaluacion Monitoreo Actor',
			'fk_id_beneficiario' => 'Fk Id Beneficiario',
			'fk_id_monitoreo_actor' => 'Fk Id Monitoreo Actor',
			'fk_id_criterio_monitoreo_actor' => 'Fk Id Criterio Monitoreo Actor',
			'evaluacion_monitoreo_actor' => 'Evaluacion Monitoreo Actor',
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

		$criteria->compare('id_evaluacion_monitoreo_actor',$this->id_evaluacion_monitoreo_actor);
		$criteria->compare('fk_id_beneficiario',$this->fk_id_beneficiario);
		$criteria->compare('fk_id_monitoreo_actor',$this->fk_id_monitoreo_actor);
		$criteria->compare('fk_id_criterio_monitoreo_actor',$this->fk_id_criterio_monitoreo_actor);
		$criteria->compare('evaluacion_monitoreo_actor',$this->evaluacion_monitoreo_actor);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EvaluacionMonitoreoActor the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	#==========================================
	
	public function fkCriterio($id){
        $sql="SELECT
criterio_monitoreo_actor.id_criterio_monitoreo_actor AS fk_id_criterio_monitoreo_actor,
criterio_monitoreo_actor.nombre_criterio_monitoreo_actor,
competencia_monitoreo_actor.nombre_competencia_monitoreo_actor
FROM
tipo_monitoreo_actor
INNER JOIN competencia_monitoreo_actor ON competencia_monitoreo_actor.fk_id_tipo_monitoreo_actor = tipo_monitoreo_actor.id_tipo_monitoreo_actor
INNER JOIN criterio_monitoreo_actor ON criterio_monitoreo_actor.fk_id_competencia_monitoreo_actor = competencia_monitoreo_actor.id_competencia_monitoreo_actor
WHERE
criterio_monitoreo_actor.estado_criterio_monitoreo_actor =1 AND
competencia_monitoreo_actor.estado_competencia_monitoreo_actor = 1 AND
tipo_monitoreo_actor.id_tipo_monitoreo_actor = ".$id." ORDER BY nombre_criterio_monitoreo_actor";
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
	
	public function fcriterio($id){
		
		$columns[] = ["text"=>"Participante","dataIndex"=>"fk_id_beneficiario","flex"=>1,"renderer"=>"{{function( value, metaData, record, rowIndex, colIndex, store, view ) { return record.get('primer_nombre_beneficiario' ) + ' ' + record.get('apellido_paterno_beneficiario')} }}"];
        $sql="SELECT
competencia_monitoreo_actor.id_competencia_monitoreo_actor,
competencia_monitoreo_actor.nombre_competencia_monitoreo_actor
FROM
competencia_monitoreo_actor
WHERE
competencia_monitoreo_actor.estado_competencia_monitoreo_actor = 1 AND
competencia_monitoreo_actor.fk_id_tipo_monitoreo_actor = ".$id;
		$competencias=Yii::app()->db->createCommand($sql)
			 ->queryAll();
		foreach($competencias as $ckey => $competencia): //competencia array([id_competencia_monitoreo_actor] => 1 [nombre_competencia_monitoreo_actor] => YO SOY)
			$sub['text'] = $competencia['nombre_competencia_monitoreo_actor'];
			#$columns[]['columns'] = $sub;
			$competencias[$ckey]=$competencia;
			$criterio_ids = Yii::app()->db->createCommand('SELECT
criterio_monitoreo_actor.id_criterio_monitoreo_actor,
criterio_monitoreo_actor.nombre_criterio_monitoreo_actor
FROM
criterio_monitoreo_actor
WHERE
criterio_monitoreo_actor.estado_criterio_monitoreo_actor = 1 AND
criterio_monitoreo_actor.fk_id_competencia_monitoreo_actor = 
'.$competencia['id_competencia_monitoreo_actor'])->queryAll();
			foreach($criterio_ids as $tkey =>$criterio_id)
            {
				$aux=array();
				$aux['text'] = $criterio_id['nombre_criterio_monitoreo_actor'];
				$aux['dataIndex'] = 'fk_id_criterio_monitoreo_actor'.$criterio_id['id_criterio_monitoreo_actor'];
				
				$aux['editor'] = "{{{xtype:'combo',name:'fk_id_criterio_monitoreo_actor".$criterio_id['id_criterio_monitoreo_actor']."',displayField:'nombre',valueField:'valor',store: new Ext.data.SimpleStore({fields:['nombre','valor'],data:[['Si',1],['No',0]]}),editable:false,forceSelection:true,allowBlack:false}}}";
				
				
				
				#$aux['editor']=array('xtype'=>'combo','name'=>'fk_id_criterio_monitoreo_actor'.$criterio_id['id_criterio_monitoreo_actor'],'displayField'=>'nombre','valueField'=>'valor','store'=>"new Ext.data.SimpleStore({fields:['nombre','valor'],data:[['si',1],['no',0]]})",'editable'=>"false",'editable'=>"true",'forceSelection'=>"true",'allowBlank'=>"false"/*,'render'=>"function(valor){ return (valor==1)?'Activo':'Inactivo'}"*/);
				$aux['renderer']="{{function(valor){ return (valor==1)?'Si':'No'}}}";
                
				$competencias[$ckey]['criterio_monitoreo_actor'][] = $aux;
				$sub['columns'][]=$aux;
            }
			$columns[] = $sub;
			
			$sub=array();
		endforeach;
		return $columns;
		#return $competencias;
    }
	
	
	
	/*public function fcriterio2($id) {
		
        $sql="SELECT
competencia_monitoreo_actor.id_competencia_monitoreo_actor,
competencia_monitoreo_actor.nombre_competencia_monitoreo_actor
FROM
competencia_monitoreo_actor
WHERE
competencia_monitoreo_actor.estado_competencia_monitoreo_actor = 1 AND
competencia_monitoreo_actor.fk_id_tipo_monitoreo_actor = ".$id;
		$competencias=Yii::app()->db->createCommand($sql)
			 ->queryAll();
		foreach($competencias as $ckey => $competencia): //competencia array([id_competencia_monitoreo_actor] => 1 [nombre_competencia_monitoreo_actor] => YO SOY)
			$competencias[$ckey] = $competencia;
			$criterio_ids = Yii::app()->db->createCommand('SELECT
criterio_monitoreo_actor.id_criterio_monitoreo_actor,
criterio_monitoreo_actor.nombre_criterio_monitoreo_actor
FROM
criterio_monitoreo_actor
WHERE
criterio_monitoreo_actor.estado_criterio_monitoreo_actor = 1 AND
criterio_monitoreo_actor.fk_id_competencia_monitoreo_actor = 
'.$competencia['id_competencia_monitoreo_actor'])->queryAll();
			foreach($criterio_ids as $tkey =>$criterio_id)
            {
				$aux=array();
				$aux['fk_id_criterio_monitoreo_actor'] =$criterio_id['id_criterio_monitoreo_actor']; 
                $competencias[$ckey]['criterio_monitoreo_actor'][] = $aux;
				#$competencias[$ckey]=$competencia;

				$evaluacion_ids = Yii::app()->db->createCommand('SELECT
evaluacion_monitoreo_actor.id_evaluacion_monitoreo_actor,
evaluacion_monitoreo_actor.fk_id_beneficiario,
evaluacion_monitoreo_actor.evaluacion_monitoreo_actor,
beneficiario.primer_nombre_beneficiario
FROM
evaluacion_monitoreo_actor
INNER JOIN beneficiario ON evaluacion_monitoreo_actor.fk_id_beneficiario = beneficiario.id_beneficiario
WHERE
evaluacion_monitoreo_actor.id_evaluacion_monitoreo_actor = 
'.$criterio_id['id_criterio_monitoreo_actor'])->queryAll();
				foreach($evaluacion_ids as $ekey => $evaluacion_id):
					$aux2=array();
					$aux2['evaluacion_monitoreo_actor'] = $evaluacion_id['evaluacion_monitoreo_actor'];
					$aux2['primer_nombre_beneficiario'] = $evaluacion_id['primer_nombre_beneficiario'];
					$competencias[$ekey]['evaluacion_monitoreo_actor'][] = $aux2;
				endforeach;

            }
		endforeach;
		#return $columns;
		return $competencias;
    }*/
	public function fcriterio2($id) {
		
        $sql="SELECT
competencia_monitoreo_actor.id_competencia_monitoreo_actor,
competencia_monitoreo_actor.nombre_competencia_monitoreo_actor
FROM
competencia_monitoreo_actor
WHERE
competencia_monitoreo_actor.estado_competencia_monitoreo_actor = 1 AND
competencia_monitoreo_actor.fk_id_tipo_monitoreo_actor = ".$id;
		$competencias=Yii::app()->db->createCommand($sql)
			 ->queryAll();
		foreach($competencias as $ckey => $competencia): //competencia array([id_competencia_monitoreo_actor] => 1 [nombre_competencia_monitoreo_actor] => YO SOY)
			$competencias[$ckey] = $competencia;
			$criterio_ids = Yii::app()->db->createCommand('SELECT
criterio_monitoreo_actor.id_criterio_monitoreo_actor,
criterio_monitoreo_actor.nombre_criterio_monitoreo_actor
FROM
criterio_monitoreo_actor
WHERE
criterio_monitoreo_actor.estado_criterio_monitoreo_actor = 1 AND
criterio_monitoreo_actor.fk_id_competencia_monitoreo_actor = 
'.$competencia['id_competencia_monitoreo_actor'])->queryAll();
			foreach($criterio_ids as $tkey =>$criterio_id)
            {
				$aux=array();
				$aux['fk_id_criterio_monitoreo_actor'] =$criterio_id['id_criterio_monitoreo_actor']; 
                $competencias[$ckey]['criterio_monitoreo_actor'][] = $aux;
				#$competencias[$ckey]=$competencia;

				$evaluacion_ids = Yii::app()->db->createCommand('SELECT
evaluacion_monitoreo_actor.id_evaluacion_monitoreo_actor,
evaluacion_monitoreo_actor.fk_id_beneficiario,
evaluacion_monitoreo_actor.evaluacion_monitoreo_actor,
beneficiario.id_beneficiario,
beneficiario.primer_nombre_beneficiario,
beneficiario.apellido_paterno_beneficiario
FROM
evaluacion_monitoreo_actor
INNER JOIN beneficiario ON evaluacion_monitoreo_actor.fk_id_beneficiario = beneficiario.id_beneficiario
INNER JOIN beneficiario_estado_beneficiario ON beneficiario_estado_beneficiario.fk_id_beneficiario = beneficiario.id_beneficiario
INNER JOIN edades_beneficiario ON beneficiario_estado_beneficiario.fk_id_edades_beneficiario = edades_beneficiario.id_edades_beneficiario
WHERE
edades_beneficiario.nombre_edades_beneficiario = "Niño" AND
evaluacion_monitoreo_actor.id_evaluacion_monitoreo_actor = 
'.$criterio_id['id_criterio_monitoreo_actor'])->queryAll();
				foreach($evaluacion_ids as $ekey => $evaluacion_id):
					$aux2=array();
					$aux2['id_evaluacion_monitoreo_actor'] = $evaluacion_id['id_evaluacion_monitoreo_actor'];
					$aux2['evaluacion_monitoreo_actor'] = $evaluacion_id['evaluacion_monitoreo_actor'];
					$aux2['id_beneficiario'] = $evaluacion_id['id_beneficiario'];
					$aux2['primer_nombre_beneficiario'] = $evaluacion_id['primer_nombre_beneficiario'];	
					$aux2['apellido_paterno_beneficiario'] = $evaluacion_id['apellido_paterno_beneficiario'];	
					$competencias[$ekey]['evaluacion_monitoreo_actor'][] = $aux2;
				endforeach;
            }
		endforeach;
		#return $columns;
		return $competencias;
    }
	
	public function benefic() {
		 $sql="SELECT
beneficiario.id_beneficiario,
beneficiario.primer_nombre_beneficiario,
beneficiario.apellido_paterno_beneficiario
FROM
beneficiario
INNER JOIN beneficiario_estado_beneficiario ON beneficiario_estado_beneficiario.fk_id_beneficiario = beneficiario.id_beneficiario
INNER JOIN edades_beneficiario ON beneficiario_estado_beneficiario.fk_id_edades_beneficiario = edades_beneficiario.id_edades_beneficiario
WHERE
edades_beneficiario.nombre_edades_beneficiario LIKE 'Niño'
";
		$beneficiarios=Yii::app()->db->createCommand($sql)
			 ->queryAll();
		return $beneficiarios;
	}
	
}
