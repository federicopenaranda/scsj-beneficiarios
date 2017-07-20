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
		$model=new Beneficiario();
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
			
			$listaRelaciones =array('eval_atencion_medica'				=>'EvalAtencionMedica',
								  	'usuario_beneficiario'				=>'UsuarioBeneficiario',
									'eval_enfermeria'					=>'EvalEnfermeria',
									'beneficiario_idioma'				=>'BeneficiarioIdioma',
									'eval_odontologia'					=>'EvalOdontologia',
									'eval_nutricion'					=>'EvalNutricion',
									'eval_pedagogico'					=>'EvalPedagogico',
									'eval_edu_childfund'				=>'EvalEduChildfund',
									'eval_edu_nelson_ortiz'				=>'EvalEduNelsonOrtiz',
									'eval_psicologico'					=>'EvalPsicologico',
									'eval_computacion'					=>'EvalComputacion',
									'beneficiario_entidad'				=>'BeneficiarioEntidad',
									'beneficiario_asistencia'			=>'BeneficiarioAsistencia',
									'beneficiario_donante'				=>'BeneficiarioDonante',
									'beneficiario_patrocinador'			=>'BeneficiarioPatrocinador',
									'parentesco'						=>'Parentesco',
									'beneficiario_familia'				=>'BeneficiarioFamilia',
									'beneficiario_actividad_favorita'	=>'BeneficiarioActividadFavorita',
									'beneficiario_unidad_educativa'		=>'BeneficiarioUnidadEducativa',
									'beneficiario_otros_programas'		=>'BeneficiarioOtrosProgramas',
									'beneficiario_trabajo'				=>'BeneficiarioTrabajo',
									'beneficiario_ocupacion'			=>'BeneficiarioOcupacion',
									'beneficiario_estado_beneficiario'	=>'BeneficiarioEstadoBeneficiario',
									'beneficiario_tipo_identificacion'	=>'BeneficiarioTipoIdentificacion',
									'beneficiario_estado_civil'			=>'BeneficiarioEstadoCivil',
									'beneficiario_telefono'				=>'BeneficiarioTelefono',
									'gestion_beneficiario'				=>'GestionBeneficiario',
									'eval_atencion_medica'				=>'EvalAtencionMedica',
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
					$model=new Beneficiario();
					try {
						if (isset($records['fk_id_religion']) && 
							isset($records['fk_id_entidad_salud']) && 
							isset($records['fk_id_escolaridad']) && 
							isset($records['codigo_beneficiario']) && 
							isset($records['numero_identificacion_beneficiario']) && 
							isset($records['primer_nombre_beneficiario']) && 
							isset($records['segundo_nombre_beneficiario']) && 
							isset($records['apellido_paterno_beneficiario']) && 
							isset($records['apellido_materno_beneficiario']) && 
							isset($records['fecha_nacimiento_beneficiario']) && 
							isset($records['sexo_beneficiario']) && 
							isset($records['numero_hijo_beneficiario']) && 
							isset($records['fotografia_beneficiario']) && 
							isset($records['observacion_beneficiario']) && 
							isset($records['trabaja_beneficiario']) && 
							isset($records['carnet_de_salud_beneficiario']) && 
							isset($records['libreta_escolar_beneficiario']) && 
							isset($records['informacion_relevante_beneficiario'])
							) {

							$model->fk_id_religion						=$records['fk_id_religion'];
							$model->fk_id_entidad_salud					=$records['fk_id_entidad_salud'];
							$model->fk_id_escolaridad					=$records['fk_id_escolaridad'];
							$model->codigo_beneficiario					=$records['codigo_beneficiario'];
							$model->numero_identificacion_beneficiario	=$records['numero_identificacion_beneficiario'];
							$model->primer_nombre_beneficiario			=$records['primer_nombre_beneficiario'];
							$model->segundo_nombre_beneficiario			=$records['segundo_nombre_beneficiario'];
							$model->apellido_paterno_beneficiario		=$records['apellido_paterno_beneficiario'];
							$model->apellido_materno_beneficiario		=$records['apellido_materno_beneficiario'];
							$model->fecha_nacimiento_beneficiario		=$records['fecha_nacimiento_beneficiario'];
							$model->sexo_beneficiario					=$records['sexo_beneficiario'];
							$model->numero_hijo_beneficiario			=$records['numero_hijo_beneficiario'];
							$model->fotografia_beneficiario				=$records['fotografia_beneficiario'];
							$model->observacion_beneficiario			=$records['observacion_beneficiario'];
							$model->trabaja_beneficiario				=$records['trabaja_beneficiario'];
							$model->carnet_de_salud_beneficiario		=$records['carnet_de_salud_beneficiario'];
							$model->libreta_escolar_beneficiario		=$records['libreta_escolar_beneficiario'];
							$model->informacion_relevante_beneficiario	=$records['informacion_relevante_beneficiario'];
							
							if ($model->validate()) {
								
								$model->save();
								$id_beneficiario=$model->getPrimaryKey();
									
								foreach ($records as $NomTabRel => $valor) {//key=nombre_tabla_atrib , $value=[{},{}] 0 ""
									
									if (is_array($valor) && sizeof($valor)!=0) {
										
										if (isset($listaRelaciones[$NomTabRel])) {	
											foreach ($valor as $subvalue) {
															
												$obj=new $listaRelaciones[$NomTabRel]();
												$obj->fk_id_beneficiario=$id_beneficiario;
												
												foreach ($subvalue as $key3 => $value3) {
													if ($obj->validaCampo($key3)) {
					           							if ($key3=="fk_id_beneficiario")
					           								$obj->fk_id_beneficiario=$id_beneficiario;
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
										} else {
							       			$error="Nombre de variable indefinido {".$NomTabRel."}";
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

		/*$tam=sizeof($params);
		$contValido=0;
		$callback=$_GET['callback'];
		$transaction=$model->dbConnection->beginTransaction();
		try {
			foreach ($params as $value) {
				$model=new Beneficiario();
				$records=CJSON::decode(urldecode($value));
				if (json_last_error()==JSON_ERROR_NONE) {
				
					if (isset($records['fk_id_religion']) && 
						isset($records['fk_id_entidad_salud']) && 
						isset($records['fk_id_escolaridad']) && 
						isset($records['codigo_beneficiario']) && 
						isset($records['numero_identificacion_beneficiario']) && 
						isset($records['primer_nombre_beneficiario']) && 
						isset($records['segundo_nombre_beneficiario']) && 
						isset($records['apellido_paterno_beneficiario']) && 
						isset($records['apellido_materno_beneficiario']) && 
						isset($records['fecha_nacimiento_beneficiario']) && 
						isset($records['sexo_beneficiario']) && 
						isset($records['numero_hijo_beneficiario']) && 
						isset($records['fotografia_beneficiario']) && 
						isset($records['observacion_beneficiario']) && 
						isset($records['trabaja_beneficiario']) && 
						isset($records['carnet_de_salud_beneficiario']) && 
						isset($records['libreta_escolar_beneficiario']) && 
						isset($records['informacion_relevante_beneficiario'])
						) {

						if ($records['trabaja_beneficiario']=='true' || $records['trabaja_beneficiario']===true){
							$records['trabaja_beneficiario']=1;
						}
					
						if ($records['trabaja_beneficiario']=='false' || $records['trabaja_beneficiario']===false){
							$records['trabaja_beneficiario']=0;
						}

						if ($records['carnet_de_salud_beneficiario']=='true' || $records['carnet_de_salud_beneficiario']===true){
							$records['carnet_de_salud_beneficiario']=1;
						}
					
						if ($records['carnet_de_salud_beneficiario']=='false' || $records['carnet_de_salud_beneficiario']===false){
							$records['carnet_de_salud_beneficiario']=0;
						}

						if ($records['libreta_escolar_beneficiario']=='true' || $records['libreta_escolar_beneficiario']===true){
							$records['libreta_escolar_beneficiario']=1;
						}
					
						if ($records['libreta_escolar_beneficiario']=='false' || $records['libreta_escolar_beneficiario']===false){
							$records['libreta_escolar_beneficiario']=0;
						}
					
						if ($model->validaFK('religion','id_religion',$records['fk_id_religion'])!==false && 
							$model->validaFK('entidad_salud','id_entidad_salud',$records['fk_id_entidad_salud'])!==false &&
							$model->validaFK('escolaridad','id_escolaridad',$records['fk_id_escolaridad'])!==false
							){
							$model->fk_id_religion						=$records['fk_id_religion'];
							$model->fk_id_entidad_salud					=$records['fk_id_entidad_salud'];
							$model->fk_id_escolaridad					=$records['fk_id_escolaridad'];
							$model->codigo_beneficiario					=$records['codigo_beneficiario'];
							$model->numero_identificacion_beneficiario	=$records['numero_identificacion_beneficiario'];
							$model->primer_nombre_beneficiario			=$records['primer_nombre_beneficiario'];
							$model->segundo_nombre_beneficiario			=$records['segundo_nombre_beneficiario'];
							$model->apellido_paterno_beneficiario		=$records['apellido_paterno_beneficiario'];
							$model->apellido_materno_beneficiario		=$records['apellido_materno_beneficiario'];
							$model->fecha_nacimiento_beneficiario		=$records['fecha_nacimiento_beneficiario'];
							$model->sexo_beneficiario					=$records['sexo_beneficiario'];
							$model->numero_hijo_beneficiario			=$records['numero_hijo_beneficiario'];
							$model->fotografia_beneficiario				=$records['fotografia_beneficiario'];
							$model->observacion_beneficiario			=$records['observacion_beneficiario'];
							$model->trabaja_beneficiario				=$records['trabaja_beneficiario'];
							$model->carnet_de_salud_beneficiario		=$records['carnet_de_salud_beneficiario'];
							$model->libreta_escolar_beneficiario		=$records['libreta_escolar_beneficiario'];
							$model->informacion_relevante_beneficiario	=$records['informacion_relevante_beneficiario'];
							
							$listaRelaciones=array('eval_atencion_medica'			=>'EvalAtencionMedica',
												'usuario_beneficiario'				=>'UsuarioBeneficiario',
												'eval_enfermeria'					=>'EvalEnfermeria',
												'beneficiario_idioma'				=>'BeneficiarioIdioma',
												'eval_odontologia'					=>'EvalOdontologia',
												'eval_nutricion'					=>'EvalNutricion',
												'eval_pedagogico'					=>'EvalPedagogico',
												'eval_edu_childfund'				=>'EvalEduChildfund',
												'eval_edu_nelson_ortiz'				=>'EvalEduNelsonOrtiz',
												'eval_psicologico'					=>'EvalPsicologico',
												'eval_computacion'					=>'EvalComputacion',
												'beneficiario_entidad'				=>'BeneficiarioEntidad',
												'beneficiario_asistencia'			=>'BeneficiarioAsistencia',
												'beneficiario_donante'				=>'BeneficiarioDonante',
												'beneficiario_patrocinador'			=>'BeneficiarioPatrocinador',
												'parentesco'						=>'Parentesco',
												'beneficiario_familia'				=>'BeneficiarioFamilia',
												'beneficiario_actividad_favorita'	=>'BeneficiarioActividadFavorita',
												'beneficiario_unidad_educativa'		=>'BeneficiarioUnidadEducativa',
												'beneficiario_otros_programas'		=>'BeneficiarioOtrosProgramas',
												'beneficiario_trabajo'				=>'BeneficiarioTrabajo',
												'beneficiario_ocupacion'			=>'BeneficiarioOcupacion',
												'beneficiario_estado_beneficiario'	=>'BeneficiarioEstadoBeneficiario',
												'beneficiario_tipo_identificacion'	=>'BeneficiarioTipoIdentificacion',
												'beneficiario_estado_civil'			=>'BeneficiarioEstadoCivil',
												'beneficiario_telefono'				=>'BeneficiarioTelefono',
												'gestion_beneficiario'				=>'GestionBeneficiario',
												'eval_atencion_medica'				=>'EvalAtencionMedica',
											);
							$contNotNull=0;
							//print_r($records)."<br>";
							echo sizeof($records);
							foreach ($records as $k => $v) {
								if (is_array($v))
									$contNotNull=$contNotNull+sizeof($v);
							}

							echo "contNotNull ".$contNotNull;
							$error = array();
							$cont=0;
							//$transaction=$model->dbConnection->beginTransaction();
							
							if ($model->validate()) {
								$model->save();
								$id=$model->getPrimaryKey();
								//try {
									foreach ($records as $key => $value) {
										$json_value=json_decode($value);	
									
										if (is_array($json_value) && sizeof($json_value)!=0){
										
											foreach ($json_value as $value2) {

												foreach ($listaRelaciones as $nomtab => $nommod) {
											
													switch ($key) {
														case $nomtab:
															$obj=new $nommod();
															$obj->fk_id_beneficiario=$id;
															try{
																foreach ($value2 as $key3 => $value3) {
           															if($value3===true){
           																$value3=1;
           															}
           															if($value3===false){
           																$value3=0;
           															}
           															$obj->$key3=$value3;
       															}
															} catch (Exception $a) {
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
										} else {
											if ($records[$key]==1 && $key=="registro_gestion_actual") {
												$post=new Gestion();
												$gb=new GestionBeneficiario();
												$ges=$post->find('estado_gestion=1');
												if (!is_null($ges)) {
													$val=$ges->getPrimaryKey();
													$gb->fk_id_beneficiario=$id;
													$gb->fk_id_gestion=$val;
													$gb->estado_gestion_beneficiario=1;
													$gb->save();
												}
											}
										}
									}//foreach
									if ($cont==$contNotNull){
										//echo "cont ".$cont;
										//echo "contNotNull ".$contNotNull;
										$contValido++;
										//$transaction->commit();
										//$respuesta->meta=array("success"=>"true", "msg"=>"Se creo exitosamente !!!");
										//$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));
									}# else {
									#	$transaction->rollback();
									#	$respuesta->meta=array("success"=>"false","msg"=>$error);
									#	$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));
									#}
								//} catch (Exception $e) {
								//	$transaction->rollback();
								//	throw $e;
								//}
							} else {
								$respuesta->meta=array("success"=>"false","msg"=>$model->getErrors());
								$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>$callback));
							}
							
						//*******************************************************************
						} else {
							$respuesta->meta=array("success"=>"false","msg"=>"Error llave foranea");
							$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>$callback));
						}
					} else {
						$respuesta->meta=array("success"=>"false","msg"=>"Campos invalidos");
						$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>$callback));
					}
				} else {
					echo "NO ES JSON";
				}
			}//foreach params
			if($contValido==$tam) {
				//echo $contValido;
				echo "VALIDO";
				//$transaction->commit();
				//$respuesta->meta=array("success"=>"true", "msg"=>"Se creo exitosamente !!!");
				//$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));
			} else {
				echo "NO VALIDO";
			}
		} catch (Exception $e) {
			$transaction->rollback();
			throw $e;
		}
		/*if (isset($_GET['records'])) {
			
			$str=str_replace('"[', '[',$_GET['records']);
			$str=str_replace(']"', ']',$str);
			$str=str_replace('\"', '"', $str);
			$records=CJSON::decode($str);
			if(json_last_error()==JSON_ERROR_NONE){

				if (isset($_GET['callback'])&&$_GET['callback']!=='' && !is_numeric($_GET['callback'])){
					$callback=$_GET['callback'];
				
					if (isset($records['fk_id_religion']) && 
						isset($records['fk_id_entidad_salud']) && 
						isset($records['fk_id_escolaridad']) && 
						isset($records['codigo_beneficiario']) && 
						isset($records['numero_identificacion_beneficiario']) && 
						isset($records['primer_nombre_beneficiario']) && 
						isset($records['segundo_nombre_beneficiario']) && 
						isset($records['apellido_paterno_beneficiario']) && 
						isset($records['apellido_materno_beneficiario']) && 
						isset($records['fecha_nacimiento_beneficiario']) && 
						isset($records['sexo_beneficiario']) && 
						isset($records['numero_hijo_beneficiario']) && 
						isset($records['fotografia_beneficiario']) && 
						isset($records['observacion_beneficiario']) && 
						isset($records['trabaja_beneficiario']) && 
						isset($records['carnet_de_salud_beneficiario']) && 
						isset($records['libreta_escolar_beneficiario']) && 
						isset($records['informacion_relevante_beneficiario'])
						) {

						if ($records['trabaja_beneficiario']=='true' || $records['trabaja_beneficiario']===true){
							$records['trabaja_beneficiario']=1;
						}
					
						if ($records['trabaja_beneficiario']=='false' || $records['trabaja_beneficiario']===false){
							$records['trabaja_beneficiario']=0;
						}

						if ($records['carnet_de_salud_beneficiario']=='true' || $records['carnet_de_salud_beneficiario']===true){
							$records['carnet_de_salud_beneficiario']=1;
						}
					
						if ($records['carnet_de_salud_beneficiario']=='false' || $records['carnet_de_salud_beneficiario']===false){
							$records['carnet_de_salud_beneficiario']=0;
						}

						if ($records['libreta_escolar_beneficiario']=='true' || $records['libreta_escolar_beneficiario']===true){
							$records['libreta_escolar_beneficiario']=1;
						}
					
						if ($records['libreta_escolar_beneficiario']=='false' || $records['libreta_escolar_beneficiario']===false){
							$records['libreta_escolar_beneficiario']=0;
						}
					
						if ($model->validaFK('religion','id_religion',$records['fk_id_religion'])!==false && 
							$model->validaFK('entidad_salud','id_entidad_salud',$records['fk_id_entidad_salud'])!==false &&
							$model->validaFK('escolaridad','id_escolaridad',$records['fk_id_escolaridad'])!==false
							){
							$model->fk_id_religion						=$records['fk_id_religion'];
							$model->fk_id_entidad_salud					=$records['fk_id_entidad_salud'];
							$model->fk_id_escolaridad					=$records['fk_id_escolaridad'];
							$model->codigo_beneficiario					=$records['codigo_beneficiario'];
							$model->numero_identificacion_beneficiario	=$records['numero_identificacion_beneficiario'];
							$model->primer_nombre_beneficiario			=$records['primer_nombre_beneficiario'];
							$model->segundo_nombre_beneficiario			=$records['segundo_nombre_beneficiario'];
							$model->apellido_paterno_beneficiario		=$records['apellido_paterno_beneficiario'];
							$model->apellido_materno_beneficiario		=$records['apellido_materno_beneficiario'];
							$model->fecha_nacimiento_beneficiario		=$records['fecha_nacimiento_beneficiario'];
							$model->sexo_beneficiario					=$records['sexo_beneficiario'];
							$model->numero_hijo_beneficiario			=$records['numero_hijo_beneficiario'];
							$model->fotografia_beneficiario				=$records['fotografia_beneficiario'];
							$model->observacion_beneficiario			=$records['observacion_beneficiario'];
							$model->trabaja_beneficiario				=$records['trabaja_beneficiario'];
							$model->carnet_de_salud_beneficiario		=$records['carnet_de_salud_beneficiario'];
							$model->libreta_escolar_beneficiario		=$records['libreta_escolar_beneficiario'];
							$model->informacion_relevante_beneficiario	=$records['informacion_relevante_beneficiario'];
							
							$listaRelaciones=array('eval_atencion_medica'			=>'EvalAtencionMedica',
												'usuario_beneficiario'				=>'UsuarioBeneficiario',
												'eval_enfermeria'					=>'EvalEnfermeria',
												'beneficiario_idioma'				=>'BeneficiarioIdioma',
												'eval_odontologia'					=>'EvalOdontologia',
												'eval_nutricion'					=>'EvalNutricion',
												'eval_pedagogico'					=>'EvalPedagogico',
												'eval_edu_childfund'				=>'EvalEduChildfund',
												'eval_edu_nelson_ortiz'				=>'EvalEduNelsonOrtiz',
												'eval_psicologico'					=>'EvalPsicologico',
												'eval_computacion'					=>'EvalComputacion',
												'beneficiario_entidad'				=>'BeneficiarioEntidad',
												'beneficiario_asistencia'			=>'BeneficiarioAsistencia',
												'beneficiario_donante'				=>'BeneficiarioDonante',
												'beneficiario_patrocinador'			=>'BeneficiarioPatrocinador',
												'parentesco'						=>'Parentesco',
												'beneficiario_familia'				=>'BeneficiarioFamilia',
												'beneficiario_actividad_favorita'	=>'BeneficiarioActividadFavorita',
												'beneficiario_unidad_educativa'		=>'BeneficiarioUnidadEducativa',
												'beneficiario_otros_programas'		=>'BeneficiarioOtrosProgramas',
												'beneficiario_trabajo'				=>'BeneficiarioTrabajo',
												'beneficiario_ocupacion'			=>'BeneficiarioOcupacion',
												'beneficiario_estado_beneficiario'	=>'BeneficiarioEstadoBeneficiario',
												'beneficiario_tipo_identificacion'	=>'BeneficiarioTipoIdentificacion',
												'beneficiario_estado_civil'			=>'BeneficiarioEstadoCivil',
												'beneficiario_telefono'				=>'BeneficiarioTelefono',
												'gestion_beneficiario'				=>'GestionBeneficiario',
												'eval_atencion_medica'				=>'EvalAtencionMedica',
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
															$obj->fk_id_beneficiario=$id;
															try{
																foreach ($value2 as $key3 => $value3) {
           															if($value3===true){
           																$value3=1;
           																#$obj->$key3=1;
           															}
           															if($value3===false){
           																$value3=0;
           																#$obj->$key3=0;
           															}
           															$obj->$key3=$value3;
       															}
															} catch (Exception $a) {
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
										} else {
											if ($records[$key]==1 && $key=="registro_gestion_actual") {
												$post=new Gestion();
												$gb=new GestionBeneficiario();
												$ges=$post->find('estado_gestion=1');
												if (!is_null($ges)) {
													$val=$ges->getPrimaryKey();
													$gb->fk_id_beneficiario=$id;
													$gb->fk_id_gestion=$val;
													$gb->estado_gestion_beneficiario=1;
													$gb->save();
												}
											}
										}
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
							} else {
								$respuesta->meta=array("success"=>"false","msg"=>$model->getErrors());
								$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>$callback));
							}
							
						//*******************************************************************
						} else {
							$respuesta->meta=array("success"=>"false","msg"=>"Error llave foranea");
							$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>$callback));
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
				$respuesta->meta=array("success"=>"false","msg"=>"Error de JSON");
				$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
			}
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>"Error variable indefinida quizas quiso decir records");
			$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
		}*/
	}
}
