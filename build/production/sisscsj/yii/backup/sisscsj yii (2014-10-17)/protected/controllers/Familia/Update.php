<?php 
/**
* Esta clase es llamado por su controlador repectivo y en aqui se definen todas las acciones del controlador
* Es una clase que hereda sus propiedades y metodos de CAction
*/ 
class Update extends CAction
{
/**
* La funcion run ejecuta la logica de la accion
* Su funcion es la de actualizar todos los registros de una tabla en la base de datos
* @param array $callback se introduce el nombre de una funcion
*/
    public function run(){
		$controller=$this->getController();
		$respuesta=new stdClass();
		$model=new Familia();

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
			
			$listaRelaciones= array('familia_servicio_basico'				=>'FamiliaServicioBasico',
									'familia_tipo_casa'						=>'FamiliaTipoCasa',
									'evento_vital_familia'					=>'EventoVitalFamilia',
									'familia_metodo_planificacion_familiar'	=>'FamiliaMetodoPlanificacionFamiliar',
									'beneficiario_familia'					=>'BeneficiarioFamilia',
									'familia_direccion'						=>'FamiliaDireccion',
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
						if (isset($records['id_familia']) && 
							isset($records['codigo_familia']) && 
							isset($records['codigo_familia_antiguo']) && 
							isset($records['numero_hijos_viven_familia']) && 
							isset($records['estado_familia'])
							) {

							$model=Familia::model()->findByPk($records['id_familia']);
							if ($model!==null) {
								$model->codigo_familia 				=$records['codigo_familia'];
								$model->codigo_familia_antiguo		=$records['codigo_familia_antiguo'];
								$model->numero_hijos_viven_familia	=$records['numero_hijos_viven_familia'];
								$model->estado_familia				=$records['estado_familia'];
							
								if ($model->validate()) {
									$model->save(); 
										
									foreach ($records as $NomTabRel => $valor) {//key=nombre_tabla_atrib , $value=[{},{}] 0 ""
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
															$obj->deleteAll("fk_id_familia=?",array($records['id_familia']));
															$t=1-$t;
														}
													}
													if ($obj!==null) {		
														$obj->fk_id_familia=$records['id_familia'];	
														
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
													}
													else {
														$error="id fuera de rango";
													}	
												} //foreach
											} else {
							       				$error="Nombre de variable indefinido";
							       			}//fin if
										}
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
			if(isset($_GET['callback'])&&$_GET['callback']!=='' && !is_numeric($_GET['callback'])){
				$callback=$_GET['callback'];			
				if(isset($records['id_familia']) && isset($records['codigo_familia']) && isset($records['codigo_familia_antiguo']) && isset($records['numero_hijos_viven_familia']) && isset($records['estado_familia']) && true){
					if($records['estado_familia']=='true' || $records['estado_familia']===true){
						$records['estado_familia']=1;
					}
					if($records['estado_familia']=='false' || $records['estado_familia']===false){
						$records['estado_familia']=0;
					}
					$model=Familia::model()->findByPk($records['id_familia']);
					if($model!==null){
						$model->codigo_familia=$records['codigo_familia'];
						$model->codigo_familia_antiguo=$records['codigo_familia_antiguo'];
						$model->numero_hijos_viven_familia=$records['numero_hijos_viven_familia'];
						$model->estado_familia=$records['estado_familia'];
						#$model->fecha_creacion_familia=$records['fecha_creacion_familia'];
						if($model->save()){
							$respuesta->meta=array("success"=>"true","msg"=>"Fue actualizado exitosamente !!!");
							$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
						}else{
							$respuesta->meta=array("success"=>"false","msg"=>$model->getErrors());
							$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
						}
					}else{
						$respuesta->meta=array("success"=>"false","msg"=>"id fuera de rango");
						$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
					}
				}else{
					$respuesta->meta=array("success"=>"false","msg"=>"Campos invalidos");
					$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));				
				}
			}else{
				$respuesta->meta=array("success"=>"false","msg"=>"Error de callback");
				$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>''));
			}
		}else{
			$respuesta->meta=array("success"=>"false","msg"=>"Error de filtrado");
			$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>''));
		}*/
	}
}
?>