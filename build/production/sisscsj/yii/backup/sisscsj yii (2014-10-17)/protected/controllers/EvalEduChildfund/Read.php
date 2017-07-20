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
				$model=new EvalEduChildfund();
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
								$modelo=$model::model()->with('fkIdTipoConsulta','fkIdUsuario','fkIdBeneficiario')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();	
							}
						}else{
							foreach ($filtro as $parametro) {
								$condicion=$parametro['property'];
								$valor=$parametro['value'];
								$modelo=$model::model()->with('fkIdTipoConsulta','fkIdUsuario','fkIdBeneficiario')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->findAll();					
							}
						}
						$total="".sizeof($modelo);
					}else{
						if(isset($_GET['sort']) && $_GET['sort']!=''){
							$sort=CJSON::decode($_GET['sort']);
							$condisort=$sort[0]['property'];
							$valorsort=$sort[0]['direction'];	
							$modelo=$model::model()->with('fkIdTipoConsulta','fkIdUsuario','fkIdBeneficiario')->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();		
						}else{
							$modelo=$model::model()->with('fkIdTipoConsulta','fkIdUsuario','fkIdBeneficiario')->pagina($_GET['limit'],$_GET['start'])->findAll();
						}
						$total=$model->count();
					}
				} catch (Exception $e) {
						$error=$e;
				}
				if ($error=="") {
					$arreglo=array();
					foreach($modelo as $staff){
						$aux=array();
						$aux['id_childfund']						=(int)$staff->id_childfund;
						$aux['fk_id_tipo_consulta']					=(int)$staff->fk_id_tipo_consulta;
						$aux['fk_id_usuario']						=(int)$staff->fk_id_usuario;
						$aux['fk_id_beneficiario']					=(int)$staff->fk_id_beneficiario;
						$aux['fecha_childfund']						=$staff->fecha_childfund;
						$aux['observaciones_childfund']				=$staff->observaciones_childfund;
						$aux['evaluacion_childfund']				=$staff->evaluacion_childfund;
						$aux['fecha_creacion_eval_edu_childfund']	=$staff->fecha_creacion_eval_edu_childfund;
						//***********************************************************
						$aux['id_tipo_consulta']					=(int)$staff->fkIdTipoConsulta->id_tipo_consulta;
						$aux['nombre_tipo_consulta']				=$staff->fkIdTipoConsulta->nombre_tipo_consulta;
						$aux['descripcion_tipo_consulta']			=$staff->fkIdTipoConsulta->descripcion_tipo_consulta;
						//**********************************************************
						$aux['id_usuario']							=(int)$staff->fkIdUsuario->id_usuario;
						$aux['fk_id_tipo_usuario']					=(int)$staff->fkIdUsuario->fk_id_tipo_usuario;
						$aux['nombre_usuario']						=$staff->fkIdUsuario->nombre_usuario;
						$aux['apellido_usuario']					=$staff->fkIdUsuario->apellido_usuario;
						$aux['login_usuario']						=$staff->fkIdUsuario->login_usuario;
						$aux['password_usuario']					=$staff->fkIdUsuario->password_usuario;
						$aux['sexo_usuario']						=$staff->fkIdUsuario->sexo_usuario;
						$aux['fecha_creacion_usuario']				=$staff->fkIdUsuario->fecha_creacion_usuario;
						$aux['fecha_actualizacion_usuario']			=$staff->fkIdUsuario->fecha_actualizacion_usuario;
						$aux['telefono_usuario']					=$staff->fkIdUsuario->telefono_usuario;
						$aux['celular_usuario']						=$staff->fkIdUsuario->celular_usuario;
						$aux['correo_usuario']						=$staff->fkIdUsuario->correo_usuario;
						$aux['direccion_usuario']					=$staff->fkIdUsuario->direccion_usuario;
						$aux['observacion_usuario']					=$staff->fkIdUsuario->observacion_usuario;
						//**********************************************************
						$aux['id_beneficiario']						=(int)$staff->fkIdBeneficiario->id_beneficiario;
						$aux['fk_id_religion']						=(int)$staff->fkIdBeneficiario->fk_id_religion;
						$aux['fk_id_entidad_salud']					=(int)$staff->fkIdBeneficiario->fk_id_entidad_salud;
						$aux['fk_id_escolaridad']				=(int)$staff->fkIdBeneficiario->fk_id_escolaridad;
						$aux['codigo_beneficiario']					=$staff->fkIdBeneficiario->codigo_beneficiario;
						$aux['numero_identificacion_beneficiario']	=$staff->fkIdBeneficiario->numero_identificacion_beneficiario;
						$aux['primer_nombre_beneficiario']			=$staff->fkIdBeneficiario->primer_nombre_beneficiario;
						$aux['segundo_nombre_beneficiario']			=$staff->fkIdBeneficiario->segundo_nombre_beneficiario;
						$aux['apellido_paterno_beneficiario']		=$staff->fkIdBeneficiario->apellido_paterno_beneficiario;
						$aux['apellido_materno_beneficiario']		=$staff->fkIdBeneficiario->apellido_materno_beneficiario;
						$aux['fecha_nacimiento_beneficiario']		=$staff->fkIdBeneficiario->fecha_nacimiento_beneficiario;
						$aux['sexo_beneficiario']					=$staff->fkIdBeneficiario->sexo_beneficiario;
						$aux['numero_hijo_beneficiario']			=(int)$staff->fkIdBeneficiario->numero_hijo_beneficiario;
						$aux['fotografia_beneficiario']				=$staff->fkIdBeneficiario->fotografia_beneficiario;
						$aux['observacion_beneficiario']			=$staff->fkIdBeneficiario->observacion_beneficiario;
						$aux['trabaja_beneficiario']				=(int)$staff->fkIdBeneficiario->trabaja_beneficiario;
						$aux['carnet_de_salud_beneficiario']		=(int)$staff->fkIdBeneficiario->carnet_de_salud_beneficiario;
						$aux['libreta_escolar_beneficiario']		=(int)$staff->fkIdBeneficiario->libreta_escolar_beneficiario;
						$aux['informacion_relevante_beneficiario']	=$staff->fkIdBeneficiario->informacion_relevante_beneficiario;
						$aux['fecha_creacion_beneficiario']			=$staff->fkIdBeneficiario->fecha_creacion_beneficiario;
						$arreglo[]=$aux;
					}					
					$respuesta->registros=$arreglo;	
					$respuesta->total=(int)$total;
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