<?php
/**
 * Estas son la accion para el controlador "TipoMonitoreoActor".
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
		$model=new TipoMonitoreoActor();
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
        					$error.= (!isset($record['id_tipo_monitoreo_actor'])) ? "Variable indefinida {id_tipo_monitoreo_actor}" : "";
        					$error.= (!isset($record['nombre_tipo_monitoreo_actor'])) ? "Variable indefinida {nombre_tipo_monitoreo_actor}" : "";
        					$error.= (!isset($record['descripcion_tipo_monitoreo_actor'])) ? "Variable indefinida {descripcion_tipo_monitoreo_actor}" : "";
        					$error.= (!isset($record['estado_tipo_monitoreo_actor'])) ? "Variable indefinida {estado_tipo_monitoreo_actor}" : "";
							if ($error == "") {
								$model = TipoMonitoreoActor::model()->findByPk($record['id_tipo_monitoreo_actor']);							
								$audi=new LogSistema();
								if ($model!==null) {
        							$model->id_tipo_monitoreo_actor=$record['id_tipo_monitoreo_actor'];
        							$model->nombre_tipo_monitoreo_actor=$record['nombre_tipo_monitoreo_actor'];
        							$model->descripcion_tipo_monitoreo_actor=$record['descripcion_tipo_monitoreo_actor'];
        							$model->estado_tipo_monitoreo_actor=$record['estado_tipo_monitoreo_actor'];
		                            if ($model->validate()) {
		                                $model->save();
                                        $audi->insertAudi("update",$model->tableName(),$record['id_tipo_monitoreo_actor']);
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
