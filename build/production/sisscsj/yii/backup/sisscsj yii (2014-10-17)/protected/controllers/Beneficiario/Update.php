<?php 
/**
* Esta clase es llamado por su controlador repectivo y en aqui se definen todas las acciones del controlador
* Es una clase que hereda sus propiedades y metodos de CAction
*/ 
class Update extends CAction{
/**
* La funcion run ejecuta la logica de la accion
* Su funcion es la de actualizar todos los registros de una tabla en la base de datos
* @param array $callback se introduce el nombre de una funcion
*/
    public function run(){
		$controller=$this->getController();
		$respuesta=new stdClass();
		$model=new Beneficiario();
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
			$estado=0;
			foreach ($params as $value) {
				
				$TotalEleVectores=0;
				$records=json_decode($value);
				foreach ($records as $propiedad => $valor) {
					
					if (is_array($valor)) {
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
					try {
						if (isset($records['id_beneficiario']) && 
							isset($records['fk_id_religion']) && 
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

							$model=Beneficiario::model()->findByPk($records['id_beneficiario']);
							if ($model!==null) {
								$model->fk_id_religion 						=$records['fk_id_religion'];
								$model->fk_id_entidad_salud 				=$records['fk_id_entidad_salud'];
								$model->fk_id_escolaridad 					=$records['fk_id_escolaridad'];
								$model->codigo_beneficiario 				=$records['codigo_beneficiario'];
								$model->numero_identificacion_beneficiario 	=$records['numero_identificacion_beneficiario'];
								$model->primer_nombre_beneficiario 			=$records['primer_nombre_beneficiario'];
								$model->segundo_nombre_beneficiario 		=$records['segundo_nombre_beneficiario'];
								$model->apellido_paterno_beneficiario 		=$records['apellido_paterno_beneficiario'];
								$model->apellido_materno_beneficiario 		=$records['apellido_materno_beneficiario'];
								$model->fecha_nacimiento_beneficiario 		=$records['fecha_nacimiento_beneficiario'];
								$model->sexo_beneficiario 					=$records['sexo_beneficiario'];
								$model->numero_hijo_beneficiario 			=$records['numero_hijo_beneficiario'];
								$model->fotografia_beneficiario 			=$records['fotografia_beneficiario'];
								$model->observacion_beneficiario 			=$records['observacion_beneficiario'];
								$model->trabaja_beneficiario 				=$records['trabaja_beneficiario'];
								$model->carnet_de_salud_beneficiario 		=$records['carnet_de_salud_beneficiario'];
								$model->libreta_escolar_beneficiario 		=$records['libreta_escolar_beneficiario'];
								$model->informacion_relevante_beneficiario 	=$records['informacion_relevante_beneficiario'];
							
								if ($model->validate()) {
									$model->save(); 
										
									foreach ($records as $NomTabRel => $valor) {//key=nombre_tabla_atrib , $value=[{},{}] 0 ""
										//echo $NomTabRel."<br>";
										$t=0;	
										if (is_array($valor) && sizeof($valor)!=0) {
											
											if (isset($listaRelaciones[$NomTabRel])) {

												foreach ($valor as $subvalue) {

													$obj=new $listaRelaciones[$NomTabRel]();
													$listaNomPri=$obj->nombreLlavePrimaria($obj->tableName());
													
													if (sizeof($listaNomPri)==1) {
														if(isset($subvalue[$listaNomPri[0]['COLUMN_NAME']])) {													
															$obj=$listaRelaciones[$NomTabRel]::model()->findByPk($subvalue[$listaNomPri[0]['COLUMN_NAME']]);
														} else {
															$sw=-1; 
															$error="llave primaria indefinida";
														}
													} else {
														if (sizeof($listaNomPri)==2 && $t==0) {
															$obj->deleteAll("fk_id_beneficiario=?",array($records['id_beneficiario']));
															$t=1-$t;
														}
													}
													if ($obj!==null) {	
														
														$obj->fk_id_beneficiario=$records['id_beneficiario'];	
														
														foreach ($subvalue as $key3 => $value3) {
															if ($obj->validaCampo($key3)) {
									           						$obj->$key3=$value3;
									           				}
							       						}
							       						if ($obj->validate()) {
									       					$obj->save();
									       					$sw++;
									       				} else {
									       					$error=$obj->getErrors();
									       				}
													} else {
														$error="id fuera de rango";
													}	
												} //foreach
											
											} else {
							       				$error="Nombre de variable indefinido {".$NomTabRel."}";
							       			}
										}//fin if
									}//foreach
									$contValido++;	

								} else {
									$error=$model->getErrors();
								}
							} else {
								$error="Registro no encontrado";
							}//if
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
					$respuesta->meta=array("success"=>"true","msg"=>"Fue actualizado exitosamente !!!");
					$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
				} else {
					$transaction->rollback();
					$respuesta->meta=array("success"=>"false","msg"=>$error);
					$controller->renderPartial('update',array('model'=>$respuesta,'callback'=>$callback));
				}	
			} catch (Exception $e) {
				$transaction->rollback();
				throw $e;
			}
		} else { //callback
			$respuesta->meta=array("success"=>"false","msg"=>"Error de callback");
			$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
		}
		/*if(isset($_GET['records'])){
			$records=CJSON::decode($_GET['records']);
			if(isset($_GET['callback'])&&$_GET['callback']!=='' && !is_numeric($_GET['callback'])) {
				$callback=$_GET['callback'];			
				if(isset($records['id_beneficiario']) && isset($records['fk_id_religion']) && isset($records['fk_id_entidad_salud']) && isset($records['fk_id_escolaridad']) && isset($records['codigo_beneficiario']) && isset($records['numero_identificacion_beneficiario']) && isset($records['primer_nombre_beneficiario']) && isset($records['segundo_nombre_beneficiario']) && isset($records['apellido_paterno_beneficiario']) && isset($records['apellido_materno_beneficiario']) && isset($records['fecha_nacimiento_beneficiario']) && isset($records['sexo_beneficiario']) && isset($records['numero_hijo_beneficiario']) && isset($records['fotografia_beneficiario']) && isset($records['observacion_beneficiario']) && isset($records['trabaja_beneficiario']) && isset($records['carnet_de_salud_beneficiario']) && isset($records['libreta_escolar_beneficiario']) && isset($records['informacion_relevante_beneficiario']) && isset($records['fecha_creacion_beneficiario']) && true){
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
					$model=Beneficiario::model()->findByPk($records['id_beneficiario']);
					if ($model!==null) {
						
						if ($model->validaFK('religion','id_religion',$records['fk_id_religion'])!==false && $model->validaFK('entidad_salud','id_entidad_salud',$records['fk_id_entidad_salud'])!==false && $model->validaFK('escolaridad','id_escolaridad',$records['fk_id_escolaridad'])!==false){					
							$model->fk_id_religion=$records['fk_id_religion'];
							$model->fk_id_entidad_salud=$records['fk_id_entidad_salud'];
							$model->fk_id_escolaridad=$records['fk_id_escolaridad'];
							$model->codigo_beneficiario=$records['codigo_beneficiario'];
							$model->numero_identificacion_beneficiario=$records['numero_identificacion_beneficiario'];
							$model->primer_nombre_beneficiario=$records['primer_nombre_beneficiario'];
							$model->segundo_nombre_beneficiario=$records['segundo_nombre_beneficiario'];
							$model->apellido_paterno_beneficiario=$records['apellido_paterno_beneficiario'];
							$model->apellido_materno_beneficiario=$records['apellido_materno_beneficiario'];
							$model->fecha_nacimiento_beneficiario=$records['fecha_nacimiento_beneficiario'];
							$model->sexo_beneficiario=$records['sexo_beneficiario'];
							$model->numero_hijo_beneficiario=$records['numero_hijo_beneficiario'];
							$model->fotografia_beneficiario=$records['fotografia_beneficiario'];
							$model->observacion_beneficiario=$records['observacion_beneficiario'];
							$model->trabaja_beneficiario=$records['trabaja_beneficiario'];
							$model->carnet_de_salud_beneficiario=$records['carnet_de_salud_beneficiario'];
							$model->libreta_escolar_beneficiario=$records['libreta_escolar_beneficiario'];
							$model->informacion_relevante_beneficiario=$records['informacion_relevante_beneficiario'];
							
							if($model->save()){
								$respuesta->meta=array("success"=>"true","msg"=>"Fue actualizado exitosamente !!!");
								$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
							}else{
								$respuesta->meta=array("success"=>"false","msg"=>"Dato invalido");
								$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
							}
						} else {
							$respuesta->meta=array("success"=>"false","msg"=>"Error de clave forenea");
							$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
						}
					} else {
						$respuesta->meta=array("success"=>"false","msg"=>"id fuera de rango");
						$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
					}
				} else {
					$respuesta->meta=array("success"=>"false","msg"=>"Campos invalidos");
					$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));		
				}
			} else {
				$respuesta->meta=array("success"=>"false","msg"=>"Error de callback");
				$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>''));
			}
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>"Error de filtrado");
			$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>''));
		}*/
	}
}
?>