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
   public function run()
   {
		$controller=$this->getController();
		$model=new Beneficiario();

		if (isset($_GET['records'])) {
			$records=CJSON::decode($_GET['records']);

			if (isset($_GET['callback']) && $_GET['callback']!=='' && !is_numeric($_GET['callback'])) {
				$callback=$_GET['callback'];
				
				if (isset($records['fk_id_religion']) && 
					isset($records['fk_id_entidad_salud']) && 
					isset($records['fk_id_nivel_escolaridad']) && 
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
					if ($model->validaFK('entidad_salud','id_entidad_salud',$records['fk_id_entidad_salud'])!==false &&
						$model->validaFK('escolaridad','id_escolaridad',$records['fk_id_nivel_escolaridad'])!==false && 
						$model->validaFK('religion','id_religion',$records['fk_id_religion'])!==false
						) {
						
						$model->fk_id_religion						=$records['fk_id_religion'];
						$model->fk_id_entidad_salud					=$records['fk_id_entidad_salud'];
						$model->fk_id_nivel_escolaridad				=$records['fk_id_nivel_escolaridad'];
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
						//************************************
		
						if (isset($records['usuario_beneficiario'])) {
							$listaObjetos[0]=$records['usuario_beneficiario'];
							$listaRelaciones[0]=new UsuarioBeneficiario();
						} else {
							$listaObjetos[0]=null;
							$listaRelaciones[0]="";
						}
						if (isset($records['eval_enfermeria'])) {
							$listaObjetos[1]=$records['eval_enfermeria'];
							$listaRelaciones[1]=new EvalEnfermeria();
						} else {
							$listaObjetos[1]=null;
							$listaRelaciones[1]="";
						}
						if (isset($records['beneficiario_idioma'])) {
							$listaObjetos[2]=$records['beneficiario_idioma'];
							$listaRelaciones[2]=new BeneficiarioIdioma();
						} else {
							$listaObjetos[2]=null;
							$listaRelaciones[2]="";
						}
						if (isset($records['eval_odontologia'])) {
							$listaObjetos[3]=$records['eval_odontologia'];
							$listaRelaciones[3]=new EvalOdontologia();
						} else {
							$listaObjetos[3]=null;
							$listaRelaciones[3]="";
						}
						if (isset($records['eval_nutricion'])) {
							$listaObjetos[4]=$records['eval_nutricion'];
							$listaRelaciones[4]=new EvalNutricion();
						} else {
							$listaObjetos[4]=null;
							$listaRelaciones[4]="";
						}
						if (isset($records['eval_pedagogico'])) {
							$listaObjetos[5]=$records['eval_pedagogico'];
							$listaRelaciones[5]=new EvalPedagogico();
						} else {
							$listaObjetos[5]=null;
							$listaRelaciones[5]="";
						}
						if (isset($records['eval_edu_childfund'])) {
							$listaObjetos[6]=$records['eval_edu_childfund'];
							$listaRelaciones[6]=new EvalEduChildfund();
						} else {
							$listaObjetos[6]=null;
							$listaRelaciones[6]="";
						}
						if (isset($records['eval_edu_nelson_ortiz'])) {
							$listaObjetos[7]=$records['eval_edu_nelson_ortiz'];
							$listaRelaciones[7]=new EvalEduNelsonOrtiz();
						} else {
							$listaObjetos[7]=null;
							$listaRelaciones[7]="";
						}
						if (isset($records['eval_psicologico'])) {
							$listaObjetos[8]=$records['eval_psicologico'];
							$listaRelaciones[8]=new EvalPsicologico();
						} else {
							$listaObjetos[8]=null;
							$listaRelaciones[8]="";
						}
						if (isset($records['eval_computacion'])) {
							$listaObjetos[9]=$records['eval_computacion'];
							$listaRelaciones[9]=new EvalComputacion();
						} else {
							$listaObjetos[9]=null;
							$listaRelaciones[9]="";
						}
						if (isset($records['beneficiario_entidad'])) {
							$listaObjetos[10]=$records['beneficiario_entidad'];
							$listaRelaciones[10]=new BeneficiarioEntidad();
						} else {
							$listaObjetos[10]=null;
							$listaRelaciones[10]="";
						}
						if (isset($records['beneficiario_asistencia'])) {
							$listaObjetos[11]=$records['beneficiario_asistencia'];
							$listaRelaciones[11]=new BeneficiarioAsistencia();
						} else {
							$listaObjetos[11]=null;
							$listaRelaciones[11]="";
						}
						if (isset($records['beneficiario_donante'])) {
							$listaObjetos[12]=$records['beneficiario_donante'];
							$listaRelaciones[12]=new BeneficiarioDonante();
						} else {
							$listaObjetos[12]=null;
							$listaRelaciones[12]="";
						}
						if (isset($records['beneficiario_patrocinador'])) {
							$listaObjetos[13]=$records['beneficiario_patrocinador'];
							$listaRelaciones[13]=new BeneficiarioPatrocinador();
						} else {
							$listaObjetos[13]=null;
							$listaRelaciones[13]="";
						}
						if (isset($records['parentesco'])) {
							$listaObjetos[14]=$records['parentesco'];
							$listaRelaciones[14]=new Parentesco();//ojo 2 veces
						} else {
							$listaObjetos[14]=null;
							$listaRelaciones[14]="";
						}
						if (isset($records['beneficiario_familia'])) {
							$listaObjetos[15]=$records['beneficiario_familia'];
							$listaRelaciones[15]=new BeneficiarioFamilia();
						} else {
							$listaObjetos[15]=null;
							$listaRelaciones[15]="";
						}
						if (isset($records['beneficiario_actividad_favorita'])) {
							$listaObjetos[16]=$records['beneficiario_actividad_favorita'];
							$listaRelaciones[16]=new BeneficiarioActividadFavorita();
						} else {
							$listaObjetos[16]=null;
							$listaRelaciones[16]="";
						}
						if (isset($records['beneficiario_unidad_educativa'])) {
							$listaObjetos[17]=$records['beneficiario_unidad_educativa'];
							$listaRelaciones[17]=new BeneficiarioUnidadEducativa();
						} else {
							$listaObjetos[17]=null;
							$listaRelaciones[17]="";
						}
						if (isset($records['beneficiario_otros_programas'])) {
							$listaObjetos[18]=$records['beneficiario_otros_programas'];
							$listaRelaciones[18]=new BeneficiarioOtrosProgramas();
						} else {
							$listaObjetos[18]=null;
							$listaRelaciones[18]="";
						}
						if (isset($records['beneficiario_trabajo'])) {
							$listaObjetos[19]=$records['beneficiario_trabajo'];
							$listaRelaciones[19]=new BeneficiarioTrabajo();//fk
						} else {
							$listaObjetos[19]=null;
							$listaRelaciones[19]="";
						}
						if (isset($records['beneficiario_ocupacion'])) {
							$listaObjetos[20]=$records['beneficiario_ocupacion'];
							$listaRelaciones[20]=new BeneficiarioOcupacion();
						} else {
							$listaObjetos[20]=null;
							$listaRelaciones[20]="";
						}
						if (isset($records['beneficiario_estado_beneficiario'])) {
							$listaObjetos[21]=$records['beneficiario_estado_beneficiario'];
							$listaRelaciones[21]=new BeneficiarioEstadoBeneficiario();
						} else {
							$listaObjetos[21]=null;
							$listaRelaciones[21]="";
						}
						if (isset($records['beneficiario_tipo_identificacion'])) {
							$listaObjetos[22]=$records['beneficiario_tipo_identificacion'];
							$listaRelaciones[22]=new BeneficiarioTipoIdentificacion();
						} else {
							$listaObjetos[22]=null;
							$listaRelaciones[22]="";
						}
						if (isset($records['beneficiario_estado_civil'])) {
							$listaObjetos[23]=$records['beneficiario_estado_civil'];
							$listaRelaciones[23]=new BeneficiarioEstadoCivil();
						} else {
							$listaObjetos[23]=null;
							$listaRelaciones[23]="";
						}
						if (isset($records['beneficiario_telefono'])) {
							$listaObjetos[24]=$records['beneficiario_telefono'];
							$listaRelaciones[24]=new BeneficiarioTelefono();//fk
						} else {
							$listaObjetos[24]=null;
							$listaRelaciones[24]="";
						}
						if (isset($records['gestion_beneficiario'])) {
							$listaObjetos[25]=$records['gestion_beneficiario'];
							$listaRelaciones[25]=new GestionBeneficiario();
						} else {
							$listaObjetos[25]=null;
							$listaRelaciones[25]="";
						}
						if (isset($records['eval_atencion_medica'])) {
							$listaObjetos[26]=$records['eval_atencion_medica'];
							$listaRelaciones[26]=new EvalAtencionMedica();
						} else {
							$listaObjetos[26]=null;
							$listaRelaciones[26]="";
						}
						
						//*************************************
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
												$listaObjetos[$i][$j]['fk_id_beneficiario']=$id;
												
												switch ($i) {
													case 0:
														$obj=new UsuarioBeneficiario();

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
														$obj=new EvalEnfermeria();
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
														$obj=new BeneficiarioIdioma();
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
														$obj=new EvalOdontologia();
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
														$obj=new EvalNutricion();
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
														$obj=new EvalPedagogico();
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
													case 6:
														$obj=new EvalEduChildfund();
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
													case 7:
														$obj=new EvalEduNelsonOrtiz();
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
													case 8:
														$obj=new EvalPsicologico();
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
													case 9:
														$obj=new EvalComputacion();
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
													case 10:
														$obj=new BeneficiarioEntidad();
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
													case 11:
														$obj=new BeneficiarioAsistencia();
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
													case 12:
														$obj=new BeneficiarioDonante();
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
													case 13:
														$obj=new BeneficiarioPatrocinador();
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
													case 14:
														$obj=new Parentesco();//ojo 2 veces
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
													case 15:
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
													case 16:
														$obj=new BeneficiarioActividadFavorita();
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
													case 17:
														$obj=new BeneficiarioUnidadEducativa();
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
													case 18:
														$obj=new BeneficiarioOtrosProgramas();
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
													case 19:
														$obj=new BeneficiarioTrabajo();//fk
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
													case 20:
														$obj=new BeneficiarioOcupacion();
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
													case 21:
														$obj=new BeneficiarioEstadoBeneficiario();
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
													case 22:
														$obj=new BeneficiarioTipoIdentificacion();
														foreach ($listaObjetos[$i][$j] as $key => $value) {
            												$obj->$key=$value;
        												}
        												try{
        													if ($obj->save())
            													$contValidos++;
            												else
																$error=array_merge($error,$obj->getErrors());
        												}catch(Exception $e){
        													$error=$e;
        												}
        												
														break;
													case 23:
														$obj=new BeneficiarioEstadoCivil();
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
													case 24:
														$obj=new BeneficiarioTelefono();//fk
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
													case 25:
														$obj=new GestionBeneficiario();
														foreach ($listaObjetos[$i][$j] as $key => $value) {
            												$obj->$key=$value;
        												}
        												try {
        													if ($obj->save())
            													$contValidos++;
            												else
																$error=array_merge($error,$obj->getErrors());
															break;
        												} catch (Exception $e) {
        													$error=$e;
        												}
        												
													case 26:
														$obj=new EvalAtencionMedica();
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
												}//switch
											}//($listaObjetos[$i][$j]!="")
											$j++;
										}//foreach ($listaObjetos[$i] as $listafam) {
									}//if ($listaObjetos[$i]!="") {
									$i++;
								}//foreach

								if ($contValidos==$contNotNull) {
									$transaction->commit();
									$respuesta->meta=array("success"=>"true","msg"=>"Se creo exitosamente !!!");
									$controller->renderParTial('create', array('model'=>$respuesta, 'callback'=>$callback));
								}else{
									$transaction->rollback();
									$respuesta->meta=array("success"=>"false", "msg"=>$error);
									$controller->renderParTial('create', array('model'=>$respuesta, 'callback'=>$callback));
								}
									
							} else {
								$respuesta->meta=array("success"=>"false", "msg"=>$model->getErrors());
								$controller->renderParTial('create', array('model'=>$respuesta, 'callback'=>$callback));
							}
						
						}catch(Exception $e){
							$transaction->rollback();
							throw $e;
						}
						//*******************************************************************
					} else {
						$respuesta->meta=array("success"=>"false","msg"=>"Error llave foranea");
						$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>$callback));
					}//$model->validaFK('')
				} else {
					$respuesta->meta=array("success"=>"false","msg"=>"Campos invalidos");
					$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>$callback));
				}//(isset($records['fk_id_religion']) && 
			} else {
				$respuesta->meta=array("success"=>"false","msg"=>"Error de callback");
				$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
			}//(isset($_GET['callback'])
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>"Error variable indefinida quizas quiso decir records");
			$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
		}//(isset($_GET['records']))
	}
}