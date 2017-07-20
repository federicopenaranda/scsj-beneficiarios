<?php
/**
 * Estas son la accion para el controlador "BeneficiarioPatrocinador".
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
		$model=new BeneficiarioPatrocinador();
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
                    $model=new BeneficiarioPatrocinador();
                    $audi=new LogSistema();
                    
                    if (json_last_error() === JSON_ERROR_NONE) {
                    	try{
        					$error.= (!isset($record['fk_id_beneficiario'])) ? "Variable indefinida {fk_id_beneficiario}" : "";
        					$error.= (!isset($record['numero_caso_beneficiario_patrocinador'])) ? "Variable indefinida {numero_caso_beneficiario_patrocinador}" : "";
        					$error.= (!isset($record['numero_ninio_beneficiario_patrocinador'])) ? "Variable indefinida {numero_ninio_beneficiario_patrocinador}" : "";
        					$error.= (!isset($record['codigo_donante_beneficiario_patrocinador'])) ? "Variable indefinida {codigo_donante_beneficiario_patrocinador}" : "";
        					$error.= (!isset($record['nombre_patrocinador_beneficiario_patrocinador'])) ? "Variable indefinida {nombre_patrocinador_beneficiario_patrocinador}" : "";
							if ($error=="") {
        						$model->fk_id_beneficiario=$record['fk_id_beneficiario'];
        						$model->numero_caso_beneficiario_patrocinador=$record['numero_caso_beneficiario_patrocinador'];
        						$model->numero_ninio_beneficiario_patrocinador=$record['numero_ninio_beneficiario_patrocinador'];
        						$model->codigo_donante_beneficiario_patrocinador=$record['codigo_donante_beneficiario_patrocinador'];
        						$model->nombre_patrocinador_beneficiario_patrocinador=$record['nombre_patrocinador_beneficiario_patrocinador'];
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





