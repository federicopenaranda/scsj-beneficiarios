<?php
error_reporting(0);
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
		
		if (isset($_GET['callback']) && $_GET['callback']!=='' && !is_numeric($_GET['callback'])){
			$callback=$_GET['callback'];
			
			if (isset($_GET['limit']) && $_GET['limit']>0 && is_numeric($_GET['limit']) && isset($_GET['start']) && 
				$_GET['start']>=0 && isset($_GET['start']) && is_numeric($_GET['start'])
				) {
				$model=new Actividad();
				$error="";
				try {
					if (isset($_GET['filter']) && $_GET['filter']!='') {
						$filtro=CJSON::decode($_GET['filter']);
						
						if (isset($_GET['sort']) && $_GET['sort']!='') {		
							$sort=CJSON::decode($_GET['sort']);
							$condisort=$sort[0]['property'];
							$valorsort=$sort[0]['direction'];
							
							foreach ($filtro as $parametro) {
								$condicion=$parametro['property'];
								$valor=$parametro['value'];
								$modelo=$model::model()->with('fkIdGestion', 'fkIdLugarActividad', 'fkIdUsuario')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();
							}
						} else {
							foreach ($filtro as $parametro) {
								$condicion=$parametro['property'];
								$valor=$parametro['value'];
								$modelo=$model::model()->with('fkIdGestion', 'fkIdLugarActividad', 'fkIdUsuario')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->findAll();
							}
						}
						$total="".sizeof($modelo);
					} else {
						
						if (isset($_GET['sort']) && $_GET['sort']!='') {
							$sort=CJSON::decode($_GET['sort']);
							$condisort=$sort[0]['property'];
							$valorsort=$sort[0]['direction'];	
							$modelo=$model::model()->with('fkIdGestion', 'fkIdLugarActividad', 'fkIdUsuario')->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();
						} else {
							$modelo=$model::model()->with('fkIdGestion', 'fkIdLugarActividad', 'fkIdUsuario')->pagina($_GET['limit'],$_GET['start'])->findAll();
						}
						$total=$model->count();
					}
				} catch (Exception $e) {
						$error=$e;
				}
				if ($error=="") {
					$arreglo=array();
	
					foreach ($modelo as $staff) {
						$aux=array();
						$aux['id_actividad']				=(int)$staff->id_actividad;
						$aux['fk_id_usuario']				=(int)$staff->fk_id_usuario;
						$aux['fk_id_gestion']				=(int)$staff->fk_id_gestion;
						$aux['fk_id_lugar_actividad']		=(int)$staff->fk_id_lugar_actividad;
						$aux['titulo_actividad']			=$staff->titulo_actividad;
						$aux['fecha_inicio_actividad']		=substr($staff->fecha_inicio_actividad,0,-9);
						$aux['fecha_fin_actividad']			=substr($staff->fecha_fin_actividad,0,-9);
						$aux['descripcion_actividad']		=$staff->descripcion_actividad;
						$aux['fecha_creacion_actividad']	=$staff->fecha_creacion_actividad;
						//***********************************************************
						$aux['id_gestion']					=(int)$staff->fkIdGestion->id_gestion;
						$aux['estado_gestion']				=(int)$staff->fkIdGestion->estado_gestion;
						$aux['nombre_gestion']				=$staff->fkIdGestion->nombre_gestion;
						$aux['orden_gestion']				=$staff->fkIdGestion->orden_gestion;
						//**********************************************************
						$aux['id_lugar_actividad']			=(int)$staff->fkIdLugarActividad->id_lugar_actividad;
						$aux['fk_id_tipo_lugar']			=(int)$staff->fkIdLugarActividad->fk_id_tipo_lugar;
						$aux['nombre_lugar_actividad']		=$staff->fkIdLugarActividad->nombre_lugar_actividad;
						$aux['descripcion_lugar_actividad']	=$staff->fkIdLugarActividad->descripcion_lugar_actividad;
						//**********************************************************
						$aux['id_usuario']					=(int)$staff->fkIdUsuario->id_usuario;
						$aux['fk_id_tipo_usuario']			=(int)$staff->fkIdUsuario->fk_id_tipo_usuario;
						$aux['nombre_usuario']				=$staff->fkIdUsuario->nombre_usuario;
						$aux['apellido_usuario']			=$staff->fkIdUsuario->apellido_usuario;
						$aux['login_usuario']				=$staff->fkIdUsuario->login_usuario;
						$aux['password_usuario']			=$staff->fkIdUsuario->password_usuario;
						$aux['sexo_usuario']				=$staff->fkIdUsuario->sexo_usuario;
						$aux['fecha_creacion_usuario']		=$staff->fkIdUsuario->fecha_creacion_usuario;
						$aux['fecha_actualizacion_usuario']	=$staff->fkIdUsuario->fecha_actualizacion_usuario;
						$aux['telefono_usuario']			=$staff->fkIdUsuario->telefono_usuario;
						$aux['celular_usuario']				=$staff->fkIdUsuario->celular_usuario;
						$aux['correo_usuario']				=$staff->fkIdUsuario->correo_usuario;
						$aux['direccion_usuario']			=$staff->fkIdUsuario->direccion_usuario;
						$aux['observacion_usuario']			=$staff->fkIdUsuario->observacion_usuario;
						//*************************************************
						$aux2=array();
						foreach ($staff->actividadTipoActividads as $va ) {
							$aux2[]=$va->fk_id_tipo_actividad;
						}
						$aux['actividad_tipo_actividad']=$aux2;
						$aux2=array();
						foreach ($staff->actividadAreaActividads as $va ) {
							$aux2[]=$va->fk_id_sub_area;
						}
						$aux['actividad_area_actividad']=$aux2;

						//*********************************
						$arreglo[]=$aux;
					}

					$respuesta->registros=$arreglo;	
					$respuesta->total=(int)$total;
					$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>$callback));
				}else{
					$respuesta->meta=array("success"=>"false","msg"=>$error);
					$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>$callback));
				}
			} else {
				$respuesta->meta=array("success"=>"false","msg"=>"Campos invalidos");
				$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>$callback));
			}
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>"Error de callback");
			$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>''));
		}
	}
}