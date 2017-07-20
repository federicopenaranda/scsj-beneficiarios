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
			$model=new AmbitoMonitoreoPc();
			if (isset($_GET['filter']) && $_GET['filter']!='') {
				$filtro=CJSON::decode($_GET['filter']);
				if (isset($_GET['sort']) && $_GET['sort']!='') {		
					$sort=CJSON::decode($_GET['sort']);
					$condisort=$sort[0]['property'];
					$valorsort=$sort[0]['direction'];
					foreach ($filtro as $parametro) {
						$condicion=$parametro['property'];
						$valor=$parametro['value'];
						if($condicion == "fk_id_caracteristica_monitoreo_pc")
							$modelo=$model::model()->with('fkIdCaracteristicaMonitoreoPc')->filterTextoInt($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();
						else
							$modelo=$model::model()->with('fkIdCaracteristicaMonitoreoPc')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();		
					}
				}else{
					foreach ($filtro as $parametro) {
						$condicion=$parametro['property'];
						$valor=$parametro['value'];
						if($condicion == "fk_id_caracteristica_monitoreo_pc")
							$modelo=$model::model()->with('fkIdCaracteristicaMonitoreoPc')->filterTextoInt($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->findAll();
						else
							$modelo=$model::model()->with('fkIdCaracteristicaMonitoreoPc')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->findAll();
					}
				}
				$total="".sizeof($modelo);
			} else {
				if(isset($_GET['sort']) && $_GET['sort']!=''){
					$sort=CJSON::decode($_GET['sort']);
					$condisort=$sort[0]['property'];
					$valorsort=$sort[0]['direction'];
					$modelo=$model::model()->with('fkIdCaracteristicaMonitoreoPc')->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();
				} else {
					$modelo=$model::model()->with('fkIdCaracteristicaMonitoreoPc')->pagina($_GET['limit'],$_GET['start'])->findAll();
				}
				$total=$model->count();
			}
			$arreglo=array();
			foreach($modelo as $staff){
				$aux=array();
				$aux['id_ambito_monitoreo_pc']=$staff->id_ambito_monitoreo_pc;
				$aux['fk_id_caracteristica_monitoreo_pc']=$staff->fk_id_caracteristica_monitoreo_pc;
				$aux['nombre_ambito_monitoreo_pc']=$staff->nombre_ambito_monitoreo_pc;
				$aux['indicador_ambito_monitoreo_pc']=$staff->indicador_ambito_monitoreo_pc;
				$aux['estado_ambito_monitoreo_pc']=$staff->estado_ambito_monitoreo_pc;
					//***********************************************************
				$aux['id_caracteristica_monitoreo_pc']=$staff->fkIdCaracteristicaMonitoreoPc->id_caracteristica_monitoreo_pc;
				$aux['nombre_caracteristica_monitoreo_pc']=$staff->fkIdCaracteristicaMonitoreoPc->nombre_caracteristica_monitoreo_pc;
				$aux['descripcion_caracteristica_monitoreo_pc']=$staff->fkIdCaracteristicaMonitoreoPc->descripcion_caracteristica_monitoreo_pc;
				$aux2=array();
				foreach($staff->resultadoMonitoreoPcs as $va){
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
