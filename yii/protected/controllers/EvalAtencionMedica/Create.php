<?php
/**
* Esta clase es llamado por su controlador repectivo y en aqui se definen todas las acciones del controlador
* Es una clase que hereda sus propiedad y metodos de la clase padre CAtion
*/ 
class Create extends CAction{
/**
* La funcion run ejecuta la logica de la accion
* Su funcion es la de crear un nuevo registro y adicionarlo en una tabla
* @param array $callback se introduce el nombre de una funcion
*/
   public function run(){
		$controller=$this->getController();
		$model=new EvalAtencionMedica();
		$respuesta=new stdClass();
		$audi=new LogSistema();
		$error="";
		if (isset($_GET['records'])){
			$str=str_replace('"[', '[',$_GET['records']);
			$str=str_replace(']"', ']',$str);
			$str=str_replace('\"', '"', $str);
			$records=CJSON::decode($str);
			if (json_last_error()==JSON_ERROR_NONE) {
				
				if (isset($_GET['callback'])&&$_GET['callback']!=='' && !is_numeric($_GET['callback'])){
					$callback=$_GET['callback'];
					$error.= (!isset($records['fk_id_tipo_consulta'])) ? "{ Error en la variable fk_id_tipo_consulta } " : "";
					$error.= (!isset($records['fk_id_diagnostico'])) ? "{ Error de fk_id_diagnostico } " : "";
					$error.= (!isset($records['fk_id_beneficiario'])) ? "{ Error de fk_id_beneficiario } " : "";
					$error.= (!isset($records['fecha_atencion_medica'])) ? "{ Error de fecha_atencion_medica } " : "";
					$error.= (!isset($records['observaciones_atencion_medica'])) ? "{ Error de observaciones_atencion_medica } " : "";
					if ($error == "") {
						
						if ($model->validaFK('beneficiario','id_beneficiario',$records['fk_id_beneficiario'])!==false && 
							$model->validaFK('diagnostico','id_diagnostico',$records['fk_id_diagnostico'])!==false && 
							$model->validaFK('tipo_consulta','id_tipo_consulta',$records['fk_id_tipo_consulta'])!==false
							) {
							$model->fk_id_tipo_consulta					=$records['fk_id_tipo_consulta'];
							$model->fk_id_usuario						=Yii::app()->user->getId();
							$model->fk_id_diagnostico					=$records['fk_id_diagnostico'];
							$model->fk_id_beneficiario					=$records['fk_id_beneficiario'];
							$model->fecha_atencion_medica 				=$records['fecha_atencion_medica'];
							$model->observaciones_atencion_medica		=$records['observaciones_atencion_medica'];
							#$model->fecha_creacion_eval_atencion_medica	=$records['fecha_creacion_eval_atencion_medica'];
							
							$listaRelaciones=array('atencion_medica_enfermedad_comun'=>'AtencionMedicaEnfermedadComun');
							//*********************************************
							$contNotNull=0;
							foreach ($records as $k => $v) {
								if (is_array($v))
									$contNotNull=$contNotNull+sizeof($v);
							}
							$error = array();
							$cont=0;
							$transaction=$model->dbConnection->beginTransaction();
							
							if ($model->validate()) {
								$model->save();
								$audi->insertAudi("create",$model->tableName(),$model->getPrimaryKey());
								$id=$model->getPrimaryKey();
								try {
									foreach ($records as $key => $value) {
									
										if (is_array($value) && sizeof($value)!=0){
										
											foreach ($value as $value2) {

												foreach ($listaRelaciones as $nomtab => $nommod) {
											
													switch ($key) {
														case $nomtab:
															$obj=new $nommod();
															$audi->insertAudi("create",$obj->tableName(),$obj->getPrimaryKey());
															$obj->fk_id_atencion_medica=$id;
															try{
																foreach ($value2 as $key3 => $value3) {
           															if($value3===true){
           																$value3=1;
           																#$obj->$key3=1;
           															}
           															if($value3===false){
           																$value3=0;
           																#$obj->$key3=0;
           															}
           															$obj->$key3=$value3;
       															}
															} catch (Exception $a) {
																$error="Error, nombre de atributos invalidos";
       															$cont=-1;	
       														}
													
       														try {
																if ($obj->validate()){ 
            														$obj->save();
																	$audi->insertAudi("create",$obj->tableName(),$obj->getPrimaryKey());
																	$cont++; 
																} else {
            														throw new Exception("Error");
																}
            														
															} catch (Exception $e) {
																if($e->getMessage()=="Error")
																	$error=$obj->getErrors();
																else
																	$error=$e->getMessage();
															
															}
															break;
													}
												}	
											}//foreach
										} 
									}//foreach
									if ($cont==$contNotNull){
										$transaction->commit();
										$respuesta->meta=array("success"=>"true", "msg"=>"Se creo exitosamente !!!");
										$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));
									} else {
										$transaction->rollback();
										$respuesta->meta=array("success"=>"false","msg"=>$error);
										$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));
									}
								} catch (Exception $e) {
									$transaction->rollback();
									throw $e;
								}
							} else {
								$respuesta->meta=array("success"=>"false","msg"=>$model->getErrors());
								$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>$callback));
							}
							//*********************************************
						} else {
							$respuesta->meta=array("success"=>"false","msg"=>"Error llave foranea");
							$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>$callback));
						}
					} else {
						$respuesta->meta=array("success"=>"false","msg"=>$error);
						$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>$callback));
					}
				} else {
					$respuesta->meta=array("success"=>"false","msg"=>"Error de callback");
					$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
				}
			} else {
				$respuesta->meta=array("success"=>"false","msg"=>"Error de JSON");
				$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
			}
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>"Error variable indefinida quizas quiso decir records");
			$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
		}
	}
}