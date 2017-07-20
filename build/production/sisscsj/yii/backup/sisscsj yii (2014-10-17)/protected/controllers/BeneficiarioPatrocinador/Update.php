<?php 
/**
* Esta clase es llamado por su controlador repectivo y en aqui se definen todas las acciones del controlador
* Es una clase que hereda sus propiedades y metodos de CAction
*/ 
class Update extends CAction{
/**
* La funcion run ejecuta la logica de la accion
* Su funcion es la de actualizar todos los registros de una tabla en la base de datos
* @param array $callback se introduce el nombre de una funcion
*/
    public function run(){
		$controller=$this->getController();
		$respuesta=new stdClass();
		$model=new BeneficiarioPatrocinador();
		if (isset($_GET['callback']) && $_GET['callback']!=='' && !is_numeric($_GET['callback']) && isset($_GET['records'])) {
			$callback=$_GET['callback'];
			$query=explode('&', $_SERVER['QUERY_STRING']);
			$params=array();

			foreach ($query as $value) {
				if(strpos($value,"records")!==FAlSE){
					$str=str_replace('"[', '[',trim(urldecode($value),"recods="));
					$str=str_replace(']"', ']',$str);
					$str=str_replace('\"', '"', $str);
					$params[]=$str;
				}
			}
			$tam=sizeof($params);
			$contValido=0;
			$error="Error de llave foranea";
			
			$transaction=$model->dbConnection->beginTransaction();
			try {
				foreach ($params as $value) {
					
					$records=CJSON::decode(urldecode($value));
					try{
						if (isset($records['fk_id_beneficiario']) && 
							isset($records['fk_id_patrocinador']) && 
							isset($records['numero_caso_beneficiario_patrocinador']) && 
							isset($records['numero_ninio_beneficiario_patrocinador']) && 
							isset($records['codigo_donante_beneficiario_patrocinador']) && 
							isset($records['Fk_id_beneficiario']) && 
							isset($records['Fk_id_patrocinador'])
							) {
							
							$model=BeneficiarioPatrocinador::model()->find(array('condition'=>'fk_id_beneficiario=:fk_id_beneficiario and fk_id_patrocinador=:fk_id_patrocinador','params'=>array(':fk_id_beneficiario'=>$records['fk_id_beneficiario'],':fk_id_patrocinador'=>$records['fk_id_patrocinador'])));
							if ($model!==null) {	
								
								$model->fk_id_beneficiario=$records['Fk_id_beneficiario'];
								$model->fk_id_patrocinador=$records['Fk_id_patrocinador'];
								$model->numero_caso_beneficiario_patrocinador=$records['numero_caso_beneficiario_patrocinador'];
								$model->numero_ninio_beneficiario_patrocinador=$records['numero_ninio_beneficiario_patrocinador'];
								$model->codigo_donante_beneficiario_patrocinador=$records['codigo_donante_beneficiario_patrocinador'];
	
								if($model->validate()) {
									$model->save();
									$contValido++;

								} else {
									$error=$model->getErrors();
								}
							} else {
								$error="El registro no se pudo encontrar";
							}
						} else {
							$error="Nombre de campos invalidos o indefinidos";
						}//if validacion de campos
					} catch(Exception $e){
							//echo $e->getMessage();
					}
						
				}//foreach
				if ($contValido==$tam) {

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
		} else { //callback
			$respuesta->meta=array("success"=>"false","msg"=>"Error de callback");
			$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
		}
	}
}
?>