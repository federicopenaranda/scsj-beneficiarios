<?php
/**
* Esta clase es llamado por su controlador repectivo y en aqui se definen todas las acciones del controlador
* Es una clase que hereda sus propiedad y metodos de la clase padre CAtion
*/ 
class Create extends CAction
{
/**
* La funcion run ejecuta la logica de la accion
* Su funcion es la de crear un nuevo registro y adicionarlo en una tabla
* @param array $callback se introduce el nombre de una funcion
*/
   public function run()
   {
		$controller=$this->getController();
		$respuesta=new stdClass();
		$model=new Asistencia();
		$audi=new LogSistema();
		if (isset($_GET['records'])){
			$str=str_replace('"[', '[',$_GET['records']);
			$str=str_replace(']"', ']',$str);
			$str=str_replace('\"', '"', $str);
			$records=CJSON::decode($str);
			#print_r($records);
			#echo $records['fk_id_usuario'];
			$error="";
			if (json_last_error()==JSON_ERROR_NONE){
				
				if (isset($_GET['callback'])&&$_GET['callback']!=='' && !is_numeric($_GET['callback'])){
					$callback=$_GET['callback'];
					
					#$error.= (!isset($records['fk_id_usuario'])) ? "Variable indefinida {fk_id_usuario}" : "";
					#$error.= (!isset($records['fk_id_actividad'])) ? "Variable indefinida {fk_id_actividad}" : "";
					$error.= (!isset($records['fecha_asistencia'])) ? "Variable indefinida {fecha_asistencia}" : "";
					$error.= (!isset($records['observaciones_asistencia'])) ? "Variable indefinida {observaciones_asistencia}" : "";
					if ($error==""){
						
						$model->fk_id_usuario			= Yii::app()->user->getId();
						$model->fk_id_actividad			=$records['fk_id_actividad'];
						$model->fecha_asistencia		=$records['fecha_asistencia'];
						$model->observaciones_asistencia=$records['observaciones_asistencia'];
						//***************************
						$listaRelaciones= array('beneficiario_asistencia'=>'BeneficiarioAsistencia',
												'personal_asistencia'=>'PersonalAsistencia',
												);
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
															$audi=new LogSistema();
															try{

																foreach ($value2 as $key3 => $value3) {

																	if($obj->validaCampo($key3)){
																		
																		if($key3=="fk_id_asistencia")
																			$obj->fk_id_asistencia = $id;
           																else
																			$obj->$key3=$value3;
																	}
       															}
															}catch (Exception $e) {
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
										}//if
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
							}//if
							//*******************************************************
						
					} else {
						$respuesta->meta=array("success"=>"false","msg"=>$error);
						$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>$callback));
					}
				} else {
					$respuesta->meta=array("success"=>"false","msg"=>"Error de callback");
					$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
				}
			} else {
				$respuesta->meta=array("success"=>"false","msg"=>"Error de sintaxis JSON");
				$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
			}
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>"Error variable indefinida quizas quiso decir records");
			$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
		}
	}
}