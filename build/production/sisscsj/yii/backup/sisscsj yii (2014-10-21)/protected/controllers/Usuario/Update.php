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
				if (isset($records['id_usuario']) && 
					isset($records['fk_id_tipo_usuario']) && 
					isset($records['nombre_usuario']) && 
					isset($records['apellido_usuario']) && 
					isset($records['login_usuario']) && 
					isset($records['password_usuario']) && 
					isset($records['sexo_usuario']) && 
					isset($records['telefono_usuario']) && 
					isset($records['celular_usuario']) && 
					isset($records['correo_usuario']) && 
					isset($records['direccion_usuario']) && 
					isset($records['observacion_usuario'])
				) {
					$model=Usuario::model()->findByPk($records['id_usuario']);
					if($model!==null){
						if($model->validaFK('tipo_usuario','id_tipo_usuario',$records['fk_id_tipo_usuario'])!==false){
							$model->fk_id_tipo_usuario=$records['fk_id_tipo_usuario'];
							$model->nombre_usuario=$records['nombre_usuario'];
							$model->apellido_usuario=$records['apellido_usuario'];
							$model->login_usuario=$records['login_usuario'];
							if($records['password_usuario']!==""){
								$model->password_usuario=sha1($records['password_usuario']);
							}
							$model->sexo_usuario=$records['sexo_usuario'];
							#$model->fecha_creacion_usuario=$records['fecha_creacion_usuario'];
							$model->fecha_actualizacion_usuario= date('Y-m-d H:i:s');
							$model->telefono_usuario=$records['telefono_usuario'];
							$model->celular_usuario=$records['celular_usuario'];
							$model->correo_usuario=$records['correo_usuario'];
							$model->direccion_usuario=$records['direccion_usuario'];
							$model->observacion_usuario=$records['observacion_usuario'];
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