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
			$model=new EvaluacionMonitoreoActor();
			if (isset($_GET['filter']) && $_GET['filter']!='') {
				$filtro=CJSON::decode($_GET['filter']);
				if(isset($_GET['sort']) && $_GET['sort']!=''){		
					$sort=CJSON::decode($_GET['sort']);
					$condisort=$sort[0]['property'];
					$valorsort=$sort[0]['direction'];
					foreach ($filtro as $parametro) {
						$condicion=$parametro['property'];
						$valor=$parametro['value'];
						$modelo=$model::model()->with('fkIdMonitoreoActor','fkIdCriterioMonitoreoActor','fkIdBeneficiario')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();			
					}
				}else{
					foreach ($filtro as $parametro) {
						$condicion=$parametro['property'];
						$valor=$parametro['value'];
						$modelo=$model::model()->with('fkIdMonitoreoActor','fkIdCriterioMonitoreoActor','fkIdBeneficiario')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->findAll();
					}
				}
				$total="".sizeof($modelo);
			} else {
				
				if (isset($_GET['sort']) && $_GET['sort']!=''){
					$sort=CJSON::decode($_GET['sort']);
					$condisort=$sort[0]['property'];
					$valorsort=$sort[0]['direction'];	
					$modelo=$model::model()->with('fkIdMonitoreoActor','fkIdCriterioMonitoreoActor','fkIdBeneficiario')->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();		
				} else {
					$modelo=$model::model()->with('fkIdMonitoreoActor','fkIdCriterioMonitoreoActor','fkIdBeneficiario')->pagina($_GET['limit'],$_GET['start'])->findAll();
				}
				$total=$model->count();
			}
			$arreglo=array();
			foreach($modelo as $staff){
				$aux=array();
				$aux['id_evaluacion_monitoreo_actor']=$staff->id_evaluacion_monitoreo_actor;
				$aux['fk_id_beneficiario']=$staff->fk_id_beneficiario;
				$aux['fk_id_monitoreo_actor']=$staff->fk_id_monitoreo_actor;
				$aux['fk_id_criterio_monitoreo_actor']=$staff->fk_id_criterio_monitoreo_actor;
				$aux['evaluacion_monitoreo_actor']=$staff->evaluacion_monitoreo_actor;
				//***********************************************************
				$aux['id_monitoreo_actor']=$staff->fkIdMonitoreoActor->id_monitoreo_actor;
				$aux['fk_id_usuario']=$staff->fkIdMonitoreoActor->fk_id_usuario;
				$aux['fk_id_tipo_monitoreo_actor']=$staff->fkIdMonitoreoActor->fk_id_tipo_monitoreo_actor;
				$aux['fecha_monitoreo_actor']=$staff->fkIdMonitoreoActor->fecha_monitoreo_actor;
				$aux['analisis_monitoreo_actor']=$staff->fkIdMonitoreoActor->analisis_monitoreo_actor;
				//**********************************************************
				$aux['id_criterio_monitoreo_actor']=$staff->fkIdCriterioMonitoreoActor->id_criterio_monitoreo_actor;
				$aux['fk_id_competencia_monitoreo_actor']=$staff->fkIdCriterioMonitoreoActor->fk_id_competencia_monitoreo_actor;
				$aux['nombre_criterio_monitoreo_actor']=$staff->fkIdCriterioMonitoreoActor->nombre_criterio_monitoreo_actor;
				$aux['descripcion_criterio_monitoreo_actor']=$staff->fkIdCriterioMonitoreoActor->descripcion_criterio_monitoreo_actor;
				$aux['estado_criterio_monitoreo_actor']=$staff->fkIdCriterioMonitoreoActor->estado_criterio_monitoreo_actor;
				//**********************************************************
				$aux['id_beneficiario']=$staff->fkIdBeneficiario->id_beneficiario;
				$aux['fk_id_religion']=$staff->fkIdBeneficiario->fk_id_religion;
				$aux['fk_id_entidad_salud']=$staff->fkIdBeneficiario->fk_id_entidad_salud;
				$aux['fk_id_curso']=$staff->fkIdBeneficiario->fk_id_curso;
				$aux['fk_id_nivel']=$staff->fkIdBeneficiario->fk_id_nivel;
				$aux['fk_id_turno']=$staff->fkIdBeneficiario->fk_id_turno;
				$aux['codigo_beneficiario']=$staff->fkIdBeneficiario->codigo_beneficiario;
				$aux['primer_nombre_beneficiario']=$staff->fkIdBeneficiario->primer_nombre_beneficiario;
				$aux['segundo_nombre_beneficiario']=$staff->fkIdBeneficiario->segundo_nombre_beneficiario;
				$aux['apellido_paterno_beneficiario']=$staff->fkIdBeneficiario->apellido_paterno_beneficiario;
				$aux['apellido_materno_beneficiario']=$staff->fkIdBeneficiario->apellido_materno_beneficiario;
				$aux['fecha_nacimiento_beneficiario']=$staff->fkIdBeneficiario->fecha_nacimiento_beneficiario;
				$aux['sexo_beneficiario']=$staff->fkIdBeneficiario->sexo_beneficiario;
				$aux['numero_hijo_beneficiario']=$staff->fkIdBeneficiario->numero_hijo_beneficiario;
				$aux['fotografia_beneficiario']=$staff->fkIdBeneficiario->fotografia_beneficiario;
				$aux['observacion_beneficiario']=$staff->fkIdBeneficiario->observacion_beneficiario;
				$aux['trabaja_beneficiario']=$staff->fkIdBeneficiario->trabaja_beneficiario;
				$aux['carnet_de_salud_beneficiario']=$staff->fkIdBeneficiario->carnet_de_salud_beneficiario;
				$aux['libreta_escolar_beneficiario']=$staff->fkIdBeneficiario->libreta_escolar_beneficiario;
				$aux['informacion_relevante_beneficiario']=$staff->fkIdBeneficiario->informacion_relevante_beneficiario;
				$aux['fecha_creacion_beneficiario']=$staff->fkIdBeneficiario->fecha_creacion_beneficiario;
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
