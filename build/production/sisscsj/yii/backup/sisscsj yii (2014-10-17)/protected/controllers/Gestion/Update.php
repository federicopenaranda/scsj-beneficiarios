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
				if(isset($records['id_gestion']) && isset($records['estado_gestion']) && isset($records['nombre_gestion']) && isset($records['orden_gestion']) && true){
					if($records['estado_gestion']=='true' || $records['estado_gestion']===true){
						$records['estado_gestion']=1;
					}
					if($records['estado_gestion']=='false' || $records['estado_gestion']===false){
						$records['estado_gestion']=0;
					}
					$model=Gestion::model()->findByPk($records['id_gestion']);
					if($model!==null){
						if($records['estado_gestion']===1 || $records['estado_gestion']==='1'){
							$model->updateAll(array('estado_gestion'=>0,'estado_gestion=1'));
						}
						$model->estado_gestion=$records['estado_gestion'];
						$model->nombre_gestion=$records['nombre_gestion'];
						$model->orden_gestion=$records['orden_gestion'];
						if($model->save()){
							$respuesta->meta=array("success"=>"true","msg"=>"Fue actualizado exitosamente !!!");
							$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
						}else{
							$respuesta->meta=array("success"=>"false","msg"=>$model->getErrors());
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