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
				if(isset($records['id_familia']) && isset($records['codigo_familia']) && isset($records['codigo_familia_antiguo']) && isset($records['numero_hijos_viven_familia']) && isset($records['estado_familia']) && true){
					if($records['estado_familia']=='true' || $records['estado_familia']===true){
						$records['estado_familia']=1;
					}
					if($records['estado_familia']=='false' || $records['estado_familia']===false){
						$records['estado_familia']=0;
					}
					$model=Familia::model()->findByPk($records['id_familia']);
					if($model!==null){
						$model->codigo_familia=$records['codigo_familia'];
						$model->codigo_familia_antiguo=$records['codigo_familia_antiguo'];
						$model->numero_hijos_viven_familia=$records['numero_hijos_viven_familia'];
						$model->estado_familia=$records['estado_familia'];
						#$model->fecha_creacion_familia=$records['fecha_creacion_familia'];
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