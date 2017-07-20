<?php
/**
* Esta clase es llamado por su controlador repectivo y en aqui se definen todas las acciones del controlador
* Es una clase que hereda sus propiedad y metodos de la clase padre CAtion
*/ 
class Create extends CAction{
/**
* La funcion run ejecuta la logica de la accion
* Su funcion es la de crear un nuevo registro y adicionarlo en una tabla
* @param array $callback se introduce el nombre de una funcion
*/
   public function run(){
		$controller=$this->getController();
		$model=new EntidadSalud();
		$respuesta=new stdClass();
		if (isset($_GET['callback']) && $_GET['callback']!=='' && !is_numeric($_GET['callback']) && isset($_GET['records'])) {
			$callback=$_GET['callback'];
			$query=explode('&', $_SERVER['QUERY_STRING']);
			$params=array();

			foreach ($query as $value) {
				if (strpos($value,"records")!==FAlSE){
					$str=str_replace('"[', '[',trim(urldecode($value),"recods="));
					$str=str_replace(']"', ']',$str);
					$str=str_replace('\"', '"', $str);
					$params[]=$str;
				} 
			}
			$tam=sizeof($params);
			
			$listaRelaciones= array('beneficiario'=>'Beneficiario',
									);
			$error="Error de llave foranea o campo indefinido";

			foreach ($params as $value) {
				
				$TotalEleVectores=0;
				$records=json_decode($value);
				foreach ($records as $propiedad => $valor) {
					
					if (is_array($valor)){
						$TotalEleVectores+=sizeof($valor);
					} 
				}
				$ListaTotalEleVec[]=$TotalEleVectores;
			}
			
			$NumVal=0;
			$i=0;
			$transaction=$model->dbConnection->beginTransaction();
			try {
				foreach ($params as $value) {
					$sw=0;
					$contValido=0;
					$records=CJSON::decode(urldecode($value));//{..p1:[{}],p2:[{}]..}
					$model=new EntidadSalud();
					try {
						if (isset($records['nombre_entidad_salud']) && 
							isset($records['observaciones_entidad_salud'])
							) {

							$model->nombre_entidad_salud  		=$records['nombre_entidad_salud'];
							$model->observaciones_entidad_salud	=$records['observaciones_entidad_salud'];
							if ($model->validate()) {
								
								$model->save();
								$id_entidad_salud=$model->getPrimaryKey();
									
								foreach ($records as $NomTabRel => $valor) {//key=nombre_tabla_atrib , $value=[{},{}] 0 ""
									
									if (is_array($valor) && sizeof($valor)!=0) {
											
										foreach ($valor as $subvalue) {
														
											$obj=new $listaRelaciones[$NomTabRel]();
											$obj->fk_id_entidad_salud=$id_entidad_salud;
											
											foreach ($subvalue as $key3 => $value3) {
												if ($obj->validaCampo($key3)) {
				           							if ($key3=="fk_id_entidad_salud")
				           								$obj->fk_id_entidad_salud=$id_entidad_salud;
				           							else
				           								$obj->$key3=$value3;
				           						}
			       							}

											if ($obj->validate()) {
			       								$obj->save();
			       								$sw++;
			       							} else {
			       								$error=$obj->getErrors();
			       							}
										}
									} 
								}//foreach
								$contValido++;	

							} else {
								$error=$model->getErrors();
							}
						} else {
							$error="Nombre de campos invalidos";
						}//if validacion de campos
					} catch(Exception $e){
							//$error=$e->getMessage();
					}
					if ($sw+$contValido==$ListaTotalEleVec[$i]+1) {
						$NumVal++;
					} 
					$i++;	
				}//foreach

				if ($NumVal==$tam) {
					$transaction->commit();
					$respuesta->meta=array("success"=>"true", "msg"=>"Se creo exitosamente !!!");
					$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));
				} else {
					$transaction->rollback();
					$respuesta->meta=array("success"=>"false","msg"=>$error);
					$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));
				}	
			} catch (Exception $e) {
				$transaction->rollback();
				throw $e;
			}
		} else { //callback
			$respuesta->meta=array("success"=>"false","msg"=>"Error de callback");
			$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
		}

		/*if (isset($_GET['records'])) {
			$str=str_replace('"[', '[',$_GET['records']);
			$str=str_replace(']"', ']',$str);
			$str=str_replace('\"', '"', $str);
			$records=CJSON::decode($str);

			if (json_last_error()==JSON_ERROR_NONE) {
				
				if (isset($_GET['callback']) && $_GET['callback']!=='' && !is_numeric($_GET['callback'])){
					$callback=$_GET['callback'];
					
					if (isset($records['nombre_entidad_salud']) && isset($records['observaciones_entidad_salud'])){
						$model->nombre_entidad_salud=$records['nombre_entidad_salud'];
						$model->observaciones_entidad_salud=$records['observaciones_entidad_salud'];
						//*********************************************************
						$listaRelaciones= array('beneficiario'=>'Beneficiario',
											);
						$contNotNull=0;
						foreach ($records as $k => $v) {
							if (is_array($v))
								$contNotNull=$contNotNull+sizeof($v);
						}
						$error = array();
						$cont=0;
						$transaction=$model->dbConnection->beginTransaction();
						if ($model->validate()) {
							$model->save();
							$id=$model->getPrimaryKey();
							try {
								foreach ($records as $key => $value) {
								
									if (is_array($value) && sizeof($value)!=0){
										foreach ($value as $value2) {

											foreach ($listaRelaciones as $nomtab => $nommod) {
											
												switch ($key) {
													case $nomtab:
														$obj=new $nommod();
														$obj->fk_id_entidad_salud=$id;
														try{
															foreach ($value2 as $key3 => $value3) {
           														if($value3===true)
           															$value3=1;
           														if($value3===false)
           															$value3=0;
           														$obj->$key3=$value3;
       														}
														}catch (Exception $e) {
															$error="Error, nombre de atributos invalidos";
       														$cont=-1;		
       													}
													
       													try {
															if ($obj->validate()){
																$obj->save(); 
            													$cont++; 
															} else {
            														throw new Exception("Error");
															}
            														
														} catch (Exception $e) {
															if($e->getMessage()=="Error")
																$error=$obj->getErrors();
															else
																$error=$e->getMessage();
														}
														break;
												}
											}	
										}//foreach
									}//if
								}//foreach
								if ($cont==$contNotNull){
									$transaction->commit();
									$respuesta->meta=array("success"=>"true", "msg"=>"Se creo exitosamente !!!");
									$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));
								} else {
									$transaction->rollback();
									$respuesta->meta=array("success"=>"false","msg"=>$error);
									$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));
								}
							} catch (Exception $e) {
								$transaction->rollback();
								throw $e;
							}
						}else{
							$respuesta->meta=array("success"=>"false","msg"=>$model->getErrors());
							$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>$callback));
						}//if
						//*******************************************************
					} else {
						$respuesta->meta=array("success"=>"false","msg"=>"Campos invalidos");
						$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>$callback));
					}
				} else {
					$respuesta->meta=array("success"=>"false","msg"=>"Error de callback");
					$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
				}
			} else {
				$respuesta->meta=array("success"=>"false","msg"=>"Error de sintaxis JSON");
				$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
			}
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>"Error variable indefinida quizas quiso decir records");
			$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
		}*/
	}
}