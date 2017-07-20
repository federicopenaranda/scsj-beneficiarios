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
			$model=new ActividadProyectoTipoActividad();
			try {
				if (isset($_GET['filter']) && $_GET['filter']!='') {
					$filtro=CJSON::decode($_GET['filter']);
                    $condi="";
					$contFil=1;
					if (isset($_GET['sort']) && $_GET['sort']!='') {		
						$sort=CJSON::decode($_GET['sort']);
						$condisort=isset($sort[0]['property']) ? $sort[0]['property'] : "";
						$valorsort=isset($sort[0]['direction']) ? $sort[0]['direction'] :"error";
						foreach ($filtro as $parametro) {
                        	$condicion=$parametro['property'];
                            $valor=$parametro['value'];
							$condi.= $contFil!=sizeof($filtro) ? $condicion." LIKE '%".$valor."%' AND " : $condicion." LIKE '%".$valor."%'";	
							$contFil++;
						}
                        $arreglo=$model::model()->findAll(array("condition"=>$condi,"order"=>$condisort." ".$valorsort,"offset"=>$_GET['start'],"limit"=>$_GET['limit']));
					} else {
						foreach ($filtro as $parametro) {
                        	$condicion=$parametro['property'];
                            $valor=$parametro['value'];
							$condi.= $contFil!=sizeof($filtro) ? $condicion." LIKE '%".$valor."%' AND " : $condicion." LIKE '%".$valor."%'";	
							$contFil++;
						}
                        $arreglo=$model::model()->findAll(array("condition"=>$condi,"offset"=>$_GET['start'],"limit"=>$_GET['limit']));
					}
					$total="".sizeof($arreglo);
				} else {
					if (isset($_GET['sort']) && $_GET['sort']!=''){
						$sort=CJSON::decode($_GET['sort']);
						$condisort=isset($sort[0]['property']) ? $sort[0]['property'] : "";
						$valorsort=isset($sort[0]['direction']) ? $sort[0]['direction'] :"error";
						$arreglo=$model->findAll(array("order"=>$condisort." ".$valorsort,"offset"=>$_GET['start'],"limit"=>$_GET['limit']));
					} else {
						$arreglo=$model->findAll(array("offset"=>$_GET['start'],"limit"=>$_GET['limit']));
					}
					$total=$model->count();
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
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>$error);
			$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>''));
		}
	}
}


