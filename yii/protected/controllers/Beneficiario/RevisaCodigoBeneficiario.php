<?php
error_reporting(0);
/**
* Esta clase es llamado por su controlador repectivo y en aqui se definen todas las acciones del controlador
* Es una clase que hereda de CAction
*/ 
class RevisaCodigoBeneficiario extends CAction
{
/**
* La funcion run ejecuta la logica de la accion
* Su funcion es la de listar todos los registros de una tabla en la base de datos
* @param array $callback se introduce el nombre de una funcion
*/
	public function run()
	{
		$controller=$this->getController();
		$respuesta=new stdClass();
		$error="";
		$error.= (!isset($_GET['callback'])) ? "{ Error de Callback } " : "";
		if ($error == "") {

			$callback = $_GET['callback'];
			
			if (isset($_GET['filter']) && $_GET['filter']!='') {
				
				$filters =CJSON::decode($_GET['filter']);
	
				$beneficiario = Beneficiario::model()->find('codigo_beneficiario=:codigo_beneficiario', array(':codigo_beneficiario'=>$filters[0]['values']));
				
				if(isset($beneficiario)) {
					$res = "true";
				} else {
					$res = "false";
				}
				$respuesta->meta=array("success"=>"true","msg"=>$res);
				$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>$callback));
			} else {
				$respuesta->meta=array("success"=>"false","msg"=>"Paramatro indefinida filter");
				$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>$callback));
			}
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>$error);
			$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>''));
		}
	}
}