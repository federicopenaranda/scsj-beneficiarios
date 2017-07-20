<?php
/**
 * Estas son la accion para el controlador "Beneficiario".
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
								'beneficiario_donante'				=>'BeneficiarioDonante',
								'beneficiario_actividad_favorita'	=>'BeneficiarioActividadFavorita',
								'beneficiario_idioma'				=>'BeneficiarioIdioma',
								'beneficiario_tipo_identificacion' 	=>'BeneficiarioTipoIdentificacion',
								'beneficiario_unidad_educativa'		=>'BeneficiarioUnidadEducativa',
								'beneficiario_otros_programas'		=>'BeneficiarioOtrosProgramas',
								'historia_social'					=>'HistoriaSocial',
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
                    $model=new Beneficiario();
                    $audi=new LogSistema();
                    
                    if (json_last_error() === JSON_ERROR_NONE) {
                    	try{
        					$error.= (!isset($record['codigo_beneficiario'])) ? "Variable indefinida {codigo_beneficiario}" : "";
        					$error.= (!isset($record['primer_nombre_beneficiario'])) ? "Variable indefinida {primer_nombre_beneficiario}" : "";
        					$error.= (!isset($record['fecha_nacimiento_beneficiario'])) ? "Variable indefinida {fecha_nacimiento_beneficiario}" : "";
        					$error.= (!isset($record['sexo_beneficiario'])) ? "Variable indefinida {sexo_beneficiario}" : "";
        					$error.= (!isset($record['fotografia_beneficiario'])) ? "Variable indefinida {fotografia_beneficiario}" : "";
        					$error.= (!isset($record['observacion_beneficiario'])) ? "Variable indefinida {observacion_beneficiario}" : "";
        					$error.= (!isset($record['trabaja_beneficiario'])) ? "Variable indefinida {trabaja_beneficiario}" : "";
        					$error.= (!isset($record['carnet_de_salud_beneficiario'])) ? "Variable indefinida {carnet_de_salud_beneficiario}" : "";
        					$error.= (!isset($record['libreta_escolar_beneficiario'])) ? "Variable indefinida {libreta_escolar_beneficiario}" : "";
        					$error.= (!isset($record['informacion_relevante_beneficiario'])) ? "Variable indefinida {informacion_relevante_beneficiario}" : "";
							if ($error=="") {
								$cod1 = substr($record['primer_nombre_beneficiario'],0,1). substr($record['segundo_nombre_beneficiario'],0,1).substr($record['apellido_paterno_beneficiario'],0,1).substr($record['apellido_materno_beneficiario'],0,1).'-';
								$codigo = strtoupper($cod1.str_replace('T00:00:00','',str_replace('-','',$record['fecha_nacimiento_beneficiario'])));
								#$cod 	= substr(md5($cod1.date('Y-m-d H:m:s')),0,3);
								#$codigo = $subcodigo;

								$model->fk_id_religion						=$record['fk_id_religion'];
        						$model->fk_id_entidad_salud					=$record['fk_id_entidad_salud'];
        						$model->fk_id_curso							=$record['fk_id_curso'];
        						$model->fk_id_nivel							=$record['fk_id_nivel'];
        						$model->fk_id_turno							=$record['fk_id_turno'];
								$model->fk_id_formacion                     =$record['fk_id_formacion'];
        						$model->codigo_beneficiario					=$codigo;
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
								
								$model->numero_caso_beneficiario_patrocinador			=$record['numero_caso_beneficiario_patrocinador'];
								$model->numero_ninio_beneficiario_patrocinador			=$record['numero_ninio_beneficiario_patrocinador'];
								$model->codigo_donante_beneficiario_patrocinador		=$record['codigo_donante_beneficiario_patrocinador'];
								$model->nombre_patrocinador_beneficiario_patrocinador	=$record['nombre_patrocinador_beneficiario_patrocinador'];
								
	                            if ($model->validate()) {
		
	                                $model->save();
                                    $audi->insertAudi("create",$model->tableName(),$model->getPrimaryKey());
	                                $id_tabla_principal=$model->getPrimaryKey();
	                                
	                                foreach ($record as $NomTabRel => $valor) {//key=nombre_tabla_atrib , $value=[{},{}] 0 ""
	                                	
	                                    if (is_array($valor) && sizeof($valor)!=0) {
	                                    	
	                                    	if (isset($listaRelaciones[$NomTabRel])) {

		                                        foreach ($valor as $subvalue) {
		                                        
		                                        	$obj=new $listaRelaciones[$NomTabRel]();
                                                    $audi=new LogSistema();
													$obj->fk_id_beneficiario=$id_tabla_principal;
		                                            foreach ($subvalue as $key3 => $value3) {
														if($obj->validaCampo($key3)){
						           							if ($key3=="fk_id_beneficiario")
						           								$obj->fk_id_beneficiario=$id_tabla_principal;
						           							else {
																if ($key3 == "fk_id_actividad_favorita")
																	$id_MM = $value3;
																if ($key3 == "fk_id_donante")
																	$id_MM = $value3;
																if($key3 == "fk_id_idioma")
																	$id_MM = $value3;
																if($key3 == "fk_id_unidad_educativa")
																	$id_MM = $value3;
																if($key3 == "fk_id_tipo_identificacion")
																	$id_MM = $value3;
						           								$obj->$key3=$value3;
															}
						           						}
					       							}
		                                            
                                                    if ($obj->validate()) {
					       								$obj->save();
														if (is_numeric($obj->getPrimaryKey())) {
															$audi->insertAudi("create",$obj->tableName(),$obj->getPrimaryKey());
														} else {
															$audi->insertAudi("create",$obj->tableName(),$id_tabla_principal."-".$id_MM);
														}
                                                        #$audi->insertAudi("create",$obj->tableName(),$obj->getPrimaryKey());
					       								$sw++;
					       							} else {
					       								$error=$obj->getErrors();
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
					$respuesta->meta=array("success"=>"true", "msg"=>"Se creo exitosamente !!!");
					$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));
				} else {
					$respuesta->meta=array("success"=>"false","msg"=>$error);
					$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));
				}
			} catch (Exception $e) {
				$transaction->rollback();
				throw $e;
			}
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>$error);
			$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
		}
    }
}





