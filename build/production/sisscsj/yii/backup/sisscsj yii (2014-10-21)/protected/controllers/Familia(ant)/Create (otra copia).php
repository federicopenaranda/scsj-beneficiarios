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
		$model=new Familia();
		$listaRelaciones[]=new FamiliaServicioBasico();
		$listaRelaciones[]=new FamiliaTipoCasa();
		$listaRelaciones[]=new EventoVitalFamilia();
		$listaRelaciones[]=new FamiliaMetodoPlanificacionFamiliar();
		$listaRelaciones[]=new BeneficiarioFamilia();
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
					$i=0;
					foreach ($listaFamilia as $value) {

						if ($value!="") {

							for ($j=0; $j <sizeof($listaFamilia[$i]) ; $j++) {
								
								if($listaFamilia[$i][$j]!="") 
									$contNotNull++;
							}
						}
						$i++;
					}

					$error = array();
					$i=0;
					foreach ($listaRelaciones as $value) {//5

						if ($listaFamilia[$i]!="") {

							for ($j=0;$j<sizeof($listaFamilia[$i]);$j++) {

								if ($listaFamilia[$i][$j]!="") {
									$listaFamilia[$i][$j]['fk_id_familia']=1;
									$res=$value->validaAtrib($listaFamilia[$i][$j]);

									if($res===true)
										$contValid++;
									else
										$error=array_merge($error,$res);
								}
							}
						}
						$i++;
					}

					if ($contNotNull==$contValid) {
						$model->save();
						$id=$model->getPrimaryKey();
						$i=0;

						foreach ($listaRelaciones as $value) {//5

							if ($listaFamilia[$i]!="") {
								$j=0;
								foreach ($listaFamilia[$i] as $listafam) {

									if ($listaFamilia[$i][$j]!="") {
										$listaFamilia[$i][$j]['fk_id_familia']=$id;
										
										switch ($i) {
											case 0:
												$obj=new FamiliaServicioBasico();
												$obj->insertar($listaFamilia[$i][$j]);
												break;
											case 1:
												$obj=new FamiliaTipoCasa();
												$obj->insertar($listaFamilia[$i][$j]);
												break;
											case 2:
												$obj=new EventoVitalFamilia();
												$obj->insertar($listaFamilia[$i][$j]);
												break;
											case 3:
												$obj=new FamiliaMetodoPlanificacionFamiliar();
												$obj->insertar($listaFamilia[$i][$j]);
												break;
											case 4:
												$obj=new BeneficiarioFamilia();
												$obj->insertar($listaFamilia[$i][$j]);
												break;
											case 5:
												$obj=new FamiliaDireccion();
												$obj->insertar($listaFamilia[$i][$j]);
												break;
										}
									}
									$j++;
								}
							}
							$i++;
						}
						$respuesta->meta=array("success"=>"true", "msg"=>"Se creo exitosamente !!!");
						$controller->renderParTial('create', array('model'=>$respuesta, 'callback'=>$callback));
					} else {
						$respuesta->meta=array("success"=>"false", "msg"=>$error);
						$controller->renderParTial('create', array('model'=>$respuesta, 'callback'=>$callback));
					}
					/*******************************************************

					/*foreach ($listaFamilia as $value) {
						if ($value!="") {
							$contNotNull++;
						}
					}
					$error = array();
					$i=0;
					foreach ($listaRelaciones as $value) {
						if ($listaFamilia[$i]!="") {
							// id ficticio
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
						$respuesta->meta=array("success"=>"true", "msg"=>"Se creo exitosamente !!!");
						$controller->renderParTial('create', array('model'=>$respuesta,'callback'=>$callback));
					}else{
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