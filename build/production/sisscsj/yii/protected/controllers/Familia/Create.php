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
		$model=new Familia();
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
			
			$listaRelaciones= array('familia_servicio_basico'				=>'FamiliaServicioBasico',
									'familia_tipo_casa'						=>'FamiliaTipoCasa',
									'evento_vital_familia'					=>'EventoVitalFamilia',
									'familia_metodo_planificacion_familiar'	=>'FamiliaMetodoPlanificacionFamiliar',
									'beneficiario_familia'					=>'BeneficiarioFamilia',
									'familia_direccion'						=>'FamiliaDireccion',
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
					$model=new Familia();
					$audi=new LogSistema();
					try {
						if (isset($records['codigo_familia']) && 
							isset($records['codigo_familia_antiguo']) && 
							isset($records['numero_hijos_viven_familia']) && 
							isset($records['estado_familia'])
							) {

							$model->codigo_familia 				=$records['codigo_familia'];
							$model->codigo_familia_antiguo		=$records['codigo_familia_antiguo'];
							$model->numero_hijos_viven_familia	=$records['numero_hijos_viven_familia'];
							$model->estado_familia				=$records['estado_familia'];
							
							if ($model->validate()) {
								
								$model->save();
								$audi->insertAudi("create",$model->tableName(),$model->getPrimaryKey());
								$id_familia=$model->getPrimaryKey();
									
								foreach ($records as $NomTabRel => $valor) {//key=nombre_tabla_atrib , $value=[{},{}] 0 ""
									
									if (is_array($valor) && sizeof($valor)!=0) {
											
										foreach ($valor as $subvalue) {
														
											$obj = new $listaRelaciones[$NomTabRel]();
											$audi = new LogSistema();
											$obj->fk_id_familia = $id_familia;
											
											foreach ($subvalue as $key3 => $value3) {
												if($obj->validaCampo($key3)){
				           							if ($key3=="fk_id_familia")
				           								$obj->fk_id_familia=$id_familia;
				           							else {
														if($key3 == "fk_id_metodo_planificacion_familiar")
															$id_MM = $value3;
				           								$obj->$key3 = $value3;
													}
				           						}
			       							}

											if ($obj->validate()) {
			       								$obj->save();
												if (is_numeric($obj->getPrimaryKey())) {
													$audi->insertAudi("create",$obj->tableName(),$obj->getPrimaryKey());
												} else {
													$audi->insertAudi("create",$obj->tableName(),$id_familia."-".$id_MM);
												}
			       								$sw++;
			       							} else {
			       								$error = $obj->getErrors();
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
							#$error=$e->getMessage();
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
	} //end run()
}
ini_set ('display_errors', 1);  error_reporting (E_ALL);