<?php
/**
 * Estas son la accion para el controlador "PrivilegiosUsuario".
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
		$model=new PrivilegiosUsuario();
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
        					$error.= (!isset($record['id_privilegios_usuario'])) ? "Variable indefinida {id_privilegios_usuario}" : "";
        					$error.= (!isset($record['nombre_privilegio_usuario'])) ? "Variable indefinida {nombre_privilegio_usuario}" : "";
        					$error.= (!isset($record['accion_privilegio_usuario'])) ? "Variable indefinida {accion_privilegio_usuario}" : "";
        					$error.= (!isset($record['opciones_privilegio_usuario'])) ? "Variable indefinida {opciones_privilegio_usuario}" : "";
        					$error.= (!isset($record['funcion_privilegio_usuario'])) ? "Variable indefinida {funcion_privilegio_usuario}" : "";
        					$error.= (!isset($record['descripcion_privilegios_usuario'])) ? "Variable indefinida {descripcion_privilegios_usuario}" : "";
							if ($error == "") {
								$model=PrivilegiosUsuario::model()->findByPk($record['id_privilegios_usuario']);							
								$audi=new LogSistema();
								if ($model!==null) {
        							$model->nombre_privilegio_usuario=$record['nombre_privilegio_usuario'];
        							$model->accion_privilegio_usuario=$record['accion_privilegio_usuario'];
        							$model->opciones_privilegio_usuario=$record['opciones_privilegio_usuario'];
        							$model->funcion_privilegio_usuario=$record['funcion_privilegio_usuario'];
        							$model->descripcion_privilegios_usuario=$record['descripcion_privilegios_usuario'];
		                            if ($model->validate()) {
		                                $model->save();
                                        $audi->insertAudi("update",$model->tableName(),$record['id_privilegios_usuario']);
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
