<?php
/**
* Esta clase es llamado por su controlador repectivo y en aqui se definen todas las acciones del controlador
* Es una clase que hereda de CAction
*/ 
class Read extends CAction{
/**
* La funcion run ejecuta la logica de la accion
* Su funcion es la de listar todos los registros de una tabla en la base de datos
* @param array $callback se introduce el nombre de una funcion
*/
	public function run(){
		$controller=$this->getController();
        $respuesta=new stdClass();

		if(isset($_GET['callback'])&&$_GET['callback']!=='' && !is_numeric($_GET['callback'])){
			$callback=$_GET['callback'];
			
			if (isset($_GET['limit']) && is_numeric($_GET['limit'])&&
				isset($_GET['start']) && $_GET['start']>=0 && is_numeric($_GET['start'])
				){
				$model=new BeneficiarioFamilia();
				$error="";
				try {
					if(isset($_GET['filter']) && $_GET['filter']!=''){
						$filtros=CJSON::decode($_GET['filter']);
						$contFil = 1;
                        $condi="";
						foreach ($filtros as $filtro) {
							if ($filtro['property'] == "fk_id_beneficiario" ||
								$filtro['property'] == "fk_id_familia" ||
								$filtro['property'] == "fk_id_tipo_parentesco" 
								){
								$condi.= $contFil != sizeof($filtros) ? $filtro['property']." = ".$filtro['value']." AND " : $filtro['property']." = ".$filtro['value'];
							}else {
								$condi.= $contFil != sizeof($filtros) ? $filtro['property']." LIKE '%".$filtro['value']."%' AND " : $filtro['property']." LIKE '%".$filtro['value']."%'";			
							}
							$contFil++;
						} //foreach
						
						if (isset($_GET['sort']) && $_GET['sort']!=''){		
							
							$sort=CJSON::decode($_GET['sort']);
							$condisort=$sort[0]['property'];
							$valorsort=$sort[0]['direction'];
							$modelo=$model::model()->with('fkIdBeneficiario','fkIdFamilia','fkIdTipoParentesco')->findAll(array('condition'=>$condi,'order'=>$condisort." ".$valorsort));
							$total="".sizeof($modelo);
							$modelo=$model::model()->with('fkIdBeneficiario','fkIdFamilia','fkIdTipoParentesco')->pagina($_GET['limit'],$_GET['start'])->findAll(array('condition'=>$condi,'order'=>$condisort." ".$valorsort));
							
							/*foreach ($filtro as $parametro) {
								$condicion=$parametro['property'];
								$valor=$parametro['value'];
								if($condition=="fk_id_beneficiario")
									$modelo=$model::model()->with('fkIdBeneficiario','fkIdFamilia','fkIdTipoParentesco')->filterTextoInt($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();
								else
									$modelo=$model::model()->with('fkIdBeneficiario','fkIdFamilia','fkIdTipoParentesco')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();
							}*/
						} else {
							$modelo=$model::model()->with('fkIdBeneficiario')->findAll(array('condition'=>$condi));
							$total="".sizeof($modelo);
							$modelo=$model::model()->with('fkIdBeneficiario')->pagina($_GET['limit'],$_GET['start'])->findAll(array('condition'=>$condi));
							/*foreach ($filtro as $parametro) {
								$condicion=$parametro['property'];
								$valor=$parametro['value'];
								if($condition=="fk_id_beneficiario")
									$modelo=$model::model()->with('fkIdBeneficiario','fkIdFamilia','fkIdTipoParentesco')->filterTextoInt($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->findAll();
								else		
									$modelo=$model::model()->with('fkIdBeneficiario','fkIdFamilia','fkIdTipoParentesco')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->findAll();				
							}*/
						}
						$total="".sizeof($modelo);
					} else {
						if(isset($_GET['sort']) && $_GET['sort']!=''){
							$sort=CJSON::decode($_GET['sort']);
							$condisort=$sort[0]['property'];
							$valorsort=$sort[0]['direction'];	
							$modelo=$model::model()->with('fkIdBeneficiario')->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();		
						}else{
							$modelo=$model::model()->with('fkIdBeneficiario')->pagina($_GET['limit'],$_GET['start'])->findAll();
						}
						$total=$model->count();
					}
				} catch(Exception $e){
					$error=$e;
				}
				if ($error=="") {
					$arreglo=array();
					foreach($modelo as $staff){
						$aux=array();
						$aux['id_beneficiario_familia']				=$staff->id_beneficiario_familia;
						$aux['fk_id_beneficiario']					=$staff->fk_id_beneficiario;
						$aux['fk_id_familia']						=$staff->fk_id_familia;
						$aux['fk_id_tipo_parentesco']				=$staff->fk_id_tipo_parentesco;
						$aux['vive_casa_beneficiario_familia']		=(int)$staff->vive_casa_beneficiario_familia;
						$aux['estado_beneficiario_familia']			=$staff->estado_beneficiario_familia;
						$aux['fecha_creacion_beneficiario_familia']	=$staff->fecha_creacion_beneficiario_familia;
						//***********************************************************
						$aux['id_beneficiario']						=(int)$staff->fkIdBeneficiario->id_beneficiario;
						#$aux['fk_id_religion']						=(int)$staff->fkIdBeneficiario->fk_id_religion;
						#$aux['fk_id_entidad_salud']					=(int)$staff->fkIdBeneficiario->fk_id_entidad_salud;
						#$aux['fk_id_curso']							=(int)$staff->fkIdBeneficiario->fk_id_curso;
						#$aux['fk_id_nivel']							=(int)$staff->fkIdBeneficiario->fk_id_nivel;
						#$aux['fk_id_turno']							=(int)$staff->fkIdBeneficiario->fk_id_turno;
						$aux['codigo_beneficiario']					=$staff->fkIdBeneficiario->codigo_beneficiario;
						$aux['primer_nombre_beneficiario']			=$staff->fkIdBeneficiario->primer_nombre_beneficiario;
						$aux['segundo_nombre_beneficiario']			=$staff->fkIdBeneficiario->segundo_nombre_beneficiario;
						$aux['apellido_paterno_beneficiario']		=$staff->fkIdBeneficiario->apellido_paterno_beneficiario;
						$aux['apellido_materno_beneficiario']		=$staff->fkIdBeneficiario->apellido_materno_beneficiario;
						#$aux['fecha_nacimiento_beneficiario']		=$staff->fkIdBeneficiario->fecha_nacimiento_beneficiario;
						#$aux['sexo_beneficiario']					=$staff->fkIdBeneficiario->sexo_beneficiario;
						#$aux['numero_hijo_beneficiario']			=$staff->fkIdBeneficiario->numero_hijo_beneficiario;
						#$aux['fotografia_beneficiario']				=$staff->fkIdBeneficiario->fotografia_beneficiario;
						#$aux['observacion_beneficiario']			=$staff->fkIdBeneficiario->observacion_beneficiario;
						#$aux['trabaja_beneficiario']				=$staff->fkIdBeneficiario->trabaja_beneficiario;
						#$aux['carnet_de_salud_beneficiario']		=$staff->fkIdBeneficiario->carnet_de_salud_beneficiario;
						#$aux['libreta_escolar_beneficiario']		=$staff->fkIdBeneficiario->libreta_escolar_beneficiario;
						#$aux['informacion_relevante_beneficiario']	=$staff->fkIdBeneficiario->informacion_relevante_beneficiario;
						#$aux['fecha_creacion_beneficiario']			=$staff->fkIdBeneficiario->fecha_creacion_beneficiario;
						//**********************************************************
						#$aux['id_familia']							=$staff->fkIdFamilia->id_familia;
						#$aux['codigo_familia']						=$staff->fkIdFamilia->codigo_familia;
						#$aux['codigo_familia_antiguo']				=$staff->fkIdFamilia->codigo_familia_antiguo;
						#$aux['numero_hijos_viven_familia']			=$staff->fkIdFamilia->numero_hijos_viven_familia;
						#$aux['estado_familia']						=$staff->fkIdFamilia->estado_familia;
						#$aux['fecha_creacion_familia']				=$staff->fkIdFamilia->fecha_creacion_familia;
						//**********************************************************
						#$aux['id_tipo_parentesco']					=$staff->fkIdTipoParentesco->id_tipo_parentesco;
						#$aux['nombre_tipo_parentesco']				=$staff->fkIdTipoParentesco->nombre_tipo_parentesco;
						#$aux['descripcion_tipo_parentesco']			=$staff->fkIdTipoParentesco->descripcion_tipo_parentesco;
						$arreglo[]=$aux;
					}	

					$respuesta->registros=$arreglo;	
					$respuesta->total=$total;
					$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>$callback));
				} else {
					$respuesta->meta=array("success"=>"false","msg"=>$error);
					$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>$callback));
				}
			}else{
				$respuesta->meta=array("success"=>"false","msg"=>"Campos invalidos");
				$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>$callback));
			}
		}else{
			$respuesta->meta=array("success"=>"false","msg"=>"Error de callback");
			$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>''));
		}
	}
}