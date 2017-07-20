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
		$model=new EventoVitalFamilia();

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
					try {
						if (isset($records['id_evento_vital_familia']) && 
							isset($records['fk_id_tipo_evento_vital']) && 
							isset($records['fk_id_familia']) && 
							isset($records['fecha_evento_vital_familia']) && 
							isset($records['observaciones_evento_vital_familia'])
							) {

							$model=EventoVitalFamilia::model()->findByPk($records['id_evento_vital_familia']);
							$audi=new LogSistema();	
							if ($model!==null) {
								$model->fk_id_tipo_evento_vital				=$records['fk_id_tipo_evento_vital'];
								$model->fk_id_familia						=$records['fk_id_familia'];
								$model->fecha_evento_vital_familia 			=$records['fecha_evento_vital_familia'];
								$model->observaciones_evento_vital_familia	=$records['observaciones_evento_vital_familia'];
								
								if ($model->validate()) {
									$model->save();
									$audi->insertAudi("update",$model->tableName(),$records['id_evento_vital_familia']);
									$contValido++;	

								} else {
									$error=$model->getErrors();
									
								}
							} else {
								$error="Id fuera de rango";
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
				$respuesta->meta=array("success"=>"true","msg"=>"Fue actualizado exitosamente !!!");
				$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
			} else {
				$respuesta->meta=array("success"=>"false","msg"=>$error);
				$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
			}
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>"Error de callback");
			$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>''));
		}
	}
}
?>