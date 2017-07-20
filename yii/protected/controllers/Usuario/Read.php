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
		$error="";
		$error.= (!isset($_GET['callback'])) ? "{ Error de Callback } " : "";
        $error.= (!isset($_GET['start'])) ? "{ Error de start } " : "";
        $error.= (!isset($_GET['limit'])) ? "{ Error de limit } " : "";
		if ($error == "") {
			$callback=$_GET['callback'];
			$model=new Usuario();
			if (isset($_GET['query']) && $_GET['query'] != "") {
					
				$condiQuery = "";
				$filtro = CJSON::decode($_GET['query']);
				$sw=0;
				foreach ($filtro as $fvalues):
					foreach($fvalues as $fk=>$fv):
						if($fv == "")
							$sw = 1;
						$condiQuery.= $fk." LIKE '%".$fv."%' OR ";
					endforeach;
				endforeach;
				$condiQuery = substr ($condiQuery, 0, -3);
				if ($sw == 0) { 
					$modelo = $model::model()->with('fkIdTipoUsuario')->findAll(array("condition"=>$condiQuery,"offset"=>$_GET['start'],"limit" => $_GET['limit']));
				$total = sizeof($modelo);
				} else {
					$modelo = $model::model()->with('fkIdTipoUsuario')->findAll(array("condition"=>$condiQuery));
					$total = sizeof($modelo);
					$modelo = $model::model()->with('fkIdTipoUsuario')->findAll(array("condition"=>$condiQuery,"offset"=>$_GET['start'],"limit" => $_GET['limit']));
				}
			} else {
				
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
								$modelo=$model::model()->with('fkIdTipoUsuario')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();					
							}
						} else {
							foreach ($filtro as $parametro) {
								$condicion=$parametro['property'];
								$valor=$parametro['value'];
								$modelo=$model::model()->with('fkIdTipoUsuario')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->findAll();	
							}
						}
						$total="".sizeof($modelo);
					} else {

						if (isset($_GET['sort']) && $_GET['sort']!=''){
							$sort=CJSON::decode($_GET['sort']);
							$condisort=$sort[0]['property'];
							$valorsort=$sort[0]['direction'];
							$modelo=$model::model()->with('fkIdTipoUsuario')->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();
						} else {
							$modelo=$model::model()->with('fkIdTipoUsuario')->pagina($_GET['limit'],$_GET['start'])->findAll();
						}
						$total=$model->count();
					}
				} catch (Exception $e) {
						$error=$e;
				}
			}//query
				if ($error=="") {
					$arreglo=array();
					foreach($modelo as $staff){
						$aux=array();
						$aux['id_usuario']					=(int)$staff->id_usuario;
						$aux['fk_id_tipo_usuario']			=(int)$staff->fk_id_tipo_usuario;
						$aux['nombre_usuario']				=$staff->nombre_usuario;
						$aux['apellido_usuario']			=$staff->apellido_usuario;
						$aux['login_usuario']				=$staff->login_usuario;
						$aux['password_usuario']			="";
						$aux['sexo_usuario']				=$staff->sexo_usuario;
						$aux['fecha_creacion_usuario']		=$staff->fecha_creacion_usuario;
						$aux['fecha_actualizacion_usuario']	=$staff->fecha_actualizacion_usuario;
						$aux['telefono_usuario']			=$staff->telefono_usuario;
						$aux['celular_usuario']				=$staff->celular_usuario;
						$aux['correo_usuario']				=$staff->correo_usuario;
						$aux['direccion_usuario']			=$staff->direccion_usuario;
						$aux['observacion_usuario']			=$staff->observacion_usuario;
						//***********************************************************
						$aux['id_tipo_usuario']				=(int)$staff->fkIdTipoUsuario->id_tipo_usuario;
						$aux['nombre_tipo_usuario']			=$staff->fkIdTipoUsuario->nombre_tipo_usuario;
						$aux['descripcion_tipo_usuario']	=$staff->fkIdTipoUsuario->descripcion_tipo_usuario;
						$aux2=array();
						foreach($staff->usuarioLugars as $va){
							$aux2[]=$va->fk_id_lugar_actividad;
						}
						$aux['usuario_lugar']=$aux2;
						$arreglo[]=$aux;
					}
					$respuesta->registros=$arreglo;
					//$total=sizeof($arreglo);
					$respuesta->total=(int)$total;
					$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>$callback));
				} else {
					$respuesta->meta=array("success"=>"false","msg"=>$error);
					$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>$callback));
				}
		} else{
			$respuesta->meta=array("success"=>"false","msg"=>"Error de callback");
			$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>''));
		}
	}
}