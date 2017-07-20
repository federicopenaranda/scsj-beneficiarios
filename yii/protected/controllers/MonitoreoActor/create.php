<?php
/**
 * Estas son la accion para el controlador "MonitoreoActor".
 */

class create extends CAction
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
		$model=new MonitoreoActor();
        $error="";
		$error.= (!isset($_GET['records'])) ? "{ Error en la variable records } " : "";
		$error.= (!isset($_GET['callback'])) ? "{ Error de Callback } " : "";
        
        if ($error == "") {
			$callback=$_GET['callback'];
			$query = explode('&', $_SERVER['QUERY_STRING']);
			$listaRecords = $model->divideRecords($query);
			$numeroRecords = sizeof($listaRecords);
            $listaRelaciones=array(
								'evaluacion_monitoreo_actor'=>'EvaluacionMonitoreoActor',
								);
            $ListaTotalEleVec=$model->listCountArrayOfEachRecord($listaRecords);

			$NumVal=0;
			$i=0;
			$transaction=$model->dbConnection->beginTransaction();
            try {
				foreach ($listaRecords as $listaRecord) {
                	$sw=0;
                    $contValRecords=0;
					$record=CJSON::decode(urldecode($listaRecord));
                    $model=new MonitoreoActor();
                    $audi=new LogSistema();
                    
                    if (json_last_error() === JSON_ERROR_NONE) {
                    	try{
        					#$error.= (!isset($record['fk_id_usuario'])) ? "Variable indefinida {fk_id_usuario}" : "";
        					$error.= (!isset($record['fk_id_tipo_monitoreo_actor'])) ? "Variable indefinida {fk_id_tipo_monitoreo_actor}" : "";
        					$error.= (!isset($record['fecha_monitoreo_actor'])) ? "Variable indefinida {fecha_monitoreo_actor}" : "";
        					$error.= (!isset($record['analisis_monitoreo_actor'])) ? "Variable indefinida {analisis_monitoreo_actor}" : "";
							if ($error == "") {
        						$model->fk_id_usuario				=Yii::app()->user->getId();
        						$model->fk_id_tipo_monitoreo_actor	=$record['fk_id_tipo_monitoreo_actor'];
        						$model->fecha_monitoreo_actor		=$record['fecha_monitoreo_actor'];
        						$model->analisis_monitoreo_actor	=$record['analisis_monitoreo_actor'];
	                            if ($model->validate()) {
	                                $model->save();
                                    $audi->insertAudi("create",$model->tableName(),$model->getPrimaryKey());
	                                $id_tabla_principal=$model->getPrimaryKey();
	                                
	                                foreach ($record as $NomTabRel => $valor) {//key=nombre_tabla_atrib , $value=[{},{}] 0 ""
									
	                                	$estado =0;	
	                                    if (is_array($valor) && sizeof($valor)!=0) {
	                                    	
	                                    	if (isset($listaRelaciones[$NomTabRel])) {

		                                        foreach ($valor as $subvalue) { //"evaluacion_monitoreo_actor:[{"fk_id_criterio_monitor_actor":3},{}]"
		                                        	
		                                        	$obj = new $listaRelaciones[$NomTabRel]();
													foreach ($subvalue as $key3 => $value3) {
														if ($obj->validaCampo($key3)) {		
															$listcamp[$key3] = $value3;
														}
													}

													$listcamp['fk_id_monitoreo_actor'] = $id_tabla_principal;
													$audi= new LogSistema();
													foreach ($subvalue as $key3 => $value3){
	
														if (strpos($key3,"fk_id_criterio_monitoreo_actor") !== FALSE) {
															
															$obj = new $listaRelaciones[$NomTabRel]();
															foreach($listcamp as $xk => $xv):
																$obj->$xk=$xv;
															endforeach;
															$val=intval(substr($key3,-1));
															$key3 = substr($key3,0,strlen($key3)-1);
															$obj->fk_id_criterio_monitoreo_actor = $val;
															$obj->evaluacion_monitoreo_actor = $value3;
															if ($obj->validate()) {
					       										$obj->save();
                                                        		$audi->insertAudi("create",$obj->tableName(),$obj->getPrimaryKey());
																#$sw++;
															} else {
																$error=$obj->getErrors();
															}
														}
													}//foreach
		                                        	if($error=="")
														$sw++;
												}
		                                    } else {
		                                    	$error="variable  indefinida ".$NomTabRel;
		                                    }
										}
										
										 
									}//foreach
	                                            
	                                $contValRecords++;
	                            } else {
	                                $error=array_merge(array("Variable idefinida o "),$model->getErrors());
	                            }
	                        } 
                        } catch(Exception $e) {
							$error=$e->getMessage();
						}
                    } else {
                        $error="Error de json";
                    }
                    if ($sw+$contValRecords == $ListaTotalEleVec[$i]+1) {
						$NumVal++;
					} 
					$i++;
				}//foreach
                if ($NumVal == $numeroRecords) {
					$transaction->commit();
					$respuesta->meta=array("success"=>"true", "msg"=>"Se creo exitosamente !!!");
					$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));
				} else {
					$respuesta->meta=array("success"=>"false","msg"=>$error);
					$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));
				}
			} catch (Exception $e) {
				$transaction->rollback();
				throw $e;
			}
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>$error);
			$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
		}
    }
}





