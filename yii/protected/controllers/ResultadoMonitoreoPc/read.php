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
		$sw=0;
        if ($error == "") {
			$callback=$_GET['callback'];
			$model=new ResultadoMonitoreoPc();
			try {
				if (isset($_GET['sort']) && $_GET['sort']!=''){ 
					$sort = CJSON::decode($_GET['sort']);
					$condisort=$sort[0]['property'];
					$valorsort=$sort[0]['direction'];
				} else {
					$condisort="id_resultado_monitoreo_pc";
					$valorsort="ASC";
				}
				$listRelation = array ("estado_ambito_monitoreo_pc"=>"ambito_monitoreo_pc",
										"fk_id_monitoreo_punto_comunitario"=>"resultado_monitoreo_pc",
									);
				if (isset($_GET['filter']) && $_GET['filter']!='') {

					$filtro=CJSON::decode($_GET['filter']);
					$condi = "";
					$contFil=1;
					foreach ($filtro as $parametro):
		
						if (in_array($parametro['property'],array_keys($listRelation))) {
							$sw = 1;
							if ($parametro['property'] == "estado_ambito_monitoreo_pc") {
								$arreglo=$model->ambitopc($_GET['start'],$_GET['limit'],"ambito_monitoreo_pc.".$parametro['property']." = ".$parametro['value'],"resultado_monitoreo_pc.".$condisort,$valorsort);									
							} else {
								$arreglo=$model->ambitopc($_GET['start'],$_GET['limit'],"resultado_monitoreo_pc.".$parametro['property']." = ".$parametro['value'],"resultado_monitoreo_pc.".$condisort,$valorsort);	
							}
							
						} else {
							if ($contFil!=count($filtro))
								$condi.=$parametro['property']." LIKE '%".$parametro['value']."%' AND ";
							else {
								$condi.=$parametro['property']." LIKE '%".$parametro['value']."%'";	
							}
							$contFil++;
						}
					endforeach;
					$modelo=$model::model()->findAll(array("condition"=>$condi,"order"=>$condisort." ".$valorsort,"offset"=>$_GET['start'],"limit"=>$_GET['limit']));
					$total=sizeof($modelo);
				} else {
					
					$modelo=$model::model()->findAll(array("order"=>$condisort." ".$valorsort,"offset"=>$_GET['start'],"limit"=>$_GET['limit']));
					$total=$model->count();
				}
				if ($sw==0) {
					$arreglo=array();
					foreach($modelo as $staff){
						$aux=array();
						$aux['id_resultado_monitoreo_pc']=$staff->id_resultado_monitoreo_pc;
						$aux['fk_id_monitoreo_punto_comunitario']=$staff->fk_id_monitoreo_punto_comunitario;
						$aux['fk_id_ambito_monitoreo_pc']=$staff->fk_id_ambito_monitoreo_pc;
						$aux['resultado_monitoreo_pc']=$staff->resultado_monitoreo_pc;
						//***********************************************************
						$aux['id_monitoreo_punto_comunitario']=$staff->fkIdMonitoreoPuntoComunitario->id_monitoreo_punto_comunitario;
						$aux['fk_id_usuario']=$staff->fkIdMonitoreoPuntoComunitario->fk_id_usuario;
						$aux['fk_id_lugar_actividad']=$staff->fkIdMonitoreoPuntoComunitario->fk_id_lugar_actividad;
						$aux['fecha_monitoreo_punto_comunitario']=$staff->fkIdMonitoreoPuntoComunitario->fecha_monitoreo_punto_comunitario;
						$aux['analisis_monitoreo_punto_comunitario']=$staff->fkIdMonitoreoPuntoComunitario->analisis_monitoreo_punto_comunitario;
						//**********************************************************
						$aux['id_ambito_monitoreo_pc']=$staff->fkIdAmbitoMonitoreoPc->id_ambito_monitoreo_pc;
						$aux['fk_id_caracteristica_monitoreo_pc']=$staff->fkIdAmbitoMonitoreoPc->fk_id_caracteristica_monitoreo_pc;
						$aux['nombre_ambito_monitoreo_pc']=$staff->fkIdAmbitoMonitoreoPc->nombre_ambito_monitoreo_pc;
						$aux['indicador_ambito_monitoreo_pc']=$staff->fkIdAmbitoMonitoreoPc->indicador_ambito_monitoreo_pc;
						$aux['estado_ambito_monitoreo_pc']=$staff->fkIdAmbitoMonitoreoPc->estado_ambito_monitoreo_pc;
						$arreglo[]=$aux;
					}
				}
			} catch(Exception $e) {
				$error=$e->getMessage();	
			}
			if ($error=="") {
				$respuesta->registros=$arreglo;	
				$respuesta->total=$total;
				$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>$callback));
			} else {
				$respuesta->meta=array("success"=>"false","msg"=>$error);
				$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>$callback));
			}
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>$error);
			$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>''));
		}
	}
}
