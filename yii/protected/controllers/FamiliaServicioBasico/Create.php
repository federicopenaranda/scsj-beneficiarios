<?php
/**
* Esta clase es llamado por su controlador repectivo y en aqui se definen todas las acciones del controlador
* Es una clase que hereda sus propiedad y metodos de la clase padre CAtion
*/ 
class Create extends CAction {
/**
* La funcion run ejecuta la logica de la accion
* Su funcion es la de crear un nuevo registro y adicionarlo en una tabla
* @param array $callback se introduce el nombre de una funcion
*/
   public function run()
   {
		$controller=$this->getController();
		$respuesta=new stdClass();
		$model=new FamiliaServicioBasico();

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
			$contValido=0;
			$error="Error de llave foranea o campo indefinido";

			$transaction=$model->dbConnection->beginTransaction();
			try {
				foreach ($params as $value) {
					
					$records=CJSON::decode(urldecode($value));//{..p1:[{}],p2:[{}]..}
					$model=new FamiliaServicioBasico();
					$audi=new LogSistema();
					try {
						if( isset($records['fk_id_servicio_basico']) && 
							isset($records['fk_id_familia']) && 
							isset($records['observacion_familia_servicio_basico']) && 
							isset($records['estado_familia_servicio_basico'])
							) {

							$model->fk_id_servicio_basico				=$records['fk_id_servicio_basico'];
							$model->fk_id_familia						=$records['fk_id_familia'];
							$model->observacion_familia_servicio_basico	=$records['observacion_familia_servicio_basico'];
							$model->estado_familia_servicio_basico		=$records['estado_familia_servicio_basico'];
							
							if ($model->validate()) {
								$model->save();
								$audi->insertAudi("create",$model->tableName(),$model->getPrimaryKey());
								$contValido++;	

							} else {
								$error=$model->getErrors();
								
							}
						} else {
							$error="Nombre de campos invalidos";
						}//if validacion de campos
					} catch(Exception $e){
							//$error=$e->getMessage();
							
					}		
				}//foreach	

			} catch (Exception $e) {
				$transaction->rollback();
				throw $e;
			}
			if ($contValido==$tam) {
				$transaction->commit();
				$respuesta->meta=array("success"=>"true", "msg"=>"Se creo exitosamente !!!");
				$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));
			} else {
				$respuesta->meta=array("success"=>"false","msg"=>$error);
				$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));
			}
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>"Error de callback");
			$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
		}
	}
}