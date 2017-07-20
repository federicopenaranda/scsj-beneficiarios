<?php
/**
 * Estas son la accion para el controlador "Parentesco".
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
		$model=new Parentesco();
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
        					$error.= (!isset($record['fk_id_beneficiario'])) ? "Variable indefinida {fk_id_beneficiario}" : "";
        					$error.= (!isset($record['fk_id_beneficiario1'])) ? "Variable indefinida {fk_id_beneficiario1}" : "";
        					$error.= (!isset($record['responsable_beneficiario'])) ? "Variable indefinida {responsable_beneficiario}" : "";
        					$error.= (!isset($record['Fk_id_beneficiario'])) ? "Variable indefinida {fk_id_beneficiario}" : "";
        					$error.= (!isset($record['Fk_id_beneficiario1'])) ? "Variable indefinida {fk_id_beneficiario1}" : "";
							if ($error == "") {
								$model=Parentesco::model()->find(array('condition'=>'fk_id_beneficiario=:fk_id_beneficiario and fk_id_beneficiario1=:fk_id_beneficiario1','params'=>array(':fk_id_beneficiario'=>$records['fk_id_beneficiario'],':fk_id_beneficiario1'=>$records['fk_id_beneficiario1'])));
								if ($model!==null) {
									$model->fk_id_beneficiario=$record['Fk_id_beneficiario'];
									$model->fk_id_beneficiario1=$record['Fk_id_beneficiario1'];
									$model->responsable_beneficiario=$record['responsable_beneficiario'];
		                            if ($model->validate()) {
		                                $model->save();
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
