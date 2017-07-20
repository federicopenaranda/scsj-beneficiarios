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
				if(isset($records['id_parametro_general']) && isset($records['nombre_parametro']) && isset($records['valor_parametro']) && isset($records['configuracion_parametro']) && isset($records['estado_parametro']) && true){
					if($records['estado_parametro']=='true' || $records['estado_parametro']===true){
						$records['estado_parametro']=1;
					}
					if($records['estado_parametro']=='false' || $records['estado_parametro']===false){
						$records['estado_parametro']=0;
					}
					$model=ParametrosGenerales::model()->findByPk($records['id_parametro_general']);
					if($model!==null){
						$model->nombre_parametro=$records['nombre_parametro'];
						$model->valor_parametro=$records['valor_parametro'];
						$model->configuracion_parametro=$records['configuracion_parametro'];
						$model->estado_parametro=$records['estado_parametro'];
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