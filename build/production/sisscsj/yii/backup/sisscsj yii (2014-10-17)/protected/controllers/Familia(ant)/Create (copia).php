<?php
/**
* Esta clase es llamado por su controlador repectivo y en aqui se definen todas las acciones del controlador
* Es una clase que hereda sus propiedad y metodos de la clase padre CAtion
*/ 
class Create extends CAction
{
/**
* La funcion run ejecuta la logica de la accion
* Su funcion es la de crear un nuevo registro y adicionarlo en una tabla
* @param array $callback se introduce el nombre de una funcion
*/
   public function run()
   {
		$controller=$this->getController();
		/*$model=new Familia();
		$modFamSerBa=new FamiliaServicioBasico();
		$modFaTiCa=new FamiliaTipoCasa();
		$modEvViFa=new EventoVitalFamilia();
		$modFaMePlaFa=new FamiliaMetodoPlanificacionFamiliar();
		$modBeFa= new BeneficiarioFamilia();
		$modFadi=new FamiliaDireccion();*/
		$model=new Familia();
		$listaRelaciones[]=new FamiliaServicioBasico();
		$listaRelaciones[]=new FamiliaTipoCasa();
		$listaRelaciones[]=new EventoVitalFamilia();
		$listaRelaciones[]=new FamiliaMetodoPlanificacionFamiliar();
		$listaRelaciones[]= new BeneficiarioFamilia();
		$listaRelaciones[]=new FamiliaDireccion();

		if (isset($_GET['records'])) {
			$records=CJSON::decode($_GET['records']);
			
			if (isset($_GET['callback']) && $_GET['callback']!=='' && !is_numeric($_GET['callback'])) {
				$callback=$_GET['callback'];
				
				if (isset($records['codigo_familia']) && 
					isset($records['codigo_familia_antiguo']) && 
					isset($records['numero_hijos_viven_familia']) && 
					isset($records['estado_familia']) && 
					isset($records['familia_servicio_basico']) &&
					isset($records['familia_tipo_casa']) &&
					isset($records['evento_vital_familia']) &&
					isset($records['familia_metodo_planificacion_familiar']) &&
					isset($records['beneficiario_familia']) &&
					isset($records['familia_direccion'])
					) {
					
					if ($records['estado_familia']=='true' || $records['estado_familia']===true) {
						$records['estado_familia']=1;
					}
					
					if ($records['estado_familia']=='false' || $records['estado_familia']===false) {
						$records['estado_familia']=0;
					}
					$model->codigo_familia 				=$records['codigo_familia'];
					$model->codigo_familia_antiguo		=$records['codigo_familia_antiguo'];
					$model->numero_hijos_viven_familia	=$records['numero_hijos_viven_familia'];
					$model->estado_familia				=$records['estado_familia'];

					$listaFamilia[]=$records['familia_servicio_basico'];
					$listaFamilia[]=$records['familia_tipo_casa'];
					$listaFamilia[]=$records['evento_vital_familia'];
					$listaFamilia[]=$records['familia_metodo_planificacion_familiar'];
					$listaFamilia[]=$records['beneficiario_familia'];
					$listaFamilia[]=$records['familia_direccion'];
					$contNotNull=0;
					$contValid=0;
					foreach ($listaFamilia as $value) {
						if ($value!=""){
							$contNotNull++;
						}
					}
					//*********************************
					$error = array();
					$i=0;
					foreach ($listaRelaciones as $value) {
						if ($listaFamilia[$i]!="") {
							$listaFamilia[$i]['fk_id_familia']=1;
							$res=$value->validaAtrib($listaFamilia[$i]);
							if($res===true)
								$contValid++;
							else
								$error=array_merge($error,$res);
						}
						$i++;
					}

					if ($contNotNull==$contValid) {
						$model->save();
						$id=$model->getPrimaryKey();
						$i=0;
						foreach ($listaRelaciones as $value) {
							if ($listaFamilia[$i]!="") {
								$listaFamilia[$i]['fk_id_familia']=$id;
								$value->insertar($listaFamilia[$i]);
							}
							$i++;
						}
						$respuesta->meta=array("success"=>"false", "msg"=>"OK!!!!");
						$controller->renderParTial('create', array('model'=>$respuesta,'callback'=>$callback));
					}else{
						$respuesta->meta=array("success"=>"false", "msg"=>$error);
						$controller->renderParTial('create', array('model'=>$respuesta,'callback'=>$callback));
					}
					 
					/*
					$error = array();
					if ($listaFamilia[0]!="") {
						$listaFamilia[0]['fk_id_familia']=1;
						$res=$modFamSerBa->validaAtrib($listaFamilia[0]);
						if($res===true)
							$contValid++;
						else
							$error=array_merge($error,$res);
					} 

					if ($listaFamilia[1]!="") {
						$listaFamilia[1]['fk_id_familia']=1;
						$res=$modFaTiCa->validaAtrib($listaFamilia[1]);
						if($res===true)
							$contValid++;
						else
							$error=array_merge($error,$res);
					} 

					if ($listaFamilia[2]!="") {
						$listaFamilia[2]['fk_id_familia']=1;
						$res=$modEvViFa->validaAtrib($listaFamilia[2]);
						if($res===true)
							$contValid++;
						else
							$error=array_merge($error,$res);
					}

					if ($listaFamilia[3]!="") {
						$listaFamilia[3]['fk_id_familia']=1;
						$res=$modFaMePlaFa->validaAtrib($listaFamilia[3]);
						if($res===true)
							$contValid++;
						else
							$error=array_merge($error,$res);
					} 

					if ($listaFamilia[4]!="") {
						$listaFamilia[4]['fk_id_familia']=1;
						$res=$modBeFa->validaAtrib($listaFamilia[4]);
						if($res===true)
							$contValid++;
						else
							$error=array_merge($error,$res);
					}

					if ($listaFamilia[5]!="") {
						$listaFamilia[5]['fk_id_familia']=1;
						$res=$modFadi->validaAtrib($listaFamilia[5]);
						if($res===true)
							$contValid++;
						else
							$error=array_merge($error,$res);
					}

					if ($contNotNull==$contValid) {
						$model->save();
						$id=$model->getPrimaryKey();
						if ($listaFamilia[0]!="") {
							$listaFamilia[0]['fk_id_familia']=$id;
							$modFamSerBa->insertar($listaFamilia[0]);
						}

						if ($listaFamilia[1]!="") {
							$listaFamilia[1]['fk_id_familia']=$id;
							$modFaTiCa->insertar($listaFamilia[1]);
							
						} 
						
						if ($listaFamilia[2]!="") {
							$listaFamilia[2]['fk_id_familia']=$id;
							$r=$modEvViFa->insertar($listaFamilia[2]);
						} 

						if ($listaFamilia[3]!="") {
							$listaFamilia[3]['fk_id_familia']=$id;
							$modFaMePlaFa->insertar($listaFamilia[3]);	
						} 

						if ($listaFamilia[4]!="") {
							$listaFamilia[4]['fk_id_familia']=$id;
							$modBeFa->insesrtar($listaFamilia[4]);
						}

						if ($listaFamilia[5]!="") {
							$listaFamilia[5]['fk_id_familia']=$id;
							$modFadi->insesrtar($listaFamilia[5]);
						}
						$respuesta->meta=array("success"=>"true", "msg"=>"Se creo exitosamente !!!");
						$controller->renderPartial('create', array('model'=>$respuesta,'callback'=>$callback));
					} else {
						$respuesta->meta=array("success"=>"false", "msg"=>$error);
						$controller->renderParTial('create', array('model'=>$respuesta,'callback'=>$callback));
					}*/	
				} else {
					$respuesta->meta=array("success"=>"false","msg"=>"Campos invalidos");
					$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>$callback));
				}
			} else {
				$respuesta->meta=array("success"=>"false","msg"=>"Error de callback");
				$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
			}
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>"Error variable indefinida quizas quiso decir records");
			$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
		}
	} //end run()
}