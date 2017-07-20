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
			$model=new ObjetivoGeneral();
			if (isset($_GET['filter']) && $_GET['filter']!='') {
				$filtro=CJSON::decode($_GET['filter']);
				if (isset($_GET['sort']) && $_GET['sort']!='') {		
					$sort=CJSON::decode($_GET['sort']);
					$condisort=$sort[0]['property'];
					$valorsort=$sort[0]['direction'];
					foreach ($filtro as $parametro) {
						$condicion=$parametro['property'];
						$valor=$parametro['value'];
						$modelo=$model::model()->with('fkIdMarcoLogico')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();					
					}
				}else{
					foreach ($filtro as $parametro) {
						$condicion=$parametro['property'];
						$valor=$parametro['value'];
						$modelo=$model::model()->with('fkIdMarcoLogico')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->findAll();
					}
				}
				$total="".sizeof($modelo);
			} else {
				if(isset($_GET['sort']) && $_GET['sort']!=''){
					$sort=CJSON::decode($_GET['sort']);
					$condisort=$sort[0]['property'];
					$valorsort=$sort[0]['direction'];
					$modelo=$model::model()->with('fkIdMarcoLogico')->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();
				} else {
					$modelo=$model::model()->with('fkIdMarcoLogico')->pagina($_GET['limit'],$_GET['start'])->findAll();
				}
				$total=$model->count();
			}
			$arreglo=array();
			foreach($modelo as $staff){
				$aux=array();
				$aux['id_objetivo_general']=$staff->id_objetivo_general;
				$aux['fk_id_marco_logico']=$staff->fk_id_marco_logico;
				$aux['descripcion_objetivo_general']=$staff->descripcion_objetivo_general;
					//***********************************************************
				$aux['id_marco_logico']=$staff->fkIdMarcoLogico->id_marco_logico;
				$aux['fk_id_entidad']=$staff->fkIdMarcoLogico->fk_id_entidad;
				$aux['fecha_marco_logico']=$staff->fkIdMarcoLogico->fecha_marco_logico;
				$aux['codigo_marco_logico']=$staff->fkIdMarcoLogico->codigo_marco_logico;
				$aux['estado_marco_logico']=$staff->fkIdMarcoLogico->estado_marco_logico;
				$aux['observaciones_marco_logico']=$staff->fkIdMarcoLogico->observaciones_marco_logico;
				$aux2=array();
				foreach($staff->objetivoEspecificos as $va){
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
