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
		if (isset($_GET['callback']) && $_GET['callback']!=='' && !is_numeric($_GET['callback'])) {
			$callback=$_GET['callback'];
			
			if (isset($_GET['limit']) && $_GET['limit']>0 && is_numeric($_GET['limit']) &&
				isset($_GET['start']) && $_GET['start']>=0 && $_GET['start']<=$_GET['limit'] && 
				isset($_GET['start'])&& is_numeric($_GET['start'])
				){
				$model=new ActividadAreaActividad();
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
								$modelo=$model::model()->with('fkIdAtividad','fkIdSubarea')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();
							}	
						} else  {
							foreach ($filtro as $parametro) {
								$condicion=$parametro['property'];
								$valor=$parametro['value'];
								$modelo=$model::model()->with('fkIdAtividad','fkIdSubarea')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->findAll();								
							}
						}
						$total="".sizeof($modelo);	
					} else {
						if (isset($_GET['sort']) && $_GET['sort']!='') {
							$sort=CJSON::decode($_GET['sort']);
							$condisort=$sort[0]['property'];
							$valorsort=$sort[0]['direction'];	
							$modelo=$model::model()->with('fkIdAtividad','fkIdSubarea')->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();		
						} else {
							$modelo=$model::model()->with('fkIdAtividad','fkIdSubarea')->pagina($_GET['limit'],$_GET['start'])->findAll();
						}
						$total=$model->count();
					}
				} catch (Exception $e) {
						$error=$e;
				}
				if($error==""){
					$arreglo=array();
					
					foreach ($modelo as $staff) {
						$aux=array();
						$aux['fk_id_actividad']			=(int)$staff->fk_id_actividad;
						$aux['fk_id_sub_area']			=(int)$staff->fk_id_sub_area;
						//***********************************************************
						$aux['id_actividad']			=(int)$staff->fkIdAtividad->id_actividad;
						$aux['fk_id_usuario']			=(int)$staff->fkIdAtividad->fk_id_usuario;
						$aux['fk_id_gestion']			=(int)$staff->fkIdAtividad->fk_id_gestion;
						$aux['fk_id_lugar_actividad']	=(int)$staff->fkIdAtividad->fk_id_lugar_actividad;
						$aux['titulo_actividad']		=$staff->fkIdAtividad->titulo_actividad;
						$aux['fecha_inicio_actividad']	=$staff->fkIdAtividad->fecha_inicio_actividad;
						$aux['fecha_fin_actividad']		=$staff->fkIdAtividad->fecha_fin_actividad;
						$aux['descripcion_actividad']	=$staff->fkIdAtividad->descripcion_actividad;
						$aux['fecha_creacion_actividad']=$staff->fkIdAtividad->fecha_creacion_actividad;
						//**********************************************************
						$aux['id_sub_area']				=(int)$staff->fkIdSubarea->id_sub_area;
						$aux['fk_id_area_actividad']	=(int)$staff->fkIdSubarea->fk_id_area_actividad;
						$aux['nombre_sub_area']			=$staff->fkIdSubarea->nombre_sub_area;
						$aux['descripcion_sub_area']	=$staff->fkIdSubarea->descripcion_sub_area;
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