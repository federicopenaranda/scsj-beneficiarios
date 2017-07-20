<?php
/**
 * Estas son la accion para el controlador "EntidadMarcoLogico".
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
		$model=new EntidadMarcoLogico();
        $error="";
		$error.= (!isset($_GET['records'])) ? "{ Error en la variable records } " : "";
		$error.= (!isset($_GET['callback'])) ? "{ Error de Callback } " : "";
        
        if ($error == "") {
			$callback=$_GET['callback'];
			$query=explode('&', $_SERVER['QUERY_STRING']);
			$listaRecords=$model->divideRecords($query);
			$numeroRecords=sizeof($listaRecords);
			$contValRecords=0;
			$transaction=$model->dbConnection->beginTransaction();
            try {
				foreach ($listaRecords as $listaRecord) {
					$record=CJSON::decode(urldecode($listaRecord));
                    
                    if (json_last_error() === JSON_ERROR_NONE) {
                    	try{
        					$error.= (!isset($record['id_entidad_marco_logico'])) ? "Variable indefinida {id_entidad_marco_logico}" : "";
        					$error.= (!isset($record['fk_id_entidad'])) ? "Variable indefinida {fk_id_entidad}" : "";
        					$error.= (!isset($record['fk_id_marco_logico'])) ? "Variable indefinida {fk_id_marco_logico}" : "";
        					$error.= (!isset($record['estado_entidad_marco_logico'])) ? "Variable indefinida {estado_entidad_marco_logico}" : "";
							if ($error == "") {
								$model=EntidadMarcoLogico::model()->findByPk($record['id_entidad_marco_logico']);							
								$audi=new LogSistema();
								if ($model!==null) {
if (!$column->isPrimaryKey==1 && strpos($column->name,"fecha_creacion")===FALSE):?>
        							$model->id_entidad_marco_logico=$record['id_entidad_marco_logico'];
if (!$column->isPrimaryKey==1 && strpos($column->name,"fecha_creacion")===FALSE):?>
        							$model->fk_id_entidad=$record['fk_id_entidad'];
if (!$column->isPrimaryKey==1 && strpos($column->name,"fecha_creacion")===FALSE):?>
        							$model->fk_id_marco_logico=$record['fk_id_marco_logico'];
if (!$column->isPrimaryKey==1 && strpos($column->name,"fecha_creacion")===FALSE):?>
        							$model->estado_entidad_marco_logico=$record['estado_entidad_marco_logico'];
		                            if ($model->validate()) {
		                                $model->save();
                                        $audi->insertAudi("update",$model->tableName(),$record['id_entidad_marco_logico']);
		                                $contValRecords++;
		                            } else {
		                                $error=array_merge(array("Variable idefinida o "),$model->getErrors());
		                            }
		                        } else {
									$error="Registro no encontrado";
								}
	                        }
                        } catch(Exception $e) {
							$error=$e->getMessage();
						}
                    } else {
                        $error="Error de json";
                    }
				}
                if ($contValRecords == $numeroRecords) {
                    $transaction->commit();
					$respuesta->meta=array("success"=>"true","msg"=>"Fue actualizado exitosamente !!!");
					$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
                } else {
                    $transaction->rollback();
					$respuesta->meta=array("success"=>"false","msg"=>$error);
					$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
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
	public function run()
	{
		$controller=$this->getController();
		$respuesta=new stdClass();
		$model=new EntidadMarcoLogico();
        $error="";
		$error.= (!isset($_GET['records'])) ? "{ Error en la variable records } " : "";
		$error.= (!isset($_GET['callback'])) ? "{ Error de Callback } " : "";
        
        if ($error == "") {
			$callback=$_GET['callback'];
			$query=explode('&', $_SERVER['QUERY_STRING']);
			$listaRecords=$model->divideRecords($query);
			$numeroRecords=sizeof($listaRecords);
            $listaRelaciones=array(
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
        					$error.= (!isset($record['id_entidad_marco_logico'])) ? "Variable indefinida {id_entidad_marco_logico}" : "";
        					$error.= (!isset($record['fk_id_entidad'])) ? "Variable indefinida {fk_id_entidad}" : "";
        					$error.= (!isset($record['fk_id_marco_logico'])) ? "Variable indefinida {fk_id_marco_logico}" : "";
        					$error.= (!isset($record['estado_entidad_marco_logico'])) ? "Variable indefinida {estado_entidad_marco_logico}" : "";
							if ($error=="") {
								$model=EntidadMarcoLogico::model()->findByPk($record['id_entidad_marco_logico']);
								$audi=new LogSistema();
								if ($model!==null) {
        							$model->fk_id_entidad=$record['fk_id_entidad'];
        							$model->fk_id_marco_logico=$record['fk_id_marco_logico'];
        							$model->estado_entidad_marco_logico=$record['estado_entidad_marco_logico'];
	                            	if ($model->validate()) {
	                                	$model->save();
	                                	$audi->insertAudi("update",$model->tableName(),$record['id_entidad_marco_logico']);
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
															$obj->fk_id_entidad_marco_logico=$record['id_entidad_marco_logico'];
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
