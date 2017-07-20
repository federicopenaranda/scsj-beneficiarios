<?php
/**
 * Estas son la accion para el controlador "BeneficiarioFamilia".
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
		$model=new BeneficiarioFamilia();
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
                    $model=new BeneficiarioFamilia();
                    
                    if (json_last_error() === JSON_ERROR_NONE) {
                    	try{
        					$error.= (!isset($record['fk_id_beneficiario'])) ? "Variable indefinida {fk_id_beneficiario}" : "";
        					$error.= (!isset($record['fk_id_familia'])) ? "Variable indefinida {fk_id_familia}" : "";
        					$error.= (!isset($record['fk_id_tipo_parentesco'])) ? "Variable indefinida {fk_id_tipo_parentesco}" : "";
        					$error.= (!isset($record['vive_casa_beneficiario_familia'])) ? "Variable indefinida {vive_casa_beneficiario_familia}" : "";
        					$error.= (!isset($record['estado_beneficiario_familia'])) ? "Variable indefinida {estado_beneficiario_familia}" : "";
							if ($error=="") {
        						$model->fk_id_beneficiario=$record['fk_id_beneficiario'];
        						$model->fk_id_familia=$record['fk_id_familia'];
        						$model->fk_id_tipo_parentesco=$record['fk_id_tipo_parentesco'];
        						$model->vive_casa_beneficiario_familia=$record['vive_casa_beneficiario_familia'];
        						$model->estado_beneficiario_familia=$record['estado_beneficiario_familia'];
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




