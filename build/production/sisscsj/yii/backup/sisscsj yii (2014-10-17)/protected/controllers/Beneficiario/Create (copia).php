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
		$listaRelaciones[]=new UsuarioBeneficiario();
		$listaRelaciones[]=new EvalEnfermeria();
		$listaRelaciones[]=new BeneficiarioIdioma();
		$listaRelaciones[]=new EvalOdontologia();
		$listaRelaciones[]=new EvalNutricion();
		$listaRelaciones[]=new EvalPedagogico();
		$listaRelaciones[]=new EvalEduChildfund();
		$listaRelaciones[]=new EvalEduNelsonOrtiz();
		$listaRelaciones[]=new EvalPsicologico();
		$listaRelaciones[]=new EvalComputacion();
		$listaRelaciones[]=new BeneficiarioEntidad();
		$listaRelaciones[]=new BeneficiarioAsistencia();
		$listaRelaciones[]=new BeneficiarioDonante();
		$listaRelaciones[]=new BeneficiarioPatrocinador();
		$listaRelaciones[]=new Parentesco();//ojo 2 veces
		$listaRelaciones[]=new BeneficiarioFamilia();
		$listaRelaciones[]=new BeneficiarioActividadFavorita();
		$listaRelaciones[]=new BeneficiarioUnidadEducativa();
		$listaRelaciones[]=new BeneficiarioOtrosProgramas();
		$listaRelaciones[]=new BeneficiarioTrabajo();//fk
		$listaRelaciones[]=new BeneficiarioOcupacion();
		$listaRelaciones[]=new BeneficiarioEstadoBeneficiario();
		$listaRelaciones[]=new BeneficiarioTipoIdentificacion();
		$listaRelaciones[]=new BeneficiarioEstadoCivil();
		$listaRelaciones[]=new BeneficiarioTelefono();//fk
		$listaRelaciones[]=new GestionBeneficiario();

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
					isset($records['informacion_relevante_beneficiario']) &&
					
					isset($records['usuario_beneficiario']) &&
					isset($records['eval_enfermeria']) &&
					isset($records['beneficiario_idioma']) &&
					isset($records['eval_odontologia']) &&
					isset($records['eval_nutricion']) &&
					isset($records['eval_pedagogico']) &&
					isset($records['eval_edu_childfund']) &&
					isset($records['eval_edu_nelson_ortiz']) &&
					isset($records['eval_psicologico']) &&
					isset($records['eval_computacion']) &&
					isset($records['beneficiario_entidad']) &&
					isset($records['beneficiario_asistencia']) &&
					isset($records['beneficiario_donante']) &&
					isset($records['beneficiario_patrocinador']) &&
					isset($records['parentesco']) &&
					isset($records['beneficiario_familia']) &&
					isset($records['beneficiario_actividad_favorita']) &&
					isset($records['beneficiario_unidad_educativa']) &&
					isset($records['beneficiario_otros_programas']) &&
					isset($records['beneficiario_trabajo']) &&
					isset($records['beneficiario_ocupacion']) &&
					isset($records['beneficiario_estado_beneficiario']) &&
					isset($records['beneficiario_tipo_identificacion']) &&
					isset($records['beneficiario_estado_civil']) &&
					isset($records['beneficiario_telefono']) &&
					isset($records['gestion_beneficiario'])		
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
						
						$listaObjetos[]=$records['usuario_beneficiario'];
						$listaObjetos[]=$records['eval_enfermeria'];
						$listaObjetos[]=$records['beneficiario_idioma'];
						$listaObjetos[]=$records['eval_odontologia'];
						$listaObjetos[]=$records['eval_nutricion'];
						$listaObjetos[]=$records['eval_pedagogico'];
						$listaObjetos[]=$records['eval_edu_childfund'];
						$listaObjetos[]=$records['eval_edu_nelson_ortiz'];
						$listaObjetos[]=$records['eval_psicologico'];
						$listaObjetos[]=$records['eval_computacion'];
						$listaObjetos[]=$records['beneficiario_entidad'];
						$listaObjetos[]=$records['beneficiario_asistencia'];
						$listaObjetos[]=$records['beneficiario_donante'];
						$listaObjetos[]=$records['beneficiario_patrocinador'];
						$listaObjetos[]=$records['parentesco'];
						$listaObjetos[]=$records['beneficiario_familia'];
						$listaObjetos[]=$records['beneficiario_actividad_favorita'];
						$listaObjetos[]=$records['beneficiario_unidad_educativa'];
						$listaObjetos[]=$records['beneficiario_otros_programas'];
						$listaObjetos[]=$records['beneficiario_trabajo'];
						$listaObjetos[]=$records['beneficiario_ocupacion'];
						$listaObjetos[]=$records['beneficiario_estado_beneficiario'];
						$listaObjetos[]=$records['beneficiario_tipo_identificacion'];
						$listaObjetos[]=$records['beneficiario_estado_civil'];
						$listaObjetos[]=$records['beneficiario_telefono'];
						$listaObjetos[]=$records['gestion_beneficiario'];

						$contNotNull=0;
						$contValid=0;
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
						$i=0;
						foreach ($listaRelaciones as $value) {//5

							if ($listaObjetos[$i]!=null) {

								for ($j=0;$j<sizeof($listaObjetos[$i]);$j++) {

									if ($listaObjetos[$i][$j]!="") {
										$listaObjetos[$i][$j]['fk_id_beneficiario']=1;
										$res=$value->validaAtrib($listaObjetos[$i][$j]);

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
							if ($model->save()) {
								$id=$model->getPrimaryKey();
								$i=0;

								foreach ($listaRelaciones as $value) {//5

									if ($listaObjetos[$i]!="") {
										$j=0;
										foreach ($listaObjetos[$i] as $listafam) {

											if ($listaObjetos[$i][$j]!="") {
												$listaObjetos[$i][$j]['fk_id_beneficiario']=$id;
												
												switch ($i) {
													case 0:
														$obj=new UsuarioBeneficiario();
														$obj->insertar($listaObjetos[$i][$j]);
														break;
													case 1:
														$obj=new EvalEnfermeria();
														$obj->insertar($listaObjetos[$i][$j]);
														break;
													case 2:
														$obj=new BeneficiarioIdioma();
														$obj->insertar($listaObjetos[$i][$j]);
														break;
													case 3:
														$obj=new EvalOdontologia();
														$obj->insertar($listaObjetos[$i][$j]);
														break;
													case 4:
														$obj=new EvalNutricion();
														$obj->insertar($listaObjetos[$i][$j]);
														break;
													case 5:
														$obj=new EvalPedagogico();
														$obj->insertar($listaObjetos[$i][$j]);
														break;
													case 6:
														$obj=new EvalEduChildfund();
														$obj->insertar($listaObjetos[$i][$j]);
														break;
													case 7:
														$obj=new EvalEduNelsonOrtiz();
														$obj->insertar($listaObjetos[$i][$j]);
														break;
													case 8:
														$obj=new EvalPsicologico();
														$obj->insertar($listaObjetos[$i][$j]);
														break;
													case 9:
														$obj=new EvalComputacion();
														$obj->insertar($listaObjetos[$i][$j]);
														break;
													case 10:
														$obj=new BeneficiarioEntidad();
														$obj->insertar($listaObjetos[$i][$j]);
														break;
													case 11:
														$obj=new BeneficiarioAsistencia();
														$obj->insertar($listaObjetos[$i][$j]);
														break;
													case 12:
														$obj=new BeneficiarioDonante();
														$obj->insertar($listaObjetos[$i][$j]);
														break;
													case 13:
														$obj=new BeneficiarioPatrocinador();
														$obj->insertar($listaObjetos[$i][$j]);
														break;
													case 14:
														$obj=new Parentesco();//ojo 2 veces
														$obj->insertar($listaObjetos[$i][$j]);
														break;
													case 15:
														$obj=new BeneficiarioFamilia();
														$obj->insertar($listaObjetos[$i][$j]);
														break;
													case 16:
														$obj=new BeneficiarioActividadFavorita();
														$obj->insertar($listaObjetos[$i][$j]);
														break;
													case 17:
														$obj=new BeneficiarioUnidadEducativa();
														$obj->insertar($listaObjetos[$i][$j]);
														break;
													case 18:
														$obj=new BeneficiarioOtrosProgramas();
														$obj->insertar($listaObjetos[$i][$j]);
														break;
													case 19:
														$obj=new BeneficiarioTrabajo();//fk
														$obj->insertar($listaObjetos[$i][$j]);
														break;
													case 20:
														$obj=new BeneficiarioOcupacion();
														$obj->insertar($listaObjetos[$i][$j]);
														break;
													case 21:
														$obj=new BeneficiarioEstadoBeneficiario();
														$obj->insertar($listaObjetos[$i][$j]);
														break;
													case 22:
														$obj=new BeneficiarioTipoIdentificacion();
														$obj->insertar($listaObjetos[$i][$j]);
														break;
													case 23:
														$obj=new BeneficiarioEstadoCivil();
														$obj->insertar($listaObjetos[$i][$j]);
														break;
													case 24:
														$obj=new BeneficiarioTelefono();//fk
														$obj->insertar($listaObjetos[$i][$j]);
														break;
													case 25:
														$obj=new GestionBeneficiario();
														$obj->insertar($listaObjetos[$i][$j]);
													break;
	
												}
											}
											$j++;
										}
									}
									$i++;
								}
								$respuesta->meta=array("success"=>"true","msg"=>"Se creo exitosamente !!!");
								$controller->renderParTial('create', array('model'=>$respuesta, 'callback'=>$callback));
							} else {
								$respuesta->meta=array("success"=>"false", "msg"=>$model->getErrors());
								$controller->renderParTial('create', array('model'=>$respuesta, 'callback'=>$callback));
							}
						} else {
								$respuesta->meta=array("success"=>"false", "msg"=>$error);
								$controller->renderParTial('create', array('model'=>$respuesta, 'callback'=>$callback));
						}//if ($contNotNull==$contValid)
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
			$respuesta->meta=array("success"=>"false","msg"=>"Error variable indefinida quizas quiso decir records");
			$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
		}
	}
}