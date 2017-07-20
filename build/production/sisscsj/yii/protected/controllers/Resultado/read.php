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
			$model=new Resultado();
			if (isset($_GET['filter']) && $_GET['filter']!='') {
				$filtro=CJSON::decode($_GET['filter']);
				if (isset($_GET['sort']) && $_GET['sort']!='') {		
					$sort=CJSON::decode($_GET['sort']);
					$condisort=$sort[0]['property'];
					$valorsort=$sort[0]['direction'];
					foreach ($filtro as $parametro) {
						$condicion=$parametro['property'];
						$valor=$parametro['value'];
						$modelo=$model::model()->with('fkIdObjetivoEspecifico')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();					
					}
				}else{
					foreach ($filtro as $parametro) {
						$condicion=$parametro['property'];
						$valor=$parametro['value'];
						$modelo=$model::model()->with('fkIdObjetivoEspecifico')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->findAll();
					}
				}
				$total="".sizeof($modelo);
			} else {
				if(isset($_GET['sort']) && $_GET['sort']!=''){
					$sort=CJSON::decode($_GET['sort']);
					$condisort=$sort[0]['property'];
					$valorsort=$sort[0]['direction'];
					$modelo=$model::model()->with('fkIdObjetivoEspecifico')->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();
				} else {
					$modelo=$model::model()->with('fkIdObjetivoEspecifico')->pagina($_GET['limit'],$_GET['start'])->findAll();
				}
				$total=$model->count();
			}
			$arreglo=array();
			foreach($modelo as $staff){
				$aux=array();
				$aux['id_resultado']=$staff->id_resultado;
				$aux['fk_id_objetivo_especifico']=$staff->fk_id_objetivo_especifico;
				$aux['descripcion_resultado']=$staff->descripcion_resultado;
				$aux['metas_resultado']=$staff->metas_resultado;
				$aux['indicadores_resultado']=$staff->indicadores_resultado;
				$aux['medios_verificacion_resultado']=$staff->medios_verificacion_resultado;
				$aux['supuestos_resultado']=$staff->supuestos_resultado;
					//***********************************************************
				$aux['id_objetivo_especifico']=$staff->fkIdObjetivoEspecifico->id_objetivo_especifico;
				$aux['fk_id_objetivo_general']=$staff->fkIdObjetivoEspecifico->fk_id_objetivo_general;
				$aux['descripcion_objetivo_especifico']=$staff->fkIdObjetivoEspecifico->descripcion_objetivo_especifico;
				$aux['metas_objetivo_especifico']=$staff->fkIdObjetivoEspecifico->metas_objetivo_especifico;
				$aux['indicadores_objetivo_especifico']=$staff->fkIdObjetivoEspecifico->indicadores_objetivo_especifico;
				$aux['medios_verificacion_objetivo_especifico']=$staff->fkIdObjetivoEspecifico->medios_verificacion_objetivo_especifico;
				$aux['supuestos_objetivo_especifico']=$staff->fkIdObjetivoEspecifico->supuestos_objetivo_especifico;
				$aux2=array();
				foreach($staff->resultadoActividads as $va){
					#$aux2=$va->ATRIBUTO;
				}
				#$aux['ATRIBUTO']=$aux2;
				$aux2=array();
				foreach($staff->resultadoEvaluacions as $va){
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
