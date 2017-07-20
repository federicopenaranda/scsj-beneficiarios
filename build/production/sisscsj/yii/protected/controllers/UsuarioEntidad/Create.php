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
	public function run(){
		$controller=$this->getController();
		$model=new UsuarioEntidad();
		$respuesta=new stdClass();
		
		if(isset($_GET['records'])){
			$records=CJSON::decode($_GET['records']);
			
			if (isset($_GET['callback'])&&$_GET['callback']!=='' && !is_numeric($_GET['callback'])){
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
				$error="Error de llave foranea o campo indefinido";
				$NumVal=0;
				$i=0;
				$transaction=$model->dbConnection->beginTransaction();
				try {
					foreach ($params as $value) {
						$sw=0;
						$contValido=0;
						$records=CJSON::decode(urldecode($value));//{..p1:[{}],p2:[{}]..}
						$model=new UsuarioEntidad();
						$audi=new LogSistema();
						if (isset($records['fk_id_usuario']) && isset($records['fk_id_entidad']) && isset($records['fecha_registro_usuario_entidad']) && isset($records['estado_usuario_entidad'])){
							try {
								$model->fk_id_usuario=$records['fk_id_usuario'];
								$model->fk_id_entidad=$records['fk_id_entidad'];
								$model->fecha_registro_usuario_entidad=$records['fecha_registro_usuario_entidad'];
								$model->estado_usuario_entidad=$records['estado_usuario_entidad'];
								if ($model->validate()){
									$model->save();
									$audi->insertAudi("create",$model->tableName(),$model->getPrimaryKey());
									$NumVal++;
								} else {
										$error=$model->getErrors();
								}
							} catch (Exception $e) {
								$error="error de llave foranea";
							}
						} else {
							$error="Nombre de campos invalidos";
						}
					}
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