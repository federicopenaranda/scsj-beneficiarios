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
		$model=new AtencionMedicaEnfermedadComun();
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
        				$error.= (!isset($record['fk_id_enfermedad_comun'])) ? "Variable indefinida {fk_id_enfermedad_comun}" : "";
        				$error.= (!isset($record['fk_id_atencion_medica'])) ? "Variable indefinida {fk_id_atencion_medica}" : "";
						if ($error == "") {
							$model=AtencionMedicaEnfermedadComun::model()->deleteAll(array('condition'=>'fk_id_enfermedad_comun=:fk_id_enfermedad_comun and fk_id_atencion_medica=:fk_id_atencion_medica','params'=>array(':fk_id_enfermedad_comun'=>$record['fk_id_enfermedad_comun'],':fk_id_atencion_medica'=>$record['fk_id_atencion_medica'])));
							$audi=new LogSistema();

	                		if ($model==1) {
								$audi->insertAudi("delete",AtencionMedicaEnfermedadComun::model()->tableName(),"");
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
