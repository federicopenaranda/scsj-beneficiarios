<?php
/**
 * Estas son la accion para el controlador "EvalPedagogico".
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
		$model=new EvalPedagogico();
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
                    $model = new EvalPedagogico();
                    
                    if (json_last_error() === JSON_ERROR_NONE) {
                    	try {
        					$error.= (!isset($record['fk_id_beneficiario'])) ? "Variable indefinida {fk_id_beneficiario}" : "";
        					$error.= (!isset($record['fecha_pedagogico'])) ? "Variable indefinida {fecha_pedagogico}" : "";
        					$error.= (!isset($record['observaciones_pedagogico'])) ? "Variable indefinida {observaciones_pedagogico}" : "";
        					$error.= (!isset($record['matematicas_pedagogico'])) ? "Variable indefinida {matematicas_pedagogico}" : "";
        					$error.= (!isset($record['lenguaje_pedagogico'])) ? "Variable indefinida {lenguaje_pedagogico}" : "";
        					$error.= (!isset($record['desarrollo_habilidades_pedagogico'])) ? "Variable indefinida {desarrollo_habilidades_pedagogico}" : "";
        					$error.= (!isset($record['ciencias_vida_pedagogico'])) ? "Variable indefinida {ciencias_vida_pedagogico}" : "";
        					$error.= (!isset($record['idiomas_pedagogico'])) ? "Variable indefinida {idiomas_pedagogico}" : "";
        					$error.= (!isset($record['tecnologia_pedagogico'])) ? "Variable indefinida {tecnologia_pedagogico}" : "";
							if ($error == "") {
        						$model->fk_id_usuario						=Yii::app()->user->getId();
        						$model->fk_id_beneficiario					=$record['fk_id_beneficiario'];
        						$model->fecha_pedagogico					=$record['fecha_pedagogico'];
        						$model->observaciones_pedagogico			=$record['observaciones_pedagogico'];
        						$model->matematicas_pedagogico				=$record['matematicas_pedagogico'];
        						$model->lenguaje_pedagogico					=$record['lenguaje_pedagogico'];
        						$model->desarrollo_habilidades_pedagogico	=$record['desarrollo_habilidades_pedagogico'];
        						$model->ciencias_vida_pedagogico			=$record['ciencias_vida_pedagogico'];
        						$model->idiomas_pedagogico					=$record['idiomas_pedagogico'];
        						$model->tecnologia_pedagogico				=$record['tecnologia_pedagogico'];
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





