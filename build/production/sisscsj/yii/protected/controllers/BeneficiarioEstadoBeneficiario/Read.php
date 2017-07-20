<?php
/**
* Esta clase es llamado por su controlador repectivo y en aqui se definen todas las acciones del controlador
* Es una clase que hereda de CAction
*/ 
class Read extends CAction
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
			
			$model=new BeneficiarioEstadoBeneficiario();
			$condi="";
			$contFil=1;
			if(isset($_GET['filter']) && $_GET['filter']!=''){
				$filtro=CJSON::decode($_GET['filter']);
				if(isset($_GET['sort']) && $_GET['sort']!=''){		
					$sort=CJSON::decode($_GET['sort']);
					$condisort=$sort[0]['property'];
					$valorsort=$sort[0]['direction'];
					foreach ($filtro as $parametro) {
						$condicion=$parametro['property'];
						$valor=$parametro['value'];
						if($condicion=="fk_id_beneficiario")
							$condi.= $contFil!=sizeof($filtro) ? $condicion." = ".$valor." AND " :  $condicion." = ".$valor;	
						else	
							$condi.= $contFil!=sizeof($filtro) ? $condicion." LIKE '%".$valor."%' AND " :  $condicion." LIKE '%".$valor."%'";	
						$contFil++;
					}
					$modelo=$model::model()->with('fkIdBeneficiario','fkIdEstadoBeneficiario','fkIdBeneficiarioTipo','fkIdEdadesBeneficiario','fkIdTipoActorBeneficiario')->findAll(array("condition"=>$condi,"order"=>$condisort." ".$valorsort,'limit'=>$_GET['limit'],'offset'=>$_GET['start']));	
				} else {
					foreach ($filtro as $parametro) {
						$condicion=$parametro['property'];
						$valor=$parametro['value'];
						if($condicion == "fk_id_beneficiario")
							$condi.= $contFil!=sizeof($filtro) ? $condicion." = ".$valor." AND " :  $condicion." = ".$valor;	
						else
							$condi.= $contFil!=sizeof($filtro) ? $condicion." LIKE '%".$valor."%' AND " :  $condicion." LIKE '%".$valor."%'";	
						$contFil++;
						/*$condicion=$parametro['property'];
						$valor=$parametro['value'];
						$modelo=$model::model()->with('fkIdBeneficiario','fkIdEstadoBeneficiario','fkIdBeneficiarioTipo','fkIdEdadesBeneficiario','fkIdTipoActorBeneficiario')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->findAll();								*/
					}
					$modelo=$model::model()->with('fkIdBeneficiario','fkIdEstadoBeneficiario','fkIdBeneficiarioTipo','fkIdEdadesBeneficiario','fkIdTipoActorBeneficiario')->pagina($_GET['limit'],$_GET['start'])->findAll($condi);							
				}
				$total="".sizeof($modelo);
			} else {

				if(isset($_GET['sort']) && $_GET['sort']!=''){
					$sort=CJSON::decode($_GET['sort']);
					$condisort=$sort[0]['property'];
					$valorsort=$sort[0]['direction'];	
					$modelo=$model::model()->with('fkIdBeneficiario','fkIdEstadoBeneficiario','fkIdBeneficiarioTipo','fkIdEdadesBeneficiario','fkIdTipoActorBeneficiario')->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();		
				} else {
					$modelo=$model::model()->with('fkIdBeneficiario','fkIdEstadoBeneficiario','fkIdBeneficiarioTipo','fkIdEdadesBeneficiario','fkIdTipoActorBeneficiario')->pagina($_GET['limit'],$_GET['start'])->findAll();
				}
				$total=$model->count();
			}
			$arreglo=array();
			foreach($modelo as $staff){
				$aux=array();
				$aux['id_beneficiario_estado_beneficiario']				=$staff->id_beneficiario_estado_beneficiario;
				$aux['fk_id_estado_beneficiario']						=$staff->fk_id_estado_beneficiario;
				$aux['fk_id_beneficiario']								=$staff->fk_id_beneficiario;
				$aux['fk_id_beneficiario_tipo']							=$staff->fk_id_beneficiario_tipo;
				$aux['fk_id_edades_beneficiario']						=$staff->fk_id_edades_beneficiario;
				$aux['fk_id_tipo_actor_beneficiario']					=$staff->fk_id_tipo_actor_beneficiario;
				$aux['fecha_asignacion_estado_beneficiario']			=$staff->fecha_asignacion_estado_beneficiario;
				$aux['observaciones_beneficiario_estado_beneficiario']	=$staff->observaciones_beneficiario_estado_beneficiario;
				$aux['fecha_creacion_beneficiario_estado_beneficiario']	=$staff->fecha_creacion_beneficiario_estado_beneficiario;
				$aux['modalidad_estado_beneficiario']=$staff->modalidad_estado_beneficiario;
				//***********************************************************
				$aux['id_beneficiario']						=(int)$staff->fkIdBeneficiario->id_beneficiario;
				$aux['fk_id_religion']						=(int)$staff->fkIdBeneficiario->fk_id_religion;
				$aux['fk_id_entidad_salud']					=(int)$staff->fkIdBeneficiario->fk_id_entidad_salud;
				$aux['fk_id_curso']							=(int)$staff->fkIdBeneficiario->fk_id_curso;
				$aux['fk_id_nivel']							=(int)$staff->fkIdBeneficiario->fk_id_nivel;
				$aux['fk_id_turno']							=(int)$staff->fkIdBeneficiario->fk_id_turno;
				$aux['codigo_beneficiario']					=$staff->fkIdBeneficiario->codigo_beneficiario;
				$aux['primer_nombre_beneficiario']			=$staff->fkIdBeneficiario->primer_nombre_beneficiario;
				$aux['segundo_nombre_beneficiario']			=$staff->fkIdBeneficiario->segundo_nombre_beneficiario;
				$aux['apellido_paterno_beneficiario']		=$staff->fkIdBeneficiario->apellido_paterno_beneficiario;
				$aux['apellido_materno_beneficiario']		=$staff->fkIdBeneficiario->apellido_materno_beneficiario;
				$aux['fecha_nacimiento_beneficiario']		=$staff->fkIdBeneficiario->fecha_nacimiento_beneficiario;
				$aux['sexo_beneficiario']					=$staff->fkIdBeneficiario->sexo_beneficiario;
				$aux['numero_hijo_beneficiario']			=$staff->fkIdBeneficiario->numero_hijo_beneficiario;
				$aux['fotografia_beneficiario']				=$staff->fkIdBeneficiario->fotografia_beneficiario;
				$aux['observacion_beneficiario']			=$staff->fkIdBeneficiario->observacion_beneficiario;
				$aux['trabaja_beneficiario']				=$staff->fkIdBeneficiario->trabaja_beneficiario;
				$aux['carnet_de_salud_beneficiario']		=$staff->fkIdBeneficiario->carnet_de_salud_beneficiario;
				$aux['libreta_escolar_beneficiario']		=$staff->fkIdBeneficiario->libreta_escolar_beneficiario;
				$aux['informacion_relevante_beneficiario']	=$staff->fkIdBeneficiario->informacion_relevante_beneficiario;
				$aux['fecha_creacion_beneficiario']			=$staff->fkIdBeneficiario->fecha_creacion_beneficiario;
				//**********************************************************
				$aux['id_estado_beneficiario']							=$staff->fkIdEstadoBeneficiario->id_estado_beneficiario;
				$aux['nombre_estado_beneficiario']						=$staff->fkIdEstadoBeneficiario->nombre_estado_beneficiario;
				$aux['descripcion_estado_beneficiario']					=$staff->fkIdEstadoBeneficiario->descripcion_estado_beneficiario;
				//**********************************************************
				$aux['id_beneficiario_tipo']							=$staff->fkIdBeneficiarioTipo->id_beneficiario_tipo;
				$aux['nombre_beneficiario_tipo']						=$staff->fkIdBeneficiarioTipo->nombre_beneficiario_tipo;
				$aux['descripcion_beneficiario_tipo']					=$staff->fkIdBeneficiarioTipo->descripcion_beneficiario_tipo;
				//**********************************************************
				$aux['id_edades_beneficiario']							=$staff->fkIdEdadesBeneficiario->id_edades_beneficiario;
				$aux['nombre_edades_beneficiario']						=$staff->fkIdEdadesBeneficiario->nombre_edades_beneficiario;
				$aux['descripcion_edades_beneficiario']					=$staff->fkIdEdadesBeneficiario->descripcion_edades_beneficiario;
				//**********************************************************
				$aux['id_tipo_actor_beneficiario']						=$staff->fkIdTipoActorBeneficiario->id_tipo_actor_beneficiario;
				$aux['nombre_tipo_actor_beneficiario']					=$staff->fkIdTipoActorBeneficiario->nombre_tipo_actor_beneficiario;
				$aux['descripcion_tipo_actor_beneficiario']				=$staff->fkIdTipoActorBeneficiario->descripcion_tipo_actor_beneficiario;		
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
