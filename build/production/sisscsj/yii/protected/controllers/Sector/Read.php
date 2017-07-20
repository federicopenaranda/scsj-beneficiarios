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
		
		if(isset($_GET['callback'])&&$_GET['callback']!=='' && !is_numeric($_GET['callback'])){
			$callback=$_GET['callback'];
			
			if (isset($_GET['limit']) && $_GET['limit']>0 && is_numeric($_GET['limit']) &&
				isset($_GET['start']) && $_GET['start']>=0 && is_numeric($_GET['start'])
				) {
				$model=new Sector();
				$error="";
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
							$modelo = $model::model()->with('fkIdZona')->findAll(array("condition"=>$condiQuery,"offset"=>$_GET['start'],"limit" => $_GET['limit']));
							$total = sizeof($modelo);
						} else {
							$modelo = $model::model()->with('fkIdZona')->findAll(array("condition"=>$condiQuery));
							$total = sizeof($modelo);
							$modelo = $model::model()->with('fkIdZona')->findAll(array("condition"=>$condiQuery,"offset"=>$_GET['start'],"limit" => $_GET['limit']));
						} 
					} else {
						if(isset($_GET['filter']) && $_GET['filter']!=''){
							$filtro=CJSON::decode($_GET['filter']);
							
							if(isset($_GET['sort']) && $_GET['sort']!=''){		
								$sort=CJSON::decode($_GET['sort']);
								$condisort=$sort[0]['property'];
								$valorsort=$sort[0]['direction'];
								foreach ($filtro as $parametro) {
									$condicion=$parametro['property'];
									$valor=$parametro['value'];
										$modelo=$model::model()->with('fkIdZona')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();		
								}
							} else {
								foreach ($filtro as $parametro) {
									$condicion=$parametro['property'];
									$valor=$parametro['value'];
										$modelo=$model::model()->with('fkIdZona')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->findAll();	
								}
							}
							$total="".sizeof($modelo);
						} else {
							if(isset($_GET['sort']) && $_GET['sort']!=''){
								$sort=CJSON::decode($_GET['sort']);
								$condisort=$sort[0]['property'];
								$valorsort=$sort[0]['direction'];
								$modelo=$model::model()->with('fkIdZona')->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();
							} else {
								$modelo=$model::model()->with('fkIdZona')->pagina($_GET['limit'],$_GET['start'])->findAll();
							}
							$total=$model->count();
						}
					}//QUERY
				} catch (Exception $e) {
						$error=$e;
				}
				if ($error=="") {
					$arreglo=array();
					foreach($modelo as $staff){
						$aux=array();
						$aux['id_sector']			=(int)$staff->id_sector;
						$aux['fk_id_zona']			=(int)$staff->fk_id_zona;
						$aux['nombre_sector']		=$staff->nombre_sector;
						$aux['descripcion_sector']	=$staff->descripcion_sector;
						//***********************************************************
						$aux['id_zona']				=(int)$staff->fkIdZona->id_zona;
						$aux['fk_id_localidad']		=(int)$staff->fkIdZona->fk_id_localidad;
						$aux['nombre_zona']			=$staff->fkIdZona->nombre_zona;
						$aux['descripcion_zona']	=$staff->fkIdZona->descripcion_zona;
						$arreglo[]=$aux;
					}
					
					$respuesta->registros=$arreglo;	
					$respuesta->total=$total;
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