<?php
/**
 * Estas son la accion para el controlador "AreaConocimientoBiblioteca".
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
		$model=new AreaConocimientoBiblioteca();
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
        					$error.= (!isset($record['id_area_conocimiento_biblioteca'])) ? "Variable indefinida {id_area_conocimiento_biblioteca}" : "";
        					$error.= (!isset($record['nombre_area_conocimiento_biblioteca'])) ? "Variable indefinida {nombre_area_conocimiento_biblioteca}" : "";
        					$error.= (!isset($record['descripcion_area_conocimiento_biblioteca'])) ? "Variable indefinida {descripcion_area_conocimiento_biblioteca}" : "";
        					$error.= (!isset($record['codigo_area_conocimiento_biblioteca'])) ? "Variable indefinida {codigo_area_conocimiento_biblioteca}" : "";
							if ($error == "") {
								$model=AreaConocimientoBiblioteca::model()->findByPk($record['id_area_conocimiento_biblioteca']);							
								$audi=new LogSistema();
								if ($model!==null) {
        							$model->nombre_area_conocimiento_biblioteca=$record['nombre_area_conocimiento_biblioteca'];
        							$model->descripcion_area_conocimiento_biblioteca=$record['descripcion_area_conocimiento_biblioteca'];
        							$model->codigo_area_conocimiento_biblioteca=$record['codigo_area_conocimiento_biblioteca'];
		                            if ($model->validate()) {
		                                $model->save();
                                        $audi->insertAudi("update",$model->tableName(),$record['id_area_conocimiento_biblioteca']);
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
