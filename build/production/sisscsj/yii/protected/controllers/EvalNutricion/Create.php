<?php
/**
 * Estas son la accion para el controlador "EvalNutricion".
 */

class Create extends CAction
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
		$model=new EvalNutricion();
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
                    $model = new EvalNutricion();
                    
                    if (json_last_error() === JSON_ERROR_NONE) {
                    	try {
        					$error.= (!isset($record['fk_id_tipo_consulta'])) ? "Variable indefinida {fk_id_tipo_consulta}" : "";
        					$error.= (!isset($record['fk_id_beneficiario'])) ? "Variable indefinida {fk_id_beneficiario}" : "";
        					$error.= (!isset($record['fecha_nutricion'])) ? "Variable indefinida {fecha_nutricion}" : "";
        					$error.= (!isset($record['observaciones_nutricion'])) ? "Variable indefinida {observaciones_nutricion}" : "";
        					$error.= (!isset($record['peso_nutricion'])) ? "Variable indefinida {peso_nutricion}" : "";
        					$error.= (!isset($record['talla_nutricion'])) ? "Variable indefinida {talla_nutricion}" : "";
        					$error.= (!isset($record['peso_talla_nutricion'])) ? "Variable indefinida {peso_talla_nutricion}" : "";
        					$error.= (!isset($record['talla_edad_nutricion'])) ? "Variable indefinida {talla_edad_nutricion}" : "";
        					
							if ($error == "") {
        						$model->fk_id_tipo_consulta		=$record['fk_id_tipo_consulta'];
        						$model->fk_id_usuario 			= Yii::app()->user->getId();
        						$model->fk_id_beneficiario		=$record['fk_id_beneficiario'];
        						$model->fecha_nutricion			=$record['fecha_nutricion'];
        						$model->observaciones_nutricion	=$record['observaciones_nutricion'];
        						$model->peso_nutricion			=$record['peso_nutricion'];
        						$model->talla_nutricion			=$record['talla_nutricion'];
        						$model->peso_talla_nutricion	=$record['peso_talla_nutricion'];
        						$model->talla_edad_nutricion	=$record['talla_edad_nutricion'];
        						
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





