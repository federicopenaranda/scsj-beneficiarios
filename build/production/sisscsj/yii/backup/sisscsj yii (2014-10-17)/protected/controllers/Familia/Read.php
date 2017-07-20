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
		if (isset($_GET['callback'])&&$_GET['callback']!=='' && !is_numeric($_GET['callback'])){
			$callback=$_GET['callback'];
			
			if(isset($_GET['limit']) && $_GET['limit']>0 && is_numeric($_GET['limit'])&&isset($_GET['start']) && $_GET['start']>=0 && $_GET['start']<=$_GET['limit'] && isset($_GET['start'])&& is_numeric($_GET['start'])){
				$model=new Familia();
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
								$modelo=$model::model()->with("familiaMetodoPlanificacionFamiliar")->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();
							}
						} else {
							foreach ($filtro as $parametro) {
								$condicion=$parametro['property'];
								$valor=$parametro['value'];
								$modelo=$model::model()->with("familiaMetodoPlanificacionFamiliar")->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->findAll();
							}
						}
						$total="".sizeof($modelo);
						//$total="".sizeof($arreglo);
					} else {
						if (isset($_GET['sort']) && $_GET['sort']!=''){
							$sort=CJSON::decode($_GET['sort']);
							$condisort=$sort[0]['property'];
							$valorsort=$sort[0]['direction'];
							$modelo=$model->with("familiaMetodoPlanificacionFamiliar")->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();							
						} else {
							$modelo=$model->with("familiaMetodoPlanificacionFamiliar")->pagina($_GET['limit'],$_GET['start'])->findAll();
						}
						$total=$model->count();
					}
					//**********************************
					
					$arreglo=array();
					foreach ($modelo as $staff) {

						$aux=array();
						$aux['id_familia']					=(int)$staff->id_familia;
						$aux['codigo_familia']				=$staff->codigo_familia;
						$aux['codigo_familia_antiguo']		=$staff->codigo_familia_antiguo;
						$aux['numero_hijos_viven_familia']	=(int)$staff->numero_hijos_viven_familia;
						$aux['estado_familia']				=(int)$staff->estado_familia;
						$aux['fecha_creacion_familia']		=$staff->fecha_creacion_familia;
						$aux2=array();
						foreach ($staff->familiaMetodoPlanificacionFamiliar as $va ) {
							$aux2[]=$va->fk_id_metodo_planificacion_familiar;
						}
						$aux['familia_metodo_planificacion_familiar']=$aux2;
						$arreglo[]=$aux;
					}

					//$arreglo['familia_metodo_planificacion_familiar']=$aux;
					//**********************************
				} catch (Exception $e) {
					$error=$e;
				}
				if ($error=="") {
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