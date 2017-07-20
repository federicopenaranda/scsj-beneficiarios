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
		$controller=$this->getController();
		$respuesta=new stdClass();
		$model=new Beneficiario();
		$callback=$_GET['callback'];
        #$error=$_POST['metadata'];
		#print_r($_FILES);
		#echo "nombre".$_FILES['userfile']['name'];
		/*if(isset($_POST['metadata'])){
			$respuesta->meta=array("success"=>"true", "msg"=>"el archivo existe");
			$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));
		} else {
			$respuesta->meta=array("success"=>"true", "msg"=>$error);
			$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));	
		}*/
			#$model->fotografia_beneficiario=CUploadedFile::getInstance($model,'fotografia_beneficiario');
		$file=CUploadedFile::getInstance($model,'fotografia_beneficiario');
		if(!is_null($file)){
			$lisnombre=explode(".",$file->getName());
			$nombre=md5($lisnombre[0]."_".date("Ymdhms")).".".$lisnombre[1];
			if($file->saveAs(Yii::getPathOfAlias("webroot")."/images/".$nombre)){
				$respuesta->registros=$nombre;
				$respuesta=array("success"=>"true","msg"=>$respuesta);
				$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));
					#$respuesta->meta=array("success"=>"true", "msg"=>"Se creo exitosamente !!!");
					#$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));
			} else {
				$respuesta->meta=array("success"=>"false", "msg"=>"No se pudo guardar");
				$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));
			}
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>"El archivo no fue instanciado");
			$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>$callback));
		}
	}
}

