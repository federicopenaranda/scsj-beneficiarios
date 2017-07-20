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
			$model=new MarcoLogico();
			if (isset($_GET['filter']) && $_GET['filter']!='') {
				$filtro=CJSON::decode($_GET['filter']);
				if (isset($_GET['sort']) && $_GET['sort']!='') {		
					$sort=CJSON::decode($_GET['sort']);
					$condisort=$sort[0]['property'];
					$valorsort=$sort[0]['direction'];
					foreach ($filtro as $parametro) {
						$condicion=$parametro['property'];
						$valor=$parametro['value'];
						$modelo=$model::model()->with('fkIdEntidad')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();					
					}
				}else{
					foreach ($filtro as $parametro) {
						$condicion=$parametro['property'];
						$valor=$parametro['value'];
						$modelo=$model::model()->with('fkIdEntidad')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->findAll();
					}
				}
				$total="".sizeof($modelo);
			} else {
				if(isset($_GET['sort']) && $_GET['sort']!=''){
					$sort=CJSON::decode($_GET['sort']);
					$condisort=$sort[0]['property'];
					$valorsort=$sort[0]['direction'];
					$modelo=$model::model()->with('fkIdEntidad')->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();
				} else {
					$modelo=$model::model()->with('fkIdEntidad')->pagina($_GET['limit'],$_GET['start'])->findAll();
				}
				$total=$model->count();
			}
			$arreglo=array();
			foreach($modelo as $staff){
				$aux=array();
				$aux['id_marco_logico']=$staff->id_marco_logico;
				$aux['fk_id_entidad']=$staff->fk_id_entidad;
				$aux['fecha_marco_logico']=$staff->fecha_marco_logico;
				$aux['codigo_marco_logico']=$staff->codigo_marco_logico;
				$aux['estado_marco_logico']=$staff->estado_marco_logico;
				$aux['observaciones_marco_logico']=$staff->observaciones_marco_logico;
					//***********************************************************
				$aux['id_entidad']=$staff->fkIdEntidad->id_entidad;
				$aux['fk_id_tipo_entidad']=$staff->fkIdEntidad->fk_id_tipo_entidad;
				$aux['nombre_entidad']=$staff->fkIdEntidad->nombre_entidad;
				$aux['fecha_inicio_actividades_entidad']=$staff->fkIdEntidad->fecha_inicio_actividades_entidad;
				$aux['fecha_fin_actividades_entidad']=$staff->fkIdEntidad->fecha_fin_actividades_entidad;
				$aux['direccion_entidad']=$staff->fkIdEntidad->direccion_entidad;
				$aux['observaciones_entidad']=$staff->fkIdEntidad->observaciones_entidad;
				$aux['fecha_creacion_entidad']=$staff->fkIdEntidad->fecha_creacion_entidad;
				$aux2=array();
				foreach($staff->objetivoGenerals as $va){
					#$aux2=$va->ATRIBUTO;
				}
				#$aux['ATRIBUTO']=$aux2;
				$arreglo[]=$aux;
			}
			$respuesta->registros=$arreglo;	
			$respuesta->total=$total;
			$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>$callback));
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>$error);
			$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>''));
		}
	}
}
