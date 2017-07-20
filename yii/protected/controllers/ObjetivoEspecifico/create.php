<?php
/**
 * Estas son la accion para el controlador "ObjetivoEspecifico".
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
		$model=new ObjetivoEspecifico();
        $error="";
		$error.= (!isset($_GET['records'])) ? "{ Error en la variable records } " : "";
		$error.= (!isset($_GET['callback'])) ? "{ Error de Callback } " : "";
        
        if ($error == "") {
			$callback=$_GET['callback'];
			$query = explode('&', $_SERVER['QUERY_STRING']);
			$listaRecords = $model->divideRecords($query);
			$numeroRecords = sizeof($listaRecords);
            $listaRelaciones=array(
								'resultado'=>'Resultado',
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
                    $model=new ObjetivoEspecifico();
                    $audi=new LogSistema();
                    
                    if (json_last_error() === JSON_ERROR_NONE) {
                    	try{
        					$error.= (!isset($record['fk_id_objetivo_general'])) ? "Variable indefinida {fk_id_objetivo_general}" : "";
        					$error.= (!isset($record['descripcion_objetivo_especifico'])) ? "Variable indefinida {descripcion_objetivo_especifico}" : "";
        					$error.= (!isset($record['metas_objetivo_especifico'])) ? "Variable indefinida {metas_objetivo_especifico}" : "";
        					$error.= (!isset($record['indicadores_objetivo_especifico'])) ? "Variable indefinida {indicadores_objetivo_especifico}" : "";
        					$error.= (!isset($record['medios_verificacion_objetivo_especifico'])) ? "Variable indefinida {medios_verificacion_objetivo_especifico}" : "";
        					$error.= (!isset($record['supuestos_objetivo_especifico'])) ? "Variable indefinida {supuestos_objetivo_especifico}" : "";
							if ($error == "") {
        						$model->fk_id_objetivo_general=$record['fk_id_objetivo_general'];
        						$model->descripcion_objetivo_especifico=$record['descripcion_objetivo_especifico'];
        						$model->metas_objetivo_especifico=$record['metas_objetivo_especifico'];
        						$model->indicadores_objetivo_especifico=$record['indicadores_objetivo_especifico'];
        						$model->medios_verificacion_objetivo_especifico=$record['medios_verificacion_objetivo_especifico'];
        						$model->supuestos_objetivo_especifico=$record['supuestos_objetivo_especifico'];
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
													$obj->fk_id_objetivo_especifico=$id_tabla_principal;
		                                            foreach ($subvalue as $key3 => $value3) {
														if($obj->validaCampo($key3)){
						           							if ($key3=="fk_id_objetivo_especifico")
						           								$obj->fk_id_objetivo_especifico=$id_tabla_principal;
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





