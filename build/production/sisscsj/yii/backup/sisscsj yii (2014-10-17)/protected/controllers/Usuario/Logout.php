<?php 
class Logout extends CAction
{
   public function run($callback=null){
   		$controller=$this->getController();
		$callback=$_GET['callback'];
		Yii::app()->user->logout();
		//$controller->redirect(Yii::app()->);
		$respuesta=array("success"=>"true","msg"=>"deslogueado!!");
		$controller->renderParTial('index',array('model'=>$respuesta,'callback'=>$callback));
		//$controller->renderParTial('index',array('model'=>array('deslogeado'),'callback'=>$callback));
	}
		
}