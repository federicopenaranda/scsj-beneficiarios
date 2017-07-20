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
				if(isset($records['id_usuario_entidad']) && isset($records['fk_id_usuario']) && isset($records['fk_id_entidad']) && isset($records['fecha_registro_usuario_entidad']) && isset($records['estado_usuario_entidad']) && true){
					if($records['estado_usuario_entidad']=='true' || $records['estado_usuario_entidad']===true){
						$records['estado_usuario_entidad']=1;
					}
					if($records['estado_usuario_entidad']=='false' || $records['estado_usuario_entidad']===false){
						$records['estado_usuario_entidad']=0;
					}
					$model=UsuarioEntidad::model()->findByPk($records['id_usuario_entidad']);
					if($model!==null){
						if($model->validaFK('entidad','id_entidad',$records['fk_id_entidad'])!==false && $model->validaFK('usuario','id_usuario',$records['fk_id_usuario'])!==false){
							$model->fk_id_usuario=$records['fk_id_usuario'];
							$model->fk_id_entidad=$records['fk_id_entidad'];
							$model->fecha_registro_usuario_entidad=$records['fecha_registro_usuario_entidad'];
							$model->estado_usuario_entidad=$records['estado_usuario_entidad'];
							#$model->fecha_creacion_usuario_entidad=$records['fecha_creacion_usuario_entidad'];
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