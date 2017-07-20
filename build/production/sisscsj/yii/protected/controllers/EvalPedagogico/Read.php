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
			
			$model=new EvalPedagogico();
			if(isset($_GET['filter']) && $_GET['filter']!=''){
				$filtro=CJSON::decode($_GET['filter']);
				if(isset($_GET['sort']) && $_GET['sort']!=''){		
					$sort=CJSON::decode($_GET['sort']);
					$condisort=$sort[0]['property'];
					$valorsort=$sort[0]['direction'];
					foreach ($filtro as $parametro) {
						$condicion=$parametro['property'];
						$valor=$parametro['value'];
						$modelo=$model::model()->with('fkIdUsuario','fkIdBeneficiario')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();			
					}
				} else {
					foreach ($filtro as $parametro) {
						$condicion=$parametro['property'];
						$valor=$parametro['value'];
						$modelo=$model::model()->with('fkIdUsuario','fkIdBeneficiario')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->findAll();
					}
				}
				$total="".sizeof($modelo);	
			} else {

				if (isset($_GET['sort']) && $_GET['sort']!=''){
					$sort=CJSON::decode($_GET['sort']);
					$condisort=$sort[0]['property'];
					$valorsort=$sort[0]['direction'];	
					$modelo=$model::model()->with('fkIdUsuario','fkIdBeneficiario')->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();		
				} else {
					$modelo=$model::model()->with('fkIdUsuario','fkIdBeneficiario')->pagina($_GET['limit'],$_GET['start'])->findAll();
				}
				$total=$model->count();
			}
			$arreglo=array();
			foreach($modelo as $staff){
				$aux=array();
				$aux['id_pedagogico']=$staff->id_pedagogico;
				$aux['fk_id_usuario']=$staff->fk_id_usuario;
				$aux['fk_id_beneficiario']=$staff->fk_id_beneficiario;
				$aux['fecha_pedagogico']=$staff->fecha_pedagogico;
				$aux['observaciones_pedagogico']=$staff->observaciones_pedagogico;
				$aux['matematicas_pedagogico']=$staff->matematicas_pedagogico;
				$aux['lenguaje_pedagogico']=$staff->lenguaje_pedagogico;
				$aux['desarrollo_habilidades_pedagogico']=$staff->desarrollo_habilidades_pedagogico;
				$aux['ciencias_vida_pedagogico']=$staff->ciencias_vida_pedagogico;
				$aux['idiomas_pedagogico']=$staff->idiomas_pedagogico;
				$aux['tecnologia_pedagogico']=$staff->tecnologia_pedagogico;
				$aux['fecha_creacion_eval_pedagogico']=$staff->fecha_creacion_eval_pedagogico;
					//***********************************************************
				$aux['id_usuario']=$staff->fkIdUsuario->id_usuario;
				$aux['fk_id_tipo_usuario']=$staff->fkIdUsuario->fk_id_tipo_usuario;
				$aux['nombre_usuario']=$staff->fkIdUsuario->nombre_usuario;
				$aux['apellido_usuario']=$staff->fkIdUsuario->apellido_usuario;
				$aux['login_usuario']=$staff->fkIdUsuario->login_usuario;
				$aux['password_usuario']=$staff->fkIdUsuario->password_usuario;
				$aux['sexo_usuario']=$staff->fkIdUsuario->sexo_usuario;
				$aux['fecha_creacion_usuario']=$staff->fkIdUsuario->fecha_creacion_usuario;
				$aux['fecha_actualizacion_usuario']=$staff->fkIdUsuario->fecha_actualizacion_usuario;
				$aux['telefono_usuario']=$staff->fkIdUsuario->telefono_usuario;
				$aux['celular_usuario']=$staff->fkIdUsuario->celular_usuario;
				$aux['correo_usuario']=$staff->fkIdUsuario->correo_usuario;
				$aux['direccion_usuario']=$staff->fkIdUsuario->direccion_usuario;
				$aux['observacion_usuario']=$staff->fkIdUsuario->observacion_usuario;
					//**********************************************************
				$aux['id_beneficiario']=$staff->fkIdBeneficiario->id_beneficiario;
				$aux['fk_id_religion']=$staff->fkIdBeneficiario->fk_id_religion;
				$aux['fk_id_entidad_salud']=$staff->fkIdBeneficiario->fk_id_entidad_salud;
				$aux['fk_id_curso']=$staff->fkIdBeneficiario->fk_id_curso;
				$aux['fk_id_nivel']=$staff->fkIdBeneficiario->fk_id_nivel;
				$aux['fk_id_turno']=$staff->fkIdBeneficiario->fk_id_turno;
				$aux['fk_id_formacion']=$staff->fkIdBeneficiario->fk_id_formacion;
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
		}else{
			$respuesta->meta=array("success"=>"false","msg"=>$error);
			$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>''));
		}
	}
}
