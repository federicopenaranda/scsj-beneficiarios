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
			if(isset($_GET['limit']) && $_GET['limit']>0 && is_numeric($_GET['limit'])&&isset($_GET['start']) && $_GET['start']>=0 && $_GET['start']<=$_GET['limit'] && isset($_GET['start'])&& is_numeric($_GET['start'])){
				$model=new Parentesco();
				$error="";
				try {
					if(isset($_GET['filter']) && $_GET['filter']!=''){
						$filtro=CJSON::decode($_GET['filter']);
						if(isset($_GET['sort']) && $_GET['sort']!=''){		
							$sort=CJSON::decode($_GET['sort']);
							$condisort=$sort[0]['property'];
							$valorsort=$sort[0]['direction'];
							foreach ($filtro as $parametro) {
								$condicion=$parametro['property'];
								$valor=$parametro['value'];
									$modelo=$model::model()->with('fkIdBeneficiario','fkIdBeneficiario1')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();
							}	
						}else{
							foreach ($filtro as $parametro) {
								$condicion=$parametro['property'];
								$valor=$parametro['value'];
									$modelo=$model::model()->with('fkIdBeneficiario','fkIdBeneficiario1')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->findAll();
							}
						}
						$total="".sizeof($modelo);	
					}else{
						if(isset($_GET['sort']) && $_GET['sort']!=''){
							$sort=CJSON::decode($_GET['sort']);
							$condisort=$sort[0]['property'];
							$valorsort=$sort[0]['direction'];	
							$modelo=$model::model()->with('fkIdBeneficiario','fkIdBeneficiario1')->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();		
						}else{
							$modelo=$model::model()->with('fkIdBeneficiario','fkIdBeneficiario1')->pagina($_GET['limit'],$_GET['start'])->findAll();
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
						$aux['fk_id_beneficiario']=$staff->fk_id_beneficiario;
						$aux['fk_id_beneficiario1']=$staff->fk_id_beneficiario1;
						$aux['responsable_beneficiario']=$staff->responsable_beneficiario;
						//***********************************************************
						$aux['id_beneficiario']=$staff->fkIdBeneficiario->id_beneficiario;
						$aux['fk_id_religion']=$staff->fkIdBeneficiario->fk_id_religion;
						$aux['fk_id_entidad_salud']=$staff->fkIdBeneficiario->fk_id_entidad_salud;
						$aux['fk_id_escolaridad']=$staff->fkIdBeneficiario->fk_id_escolaridad;
						$aux['codigo_beneficiario']=$staff->fkIdBeneficiario->codigo_beneficiario;
						$aux['numero_identificacion_beneficiario']=$staff->fkIdBeneficiario->numero_identificacion_beneficiario;
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
						//**********************************************************
						$aux['id_beneficiario']=$staff->fkIdBeneficiario1->id_beneficiario;
						$aux['fk_id_religion']=$staff->fkIdBeneficiario1->fk_id_religion;
						$aux['fk_id_entidad_salud']=$staff->fkIdBeneficiario1->fk_id_entidad_salud;
						$aux['fk_id_escolaridad']=$staff->fkIdBeneficiario1->fk_id_escolaridad;
						$aux['codigo_beneficiario']=$staff->fkIdBeneficiario1->codigo_beneficiario;
						$aux['numero_identificacion_beneficiario']=$staff->fkIdBeneficiario1->numero_identificacion_beneficiario;
						$aux['primer_nombre_beneficiario']=$staff->fkIdBeneficiario1->primer_nombre_beneficiario;
						$aux['segundo_nombre_beneficiario']=$staff->fkIdBeneficiario1->segundo_nombre_beneficiario;
						$aux['apellido_paterno_beneficiario']=$staff->fkIdBeneficiario1->apellido_paterno_beneficiario;
						$aux['apellido_materno_beneficiario']=$staff->fkIdBeneficiario1->apellido_materno_beneficiario;
						$aux['fecha_nacimiento_beneficiario']=$staff->fkIdBeneficiario1->fecha_nacimiento_beneficiario;
						$aux['sexo_beneficiario']=$staff->fkIdBeneficiario1->sexo_beneficiario;
						$aux['numero_hijo_beneficiario']=$staff->fkIdBeneficiario1->numero_hijo_beneficiario;
						$aux['fotografia_beneficiario']=$staff->fkIdBeneficiario1->fotografia_beneficiario;
						$aux['observacion_beneficiario']=$staff->fkIdBeneficiario1->observacion_beneficiario;
						$aux['trabaja_beneficiario']=$staff->fkIdBeneficiario1->trabaja_beneficiario;
						$aux['carnet_de_salud_beneficiario']=$staff->fkIdBeneficiario1->carnet_de_salud_beneficiario;
						$aux['libreta_escolar_beneficiario']=$staff->fkIdBeneficiario1->libreta_escolar_beneficiario;
						$aux['informacion_relevante_beneficiario']=$staff->fkIdBeneficiario1->informacion_relevante_beneficiario;
						$aux['fecha_creacion_beneficiario']=$staff->fkIdBeneficiario1->fecha_creacion_beneficiario;
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