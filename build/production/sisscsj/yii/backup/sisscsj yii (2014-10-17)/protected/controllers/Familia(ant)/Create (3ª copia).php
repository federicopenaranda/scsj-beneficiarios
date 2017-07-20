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

		if (isset($_GET['records'])) {
			$records=CJSON::decode($_GET['records']);
			
			if (isset($_GET['callback']) && $_GET['callback']!=='' && !is_numeric($_GET['callback'])) {
				$callback=$_GET['callback'];
				
				if (isset($records['codigo_familia']) && 
					isset($records['codigo_familia_antiguo']) && 
					isset($records['numero_hijos_viven_familia']) && 
					isset($records['estado_familia'])
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

					if (isset($records['familia_servicio_basico'])){
						$listaRelaciones[0]=new FamiliaServicioBasico();
						$listaObjetos[0]=$records['familia_servicio_basico'];
					} else {
						$listaRelaciones[0]="";
						$listaObjetos[0]=null;
					}
					if (isset($records['familia_tipo_casa'])){
						$listaRelaciones[1]=new FamiliaTipoCasa();
						$listaObjetos[1]=$records['familia_tipo_casa'];
					} else {
						$listaRelaciones[1]="";
						$listaObjetos[1]=null;
					}
					if (isset($records['evento_vital_familia'])){
						$listaRelaciones[2]=new EventoVitalFamilia();
						$listaObjetos[2]=$records['evento_vital_familia'];
					} else {
						$listaRelaciones[2]="";
						$listaObjetos[2]=null;
					}
					if (isset($records['familia_metodo_planificacion_familiar'])){
						$listaRelaciones[3]=new FamiliaMetodoPlanificacionFamiliar();
						$listaObjetos[3]=$records['familia_metodo_planificacion_familiar'];
					} else {
						$listaRelaciones[3]="";
						$listaObjetos[3]=null;
					}
					if (isset($records['beneficiario_familia'])){
						$listaRelaciones[4]=new BeneficiarioFamilia();
						$listaObjetos[4]=$records['beneficiario_familia'];
					} else {
						$listaRelaciones[4]="";
						$listaObjetos[4]=null;
					}
					if (isset($records['familia_direccion'])){
						$listaRelaciones[5]=new FamiliaDireccion();
						$listaObjetos[5]=$records['familia_direccion'];
					} else {
						$listaRelaciones[5]="";
						$listaObjetos[5]=null;
					}
	
					$contNotNull=0;
					$i=0;
					foreach ($listaObjetos as $value) {

						if ($value!=null) {

							for ($j=0; $j <sizeof($listaObjetos[$i]) ; $j++) {
								
								if($listaObjetos[$i][$j]!="") 
									$contNotNull++;
							}
						}
						$i++;
					}

					$error = array();
					$transaction=$model->dbConnection->beginTransaction();
					$contValidos=0;
					try{
						if ($model->save()) {
							$id=$model->getPrimaryKey();
							$i=0;

							foreach ($listaRelaciones as $value) {

								if ($listaObjetos[$i]!="") {
									$j=0;
									foreach ($listaObjetos[$i] as $listafam) {

										if ($listaObjetos[$i][$j]!="") {
											$listaObjetos[$i][$j]['fk_id_familia']=$id;
										
											switch ($i) {
												case 0:
													$obj=new FamiliaServicioBasico();
													foreach ($listaObjetos[$i][$j] as $key => $value) {
           												$obj->$key=$value;
       												}
       												try {
       													if ($obj->save())
            												$contValidos++;
            											else
															$error=array_merge($error,$obj->getErrors());
       												} catch (Exception $e) {
       													$error=$e;
       												}
													break;
												case 1:
													$obj=new FamiliaTipoCasa();
													foreach ($listaObjetos[$i][$j] as $key => $value) {
           												$obj->$key=$value;
       												}
       												try {
       													if ($obj->save())
            												$contValidos++;
            											else
															$error=array_merge($error,$obj->getErrors());
       												} catch (Exception $e) {
       													$error=$e;
       												}
													break;
												case 2:
													$obj=new EventoVitalFamilia();
													foreach ($listaObjetos[$i][$j] as $key => $value) {
           												$obj->$key=$value;
       												}
       												try {
       													if ($obj->save())
            												$contValidos++;
            											else
															$error=array_merge($error,$obj->getErrors());
       												} catch (Exception $e) {
       													$error=$e;
       												}
													break;
												case 3:
													$obj=new FamiliaMetodoPlanificacionFamiliar();
													foreach ($listaObjetos[$i][$j] as $key => $value) {
           												$obj->$key=$value;
       												}
       												try {
       													if ($obj->save())
            												$contValidos++;
            											else
															$error=array_merge($error,$obj->getErrors());
       												} catch (Exception $e) {
       													$error=$e;
       												}
													break;
												case 4:
													$obj=new BeneficiarioFamilia();
													foreach ($listaObjetos[$i][$j] as $key => $value) {
           												$obj->$key=$value;
       												}
       												try {
       													if ($obj->save())
            												$contValidos++;
            											else
															$error=array_merge($error,$obj->getErrors());
       												} catch (Exception $e) {
       													$error=$e;
       												}
													break;
												case 5:
													$obj=new FamiliaDireccion();
													foreach ($listaObjetos[$i][$j] as $key => $value) {
           												$obj->$key=$value;
       												}
       												try {
       													if ($obj->save())
            												$contValidos++;
            											else
															$error=array_merge($error,$obj->getErrors());
       												} catch (Exception $e) {
       													$error=$e;
       												}
													break;
											}//switch ($i) {
										}//if ($listaObjetos[$i][$j]!="") {
										$j++;
									}//foreach
								}//if
								$i++;
							}//foreach
							if ($contValidos==$contNotNull) {
								$transaction->commit();
								$respuesta->meta=array("success"=>"true", "msg"=>"Se creo exitosamente !!!");
								$controller->renderParTial('create', array('model'=>$respuesta, 'callback'=>$callback));
							} else {
								$transaction->rollback();
								$respuesta->meta=array("success"=>"false", "msg"=>$error);
								$controller->renderParTial('create', array('model'=>$respuesta, 'callback'=>$callback));
							}
						} else {
							$respuesta->meta=array("success"=>"false", "msg"=>$model->getErrors());
							$controller->renderParTial('create', array('model'=>$respuesta, 'callback'=>$callback));
						}//if
					}catch(Exception $e){
							$transaction->rollback();
							throw $e;
					}
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