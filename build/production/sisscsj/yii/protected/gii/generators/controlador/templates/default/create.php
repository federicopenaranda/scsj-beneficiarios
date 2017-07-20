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
require_once('Dato.php');
$mode=new $modelClass();
$relations=$mode->relations();
/**
* catidad de llaves primarias de una tabla
*/
$cantidadPk=quantityPrimaryKey($columns);
/**
* catidad de llaves foraneas de una tabla
*/
$cantidadFk=quantityForeignKey($columns);
/**
* Lista de los nombres de las clases relacionadas (nombre_de_lo_modelos ) de tipo hasMany
*/
$listClassName=listClassName($relations);
/**
* Lista de todos los nombres de los campos que son llaves primarias
*/
$listNamePrimaryKey=listNamePrimaryKey($columns);
/**
* Lista de todos los nombres de los campos que son llaves foraneas
*/
$listNameForeignKey=listNameForeignKey($columns);

$aux=array();
$aux2=array();
$relacion=array();
for($i=0;$i<sizeof($relations);$i++){
	$current=current($relations);
	if(current($current)=="CHasManyRelation"){
		$key=key($relations);next($current);
		$nomode=current($current);
		$aux[]=$nomode;
	}
	next($relations);
}
for($i=0;$i<sizeof($aux);$i++){
	$relacion[trim(strtolower (preg_replace ('/([A-Z])/', '_$1', $aux[$i])),"_")] =$aux[$i] ;
}
?>
<?php $listcolumSinPkDate = listColumnsSinPkAndDate($columns);?>
<?php if(($cantidadPk == 1 && $cantidadFk == 0) && sizeof(listClassName($relations) == 0)) :?>
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
                    $model=new <?php echo $modelClass; ?>();
                    $audi=new LogSistema();
                    
                    if (json_last_error() === JSON_ERROR_NONE) {
                    	try{
<?php foreach($columns as $column):
if (!$column->isPrimaryKey==1 && strpos($column->name,"fecha_creacion")===FALSE):?>
        					$error.= (!isset($record['<?php echo $column->name;?>'])) ? "Variable indefinida {<?php echo $column->name;?>}" : "";
<?php endif;endforeach;?>
							if ($error=="") {
<?php foreach($columns as $column):
if (!$column->isPrimaryKey==1 && strpos($column->name,"fecha_creacion")===FALSE):?>
        						$model-><?php echo $column->name;?>=$record['<?php echo $column->name;?>'];
<?php endif;endforeach;?>
	                            if ($model->validate()) {
	                                $model->save();
                                    $audi->insertAudi("create",$model->tableName(),$model->getPrimaryKey());
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
				}
                if ($contValRecords == $numeroRecords) {
                    $transaction->commit();
                    $respuesta->meta=array("success"=>"true","msg"=>"Se creo exitosamente !!!");
                    $controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));
                } else {
                    $transaction->rollback();
                    $respuesta->meta=array("success"=>"false","msg"=>$error);
                    $controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
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
<?php endif;?>
<?php if(($cantidadPk == 1 && $cantidadFk > 0) && ($cantidadFk != sizeof($columns)-1 && sizeof(listClassName($relations)) == 0)):?>
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
					$record = CJSON::decode(urldecode($listaRecord));
                    $model = new <?php echo $modelClass; ?>();
                    
                    if (json_last_error() === JSON_ERROR_NONE) {
                    	try {
<?php foreach($listcolumSinPkDate as $column):?>
        					$error.= (!isset($record['<?php echo $column;?>'])) ? "Variable indefinida {<?php echo $column;?>}" : "";
<?php endforeach;?>
							if ($error == "") {
<?php foreach($listcolumSinPkDate as $column):?>
        						$model-><?php echo $column;?>=$record['<?php echo $column;?>'];
<?php endforeach;?>
	                            if ($model->validate()) {
	                                $model->save();
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
				}
                if ($contValRecords == $numeroRecords) {
                    $transaction->commit();
                    $respuesta->meta=array("success"=>"true", "msg"=>"Se creo exitosamente !!!");
                    $controller->renderPartial('create', array('model'=>$respuesta, 'callback'=>$callback));
                } else {
                    $transaction->rollback();
                    $respuesta->meta=array("success"=>"false", "msg"=>$error);
                    $controller->renderParTial('create', array('model'=>$respuesta, 'callback'=>''));
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
<?php endif;?>
<?php if(($cantidadPk == 1 && $cantidadFk > 0) && sizeof(listClassName($relations) != 0)):?>
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
			$query = explode('&', $_SERVER['QUERY_STRING']);
			$listaRecords = $model->divideRecords($query);
			$numeroRecords = sizeof($listaRecords);
            $listaRelaciones=array(
<?php  foreach($relacion as $nomTabla=>$nomModel):?>
								'<?php echo $nomTabla;?>'=>'<?php echo $nomModel;?>',
<?php endforeach;?>
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
                    $model=new <?php echo $modelClass; ?>();
                    $audi=new LogSistema();
                    
                    if (json_last_error() === JSON_ERROR_NONE) {
                    	try{
<?php foreach($listcolumSinPkDate as $column):?>
        					$error.= (!isset($record['<?php echo $column;?>'])) ? "Variable indefinida {<?php echo $column;?>}" : "";
<?php endforeach;?>
							if ($error == "") {
<?php foreach($listcolumSinPkDate as $column):?>
        						$model-><?php echo $column;?>=$record['<?php echo $column;?>'];
<?php endforeach;?>
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
													$obj->fk_id_<?php echo $tableName;?>=$id_tabla_principal;
		                                            foreach ($subvalue as $key3 => $value3) {
														if($obj->validaCampo($key3)){
						           							if ($key3=="fk_id_<?php echo $tableName;?>")
						           								$obj->fk_id_<?php echo $tableName;?>=$id_tabla_principal;
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
<?php endif;?>





