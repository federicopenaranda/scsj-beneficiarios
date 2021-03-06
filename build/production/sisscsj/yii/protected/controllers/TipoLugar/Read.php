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
        $error="";
		$error.= (!isset($_GET['callback'])) ? "{ Error de Callback } " : "";
        $error.= (!isset($_GET['start'])) ? "{ Error de start } " : "";
        $error.= (!isset($_GET['limit'])) ? "{ Error de limit } " : "";
        if ($error == "") {
			$callback=$_GET['callback'];
			$model=new TipoLugar();
			try {
				if (isset($_GET['filter']) && $_GET['filter']!='') {
					$filtro=CJSON::decode($_GET['filter']);
					if (isset($_GET['sort']) && $_GET['sort']!='') {		
						$sort=CJSON::decode($_GET['sort']);
						$condisort=isset($sort[0]['property']) ? $sort[0]['property'] : "";
						$valorsort=isset($sort[0]['direction']) ? $sort[0]['direction'] :"error";
						foreach ($filtro as $parametro) {
							$condicion=isset($parametro['property']) ? $parametro['property'] : "" ;
							$valor=isset($parametro['value']) ? $parametro['value'] : "error" ;
							$arreglo=$model::model()->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();
						}
					} else {
						foreach ($filtro as $parametro) {
							$condicion=isset($parametro['property']) ? $parametro['property'] : "" ;
							$valor=isset($parametro['value']) ? $parametro['value'] : "error" ;
							$arreglo=$model::model()->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->findAll();
						}
					}
					$total="".sizeof($arreglo);
				} else {
					if (isset($_GET['sort']) && $_GET['sort']!=''){
						$sort=CJSON::decode($_GET['sort']);
						$condisort=isset($sort[0]['property']) ? $sort[0]['property'] : "";
						$valorsort=isset($sort[0]['direction']) ? $sort[0]['direction'] :"error";
						$arreglo=$model->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();
					} else {
						$arreglo=$model->pagina($_GET['limit'],$_GET['start'])->findAll();
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
				$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>''));
			}
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>$error);
			$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>''));
		}
	}
}
