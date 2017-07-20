<?php
/**
 * Estas son la accion para el controlador "MonitoreoActor".
 */

class update extends CAction
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
			$query=explode('&', $_SERVER['QUERY_STRING']);
			$listaRecords=$model->divideRecords($query);
			$numeroRecords=sizeof($listaRecords);
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
                    
                    if (json_last_error() === JSON_ERROR_NONE) {
                    	try{
        					$error.= (!isset($record['id_monitoreo_actor'])) ? "Variable indefinida {id_monitoreo_actor}" : "";
        					#$error.= (!isset($record['fk_id_usuario'])) ? "Variable indefinida {fk_id_usuario}" : "";
        					$error.= (!isset($record['fk_id_tipo_monitoreo_actor'])) ? "Variable indefinida {fk_id_tipo_monitoreo_actor}" : "";
        					$error.= (!isset($record['fecha_monitoreo_actor'])) ? "Variable indefinida {fecha_monitoreo_actor}" : "";
        					$error.= (!isset($record['analisis_monitoreo_actor'])) ? "Variable indefinida {analisis_monitoreo_actor}" : "";
							if ($error=="") {
								$model=MonitoreoActor::model()->findByPk($record['id_monitoreo_actor']);
								$audi=new LogSistema();
								if ($model!==null) {
        							$model->fk_id_usuario 				= Yii::app()->user->getId();
        							$model->fk_id_tipo_monitoreo_actor	=$record['fk_id_tipo_monitoreo_actor'];
        							$model->fecha_monitoreo_actor		=$record['fecha_monitoreo_actor'];
        							$model->analisis_monitoreo_actor	=$record['analisis_monitoreo_actor'];
	                            	if ($model->validate()) {
	                                	$model->save();
	                                	$audi->insertAudi("update",$model->tableName(),$record['id_monitoreo_actor']);
	                                	foreach ($record as $NomTabRel => $valor) {//key=nombre_tabla_atrib , $value=[{},{}] 0 ""
	                                		$t=0;
	                                    	if (is_array($valor) && sizeof($valor)!=0) {
	                                    	
	                                    		if (isset($listaRelaciones[$NomTabRel])) {

		                                        	foreach ($valor as $subvalue) {
		                                        
		                                        		$obj=new $listaRelaciones[$NomTabRel]();
                                                        $audi=new LogSistema();
														$listaNomPri=$obj->nombreLlavePrimaria($obj->tableName());
											
														if(isset($subvalue[$listaNomPri[0]['COLUMN_NAME']])) {
															$obj=$listaRelaciones[$NomTabRel]::model()->findByPk($subvalue[$listaNomPri[0]['COLUMN_NAME']]);
														} else {
															$sw=-1; 
															$error="llave primaria indefinida";
														}
														if ($obj!==null) {
															$obj->fk_id_monitoreo_actor=$record['id_monitoreo_actor'];
															foreach ($subvalue as $key3 => $value3) {
																if ($obj->validaCampo($key3)) {
										           					$obj->$key3=$value3;
										           				}
								       						}
								       						if ($obj->validate()) {
										       					$obj->save();
                                                               	$audi->insertAudi("update",$obj->tableName(),$subvalue[$listaNomPri[0]['COLUMN_NAME']]);
										       					$sw++;
										       				} else {
										       					$error=$obj->getErrors();
										       				}
														}
														else {
															$error="id fuera de rango";
														}
													}//foreach
		                                    	} else {
		                                    		$error="variable  indefinida ".$NomTabRel;
		                                    	}
											} 
										}//foreach        
	                                	$contValRecords++;
	                            	} else {
	                                	$error=array_merge(array("Variable idefinida o "),$model->getErrors());
	                            	}
	                            } else {
									$error="Registro no encontrado";
								}//if
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
					$respuesta->meta=array("success"=>"true","msg"=>"Fue actualizado exitosamente !!!");
					$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
				} else {
					$transaction->rollback();
					$respuesta->meta=array("success"=>"false","msg"=>$error);
					$controller->renderPartial('update',array('model'=>$respuesta,'callback'=>$callback));
				}
			} catch (Exception $e) {
				$transaction->rollback();
				throw $e;
			}
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>$error);
			$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>''));
		}
    }
}
