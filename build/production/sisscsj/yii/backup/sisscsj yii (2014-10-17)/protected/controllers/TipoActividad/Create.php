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
		$model=new TipoActividad();
		$respuesta=new stdClass();
		if (isset($_GET['records'])){
			$records=CJSON::decode($_GET['records']);
			
			if (isset($_GET['callback'])&&$_GET['callback']!=='' && !is_numeric($_GET['callback'])){
				$callback=$_GET['callback'];
				
				if (isset($records['nombre_tipo_actividad']) && isset($records['descripcion_tipo_actividad'])){
					$model->nombre_tipo_actividad=$records['nombre_tipo_actividad'];
					$model->descripcion_tipo_actividad=$records['descripcion_tipo_actividad'];
					
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