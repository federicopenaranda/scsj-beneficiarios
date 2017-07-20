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
			$model=new MonitoreoPuntoComunitario();
            try {
            	if (isset($_GET['query'])) {
                        
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
                    	$modelo = $model::model()->with('fkIdLugarActividad','fkIdUsuarioResponsable','fkIdUsuario')->findAll(array("condition"=>$condiQuery,"offset"=>$_GET['start'],"limit" => $_GET['limit']));
                    	$total = sizeof($modelo);
					} else {
						$modelo = $model::model()->with('fkIdLugarActividad','fkIdUsuarioResponsable','fkIdUsuario')->findAll(array("condition"=>$condiQuery));
                    	$total = sizeof($modelo);
						$modelo = $model::model()->with('fkIdLugarActividad','fkIdUsuarioResponsable','fkIdUsuario')->findAll(array("condition"=>$condiQuery,"offset"=>$_GET['start'],"limit" => $_GET['limit']));
					}
                } else {
                
                    if (isset($_GET['filter']) && $_GET['filter']!='') {
                        $filtro=CJSON::decode($_GET['filter']);
                        $condi="";
                        $contFil=1;
                        if(isset($_GET['sort']) && $_GET['sort']!=''){		
                            $sort=CJSON::decode($_GET['sort']);
                            $condisort=$sort[0]['property'];
                            $valorsort=$sort[0]['direction'];
                            foreach ($filtro as $parametro) {
                                $condicion=$parametro['property'];
                                $valor=$parametro['value'];
                                $modelo=$model::model()->with('fkIdLugarActividad','fkIdUsuarioResponsable','fkIdUsuario')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();			
                            }
                        }else{
                            foreach ($filtro as $parametro) {
                                $condicion=$parametro['property'];
                                $valor=$parametro['value'];
                                $modelo=$model::model()->with('fkIdLugarActividad','fkIdUsuarioResponsable','fkIdUsuario')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->findAll();
                            }
                        }
                        $total="".sizeof($modelo);
                    } else {
						$modelo=array();
                        if(isset($_GET['sort']) && $_GET['sort']!=''){
                            $sort=CJSON::decode($_GET['sort']);
                            $condisort=$sort[0]['property'];
                            $valorsort=$sort[0]['direction'];	
                            $modelo=$model::model()->with('fkIdLugarActividad','fkIdUsuarioResponsable','fkIdUsuario')->findAll(array("order"=>$condisort." ".$valorsort,"offset"=>$_GET['start'],"limit"=>$_GET['limit']));		
                        } else {
                            $modelo=$model::model()->with('fkIdLugarActividad','fkIdUsuarioResponsable','fkIdUsuario')->findAll(array("offset"=>$_GET['start'],"limit"=>$_GET['limit']));
                        }
                        $total=$model->count();
                    }
				}//if query
                $arreglo=array();
                foreach($modelo as $staff){
                    $aux=array();
                    $aux['id_monitoreo_punto_comunitario']=$staff->id_monitoreo_punto_comunitario;
                    $aux['fk_id_usuario']=$staff->fk_id_usuario;
                    $aux['fk_id_usuario_responsable']=$staff->fk_id_usuario_responsable;
                    $aux['fk_id_lugar_actividad']=$staff->fk_id_lugar_actividad;
                    $aux['fecha_monitoreo_punto_comunitario']=$staff->fecha_monitoreo_punto_comunitario;
                    $aux['analisis_monitoreo_punto_comunitario']=$staff->analisis_monitoreo_punto_comunitario;
                    //***********************************************************
                    $aux['id_lugar_actividad']=$staff->fkIdLugarActividad->id_lugar_actividad;
                    $aux['fk_id_tipo_lugar']=$staff->fkIdLugarActividad->fk_id_tipo_lugar;
                    $aux['nombre_lugar_actividad']=$staff->fkIdLugarActividad->nombre_lugar_actividad;
                    $aux['descripcion_lugar_actividad']=$staff->fkIdLugarActividad->descripcion_lugar_actividad;
                    //**********************************************************
                    $aux['id_usuario']=$staff->fkIdUsuarioResponsable->id_usuario;
                    $aux['fk_id_tipo_usuario']=$staff->fkIdUsuarioResponsable->fk_id_tipo_usuario;
                    $aux['nombre_usuario']=$staff->fkIdUsuarioResponsable->nombre_usuario;
                    $aux['apellido_usuario']=$staff->fkIdUsuarioResponsable->apellido_usuario;
                    $aux['login_usuario']=$staff->fkIdUsuarioResponsable->login_usuario;
                    $aux['password_usuario']=$staff->fkIdUsuarioResponsable->password_usuario;
                    $aux['sexo_usuario']=$staff->fkIdUsuarioResponsable->sexo_usuario;
                    $aux['fecha_creacion_usuario']=$staff->fkIdUsuarioResponsable->fecha_creacion_usuario;
                    $aux['fecha_actualizacion_usuario']=$staff->fkIdUsuarioResponsable->fecha_actualizacion_usuario;
                    $aux['telefono_usuario']=$staff->fkIdUsuarioResponsable->telefono_usuario;
                    $aux['celular_usuario']=$staff->fkIdUsuarioResponsable->celular_usuario;
                    $aux['correo_usuario']=$staff->fkIdUsuarioResponsable->correo_usuario;
                    $aux['direccion_usuario']=$staff->fkIdUsuarioResponsable->direccion_usuario;
                    $aux['observacion_usuario']=$staff->fkIdUsuarioResponsable->observacion_usuario;
                    //**********************************************************
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
                    $aux2=array();
                    foreach($staff->resultadoMonitoreoPcs as $va){
                        #$aux2=$va->ATRIBUTO;
                    }
                    #$aux['ATRIBUTO']=$aux2;
                    $arreglo[]=$aux;
                }
            } catch(Exception $e) {
				$error=$e->getMessage();
			}
			if ($error == "") { 
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
