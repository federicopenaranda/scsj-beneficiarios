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
		if(isset($_GET['callback'])&&$_GET['callback']!=='' && !is_numeric($_GET['callback'])){
			$callback=$_GET['callback'];
			
			if(isset($_GET['limit']) && $_GET['limit']>0 && is_numeric($_GET['limit'])&&isset($_GET['start']) && $_GET['start']>=0 && $_GET['start']<=$_GET['limit'] && isset($_GET['start'])&& is_numeric($_GET['start'])){
				$model=new Biblioteca();
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
								$modelo=$model::model()->with('fkIdAreaCononcimientoBiblioteca','fkIdEscolaridad','fkIdUsuario')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();	
							}
						} else {
							foreach ($filtro as $parametro) {
								$condicion=$parametro['property'];
								$valor=$parametro['value'];
								$modelo=$model::model()->with('fkIdAreaCononcimientoBiblioteca','fkIdEscolaridad','fkIdUsuario')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->findAll();			
							}
						}
						$total="".sizeof($modelo);
					} else {
						if(isset($_GET['sort']) && $_GET['sort']!=''){
							$sort=CJSON::decode($_GET['sort']);
							$condisort=$sort[0]['property'];
							$valorsort=$sort[0]['direction'];	
							$modelo=$model::model()->with('fkIdAreaCononcimientoBiblioteca','fkIdEscolaridad','fkIdUsuario')->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();		
						}else{
							$modelo=$model::model()->with('fkIdAreaCononcimientoBiblioteca','fkIdEscolaridad','fkIdUsuario')->pagina($_GET['limit'],$_GET['start'])->findAll();
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
						$aux['id_biblioteca']							=(int)$staff->id_biblioteca;
						$aux['fk_id_usuario']							=(int)$staff->fk_id_usuario;
						$aux['fk_id_area_cononcimiento_biblioteca']		=(int)$staff->fk_id_area_cononcimiento_biblioteca;
						$aux['fk_id_escolaridad']						=(int)$staff->fk_id_escolaridad;
						$aux['tipo_usuario_biblioteca']					=$staff->tipo_usuario_biblioteca;
						$aux['sexo_usuario_biblioteca']					=$staff->sexo_usuario_biblioteca;
						$aux['fecha_consulta_biblioteca']				=$staff->fecha_consulta_biblioteca;
						$aux['observaciones_biblioteca']				=$staff->observaciones_biblioteca;
						$aux['fecha_creacion_biblioteca']				=$staff->fecha_creacion_biblioteca;
						//***********************************************************
						$aux['id_area_conocimiento_biblioteca']			=(int)$staff->fkIdAreaCononcimientoBiblioteca->id_area_conocimiento_biblioteca;
						$aux['nombre_area_conocimiento_biblioteca']		=$staff->fkIdAreaCononcimientoBiblioteca->nombre_area_conocimiento_biblioteca;
						$aux['descripcion_area_conocimiento_biblioteca']=$staff->fkIdAreaCononcimientoBiblioteca->descripcion_area_conocimiento_biblioteca;
						$aux['codigo_area_conocimiento_biblioteca']		=$staff->fkIdAreaCononcimientoBiblioteca->codigo_area_conocimiento_biblioteca;
						//**********************************************************
						$aux['id_escolaridad']							=(int)$staff->fkIdEscolaridad->id_escolaridad;
						$aux['nombre_escolaridad']						=$staff->fkIdEscolaridad->nombre_escolaridad;
						$aux['descripcion_escolaridad']					=$staff->fkIdEscolaridad->descripcion_escolaridad;
						$aux['turno_escolaridad']						=$staff->fkIdEscolaridad->turno_escolaridad;
						//**********************************************************
						$aux['id_usuario']								=(int)$staff->fkIdUsuario->id_usuario;
						$aux['fk_id_tipo_usuario']						=(int)$staff->fkIdUsuario->fk_id_tipo_usuario;
						$aux['nombre_usuario']							=$staff->fkIdUsuario->nombre_usuario;
						$aux['apellido_usuario']						=$staff->fkIdUsuario->apellido_usuario;
						$aux['login_usuario']							=$staff->fkIdUsuario->login_usuario;
						$aux['password_usuario']						=$staff->fkIdUsuario->password_usuario;
						$aux['sexo_usuario']							=$staff->fkIdUsuario->sexo_usuario;
						$aux['fecha_creacion_usuario']					=$staff->fkIdUsuario->fecha_creacion_usuario;
						$aux['fecha_actualizacion_usuario']				=$staff->fkIdUsuario->fecha_actualizacion_usuario;
						$aux['telefono_usuario']						=$staff->fkIdUsuario->telefono_usuario;
						$aux['celular_usuario']							=$staff->fkIdUsuario->celular_usuario;
						$aux['correo_usuario']							=$staff->fkIdUsuario->correo_usuario;
						$aux['direccion_usuario']						=$staff->fkIdUsuario->direccion_usuario;
						$aux['observacion_usuario']						=$staff->fkIdUsuario->observacion_usuario;
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