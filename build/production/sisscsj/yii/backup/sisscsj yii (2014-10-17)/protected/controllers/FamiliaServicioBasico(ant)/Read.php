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
		if (isset($_GET['callback'])&&$_GET['callback']!=='' && !is_numeric($_GET['callback'])){
			$callback=$_GET['callback'];
			
			if (isset($_GET['limit']) && $_GET['limit']>0 && is_numeric($_GET['limit'])&&isset($_GET['start']) && $_GET['start']>=0 && $_GET['start']<=$_GET['limit'] && isset($_GET['start'])&& is_numeric($_GET['start'])){
				$model=new FamiliaServicioBasico();
				$error="";
				try {
					if (isset($_GET['filter']) && $_GET['filter']!=''){
						$filtro=CJSON::decode($_GET['filter']);
						
						if(isset($_GET['sort']) && $_GET['sort']!=''){		
							$sort=CJSON::decode($_GET['sort']);
							$condisort=$sort[0]['property'];
							$valorsort=$sort[0]['direction'];
							foreach ($filtro as $parametro) {
								$condicion=$parametro['property'];
								$valor=$parametro['value'];
								$modelo=$model::model()->with('fkIdFamilia','fkIdServicioBasico')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();		
							}	
						} else {
							foreach ($filtro as $parametro) {
								$condicion=$parametro['property'];
								$valor=$parametro['value'];
								$modelo=$model::model()->with('fkIdFamilia','fkIdServicioBasico')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->findAll();							
							}
						}
						$total="".sizeof($modelo);	
					} else {
						if(isset($_GET['sort']) && $_GET['sort']!=''){
							$sort=CJSON::decode($_GET['sort']);
							$condisort=$sort[0]['property'];
							$valorsort=$sort[0]['direction'];	
							$modelo=$model::model()->with('fkIdFamilia','fkIdServicioBasico')->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();		
						}else{
							$modelo=$model::model()->with('fkIdFamilia','fkIdServicioBasico')->pagina($_GET['limit'],$_GET['start'])->findAll();
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
						$aux['id_familia_servicio_basico']				=(int)$staff->id_familia_servicio_basico;
						$aux['fk_id_servicio_basico']					=(int)$staff->fk_id_servicio_basico;
						$aux['fk_id_familia']							=(int)$staff->fk_id_familia;
						$aux['observacion_familia_servicio_basico']		=$staff->observacion_familia_servicio_basico;
						$aux['estado_familia_servicio_basico']			=(int)$staff->estado_familia_servicio_basico;
						$aux['fecha_creacion_familia_servicio_basico']	=$staff->fecha_creacion_familia_servicio_basico;
						//***********************************************************
						$aux['id_familia']								=(int)$staff->fkIdFamilia->id_familia;
						$aux['codigo_familia']							=$staff->fkIdFamilia->codigo_familia;
						$aux['codigo_familia_antiguo']					=$staff->fkIdFamilia->codigo_familia_antiguo;
						$aux['numero_hijos_viven_familia']				=(int)$staff->fkIdFamilia->numero_hijos_viven_familia;
						$aux['estado_familia']							=(int)$staff->fkIdFamilia->estado_familia;
						$aux['fecha_creacion_familia']					=$staff->fkIdFamilia->fecha_creacion_familia;
						//**********************************************************
						$aux['id_servicio_basico']						=(int)$staff->fkIdServicioBasico->id_servicio_basico;
						$aux['nombre_servicio_basico']					=$staff->fkIdServicioBasico->nombre_servicio_basico;
						$aux['descripcion_servicio_basico']				=$staff->fkIdServicioBasico->descripcion_servicio_basico;
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