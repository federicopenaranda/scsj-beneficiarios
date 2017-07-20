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
    	
		if(is_numeric($n))
			$v=$n;
		else
    		$v='%'.$n.'%';
		$sql=$campo.' like :v';
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
	public function consulta1_1_de_rep2($id){
        $sql="SELECT
b.primer_nombre_beneficiario AS Primer_Nombre,
b.segundo_nombre_beneficiario AS Segundo_Nombre,
b.apellido_paterno_beneficiario AS Apellido_Paterno,
b.apellido_materno_beneficiario AS Apellido_Materno,
b.sexo_beneficiario AS Sexo,
b.fecha_nacimiento_beneficiario AS Fecha_de_Nacimiento,
round(datediff(sysdate(),b.fecha_nacimiento_beneficiario)/365) as Edad,
r.nombre_religion as Religion,
b.numero_identificacion_beneficiario AS Cert_de_Nacimiento,
b.carnet_de_salud_beneficiario AS Carnet_de_Salud,
b.trabaja_beneficiario AS Trabaja,
b.libreta_escolar_beneficiario AS Libreta_Escolar
FROM
beneficiario AS b
LEFT JOIN religion AS r ON b.fk_id_religion = r.id_religion
WHERE
b.id_beneficiario = ".$id;
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
	public function consulta1_2_de_rep2($id){
        $sql="SELECT
fd.direccion_familia_direccion AS Direccion,
f.codigo_familia as Codigo_de_Familia
FROM
beneficiario AS b
INNER JOIN beneficiario_familia AS bf ON bf.fk_id_beneficiario = b.id_beneficiario
INNER JOIN familia AS f ON bf.fk_id_familia = f.id_familia
INNER JOIN familia_direccion AS fd ON fd.fk_id_familia = f.id_familia
WHERE
bf.estado_beneficiario_familia = 1 AND
b.id_beneficiario = ".$id;
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
	public function consulta1_3_de_rep2($id){
        $sql="SELECT
bp.numero_caso_beneficiario_patrocinador AS Nro_de_Caso
FROM
beneficiario AS b
INNER JOIN beneficiario_patrocinador AS bp ON bp.fk_id_beneficiario = b.id_beneficiario
WHERE
b.id_beneficiario = ".$id;
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
	public function consulta1_4_de_rep2($id){
        $sql="SELECT
bt.descripcion_beneficiario_trabajo AS Lugar_de_Trabajo,
bt.monto_ingreso_beneficiario_trabajo AS Ingreso
FROM
beneficiario AS b
INNER JOIN beneficiario_trabajo AS bt ON bt.fk_id_beneficiario = b.id_beneficiario
WHERE
bt.estado_beneficiario_trabajo = 1 AND
b.id_beneficiario = ".$id;
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
	public function consulta1_5_de_rep2($id){
        $sql="SELECT
e.nombre_escolaridad AS Grado_Escolar,
e.turno_escolaridad AS Turno,
ue.nombre_unidad_educativa AS Unidad_Educativa
FROM
beneficiario AS b
INNER JOIN escolaridad AS e ON b.fk_id_escolaridad = e.id_escolaridad
INNER JOIN beneficiario_unidad_educativa AS bue ON bue.fk_id_beneficiario = b.id_beneficiario
INNER JOIN unidad_educativa AS ue ON bue.fk_id_unidad_educativa = ue.id_unidad_educativa
WHERE
bue.estado_beneficiario_unidad_educativa = 1 AND
b.id_beneficiario = ".$id;
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
	 public function consulta1_6_de_rep2($id){
        $sql="SELECT
bt.numero_beneficiario_telefono as Telefono,bt.emergencia_beneficiario_telefono as Estado_urgencia
FROM
beneficiario AS b
INNER JOIN beneficiario_telefono as bt ON bt.fk_id_beneficiario = b.id_beneficiario
WHERE
b.id_beneficiario =".$id;
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
	 public function consulta1_7_de_rep2($id){
        $sql="SELECT
i.nombre_idioma as Idiomas
FROM
beneficiario AS b
INNER JOIN beneficiario_idioma AS bi ON bi.fk_id_beneficiario = b.id_beneficiario
INNER JOIN idioma AS i ON bi.fk_id_idioma = i.id_idioma
WHERE
b.id_beneficiario = ".$id;
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
	public function consulta1_8_de_rep2($id){
        $sql="SELECT
bti.numero_tipo_identificacion as CI
FROM
beneficiario AS b
INNER JOIN beneficiario_tipo_identificacion AS bti ON bti.fk_id_beneficiario = b.id_beneficiario
WHERE
bti.primario_tipo_identificacion = 1 AND
b.id_beneficiario = ".$id;
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
	public function consulta1_10_de_rep2($id){
        $sql="";
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
	
    /*public function consulta1_de_rep2($id){
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
b.numero_identificacion_beneficiario as Cert_de_Nacimiento,
b.carnet_de_salud_beneficiario as Carnet_de_Salud,
f.codigo_familia as Codigo_de_Familia,
bp.numero_caso_beneficiario_patrocinador as Nro_de_Caso,
b.trabaja_beneficiario as Trabaja,
bt.monto_ingreso_beneficiario_trabajo Ingreso,
bt.descripcion_beneficiario_trabajo Lugar_de_Trabajo,
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
INNER JOIN beneficiario_trabajo AS bt ON bt.fk_id_beneficiario = b.id_beneficiario
INNER JOIN escolaridad AS e ON b.fk_id_escolaridad = e.id_escolaridad
INNER JOIN beneficiario_unidad_educativa AS bue ON bue.fk_id_beneficiario = b.id_beneficiario
INNER JOIN unidad_educativa AS ue ON bue.fk_id_unidad_educativa = ue.id_unidad_educativa
WHERE
b.id_beneficiario = ".$id." AND
bue.estado_beneficiario_unidad_educativa = 1 AND 
bt.estado_beneficiario_trabajo = 1";
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }*/
   
    public function consulta2_de_rep2($id){
        $sql="SELECT
b.primer_nombre_beneficiario as Nombre,
b.apellido_paterno_beneficiario as Apellido,
tp.nombre_tipo_parentesco as Parentesco,
round(datediff(sysdate(),b.fecha_nacimiento_beneficiario)/365) as Edad,
p.responsable_beneficiario as Responsable,
b.sexo_beneficiario as Sexo,
o.nombre_ocupacion as Tipo_ocupacion,
o.descripcion_ocupacion as Ocupacion,
bt.monto_ingreso_beneficiario_trabajo as Ingreso
FROM
beneficiario AS b
INNER JOIN parentesco AS p ON p.fk_id_beneficiario1 = b.id_beneficiario and p.fk_id_beneficiario1 = b.id_beneficiario
INNER JOIN tipo_parentesco AS tp ON p.fk_id_tipo_parentesco = tp.id_tipo_parentesco
INNER JOIN beneficiario_ocupacion AS bo ON bo.fk_id_beneficiario = p.fk_id_beneficiario1
INNER JOIN ocupacion AS o ON bo.fk_id_ocupacion = o.id_ocupacion
INNER JOIN beneficiario_trabajo AS bt ON bt.fk_id_beneficiario = b.id_beneficiario
where p.fk_id_beneficiario=".$id;
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
    public function consulta3_de_rep2($id){
        $sql="SELECT
fc.nombre_tipo_casa AS Tipo_de_Vivienda,
ftc.ambientes_familia_tipo_casa AS Numero_de_Habitaciones,
fco.nombre_tipo_cocina AS Tipo_de_Cocina,
b.observacion_beneficiario AS Observaciones,
b.informacion_relevante_beneficiario AS Informacion_relevante
FROM
beneficiario AS b
INNER JOIN beneficiario_familia AS bf ON bf.fk_id_beneficiario = b.id_beneficiario
INNER JOIN familia AS f ON bf.fk_id_familia = f.id_familia
INNER JOIN familia_tipo_casa AS ftc ON ftc.fk_id_familia = f.id_familia
INNER JOIN tipo_casa AS fc ON ftc.fk_id_tipo_casa = fc.id_tipo_casa
INNER JOIN tipo_cocina AS fco ON ftc.fk_id_tipo_cocina = fco.id_tipo_cocina
WHERE
ftc.estado_familia_tipo_casa = 1 AND
bf.estado_beneficiario_familia = 1 AND
b.id_beneficiario =".$id;
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
    public function subconsulta1_de_rep3($id){
        $sql="SELECT
sb.nombre_servicio_basico AS Servicio
FROM
beneficiario AS b
INNER JOIN beneficiario_familia AS bf ON bf.fk_id_beneficiario = b.id_beneficiario
INNER JOIN familia AS f ON bf.fk_id_familia = f.id_familia
INNER JOIN familia_servicio_basico AS fsb ON fsb.fk_id_familia = f.id_familia
INNER JOIN servicio_basico AS sb ON fsb.fk_id_servicio_basico = sb.id_servicio_basico
WHERE
bf.estado_beneficiario_familia = 1 AND
fsb.estado_familia_servicio_basico = 1 AND
b.id_beneficiario =".$id;
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
	
	public function consulta2_1_de_rep2($id){
        $sql="SELECT
b.id_beneficiario as id,
b.primer_nombre_beneficiario AS Nombre,
b.apellido_paterno_beneficiario AS Apellido,
tp.nombre_tipo_parentesco AS Parentesco,
round(datediff(sysdate(),b.fecha_nacimiento_beneficiario)/365) as Edad,
p.responsable_beneficiario AS Responsable,
b.sexo_beneficiario AS Sexo
FROM
beneficiario AS b
INNER JOIN parentesco AS p ON p.fk_id_beneficiario1 = b.id_beneficiario AND p.fk_id_beneficiario1 = b.id_beneficiario
INNER JOIN beneficiario_familia AS bf ON bf.fk_id_beneficiario = b.id_beneficiario
INNER JOIN tipo_parentesco AS tp ON bf.fk_id_tipo_parentesco = tp.id_tipo_parentesco
WHERE
p.fk_id_beneficiario = ".$id;
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
	public function consulta2_2_de_rep2($id){
        $sql="SELECT
o.nombre_ocupacion AS Tipo_de_Ocupacion,
o.descripcion_ocupacion AS Ocupacion
FROM
beneficiario AS b
INNER JOIN parentesco AS p ON p.fk_id_beneficiario1 = b.id_beneficiario AND p.fk_id_beneficiario1 = b.id_beneficiario
INNER JOIN beneficiario_ocupacion AS bo ON bo.fk_id_beneficiario = b.id_beneficiario
INNER JOIN ocupacion AS o ON bo.fk_id_ocupacion = o.id_ocupacion
WHERE
bo.estado_beneficiario_ocupacion = 1 AND
p.fk_id_beneficiario = ".$id;
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
	public function consulta2_3_de_rep2($id){
        $sql="SELECT
bt.monto_ingreso_beneficiario_trabajo AS Ingreso
FROM
beneficiario AS b
INNER JOIN parentesco AS p ON p.fk_id_beneficiario1 = b.id_beneficiario AND p.fk_id_beneficiario1 = b.id_beneficiario
INNER JOIN beneficiario_trabajo AS bt ON bt.fk_id_beneficiario = b.id_beneficiario

WHERE
bt.estado_beneficiario_trabajo = 1 AND
p.fk_id_beneficiario = ".$id;
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
	

    public function listaAccion($nom,$con){
        $sql="select pu.accion_privilegio_usuario as accion from privilegios_usuario as pu inner join privilegios_tipo_usuario as ptu on pu.id_privilegios_usuario=ptu.fk_id_privilegios_usuario inner join tipo_usuario as tu on ptu.fk_id_tipo_usuario=tu.id_tipo_usuario inner join usuario as u on tu.id_tipo_usuario=u.fk_id_tipo_usuario where u.login_usuario='".$nom."' and pu.opciones_privilegio_usuario='".$con."' order by accion_privilegio_usuario asc";
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
    public function listaAcciones($nom,$con){
        //$objusu=new Usuario();
        //$nombre=Yii::app()->user->name;
        $res=$this->listaAccion($nom,$con);
        $aux=array();
        for($i=0;$i<sizeof($res);$i++) {
            $aux[]=$res[$i]['accion'];
        }
        return $aux;

    }
	/**
	* Esta funcion lista todos los parientes de un beneficiario 
	* Devuelve los id's de los parientes
	*/
	 public function lista_de_parientes($id){
        $sql="select b.id_beneficiario FROM beneficiario AS b inner join parentesco AS p ON
p.fk_id_beneficiario1=b.id_beneficiario
where
p.fk_id_beneficiario = ".$id;
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
	/**
	* Esta funcion valida los nombres de los atributos del objetos en cuestion
	* retorna un valor booleano
	*/
	 public function validaCampo($campo) {
        $ListaActributos=$this->attributeLabels();
        $sw=false;
        foreach ($ListaActributos as $key => $value) {
            if($key==$campo)
                $sw=true;
        }
        return $sw;
    }
	
	/**
    * Esta funcion devuelve el nombre de la columna de la llave primaria de una tabla
    */
    public function nombreLlavePrimaria($tabla){
        //$tabla=$this->tableName();
        $sql="SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='sisscsj' AND TABLE_NAME ='".$tabla."' and COLUMN_KEY ='PRI'";
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
    /**
    * Esta funcion devuelve el nombre de la columna de la llave foranea de una tabla
    */
    public function nombreLlaveForanea($tabla){
        $sql="SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='sisscsj' AND TABLE_NAME ='".$tabla."' and COLUMN_KEY ='MUL'";
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
	
	public function divideRecords($url) {
		$params=array();
		foreach ($url as $value) {
			if (strpos($value,"records")!==FAlSE){
				$str=str_replace('"[', '[',trim(urldecode($value),"recods="));
				$str=str_replace(']"', ']',$str);
				$str=str_replace('\"', '"', $str);
				$params[]=$str;
			} 
		}
		return $params;
	}
	public function insertAudi($accion,$nomTab,$id){
		$this->fk_id_usuario=Yii::app()->user->id;
		$this->accion_sistema=$accion." ".$nomTab." ".$id;
		$this->valor_accion_sistema=date('Y-m-d H:i:s');
		$this->save();
	}
	public function consulta2_1_de_pdf5($id){
        $sql="SELECT
b.id_beneficiario as id,
b.primer_nombre_beneficiario AS Nombre,
b.apellido_paterno_beneficiario AS Apellido,
tp.nombre_tipo_parentesco AS Parentesco,
round(datediff(sysdate(),b.fecha_nacimiento_beneficiario)/365) as Edad,
p.responsable_beneficiario AS Responsable,
b.sexo_beneficiario AS Sexo,
e.nombre_escolaridad AS Grado
FROM
beneficiario AS b
INNER JOIN parentesco AS p ON p.fk_id_beneficiario1 = b.id_beneficiario AND p.fk_id_beneficiario1 = b.id_beneficiario
INNER JOIN beneficiario_familia AS bf ON bf.fk_id_beneficiario = b.id_beneficiario
INNER JOIN tipo_parentesco AS tp ON bf.fk_id_tipo_parentesco = tp.id_tipo_parentesco
INNER JOIN escolaridad AS e ON b.fk_id_escolaridad = e.id_escolaridad
WHERE
p.fk_id_beneficiario = ".$id;
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
