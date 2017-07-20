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
			$model=new ActividadProyecto();
            try {
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
                            $listAtrib=$model->attributeLabels();
							if(isset($listAtrib[$condicion])) {
								$condi.= $contFil!=sizeof($filtro) ? $condicion." LIKE '%".$valor."%' AND " : $condicion." LIKE '%".$valor."%'";	
								$contFil++;	
							} else {
								$listName=strpos($condicion,"fk_id");
								if($listName === FALSE){
									$condi.= $contFil!=sizeof($filtro) ? $condicion." LIKE '%".$valor."%' AND " : $condicion." LIKE '%".$valor."%'";	
									$contFil++;	
								} else {
									$nomTabEx=substr($condicion,6);
									$condi.= $contFil!=sizeof($filtro) ? "t.id_actividad_proyecto IN ((SELECT
actividad_proyecto.id_actividad_proyecto FROM
actividad_proyecto INNER JOIN actividad_proyecto_$nomTabEx ON actividad_proyecto_$nomTabEx.fk_id_actividad_proyecto = actividad_proyecto.id_actividad_proyecto WHERE $condicion LIKE '$valor')) AND " : "t.id_actividad_proyecto IN ((SELECT
actividad_proyecto.id_actividad_proyecto FROM
actividad_proyecto INNER JOIN actividad_proyecto_$nomTabEx ON actividad_proyecto_$nomTabEx.fk_id_actividad_proyecto = actividad_proyecto.id_actividad_proyecto WHERE $condicion LIKE '$valor'))";
									$contFil++;
								}
							}					
                        }                   
                        $modelo=$model::model()->with('fkIdLugarActividad','fkIdGestion','fkIdUsuario')->findAll(array("condition"=>$condi,"order"=>$condisort." ".$valorsort,"offset"=>$_GET['start'],"limit"=>$_GET['limit']));
                    }else{
                        foreach ($filtro as $parametro) {
                            $condicion=$parametro['property'];
                            $valor=$parametro['value'];
                            $listAtrib=$model->attributeLabels();
							if(isset($listAtrib[$condicion])) {
								$condi.= $contFil!=sizeof($filtro) ? $condicion." LIKE '%".$valor."%' AND " : $condicion." LIKE '%".$valor."%'";	
								$contFil++;	
							} else {
								$listName=strpos($condicion,"fk_id");
								if ($listName===FALSE){	
									$condi.= $contFil!=sizeof($filtro) ? $condicion." LIKE '%".$valor."%' AND " : $condicion." LIKE '%".$valor."%'";	
									$contFil++;	
								} else {
									$nomTabEx=substr($condicion,6);
									$condi.= $contFil!=sizeof($filtro) ? "t.id_actividad_proyecto IN ((SELECT
actividad_proyecto.id_actividad_proyecto FROM
actividad_proyecto INNER JOIN actividad_proyecto_$nomTabEx ON actividad_proyecto_$nomTabEx.fk_id_actividad_proyecto = actividad_proyecto.id_actividad_proyecto WHERE $condicion LIKE '$valor')) AND " : "t.id_actividad_proyecto IN ((SELECT
actividad_proyecto.id_actividad_proyecto FROM
actividad_proyecto INNER JOIN actividad_proyecto_$nomTabEx ON actividad_proyecto_$nomTabEx.fk_id_actividad_proyecto = actividad_proyecto.id_actividad_proyecto WHERE $condicion LIKE '$valor'))";
									$contFil++;
								}
							}
                           
                        }
                        $modelo=$model::model()->with('fkIdLugarActividad','fkIdGestion','fkIdUsuario')->findAll(array("condition"=>$condi,"offset"=>$_GET['start'],"limit"=>$_GET['limit']));
                    }
                    $total="".sizeof($modelo);
                } else {
                    if(isset($_GET['sort']) && $_GET['sort']!=''){
                        $sort=CJSON::decode($_GET['sort']);
                        $condisort=$sort[0]['property'];
                        $valorsort=$sort[0]['direction'];	
                        $modelo=$model::model()->with('fkIdLugarActividad','fkIdGestion','fkIdUsuario')->findAll(array("order"=>$condisort." ".$valorsort,"offset"=>$_GET['start'],"limit"=>$_GET['limit']));		
                    } else {
                        $modelo=$model::model()->with('fkIdLugarActividad','fkIdGestion','fkIdUsuario')->findAll(array("offset"=>$_GET['start'],"limit"=>$_GET['limit']));
                    }
                    $total=$model->count();
                }
                $arreglo=array();
                foreach($modelo as $staff){
                    $aux=array();
                    $aux['id_actividad_proyecto']=$staff->id_actividad_proyecto;
                    $aux['fk_id_usuario']=$staff->fk_id_usuario;
                    $aux['fk_id_lugar_actividad']=$staff->fk_id_lugar_actividad;
                    $aux['fk_id_gestion']=$staff->fk_id_gestion;
                    $aux['titulo_actividad_proyecto']=$staff->titulo_actividad_proyecto;
                    $aux['fecha_inicio_actividad_proyecto']=$staff->fecha_inicio_actividad_proyecto;
                    $aux['fecha_fin_actividad_proyecto']=$staff->fecha_fin_actividad_proyecto;
                    $aux['descripcion_actividad_proyecto']=$staff->descripcion_actividad_proyecto;
                    $aux['fecha_creacion_actividad_proyecto']=$staff->fecha_creacion_actividad_proyecto;
                    //***********************************************************
                    $aux['id_lugar_actividad']=$staff->fkIdLugarActividad->id_lugar_actividad;
                    $aux['fk_id_tipo_lugar']=$staff->fkIdLugarActividad->fk_id_tipo_lugar;
                    $aux['nombre_lugar_actividad']=$staff->fkIdLugarActividad->nombre_lugar_actividad;
                    $aux['descripcion_lugar_actividad']=$staff->fkIdLugarActividad->descripcion_lugar_actividad;
                    //**********************************************************
                    $aux['id_gestion']=$staff->fkIdGestion->id_gestion;
                    $aux['estado_gestion']=$staff->fkIdGestion->estado_gestion;
                    $aux['nombre_gestion']=$staff->fkIdGestion->nombre_gestion;
                    $aux['orden_gestion']=$staff->fkIdGestion->orden_gestion;
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
                    foreach($staff->actividadTipoParticipantes as $va){
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
