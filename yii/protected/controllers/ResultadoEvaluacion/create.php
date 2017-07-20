<?php
/**
 * Estas son la accion para el controlador "ResultadoEvaluacion".
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
		$model=new ResultadoEvaluacion();
		$audi=new LogSistema();
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
                    $model = new ResultadoEvaluacion();
                    $audi=new LogSistema();
					
                    if (json_last_error() === JSON_ERROR_NONE) {
                    	try {
        					$error.= (!isset($record['fk_id_resultado'])) ? "Variable indefinida {fk_id_resultado}" : "";
        					$error.= (!isset($record['tipo_resultado_evaluacion'])) ? "Variable indefinida {tipo_resultado_evaluacion}" : "";
        					$error.= (!isset($record['informacion_cualitativa_resultado_evaluacion'])) ? "Variable indefinida {informacion_cualitativa_resultado_evaluacion}" : "";
        					$error.= (!isset($record['accion_seguimiento_resultado_evaluacion'])) ? "Variable indefinida {accion_seguimiento_resultado_evaluacion}" : "";
        					$error.= (!isset($record['evaluacion_resultado_evaluacion'])) ? "Variable indefinida {evaluacion_resultado_evaluacion}" : "";
							if ($error == "") {
        						$model->fk_id_resultado								=$record['fk_id_resultado'];
        						$model->tipo_resultado_evaluacion					=$record['tipo_resultado_evaluacion'];
        						$model->informacion_cualitativa_resultado_evaluacion=$record['informacion_cualitativa_resultado_evaluacion'];
        						$model->accion_seguimiento_resultado_evaluacion		=$record['accion_seguimiento_resultado_evaluacion'];
        						$model->evaluacion_resultado_evaluacion				=$record['evaluacion_resultado_evaluacion'];
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