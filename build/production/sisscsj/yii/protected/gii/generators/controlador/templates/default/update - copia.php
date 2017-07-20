<?php
/**
* nombre de la tabla <?php echo $tableName; ?>
*  nombre del Modelo <?php echo $modelClass; ?>
* nombre de la columnas 
* nombre de la acciont <?php echo $action; ?>
*/
?>
<?php echo "<?php\n"; ?>
/**
 * Estas son la accion para el controlador "<?php echo $modelClass; ?>".
 */

class <?php echo $action; ?> extends CAction
{
    /**
    * La funcion run ejecuta la logica de la accion
    * Su funcion es la de crear un nuevo registro y adicionarlo en una tabla
    * @param array $callback se introduce el nombre de una funcion
    */
<?php
/**
* 'VarName'=>array('RelationType', 'ClassName', 'ForeignKey', ...additional options)
*/
$mode=new $modelClass();

$relations=$mode->relations();
$listClassName=array();
for($i=0;$i<sizeof($relations);$i++) {
			
	$current=current($relations);
	if (current($current)=="CHasManyRelation") {
		$key=key($relations);next($current);
		$nomode=current($current);
		$listClassName[]=$nomode;	
	}
	next($relations);
}

$listNamePrimaryKey=array();
foreach($columns as $valor) {
	if ($valor->isPrimaryKey == 1)
		$listNamePrimaryKey[]=$valor->name;
}

$listNameForeignKey=array();
foreach($columns as $valor) {
	if ($valor->isForeignKey == 1)
		$listNameForeignKey[]=$valor->name;
}

$array=$mode->relations();
$aux=array();
$aux2=array();
$relacion=array();
for($i=0;$i<sizeof($array);$i++){
	$current=current($array);
	if(current($current)=="CHasManyRelation"){
		$key=key($array);next($current);
		$nomode=current($current);
		$aux[]=$nomode;	
	}
	next($array);
}

for($i=0;$i<sizeof($aux);$i++){
	$relacion[trim(strtolower (preg_replace ('/([A-Z])/', '_$1', $aux[$i])),"_")] =$aux[$i] ;
}?>
<?php if(sizeof($listClassName) >=0 && sizeof($listClassName) <3 && sizeof($listNamePrimaryKey)==1)://Referencial?>
	public function run()
	{
		$controller=$this->getController();
		$respuesta=new stdClass();
		$model=new <?php echo $modelClass; ?>();
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
<?php foreach($columns as $column):
if (strpos($column->name,"fecha_creacion")===FALSE):?>
        					$error.= (!isset($record['<?php echo $column->name;?>'])) ? "Variable indefinida {<?php echo $column->name;?>}" : "";
<?php endif;endforeach;?>
							if ($error == "") {
								$model=<?php echo $modelClass;?>::model()->findByPk($record['<?php echo $listNamePrimaryKey[0];?>']);							
								$audi=new LogSistema();
								if ($model!==null) {
<?php foreach($columns as $column):
if (!$column->isPrimaryKey==1 && strpos($column->name,"fecha_creacion")===FALSE):?>
        							$model-><?php echo $column->name;?>=$record['<?php echo $column->name;?>'];
<?php endif;endforeach;?>
		                            if ($model->validate()) {
		                                $model->save();
                                        $audi->insertAudi("update",$model->tableName(),$record['<?php echo $listNamePrimaryKey[0];?>']);
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
<?php endif;?>
<?php if(sizeof($listClassName) >=0 && sizeof($listClassName) <3 && sizeof($listNamePrimaryKey)==2 && sizeof($columns)>2)://tablas referenciales?>
	public function run()
	{
		$controller=$this->getController();
		$respuesta=new stdClass();
		$model=new <?php echo $modelClass; ?>();
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
<?php foreach($columns as $column):
if (strpos($column->name,"fecha_creacion")===FALSE):?>
        					$error.= (!isset($record['<?php echo $column->name;?>'])) ? "Variable indefinida {<?php echo $column->name;?>}" : "";
<?php endif;endforeach;?>
<?php foreach($columns as $column):
if ($column->isForeignKey==1):$listaF[]=$column->name;?>
        					$error.= (!isset($record['<?php echo ucfirst($column->name);?>'])) ? "Variable indefinida {<?php echo $column->name;?>}" : "";
<?php endif;endforeach;?>
							if ($error == "") {
								$model=<?php echo $modelClass;?>::model()->find(array('condition'=>'<?php echo $listaF[0]?>=:<?php echo $listaF[0]?> and <?php echo $listaF[1]?>=:<?php echo $listaF[1]?>','params'=>array(':<?php echo $listaF[0]?>'=>$records['<?php echo $listaF[0]?>'],':<?php echo $listaF[1]?>'=>$records['<?php echo $listaF[1]?>'])));
                                $audi=new LogSistema();
								if ($model!==null) {
<?php foreach($columns as $column):
if (strpos($column->name,"fecha_creacion")===FALSE):if($column->isForeignKey==1) {?>
									$model-><?php echo $column->name;?>=$record['<?php echo ucfirst($column->name);?>'];
<?php }else { ?>
									$model-><?php echo $column->name;?>=$record['<?php echo $column->name;?>'];
<?php }endif;endforeach;?>
		                            if ($model->validate()) {
		                                $model->save();
                                        $audi->insertAudi("update",$model->tableName(),$records['<?php echo $listaF[0]?>." ".$records['<?php echo $listaF[1]?>);
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
<?php endif;?>
<?php if (sizeof($listClassName)>=3 && sizeof($listNamePrimaryKey)==1)://PATRON 2?>
<?php $listNamePri=$listNamePrimaryKey;?>
public function run()
	{
		$controller=$this->getController();
		$respuesta=new stdClass();
		$model=new <?php echo $modelClass; ?>();
        $error="";
		$error.= (!isset($_GET['records'])) ? "{ Error en la variable records } " : "";
		$error.= (!isset($_GET['callback'])) ? "{ Error de Callback } " : "";
        
        if ($error == "") {
			$callback=$_GET['callback'];
			$query=explode('&', $_SERVER['QUERY_STRING']);
			$listaRecords=$model->divideRecords($query);
			$numeroRecords=sizeof($listaRecords);
            $listaRelaciones=array(
<?php  foreach($relacion as $nomTabla=>$nomModel):?>
								'<?php echo $nomTabla;?>'=>'<?php echo $nomModel;?>',
<?php endforeach;?>
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
<?php foreach($columns as $column):
if (strpos($column->name,"fecha_creacion")===FALSE):?>
        					$error.= (!isset($record['<?php echo $column->name;?>'])) ? "Variable indefinida {<?php echo $column->name;?>}" : "";
<?php endif;endforeach;?>
							if ($error=="") {
								$model=<?php echo $modelClass;?>::model()->findByPk($record['<?php echo $listNamePrimaryKey[0];?>']);
                               	$audi=new LogSistema();
								if ($model!==null) {
<?php foreach($columns as $column):
if (!$column->isPrimaryKey==1 && strpos($column->name,"fecha_creacion")===FALSE):?>
        							$model-><?php echo $column->name;?>=$record['<?php echo $column->name;?>'];
<?php endif;endforeach;?>
	                            	if ($model->validate()) {
	                                	$model->save();
	                                	$audi->insertAudi("update",$model->tableName(),$record['<?php echo $listNamePrimaryKey[0];?>']);
	                                	foreach ($record as $NomTabRel => $valor) {//key=nombre_tabla_atrib , $value=[{},{}] 0 ""
	                                		$t=0;
	                                    	if (is_array($valor) && sizeof($valor)!=0) {
	                                    	
	                                    		if (isset($listaRelaciones[$NomTabRel])) {

		                                        	foreach ($valor as $subvalue) {
		                                        
		                                        		$obj=new $listaRelaciones[$NomTabRel]();
                                                        $audi=new LogSistema();
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
																$obj->deleteAll("fk_id_<?php echo $tableName;?>=?",array($record['id_<?php echo $tableName;?>']));
																$t=1-$t;
															}
														}
														if ($obj!==null) {
															$obj->fk_id_<?php echo $tableName;?>=$record['<?php echo $listNamePrimaryKey[0];?>'];	
														
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
<?php endif;?>