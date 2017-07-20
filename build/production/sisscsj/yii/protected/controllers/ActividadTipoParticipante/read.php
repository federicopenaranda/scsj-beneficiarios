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
			$model=new ActividadTipoParticipante();
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
                    	$modelo = $model::model()->with('fkIdEdadesBeneficiario','fkIdActividadProyecto')->findAll(array("condition"=>$condiQuery,"offset"=>$_GET['start'],"limit" => $_GET['limit']));
                    	$total = sizeof($modelo);
					} else {
						$modelo = $model::model()->with('fkIdEdadesBeneficiario','fkIdActividadProyecto')->findAll(array("condition"=>$condiQuery));
						$total = sizeof($modelo);
						$modelo = $model::model()->with('fkIdEdadesBeneficiario','fkIdActividadProyecto')->findAll(array("condition"=>$condiQuery,"offset"=>$_GET['start'],"limit" => $_GET['limit']));
					} 
                } else {
                
                    if(isset($_GET['filter']) && $_GET['filter']!=''){
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
                                $modelo=$model::model()->with('fkIdEdadesBeneficiario','fkIdActividadProyecto')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();			
                            }
                        } else {
                            foreach ($filtro as $parametro) {
                                $condicion=$parametro['property'];
                                $valor=$parametro['value'];
                                $modelo=$model::model()->with('fkIdEdadesBeneficiario','fkIdActividadProyecto')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->findAll();
                            }
                        }
                        $total="".sizeof($modelo);	
                    } else {
						$modelo=array();
						$total=0;
                        /*if (isset($_GET['sort']) && $_GET['sort']!=''){
                            $sort=CJSON::decode($_GET['sort']);
                            $condisort=$sort[0]['property'];
                            $valorsort=$sort[0]['direction'];	
                            $modelo=$model::model()->with('fkIdEdadesBeneficiario','fkIdActividadProyecto')->findAll(array("order"=>$condisort." ".$valorsort,"offset"=>$_GET['start'],"limit"=>$_GET['limit']));		
                        } else {
                            $modelo=$model::model()->with('fkIdEdadesBeneficiario','fkIdActividadProyecto')->findAll(array("offset"=>$_GET['start'],"limit"=>$_GET['limit']));
                        }
                        $total=$model->count();*/
                    }
				}//if query
                $arreglo=array();
                foreach($modelo as $staff){
                    $aux=array();
                    $aux['id_actividad_tipo_participante']=$staff->id_actividad_tipo_participante;
                    $aux['fk_id_actividad_proyecto']=$staff->fk_id_actividad_proyecto;
                    $aux['fk_id_edades_beneficiario']=$staff->fk_id_edades_beneficiario;
                    $aux['cantidad_actividad_tipo_participante']=$staff->cantidad_actividad_tipo_participante;
                    $aux['sexo_actividad_tipo_participante']=$staff->sexo_actividad_tipo_participante;
                     //***********************************************************
                    $aux['id_edades_beneficiario']=$staff->fkIdEdadesBeneficiario->id_edades_beneficiario;
                    $aux['nombre_edades_beneficiario']=$staff->fkIdEdadesBeneficiario->nombre_edades_beneficiario;
                    $aux['descripcion_edades_beneficiario']=$staff->fkIdEdadesBeneficiario->descripcion_edades_beneficiario;
                    //**********************************************************
                    $aux['id_actividad_proyecto']=$staff->fkIdActividadProyecto->id_actividad_proyecto;
                    $aux['fk_id_usuario']=$staff->fkIdActividadProyecto->fk_id_usuario;
                    $aux['fk_id_lugar_actividad']=$staff->fkIdActividadProyecto->fk_id_lugar_actividad;
                    $aux['fk_id_gestion']=$staff->fkIdActividadProyecto->fk_id_gestion;
                    $aux['titulo_actividad_proyecto']=$staff->fkIdActividadProyecto->titulo_actividad_proyecto;
                    $aux['fecha_inicio_actividad_proyecto']=$staff->fkIdActividadProyecto->fecha_inicio_actividad_proyecto;
                    $aux['fecha_fin_actividad_proyecto']=$staff->fkIdActividadProyecto->fecha_fin_actividad_proyecto;
                    $aux['descripcion_actividad_proyecto']=$staff->fkIdActividadProyecto->descripcion_actividad_proyecto;
                    $aux['fecha_creacion_actividad_proyecto']=$staff->fkIdActividadProyecto->fecha_creacion_actividad_proyecto;
                    $arreglo[]=$aux;
                }
            } catch(Exception $e) {
				$error=$e->getMessage();
			}
			if ($error=="") {
				$respuesta->registros=$arreglo;	
				$respuesta->total=$total;
				$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>$callback));
			} else {
				$respuesta->meta=array("success"=>"false","msg"=>$error);
				$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>$callback));
			}
        } else{
			$respuesta->meta=array("success"=>"false","msg"=>$error);
			$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>''));
		}
	}
}
