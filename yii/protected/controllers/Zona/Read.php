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
		$audi=new LogSistema();
		if(isset($_GET['callback'])&&$_GET['callback']!=='' && !is_numeric($_GET['callback'])){
			$callback=$_GET['callback'];
			
			if (isset($_GET['limit']) && $_GET['limit']>0 && is_numeric($_GET['limit'])&&
				isset($_GET['start']) && $_GET['start']>=0 && is_numeric($_GET['start'])
				){
				$model=new Zona();
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
								$modelo=$model::model()->with('fkIdLocalidad')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();		
							}
						} else {
							foreach ($filtro as $parametro) {
								$condicion=$parametro['property'];
								$valor=$parametro['value'];
								$modelo=$model::model()->with('fkIdLocalidad')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->findAll();
							}
						}
						$total="".sizeof($modelo);
					} else {
						if (isset($_GET['sort']) && $_GET['sort']!=''){
							$sort=CJSON::decode($_GET['sort']);
							$condisort=$sort[0]['property'];
							$valorsort=$sort[0]['direction'];
							$modelo=$model::model()->with('fkIdLocalidad')->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();
						} else {
							$modelo=$model::model()->with('fkIdLocalidad')->pagina($_GET['limit'],$_GET['start'])->findAll();
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
						$aux['id_zona']				=(int)$staff->id_zona;
						$aux['fk_id_localidad']		=(int)$staff->fk_id_localidad;
						$aux['nombre_zona']			=$staff->nombre_zona;
						$aux['descripcion_zona']	=$staff->descripcion_zona;
						//***********************************************************
						$aux['id_localidad']		=(int)$staff->fkIdLocalidad->id_localidad;
						$aux['fk_id_provincia']		=(int)$staff->fkIdLocalidad->fk_id_provincia;
						$aux['nombre_localidad']	=$staff->fkIdLocalidad->nombre_localidad;
						$aux['descripcion_localidad']=$staff->fkIdLocalidad->descripcion_localidad;
						$arreglo[]=$aux;
					}

					$respuesta->registros=$arreglo;	
					$respuesta->total=(int)$total;
					$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>$callback));
				} else {
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