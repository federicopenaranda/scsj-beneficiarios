<?php
/**
 * Estas son la accion para el controlador "ActividadProyecto".
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
		$model=new ActividadProyecto();
        $error="";
		$error.= (!isset($_GET['records'])) ? "{ Error en la variable records } " : "";
		$error.= (!isset($_GET['callback'])) ? "{ Error de Callback } " : "";
        
        if ($error == "") {
			$callback=$_GET['callback'];
			$query = explode('&', $_SERVER['QUERY_STRING']);
			$listaRecords = $model->divideRecords($query);
			$numeroRecords = sizeof($listaRecords);
            $listaRelaciones=array(	
								'actividad_tipo_participante'=>'ActividadTipoParticipante',
								'resultado_actividad'=>'ResultadoActividad',
								'actividad_proyecto_tipo_actividad'=>'ActividadProyectoTipoActividad',
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
                    $model=new ActividadProyecto();
                    $audi=new LogSistema();
                    
                    if (json_last_error() === JSON_ERROR_NONE) {
                    	try{
        					#$error.= (!isset($record['fk_id_usuario'])) ? "Variable indefinida {fk_id_usuario}" : "";
        					$error.= (!isset($record['fk_id_lugar_actividad'])) ? "Variable indefinida {fk_id_lugar_actividad}" : "";
        					$error.= (!isset($record['fk_id_gestion'])) ? "Variable indefinida {fk_id_gestion}" : "";
        					$error.= (!isset($record['titulo_actividad_proyecto'])) ? "Variable indefinida {titulo_actividad_proyecto}" : "";
        					$error.= (!isset($record['fecha_inicio_actividad_proyecto'])) ? "Variable indefinida {fecha_inicio_actividad_proyecto}" : "";
        					$error.= (!isset($record['fecha_fin_actividad_proyecto'])) ? "Variable indefinida {fecha_fin_actividad_proyecto}" : "";
        					$error.= (!isset($record['descripcion_actividad_proyecto'])) ? "Variable indefinida {descripcion_actividad_proyecto}" : "";
							if ($error == "") {
        						$model->fk_id_usuario=Yii::app()->user->getId();
        						$model->fk_id_lugar_actividad=$record['fk_id_lugar_actividad'];
        						$model->fk_id_gestion=$record['fk_id_gestion'];
        						$model->titulo_actividad_proyecto=$record['titulo_actividad_proyecto'];
        						$model->fecha_inicio_actividad_proyecto=$record['fecha_inicio_actividad_proyecto'];
        						$model->fecha_fin_actividad_proyecto=$record['fecha_fin_actividad_proyecto'];
        						$model->descripcion_actividad_proyecto=$record['descripcion_actividad_proyecto'];
	                            if ($model->validate()) {
	                                $model->save();
                                    $audi->insertAudi("create",$model->tableName(),$model->getPrimaryKey());
	                                $id_tabla_principal=$model->getPrimaryKey();
	                                
	                                foreach ($record as $NomTabRel => $valor) {//key=nombre_tabla_atrib , $value=[{},{}] 0 ""
	                                	
	                                    if (is_array($valor) && sizeof($valor)!=0) {
	                                    	
	                                    	if (isset($listaRelaciones[$NomTabRel])) {

		                                        foreach ($valor as $subvalue) {
		                                        
		                                        	$obj=new $listaRelaciones[$NomTabRel]();
                                                    $audi=new LogSistema();
													$obj->fk_id_actividad_proyecto=$id_tabla_principal;
		                                            foreach ($subvalue as $key3 => $value3) {
														if($obj->validaCampo($key3)){
						           							if ($key3=="fk_id_actividad_proyecto")
						           								$obj->fk_id_actividad_proyecto=$id_tabla_principal;
						           							else
						           								$obj->$key3=$value3;
						           						}
					       							}
		                                            
                                                    if ($obj->validate()) {
					       								$obj->save();
                                                        $audi->insertAudi("create",$obj->tableName(),$obj->getPrimaryKey());

					       								$sw++;
					       							} else {
					       								$error=$obj->getErrors();
					       							}
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





