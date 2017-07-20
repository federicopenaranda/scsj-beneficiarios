<?php
/**
* Esta clase es llamado por su controlador repectivo y en aqui se definen todas las acciones del controlador
* Es una clase que hereda de CAction
*/ 
class GestionBeneficiarioActual extends CAction
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
		if(isset($_GET['callback'])&&$_GET['callback']!=='' && !is_numeric($_GET['callback'])){
			$callback=$_GET['callback'];
			
				$model=new Beneficiario();
				$Criteria=new CDbCriteria();
				#$Criteria->select= 't.id_beneficiario';
				$Criteria->join='INNER JOIN gestion_beneficiario AS gb ON gb.fk_id_beneficiario = t.id_beneficiario
INNER JOIN gestion AS g ON gb.fk_id_gestion = g.id_gestion
INNER JOIN beneficiario_estado_beneficiario AS beb ON beb.fk_id_beneficiario = t.id_beneficiario
INNER JOIN beneficiario_tipo AS bt ON beb.fk_id_beneficiario_tipo = bt.id_beneficiario_tipo';
				$Criteria->condition='gb.estado_gestion_beneficiario = 1 AND
g.estado_gestion = 1 AND
bt.nombre_beneficiario_tipo = "Beneficiario"';
				#$Criteria->group="beb.fk_id_beneficiario";
				$b=$model::model()->findAll($Criteria);
				$total=sizeof($b);
				$error="";
				$condi="";
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
								$condi=$condi." ".$condicion." like '%".$valor."%' and ";
							}
							$Criteria->condition=$condi."true";
							$condisort=$sort[0]['property'];
							$valorsort=$sort[0]['direction'];	
							$Criteria->order=$condisort.' '.$valorsort;
								
							#$Criteria->limit=$_GET['limit'];
							#$Criteria->offset=$_GET['start'];

							$bens=$model::model()->findAll($Criteria);
						}else{
							foreach ($filtro as $parametro) {
								$condicion=$parametro['property'];
								$valor=$parametro['value'];
								#$Criteria->condition=$condicion." like '%".$valor."%'";
								$condi=$condi." ".$condicion." like '%".$valor."%' and ";
							}
							$Criteria->condition=$condi."true";
							#$Criteria->limit=$_GET['limit'];
							#$Criteria->offset=$_GET['start'];
							$bens=$model::model()->findAll($Criteria);
						}
					}else {	
						if(isset($_GET['sort']) && $_GET['sort']!='') {
							$sort=CJSON::decode($_GET['sort']);
							$condisort=$sort[0]['property'];
							$valorsort=$sort[0]['direction'];	
							$Criteria->order=$condisort.' '.$valorsort;
							
							#$Criteria->limit=$_GET['limit'];
							#$Criteria->offset=$_GET['start'];
							$bens=$model::model()->findAll($Criteria);
						} else {
							#$Criteria->limit=$_GET['limit'];
							#$Criteria->offset=$_GET['start'];
							$bens=$model::model()->findAll($Criteria);
						}
						$total="".sizeof($bens);	
					}
				} catch (Exception $e) {
						$error=$e;
				}

				if ($error=="") {
					$arreglo=array();
					foreach($bens as $staff){
						$estado=0;
						$aux=array();
						$aux['id_beneficiario']					=(int)$staff->id_beneficiario;
						$aux['codigo_beneficiario']				=$staff->codigo_beneficiario;
						$aux['primer_nombre_beneficiario']		=$staff->primer_nombre_beneficiario;
						$aux['segundo_nombre_beneficiario']		=$staff->segundo_nombre_beneficiario;
						$aux['apellido_paterno_beneficiario']	=$staff->apellido_paterno_beneficiario;
						$aux['apellido_materno_beneficiario']	=$staff->apellido_materno_beneficiario;

						$aux2=array();
						foreach($staff->gestionBeneficiarios as $va){
							$aux2=$va->id_gestion_beneficiario;
						}
						$aux['id_gestion_beneficiario']=$aux2;
						
						$arreglo[]=$aux;	
					}
					
					$respuesta->success="true";
					#$respuesta->meta=array("success"=>"true");
					$respuesta->registros=$arreglo;	
					$respuesta->total=(int)$total;
					$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>$callback));
				} else {
					$respuesta->meta=array("success"=>"false","msg"=>$error);
					$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>$callback));
				}
		}else{
			$respuesta->meta=array("success"=>"false","msg"=>"Error de callback");
			$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>''));
		}
		
	}
}