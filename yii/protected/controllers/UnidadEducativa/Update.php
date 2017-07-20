<?php
/**
 * Estas son la accion para el controlador "UnidadEducativa".
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
		$model=new UnidadEducativa();
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
        					$error.= (!isset($record['id_unidad_educativa'])) ? "Variable indefinida {id_unidad_educativa}" : "";
        					$error.= (!isset($record['nombre_unidad_educativa'])) ? "Variable indefinida {nombre_unidad_educativa}" : "";
        					$error.= (!isset($record['telefono_unidad_educativa'])) ? "Variable indefinida {telefono_unidad_educativa}" : "";
        					$error.= (!isset($record['direccion_unidad_educativa'])) ? "Variable indefinida {direccion_unidad_educativa}" : "";
							if ($error == "") {
								$model=UnidadEducativa::model()->findByPk($record['id_unidad_educativa']);							
								$audi=new LogSistema();
								if ($model!==null) {
        							$model->nombre_unidad_educativa=$record['nombre_unidad_educativa'];
        							$model->telefono_unidad_educativa=$record['telefono_unidad_educativa'];
        							$model->direccion_unidad_educativa=$record['direccion_unidad_educativa'];
		                            if ($model->validate()) {
		                                $model->save();
                                        $audi->insertAudi("update",$model->tableName(),$record['id_unidad_educativa']);
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
