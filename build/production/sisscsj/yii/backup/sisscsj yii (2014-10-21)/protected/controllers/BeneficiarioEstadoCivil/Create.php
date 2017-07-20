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
		$model=new BeneficiarioEstadoCivil();
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
			$contValido=0;
			$error="Error de llave foranea o campo indefinido";

			$transaction=$model->dbConnection->beginTransaction();
			try {
				foreach ($params as $value) {
					
					$records=CJSON::decode(urldecode($value));//{..p1:[{}],p2:[{}]..}
					$model=new BeneficiarioEstadoCivil();
					try {
						if (isset($records['fk_id_estado_civil']) && 
							isset($records['fk_id_beneficiario']) && 
							isset($records['fecha_asignacion_beneficiario_estado_civil']) && 
							isset($records['estado_beneficiario_estado_civil'])
							) {

							$model->fk_id_estado_civil 							=$records['fk_id_estado_civil'];
							$model->fk_id_beneficiario 							=$records['fk_id_beneficiario'];
							$model->fecha_asignacion_beneficiario_estado_civil	=$records['fecha_asignacion_beneficiario_estado_civil'];
							$model->estado_beneficiario_estado_civil			=$records['estado_beneficiario_estado_civil'];
							
							if ($model->validate()) {
								$model->save();
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
				if ($contValido==$tam) {
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
		/*if (isset($_GET['records'])) {
			$records=CJSON::decode($_GET['records']);
			
			if (isset($_GET['callback']) && $_GET['callback']!=='' && !is_numeric($_GET['callback'])){
				$callback=$_GET['callback'];
				
				if (isset($records['fk_id_estado_civil']) && isset($records['fk_id_beneficiario']) && isset($records['fecha_asignacion_beneficiario_estado_civil']) && isset($records['estado_beneficiario_estado_civil'])){
					
					if ($records['estado_beneficiario_estado_civil']=='true' || $records['estado_beneficiario_estado_civil']===true){
						$records['estado_beneficiario_estado_civil']=1;
					}
					if ($records['estado_beneficiario_estado_civil']=='false' || $records['estado_beneficiario_estado_civil']===false){
						$records['estado_beneficiario_estado_civil']=0;
					}
					if ($model->validaFK('beneficiario','id_beneficiario',$records['fk_id_beneficiario'])!==false && $model->validaFK('estado_civil','id_estado_civil',$records['fk_id_estado_civil'])!==false){
						$model->fk_id_estado_civil=$records['fk_id_estado_civil'];
						$model->fk_id_beneficiario=$records['fk_id_beneficiario'];
						$model->fecha_asignacion_beneficiario_estado_civil=$records['fecha_asignacion_beneficiario_estado_civil'];
						$model->estado_beneficiario_estado_civil=$records['estado_beneficiario_estado_civil'];
						if ($model->save()){
							$respuesta->meta=array("success"=>"true","msg"=>"Se creo exitosamente !!!");
							$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));
						} else {
							$respuesta->meta=array("success"=>"false","msg"=>$model->getErrors());
							$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));						
						}
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
		}*/
	}
}