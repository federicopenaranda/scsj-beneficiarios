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
		$model=new Usuario();
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
			
			$listaRelaciones = array(
                					'actividad'				=>'Actividad',
                					'asistencia'			=>'Asistencia',
                					'biblioteca'			=>'Biblioteca',
                					'eval_atencion_medica'	=>'EvalAtencionMedica',
                					'eval_computacion'		=>'EvalComputacion',
                					'eval_edu_childfund'	=>'EvalEduChildfund',
               						'eval_edu_nelson_ortiz'	=>'EvalEduNelsonOrtiz',
                					'eval_enfermeria'		=>'EvalEnfermeria',
									'eval_nutricion'		=>'EvalNutricion',
									'eval_odontologia'		=>'EvalOdontologia',
									'eval_pedagogico'		=>'EvalPedagogico',
									'eval_psicologico'		=>'EvalPsicologico',
									'log_sistema'			=>'LogSistema',
									'personal_asistencia'	=>'PersonalAsistencia',
									'usuario_beneficiario'	=>'UsuarioBeneficiario',
									'usuario_entidad'		=>'UsuarioEntidad',
									'usuario_lugar'			=>'UsuarioLugar',
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
						if (isset($records['id_usuario']) && 
							isset($records['fk_id_tipo_usuario']) && 
							isset($records['nombre_usuario']) && 
							isset($records['apellido_usuario']) && 
							isset($records['login_usuario']) && 
							isset($records['password_usuario']) && 
							isset($records['sexo_usuario']) && 
							isset($records['telefono_usuario']) && 
							isset($records['celular_usuario']) && 
							isset($records['correo_usuario']) && 
							isset($records['direccion_usuario']) && 
							isset($records['observacion_usuario'])
						) {

							$model=Usuario::model()->findByPk($records['id_usuario']);
							$audi=new LogSistema();
							if ($model!==null) {
								$model->fk_id_tipo_usuario			=$records['fk_id_tipo_usuario'];
								$model->nombre_usuario				=$records['nombre_usuario'];
								$model->apellido_usuario			=$records['apellido_usuario'];
								$model->login_usuario				=$records['login_usuario'];
								if ($records['password_usuario']!=="") {
									$model->password_usuario		=sha1($records['password_usuario']);
								}
								$model->sexo_usuario				=$records['sexo_usuario'];
								$model->fecha_actualizacion_usuario	=date('Y-m-d H:i:s');
								$model->telefono_usuario			=$records['telefono_usuario'];
								$model->celular_usuario				=$records['celular_usuario'];
								$model->correo_usuario				=$records['correo_usuario'];
								$model->direccion_usuario			=$records['direccion_usuario'];
								$model->observacion_usuario			=$records['observacion_usuario'];

								if ($model->validate()) {
									$model->save(); 
									$audi->insertAudi("update",$model->tableName(),$records['id_usuario']);	
									foreach ($records as $NomTabRel => $valor) {//key=nombre_tabla_atrib , $value=[{},{}] 0 ""
										//echo $NomTabRel."<br>";

										$t=0;	
										if (is_array($valor) /*&& sizeof($valor)!=0*/) {
											
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
																
																$obj->deleteAll("fk_id_usuario=?",array($records['id_usuario']));
																$t=1-$t;
															}
														}
														if ($obj!==null) {	
															
															$obj->fk_id_usuario=$records['id_usuario'];	
															
															foreach ($subvalue as $key3 => $value3) {
																if ($obj->validaCampo($key3)) {
																		$obj->$key3=$value3;
																}
															}
															if ($obj->validate()) {
																$obj->save();
																$audi->insertAudi("update",$obj->tableName(),"");
																$sw++;
															} else {
																$error=$obj->getErrors();
															}
														} else {
															$error="id fuera de rango";
														}	
													} //foreach
												} else {
													$obj=new $listaRelaciones[$NomTabRel]();
													$audi=new LogSistema();
													$listaNomPri=$obj->nombreLlavePrimaria($obj->tableName());
													if (sizeof($listaNomPri)==2) {
														$obj->deleteAll("fk_id_usuario=?",array($records['id_usuario']));
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
	}
}
?>