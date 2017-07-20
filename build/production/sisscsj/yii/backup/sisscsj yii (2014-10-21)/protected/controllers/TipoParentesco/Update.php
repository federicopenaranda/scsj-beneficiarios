<?php
/**
 * Estas son la accion para el controlador "TipoParentesco".
 */

class Update extends CAction
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
		$model=new TipoParentesco();
        $error="";
		$error.= (!isset($_GET['records'])) ? "{ Error en la variable records } " : "";
		$error.= (!isset($_GET['callback'])) ? "{ Error de Callback } " : "";
        
        if ($error == "") {
			$callback=$_GET['callback'];
			$query=explode('&', $_SERVER['QUERY_STRING']);
			$listaRecords=$model->divideRecords($query);
			$numeroRecords=sizeof($listaRecords);
            $listaRelaciones=array(
								'beneficiario_familia'=>'BeneficiarioFamilia',
								);
            foreach ($listaRecords as $value) {
				
				$TotalEleVectores=0;
				$records=json_decode($value);
				foreach ($records as $propiedad => $valor) {
					
					if (is_array($valor)){
						
						$TotalEleVectores+=sizeof($valor);
					} 
				}
				$ListaTotalEleVec[]=$TotalEleVectores;
			}
			
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
        					$error.= (!isset($record['id_tipo_parentesco'])) ? "Variable indefinida {id_tipo_parentesco}" : "";
        					$error.= (!isset($record['nombre_tipo_parentesco'])) ? "Variable indefinida {nombre_tipo_parentesco}" : "";
        					$error.= (!isset($record['descripcion_tipo_parentesco'])) ? "Variable indefinida {descripcion_tipo_parentesco}" : "";
							if ($error=="") {
								$model=TipoParentesco::model()->findByPk($record['id_tipo_parentesco']);
								if ($model!==null) {
        							$model->nombre_tipo_parentesco=$record['nombre_tipo_parentesco'];
        							$model->descripcion_tipo_parentesco=$record['descripcion_tipo_parentesco'];
	                            	if ($model->validate()) {
	                                	$model->save();
	                                
	                                	foreach ($record as $NomTabRel => $valor) {//key=nombre_tabla_atrib , $value=[{},{}] 0 ""
	                                		$t=0;
	                                    	if (is_array($valor) && sizeof($valor)!=0) {
	                                    	
	                                    		if (isset($listaRelaciones[$NomTabRel])) {

		                                        	foreach ($valor as $subvalue) {
		                                        
		                                        		$obj=new $listaRelaciones[$NomTabRel]();
														$listaNomPri=$obj->nombreLlavePrimaria($obj->tableName());

														if (sizeof($listaNomPri)==1) {
															if(isset($subvalue[$listaNomPri[0]['COLUMN_NAME']])) {
																$obj=$listaRelaciones[$NomTabRel]::model()->findByPk($subvalue[$listaNomPri[0]['COLUMN_NAME']]);
															} else {
																$sw=-1; 
																$error="llave primaria indefinida";
															}
														} else {
															if (sizeof($listaNomPri)==2 && $t==0) {
																$obj->deleteAll("fk_id_tipo_parentesco=?",array($record['id_tipo_parentesco']));
																$t=1-$t;
															}
														}
														if ($obj!==null) {
															$obj->fk_id_tipo_parentesco=$record['id_tipo_parentesco'];	
														
															foreach ($subvalue as $key3 => $value3) {
																if ($obj->validaCampo($key3)) {
										           						$obj->$key3=$value3;
										           				}
								       						}
								       						if ($obj->validate()) {
										       					$obj->save();
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
