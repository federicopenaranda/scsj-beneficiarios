<?php
/**
 * Estas son la accion para el controlador "ParametrosGenerales".
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
		$model=new ParametrosGenerales();
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
        					$error.= (!isset($record['id_parametro_general'])) ? "Variable indefinida {id_parametro_general}" : "";
        					$error.= (!isset($record['nombre_parametro'])) ? "Variable indefinida {nombre_parametro}" : "";
        					$error.= (!isset($record['valor_parametro'])) ? "Variable indefinida {valor_parametro}" : "";
        					$error.= (!isset($record['configuracion_parametro'])) ? "Variable indefinida {configuracion_parametro}" : "";
        					$error.= (!isset($record['estado_parametro'])) ? "Variable indefinida {estado_parametro}" : "";
							if ($error == "") {
								$model=ParametrosGenerales::model()->findByPk($record['id_parametro_general']);							
								$audi=new LogSistema();
								if ($model!==null) {
        							$model->nombre_parametro=$record['nombre_parametro'];
        							$model->valor_parametro=$record['valor_parametro'];
        							$model->configuracion_parametro=$record['configuracion_parametro'];
        							$model->estado_parametro=$record['estado_parametro'];
		                            if ($model->validate()) {
		                                $model->save();
                                        $audi->insertAudi("update",$model->tableName(),$record['id_parametro_general']);
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
