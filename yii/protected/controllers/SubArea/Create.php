<?php
/**
* Esta clase es llamado por su controlador repectivo y en aqui se definen todas las acciones del controlador
* Es una clase que hereda sus propiedad y metodos de la clase padre CAtion
*/ 
class Create extends CAction 
{
/**
* La funcion run ejecuta la logica de la accion
* Su funcion es la de crear un nuevo registro y adicionarlo en una tabla
* @param array $callback se introduce el nombre de una funcion
*/
   public function run() 
   {
		$controller=$this->getController();
		$model=new SubArea();
		$respuesta=new stdClass();
		$audi=new LogSistema();
		if (isset($_GET['records'])) {
			$records=CJSON::decode($_GET['records']);
			
			if (isset($_GET['callback'])&&$_GET['callback']!=='' && !is_numeric($_GET['callback'])){
				$callback=$_GET['callback'];
				
				if (isset($records['fk_id_area_actividad']) && isset($records['nombre_sub_area']) && isset($records['descripcion_sub_area']) && true){
					
					if ($model->validaFK('area_actividad','id_area_actividad',$records['fk_id_area_actividad'])!==false){
						$model->fk_id_area_actividad=$records['fk_id_area_actividad'];
						$model->nombre_sub_area=$records['nombre_sub_area'];
						$model->descripcion_sub_area=$records['descripcion_sub_area'];
						
						if ($model->save()){
							$audi->insertAudi("create",$model->tableName(),$model->getPrimaryKey());
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