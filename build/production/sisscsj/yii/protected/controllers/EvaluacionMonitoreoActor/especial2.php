<?php
/**
* Esta clase es llamado por su controlador repectivo y en aqui se definen todas las acciones del controlador
* Es una clase que hereda de CAction
*/ 
class especial2 extends CAction
{
/**
* La funcion run ejecuta la logica de la accion
* Su funcion es la de listar todos los registros de una tabla en la base de datos
* @param array $callback se introduce el nombre de una funcion
*/
	public function run()
	{
		$controller=$this->getController();
		$respuesta=new stdClass();
		if(isset($_GET['callback'])&& $_GET['callback']!=='' && !is_numeric($_GET['callback']) && isset($_GET['id_tipo_monitoreo_actor'])) {
			$callback=$_GET['callback'];
			$id = $_GET['id_tipo_monitoreo_actor'];
			$model=new EvaluacionMonitoreoActor();
			#$r = $model->fcriterio(1);
			#$res = $model->fkCriterio(1);
			$r2= $model->fcriterio2($id);
			
		#$respuesta->meta=array("success"=>"false","msg"=>$json);
		$controller->renderParTial('especial',array('model'=>$r2,'callback'=>$callback));		
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>"Error de callback");
			$controller->renderParTial('especial',array('model'=>$respuesta,'callback'=>''));
		}
	}
}