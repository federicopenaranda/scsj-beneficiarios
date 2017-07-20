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
		$model=new FamiliaDireccion();
		$respuesta=new stdClass();
		if (isset($_GET['records'])){
			$records=CJSON::decode($_GET['records']);
			
			if (isset($_GET['callback']) && $_GET['callback']!=='' && !is_numeric($_GET['callback'])){
				$callback=$_GET['callback'];
				
				if (isset($records['fk_id_sector']) && 
					isset($records['fk_id_familia']) && 
					isset($records['direccion_familia_direccion']) && 
					isset($records['estado_familia_direccion'])
					) {
					
					if ($records['estado_familia_direccion']=='true' || $records['estado_familia_direccion']===true){
						$records['estado_familia_direccion']=1;
					}
					if ($records['estado_familia_direccion']=='false' || $records['estado_familia_direccion']===false){
						$records['estado_familia_direccion']=0;
					}
					if ($model->validaFK('familia','id_familia',$records['fk_id_familia'])!==false && $model->validaFK('sector','id_sector',$records['fk_id_sector'])!==false){
						$model->fk_id_sector=$records['fk_id_sector'];
						$model->fk_id_familia=$records['fk_id_familia'];
						$model->direccion_familia_direccion=$records['direccion_familia_direccion'];
						#$model->fecha_creacion_famillia_direccion=$records['fecha_creacion_famillia_direccion'];
						$model->estado_familia_direccion=$records['estado_familia_direccion'];
						if ($model->save()) {
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