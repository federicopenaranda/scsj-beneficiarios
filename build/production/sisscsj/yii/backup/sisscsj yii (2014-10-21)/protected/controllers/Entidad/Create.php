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
		$model=new Entidad();
		$respuesta=new stdClass();
		if (isset($_GET['records'])){
			$str=str_replace('"[', '[',$_GET['records']);
			$str=str_replace(']"', ']',$str);
			$str=str_replace('\"', '"', $str);
			$records=CJSON::decode($str);

			if (json_last_error()==JSON_ERROR_NONE){
			
				if (isset($_GET['callback'])&&$_GET['callback']!=='' && !is_numeric($_GET['callback'])){
					$callback=$_GET['callback'];
					
					if (isset($records['fk_id_tipo_entidad']) && 
						isset($records['nombre_entidad']) && 
						isset($records['fecha_inicio_actividades_entidad']) && 
						isset($records['fecha_fin_actividades_entidad']) && 
						isset($records['direccion_entidad']) && 
						isset($records['observaciones_entidad'])
						) {
						
						if ($model->validaFK('tipo_entidad','id_tipo_entidad',$records['fk_id_tipo_entidad'])!==false){
							$model->fk_id_tipo_entidad=$records['fk_id_tipo_entidad'];
							$model->nombre_entidad=$records['nombre_entidad'];
							$model->fecha_inicio_actividades_entidad=$records['fecha_inicio_actividades_entidad'];
							$model->fecha_fin_actividades_entidad=$records['fecha_fin_actividades_entidad'];
							$model->direccion_entidad=$records['direccion_entidad'];
							$model->observaciones_entidad=$records['observaciones_entidad'];
							//***************************
							$listaRelaciones= array('usuario_entidad'=>'UsuarioEntidad',
													'beneficiario_entidad'=>'BeneficiarioEntidad',
													'entidad_estado_entidad'=>'EntidadEstadoEntidad'
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
															$obj->fk_id_entidad=$id;
															try{
																foreach ($value2 as $key3 => $value3) {
           															if($key3=="fk_id_entidad" && is_null($value3) || $value3==null)
																	$obj->fk_id_entidad=$id;
																	if($key3!=="nombre_estado_entidad"){
																	if($value3===true)
           																$value3=1;
           															if($value3===false)
           																$value3=0;
           															$obj->$key3=$value3;
																	}//nombre_estado_entidad
       															}
															}catch (Exception $e) {
																$error="Error, nombre de atributos invalidos";
       															$cont=-1;		
       														}
													
       														try {
																if ($obj->validate()) {
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
										}//if
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
							}else{
								$respuesta->meta=array("success"=>"false","msg"=>$model->getErrors());
								$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>$callback));
							}//if
						//*******************************************************
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
				$respuesta->meta=array("success"=>"false","msg"=>"Error de sintaxis JSON");
				$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
			}
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>"Error variable indefinida quizas quiso decir records");
			$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
		}
	}
}