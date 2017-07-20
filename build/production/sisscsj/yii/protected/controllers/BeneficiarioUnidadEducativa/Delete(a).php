<?php
/**
* Esta clase es llamado por su controlador repectivo y en aqui se definen todas las acciones del controlador
* Es una clase que hereda sus propiedades y metodos de CAction
*/ 
class Delete extends CAction{
/**
* La funcion run ejecuta la logica de la accion
* Su funcion es la de eliminar un registro de una tabla en la base de datos
* @param array $callback se introduce el nombre de una funcion
*/

	public function run()
    {
		$controller=$this->getController();
		$respuesta=new stdClass();
		$model=new BeneficiarioUnidadEducativa();
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
        				$error.= (!isset($record['fk_id_unidad_educativa'])) ? "Variable indefinida {fk_id_unidad_educativa}" : "";
        				$error.= (!isset($record['fk_id_beneficiario'])) ? "Variable indefinida {fk_id_beneficiario}" : "";
						if ($error == "") {
							$model=BeneficiarioUnidadEducativa::model()->deleteAll(array('condition'=>'fk_id_unidad_educativa=:fk_id_unidad_educativa and fk_id_beneficiario=:fk_id_beneficiario','params'=>array(':fk_id_unidad_educativa'=>$record['fk_id_unidad_educativa'],':fk_id_beneficiario'=>$record['fk_id_beneficiario'])));
							$audi=new LogSistema();

	                		if ($model==1) {
								$audi->insertAudi("delete",BeneficiarioUnidadEducativa::model()->tableName(),"");
	                    		$contValRecords++;
	                    	} else {
								$error="Registro no se pudo eliminar";
							}
						} 
					} else {
                        $error="Error de json";
                    }
                }//foreach
	            if ($contValRecords == $numeroRecords) {
	                $transaction->commit();
					$respuesta->meta=array("success"=>"true","msg"=>"Registro eliminado !!");
					$controller->renderPartial('delete',array('model'=>$respuesta,'callback'=>$callback));
	            } else {
	                $transaction->rollback();
					$respuesta->meta=array("success"=>"false","msg"=>$error);
					$controller->renderParTial('delete',array('model'=>$respuesta,'callback'=>$callback));
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