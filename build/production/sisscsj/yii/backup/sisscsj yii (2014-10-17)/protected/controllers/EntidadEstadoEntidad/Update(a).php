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
		if(isset($_GET['records'])){
			$records=CJSON::decode($_GET['records']);
			if(isset($_GET['callback'])&&$_GET['callback']!=='' && !is_numeric($_GET['callback'])){
				$callback=$_GET['callback'];			
				if(isset($records['id_entidad_estado_entidad']) && isset($records['fk_id_entidad']) && isset($records['fk_id_estado_entidad']) && isset($records['estado_entidad_estado_entidad']) && isset($records['observaciones_entidad_estado_entidad']) && true){
					if($records['estado_entidad_estado_entidad']=='true' || $records['estado_entidad_estado_entidad']===true){
						$records['estado_entidad_estado_entidad']=1;
					}
					if($records['estado_entidad_estado_entidad']=='false' || $records['estado_entidad_estado_entidad']===false){
						$records['estado_entidad_estado_entidad']=0;
					}
					$model=EntidadEstadoEntidad::model()->findByPk($records['id_entidad_estado_entidad']);
					if($model!==null){
						if($model->validaFK('entidad','id_entidad',$records['fk_id_entidad'])!==false && $model->validaFK('estado_entidad','id_estado_entidad',$records['fk_id_estado_entidad'])!==false){
							$model->fk_id_entidad=$records['fk_id_entidad'];
							$model->fk_id_estado_entidad=$records['fk_id_estado_entidad'];
							#$model->fecha_creacion_estado_entidad=$records['fecha_creacion_estado_entidad'];
							$model->estado_entidad_estado_entidad=$records['estado_entidad_estado_entidad'];
							$model->observaciones_entidad_estado_entidad=$records['observaciones_entidad_estado_entidad'];
							if($model->save()){
								$respuesta->meta=array("success"=>"true","msg"=>"Fue actualizado exitosamente !!!");
								$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
							}else{
								$respuesta->meta=array("success"=>"false","msg"=>$model->getErrors());
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
		}
	}
}
?>