<?php
/**
 * Estas son la accion para el controlador "AmbitoMonitoreoPc".
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
		$model=new AmbitoMonitoreoPc();
        $error="";
		$error.= (!isset($_GET['records'])) ? "{ Error en la variable records } " : "";
		$error.= (!isset($_GET['callback'])) ? "{ Error de Callback } " : "";
        
        if ($error == "") {
			$callback=$_GET['callback'];
			$query=explode('&', $_SERVER['QUERY_STRING']);
			$listaRecords=$model->divideRecords($query);
			$numeroRecords=sizeof($listaRecords);
            $listaRelaciones=array(
								'resultado_monitoreo_pc'=>'ResultadoMonitoreoPc',
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
        					$error.= (!isset($record['id_ambito_monitoreo_pc'])) ? "Variable indefinida {id_ambito_monitoreo_pc}" : "";
        					$error.= (!isset($record['fk_id_caracteristica_monitoreo_pc'])) ? "Variable indefinida {fk_id_caracteristica_monitoreo_pc}" : "";
        					$error.= (!isset($record['nombre_ambito_monitoreo_pc'])) ? "Variable indefinida {nombre_ambito_monitoreo_pc}" : "";
        					$error.= (!isset($record['indicador_ambito_monitoreo_pc'])) ? "Variable indefinida {indicador_ambito_monitoreo_pc}" : "";
        					$error.= (!isset($record['estado_ambito_monitoreo_pc'])) ? "Variable indefinida {estado_ambito_monitoreo_pc}" : "";
							if ($error=="") {
								$model=AmbitoMonitoreoPc::model()->findByPk($record['id_ambito_monitoreo_pc']);
								$audi=new LogSistema();
								if ($model!==null) {
        							$model->fk_id_caracteristica_monitoreo_pc=$record['fk_id_caracteristica_monitoreo_pc'];
        							$model->nombre_ambito_monitoreo_pc=$record['nombre_ambito_monitoreo_pc'];
        							$model->indicador_ambito_monitoreo_pc=$record['indicador_ambito_monitoreo_pc'];
        							$model->estado_ambito_monitoreo_pc=$record['estado_ambito_monitoreo_pc'];
	                            	if ($model->validate()) {
	                                	$model->save();
	                                	$audi->insertAudi("update",$model->tableName(),$record['id_ambito_monitoreo_pc']);
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
															$obj->fk_id_ambito_monitoreo_pc=$record['id_ambito_monitoreo_pc'];
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
