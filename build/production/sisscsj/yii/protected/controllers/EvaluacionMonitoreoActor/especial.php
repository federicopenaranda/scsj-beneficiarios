<?php
/**
* Esta clase es llamado por su controlador repectivo y en aqui se definen todas las acciones del controlador
* Es una clase que hereda de CAction
*/ 
class especial extends CAction
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
		if(isset($_GET['callback'])&& $_GET['callback']!=='' && !is_numeric($_GET['callback']) && isset($_GET['id_tipo_monitoreo_actor'])){
			$callback=$_GET['callback'];
			$id=$_GET['id_tipo_monitoreo_actor'];
			$model=new EvaluacionMonitoreoActor();
			$r = $model->fcriterio($id);
			$res = $model->fkCriterio($id);
			$r2= $model->fcriterio2($id);
			
			$r3=$model->benefic();
			
			foreach($res as $rVal):
				foreach($rVal as $Key => $Val):
					if ($Key != "nombre_criterio_monitoreo_actor")
						if ($Key != "nombre_competencia_monitoreo_actor")
							$aux3[$Key."".$Val]=NULL;
				endforeach;	
			endforeach;
			
			foreach($r3 as $rKey => $rVal):
				$auxilio["id_evaluacion_monitoreo_actor"]=NULL;
				foreach($rVal as $Key => $Val):
					$auxilio[$Key]=$Val;
				endforeach;
				$rs3[]=$auxilio;
				$array3[]=array_merge($auxilio,$aux3);
				#$rs3[]=$aux3;
			endforeach;	

			#$array3[]=array_merge($rs3,$aux3);
			#foreach($r3 as $rVal):
			#	$array3[]=array_merge($rVal,$aux3);
			#endforeach;
			/*foreach($r3 as $rVal):
				$array3[]=array_merge($rs3,$aux3);
			endforeach;*/
			
			
			#print_r($r3);
			$array=array();
			$array2=array();
			
			if(sizeof($r2)!=0){
				
				$array2=[
                                    "id_evaluacion_monitoreo_actor"=>NULL,
                                    "fk_id_beneficiario"=>$r2[0]['evaluacion_monitoreo_actor'][0]['fk_id_beneficiario'],
                                    "primer_nombre_beneficiario"=>$r2[0]['evaluacion_monitoreo_actor'][0]['primer_nombre_beneficiario'],
                                    "apellido_paterno_beneficiario"=>$r2[0]['evaluacion_monitoreo_actor'][0]['apellido_paterno_beneficiario'],
                                    "codigo_beneficiario"=>$r2[0]['evaluacion_monitoreo_actor'][0]['codigo_beneficiario']];
								
				#$array2[]=["id_evaluacion_monitoreo_actor"=>NULL];
				#$array2[]=["fk_id_beneficiario"=>$r2[0]['evaluacion_monitoreo_actor'][0]['fk_id_beneficiario'],"type"=>"int"];
				#$array2[]=["primer_nombre_beneficiario"=>$r2[0]['evaluacion_monitoreo_actor'][0]['primer_nombre_beneficiario'],"type"=>"string"];
				#$array2[]=["apellido_paterno_beneficiario"=>$r2[0]['evaluacion_monitoreo_actor'][0]['apellido_paterno_beneficiario'],"type"=>"string"];
			}
				foreach($res as $rVal):
					foreach($rVal as $Key => $Val):
						if ($Key != "nombre_criterio_monitoreo_actor")
							if ($Key != "nombre_competencia_monitoreo_actor")
								$array2[$Key."".$Val]=NULL;
					endforeach;	
				endforeach;
				
			if(sizeof($r2)!=0){
				$array[]=["name"=>"id_evaluacion_monitoreo_actor","type"=>"int"];
				$array[]=["name"=>"fk_id_beneficiario","type"=>"int"];
				$array[]=["name"=>"primer_nombre_beneficiario","type"=>"string"];
				$array[]=["name"=>"apellido_paterno_beneficiario","type"=>"string"];
				$array[]=["name"=>"codigo_beneficiario","type"=>"string"];
			}//if
			foreach($res as $rVal):
				foreach($rVal as $Key => $Val):
					if ($Key != "nombre_criterio_monitoreo_actor")
						if ($Key != "nombre_competencia_monitoreo_actor")
							$array[]=["name"=>$Key."".$Val,"type"=>"int"];
				endforeach;	
			endforeach;
	
			$json = array(
				#'count'=>1,
				#'data'=>$array3,
				
				#'data'=>[array('id_evaluacion_monitoreo_actor'=>NULL,'id_beneficiario'=>$r2[0]['evaluacion_monitoreo_actor'][0]['id_beneficiario'],'primer_nombre_beneficiario'=>$r2[0]['evaluacion_monitoreo_actor'][0]['primer_nombre_beneficiario'],'apellido_paterno_beneficiario'=>$r2[0]['evaluacion_monitoreo_actor'][0]['apellido_paterno_beneficiario'],'fk_id_criterio_monitoreo_actor5'=>NULL,'fk_id_criterio_monitoreo_actor6'=>NULL,"fk_id_criterio_monitoreo_actor3"=>NULL,"fk_id_criterio_monitoreo_actor4"=>NULL,"fk_id_criterio_monitoreo_actor1"=>NULL,"fk_id_criterio_monitoreo_actor7"=>NULL,"fk_id_criterio_monitoreo_actor2"=>NULL),
						#array('id_evaluacion_monitoreo_actor'=>NULL,'fk_id_beneficiario'=>NULL,'fk_id_monitoreo_actor'=>NULL,'fk_id_criterio_monitoreo_actor5'=>NULL,'fk_id_criterio_monitoreo_actor6'=>NULL,"fk_id_criterio_monitoreo_actor3"=>NULL,"fk_id_criterio_monitoreo_actor4"=>NULL,"fk_id_criterio_monitoreo_actor1"=>NULL,"fk_id_criterio_monitoreo_actor7"=>NULL,"fk_id_criterio_monitoreo_actor2"=>NULL),
						#array('id_evaluacion_monitoreo_actor'=>NULL,'fk_id_beneficiario'=>NULL,'fk_id_monitoreo_actor'=>NULL,'fk_id_criterio_monitoreo_actor5'=>NULL,'fk_id_criterio_monitoreo_actor6'=>NULL,"fk_id_criterio_monitoreo_actor3"=>NULL,"fk_id_criterio_monitoreo_actor4"=>NULL,"fk_id_criterio_monitoreo_actor1"=>NULL,"fk_id_criterio_monitoreo_actor7"=>NULL,"fk_id_criterio_monitoreo_actor2"=>NULL)
				'metaData'=>array('idProperty'=>'id_evaluacion_monitoreo_actor',
									'fields'=> $array,
									'columns'=>$r	,
								),
					'success' => true
						);	
		#$respuesta->meta=array("success"=>"false","msg"=>$json);
		$controller->renderParTial('especial',array('model'=>$json,'callback'=>$callback));		
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>"Error de callback o de id_tipo_monitoreo_actor");
			$controller->renderParTial('especial',array('model'=>$respuesta,'callback'=>''));
		}
	}
}