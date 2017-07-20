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
		$model=new BeneficiarioTelefono();

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
						if (isset($records['id_beneficiario_telefono']) && 
							isset($records['fk_id_beneficiario']) && 
							isset($records['numero_beneficiario_telefono']) && 
							isset($records['tipo_telefono']) && 
							isset($records['emergencia_beneficiario_telefono'])
							) {

							$model=BeneficiarioTelefono::model()->findByPk($records['id_beneficiario_telefono']);
							$audi=new LogSistema();
							if ($model!==null) {
								$model->fk_id_beneficiario 				=$records['fk_id_beneficiario'];
								$model->numero_beneficiario_telefono	=$records['numero_beneficiario_telefono'];
								$model->tipo_telefono					=$records['tipo_telefono'];
								$model->emergencia_beneficiario_telefono=$records['emergencia_beneficiario_telefono'];
								
								if ($model->validate()) {
									$model->save();
									$audi->insertAudi("update",$model->tableName(),$records['id_beneficiario_telefono']);
									$contValido++;	
								} else {
									$error=$model->getErrors();	
								}
							} else {
								$error="Registro no encontrado";
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
					$respuesta->meta=array("success"=>"true","msg"=>"Fue actualizado exitosamente !!!");
					$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
				} else {
					$transaction->rollback();
					$respuesta->meta=array("success"=>"false","msg"=>$error);
					$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
				}
			} catch (Exception $e) {
				$transaction->rollback();
				throw $e;
			}
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>"Error de callback");
			$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>''));
		}
	}
}
?>