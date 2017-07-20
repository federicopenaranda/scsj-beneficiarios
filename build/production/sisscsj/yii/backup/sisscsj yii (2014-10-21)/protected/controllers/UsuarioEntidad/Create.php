<?php
/**
* Esta clase es llamado por su controlador repectivo y en aqui se definen todas las acciones del controlador
* Es una clase que hereda sus propiedad y metodos de la clase padre CAtion
*/ 
class Create extends CAction{
/**
* La funcion run ejecuta la logica de la accion
* Su funcion es la de crear un nuevo registro y adicionarlo en una tabla
* @param array $callback se introduce el nombre de una funcion
*/
   public function run(){
		$controller=$this->getController();
		$model=new UsuarioEntidad();
		$respuesta=new stdClass();
		if(isset($_GET['records'])){
			$records=CJSON::decode($_GET['records']);
			
			if (isset($_GET['callback'])&&$_GET['callback']!=='' && !is_numeric($_GET['callback'])){
				$callback=$_GET['callback'];
				
				if (isset($records['fk_id_usuario']) && isset($records['fk_id_entidad']) && isset($records['fecha_registro_usuario_entidad']) && isset($records['estado_usuario_entidad'])){
					
					if ($records['estado_usuario_entidad']=='true' || $records['estado_usuario_entidad']===true){
						$records['estado_usuario_entidad']=1;
					}
					if ($records['estado_usuario_entidad']=='false' || $records['estado_usuario_entidad']===false){
						$records['estado_usuario_entidad']=0;
					}
					if ($model->validaFK('entidad','id_entidad',$records['fk_id_entidad'])!==false && $model->validaFK('usuario','id_usuario',$records['fk_id_usuario'])!==false){
						$model->fk_id_usuario=$records['fk_id_usuario'];
						$model->fk_id_entidad=$records['fk_id_entidad'];
						$model->fecha_registro_usuario_entidad=$records['fecha_registro_usuario_entidad'];
						$model->estado_usuario_entidad=$records['estado_usuario_entidad'];
						#$model->fecha_creacion_usuario_entidad=$records['fecha_creacion_usuario_entidad'];
						if ($model->save()){
							$respuesta->meta=array("success"=>"true","msg"=>"Se creo exitosamente !!!");
							$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));
						} else {
							$respuesta->meta=array("success"=>"false","msg"=>$model->getErrors());
							$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));						
						}
					} else {
						$respuesta->meta=array("success"=>"false","msg"=>"Error llave foranea");
						$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>$callback));
					}
				} else {
					$respuesta->meta=array("success"=>"false","msg"=>"Campos invalidos");
					$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>$callback));
				}
			} else {
				$respuesta->meta=array("success"=>"false","msg"=>"Error de callback");
				$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
			}
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>"Error variable indefinida quizas quiso decir records");
			$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
		}
	}
}