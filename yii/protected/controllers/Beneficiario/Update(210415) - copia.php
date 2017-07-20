<?php
/**
 * Estas son la accion para el controlador "Beneficiario".
 */

class Update extends CAction
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
		$model=new Beneficiario();
        $error="";
		$error.= (!isset($_GET['records'])) ? "{ Error en la variable records } " : "";
		$error.= (!isset($_GET['callback'])) ? "{ Error de Callback } " : "";
        
        if ($error == "") {
			$callback=$_GET['callback'];
			$query=explode('&', $_SERVER['QUERY_STRING']);
			$listaRecords=$model->divideRecords($query);
			$numeroRecords=sizeof($listaRecords);
            $listaRelaciones=array(
								'beneficiario_asistencia'			=>'BeneficiarioAsistencia',
								'beneficiario_entidad'				=>'BeneficiarioEntidad',
								'beneficiario_estado_beneficiario'	=>'BeneficiarioEstadoBeneficiario',
								'beneficiario_estado_civil'			=>'BeneficiarioEstadoCivil',
								'beneficiario_familia'				=>'BeneficiarioFamilia',
								'beneficiario_ocupacion'			=>'BeneficiarioOcupacion',
								'beneficiario_patrocinador'			=>'BeneficiarioPatrocinador',
								'beneficiario_telefono'				=>'BeneficiarioTelefono',
								'beneficiario_trabajo'				=>'BeneficiarioTrabajo',
								'eval_atencion_medica'				=>'EvalAtencionMedica',
								'eval_computacion'					=>'EvalComputacion',
								'eval_edu_childfund'				=>'EvalEduChildfund',
								'eval_edu_nelson_ortiz'				=>'EvalEduNelsonOrtiz',
								'eval_enfermeria'					=>'EvalEnfermeria',
								'eval_nutricion'					=>'EvalNutricion',
								'eval_odontologia'					=>'EvalOdontologia',
								'eval_pedagogico'					=>'EvalPedagogico',
								'eval_psicologico'					=>'EvalPsicologico',
								'gestion_beneficiario'				=>'GestionBeneficiario',
								'beneficiario_idioma'				=>'BeneficiarioIdioma',
								'beneficiario_donante'				=>'BeneficiarioDonante',
								'beneficiario_actividad_favorita'	=>'BeneficiarioActividadFavorita',
								'beneficiario_otros_programas'		=>'BeneficiarioOtrosProgramas',
								'beneficiario_tipo_identificacion' 	=>'BeneficiarioTipoIdentificacion',
								'beneficiario_unidad_educativa'=>'BeneficiarioUnidadEducativa',
								'beneficiario_otros_programas'		=>'BeneficiarioOtrosProgramas',
								);
            foreach ($listaRecords as $value) {
				
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
				foreach ($listaRecords as $listaRecord) {
                	$sw=0;
                    $contValRecords=0;
					$record=CJSON::decode(urldecode($listaRecord));
                    
                    if (json_last_error() === JSON_ERROR_NONE) {
                    	try{
        					$error.= (!isset($record['id_beneficiario'])) ? "Variable indefinida {id_beneficiario}" : "";
        					#$error.= (!isset($record['fk_id_religion'])) ? "Variable indefinida {fk_id_religion}" : "";
        					#$error.= (!isset($record['fk_id_entidad_salud'])) ? "Variable indefinida {fk_id_entidad_salud}" : "";
        					#$error.= (!isset($record['fk_id_curso'])) ? "Variable indefinida {fk_id_curso}" : "";
        					#$error.= (!isset($record['fk_id_nivel'])) ? "Variable indefinida {fk_id_nivel}" : "";
        					#$error.= (!isset($record['fk_id_turno'])) ? "Variable indefinida {fk_id_turno}" : "";
        					$error.= (!isset($record['codigo_beneficiario'])) ? "Variable indefinida {codigo_beneficiario}" : "";
        					$error.= (!isset($record['primer_nombre_beneficiario'])) ? "Variable indefinida {primer_nombre_beneficiario}" : "";
        					#$error.= (!isset($record['segundo_nombre_beneficiario'])) ? "Variable indefinida {segundo_nombre_beneficiario}" : "";
        					#$error.= (!isset($record['apellido_paterno_beneficiario'])) ? "Variable indefinida {apellido_paterno_beneficiario}" : "";
        					#$error.= (!isset($record['apellido_materno_beneficiario'])) ? "Variable indefinida {apellido_materno_beneficiario}" : "";
        					$error.= (!isset($record['fecha_nacimiento_beneficiario'])) ? "Variable indefinida {fecha_nacimiento_beneficiario}" : "";
        					$error.= (!isset($record['sexo_beneficiario'])) ? "Variable indefinida {sexo_beneficiario}" : "";
        					$error.= (!isset($record['numero_hijo_beneficiario'])) ? "Variable indefinida {numero_hijo_beneficiario}" : "";
        					$error.= (!isset($record['fotografia_beneficiario'])) ? "Variable indefinida {fotografia_beneficiario}" : "";
        					$error.= (!isset($record['observacion_beneficiario'])) ? "Variable indefinida {observacion_beneficiario}" : "";
        					$error.= (!isset($record['trabaja_beneficiario'])) ? "Variable indefinida {trabaja_beneficiario}" : "";
        					$error.= (!isset($record['carnet_de_salud_beneficiario'])) ? "Variable indefinida {carnet_de_salud_beneficiario}" : "";
        					$error.= (!isset($record['libreta_escolar_beneficiario'])) ? "Variable indefinida {libreta_escolar_beneficiario}" : "";
        					$error.= (!isset($record['informacion_relevante_beneficiario'])) ? "Variable indefinida {informacion_relevante_beneficiario}" : "";
							if ($error=="") {
								$model=Beneficiario::model()->findByPk($record['id_beneficiario']);
                               	$audi=new LogSistema();
								if ($model!==null) {
        							$model->fk_id_religion						=$record['fk_id_religion'];
        							$model->fk_id_entidad_salud					=$record['fk_id_entidad_salud'];
        							$model->fk_id_curso							=$record['fk_id_curso'];
        							$model->fk_id_nivel							=$record['fk_id_nivel'];
        							$model->fk_id_turno							=$record['fk_id_turno'];
									$model->fk_id_formacion                     =$record['fk_id_formacion'];
        							$model->codigo_beneficiario					=$record['codigo_beneficiario'];
        							$model->primer_nombre_beneficiario			=$record['primer_nombre_beneficiario'];
        							$model->segundo_nombre_beneficiario			=$record['segundo_nombre_beneficiario'];
        							$model->apellido_paterno_beneficiario		=$record['apellido_paterno_beneficiario'];
        							$model->apellido_materno_beneficiario		=$record['apellido_materno_beneficiario'];
        							$model->fecha_nacimiento_beneficiario		=$record['fecha_nacimiento_beneficiario'];
        							$model->sexo_beneficiario					=$record['sexo_beneficiario'];
        							$model->numero_hijo_beneficiario			=$record['numero_hijo_beneficiario'];
        							$model->fotografia_beneficiario				=$record['fotografia_beneficiario'];
        							$model->observacion_beneficiario			=$record['observacion_beneficiario'];
        							$model->trabaja_beneficiario				=$record['trabaja_beneficiario'];
        							$model->carnet_de_salud_beneficiario		=$record['carnet_de_salud_beneficiario'];
        							$model->libreta_escolar_beneficiario		=$record['libreta_escolar_beneficiario'];
        							$model->informacion_relevante_beneficiario	=$record['informacion_relevante_beneficiario'];
	                            	if ($model->validate()) {
	                                	$model->save();
	                                	$audi->insertAudi("update",$model->tableName(),$record['id_beneficiario']);
	                                	foreach ($record as $NomTabRel => $valor) {//key=nombre_tabla_atrib , $value=[{},{}] 0 ""
	                                		$t=0;
	                                    	if (is_array($valor)/* && sizeof($valor)!=0*/) {
	                                    
	                                    		if (isset($listaRelaciones[$NomTabRel])) {
													
													if(sizeof($valor)!==0){

														foreach ($valor as $subvalue) {
													
															$obj=new $listaRelaciones[$NomTabRel]();
															$audi=new LogSistema();
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
																	$obj->deleteAll("fk_id_beneficiario=?",array($record['id_beneficiario']));
																	$t=1-$t;
																}
															}
															if ($obj!==null) {
																$obj->fk_id_beneficiario=$record['id_beneficiario'];	
															
																foreach ($subvalue as $key3 => $value3) {
																	if ($obj->validaCampo($key3)) {
																			$obj->$key3=$value3;
																	}
																}
																if ($obj->validate()) {
																	$obj->save();
																	$audi->insertAudi("update",$obj->tableName(),$subvalue[$listaNomPri[0]['COLUMN_NAME']]);
																	$sw++;
																} else {
																	$error=$obj->getErrors();
																}
															}
															else {
																$error="id fuera de rango";
															}
														}//foreach
													} else {
														
														$obj=new $listaRelaciones[$NomTabRel]();
														$audi=new LogSistema();
														$listaNomPri=$obj->nombreLlavePrimaria($obj->tableName());
														if (sizeof($listaNomPri)==2) {
														
															$obj->deleteAll("fk_id_beneficiario=?",array($record['id_beneficiario']));
															if ($obj->validate()) {
																$obj->save();
																$audi->insertAudi("update",$obj->tableName(),"");
																$sw++;
															} else {
																$error=$obj->getErrors();
															}	
														}
													}
													
		                                    	} else {
		                                    		$error="variable  indefinida ".$NomTabRel;
		                                    	}
											} 
										}//foreach        
	                                	$contValRecords++;
	                            	} else {
	                                	$error=array_merge(array("Variable idefinida o "),$model->getErrors());
	                            	}
	                            } else {
									$error="Registro no encontrado";
								}//if
	                        } 
                        } catch(Exception $e) {
							$error=$e->getMessage();
						}
                    } else {
                        $error="Error de json";
                    }
                    if ($sw+$contValRecords == $ListaTotalEleVec[$i]+1) {
						$NumVal++;
					} 
					$i++;
				}//foreach
                if ($NumVal == $numeroRecords) {
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
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>$error);
			$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>''));
		}
    }
}
