<?php
/**
* Esta clase es llamado por su controlador repectivo y en aqui se definen todas las acciones del controlador
* Es una clase que hereda de CAction
*/ 
class read extends CAction
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
        $error="";
		$error.= (!isset($_GET['callback'])) ? "{ Error de Callback } " : "";
        $error.= (!isset($_GET['start'])) ? "{ Error de start } " : "";
        $error.= (!isset($_GET['limit'])) ? "{ Error de limit } " : "";
        if ($error == "") {
			$callback=$_GET['callback'];
			$model=new CompetenciaMonitoreoActor();
			if (isset($_GET['filter']) && $_GET['filter']!='') {
				$filtro=CJSON::decode($_GET['filter']);
				if (isset($_GET['sort']) && $_GET['sort']!='') {		
					$sort=CJSON::decode($_GET['sort']);
					$condisort=$sort[0]['property'];
					$valorsort=$sort[0]['direction'];
					foreach ($filtro as $parametro) {
						$condicion=$parametro['property'];
						$valor=$parametro['value'];
						$modelo=$model::model()->with('fkIdTipoMonitoreoActor')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();					
					}
				}else{
					foreach ($filtro as $parametro) {
						$condicion=$parametro['property'];
						$valor=$parametro['value'];
						$modelo=$model::model()->with('fkIdTipoMonitoreoActor')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->findAll();
					}
				}
				$total="".sizeof($modelo);
			} else {
				$modelo = array();

				if(isset($_GET['sort']) && $_GET['sort']!=''){
					$sort=CJSON::decode($_GET['sort']);
					$condisort=$sort[0]['property'];
					$valorsort=$sort[0]['direction'];
					$modelo=$model::model()->with('fkIdTipoMonitoreoActor')->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();
				} else {
					$modelo=$model::model()->with('fkIdTipoMonitoreoActor')->pagina($_GET['limit'],$_GET['start'])->findAll();
				}
				$total=$model->count();
			}
			$arreglo=array();
			foreach($modelo as $staff){
				$aux=array();
				$aux['id_competencia_monitoreo_actor']			=$staff->id_competencia_monitoreo_actor;
				$aux['fk_id_tipo_monitoreo_actor']				=$staff->fk_id_tipo_monitoreo_actor;
				$aux['nombre_competencia_monitoreo_actor']		=$staff->nombre_competencia_monitoreo_actor;
				$aux['descripcion_competencia_monitoreo_actor']	=$staff->descripcion_competencia_monitoreo_actor;
				$aux['estado_competencia_monitoreo_actor']		=$staff->estado_competencia_monitoreo_actor;
					//***********************************************************
				$aux['id_tipo_monitoreo_actor']					=$staff->fkIdTipoMonitoreoActor->id_tipo_monitoreo_actor;
				$aux['nombre_tipo_monitoreo_actor']				=$staff->fkIdTipoMonitoreoActor->nombre_tipo_monitoreo_actor;
				$aux['descripcion_tipo_monitoreo_actor']		=$staff->fkIdTipoMonitoreoActor->descripcion_tipo_monitoreo_actor;
				$aux['estado_tipo_monitoreo_actor']				=$staff->fkIdTipoMonitoreoActor->estado_tipo_monitoreo_actor;
				$aux2=array();
				foreach($staff->criterioMonitoreoActors as $va){
					#$aux2=$va->ATRIBUTO;
				}
				#$aux['ATRIBUTO']=$aux2;
				$arreglo[]=$aux;
			}

			$respuesta->registros=$arreglo;	
			$respuesta->total=$total;
			$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>$callback));
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>$error);
			$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>''));
		}
	}
}
