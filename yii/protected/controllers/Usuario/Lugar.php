<?php
/**
* Esta clase es llamado por su controlador repectivo y en aqui se definen todas las acciones del controlador
* Es una clase que hereda de CAction
*/ 
class Lugar extends CAction
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
				$model=new LugarActividad();
				$Criteria=new CDbCriteria();
				$Criteria->join='INNER JOIN usuario_lugar AS ul ON ul.fk_id_lugar_actividad = t.id_lugar_actividad
INNER JOIN usuario AS u ON ul.fk_id_usuario = u.id_usuario';
				$Criteria->condition="u.id_usuario = ".Yii::app()->user->id;
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
						$aux['id_lugar_actividad']	=(int)$staff->id_lugar_actividad;
						$aux['nombre_lugar_actividad']=$staff->nombre_lugar_actividad;
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