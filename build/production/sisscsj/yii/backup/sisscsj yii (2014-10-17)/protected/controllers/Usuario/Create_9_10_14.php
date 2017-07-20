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
		$model=new Usuario();
		$respuesta=new stdClass();
		if(isset($_GET['records'])){
			$records=CJSON::decode($_GET['records']);
			
			if(isset($_GET['callback'])&&$_GET['callback']!=='' && !is_numeric($_GET['callback'])){
				$callback=$_GET['callback'];
				
				if(isset($records['fk_id_tipo_usuario']) && isset($records['nombre_usuario']) && isset($records['apellido_usuario']) && isset($records['login_usuario']) && isset($records['password_usuario']) && isset($records['sexo_usuario']) && isset($records['fecha_actualizacion_usuario']) && isset($records['telefono_usuario']) && isset($records['celular_usuario']) && isset($records['correo_usuario']) && isset($records['direccion_usuario']) && isset($records['observacion_usuario']) && true){
					
					if($model->validaFK('tipo_usuario','id_tipo_usuario',$records['fk_id_tipo_usuario'])!==false){	
						$model->fk_id_tipo_usuario=$records['fk_id_tipo_usuario'];
						$model->nombre_usuario=$records['nombre_usuario'];
						$model->apellido_usuario=$records['apellido_usuario'];
						$model->login_usuario=$records['login_usuario'];
						$model->password_usuario=$records['password_usuario'];
						$model->sexo_usuario=$records['sexo_usuario'];
						#$model->fecha_creacion_usuario=$records['fecha_creacion_usuario'];
						$model->fecha_actualizacion_usuario=$records['fecha_actualizacion_usuario'];
						$model->telefono_usuario=$records['telefono_usuario'];
						$model->celular_usuario=$records['celular_usuario'];
						$model->correo_usuario=$records['correo_usuario'];
						$model->direccion_usuario=$records['direccion_usuario'];
						$model->observacion_usuario=$records['observacion_usuario'];
						if ($model->save()) {
							$respuesta->meta=array("success"=>"true","msg"=>"Se creo exitosamente !!!");
							$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));
						} else{
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