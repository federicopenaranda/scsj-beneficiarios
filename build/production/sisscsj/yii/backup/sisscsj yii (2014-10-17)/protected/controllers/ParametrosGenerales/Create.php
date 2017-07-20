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
		$model=new ParametrosGenerales();
		$respuesta=new stdClass();
		if (isset($_GET['records'])) {
			$records=CJSON::decode($_GET['records']);
			
			if (isset($_GET['callback']) && $_GET['callback']!=='' && !is_numeric($_GET['callback'])){
				$callback=$_GET['callback'];
				
				if (isset($records['nombre_parametro']) && isset($records['valor_parametro']) && isset($records['configuracion_parametro']) && isset($records['estado_parametro']) && true){
					
					if ($records['estado_parametro']=='true' || $records['estado_parametro']===true){
						$records['estado_parametro']=1;
					}
					if ($records['estado_parametro']=='false' || $records['estado_parametro']===false){
						$records['estado_parametro']=0;
					}
					$model->nombre_parametro=$records['nombre_parametro'];
					$model->valor_parametro=$records['valor_parametro'];
					$model->configuracion_parametro=$records['configuracion_parametro'];
					$model->estado_parametro=$records['estado_parametro'];
					if ($model->save()){
						$respuesta->meta=array("success"=>"true","msg"=>"Se creo exitosamente !!!");
						$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));
					} else {
						$respuesta->meta=array("success"=>"false","msg"=>$model->getErrors());
						$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));
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