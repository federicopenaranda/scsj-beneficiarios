<?php

/**
 * Esta es la clase modelo para la tabla "actividad_favorita".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'actividad_favorita':
 * @property integer $id_actividad_favorita
 * @property string $nombre_actividad_favorita
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property Beneficiario[] $beneficiarios
 */
class CTQ extends CActiveRecord
{
	/**
	* @param integer $limit parametro de cuentos registro se va a retornar
	* @param integer $start parametro de inicio desde que registro se va a empezar
	* @return retorna un conjunto de registros 
	*/
	public function pagina($limit, $start)
    {
        $this->getDbCriteria()->mergeWith(array(
             'limit'=>$limit,
             'offset'=>$start,
        ));
        return $this;
    }

    /**
    * metodo que que sirve para hallar registros que cumplan la condicion like
	* @param string $campo parametro de comparacion
	* @param string $n parametro de nombre de campo
	* @return retorna CActiveRecord 
	*/

    public function filterTexto($campo='',$n='')
    {
    	$sql=$campo.' like :v';
    	$v='%'.$n.'%';
    	$this->getDbCriteria()->mergeWith(array(
    		'condition'=>$sql,
    			'params'=>array(':v'=>$v),
    		));
    	return $this;
    }

    /**
    * Valida la llave foranea de una tabla.
    * @return boolean retorna false si no encuentra ningun registro en la tabla
    */
    public function validaFK($tabla,$campo,$id)
    {
        $sql='select * from '.$tabla.' where('.$campo.'='.$id.')';
    	$rows=Yii::app()->db->createCommand($sql)
		#->select()
		#->from($tabla)
		#->where($campo.'=:id',array(':id'=>$id))
		->queryRow();
		return $rows;
    }
    
    
    /**
    * Ordena los registros de la tabla.
    * @return retorna el objeto
    */
    public function ordenar($campo,$forma){
        $sql=$campo.' '.$forma;
        $this->getDbCriteria()->mergeWith(array(
            'order'=>$sql,
            ));

        return $this;
    }

    public function getTipoDato($nomtabla,$posicion=0)
    {
        mysql_connect('localhost','root','7009593');
        mysql_select_db("sisscsj");
        $sql='select * from '.$nomtabla;
        $result=mysql_query($sql);
        $fields=mysql_num_fields($result);
        $type=mysql_field_type($result,$posicion);
        return $type;
    }

    /**
    * Esta funcion valida si los atributos  del vector son correctos
    * @return boolean retorna verdad si todo es valido caso contrario retorna un mensaje del errror
    */
    public function validaAtrib($listaAtrib)
    {
        foreach ($listaAtrib as $key => $value) {
            $this->$key=$value;
        }
        
        if($this->validate())
            return true;
        else
            return $this->getErrors();
    }

    /**
    * Adiciona un nuevo registro en la tabla
    * @return retorna la llave primaris si se a guardado correctamente caso contraio reduelve un mensaje de error
    */

    public function insertar($listaAtrib)
    {
        foreach ($listaAtrib as $key => $value) {
            $this->$key=$value;
        }
        
        if($this->save())
            return $this->getPrimaryKey();
        else
            return $this->getErrors();
    }
    public function beneficiarioTipo($id){
        $sql='select nombre_beneficiario_tipo from (beneficiario_tipo bt inner join beneficiario_estado_beneficiario be  on bt.id_beneficiario_tipo=be.fk_id_beneficiario_tipo )inner join beneficiario b on b.id_beneficiario=be.fk_id_beneficiario  where b.id_beneficiario='.$id;
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
     public function bTipo($id){
        $sql='select * from beneficiario_tipo where id_beneficiario_tipo='.$id;
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
    public function consulta1($fini,$ffin){
        $sql="select sexo_usuario_biblioteca,count(*) as cantidad from biblioteca  where fecha_consulta_biblioteca between ".$fini." and ".$ffin." group by sexo_usuario_biblioteca";
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
    public function consulta2($fini,$ffin){
        $sql="select e.nombre_escolaridad,e.turno_escolaridad,count(*) as cantidad from biblioteca b inner join escolaridad e on b.fk_id_escolaridad=e.id_escolaridad  where fecha_consulta_biblioteca between ".$fini." and ".$ffin." group by e.nombre_escolaridad,e.turno_escolaridad ";
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
    public function consulta3($fini,$ffin){
        $sql="select tipo_usuario_biblioteca,count(*) as cantidad from biblioteca  where fecha_consulta_biblioteca between ".$fini." and ".$ffin." group by tipo_usuario_biblioteca";
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
    public function consulta4($fini,$ffin){
        $sql="select acb.nombre_area_conocimiento_biblioteca, count(*) as cantidad from biblioteca b inner join area_conocimiento_biblioteca acb on b.fk_id_area_cononcimiento_biblioteca=acb.id_area_conocimiento_biblioteca  where fecha_consulta_biblioteca between ".$fini." and ".$ffin." group by acb.nombre_area_conocimiento_biblioteca";
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
	public function consulta1_de_rep2($id){
        $sql="SELECT
b.primer_nombre_beneficiario as Primer_Nombre,
b.segundo_nombre_beneficiario as Segundo_Nombre,
b.apellido_paterno_beneficiario as Apellido_Paterno,
b.apellido_materno_beneficiario as Apellido_Materno,
b.sexo_beneficiario as Sexo,
b.fecha_nacimiento_beneficiario as Fecha_de_Nacimiento,
bti.numero_tipo_identificacion as CI,
round(datediff(sysdate(),b.fecha_nacimiento_beneficiario)/365) as Edad,
r.nombre_religion as Religion,
fd.direccion_familia_direccion as Direccion,
b.numero_identificacion_beneficiario as Cet_de_Nacimiento,
b.carnet_de_salud_beneficiario as Carnet_de_Salud,
f.codigo_familia as Codigo_de_Familia,
bp.numero_caso_beneficiario_patrocinador as Nro_de_Caso,
b.trabaja_beneficiario as Trabaja,
e.nombre_escolaridad as Grado_Escolaridad,
e.turno_escolaridad as Turno,
ue.nombre_unidad_educativa as Unidad_Educativa,
b.libreta_escolar_beneficiario as Libreta_Escolar

FROM
beneficiario AS b
INNER JOIN beneficiario_tipo_identificacion AS bti ON bti.fk_id_beneficiario = b.id_beneficiario
INNER JOIN religion AS r ON b.fk_id_religion = r.id_religion
INNER JOIN beneficiario_familia AS bf ON bf.fk_id_beneficiario = b.id_beneficiario
INNER JOIN familia AS f ON bf.fk_id_familia = f.id_familia
INNER JOIN familia_direccion AS fd ON fd.fk_id_familia = f.id_familia
INNER JOIN beneficiario_patrocinador AS bp ON bp.fk_id_beneficiario = b.id_beneficiario
INNER JOIN escolaridad AS e ON b.fk_id_escolaridad = e.id_escolaridad
INNER JOIN beneficiario_unidad_educativa AS bue ON bue.fk_id_beneficiario = b.id_beneficiario
INNER JOIN unidad_educativa AS ue ON bue.fk_id_unidad_educativa = ue.id_unidad_educativa
WHERE
b.id_beneficiario =".$id." AND
bue.estado_beneficiario_unidad_educativa = 1";
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }

    /*public function ordenar(){
        $rows=Yii::app()->db->createCommand()
        ->select()
        ->from('actividad_favorita')
        ->order('id_actividad_favorita ASC')
        ->queryRow();
        return $rows;
    }*/
}
