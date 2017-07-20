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
			
			$model=new ResultadoActividad();
			if(isset($_GET['filter']) && $_GET['filter']!=''){
				$filtro=CJSON::decode($_GET['filter']);
				if(isset($_GET['sort']) && $_GET['sort']!=''){		
					$sort=CJSON::decode($_GET['sort']);
					$condisort=$sort[0]['property'];
					$valorsort=$sort[0]['direction'];
					foreach ($filtro as $parametro) {
						$condicion=$parametro['property'];
						$valor=$parametro['value'];
						$modelo=$model::model()->with('fkIdResultado','fkIdActividad')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();			
					}
				} else {
					foreach ($filtro as $parametro) {
						$condicion=$parametro['property'];
						$valor=$parametro['value'];
						$modelo=$model::model()->with('fkIdResultado','fkIdActividad')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->findAll();
					}
				}
				$total="".sizeof($modelo);	
			} else {
				if (isset($_GET['sort']) && $_GET['sort']!=''){
					$sort=CJSON::decode($_GET['sort']);
					$condisort=$sort[0]['property'];
					$valorsort=$sort[0]['direction'];	
					$modelo=$model::model()->with('fkIdResultado','fkIdActividad')->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();		
				} else {
					$modelo=$model::model()->with('fkIdResultado','fkIdActividad')->pagina($_GET['limit'],$_GET['start'])->findAll();
				}
				$total=$model->count();
			}
			$arreglo=array();
			foreach($modelo as $staff){
				$aux=array();
				$aux['id_resultado_actividad']=$staff->id_resultado_actividad;
				$aux['fk_id_resultado']=$staff->fk_id_resultado;
				$aux['fk_id_actividad']=$staff->fk_id_actividad;
					//***********************************************************
				$aux['id_resultado']=$staff->fkIdResultado->id_resultado;
				$aux['fk_id_objetivo_especifico']=$staff->fkIdResultado->fk_id_objetivo_especifico;
				$aux['descripcion_resultado']=$staff->fkIdResultado->descripcion_resultado;
				$aux['logica_intervencion_resultado']=$staff->fkIdResultado->logica_intervencion_resultado;
				$aux['metas_resultado']=$staff->fkIdResultado->metas_resultado;
				$aux['indicadores_resultado']=$staff->fkIdResultado->indicadores_resultado;
				$aux['medios_verificacion_resultado']=$staff->fkIdResultado->medios_verificacion_resultado;
				$aux['supuestos_resultado']=$staff->fkIdResultado->supuestos_resultado;
					//**********************************************************
				$aux['id_actividad']=$staff->fkIdActividad->id_actividad;
				$aux['fk_id_usuario']=$staff->fkIdActividad->fk_id_usuario;
				$aux['fk_id_gestion']=$staff->fkIdActividad->fk_id_gestion;
				$aux['fk_id_lugar_actividad']=$staff->fkIdActividad->fk_id_lugar_actividad;
				$aux['titulo_actividad']=$staff->fkIdActividad->titulo_actividad;
				$aux['fecha_inicio_actividad']=$staff->fkIdActividad->fecha_inicio_actividad;
				$aux['fecha_fin_actividad']=$staff->fkIdActividad->fecha_fin_actividad;
				$aux['descripcion_actividad']=$staff->fkIdActividad->descripcion_actividad;
				$aux['fecha_creacion_actividad']=$staff->fkIdActividad->fecha_creacion_actividad;
				$arreglo[]=$aux;
			}
			$respuesta->registros=$arreglo;	
			$respuesta->total=$total;
			$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>$callback));
		}else{
			$respuesta->meta=array("success"=>"false","msg"=>$error);
			$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>''));
		}
	}
}
