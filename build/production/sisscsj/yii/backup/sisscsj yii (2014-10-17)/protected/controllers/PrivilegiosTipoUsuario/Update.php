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
		if(isset($_GET['records'])){
			$records=CJSON::decode($_GET['records']);
			if(isset($_GET['callback'])&&$_GET['callback']!=='' && !is_numeric($_GET['callback'])){
				$callback=$_GET['callback'];			
				if(isset($records['fk_id_privilegios_usuario']) && isset($records['fk_id_tipo_usuario']) && isset($records['estado_privilegio_tipo_usuario']) && isset($records['Fk_id_privilegios_usuario']) && isset($records['Fk_id_tipo_usuario'])){
					if($records['estado_privilegio_tipo_usuario']=='true' || $records['estado_privilegio_tipo_usuario']===true){
						$records['estado_privilegio_tipo_usuario']=1;
					}
					if($records['estado_privilegio_tipo_usuario']=='false' || $records['estado_privilegio_tipo_usuario']===false){
						$records['estado_privilegio_tipo_usuario']=0;
					}
					$model=PrivilegiosTipoUsuario::model()->find(array('condition'=>'fk_id_privilegios_usuario=:fk_id_privilegios_usuario and fk_id_tipo_usuario=:fk_id_tipo_usuario','params'=>array(':fk_id_privilegios_usuario'=>$records['fk_id_privilegios_usuario'],':fk_id_tipo_usuario'=>$records['fk_id_tipo_usuario'])));
					if($model!==null){
						if($model->validaFK('privilegios_usuario','id_privilegios_usuario',$records['fk_id_privilegios_usuario'])!==false && $model->validaFK('tipo_usuario','id_tipo_usuario',$records['fk_id_tipo_usuario'])!==false && $model->validaFK('privilegios_usuario','id_privilegios_usuario',$records['Fk_id_privilegios_usuario'])!==false && $model->validaFK('tipo_usuario','id_tipo_usuario',$records['Fk_id_tipo_usuario'])!==false){
							$model->fk_id_privilegios_usuario=$records['Fk_id_privilegios_usuario'];
							$model->fk_id_tipo_usuario=$records['Fk_id_tipo_usuario'];
							$model->estado_privilegio_tipo_usuario=$records['estado_privilegio_tipo_usuario'];
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