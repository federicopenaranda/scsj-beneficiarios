<?php
/**
 * Estas son la accion para el controlador "UsuarioBeneficiario".
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
		$model=new UsuarioBeneficiario();
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
        					$error.= (!isset($record['id_usuario_beneficiario'])) ? "Variable indefinida {id_usuario_beneficiario}" : "";
        					$error.= (!isset($record['fk_id_usuario'])) ? "Variable indefinida {fk_id_usuario}" : "";
        					$error.= (!isset($record['fk_id_gestion_beneficiario'])) ? "Variable indefinida {fk_id_gestion_beneficiario}" : "";
        					$error.= (!isset($record['estado_usuario_beneficiario'])) ? "Variable indefinida {estado_usuario_beneficiario}" : "";
							if ($error == "") {
								$model=UsuarioBeneficiario::model()->findByPk($record['id_usuario_beneficiario']);
                                $audi=new LogSistema();
								if ($model!==null) {
									$model->id_usuario_beneficiario=$record['id_usuario_beneficiario'];
									$model->fk_id_usuario=$record['fk_id_usuario'];
									$model->fk_id_gestion_beneficiario=$record['fk_id_gestion_beneficiario'];
									$model->fecha_asignacion_usuario_beneficiario=$record['fecha_asignacion_usuario_beneficiario'];
									$model->estado_usuario_beneficiario=$record['estado_usuario_beneficiario'];
		                            if ($model->validate()) {
		                                $model->save();
                                        $audi->insertAudi("update",$model->tableName(),$record['id_usuario_beneficiario']);
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
