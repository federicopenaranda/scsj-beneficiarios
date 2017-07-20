<?php 
/**
* Esta clase es llamado por su controlador repectivo y en aqui se definen todas las acciones del controlador
* Es una clase que hereda sus propiedades y metodos de CAction
*/ 
class Update extends CAction
{
/**
* La funcion run ejecuta la logica de la accion
* Su funcion es la de actualizar todos los registros de una tabla en la base de datos
* @param array $callback se introduce el nombre de una funcion
*/
    public function run(){
		$controller=$this->getController();
		$respuesta=new stdClass();
		$model=new BeneficiarioEstadoBeneficiario();

		if (isset($_GET['callback']) && $_GET['callback']!=='' && !is_numeric($_GET['callback']) && isset($_GET['records'])) {
			$callback=$_GET['callback'];
			$query=explode('&', $_SERVER['QUERY_STRING']);
			$params=array();

			foreach ($query as $value) {
				if (strpos($value,"records")!==FAlSE){
					$str=str_replace('"[', '[',trim(urldecode($value),"recods="));
					$str=str_replace(']"', ']',$str);
					$str=str_replace('\"', '"', $str);
					$params[]=$str;
				} 
			}

			$tam=sizeof($params);
			$contValido=0;
			$error="Error de llave foranea o campo indefinido";

			$transaction=$model->dbConnection->beginTransaction();
			try {
				foreach ($params as $value) {
					
					$records=CJSON::decode(urldecode($value));//{..p1:[{}],p2:[{}]..}
					try {
						if (isset($records['id_beneficiario_estado_beneficiario']) && 
							isset($records['fk_id_estado_beneficiario']) && 
							isset($records['fk_id_beneficiario']) && 
							isset($records['fk_id_beneficiario_tipo']) && 
							isset($records['fk_id_edades_beneficiario']) && 
							isset($records['fk_id_tipo_actor_beneficiario']) && 
							isset($records['fecha_asignacion_estado_beneficiario']) && 
							isset($records['observaciones_beneficiario_estado_beneficiario'])
							) {

							$model=BeneficiarioEstadoBeneficiario::model()->findByPk($records['id_beneficiario_estado_beneficiario']);
							if ($model!==null) {
								$model->fk_id_estado_beneficiario						=$records['fk_id_estado_beneficiario'];
								$model->fk_id_beneficiario 								=$records['fk_id_beneficiario'];
								$model->fk_id_beneficiario_tipo 						=$records['fk_id_beneficiario_tipo'];
								$model->fk_id_edades_beneficiario 						=$records['fk_id_edades_beneficiario'];
								$model->fk_id_tipo_actor_beneficiario 					=$records['fk_id_tipo_actor_beneficiario'];
								$model->fecha_asignacion_estado_beneficiario 			=$records['fecha_asignacion_estado_beneficiario'];
								$model->observaciones_beneficiario_estado_beneficiario 	=$records['observaciones_beneficiario_estado_beneficiario'];
								
								if ($model->validate()) {
									$model->save();
									$contValido++;	
								} else {
									$error=$model->getErrors();	
								}
							} else {
								$error="Registro no encontrado";
							}
						} else {
							$error="Nombre de campos invalidos";
						}//if validacion de campos
					} catch(Exception $e){
							//$error=$e->getMessage();	
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
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>"Error de callback");
			$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>''));
		}
		/*if(isset($_GET['records'])){
			$records=CJSON::decode($_GET['records']);
			if(isset($_GET['callback'])&&$_GET['callback']!=='' && !is_numeric($_GET['callback'])){
				$callback=$_GET['callback'];			
				if(isset($records['id_beneficiario_estado_beneficiario']) && isset($records['fk_id_estado_beneficiario']) && isset($records['fk_id_beneficiario']) && isset($records['fk_id_beneficiario_tipo']) && isset($records['fk_id_edades_beneficiario']) && isset($records['fk_id_tipo_actor_beneficiario']) && isset($records['fecha_asignacion_estado_beneficiario']) && isset($records['observaciones_beneficiario_estado_beneficiario']) && true){
					$model=BeneficiarioEstadoBeneficiario::model()->findByPk($records['id_beneficiario_estado_beneficiario']);
					if($model!==null){
						if($model->validaFK('beneficiario','id_beneficiario',$records['fk_id_beneficiario'])!==false && $model->validaFK('beneficiario_tipo','id_beneficiario_tipo',$records['fk_id_beneficiario_tipo'])!==false && $model->validaFK('edades_beneficiario','id_edades_beneficiario',$records['fk_id_edades_beneficiario'])!==false && $model->validaFK('estado_beneficiario','id_estado_beneficiario',$records['fk_id_estado_beneficiario'])!==false && $model->validaFK('tipo_actor_beneficiario','id_tipo_actor_beneficiario',$records['fk_id_tipo_actor_beneficiario'])!==false){
							$model->fk_id_estado_beneficiario=$records['fk_id_estado_beneficiario'];
							$model->fk_id_beneficiario=$records['fk_id_beneficiario'];
							$model->fk_id_beneficiario_tipo=$records['fk_id_beneficiario_tipo'];
							$model->fk_id_edades_beneficiario=$records['fk_id_edades_beneficiario'];
							$model->fk_id_tipo_actor_beneficiario=$records['fk_id_tipo_actor_beneficiario'];
							$model->fecha_asignacion_estado_beneficiario=$records['fecha_asignacion_estado_beneficiario'];
							$model->observaciones_beneficiario_estado_beneficiario=$records['observaciones_beneficiario_estado_beneficiario'];
							#$model->fecha_creacion_beneficiario_estado_beneficiario=$records['fecha_creacion_beneficiario_estado_beneficiario'];
							if($model->save()){
								$respuesta->meta=array("success"=>"true","msg"=>"Fue actualizado exitosamente !!!");
								$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
							}else{
								$respuesta->meta=array("success"=>"false","msg"=>"Dato invalido");
								$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
							}
						}else{
							$respuesta->meta=array("success"=>"false","msg"=>"Error de clave forenea");
							$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
						}
					}else{
						$respuesta->meta=array("success"=>"false","msg"=>"id fuera de rango");
						$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
					}
				}else{
					$respuesta->meta=array("success"=>"false","msg"=>"Campos invalidos");
					$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));		
				}
			}else{
				$respuesta->meta=array("success"=>"false","msg"=>"Error de callback");
				$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>''));
			}
		}else{
			$respuesta->meta=array("success"=>"false","msg"=>"Error de filtrado");
			$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>''));
		}*/
	}
}
?>