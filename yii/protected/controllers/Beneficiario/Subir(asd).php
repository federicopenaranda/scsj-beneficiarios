<?php
/**
 * Estas son la accion para el controlador "Beneficiario".
 */

class Subir extends CAction
{
    /**
    * La funcion run ejecuta la logica de la accion
    * Su funcion es la de crear un nuevo registro y adicionarlo en una tabla
    * @param array $callback se introduce el nombre de una funcion
    */
	public function run()
	{
		echo "mesaje".$_POST['fotografia_beneficiario'];
		#$controller=$this->getController();
		#$respuesta=new stdClass();
		/*$model=new Beneficiario();
			if(isset($_POST['fotografia_beneficiario'])){
				$respuesta->meta=array("success"=>"true", "msg"=>"el archivo existe");
				$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));
			} else {
				$respuesta->meta=array("success"=>"true", "msg"=>$_POST['fotografia_beneficiario']);
				$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));	
			}*/
	}
}

