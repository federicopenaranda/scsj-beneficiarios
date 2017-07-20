<?php
/**
* Esta clase es llamado por su controlador repectivo y en aqui se definen todas las acciones del controlador
* Es una clase que hereda de CAction
*/ 
class especial extends CAction
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
		if(isset($_GET['callback'])&& $_GET['callback']!=='' && !is_numeric($_GET['callback']) && isset($_GET['id_tipo_monitoreo_actor'])){
			$callback=$_GET['callback'];
			$id=$_GET['id_tipo_monitoreo_actor'];
			$model=new EvaluacionMonitoreoActor();
			$r = $model->fcriterio($id);
			$res = $model->fkCriterio($id);
			$array[] = ["name"=>"id_evaluacion_monitoreo_actor","type"=>"int"];
			$array[] = ["name"=>"fk_id_beneficiario","type"=>"int"];
			$array[] = ["name"=>"fk_id_monitoreo_actor","type"=>"int"];
			
			foreach($res as $rVal):
				foreach($rVal as $Key => $Val):
					if($Key != "nombre_criterio_monitoreo_actor")
						if($Key != "nombre_competencia_monitoreo_actor")
							$array[]=["name"=>$Key."".$Val,"type"=>"int"];
				endforeach;	
			endforeach;	
			
			$json = array(
				'metaData'=>array('idProperty'=>'id_evaluacion_monitoreo_actor',
									'fields'=> $array,
									'columns'=>$r,
								),
					'success' => true
						);	
		#$respuesta->meta=array("success"=>"false","msg"=>$json);
		$controller->renderParTial('especial',array('model'=>$json,'callback'=>$callback));		
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>"Error de callback");
			$controller->renderParTial('especial',array('model'=>$respuesta,'callback'=>''));
		}
	}
}