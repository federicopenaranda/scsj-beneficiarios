<?php
/**
 * Estas son la accion para el controlador "EvalEduNelsonOrtiz".
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
		$model=new EvalEduNelsonOrtiz();
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
                    $model = new EvalEduNelsonOrtiz();
                    
                    if (json_last_error() === JSON_ERROR_NONE) {
                    	try {
        					$error.= (!isset($record['fk_id_tipo_consulta'])) ? "Variable indefinida {fk_id_tipo_consulta}" : "";
        					$error.= (!isset($record['fk_id_beneficiario'])) ? "Variable indefinida {fk_id_beneficiario}" : "";
        					$error.= (!isset($record['fecha_nelson_ortiz'])) ? "Variable indefinida {fecha_nelson_ortiz}" : "";
        					$error.= (!isset($record['observaciones_nelson_ortiz'])) ? "Variable indefinida {observaciones_nelson_ortiz}" : "";
        					$error.= (!isset($record['motricidad_gruesa_nelson_ortiz'])) ? "Variable indefinida {motricidad_gruesa_nelson_ortiz}" : "";
        					$error.= (!isset($record['audicion_lenguaje_nelson_ortiz'])) ? "Variable indefinida {audicion_lenguaje_nelson_ortiz}" : "";
        					$error.= (!isset($record['motricidad_fina_nelson_ortiz'])) ? "Variable indefinida {motricidad_fina_nelson_ortiz}" : "";
        					$error.= (!isset($record['personal_social_nelson_ortiz'])) ? "Variable indefinida {personal_social_nelson_ortiz}" : "";
        					$error.= (!isset($record['total_nelson_ortiz'])) ? "Variable indefinida {total_nelson_ortiz}" : "";
							if ($error == "") {
        						$model->fk_id_tipo_consulta				=$record['fk_id_tipo_consulta'];
        						$model->fk_id_usuario					=Yii::app()->user->getId();
        						$model->fk_id_beneficiario				=$record['fk_id_beneficiario'];
        						$model->fecha_nelson_ortiz				=$record['fecha_nelson_ortiz'];
        						$model->observaciones_nelson_ortiz		=$record['observaciones_nelson_ortiz'];
        						$model->motricidad_gruesa_nelson_ortiz	=$record['motricidad_gruesa_nelson_ortiz'];
        						$model->audicion_lenguaje_nelson_ortiz	=$record['audicion_lenguaje_nelson_ortiz'];
        						$model->motricidad_fina_nelson_ortiz	=$record['motricidad_fina_nelson_ortiz'];
        						$model->personal_social_nelson_ortiz	=$record['personal_social_nelson_ortiz'];
        						$model->total_nelson_ortiz				=$record['total_nelson_ortiz'];
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




