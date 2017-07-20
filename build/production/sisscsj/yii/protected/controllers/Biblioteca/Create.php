<?php
/**
 * Estas son la accion para el controlador "Biblioteca".
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
		$model=new Biblioteca();
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
                    $model=new Biblioteca();
                    $audi=new LogSistema();
                    
                    if (json_last_error() === JSON_ERROR_NONE) {
                    	try{
        					$error.= (!isset($record['fk_id_area_cononcimiento_biblioteca'])) ? "Variable indefinida {fk_id_area_cononcimiento_biblioteca}" : "";
        					$error.= (!isset($record['fk_id_curso'])) ? "Variable indefinida {fk_id_curso}" : "";
        					$error.= (!isset($record['fk_id_nivel'])) ? "Variable indefinida {fk_id_nivel}" : "";
        					$error.= (!isset($record['fk_id_turno'])) ? "Variable indefinida {fk_id_turno}" : "";
        					$error.= (!isset($record['tipo_usuario_biblioteca'])) ? "Variable indefinida {tipo_usuario_biblioteca}" : "";
        					$error.= (!isset($record['sexo_usuario_biblioteca'])) ? "Variable indefinida {sexo_usuario_biblioteca}" : "";
        					$error.= (!isset($record['fecha_consulta_biblioteca'])) ? "Variable indefinida {fecha_consulta_biblioteca}" : "";
        					$error.= (!isset($record['observaciones_biblioteca'])) ? "Variable indefinida {observaciones_biblioteca}" : "";
							if ($error=="") {
        						$model->fk_id_usuario=Yii::app()->user->getId();
        						$model->fk_id_area_cononcimiento_biblioteca=$record['fk_id_area_cononcimiento_biblioteca'];
        						$model->fk_id_curso=$record['fk_id_curso'];
        						$model->fk_id_nivel=$record['fk_id_nivel'];
        						$model->fk_id_turno=$record['fk_id_turno'];
        						$model->tipo_usuario_biblioteca=$record['tipo_usuario_biblioteca'];
        						$model->sexo_usuario_biblioteca=$record['sexo_usuario_biblioteca'];
        						$model->fecha_consulta_biblioteca=$record['fecha_consulta_biblioteca'];
        						$model->observaciones_biblioteca=$record['observaciones_biblioteca'];
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





