<?php
/**
 * Estas son la accion para el controlador "Entidad".
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
		$model=new Entidad();
        $error="";
		$error.= (!isset($_GET['records'])) ? "{ Error en la variable records } " : "";
		$error.= (!isset($_GET['callback'])) ? "{ Error de Callback } " : "";
        
        if ($error == "") {
			$callback=$_GET['callback'];
			$query=explode('&', $_SERVER['QUERY_STRING']);
			$listaRecords=$model->divideRecords($query);
			$numeroRecords=sizeof($listaRecords);
            $listaRelaciones=array(
								'beneficiario_entidad'=>'BeneficiarioEntidad',
								'entidad_estado_entidad'=>'EntidadEstadoEntidad',
								'marco_logico'=>'MarcoLogico',
								'usuario_entidad'=>'UsuarioEntidad',
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
        					$error.= (!isset($record['id_entidad'])) ? "Variable indefinida {id_entidad}" : "";
        					$error.= (!isset($record['fk_id_tipo_entidad'])) ? "Variable indefinida {fk_id_tipo_entidad}" : "";
        					$error.= (!isset($record['nombre_entidad'])) ? "Variable indefinida {nombre_entidad}" : "";
        					$error.= (!isset($record['fecha_inicio_actividades_entidad'])) ? "Variable indefinida {fecha_inicio_actividades_entidad}" : "";
        					$error.= (!isset($record['fecha_fin_actividades_entidad'])) ? "Variable indefinida {fecha_fin_actividades_entidad}" : "";
        					$error.= (!isset($record['direccion_entidad'])) ? "Variable indefinida {direccion_entidad}" : "";
        					$error.= (!isset($record['observaciones_entidad'])) ? "Variable indefinida {observaciones_entidad}" : "";
							if ($error=="") {
								$model=Entidad::model()->findByPk($record['id_entidad']);
								$audi=new LogSistema();
								if ($model!==null) {
        							$model->fk_id_tipo_entidad=$record['fk_id_tipo_entidad'];
        							$model->nombre_entidad=$record['nombre_entidad'];
        							$model->fecha_inicio_actividades_entidad=$record['fecha_inicio_actividades_entidad'];
        							$model->fecha_fin_actividades_entidad=$record['fecha_fin_actividades_entidad'];
        							$model->direccion_entidad=$record['direccion_entidad'];
        							$model->observaciones_entidad=$record['observaciones_entidad'];
	                            	if ($model->validate()) {
	                                	$model->save();
	                                	$audi->insertAudi("update",$model->tableName(),$record['id_entidad']);
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
															$obj->fk_id_entidad=$record['id_entidad'];
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
