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
		$model=new EntidadEstadoEntidad();
		if (isset($_GET['callback']) && $_GET['callback']!=='' && !is_numeric($_GET['callback'])) {
			$callback=$_GET['callback'];
			$query=explode('&', $_SERVER['QUERY_STRING']);
			$params=array();
			
			foreach ($query as $value) {
				if(strpos($value,"records")!==FAlSE)
					$params[]=trim($value,"recods=");
			}
			$tam=sizeof($params);
			$cont=0;
			$err_campo=0;
			$error="";
			$transaction=$model->dbConnection->beginTransaction();
			try {
				foreach ($params as $value) {
					$sw=0;
					$records=CJSON::decode(urldecode($value));

					if (isset($records['id_entidad_estado_entidad']) &&
						isset($records['fk_id_entidad']) && 
						isset($records['fk_id_estado_entidad']) && 
						isset($records['estado_entidad_estado_entidad']) &&
						isset($records['observaciones_entidad_estado_entidad'])
						) {
						$model=EntidadEstadoEntidad::model()->findByPk($records['id_entidad_estado_entidad']);
						if ($model!==null) {
							if ($model->validaFK('entidad','id_entidad',$records['fk_id_entidad'])!==false 
								&& $model->validaFK('estado_entidad','id_estado_entidad',$records['fk_id_estado_entidad'])!==false
							) 
								$sw=1;
							else
								$error="Error de llave foranea";
							if ($records['estado_entidad_estado_entidad']==='true' || $records['estado_entidad_estado_entidad']===TRUE){
						$records['estado_entidad_estado_entidad']=1;
					}
					if ($records['estado_entidad_estado_entidad']==='false' || $records['estado_entidad_estado_entidad']===FALSE){
						$records['estado_entidad_estado_entidad']=0;
					}
							$model->fk_id_entidad=$records['fk_id_entidad'];
							$model->fk_id_estado_entidad=$records['fk_id_estado_entidad'];
							$model->estado_entidad_estado_entidad=$records['estado_entidad_estado_entidad'];
							$model->observaciones_entidad_estado_entidad=$records['observaciones_entidad_estado_entidad'];
						
							try {
								if($model->validate()) {
									$model->save();
									$cont++;
								} else {
									throw new Exception("Error");
								}
							} catch(Exception $e){
								if($e->getMessage()=="Error")
									$error=$model->getErrors();
								else
									$error=$e->getMessage();
							}
						}else{
							$error="id fuera de rango";
						}
					} else {
						$error="Datos invalidos o variable indefinidas";
					}
							
				}//foreach
				if ($cont==$tam && $sw==1) {
					$transaction->commit();
					$respuesta->meta=array("success"=>"true","msg"=>"Fue actualizado exitosamente !!!");
					$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));
				} else {
					$transaction->rollback();
					if ($sw==0) {
						$respuesta->meta=array("success"=>"false","msg"=>$error);
						$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>''));
					} else {
						$respuesta->meta=array("success"=>"false","msg"=>$error);
						$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>''));	
					}
				}

			} catch (Exception $e){
				$transaction->rollback();
				throw $e;
			}
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>"Error de callback");
			$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
		}	
	}
}
?>