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
		$respuesta=new stdClass();
		$model=new Actividad();
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

			$listaRelaciones= array('actividad_tipo_actividad'	=>'ActividadTipoActividad',
									'actividad_area_actividad'	=>'ActividadAreaActividad',
									'beneficiario_asistencia'	=>'BeneficiarioAsistencia',
									'personal_asistencia'		=>'PersonalAsistencia',
									);
			$error="Error de llave foranea o campo indefinido";
			
			foreach ($params as $value) {
				
				$TotalEleVectores=0;
				$records=json_decode($value);
				foreach ($records as $propiedad => $valor) {
					
					if (is_array($valor)){
						
						$TotalEleVectores+=sizeof($valor);
					} else{
						if ($propiedad=="incluir_entorno_familiar")
							$incluir=$valor;
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
					$error="";
					//$total=$tam+$ListaTotalEleVec[$i];
					$records=CJSON::decode(urldecode($value));//{..p1:[{}],p2:[{}]..}
					$model=new Actividad();		
					$audi=new LogSistema();
					try {
						#$error.= (!isset($records['fk_id_usuario'])) ? "Variable indefinida {fk_id_usuario}" : "";
						$error.= (!isset($records['fk_id_gestion'])) ? "Variable indefinida {fk_id_gestion}" : "";
						$error.= (!isset($records['fk_id_lugar_actividad'])) ? "Variable indefinida {fk_id_lugar_actividad}" : "";
						$error.= (!isset($records['titulo_actividad'])) ? "Variable indefinida {titulo_actividad}" : "";
						$error.= (!isset($records['fecha_inicio_actividad'])) ? "Variable indefinida {fecha_inicio_actividad}" : "";
						$error.= (!isset($records['fecha_fin_actividad'])) ? "Variable indefinida {fecha_fin_actividad}" : "";
						$error.= (!isset($records['descripcion_actividad'])) ? "Variable indefinida {descripcion_actividad}" : "";
						if ($error=="") {

							$model->fk_id_usuario			=$records['fk_id_usuario'];
							$model->fk_id_gestion			=$records['fk_id_gestion'];
							$model->fk_id_lugar_actividad	=$records['fk_id_lugar_actividad'];
							$model->titulo_actividad		=$records['titulo_actividad'];
							$model->fecha_inicio_actividad	=$records['fecha_inicio_actividad'];
							$model->fecha_fin_actividad		=$records['fecha_fin_actividad'];
							$model->descripcion_actividad	=$records['descripcion_actividad'];
							
							if ($model->validate()) {
	
								$model->save();
								$audi->insertAudi("create",$model->tableName(),$model->getPrimaryKey());
								$id_actividad=$model->getPrimaryKey();
								
								$objAsistencia=new Asistencia();
								$audi=new LogSistema();
								$objAsistencia->fk_id_usuario			=$records['fk_id_usuario'];
								$objAsistencia->fk_id_actividad 		=$id_actividad;
								$objAsistencia->fecha_asistencia		=date("Y-m-d");
								$objAsistencia->observaciones_asistencia="";
								if ($objAsistencia->validate()) {
									
									$objAsistencia->save();
									$audi->insertAudi("create",$objAsistencia->tableName(),$objAsistencia->getPrimaryKey());
									$id_asistencia=$objAsistencia->getPrimaryKey();
									$activa=0;
									
									foreach ($records as $NomTabRel => $valor) {//key=nombre_tabla_atrib , $value=[{},{}] 0 ""
									
										if (is_array($valor) && sizeof($valor)!=0) {
									
											$activa=1;
											
											foreach ($valor as $subvalue) {
												
												if ($NomTabRel == "beneficiario_asistencia") {
													
													$obj=new BeneficiarioAsistencia();
													$audi=new LogSistema();
													$v=(int)$subvalue["fk_id_beneficiario"];
													$obj->fk_id_asistencia 			=$id_asistencia;
													$obj->fk_id_beneficiario		= $v;
													$obj->fk_id_estado_asistencia	=null;
													if ($obj->validate()) {
			       										$obj->save();
														$audi->insertAudi("create",$obj->tableName(),$obj->getPrimaryKey());
			       										$sw++;
			       									} else {
			       										$error=$obj->getErrors();
			       									}
													if ($incluir==1) {
														$res=$obj->lista_de_parientes($v);
														for ($j=0; $j < sizeof($res); $j++) { 
										 					
															$obj=new BeneficiarioAsistencia();
															$audi=new LogSistema();
															$obj->fk_id_asistencia 			=$id_asistencia;
															$obj->fk_id_beneficiario 		= (int)$res[0]['id_beneficiario'];
															$obj->fk_id_estado_asistencia	=NULL;
															if ($obj->validate()){
																$obj->save();
																$audi->insertAudi("create",$obj->tableName(),$obj->getPrimaryKey());
															}
														}
													}
													
												} else {
													if ($NomTabRel == "personal_asistencia") {
														
														$obj=new PersonalAsistencia();
														$audi=new LogSistema();
														$obj->fk_id_asistencia=$id_asistencia;
														$obj->fk_id_usuario=$subvalue['fk_id_usuario'];
														$obj->fk_id_estado_asistencia=NULL;
														
													} else {
														
														$obj=new $listaRelaciones[$NomTabRel]();
														$audi=new LogSistema();
														$obj->fk_id_actividad=$id_actividad;
														
														foreach ($subvalue as $key3 => $value3) {
															if ($obj->validaCampo($key3)) 
			           											$obj->$key3=$value3;
			       										}
			       										
													}
													if ($obj->validate()) {
			       										$obj->save();
														$audi->insertAudi("create",$obj->tableName(),$obj->getPrimaryKey());
			       										$sw++;
			       									} else {
			       										$error=$obj->getErrors();
			       									}		
												}
			
											}
										} 
									}//foreach
								$contValido++;
								}		
							} else {
								$error=$model->getErrors();	
							}
						} #else {
							#$error="Nombre de campos invalidos";
						#}//if validacion de campos
					} catch(Exception $e){
							$error=$e->getMessage();
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
	}
}